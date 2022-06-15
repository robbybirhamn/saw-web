<?php 
class User_model  extends CI_Model  {
    public function getActive()
    {
        $id = $this->session->user_logged->salesman_users;
        $data = $this->db->query("SELECT * from ms_salesman WHERE id_salesman='$id'")->row_array();
        return $data;
    }
}
?>