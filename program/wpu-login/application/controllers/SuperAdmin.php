<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SuperAdmin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // Query menjumlahkan admin sistem
        $adminSistem = "SELECT * FROM user WHERE role_id = 3";
        $data['admin_sistem'] = $this->db->query($adminSistem)->result_array();

        // Query menjumlahkan admin pusdiklat
        $adminPusdiklat = "SELECT COUNT(user.name) FROM user WHERE role_id = 1";
        $data['admin_pusdiklat'] = $this->db->query($adminPusdiklat)->result_array();

        // Query menjumlahkan mentor pelatihan bahasa
        $mentor = "SELECT * FROM user WHERE role_id = 2";
        $data['mentor'] = $this->db->query($mentor)->result_array();

        $this->load->view('templates/header', $data); //untuk memanggil file index setelah login dilakukan
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kelola_web/index', $data);
        $this->load->view('templates/footer');
    }

    // BAGIAN FAKULTAS
    public function fakultas()
    {
        $data['title'] = 'Fakultas';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['fakultas'] = $this->db->get('fakultas')->result_array();
        $this->load->view('templates/header', $data); //untuk memanggil file index setelah login dilakukan
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kelola_web/fakultas', $data);
        $this->load->view('templates/footer');
    }

    public function addfakultas()
    {
        $nama = $this->input->post('nama');
        $alias = $this->input->post('alias');

        $data = [
            'nama' => $nama,
            'alias' => $alias
        ];


        $input = $this->db->insert('fakultas', $data);

        if ($input) :
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Tambah fakultas berhasil  </div>');
            redirect('superadmin/fakultas');
        endif;
    }

    public function editfakultas($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Fakultas';

        $data['fakultas'] = $this->db->get_where('fakultas', ['id' => $id])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kelola_web/editfakultas', $data);
        $this->load->view('templates/footer');
    }

    public function proseseditfakultas()
    {
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $alias = $this->input->post('alias');

        $data = [
            'nama' => $nama,
            'alias' => $alias
        ];

        $this->db->where('id', $id);
        $edit = $this->db->update('fakultas', $data);

        if ($edit) :
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Ubah fakultas berhasil  </div>');
            redirect('superadmin/fakultas');
        endif;
    }

    public function deletefakultas($id)
    {

        $this->db->where('id', $id);
        $delete = $this->db->delete('fakultas');

        if ($delete) :
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Delete fakultas berhasil  </div>');
            redirect('superadmin/fakultas');
        endif;
    }

    // BAGIAN INSTITUSI
    public function institusi()
    {
        $data['title'] = 'Institusi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['institusi'] = $this->db->get('institusi')->result_array();
        $this->load->view('templates/header', $data); //untuk memanggil file index setelah login dilakukan
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kelola_web/institusi', $data);
        $this->load->view('templates/footer');
    }

    public function addinstitusi()
    {
        $nama = $this->input->post('nama');

        $add = $this->db->insert('institusi', ['nama' => $nama]);

        if ($add) :
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Tambah institusi berhasil  </div>');
            redirect('superadmin/institusi');
        endif;
    }

    public function deleteinstitusi($id)
    {
        $this->db->where('id', $id);
        $delete = $this->db->delete('institusi');

        if ($delete) :
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Delete institusi berhasil  </div>');
            redirect('superadmin/institusi');
        endif;
    }

    public function editinstitusi($id = null)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Institusi';

        $data['fakultas'] = $this->db->get('fakultas')->result_array();
        $queryInstitusi = "SELECT * from institusi i WHERE i.id = $id";
        $data['institusi'] = $this->db->query($queryInstitusi)->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kelola_web/editinstitusi', $data);
        $this->load->view('templates/footer');
    }

    public function proseseditinstitusi()
    {
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');

        $this->db->where('id', $id);
        $edit = $this->db->update('institusi', ['nama' => $nama]);

        if ($edit) :
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Edit institusi berhasil  </div>');
            redirect('superadmin/institusi');
        endif;
    }

    // BAGIAN PRODI
    public function prodi()
    {
        $data['title'] = 'Program Studi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['fakultas'] = $this->db->get('fakultas')->result_array();
        $queryProdi = "SELECT p.*,f.alias from prodi p, fakultas f
                        WHERE f.id = p.id_fakultas
                        ORDER BY p.id_fakultas ASC";
        $data['prodi'] = $this->db->query($queryProdi)->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kelola_web/prodi', $data);
        $this->load->view('templates/footer');
    }

    public function addprodi()
    {
        $nama = $this->input->post('nama');
        $akreditas = $this->input->post('akreditas');
        $id_fakultas = $this->input->post('id_fakultas');

        $data = [
            'id_fakultas' => $id_fakultas,
            'nama' => $nama,
            'akreditas' => $akreditas
        ];

        $input = $this->db->insert('prodi', $data);

        if ($input) :
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Tambah prodi berhasil  </div>');
            redirect('superadmin/prodi');
        endif;
    }

    public function editprodi($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Program Studi';

        $data['fakultas'] = $this->db->get('fakultas')->result_array();
        $queryProdi = "SELECT p.*,f.alias from prodi p, fakultas f
                        WHERE f.id = p.id_fakultas
                        AND p.id = $id";
        $data['prodi'] = $this->db->query($queryProdi)->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kelola_web/editprodi', $data);
        $this->load->view('templates/footer');
    }

    public function proseseditprodi()
    {
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $akreditas = $this->input->post('akreditas');
        $id_fakultas = $this->input->post('id_fakultas');

        $data = [
            'nama' => $nama,
            'akreditas' => $akreditas,
            'id_fakultas' => $id_fakultas
        ];

        $this->db->where('id', $id);
        $edit = $this->db->update('prodi', $data);

        if ($edit) :
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Edit prodi berhasil  </div>');
            redirect('superadmin/prodi');
        endif;
    }

    public function deleteprodi($id)
    {

        $this->db->where('id', $id);
        $delete = $this->db->delete('prodi');

        if ($delete) :
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Delete program studi berhasil  </div>');
            redirect('superadmin/prodi');
        endif;
    }



    // BAGIAN JENIS PENDAFTAR
    public function jenis_pendaftar()
    {
        $data['title'] = 'Jenis Pendaftar';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['pendaftar'] = $this->db->get('jenis_pendaftar')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kelola_web/pendaftar', $data);
        $this->load->view('templates/footer');
    }

    public function addjenis_pendaftar()
    {
        $nama = $this->input->post('nama');

        $add = $this->db->insert('jenis_pendaftar', ['nama_jenis' => $nama]);

        if ($add) :
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Tambah jenis pendaftar berhasil  </div>');
            redirect('superadmin/jenis_pendaftar');
        endif;
    }

    public function editjenis_pendaftar($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Jenis Pendaftar';

        $data['jenis_pendaftar'] = $this->db->get_where('jenis_pendaftar', ['id' => $id])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kelola_web/editjenis_pendaftar', $data);
        $this->load->view('templates/footer');
    }

    public function prosesedit_pendaftar()
    {
        $id = $this->input->post('id');
        $nama = $this->input->post('nama_jenis');

        $data = [
            'nama_jenis' => $nama
        ];

        $this->db->where('id', $id);
        $edit = $this->db->update('jenis_pendaftar', $data);

        if ($edit) :
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Edit prodi berhasil  </div>');
            redirect('superadmin/jenis_pendaftar');
        endif;
    }

    public function deletejenis_pendaftar($id)
    {

        $this->db->where('id', $id);
        $delete = $this->db->delete('jenis_pendaftar');

        if ($delete) :
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Delete program studi berhasil  </div>');
            redirect('superadmin/jenis_pendaftar');
        endif;
    }
}