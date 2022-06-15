<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Module extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->library('grocery_CRUD');
		isLogin();
	}

	public function default_config($crud,$config)
	{
		$crud->set_table($config['table']);
		$state = $crud->getState();
		if($state == 'add') {
            $crud->field_type($config['pk'], 'hidden', $this->uuid->v4());
	    }
	    else {
    		$crud->change_field_type($config['pk'] , 'invisible');
		}
		// array_push($unset_column,$config['unset_column']);
		// array_merge($unset_column,$config['unset_column']);
		$unset_column = array_merge(array($config['pk'],'created_at','deleted_at'),(isset($config['unset_column']) ? $config['unset_column'] : array()));
		
		
		$crud->unset_columns($unset_column);
		$crud->change_field_type('user_log','hidden',$this->session->user_logged->id_users);
		$crud->change_field_type('created_at','invisible');
		$crud->change_field_type('updated_at','invisible');
		$crud->change_field_type('deleted_at','invisible');

		$crud->set_language('indonesian');
		$crud->set_theme('flexigrid');

		if(isset($config['display']))
		{
			foreach ($config['display'] as $field => $alias) {
				$crud->display_as($field,$alias);
			}
		}

		return $crud;
	}

	public function vendor()
	{
		$crud = new grocery_CRUD();

		//REQUIRED
		$config['pk'] = 'id_vendor';
		$config['display'] = array(
			'LUPDATE' => 'Updated At'
		);
		$config['table'] = "tb_vendor";
		$config['unset_column'] = array("GRPPRD","LUPOPR","user_log");
		$this->default_config($crud,$config);

		$crud->set_field_upload('logo','uploads');
		
		$output = $crud->render();
		$this->load->view('layout',$output);
	}

	public function packet()
	{
		$crud = new grocery_CRUD();

		//REQUIRED
		$config['pk'] = 'id_packet';
		$config['display'] = array(
			'LUPDATE' => 'Updated At'
		);
		$config['table'] = "tb_packet";
		$this->default_config($crud,$config);

		$crud->set_relation('vendor_packet','tb_vendor','nama_vendor');
		
		$options = array(
			'1' => 'Minimalist',
			'2' => 'Standard',
			'3' => 'Mewah'
		);

		$crud->change_field_type('dekorasi','dropdown',$options);
		$crud->change_field_type('rias','dropdown',$options);
		$crud->change_field_type('catering','dropdown',$options);

		$crud->set_field_upload('photo_1','uploads/packet');
		$crud->set_field_upload('photo_2','uploads/packet');
		$crud->set_field_upload('photo_3','uploads/packet');
		$crud->set_field_upload('photo_4','uploads/packet');

		$output = $crud->render();
		$this->load->view('layout',$output);
	}

	public function banner()
	{
		$crud = new grocery_CRUD();

		//REQUIRED
		$config['pk'] = 'id_banner';
		$config['display'] = array();
		$config['table'] = "ms_banner";
		$this->default_config($crud,$config);
		
		$crud->set_field_upload('file_banner','uploads/banner');

		$output = $crud->render();
		$this->load->view('layout',$output);
	}
	
	public function usergroup()
	{
		$crud = new grocery_CRUD();

		//REQUIRED
		$config['pk'] = 'id_usergroup';
		$config['display'] = array();
		$config['table'] = "ms_usergroup";
		$this->default_config($crud,$config);
		
		//custom button action
		$crud->add_action('Smileys', 'http://www.grocerycrud.com/assets/uploads/general/smiley.png', 'module/index/');
		
		$output = $crud->render();
		$this->load->view('layout',$output);
	}

	public function division()
	{
		$crud = new grocery_CRUD();

		//REQUIRED
		$config['pk'] = 'id_division';
		$config['display'] = array(
			'LUPDATE' => 'Updated At'
		);
		$config['table'] = "ms_division";
		$config['unset_column'] = array("GRPPRD","LUPOPR","user_log");
		$this->default_config($crud,$config);
		
		$output = $crud->render();
		$this->load->view('layout',$output);
	}

	public function favorite()
	{
		$crud = new grocery_CRUD();

		//REQUIRED
		$config['pk'] = 'id_favorite';
		$config['display'] = array(
			'user_favorite' => 'Salesman/Toko',
			'product_favorite' => 'Produk Favorit',
		);
		$config['table'] = "tb_product_favorite";
		$config['unset_column'] = array("GRPPRD","LUPOPR","user_log,user_favorite");

		if(getLevel() != "admin")
		{
			$config['unset_column'] = array("GRPPRD","LUPOPR","user_log");
			$user = $this->session->user_logged->id_users;
			$this->db->where('user_favorite',$user);
		}

		$this->default_config($crud,$config);
		$crud->set_relation('user_favorite','ms_users','{username_users}');
		$crud->set_relation('product_favorite','ms_product','{code_product}-{name_product}');

		$crud->unset_import();
		$crud->unset_exportdbf();
		
		$output = $crud->render();
		$this->load->view('layout',$output);
	}

	public function privilege()
	{
		$crud = new grocery_CRUD();

		//REQUIRED
		$config['pk'] = 'id_usergroup';
		$config['display'] = array();
		$config['table'] = "ms_usergroup";
		$this->default_config($crud,$config);
		
		$output = $crud->render();
		$this->load->view('layout',$output);
	}

	public function users()
	{
		$crud = new grocery_CRUD();

		//REQUIRED
		$config['pk'] = 'id_users';
		$config['display'] = array(
			'usergroup_users' => 'Level'
		);
		$config['table'] = "ms_users";
		$config['unset_column'] = array("password_users");
		$this->default_config($crud,$config);

		$crud->columns(['username_users','usergroup_users','salesman_users','store_users','updated_at']);

		$state = $crud->getState();
		if($state == 'edit') {
			$crud->change_field_type('password_users', 'invisible');
	    }

		$crud->set_relation('salesman_users','ms_salesman','{name_salesman}');
		$crud->set_relation('usergroup_users','ms_usergroup','{name_usergroup}');
		$crud->set_relation('store_users','ms_store','{kode_store} - {name_store}');
		
		$crud->unset_import();
		$crud->unset_exportdbf();

		$crud->callback_before_insert(array($this,'password_callback'));
		$crud->add_action('Reset Password', base_url('assets/bt-reset.png'), 'module/reset_password');
		$output = $crud->render();
		$this->load->view('layout',$output);
	}

	public function product()
	{
		$crud = new grocery_CRUD();

		//REQUIRED
		$config['pk'] = 'id_product';
		$config['display'] = array();
		$config['table'] = "ms_product";
		$this->default_config($crud,$config);

		if(getLevel() != "admin")
		{
			$crud->unset_add();
			$crud->unset_edit();
			$crud->unset_clone();
			$crud->unset_import();
			$crud->unset_exportdbf();
			$crud->unset_delete();
		}
		
		$crud->set_field_upload('img','upload/product');
		$crud->set_field_upload('img_2','upload/product');
		// $crud->set_field_upload('thumbnail','upload/product');

		$crud->add_action('Tambahkan ke favorite', base_url('assets/star.png'), 'favorite/add/');

		// $crud->set_relation('division_product','ms_division','{name_division}');
		
		// $crud->callback_column('division_product',array($this,'division_callback')); 
		$division = array();
        $dataa = $this->db->get('ms_division')->result_array();
		foreach ($dataa as $key => $value) {
			$division[$value['code_division']] = $value['name_division'];
		}
		$crud->field_type('division_product','dropdown',$division);

		$output = $crud->render();
		$this->load->view('layout',$output);
	}

	public function division_callback($row,$data)
	{
		$this->db->where('code_division',$row);
        $dataa = $this->db->get('ms_division')->row_array();
		return $row. "-" .$dataa['name_division'];
	}

	public function image_callback($row,$data)
	{
		return ($data->img != null) ? "<a href='".$data->img."' target='blank'>lihat gambar</a>" : "";
	}

	public function option()
	{
		$crud = new Grocery_CRUD();

		//REQUIRED
		$config['pk'] = 'id';
		$config['display'] = array();
		$config['table'] = "ms_option";
		$this->default_config($crud,$config);
		$crud->set_relation('pengguna','ms_salesman','{name_salesman}');
		$output = $crud->render();
		$this->load->view('layout',$output);
	}

	public function warehouse()
	{
		$crud = new grocery_CRUD();

		//REQUIRED
		$config['pk'] = 'id_warehouse';
		$config['display'] = array();
		$config['table'] = "ms_warehouse";
		$this->default_config($crud,$config);
		
		$crud->unset_import();
		$crud->unset_exportdbf();

		$output = $crud->render();
		$this->load->view('layout',$output);
	}

	public function store()
	{
		$crud = new grocery_CRUD();

		//REQUIRED
		$config['pk'] = 'id_store';
		$config['display'] = array();
		$config['table'] = "ms_store";
		$this->default_config($crud,$config);
		
		$crud->unset_exportdbf();
		$crud->display_as('disccst','Diskon');

		$crud->columns(['kode_store','name_store','salesman_store','disccst','discdgcst','discnoncst','npotcst','kpotcst']);

		$crud->set_relation('salesman_store','ms_salesman','{name_salesman}');

		$output = $crud->render();
		$this->load->view('layout',$output);
	}

	public function change_password()
	{
		$crud = new grocery_CRUD();

		//REQUIRED
		$config['pk'] = 'id_user';
		$config['display'] = array();
		$config['table'] = "ms_users";
		$this->default_config($crud,$config);

		$output = $crud->render();
		$this->load->view('layout',$output);
	}

	public function stok()
	{
		$crud = new grocery_CRUD();

		//REQUIRED
		$config['pk'] = 'id';
		$config['display'] = array(
			'GDGFG' => 'Gudang',
			'DIVFG' => 'Divisi',
			'ARTFG' => 'Code Product',
			'AK26FG' => '26',
			'AK27FG' => '27',
			'AK28FG' => '28',
			'AK29FG' => '29',
			'AK30FG' => '30',
			'AK31FG' => '31',
			'AK32FG' => '32',
			'AK33FG' => '33',
			'AK34FG' => '34',
			'AK35FG' => '35',
			'AK36FG' => '36',
			'AK37FG' => '37',
			'AK38FG' => '38',
			'AK39FG' => '39',
			'AK40FG' => '40',
			'AK41FG' => '41',
			'AK42FG' => '42',
			'AK43FG' => '43',
			'AK44FG' => '44',
			'AK45FG' => '45',
			'AKPCSFG' => 'Stok'
		);
		$config['table'] = "fgm";
		$this->default_config($crud,$config);

		$crud->unset_add();
		$crud->unset_edit();
		$crud->unset_clone();
		$crud->unset_import();
		$crud->unset_exportdbf();
		$crud->unset_delete();

		$crud->columns(['CART','PRICE','GDGFG','ARTFG','DIVFG','AKPCSFG','AK26FG','AK27FG','AK28FG','AK29FG','AK30FG','AK31FG','AK32FG','AK33FG','AK34FG','AK35FG','AK36FG','AK37FG','AK38FG','AK39FG','AK40FG','AK41FG','AK42FG','AK43FG','AK44FG','AK45FG','updated_at']);
		// if(getLevel() == "TK")
        // {
		// 	$user = $this->session->user_logged;
		// 	$this->load->model('Store_model');
		// 	$store = $this->Store_model->getDataById($user->store_users);
			
		// 	//getWarehouse
		// 	$warehouse = getWarehouse($store['kode_store']);
			
		// 	$this->db->where('GDGFG',$warehouse);
		// }

		//getWarehouse
		$warehouse = getWarehouse($this->session->store_id);
			
		$this->db->where('GDGFG',$warehouse);

		$crud->callback_column('CART',array($this,'buttonCart')); 
		$crud->callback_column('PRICE',array($this,'priceStok')); 
		$crud->callback_column('AKPCSFG',array($this,'totalStok')); 

		$output = $crud->render();
		$this->load->view('layout',$output);
	}

	public function buttonCart($value, $row)
	{
		//get id product
		$this->load->model('Product_model');
		$produk = $this->Product_model->getDataByCode($row->ARTFG);
		$productId = $produk['id_product'];
		return "<a href='".base_url('cart/add/'.$productId)."'><button class='btn btn-sm btn-success'><i class='fa fa-shopping-cart'></i></button></a>";
	}

	public function priceStok($value, $row)
	{
		//get id product
		$this->load->model('Product_model');
		$produk = $this->Product_model->getDataByCode($row->ARTFG);

		return $produk['price_product'];
	}

	public function totalStok($value, $row)
	{
		$total = 0;
		for ($i=26; $i <= 45 ; $i++) { 
			$xx = "AK".$i."FG";
			$total += $row->$xx;
		}
		return $total;
	}

	public function salesman()
	{
		$crud = new grocery_CRUD();

		//REQUIRED
		$config['pk'] = 'id_salesman';
		$config['display'] = array();
		$config['table'] = "ms_salesman";
		$this->default_config($crud,$config);
		$crud->columns(['code_salesman','name_salesman','phone_salesman','updated_at']);
		$output = $crud->render();
		$this->load->view('layout',$output);
	}

	public function password_callback($post_array){
		$post_array['password_users'] = md5($post_array['password_users']);
		return $post_array;
	}

	public function reset_password($id)
	{
		$save['password_users'] = md5('lois-123');
		$this->db->update('ms_users',$save,array('id_users'=>$id));
		redirect('');
		echo ("<script LANGUAGE='JavaScript'>
			window.alert('Password berhasil direset menjadi lois-123');
			window.location.href='".base_url('module/users')."';
			</script>");
	}
}
