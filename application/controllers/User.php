<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
    public function index()
    {
        $set['message'] = "";
        $set['output'] = array('module/user/change_password');
        $this->load->view('layout',$set);
    }

    public function change_password()
    {
        $post = $this->input->post();
        $auth = $this->session->userdata;
        $id = $auth['user_logged']->id_users;
        
        $set['message'] = "";

        $data = $this->db->query("SELECT * from ms_users WHERE id_users='$id'")->row_array();

        //cek password lama
        if($data['password_users'] != md5($post['old_password']))
        {
            $set['message'] .= "password lama tidak sama <br>";
        }elseif(md5($post['new_password']) != md5($post['confirm_password']))
        {
            $set['message'] .= "konfirmasi password tidak sama";
        }else{
            $set['message'] = "Password berhasil dirubah";
            $this->db->update('ms_users',array('password_users'=>md5($post['new_password'])),array('id_users'=>$id));
        }

        $set['output'] = array('module/user/change_password');
        $this->load->view('layout',$set);
    }
}