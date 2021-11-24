<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Berita_model extends CI_Model
{
    function simpanBerita($data)
    {
        $this->db->insert('berita_acara', $data);
    }

    function simpanBerita2(
        $id_user,
        $id_kelas,
        $jenis_pelatihan,
        $kelas,
        $pertemuan,
        $tanggal,
        $nama_mentor,
        $berita
    ) {
        $data = array(
            'id_user' => $id_user,
            'id_kelas' => $id_kelas,
            'jenis_pelatihan' => $jenis_pelatihan,
            'kelas' => $kelas,
            'pertemuan' => $pertemuan,
            'tanggal' => $tanggal,
            'nama_mentor' => $nama_mentor,
            'berita' => $berita
        );
        $this->db->insert('berita_acara', $data);

        return $this->db->insert_id();
    }



    function historiPeserta($data)
    {
        $this->db->insert('history_peserta', $data);
    }

    // function increBerita($data)
    // {
    //     $this->db->select("MAX(id_beritaacara)+1 AS id");
    //     $this->db->from("berita_acara");
    //     $query = $this->db->get();

    //     return $query->row()->id;
    // }

    function gettahun()
    {
        $query = $this->db->query("SELECT YEAR(tanggal) AS tahun FROM berita_acara GROUP BY YEAR(tanggal)
        ORDER BY YEAR(tanggal) ASC");

        return $query->result();
    }

    function filterbytanggal($tanggalawal, $tanggalakhir)
    {
        $query = $this->db->query("SELECT * FROM berita_acara WHERE tanggal BETWEEN '$tanggalawal' AND  '$tanggalakhir'
        ORDER BY tanggal ASC");

        // $this->db->where('tanggal >=', $tanggalawal);
        // $this->db->where('tanggal <=', $tanggalakhir);
        return $query->result();
    }

    // function filterbybulan($tahun1, $bulanawal, $bulanakhir)
    // {
    //     $query = $this->db->query("SELECT * FROM berita_acara WHERE YEAR(tanggal) = '$tahun1' AND  MONTH(tanggal)
    //     BETWEEN '$bulanawal' AND '$bulanakhir'
    //     ORDER BY tanggal ASC");

    //     return $query->result();
    // }


    // function filterbytahun($tahun2)
    // {
    //     $query = $this->db->query("SELECT * FROM berita_acara WHERE YEAR(tanggal) = '$tahun2'
    //     ORDER BY tanggal ASC");

    //     return $query->result();
    // }
}