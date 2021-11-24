<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Account_model extends CI_Model
{

    public function hapusDataAccount($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user');
    }

    public function cariDataUser()
    {
        $cari = $this->input->post('cari');
        $this->db->like('name',  $cari);
        $this->db->or_like('email',  $cari);
        return $this->db->get('user')->result_array();
    }

    // public function kelas()
    // {
    //     $querykelas = "SELECT u.id, k.nama, u.class FROM user u, kelas k 
    //                     WHERE k.id = u.kelas_id ORDER BY k.nama ASC";
    //     $data['user'] = $this->db->query($querykelas)->result_array();
    //     return $this->db->get('kelas')->result_array();
    // }
}