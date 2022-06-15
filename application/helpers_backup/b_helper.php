<?php 
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

function getWarehouse($store)
{
    if(substr($store,0,2) == "TC")
    {
        $gudang = "40";
    }else{
        $gudang = "07";
    }
    return $gudang;    
}

?>