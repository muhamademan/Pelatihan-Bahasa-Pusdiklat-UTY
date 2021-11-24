<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelatihan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    // =========== BAGIAN SPESIFIKASI ===============
    public function spesifikasi()
    {
        $data['title'] = 'Spesifikasi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $query = "SELECT sp.id, sk.alias, sp.spesifikasi FROM spesifikasi sp, pelatihan_kat sk
                    WHERE sk.id = sp.id_pelatihan";
        $data['spesifikasi'] = $this->db->query($query)->result_array();
        $data['pelatihan'] = $this->db->get('pelatihan_kat')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kelola_pelatihan/spesifikasi', $data);
        $this->load->view('templates/footer');
    }

    public function editspesifikasi($id = null)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Spesifikasi';

        $data['pelatihan'] = $this->db->get('pelatihan_kat')->result_array();
        $this->db->where('id', $id);
        $data['spesifikasi'] = $this->db->get('spesifikasi')->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kelola_pelatihan/editspesifikasi', $data);
        $this->load->view('templates/footer');
    }

    public function proseseditspesifikasi()
    {
        $id = $this->input->post('id');
        $id_pelatihan = $this->input->post('id_pelatihan');
        $spesifikasi = $this->input->post('spesifikasi');

        $data = [
            'id' => $id,
            'id_pelatihan' => $id_pelatihan,
            'spesifikasi' => $spesifikasi
        ];

        $this->db->where('id', $id);
        $edit = $this->db->update('spesifikasi', $data);

        if ($edit) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Spesifikasi berhasil diedit </div>');
            redirect('pelatihan/spesifikasi');
        }
    }

    public function addspesifikasi()
    {
        $id_pelatihan = $this->input->post('id_pelatihan');
        $spesifikasi = $this->input->post('spesifikasi');

        $data = [
            'id_pelatihan' => $id_pelatihan,
            'spesifikasi' => $spesifikasi
        ];

        $pelatihan = $this->db->insert('spesifikasi', $data);

        if ($pelatihan) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Spesifikasi berhasil ditambahkan </div>');
            redirect('pelatihan/spesifikasi');
        };
    }

    public function deletespesifikasi($id = null)
    {
        $this->db->where('id', $id);
        $spesifikasi = $this->db->delete('spesifikasi');

        if ($spesifikasi) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Spesifikasi berhasil dihapus </div>');
            redirect('pelatihan/spesifikasi');
        }
    }


    // ============ BAGIAN PELATIHAN ==============
    public function latih()
    {
        $data['title'] = 'Pelatihan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['pelatihan'] = $this->db->get('pelatihan_kat')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kelola_pelatihan/pelatihan', $data);
        $this->load->view('templates/footer');
    }

    public function editpelatihan($id = null)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Pelatihan';

        $this->db->where('id', $id);
        $data['pelatihan'] = $this->db->get('pelatihan_kat')->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kelola_pelatihan/editpelatihan', $data);
        $this->load->view('templates/footer');
    }

    public function proseseditpelatihan()
    {
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $alias = $this->input->post('alias');
        // $nilai = $this->input->post('nilai');

        $data = [
            'nama_pelatihan' => $nama,
            'alias' => $alias
        ];

        $this->db->where('id', $id);
        $edit = $this->db->update('pelatihan_kat', $data);

        if ($edit) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            pelatihan berhasil diedit </div>');
            redirect('pelatihan/latih');
        }
    }

    public function addpelatihan()
    {
        $nama = $this->input->post('nama');
        $ket = $this->input->post('ket');

        $data = [
            'nama_pelatihan' => $nama,
            'alias' => $ket
        ];

        $pelatihan = $this->db->insert('pelatihan_kat', $data);

        if ($pelatihan) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Pelatihan berhasil ditambahkan </div>');
            redirect('pelatihan/latih');
        };
    }

    public function deletepelatihan($id = null)
    {
        $this->db->where('id', $id);
        $submenu = $this->db->delete('pelatihan_kat');

        if ($submenu) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Pelatihan berhasil dihapus </div>');
            redirect('pelatihan/latih');
        }
    }
}