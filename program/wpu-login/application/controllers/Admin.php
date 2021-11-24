<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller

{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Berita_model');
        $this->load->model('Student_model');
    }

    // DASHBOARD ADMIN
    public function index()
    {
        $data['title'] = 'Dashboard';
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

        // Query menjumlahkan admin sistem
        $adminSistem = "SELECT * FROM user WHERE role_id = 3";
        $data['admin_sistem'] = $this->db->query($adminSistem)->result_array();

        // Query menjumlahkan admin pusdiklat
        $adminPusdiklat = "SELECT COUNT(user.name) FROM user WHERE role_id = 1";
        $data['admin_pusdiklat'] = $this->db->query($adminPusdiklat)->result_array();

        // Query menjumlahkan mentor pelatihan bahasa
        $mentor = "SELECT * FROM user WHERE role_id = 2";
        $data['mentor'] = $this->db->query($mentor)->result_array();

        // Query menjumlahkan peserta pelatihan
        $dtPeserta = "SELECT * FROM data_peserta";
        $data['dt_pst'] = $this->db->query($dtPeserta)->result_array();

        $this->load->view('templates/header', $data); //untuk memanggil file index setelah login dilakukan
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    // ========= JADWAL DAN KELAS ==========
    public function jadwalkelas()
    {
        $data['title'] = 'Jadwal & Kelas';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['mentor'] = $this->db->get_where('user', ['role_id' => 2])->result_array();

        $data['akun_user'] = $this->db->get_where(
            'user',
            ['email' => $this->session->userdata('email')]
        )->row_array();

        $data['kelas'] = $this->db->get('kelas')->result_array();

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

        $this->form_validation->set_rules('nama_kelas', 'Nama Kelas', 'required|is_unique[kelas.nama]', [
            'is_unique' => 'Nama kelas sudah ada!'
        ]);
        $this->form_validation->set_rules('nama_ruangan', 'Nama ruangan', 'required');
        $this->form_validation->set_rules('lokasi', 'Lokasi', 'required');
        $this->form_validation->set_rules('kuota', 'Kuota', 'required');
        $this->form_validation->set_rules('tanggal_ujian', 'Tanggal Ujian', 'required');
        $this->form_validation->set_rules('status_kelas', 'Status Kelas', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/jadwalkelas', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('kelas', [
                'nama' => $this->input->post('nama_kelas'),
                'ruangan' => $this->input->post('nama_ruangan'),
                'lokasi' => $this->input->post('lokasi'),
                'kuota' => $this->input->post('kuota'),
                'sisa_kuota' => $this->input->post('kuota'),
                'tanggal' => $this->input->post('tanggal_ujian'),
                'status' => $this->input->post('status_kelas')

            ]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Kelas berhasil ditambahan ! </div>');
            redirect('admin/jadwalkelas');
        }
    }

    public function hapus_kelas($id)
    {
        $this->load->model('Admin_model');
        $where = ['id' => $id];
        $this->Admin_model->hapus_kelas($where, 'kelas');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
					Kelas berhasil dihapus !
					  </div>');
        redirect('admin/jadwalkelas');
    }

    public function edit_kelas()
    {
        $id = $this->input->post('id');
        $nama_kelas = $this->input->post('nama_kelas');
        $tanggal_ujian = $this->input->post('tanggal_ujian');
        $kuota = $this->input->post('kuota');
        $sisa_kuota = $this->input->post('sisa_kuota');
        $status_kelas = $this->input->post('status_kelas');
        $mentor = $this->input->post('mentor');

        $data = [
            'nama' => $nama_kelas,
            'tanggal' => $tanggal_ujian,
            'kuota' => $kuota,
            'sisa_kuota' => $sisa_kuota,
            'status' => $status_kelas,
            'user_id' => $mentor
        ];

        $this->db->where('id', $id);
        $update = $this->db->update('kelas', $data);

        if ($update) :
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Kelas berhasil diedit </div>');
        endif;

        redirect('admin/jadwalkelas');
    }

    // ========== REKAP / LAPORAN ADMIN ===========
    public function rekapadmin()
    {
        $data['title'] = 'Rekap Admin';
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
        $queryRekapAdmin = "SELECT k.id, k.nama, k.tanggal, COUNT(b.pertemuan) as pertemuan
                            FROM kelas k, user u, berita_acara b
                            WHERE k.id = b.id_kelas
                            AND u.id = k.user_id
                            AND k.id = b.id_kelas 
                            GROUP BY k.id ASC";
        $data['kelas'] = $this->db->query($queryRekapAdmin)->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/rekapadmin', $data);
        $this->load->view('templates/footer');
    }

    public function detailRekapAdmin($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = "Rekap Admin";
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
        // Batas notifikasi

        $queryDetailAdmin = "SELECT * FROM berita_acara 
                             WHERE id_kelas=$id 
                             AND pertemuan='Pertemuan Ke  1'";

        $aa = "SELECT dp.`nama_peserta`, hp.`keterangan`
               FROM `data_peserta` dp, `history_peserta` hp, berita_acara ba
               WHERE dp.`id`=hp.`id_peserta`
               AND ba.id_beritaacara = hp.id_berita
               AND ba.id_kelas=$id
               AND ba.pertemuan='Pertemuan Ke  1'";

        $data['peserta1'] = $this->db->query($queryDetailAdmin)->result_array();
        $data['peserta2'] = $this->db->query($aa)->result_array();
        // akhir

        //menampilkan pertemuan pada dropdown
        $id_mentor = $data['user']['id'];
        $aa = "SELECT pertemuan, id_kelas FROM berita_acara 
               WHERE berita_acara.id_kelas = $id";

        $data['pertemuan'] = $this->db->query($aa)->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/detailrekapadmin', $data);
        $this->load->view('templates/footer');
    }

    // dari detail rekap mentor
    function detail_rekapadmin()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = "Rekap Admin";

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

        $per = $this->input->post('pertemuann');
        $id_kelas = $this->input->post('id_kelas');
        $this->session->set_flashdata('pert', $per);

        //menampilkan pertemuan pada dropdown
        $id_mentor = $data['user']['id'];
        $aa = "SELECT pertemuan, id_kelas FROM berita_acara WHERE berita_acara.id_kelas = $id_kelas";
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
        $this->load->view('admin/detailrekapadmin', $data);
        $this->load->view('templates/footer');
    }

    public function print()
    {

        $queryDetailAdmin = " SELECT kelas.id, kelas.nama, data_peserta.no_identitas, data_peserta.nama_peserta, data_peserta.email, data_peserta.nama_instansi, data_peserta.hp, data_peserta.email, user.name, pelatihan_kat.nama_pelatihan, data_peserta.presensi
        FROM data_peserta 
        JOIN kelas ON kelas.id = data_peserta.kelas_id
        JOIN pelatihan_kat ON pelatihan_kat.id = data_peserta.id_pelatihan
        JOIN USER ON user.id = data_peserta.user_id
        WHERE user.id";

        $data['peserta'] = $this->db->query($queryDetailAdmin)->result_array();
        $this->load->view('admin/print_rekapadmin', $data);
    }

    // ========= BAGIAN PENGATURAN ADMIN ============
    public function pengaturan()
    {
        $data['title'] = 'Pengaturan';
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

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');
        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/pengaturan', $data);
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');

            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');

            // Bagian ubah password
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Wrong current password!</div>');
                redirect('user/changepassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    New password cannot be the same as current password!</div>');
                    redirect('user/changepassword');
                } else {
                    // Password yang sudah benar OK
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');
                }
            }

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

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has been updated!</div>');
            redirect('admin');
        }
    }

    // =========== BAGIAN PESERTA ===========
    public function peserta()
    {
        $data['title'] = 'Peserta';
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

        // PAGINATION
        // $this->load->model('Student_model', 'stdn');
        // $this->load->library('pagination');
        // $config['base_url'] = 'http://localhost/wpu-login/admin/peserta';
        // $config['total_rows'] = $this->Student_model->countAllStudent();
        // $config['per_page'] = 3;

        // $this->pagination->initialize($config);

        // $data['start'] = $this->uri->segment(3);
        // $data['dt_pst'] = $this->Student_model->getStudent($config['per_page'], $data['start']);
        // batas PAGINATION

        $queryPeserta = "SELECT ds.*, k.nama, f.alias
                            FROM data_peserta ds, kelas k, fakultas f
                            WHERE k.id = ds.kelas_id 
                            AND f.id = ds.id_fakultas
                            ORDER BY ds.kelas_id ASC";

        $data['peserta'] = $this->db->query($queryPeserta)->result_array();

        // Search
        // $this->load->model('Student_model');
        // $keyword = $this->input->post($queryPeserta);
        // $data['peserta'] = $this->Student_model->get_keyword($keyword);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/peserta', $data);
        $this->load->view('templates/footer');
    }

    public function deletePeserta($id = null)
    {
        $this->db->where('id', $id);
        $delete = $this->db->delete('data_peserta');

        if ($delete) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Peserta berhasil dihapus  </div>');
            redirect('akun/peserta');
        }
    }

    public function editpeserta($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Peserta';

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

        $queryPeserta = "SELECT ds.*, k.nama FROM data_peserta ds, kelas k
                        WHERE k.id = ds.kelas_id
                        AND ds.id = $id";

        $data['data_peserta'] = $this->db->query($queryPeserta)->row_array();
        $data['kelas'] = $this->db->get('kelas')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/editpeserta', $data);
        $this->load->view('templates/footer');
    }

    public function proseseditpeserta()
    {
        $id = $this->input->post('id');
        $no_identitas = $this->input->post('no_identitas');
        $nama_peserta = $this->input->post('nama_peserta');
        $tgl_lahir = $this->input->post('tgl_lahir');
        $jenis_kelamin = $this->input->post('jenis_kelamin');
        $prodi = $this->input->post('prodi');
        $nama_instansi = $this->input->post('nama_instansi');
        $kelas_id = $this->input->post('kelas_id');

        $data = [
            'no_identitas' => $no_identitas,
            'nama_peserta' => $nama_peserta,
            'tgl_lahir' => $tgl_lahir,
            'jenis_kelamin' => $jenis_kelamin,
            'prodi' => $prodi,
            'nama_instansi' => $nama_instansi,
            'kelas_id' => $kelas_id
        ];

        $this->db->where('id', $id);
        $edit = $this->db->update('data_peserta', $data);

        if ($edit) :
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Peserta berhasil diedit </div>');
            redirect('admin/peserta');
        endif;
    }

    public function searchPst($keyword = null)
    {
        $data['title'] = 'Peserta';
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


        $this->load->model('Student_model');
        $keyword = $this->input->post('keyword');
        $data['peserta'] = $this->Student_model->get_keyword($keyword);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/peserta', $data);
        $this->load->view('templates/footer');
    }
}