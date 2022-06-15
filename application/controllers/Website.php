<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Website extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');
		$this->load->library('grocery_CRUD');
		isLogin();
	}

    public function index()
    {
		$this->load->model('Banner_model');
		$this->load->model('Packet_model');
		$set['banners'] = $this->Banner_model->getAll();

		$opt_packet['limit'] = 4;
		$set['packets'] = $this->Packet_model->getData($opt_packet);
		$set['output'] = array('pages/home');
        $this->load->view('layout_website',$set);
    }
}
