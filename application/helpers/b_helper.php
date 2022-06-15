<?php

use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

function isLogin()
{
    $ci = get_instance();

    if($ci->session->user_logged == NULL)
    {
        redirect(base_url('auth'));
    }
}

function getLevel()
{
    $ci = get_instance();
    $data = $ci->session->user_logged;
    $id = $data->id_users;
    $ci->db->where('id_users',$id);
    $ci->db->join('ms_usergroup','id_usergroup = usergroup_users');
    $data = $ci->db->get('ms_users')->row_array();
    return $data['code_usergroup'];
}

function getLevelName()
{
    $ci = get_instance();
    $data = $ci->session->user_logged;
    $id = $data->id_users;
    $ci->db->where('id_users',$id);
    $ci->db->join('ms_usergroup','id_usergroup = usergroup_users');
    $data = $ci->db->get('ms_users')->row_array();
    return $data['name_usergroup'];
}

function getWarehouse($store)
{
   /* if(substr($store,0,2) == "TC")
    {
        $gudang = "40";
    }else{
        $gudang = "07";
    }*/
	$gudang ="71";
    return $gudang;    
}

function checkStore()
{
    $ci = get_instance();
    if($ci->session->store_id == NULL)
    {
        echo ("<script LANGUAGE='JavaScript'>
            window.alert('PASTIKAN ANDA MEMILIH TOKO!');
            window.location.href='".base_url()."';
            </script>");
    }
}

function checkStatus()
{
    $ci = get_instance();
    $ci->load->model('Option_model');
    $status = $ci->Option_model->getStatus();
    if($status == "0")
    {
        echo ("<script LANGUAGE='JavaScript'>
            window.alert('SISTEM SEDANG DITUTUP!');
            window.location.href='".base_url()."';
            </script>");
    }
}

function get_login()
{
    $ci = get_instance();   
    return $ci->session->user_logged->username_users ?? NULL;
}

function push_log($desc,$log)
{
    $ci = get_instance();   
    $ci->load->model('Log_model');
    return $ci->Log_model->log($desc,$log);
}

function get_id_login()
{
    $ci = get_instance();   
    return $ci->session->user_logged->id_users ?? NULL;
}

function rupiah_format($val)
{
    return number_format($val,"0","0",".");
}

function b_reference($value,$kode)
{
    switch ($kode) {
        case 'TRX':
            $data = array(
                'W' => 'Waiting',
                'S' => 'Process',
                'I' => 'Invoicing',
                'D' => 'Delivery',
                'P' => 'Posted',
            );
            return $data[$value] ?? "";
            break;
        
        default:
            return null;
            break;
    }
}

?>