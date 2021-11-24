<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reset_pass extends CI_Controller

{
    public function index()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Lupa Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/resetPassword');
            $this->load->view('templates/auth_footer');
        }
    }

    public function updatePass()
    {
        $email = $this->input->post('email');
        $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        $this->db->set('password', $password);
        $this->db->where('email', $email);
        $q1 = $this->db->update('user');

        if ($q1) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Password <b>berhasil</b> diubah, silahkan keluar dahulu!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Password gagal</b> diubah!</div>');
        }
        redirect('reset_pass');
    }
}