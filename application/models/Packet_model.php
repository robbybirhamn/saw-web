<?php 
class Packet_model  extends CI_Model  {
    public function getData($opt=null)
    {
        if($opt['limit'] != null)
        {
            $limit = "LIMIT ".$opt['limit'];
        }else{
            $limit = "";
        }
        $data = $this->db->query("SELECT * from tb_packet $limit")->result_array();
        return $data;
    }

    public function insert($data)
    {
        $this->db->insert('tb_packet',$data);
        push_log('Menambah data gudang',serialize($data));

        return "berhasil";
    }

    public function getDataById($id)
    {
        $data = $this->db->query("SELECT * from tb_packet WHERE id='$id'")->row_array();
        return $data;
    }

    public function update($id,$data)
    {
        $this->db->update('tb_packet',$data,array('id'=>$id));
        push_log('Memperbarui data gudang',serialize($data));

        return "berhasil";
    }
    
    public function delete($id)
    {
        $this->db->delete('tb_packet',array('id'=>$id));
        push_log('Menghapus data gudang',serialize($id));

        return "berhasil";
    }
}
?>