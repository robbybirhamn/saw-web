# Memulai project dan menjalankannya
1. Buat database dengan nama "sekolah"  (Tanpa kutip)
2. Import database sekolah yang sudah di sediakan di folder db
3. Clone project menggunakan git :
```bash
$ git clone https://github.com/sutrisna/ci3-grocery-crud.git
```
4. Jalankan project, dengan buka cmd lalu arahkan path pada project
```bash
$ cd ci3-grocery-crud
$ php -S localhost:8080
```
5. Buka browser lalu ketik **http://localhost:8080/**

# Cara kedua
1. Buat Database dengan nama sekolah
2. Import database sekolah yang sudah di sediakan di folder db
3. Clone project menggunakan git :
```bash
$ git clone https://github.com/sutrisna/ci3-grocery-crud.git
```
4. Pindahkan project ke folder htdocs di xampp
5. Buka browser ketik **http://localhost/nama_project**

# Cara menambahkan tabel baru
1. Buat tabel dengan nama guru di database sekolah
2. Buka file Sekolah.php di folder controllers
3. Tambahkan code ini
```bash
public function guru()
	{
			$crud = new grocery_CRUD();

			$crud->set_table('guru');

			$output = $crud->render();

    		$this->load->view('wrapper/header',$output);
    		$this->load->view('sekolah/home', $output);
    		$this->load->view('wrapper/footer',$output);
            
	}
```
4. Buka browser, ketik **http://localhost/nama_project/sekolah/guru**

### Framework dan Library
[CodeIgniter 3](https://codeigniter.com/)
[Grocery CRUD](https://www.grocerycrud.com/)
[Materializecss](https://materializecss.com/)

### Sutrisna 1453
Jika tidak bisa sedekah dengan uang, maka bersedekahlah dengan ilmu pengetahuan


