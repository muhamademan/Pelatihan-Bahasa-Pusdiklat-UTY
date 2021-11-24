<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    // ============= MENU AKSES ===============
    public function menuakses()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Menu Akses';

        $queryAksesMenu = "SELECT am.id, am.role_id,u.email, am.menu_id, m.menu
                        FROM user u,user_access_menu am, user_menu m
                        WHERE u.role_id = am.role_id
                        AND am.menu_id = m.id
                        ORDER BY u.email, m.menu ASC";

        $data['menuakses'] = $this->db->query($queryAksesMenu)->result_array();

        $queryRole = "SELECT * FROM user_role";
        $data['datarole'] = $this->db->query($queryRole)->result_array();

        $queryMenu = "SELECT * FROM user_menu";
        $data['datamenu'] = $this->db->query($queryMenu)->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kelola_menu/menuakses', $data);
        $this->load->view('templates/footer');
    }

    public function addaksesmenu()
    {
        $role_id = $this->input->post('role_id');
        $menu_id = $this->input->post('menu_id');

        $data_user_akses = $this->db->get('user_access_menu')->result_array();
        $pesan = 0;
        foreach ($data_user_akses as $d) :
            if ($d['role_id'] == $role_id) :
                if ($d['menu_id'] == $menu_id) :
                    $pesan = 1;
                endif;
            endif;
        endforeach;

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        if ($pesan == 1) :
            $queryUserMenu = "SELECT am.id, am.role_id, u.email, am.menu_id, m.menu
                                FROM user u,user_access_menu am, user_menu m
                                WHERE u.role_id = am.role_id
                                AND am.menu_id = m.id
                                AND am.role_id = $role_id
                                AND am.menu_id = $menu_id";
            $email = $this->db->query($queryUserMenu)->row_array();
            $email = $email['email'];
            $menu = $email['menu'];
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Role <b class="text-primary">' . $email . '</b> sudah memiliki akses ke menu <b class="text-primary">' . $menu . ' </b></div>');
        else :
            $addmenuakses = $this->db->insert('user_access_menu', $data);
            if ($addmenuakses) :
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Akses berhasil di tambahkan  </div>');
            endif;
        endif;

        redirect('kelola_web/menuakses');
    }

    public function deleteaksesmenu($id = null)
    {
        if ($id) {
            $queryUserMenu = "SELECT am.id, am.role_id,u.username, am.menu_id, m.title
            FROM user u,user_access_menu am, user_menu m
            WHERE u.role = am.role_id
            AND am.menu_id = m.id
            AND am.id = $id";
            $usermenu = $this->db->query($queryUserMenu)->row_array();
            $username = $usermenu['username'];
            $title = $usermenu['title'];

            $this->db->where('id', $id);
            $delete = $this->db->delete('user_access_menu');

            if ($delete) :
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Akses <b class="text-primary">' . $username . '</b> ke <b class="text-primary">' . $title . '</b> berhasil dihapus  </div>');
            else :
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Akses ' . $username . ' ke ' . $title . ' gagal dihapus  </div>');
            endif;
        }
        redirect('kelola_web/menuakses');
    }

    // ============ MENU MANAGEMENT =============
    public function menu()
    {
        $data['title'] = 'Menu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['menu'] = $this->db->get('user_menu')->result_array();
        $querySubmenu = "SELECT *,m.menu as menu_title FROM user_menu m, user_sub_menu sm
                        WHERE m.id = sm.menu_id
                        ORDER BY menu_title ASC";
        $data['submenu'] = $this->db->query($querySubmenu)->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kelola_menu/menu', $data);
        $this->load->view('templates/footer');
    }

    public function UserActived()
    {
        $id = $this->input->post('id');
        echo json_encode($this->Menu->UpdateActiveById($id));
    }

    public function UserActivedMenu()
    {
        $id = $this->input->post('id');
        echo json_encode($this->Menu->UpdateActiveByIdMenu($id));
    }

    public function addmenu()
    {
        $nama = $this->input->post('nama');

        $menu = $this->db->insert('user_menu', ['menu' => $nama]);

        if ($menu) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Menu berhasil diambahkan  </div>');
            redirect('menu/menu');
        };
    }

    public function deletemenu($id = null)
    {

        $this->db->where('id', $id);
        $menu = $this->db->delete('user_menu');

        if ($menu) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Menu berhasil dihapus </div>');
            redirect('menu/menu');
        };
    }

    public function editmenu($id = null)
    {
        if (!$id) {
            redirect('menu/menu');
        }

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Menu management';

        $this->db->where('id', $id);
        $data['menu'] = $this->db->get('user_menu')->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kelola_menu/editmenu', $data);
        $this->load->view('templates/footer');
    }

    public function proseseditmenu()
    {
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');

        $this->db->where('id', $id);
        $menu = $this->db->update('user_menu', ['menu' => $nama]);

        if ($menu) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Menu berhasil diedit </div>');
            redirect('menu/menu');
        }
    }

    // ============ BAGIAN SUBMENU =============
    public function addsubmenu()
    {
        $menu_id = $this->input->post('menu_id');
        $nama = $this->input->post('nama');
        $icon = $this->input->post('icon');
        $url = $this->input->post('url');
        $status = $this->input->post('status');

        if ($status == null) {
            $status = 1;
        }

        $data = [
            'menu_id' => $menu_id,
            'title' => $nama,
            'icon' => $icon,
            'url' => $url,
            'is_active' => $status
        ];

        $submenu = $this->db->insert('user_sub_menu', $data);

        if ($submenu) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Submenu berhasil ditambahkan, cek bagian bawah </div>');
            redirect('menu/menu');
        }
    }

    public function editsubmenu($id = null)
    {
        $data['title'] = 'Menu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->db->where('id', $id);
        $data['submenu'] = $this->db->get('user_sub_menu')->row_array();

        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kelola_menu/editsubmenu', $data);
        $this->load->view('templates/footer');
    }

    public function proseseditsubmenu()
    {
        $id = $this->input->post('id');
        $menu_id = $this->input->post('menu_id');
        $title = $this->input->post('nama');
        $icon = $this->input->post('icon');
        $url = $this->input->post('url');
        $is_active = $this->input->post('status');

        $data = [
            'menu_id' => $menu_id,
            'title' => $title,
            'icon' => $icon,
            'url' => $url,
            'is_active' => $is_active
        ];

        $this->db->where('id', $id);
        $submenu = $this->db->update('user_sub_menu', $data);

        if ($submenu) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Submenu berhasil diedit, cek bagian bawah </div>');
            redirect('menu/menu');
        }
    }

    public function deletesubmenu($id = null)
    {
        $this->db->where('id', $id);
        $submenu = $this->db->delete('user_sub_menu');

        if ($submenu) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Submenu berhasil dihapus, cek bagian bawah </div>');
            redirect('menu/menu');
        }
    }
}