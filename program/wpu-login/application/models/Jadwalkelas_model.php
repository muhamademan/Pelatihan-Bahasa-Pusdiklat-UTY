<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwalkelas_model extends CI_Model

{
    public function hapusJadwalKelas($id)
    {
        // return $this->db->get('data_peserta')->result_array();
        $this->db->where('id', $id);
        $this->db->delete('kelas');
    }

    public function cariJadwalKelas()
    {
        $cari = $this->input->post('cari');
        $this->db->like('nama',  $cari);
        $this->db->or_like('tanggal',  $cari);
        return $this->db->get('kelas')->result_array();
    }

    // public function tambahmentor()
    // {
    //     $querymentor = "SELECT u.id, k.nama, u.class FROM user u, kelas k 
    //                     WHERE k.id = u.kelas_id ORDER BY k.nama ASC";
    //     $data['user'] = $this->db->query($querymentor)->result_array();
    //     return $this->db->get('user')->result_array();
    // }
    // public function jum_peserta($id)
    // {
    //     $query = "SELECT COUNT(kelas_id) as total_peserta FROM `data_peserta` WHERE `user_id` = $id;";
    //     return $this->db->query($query)->result_array();
    // }

    // public function cek_kuota($id)
    // {
    //     $query = "SELECT nama,kuota FROM `kelas` WHERE `user_id` = $id;";
    //     return $this->db->query($query)->result_array();
    // }
}