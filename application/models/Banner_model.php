<?php 
class Banner_model  extends CI_Model  {
    public function getAll()
    {
        $data = $this->db->query("SELECT * from ms_banner")->result_array();
        return $data;
    }

    public function insert($data)
    {
        $this->db->insert('ms_banner',$data);
        push_log('Menambah data gudang',serialize($data));

        return "berhasil";
    }

    public function getDataById($id)
    {
        $data = $this->db->query("SELECT * from ms_banner WHERE id='$id'")->row_array();
        return $data;
    }

    public function update($id,$data)
    {
        $this->db->update('ms_banner',$data,array('id'=>$id));
        push_log('Memperbarui data gudang',serialize($data));

        return "berhasil";
    }
    
    public function delete($id)
    {
        $this->db->delete('ms_banner',array('id'=>$id));
        push_log('Menghapus data gudang',serialize($id));

        return "berhasil";
    }
}
?>