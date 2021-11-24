<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller

{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        if ($this->session->userdata('email')) { // agar user keluar lewat button logout
            redirect('user');
        }

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Page';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            // Ketika vaidasinya lolos/sukses
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();
        if ($user) {
            if ($user['is_active'] == 1) {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('admin');
                    } elseif ($user['role_id'] == 3) {
                        redirect('superadmin');
                    } else {
                        redirect('user');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Wrong password! </div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                This email has not been activated! </div>');
                redirect('auth');
            }
        } else {
            // Tidak ada user dengan email itu
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Email is not registered! </div>');
            redirect('auth');
        }
    }

    public function lupa_password()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This email has alredy registered!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[4]|matches[password2]', [
            'matches' => 'Password dont match!',
            'min_length' => 'Password 4 character!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'User Registration';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/lupa_password');
            $this->load->view('templates/auth_footer');
        } else {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.png',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 3,
                'is_active' => 1,
                'date_created' => time()
            ];

            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Congratulation! your account has been created</div>');
            redirect('auth');
        }
    }

    // Reset Password
    public function indexreset()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Lupa Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/lupa_password');
            $this->load->view('templates/auth_footer');
        } else {
            // Ketika vaidasinya lolos/sukses
            $this->resetPassword();
        }
    }

    public function resetPassword()
    {
        $email = $this->input->post('email');
        $QueryEmail = "SELECT id FROM `user` WHERE email = '$email'";
        $var = $user['Email'] = $this->db->query($QueryEmail)->result_array();

        if ($var == null) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                        Email tidak terdaftar!</div>');
            redirect('auth/indexreset');
        } else {
            $data = [
                'email' => $this->input->post('email'),
            ];
            $cek = $this->session->set_userdata($data);
            redirect('reset_pass');
        }
    }

    // Bagian Profile
    public function profile()
    {

        $data['title'] = 'Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // notifikasi
        $date_now = date('Y-m-d');
        $date1 = date('Y-m-d', strtotime('-1 days', strtotime($date_now)));

        $q1 = "SELECT * FROM `kelas` WHERE sisa_kuota > 10 
                AND tanggal >= '$date1'
                AND tanggal <= '$date_now'";

        $q2 = "SELECT count('nama') as jumlah FROM `kelas`
                WHERE sisa_kuota > 10 
                AND tanggal > '$date1' 
                AND tanggal <= '$date_now'";

        $data['nama'] = $this->db->query($q1)->result_array();
        $data['jumlah'] = $this->db->query($q2)->result_array();
        //Batas notifikasi

        $this->load->view('templates/header', $data); //untuk memanggil file index setelah login dilakukan
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    // Bagian Logout
    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');


        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        You have been logged out!</div>');
        redirect('auth');
    }

    // Blok access
    public function blocked()
    {
        $this->load->view('auth/blocked');
    }
}