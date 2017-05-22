<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mtesonline extends CI_Model {

    //mengambil paket tingkat dan mapel tertentu
    //misalnya : IPA untuk Tingkat SD
    public function getpaketbytingkatmapel($tingpelID) {
        $this->db->select('tingpel.tingkatID as tingkatID,judulSubBab as JudulSub,tingpel.id AS tingpelID,paket.nm_paket, paket.id_paket AS paketID, jumlah_soal');
        $this->db->from('tb_mata-pelajaran mapel');
        $this->db->join('tb_tingkat-pelajaran tingpel', 'mapel.id = tingpel.mataPelajaranID');
        $this->db->join('tb_bab bab', 'bab.tingkatPelajaranID=tingpel.id');
        $this->db->join('tb_subbab subab', 'subab.babID = bab.id');
        $this->db->join('tb_paket paket', 'paket.id_subbab = subab.id');

        $this->db->where('tingpel.id', $tingpelID);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_soal($id_latihan) {
        $this->db->select('id_latihan as idlat, soal as soal, soal.id_soal as soalid, soal.judul_soal as judul, soal.gambar_soal as gambar, soal.jawaban as jaw,, soal.pembahasan, soal.gambar_pembahasan, soal.video_pembahasan, soal.status_pembahasan, soal.link,soal.audio');
        $this->db->from('tb_mm_sol_lat as sollat');
        $this->db->join('tb_banksoal as soal', 'sollat.id_soal = soal.id_soal');
        $this->db->where('sollat.id_latihan', $id_latihan);
        $query = $this->db->get();
        $soal = $query->result_array();

        $this->db->select('*,id_latihan as idlat, soal as soal, pil.id_soal as pilid,soal.id_soal as soalid, pil.pilihan as pilpil, pil.jawaban as piljaw, pil.gambar as pilgam');
        $this->db->from('tb_mm_sol_lat as sollat');
        $this->db->join('tb_banksoal as soal', 'sollat.id_soal = soal.id_soal');
        $this->db->join('tb_piljawaban as pil', 'soal.id_soal = pil.id_soal');
        $this->db->where('sollat.id_latihan', $id_latihan);
        $query = $this->db->get();
        $pil = $query->result_array();

        return array(
            'soal' => $soal,
            'pil' => $pil,
        );
    }

    //get pilihan berdasarkan subbab MP
    public function get_pilihan($subbID) {
        $this->db->select('*,pil.id_soal as pilid, soal.id_soal as soalid, pil.jawaban as piljawaban');
        $this->db->from('tb_banksoal soal');
        $this->db->join('tb_piljawaban pil', ' pil.id_soal= soal.id_soal');
        $this->db->where('id_subbab', $subbID);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function jawabansoal($id) {
        $this->db->select('soal.id_soal as soalid, soal.jawaban as jawaban');
        $this->db->from('tb_mm_sol_lat as sollat');
        $this->db->join('tb_banksoal as soal', 'sollat.id_soal = soal.id_soal');
        $this->db->where('sollat.id_latihan', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function inputreport($data) {
        $this->db->insert('tb_report-latihan', $data);
    }

    public function updateLatihan($id) {
        $this->db->set('status_pengerjaan', 2);
        $this->db->where('id_latihan', $id);
        $this->db->update('tb_latihan');
    }

    public function levelLatihan($id) {
        $this->db->select('tingkatKesulitan as level');
        $this->db->from('tb_latihan');
        $this->db->where('id_latihan', $id);
        $query = $this->db->get();
        return $query->result();
    }
}

?>
