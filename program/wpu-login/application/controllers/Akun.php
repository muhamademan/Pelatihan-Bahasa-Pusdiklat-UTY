<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Akun extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function admin()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Admin & Staff';

        date_default_timezone_set('Asia/Jakarta');
        $query = "SELECT user.*, user_role.role, user_role.id AS id_role FROM user, user_role
                    WHERE user.role_id = user_role.id 
                    ORDER BY user.role_id ASC";

        $data['admin'] = $this->db->query($query)->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kelola_akun/admin', $data);
        $this->load->view('templates/footer');
    }

    public function addadmin()
    {
        $role = $this->input->post('role_id');
        $email = $this->input->post('email');
        $username = $this->input->post('username');
        $name = $this->input->post('name');
        $jns_kelamin = $this->input->post('jns_kelamin');
        $no_hp = $this->input->post('no_hp');
        $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

        $data = [
            'role_id' => $role,
            'email' => $email,
            'username' => $username,
            'name' => $name,
            'jns_kelamin' => $jns_kelamin,
            'no_hp' => $no_hp,
            'password' => $password,
            'is_active' => 1,
            'image' => 'default.png'
        ];

        $add = $this->db->insert('user', $data);
        if ($add) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Tambah admin atau staff berhasil  </div>');
            redirect('akun/admin');
        }
    }

    public function deleteadmin($id)
    {

        $this->db->where('id', $id);
        $delete = $this->db->delete('user');

        if ($delete) :
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Delete user berhasil  </div>');
            redirect('akun/admin');
        endif;
    }

    function editAdmin($id = null)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Admin & Staff';

        $queryAdmin = "SELECT u.* FROM user u, user_role ur
                        WHERE ur.id = u.role_id
                        AND u.id = $id";

        $data['data_user'] = $this->db->query($queryAdmin)->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kelola_akun/editAdmin', $data);
        $this->load->view('templates/footer');
    }

    public function proseseditAdmin()
    {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $username = $this->input->post('username');
        $jns_kelamin = $this->input->post('jns_kelamin');
        $no_hp = $this->input->post('no_hp');
        $email = $this->input->post('email');

        $data = [
            'name' => $name,
            'username' => $username,
            'jns_kelamin' => $jns_kelamin,
            'no_hp' => $no_hp,
            'email' => $email
        ];

        $this->db->where('id', $id);
        $edit = $this->db->update('user', $data);

        if ($edit) :
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            admin berhasil diedit </div>');
            redirect('akun/admin');
        endif;
    }

    // ========= BAGIAN PENGATURAN ADMIN ============
    public function pengaturan()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Pengaturan';

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');
        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('kelola_akun/pengaturan', $data);
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');

            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');

            // Bagian ubah password
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

    // ========== BAGIAN ROLE ============
    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $query = "SELECT * FROM user_role ORDER BY role ASC";
        $data['role'] = $this->db->query($query)->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kelola_akun/role', $data);
        $this->load->view('templates/footer');
    }

    public function addRole()
    {
        $nama = $this->input->post('nama');

        $add = $this->db->insert('user_role', ['role' => $nama]);

        if ($add) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Role berhasil ditambahkan </div>');
            redirect('akun/role');
        }
    }

    public function editRole($id = null)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Role';

        $this->db->where('id', $id);
        $data['role'] = $this->db->get('user_role')->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kelola_akun/editRole', $data);
        $this->load->view('templates/footer');
    }

    function proseseditRole()
    {
        $id = $this->input->post('id');
        $role = $this->input->post('role');

        $data = [
            'role' => $role
        ];

        $this->db->where('id', $id);
        $edit = $this->db->update('user_role', $data);

        if ($edit) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Jenis role berhasil diedit </div>');
            redirect('akun/role');
        }
    }

    public function deleteRole($id = null)
    {
        $this->db->where('id', $id);
        $delete = $this->db->delete('user_role');

        if ($delete) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Role berhasil dihapus  </div>');
            redirect('akun/role');
        }
    }
}