<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal_presensi extends CI_Controller

{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('auth');
        }
        $this->load->model('Tgl_model', 'tgl');
        $this->load->model('Method_model', 'Method');
    }


    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = "Jadwal & Presensi";
        $data['mentor'] = $this->db->get_where('user', ['role_id' => 2])->result_array();

        $email = $data['user']['email'];
        $queryKelas = "SELECT kelas.id, kelas.nama, kelas.tanggal, COUNT(kelas.id) AS peserta
                        FROM USER 
                        JOIN kelas 
                        ON user.id = kelas.user_id
                        JOIN data_peserta
                        ON kelas.id = data_peserta.kelas_id
                        WHERE user.email= '$email'
                        GROUP BY kelas.nama";

        $data['kelas'] = $this->db->query($queryKelas)->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('jadwal_presensi/index', $data);
        $this->load->view('templates/footer');
    }


    public function detailkelas($kelas_id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = "Jadwal & Presensi";

        $id_user = $data['user']['id'];
        $Querypertemuan = "SELECT*FROM berita_acara WHERE berita_acara.id_user =
            '$id_user' AND id_kelas=$kelas_id";
        $pertemuan = $this->db->query($Querypertemuan)->result_array();
        $data['berita_acara'] = $pertemuan;

        $queryPeserta = "SELECT p.*,s.spesifikasi ,k.nama as kelas, k.tanggal as tanggal,sk.alias as sertifikasi, f.alias as fakultas
        FROM data_peserta p, kelas k, pelatihan_kat sk, spesifikasi s, fakultas f
        WHERE p.kelas_id = k.id
        AND p.id_pelatihan = sk.id
        AND sk.id = s.id_pelatihan
        AND f.id = p.id_fakultas
        AND p.kelas_id = $kelas_id";

        $peserta = $this->db->query($queryPeserta)->result_array();
        $data['data_peserta'] = $peserta;

        $Totalpeserta = 0;
        $hadir = 0;
        $belumhadir = 0;

        foreach ($peserta as $p) :
            $Totalpeserta += 1;
            if ($p['presensi'] == 1) :
                $hadir += 1;
            else :
                $belumhadir += 1;
            endif;
        endforeach;

        $data['totalpeserta'] = $Totalpeserta;
        $data['hadir'] = $hadir;
        $data['belumhadir'] = $belumhadir;
        $data['kelas_id'] = $kelas_id;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('jadwal_presensi/kelas', $data);
        $this->load->view('templates/footer');
    }

    public function hadir($id = null, $kelas_id = null)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $id_mentor = $data['user']['id'];
        $presensi = $this->input->post('presensi');

        $ket = "Hadir";
        if ($presensi == 1) {
            $ket = "Hadir";
        }

        $hh = "SELECT nama_peserta, presensi FROM data_peserta WHERE '$id_mentor'";
        $data['coba'] = $this->db->query($hh)->result_array();
        $tgl_sekarang = date("d M Y");
        $tgl_sekarang = date("Y-m-d", strtotime($tgl_sekarang));

        $data = [
            'presensi' => 1,
            'keterangan' => $ket,
            'id_kelas' => $kelas_id,
            'id_user' => $id_mentor,
            'id_peserta' => $id,
            'tanggal' => $tgl_sekarang
        ];

        $this->db->where('id', $id);
        $this->db->insert('history_peserta', $data);
        redirect("jadwal_presensi/detailkelas/$kelas_id");
    }

    public function belumhadir($id = null, $kelas_id = null)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $id_mentor = $data['user']['id'];
        $presensi = $this->input->post('presensi');

        $ket = "Tidak Hadir";
        if ($presensi == 0) {
            $ket = "Tidak hadir";
        }

        $hh = "SELECT nama_peserta, presensi FROM data_peserta WHERE '$id_mentor'";
        $data['coba'] = $this->db->query($hh)->result_array();
        $tgl_sekarang = date("d M Y");
        $tgl_sekarang = date("Y-m-d", strtotime($tgl_sekarang));

        $data = [
            'presensi' => 0,
            'keterangan' => $ket,
            'id_kelas' => $kelas_id,
            'id_user' => $id_mentor,
            'id_peserta' => $id,
            'tanggal' => $tgl_sekarang
        ];

        $this->db->where('id', $id);
        $this->db->insert('history_peserta', $data);
        redirect("jadwal_presensi/detailkelas/$kelas_id");
    }

    public function simpanpeserta()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = "Jadwal & Presensi";

        $id_mentor = $data['user']['id'];

        $hh = "SELECT nama_peserta, presensi FROM data_peserta WHERE '$id_mentor'";
        $data['coba'] = $this->db->query($hh)->result_array();

        $data = array(
            'id_kelas' => $this->input->post('id_kelas'),
            'id_user' => $id_mentor,

            'keterangan' => htmlspecialchars($this->input->post('hadir', true)),
            'keterangan' => htmlspecialchars($this->input->post('tidak_hadir', true)),
            'nama_peserta' => htmlspecialchars($this->input->post('nama_peserta', true)),
            'keterangan' => htmlspecialchars($this->input->post('keterangan', true))
        );

        $this->load->model('Berita_model');
        $this->Berita_model->historiPeserta($data);
        redirect('jadwal_presensi/tambahberita');
    }

    public function tambahberita($kelas_id)
    {

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = "Jadwal & Presensi";

        $email = $data['user']['email'];
        $id_user = $data['user']['id'];

        $queryKelas = "SELECT k.nama, k.id, pk.nama_pelatihan, u.name
                       FROM kelas k, data_peserta dp, user u, pelatihan_kat pk
                       WHERE k.id = dp.kelas_id
                       AND dp.id_pelatihan = pk.id
                       AND dp.user_id = u.id
                       AND k.id=$kelas_id";

        $pert = "SELECT COUNT(berita_acara.id_beritaacara) AS jml, pertemuan 
                 FROM berita_acara 
                 WHERE berita_acara.id_user = '$id_user' 
                 AND id_kelas=$kelas_id";

        $brt = "SELECT id_beritaacara FROM berita_acara";
        $data['kelas'] = $this->db->query($queryKelas)->result_array();
        $data['pertemuan'] = $this->db->query($pert)->result_array();
        $data['berita'] = $this->db->query($brt)->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('jadwal_presensi/beritaacara', $data);
        $this->load->view('templates/footer');
    }

    public function tambahberitaacara()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = "Jadwal & Presensi";
        $pertemuan2 = $data['user']['id'];
        $data = array(
            'id_user' => $pertemuan2,
            'id_kelas' => $this->input->post('id_kelas'),
            'jenis_pelatihan' => htmlspecialchars($this->input->post('nama_pelatihan', true)),
            'kelas' => htmlspecialchars($this->input->post('kelas', true)),
            'pertemuan' => htmlspecialchars($this->input->post('pertemuan', true)),
            'tanggal' => htmlspecialchars($this->input->post('tanggal', true)),
            'nama_mentor' => htmlspecialchars($this->input->post('nama_mentor', true)),
            'berita' => htmlspecialchars($this->input->post('berita', true)),
        );

        $id_user = $pertemuan2;
        $id_kelas = $this->input->post('id_kelas');
        $jenis_pelatihan = htmlspecialchars($this->input->post('nama_pelatihan', true));
        $kelas = htmlspecialchars($this->input->post('kelas', true));
        $pertemuan = htmlspecialchars($this->input->post('pertemuan', true));
        $tanggal = htmlspecialchars($this->input->post('tanggal', true));
        $nama_mentor = htmlspecialchars($this->input->post('nama_mentor', true));
        $berita = htmlspecialchars($this->input->post('berita', true));
        $tanggal = date("Y-m-d", strtotime($tanggal));

        $this->load->model('Berita_model');
        $id = $this->Berita_model->simpanBerita2(
            $id_user,
            $id_kelas,
            $jenis_pelatihan,
            $kelas,
            $pertemuan,
            $tanggal,
            $nama_mentor,
            $berita
        );

        $query = "SELECT tanggal FROM berita_acara WHERE id_beritaacara = $id";
        $data = $this->db->query($query)->row();
        $tgl_input = $data->tanggal;
        $query_update = "UPDATE history_peserta SET id_berita=$id 
                        WHERE id_berita=0 AND id_user=$pertemuan2 
                        AND id_kelas =$id_kelas";
        $this->db->query($query_update);
        if ($query_update) :
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Pelatihan hari ini telah selesai, silahkan logout! </div>');
            redirect('jadwal_presensi/index');
        endif;
    }
}