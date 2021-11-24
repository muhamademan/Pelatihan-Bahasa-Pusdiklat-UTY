<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Student_model extends CI_Model

{
    public function hapusDataStudent($noidentitas)
    {
        // return $this->db->get('data_peserta')->result_array();
        $this->db->where('no_identitas', $noidentitas);
        $this->db->delete('data_peserta');
    }

    // public function get_all()
    // {
    //     return $this->db->get('data_peserta')->result();
    // }

    public function get_keyword($keyword)
    {
        // $keyword = $this->input->post('keyword');
        $this->db->select('*');
        $this->db->from('data_peserta ds');
        $this->db->like('no_identitas', $keyword);
        $this->db->or_like('nama_peserta', $keyword);
        $this->db->join('kelas k', 'k.id = ds.kelas_id');
        // $this->db->or_like('k.nama');
        $this->db->join('fakultas f', 'f.id = ds.id_fakultas');
        // $this->db->or_like('f.alias');
        return $this->db->get()->result_array();
    }

    public function getStudent($limit, $start)
    {
        return $this->db->get('data_peserta', $limit, $start)->result_array();
    }

    public function countAllStudent()
    {
        return $this->db->get('data_peserta')->num_rows();
    }
}