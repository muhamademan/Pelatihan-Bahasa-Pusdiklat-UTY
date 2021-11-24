<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absen_model extends CI_Model
{
    public function data_absen($data)
    {
        $data = $this->session->userdata['email']; // dapatkan id user yg login

        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('kelas', 'kelas.id = kelas.user_id', 'left');
        $this->db->join('data_peserta', 'data_peserta.id = data_peserta.user_id', 'left');
        $this->db->where('kelas.id', $data);
        $this->db->order_by('kelas.id', 'asc');
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
}