<?php 

class Pelanggan_model extends CI_Model {
    public function getPelanggan($id = null) {
        if($id === null){

            return $this->db->get('pelanggan')->result_array();
        } else {
            return $this->db->get_where('pelanggan', ['id_pelanggan' => $id])->result_array();
        }
    }

    public function deletePelanggan ($id){
        $this->db->delete('pelanggan', ['id_pelanggan'=>$id]);
        return $this->db->affected_rows();
    }

    public function createPelanggan($data){
        $this->db->insert('pelanggan',$data);
        return $this->db->affected_rows();
    }

    public function updatePelanggan($data,$id){
        $this->db->update('pelanggan',$data, ['id_pelanggan' => $id]);
        return $this->db->affected_rows();
    }
}