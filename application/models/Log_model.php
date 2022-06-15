<?php 
class Log_model  extends CI_Model  {
    public function insert($type,$file)
    {
        $insert['id_log'] = $this->uuid->v4();
        $insert['type_log'] = $type;
        $insert['date_log'] = date('Y-m-d H:i:s');
        $insert['source_log'] = $file;
        $this->db->insert('tb_log',$insert);
        return "berhasil";
    }

    public function log($desc,$log)
    {
        $user = $this->session->user_logged;
        if($user != NULL)
        {
            $who = $user->username_users;
        }else{
            $who = "belum login";
        }
        $insert['description'] = $desc;
        $insert['log'] = $log;
        $insert['user'] = $who;
        $this->db->insert('logs',$insert);
        return "berhasil";
    }
}
?>