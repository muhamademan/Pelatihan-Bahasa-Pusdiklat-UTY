<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller

{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }


    public function index()
    {

        $data['title'] = 'Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $queryRole = "SELECT r.role FROM user_role r, user u
                      WHERE r.id = u.role_id";
        $data['role'] = $this->db->query($queryRole)->result_array();
        $this->load->view('templates/header', $data); //untuk memanggil file index setelah login dilakukan
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    // ============ EDIT PROFILE ===========
    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');

            // cek jika ada gambar yang akan di upload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '2048';
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.png') {
                        unlink(FCPATH . 'assets/img/profile/.' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('name', $name);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Your profile has been updated!</div>');
            redirect('user');
        }
    }

    // ========= UBAH PASSWORD PELATIHAN =============
    public function changePassword()
    {
        $data['title'] = 'Change Password';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data); //untuk memanggil file index setelah login dilakukan
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/changepassword', $data);
            $this->load->view('templates/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');

            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong current password!</div>');
                redirect('user/changepassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New password cannot be the same as current password!</div>');
                    redirect('user/changepassword');
                } else {
                    // Password yang sudah benar OK
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password Change!</div>');
                    redirect('user/changepassword');
                }
            }
        }
    }

    // ========== JADWAL PRESENSI PELATIHAN BAHASA ==============
    public function jadwalpresensi()
    {
        $data['title'] = 'Jadwal & Presensi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/jadwalpresensi', $data);
        $this->load->view('templates/footer');
    }

    // ============ REKAP / LAPORAN MENTOR ===========
    public function rekapmentor()
    {
        $data['title'] = 'Rekap Mentor';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $email = $data['user']['email'];
        $queryRekapMentor = "SELECT k.id, k.nama, k.tanggal, COUNT(b.pertemuan) AS pertemuan
                             FROM kelas k, USER u, berita_acara b
                             WHERE k.id = b.id_kelas
                             AND u.id = k.user_id
                             AND u.email = '$email'
                             GROUP BY k.id ASC";
        $data['kelas'] = $this->db->query($queryRekapMentor)->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/rekapmentor', $data);
        $this->load->view('templates/footer');
    }

    // dari rekap mentor
    public function detailRekapMentor($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = "Rekap Mentor";

        $queryDetailMentor = "SELECT * FROM berita_acara WHERE id_kelas=$id AND pertemuan='Pertemuan Ke  1'";
        $historyPst = "SELECT dp.`nama_peserta`, hp.`keterangan`
                       FROM `data_peserta` dp, `history_peserta` hp, berita_acara ba
                       WHERE dp.`id`=hp.`id_peserta`
                       AND ba.id_beritaacara = hp.id_berita
                       AND ba.id_kelas=$id
                       AND ba.pertemuan='Pertemuan Ke  1'";

        $data['peserta1'] = $this->db->query($queryDetailMentor)->result_array();
        $data['peserta2'] = $this->db->query($historyPst)->result_array();

        //menampilkan pertemuan pada dropdown
        $id_mentor = $data['user']['id'];
        $aa = "SELECT pertemuan, id_kelas 
               FROM berita_acara 
               WHERE berita_acara.id_user = '$id_mentor' 
               AND id_kelas= $id";
        $data['pertemuan'] = $this->db->query($aa)->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/detailrekapmentor', $data);
        $this->load->view('templates/footer');
    }

    // dari detail rekap mentor
    function detail_rekapmentor()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = "Rekap Mentor";

        $per = $this->input->post('pertemuann');
        $id_kelas = $this->input->post('id_kelas');
        $this->session->set_flashdata('pert', $per);

        //menampilkan pertemuan pada dropdown
        $id_mentor = $data['user']['id'];
        $aa = "SELECT pertemuan, id_kelas  FROM berita_acara WHERE berita_acara.id_user = '$id_mentor' AND id_kelas= $id_kelas";
        $data['pertemuan'] = $this->db->query($aa)->result_array();

        $q1 = "SELECT * FROM berita_acara WHERE id_kelas=$id_kelas and pertemuan='$per'";
        $q2 = "SELECT dp.`nama_peserta`, hp.`keterangan`
        FROM `data_peserta` dp, `history_peserta` hp, berita_acara ba
        WHERE dp.`id`=hp.`id_peserta`
        AND ba.id_beritaacara = hp.id_berita
        AND ba.id_kelas=$id_kelas
        AND ba.pertemuan='$per'";

        $data['peserta1'] = $this->db->query($q1)->result_array();
        $data['peserta2'] = $this->db->query($q2)->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/detailrekapmentor', $data);
        $this->load->view('templates/footer');
    }
}