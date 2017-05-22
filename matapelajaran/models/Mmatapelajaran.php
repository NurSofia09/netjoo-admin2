<?php



class Mmatapelajaran extends CI_Model {



    public function __construct() {

        parent::__construct();

    }



    public function daftarMapel() {

        $this->db->select('*');

        $this->db->from('tb_mata-pelajaran');

        $this->db->where('status', 1);

        $query = $this->db->get();

        return $query->result();

    }



    public function daftarMapelSD() {
        $this->db->distinct();
        $this->db->select('tp.id, tp.tingkatID, tp.matapelajaranID, tp.keterangan,mp.namaMataPelajaran,mp.aliasMataPelajaran');

        $this->db->from('tb_mata-pelajaran mp');

        $this->db->from('tb_tingkat-pelajaran tp');

        $this->db->join('tb_bab bab', 'bab.tingkatPelajaranID=tp.id');
        $this->db->join('tb_subbab sub','sub.babID=bab.id');
        $this->db->join('tb_video video','video.subBabID=sub.id');

        $this->db->where('mp.id = tp.mataPelajaranID');

        $this->db->where('tingkatID', '1');

        $this->db->where('mp.status', '1');

        $this->db->where('tp.status', '1');



        $query = $this->db->get();

        return $query->result();

    }



    public function daftarMapelSMP() {
        $this->db->distinct();
        $this->db->select('tp.id, tp.tingkatID, tp.matapelajaranID, tp.keterangan,mp.namaMataPelajaran,mp.aliasMataPelajaran');

        $this->db->from('tb_mata-pelajaran mp');

        $this->db->from('tb_tingkat-pelajaran tp');

        $this->db->join('tb_bab bab', 'bab.tingkatPelajaranID=tp.id');
        $this->db->join('tb_subbab sub','sub.babID=bab.id');
        $this->db->join('tb_video video','video.subBabID=sub.id');

        $this->db->where('mp.id = tp.mataPelajaranID');

        $this->db->where('tingkatID', '2');

        $this->db->where('mp.status', '1');

        $this->db->where('tp.status', '1');



        $query = $this->db->get();

        return $query->result();

    }



    public function daftarMapelSMA() {
        $this->db->distinct();
        $this->db->select('tp.id, tp.tingkatID, tp.matapelajaranID, tp.keterangan,mp.namaMataPelajaran,mp.aliasMataPelajaran');

        $this->db->from('tb_mata-pelajaran mp');

        $this->db->from('tb_tingkat-pelajaran tp');


        $this->db->join('tb_bab bab', 'bab.tingkatPelajaranID=tp.id');
        $this->db->join('tb_subbab sub','sub.babID=bab.id');
        $this->db->join('tb_video video','video.subBabID=sub.id');
        $this->db->where('mp.id = tp.mataPelajaranID');

        $this->db->where('tingkatID', '3');

        $this->db->where('mp.status', '1');

        $this->db->where('tp.status', '1');



        $query = $this->db->get();

        return $query->result();

    }



    public function daftarMapelSMAIPA() {
        $this->db->distinct();
        $this->db->select('tp.id, tp.tingkatID, tp.matapelajaranID, tp.keterangan,mp.namaMataPelajaran,mp.aliasMataPelajaran');

        $this->db->from('tb_mata-pelajaran mp');

        $this->db->from('tb_tingkat-pelajaran tp');

        $this->db->join('tb_bab bab', 'bab.tingkatPelajaranID=tp.id');
        $this->db->join('tb_subbab sub','sub.babID=bab.id');
        $this->db->join('tb_video video','video.subBabID=sub.id');

        $this->db->where('mp.id = tp.mataPelajaranID');

        $this->db->where('tingkatID', '4');

        $this->db->where('mp.status', '1');

        $this->db->where('tp.status', '1');



        $query = $this->db->get();

        return $query->result();

    }

    

    public function daftarMapelSMAIPS() {
        $this->db->distinct();
        $this->db->select('tp.id, tp.tingkatID, tp.matapelajaranID, tp.keterangan,mp.namaMataPelajaran,mp.aliasMataPelajaran');

        $this->db->from('tb_mata-pelajaran mp');

        $this->db->from('tb_tingkat-pelajaran tp');

        $this->db->join('tb_bab bab', 'bab.tingkatPelajaranID=tp.id');
        $this->db->join('tb_subbab sub','sub.babID=bab.id');
        $this->db->join('tb_video video','video.subBabID=sub.id');

        $this->db->where('mp.id = tp.mataPelajaranID');

        $this->db->where('tingkatID', '5');

        $this->db->where('mp.status', '1');

        $this->db->where('tp.status', '1');



        $query = $this->db->get();

        return $query->result();

    }



    public function tambahMP($data) {

        $this->db->insert('tb_mata-pelajaran', $data);

    }



    function hapusMP($id) {

        $this->db->set('status', 0);

        $this->db->where('id', $id);

        $this->db->update('tb_mata-pelajaran');

    }



    function rubahMP($id, $data) {

        $this->db->where('id', $id);

        $this->db->update('tb_mata-pelajaran', $data);

    }



    public function tambahtingkatMP($data) {

        $this->db->insert('tb_tingkat-pelajaran', $data);

    }



    function hapustingkatMP($id) {

        $this->db->set('status', 0);

        $this->db->where('id', $id);

        $this->db->update('tb_tingkat-pelajaran');

    }



    function rubahtingkatMP($id, $data) {

        $this->db->where('id', $id);

        $this->db->update('tb_tingkat-pelajaran', $data);

    }



    public function daftarBab($id) {

        $this->session->set_userdata('id_mp', $id);

        $this->db->select('*, tbbab.id as idbab');

        $this->db->from('tb_bab as tbbab');
        $this->db->join('tb_tingkat-pelajaran as tbtipe','tbbab.tingkatPelajaranID = tbtipe.id');
//        $this->db->join('tb_mata-pelajaran as tbmapel','tbtipe.mataPelajaranID = tbmapel.id');

        $this->db->where('tingkatPelajaranID', $id);

        $this->db->where('tbbab.status', 1);

        $query = $this->db->get();

        return $query->result();

    }



    public function tambahbabMP($data) {

        $this->db->insert('tb_bab', $data);

    }



    function rubahbabMP($id, $data) {

        $this->db->where('id', $id);

        $this->db->update('tb_bab', $data);

    }



    function hapusbabMP($id, $data) {

        $this->db->set('status', 0);

        $this->db->where('id', $id);

        $this->db->update('tb_bab');

    }



    public function daftarsubBab($id) {

        $this->db->select('*,tb_subbab.id as subID');

        $this->db->from('tb_subbab');

        $this->db->where('babID', $id);

        $this->db->where('status', 1);

        $query = $this->db->get();

        return $query->result();

    }



    public function tambahsubbabMP($data) {

        $this->db->insert('tb_subbab', $data);

    }



    function rubahsubbabMP($id, $data) {

        $this->db->where('id', $id);

        $this->db->update('tb_subbab', $data);

    }



    function hapussubbabMP($id, $data) {

        $this->db->set('status', 0);

        $this->db->where('id', $id);

        $this->db->update('tb_subbab');

    }



    public function sc_bab_by_tingpel_id($tingpelID)

    {

        $this->db->where('tingkatPelajaranID', $tingpelID);

        $this->db->select('id, keterangan, judulBab')->from('tb_bab');

        $query = $this->db->get();

        return $query->result_array();

    }



    public function sc_sub_by_subid($subid){

        $this->db->where('id', $subid);

        $this->db->select('judulSubBab')->from('tb_subbab');

        $query = $this->db->get();

        return $query->result_array();

    }



    #Menghitung jumlah pelajaran secara keseluruhan

    function get_courses_number(){

        $this->db->select('id');

        $this->db->from('tb_tingkat-pelajaran');

        $query = $this->db->get();

        return $query->num_rows();

    }

    function get_mapel_by_tingkatID($id_tingkat){
        $this->db->select('tingpel.id as tingpelID, mapel.id as mapelID, mapel.namaMataPelajaran as napel');
        $this->db->from('tb_mata-pelajaran mapel');
        $this->db->JOIN('tb_tingkat-pelajaran tingpel','mapel.id = tingpel.mataPelajaranID');
        $this->db->where('tingkatID',$id_tingkat);
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_mapel_by_guruID($id_guru){
        $this->db->select('namaMataPelajaran,mapelID');
        $this->db->from("(SELECT * FROM `tb_mm-gurumapel` WHERE guruID = $id_guru) AS mapel");
        $this->db->JOIN('tb_mata-pelajaran mp', 'mp.id = mapel.mapelID');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_bab_by_tingpelID($id_tingkat_pelajaran){
        $this->db->select('bab.id as babID, judulBab');
        $this->db->from('tb_bab bab');
        $this->db->JOIN('tb_tingkat-pelajaran tingpel = bab.tingkatPelajaranID = tingpel.id');
        $this->db->where('tingkatPelajaranID',$id_tingkat_pelajaran);
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_bab_by_id($data){
        $query = "SELECT 
        bab.id, namaTingkat, `namaMataPelajaran`, `judulBab`
        FROM
        (SELECT  * FROM  `tb_bab`
        WHERE 
        id =  $data ) AS bab JOIN 
        `tb_tingkat-pelajaran` AS tingkatpel 
        ON tingkatpel.`id` = bab.tingkatPelajaranID
        JOIN `tb_tingkat` AS tingkat
        ON `tingkat`.`id` = `tingkatpel`.`tingkatID`
        JOIN `tb_mata-pelajaran` AS mapel
        ON mapel.`id` = `tingkatpel`.`mataPelajaranID`";
        $result = $this->db->query($query);
        return $result->result_array();
    }

    function get_bab_by_mapel($id_mapel){
        $this->db->select('b.id, b.judulBab');
        $this->db->from('(SELECT * FROM `tb_mata-pelajaran` m WHERE m.id = '.$id_mapel.') AS mapel');
        $this->db->JOIN('`tb_tingkat-pelajaran` t','t.mataPelajaranID = mapel.id');
        $this->db->JOIN('tb_bab b','b.tingkatPelajaranID = t.id');
        $query = $this->db->get();
        return $query->result_array();

    }

}



?>