<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {
    public function index()
    {
        $this->load->view('auth/login');
    }

    public function proses()
    {
        $post = $this->input->post();
        
        // cari user berdasarkan email dan username
        $this->db->where('username_users', $post["username"])
                ->where('password_users', md5($post["password"]));
        $user = $this->db->get('ms_users')->row();

        // jika user terdaftar
        if($user != NULL){
            push_log($post["username"]. 'Berhasil masuk sistem',serialize($user));
            // periksa password-nya
            $this->session->set_userdata(['user_logged' => $user]);
            echo ("<script LANGUAGE='JavaScript'>
                window.alert('Login berhasil');
                window.location.href='".base_url('main')."';
                </script>");
        }else{
            push_log($post["username"]. 'Gagal masuk sistem','');

            echo ("<script LANGUAGE='JavaScript'>
                window.alert('Login gagal!');
                window.location.href='".base_url('auth')."';
                </script>");
        }
    }

    public function logout()
    {
        $user = $this->session->user_logged;
        push_log($user->username_users.' berhasil keluar sistem','');

        $this->session->sess_destroy();
        echo ("<script LANGUAGE='JavaScript'>
                window.alert('Logout Berhasil');
                window.location.href='".base_url('auth')."';
                </script>");
    }

    
}
