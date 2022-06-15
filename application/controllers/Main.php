<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

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
		$set['output'] = array('module/home');
        $this->load->view('layout',$set);
    }
}
