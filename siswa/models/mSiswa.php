<?php

class Msiswa extends CI_Model {
    #Start function pengaturan profile siswa#
    //front
    public function update_siswa($data) {
        $penggunaID = $this->session->userdata['id'];
        $this->db->where('penggunaID', $penggunaID);
        $this->db->update('tb_siswa', $data);
        
    }
    //back
    public function update_siswa1($data,$idsiswa) {
        $this->db->where('id', $idsiswa);
        $this->db->update('tb_siswa', $data);
        
    }

    public function update_email($data) {
        $id = $this->session->userdata['id'];
        $this->db->where('id', $id);
        $this->db->update('tb_pengguna', $data);
        $sess_array = array(
            'eMail' => $data['eMail'],
            );
        $this->session->set_userdata($sess_array);

    }

    // front
    public function update_katasandi($data) {
        $id = $this->session->userdata['id'];
        $this->db->where('id', $id);
        $this->db->update('tb_pengguna', $data);
    }
    // back
    public function update_katasandi2($data,$idpengguna) {
        $this->db->where('id', $idpengguna);
        $this->db->update('tb_pengguna', $data);
    }
    public function update_photo($photo) {
        $data = array(
            'photo' => $photo
            );
        $penggunaID = $this->session->userdata['id'];
        $this->db->where('penggunaID', $penggunaID);
        $this->db->update('tb_siswa', $data);

    }

    public function get_siswa() {
        $penggunaID = $this->session->userdata['id'];
        //select from 2 table di join semuanya
        $this->db->select('namaDepan');
        $this->db->from('tb_guru guru');
        $this->db->join('tb_pengguna pengguna', 'pengguna.id=guru.penggunaID');

        //where 
        $this->db->where('penggunaID', $penggunaID);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_siswa_numbers() {
        //select from 2 table di join semuanya
        $this->db->select('id');
        $this->db->from('tb_siswa');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_datsiswa() {
        $penggunaID = $this->session->userdata['id'];
        $this->db->select('namaDepan,namaBelakang,alamat,noKontak,namaSekolah,alamatSekolah,biografi,photo');
        $this->db->from('tb_siswa');
        $this->db->where('penggunaID', $penggunaID);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_password() {
        $ID = $this->session->userdata['id'];
        $this->db->select('kataSandi');
        $this->db->from('tb_pengguna');
        $this->db->where('id', $ID);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_allsiswa() {
        $this->db->select('namaDepan,namaBelakang,aliasTingkat, siswa.id as id, tingkat.id as id_tingkat');
        $this->db->from('tb_siswa siswa');
        $this->db->join('tb_tingkat tingkat', 'tingkat.id = siswa.tingkatID');
        $this->db->where('status', 1);
        $query = $this->db->get();
        return $query->result_array();
    }


    #query get siswa belum to
    public function get_siswa_blm_ikutan_to_pagination($data) {
        $this->db->select('s.`id`, s.`namaDepan`,s.`namaBelakang`,c.`namaCabang`,tkt.`aliasTingkat`,p.`namaPengguna`');
        $this->db->join('tb_cabang c', 's.`cabangID` = c.id','left');
        $this->db->join('tb_pengguna p', 's.penggunaID = p.id');
        $this->db->join('tb_tingkat tkt', 'tkt.id = s.tingkatID');

        // kalo user melakukan search secara keseluruhan

        if ($data['key_search']!="") { 
            $search_all = "'%".$data['key_search']."%'";
            $this->db->where('(
                `p`.`namaPengguna` LIKE '.$search_all.' 
                OR s.`namaDepan`LIKE '.$search_all.' 
                OR tkt.`aliasTingkat` LIKE '.$search_all.' 
                OR s.`namaDepan` LIKE '.$search_all.' 
                OR c.`namaCabang` LIKE '.$search_all.' 
                ) ');
        }

        // kalo user melakukan search single.
        $result = 'true' === $data['search_single'];
        // $data['key_single'] = 'nama_pengguna_search';
        // $data['key_word'] = 'nursofia';

        if($result){
            if($data['key_single']=='nama_siswa_search'){
                $this->db->or_like('s.namaDepan',$data['key_word']);

            }else if($data['key_single']=='nama_pengguna_search'){
                $this->db->or_like('p.namaPengguna',$data['key_word']);

            }else if($data['key_single']=='cabang_search'){
                $this->db->or_like('c.namaCabang',$data['key_word']);

            }else{
                $this->db->or_like('tkt.aliasTingkat',$data['key_word']); 

            }
        }
        

        $this->db->where('s.id NOT IN(SELECT ss.`id` FROM tb_siswa ss JOIN `tb_hakakses-to` ho ON ho.`id_siswa` = ss.`id` WHERE ho.`id_tryout` = '.$data['id_to'].') AND s.`status`=1
            ');
        $query = $this->db->get('tb_siswa s', $data['records_per_page'], $data['page_select']);
        return $query->result_array();
    }

    public function get_siswa_blm_ikutan_to_pagination_number($data) {
        $this->db->select('s.`id`');
        $this->db->join('tb_cabang c', 's.`cabangID` = c.id','left');
        $this->db->join('tb_pengguna p', 's.penggunaID = p.id');
        $this->db->join('tb_tingkat tkt', 'tkt.id = s.tingkatID');

        // kalo user melakukan search secara keseluruhan

        if ($data['key_search']!="") { 
            $search_all = "'%".$data['key_search']."%'";
            $this->db->where('(
                `p`.`namaPengguna` LIKE '.$search_all.' 
                OR s.`namaDepan`LIKE '.$search_all.' 
                OR tkt.`aliasTingkat` LIKE '.$search_all.' 
                OR s.`namaDepan` LIKE '.$search_all.' 
                OR c.`namaCabang` LIKE '.$search_all.' 
                ) ');
        }

        // kalo user melakukan search single.
        $result = 'true' === $data['search_single'];
        // $data['key_single'] = 'nama_pengguna_search';
        // $data['key_word'] = 'nursofia';

        if($result){
            if($data['key_single']=='nama_siswa_search'){
                $this->db->or_like('s.namaDepan',$data['key_word']);

            }else if($data['key_single']=='nama_pengguna_search'){
                $this->db->or_like('p.namaPengguna',$data['key_word']);

            }else if($data['key_single']=='cabang_search'){
                $this->db->or_like('c.namaCabang',$data['key_word']);

            }else{
                $this->db->or_like('tkt.aliasTingkat',$data['key_word']); 

            }
        }
        

        $this->db->where('s.id NOT IN(SELECT ss.`id` FROM tb_siswa ss JOIN `tb_hakakses-to` ho ON ho.`id_siswa` = ss.`id` WHERE ho.`id_tryout` = '.$data['id_to'].') AND s.`status`=1
            ');
        
        $query = $this->db->get('tb_siswa s');
        return $query->num_rows();
    }
    ##query get siswa belum to.

    #query get siswa belum to

    public function get_siswa_blm_ikutan_to($id) {
        $query = "SELECT s.`id`, s.`namaDepan`,s.`namaBelakang`,c.`namaCabang`,tkt.`aliasTingkat`,pengguna.`namaPengguna` FROM tb_siswa s 
        Join `tb_pengguna` pengguna
        ON pengguna.`id` = s.`penggunaID`
        Join `tb_tingkat` tkt
        ON tkt.`id` = s.`tingkatID`
        LEFT JOIN `tb_cabang` c
        ON s.`cabangID` = c.id
        WHERE s.id NOT IN
        (
        SELECT ss.`id` FROM tb_siswa ss
        JOIN `tb_hakakses-to` ho ON
        ho.`id_siswa` = ss.`id`
        WHERE ho.`id_tryout` = $id) AND s.`status`=1
        ";
        $result = $this->db->query($query);
        return $result->result_array();
    }

    ##query get siswa belum to.
    #query get semua siswa

    function get_all_siswa() {
        $this->db->select('*,siswa.id as idsiswa');
        $this->db->from('tb_siswa siswa');
        $this->db->join('tb_pengguna pengguna', 'siswa.penggunaID = pengguna.id');
        $this->db->where('siswa.status', 1);
        $query = $this->db->get();
        return $query->result_array();
    }

    function hapus_siswa($idsiswa, $idpengguna) {
        $this->db->set('status', 0);
        $this->db->where('id', $idsiswa);
        $this->db->update('tb_siswa');

        $this->db->set('status', 0);
        $this->db->where('id', $idpengguna);
        $this->db->update('tb_pengguna');
    }


    function get_siswa_byid($idsiswa, $idpengguna) {
        $this->db->select('siswa.id as idsiswa,siswa.namaDepan,siswa.namaBelakang,siswa.alamat,siswa.noKontak,siswa.tingkatID as kelasID,siswa.namaSekolah,siswa.alamatSekolah,siswa.cabangID,tkt.depedensi as tingkatID');
        $this->db->from('tb_siswa siswa');
        $this->db->join('tb_pengguna pengguna', 'siswa.penggunaID = pengguna.id');
        $this->db->join('tb_tingkat tkt','tkt.id = siswa.tingkatID');
        $this->db->where('pengguna.id', $idpengguna);
        $query = $this->db->get();
        return $query->result_array();
    }


    function get_reportlatihan_siswa($idpengguna) {
        $this->db->select('*');
        $this->db->from('tb_report-latihan reportla');
        $this->db->join('tb_latihan latihan', 'reportla.id_latihan = latihan.id_latihan');
        $this->db->where('reportla.id_pengguna', $idpengguna);
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_reporttryout_siswa($idpengguna) {
        $this->db->select('tryout.id_tryout,tryout.nm_tryout,tryout.tgl_mulai,siswa.penggunaID as idpengguna');
        $this->db->from('tb_siswa as siswa');
        $this->db->join('tb_hakakses-to as hak', 'siswa.id = hak.id_siswa');
        $this->db->join('tb_tryout as tryout', 'hak.id_tryout = tryout.id_tryout');
        $this->db->where('siswa.penggunaID', $idpengguna);

        // $this->db->select('AVG(repa.poin) AS ratarata');
        // $this->db->from('tb_report-paket as repa');
        // $this->db->join('tb_mm-tryoutpaket as mmtry', 'repa.id_mm-tryout-paket = mmtry.id');
        // $this->db->join('tb_paket as pa', 'mmtry.id_paket = pa.id_paket');
        // $this->db->where('repa.id_pengguna', $idpengguna);
        // $this->db->where('mmtry.id_tryout', $idto);


        $query = $this->db->get();
        return $query->result_array();
    }

    function get_reportpaket_to($idpengguna,$idto) {
        $this->db->select('pa.nm_paket,repa.tgl_pengerjaan, repa.jmlh_kosong,repa.jmlh_benar,repa.jmlh_salah,repa.poin');
        $this->db->from('tb_report-paket as repa');
        $this->db->join('tb_mm-tryoutpaket as mmtry', 'repa.id_mm-tryout-paket = mmtry.id');
        $this->db->join('tb_paket as pa', 'mmtry.id_paket = pa.id_paket');
        $this->db->where('repa.id_pengguna', $idpengguna);
        $this->db->where('mmtry.id_tryout', $idto);
        $query = $this->db->get();
        return $query->result_array();
    }

    function ratarata_to($idpengguna,$idto) {
        $this->db->select('repa.poin, AVG(repa.poin) as rata');
        $this->db->from('tb_report-paket as repa');
        $this->db->join('tb_mm-tryoutpaket as mmtry', 'repa.id_mm-tryout-paket = mmtry.id');
        $this->db->join('tb_paket as pa', 'mmtry.id_paket = pa.id_paket');
        $this->db->where('repa.id_pengguna', $idpengguna);
        $this->db->where('mmtry.id_tryout', $idto);
        $query = $this->db->get();
        return $query->result_array();
    }


    function get_siswaid(){
        $penggunaID = $this->session->userdata['id'];

        $this->db->select('id');
        $this->db->from('tb_siswa');
        $this->db->where('penggunaID',$penggunaID);
        $query = $this->db->get();
        return $query->result_array()[0]['id'];
    }

    function get_token(){
        $siswaID = $this->get_siswaid();
        $this->db->select('*,id as tokenid');
        $this->db->from('tb_token');
        $this->db->where('siswaID', $siswaID);
        $query = $this->db->get();
        if ($query->result_array()) {
            return $query->result_array()[0];
        }else{
            return false;
        }
    }

    // get jumlah siswa untuk footer pagination
    function jumlah_siswa(){
        $this->db->where('status','1');
        return $this->db->get('tb_siswa')->num_rows();
    }

    // get data siswa per segment
    function data_siswa($number,$offset){
        $this->db->select('s.id as idsiswa,s.namaDepan,s.namaBelakang,s.alamat,s.noKontak,s.namaSekolah,s.alamatSekolah,s.penggunaID,p.namaPengguna,p.eMail,cabang.namaCabang');
        $this->db->join('tb_pengguna p', 's.penggunaID = p.id');
        $this->db->join('tb_cabang cabang','cabang.id = s.cabangID');
        $this->db->where('s.status','1');
        $this->db->where('p.status','1');
        $this->db->order_by('s.namaDepan', 'asc');
        return $query = $this->db->get('tb_siswa s',$number,$offset)->result_array();       
    }
    //cari Siswa

    public function get_cari_siswa($data)
    {   
        $this->db->select('s.id as idsiswa,s.namaDepan,s.namaBelakang,p.namaPengguna,s.penggunaID');
        $this->db->from('tb_siswa s');
        $this->db->join('tb_pengguna p','p.id=s.penggunaID');

        $this->db->like('namaDepan',$data);
        $this->db->or_like('namaBelakang',$data);
        $this->db->or_like('p.namaPengguna',$data);

        $this->db->where('s.status',1);
        $query = $this->db->get();
        return $query->result_array();
    }




    public function persentasi(){
        $id = $this->session->userdata('id');
        $query = "SELECT topikID AS top,`namaTopik` , 
        COUNT(`stepID`) AS stepDone, 
        (SELECT COUNT(id) FROM `tb_line_step` ls
        WHERE ls.topikID = top) AS jumlah_step  FROM(
        SELECT * FROM tb_line_log l WHERE l.`penggunaID` = $id) hasil
        JOIN `tb_line_step` s ON s.`id` = hasil.stepID
        JOIN `tb_line_topik` t ON t.`id` = s.`topikID`
        GROUP BY topikID
        ORDER BY topikID
        ";
        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function persentasi_limit($data){
        if ($this->session->userdata('HAKAKSES')=='ortu') {
            $id = $this->session->userdata('NAMAORTU');  
        }else{
            $id = $this->session->userdata('USERNAME');  
        } 
        $query = "SELECT topikID AS top,babID,`namaTopik` , 
        COUNT(`stepID`) AS stepDone, 
        (SELECT COUNT(id) FROM `tb_line_step` ls
        WHERE ls.topikID = top) AS jumlah_step  FROM(
        SELECT pp.`namaPengguna`, l.`stepID` FROM tb_line_log l JOIN tb_pengguna pp ON l.`penggunaID`=pp.`id` WHERE pp.`namaPengguna` = '$id') hasil
        JOIN `tb_line_step` s ON s.`id` = hasil.stepID
        JOIN `tb_line_topik` t ON t.`id` = s.`topikID`
        GROUP BY topikID
        ORDER BY topikID
        limit $data
        ";
        $result = $this->db->query($query);
        return $result->result_array();
    }


    //get nama pengguna untuk reset katasandi
    public function get_namaPengguna($id){
        $this->db->select('namaPengguna');
        $this->db->from('tb_pengguna');
        $this->db->where('id',$id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_limit_persentase_latihan($data){
        if ($this->session->userdata('HAKAKSES')=='ortu') {
            $id = $this->session->userdata('NAMAORTU');  
        }else{
            $id = $this->session->userdata('USERNAME');  
        } 
        $query = "SELECT  bab.`judulBab` ,
        SUM(latihan.jmlh_benar + latihan.jmlh_salah + latihan.jmlh_kosong) AS total_soal,
        SUM(latihan.jmlh_benar) AS total_benar,
        SUM(latihan.jmlh_salah) AS total_salah,
        SUM(latihan.jmlh_kosong) AS total_kosong

        FROM (SELECT * FROM `tb_report-latihan` repo 
        JOIN `tb_pengguna` `pengguna` ON `pengguna`.id = `repo`.`id_pengguna` WHERE `namaPengguna` = '$id') AS latihan
        JOIN `tb_mm_sol_lat` mmsol ON mmsol.`id_latihan` = latihan.id_latihan
        JOIN `tb_latihan` l ON l.`id_latihan` = latihan.id_latihan
        JOIN `tb_banksoal` bank ON bank.`id_soal` = mmsol.`id_soal`
        JOIN `tb_subbab` sub ON bank.`id_subbab` = sub.`id`
        JOIN tb_bab bab ON bab.`id` = sub.`babID`
        GROUP BY bab.`id`
        ORDER BY total_soal DESC

        limit $data
        ";
        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function sum_cari_siswa($key='')
    {
        $this->db->select('s.id');
        $this->db->from('tb_siswa s');
        $this->db->join('tb_pengguna p','p.id=s.penggunaID');

        $this->db->like('s.namaDepan',$key);
        $this->db->or_like('s.namaBelakang',$key);
        $this->db->or_like('p.namaPengguna',$key);

        $this->db->where('s.status',1);
        return $this->db->get()->num_rows();
    }

    function data_siswa_cari($number,$offset,$key=''){
        $this->db->select('s.id as idsiswa,s.namaDepan,s.namaBelakang,s.alamat,s.noKontak,s.namaSekolah,s.alamatSekolah,s.penggunaID,p.namaPengguna,p.eMail,cabang.namaCabang');
        $this->db->join('tb_pengguna p', 's.penggunaID = p.id');
        $this->db->join('tb_cabang cabang','cabang.id = s.cabangID');
        $this->db->like('s.namaDepan',$key);
        $this->db->or_like('s.namaBelakang',$key);
        $this->db->or_like('p.namaPengguna',$key);
        $this->db->where('s.status','1');
        $this->db->where('p.status','1');
        $this->db->order_by('s.namaDepan', 'asc');
        return $query = $this->db->get('tb_siswa s',$number,$offset)->result_array();       
    }
    public function get_kelas()
    {
        $this->db->select('id,aliasTingkat as kelas');
        $this->db->from('tb_tingkat');
        $this->db->where('status',2);
        $query=$this->db->get();
        return $query->result_array();

    }
    public function get_tingkat_siswa($status,$tingkatID)
    {
        $this->db->select('id,aliasTingkat');
        $this->db->from('tb_tingkat');
        $this->db->where('status',$status);
        $this->db->where('depedensi',$tingkatID);
        $query=$this->db->get();
        return $query->result_array();
    }

    public function get_pesan() {
         $limit = 3; 
        if ($this->session->userdata('HAKAKSES')=='ortu') {
            $penggunaID  = $this->session->userdata('NAMAORTU');  
        }else{
            $penggunaID  = $this->session->userdata('USERNAME');
        } 
        
        $query = "SELECT l.isi, j.nama, j.id_ortu, l.jenis 
                    FROM (SELECT s.id AS id_siswa, s.`namaBelakang` AS nama, o.id AS id_ortu 
                    FROM tb_siswa s 
                    JOIN `tb_orang_tua` o ON s.`id` = o.`siswaID` 
                    JOIN `tb_pengguna` peng ON `peng`.`id` = `s`.`penggunaID`
                    WHERE `peng`.`namaPengguna`='$penggunaID') AS j 
                    JOIN `tb_laporan_ortu` l ON j.id_ortu = l.`id_ortu` WHERE l.`id_ortu` = j.id_ortu
                    ORDER BY `l`.`id` DESC
                    LIMIT $limit";
        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function get_siswa_id($pengguna='')
    {
        $this->db->select('o.id as id_ortu, s.penggunaID');
        $this->db->from('tb_siswa s');
        $this->db->join('tb_orang_tua o', 's.id=o.siswaID');
        $this->db->where('s.penggunaID',$pengguna);
        $query = $this->db->get();
        return $query->result_array();
    }

    // tampil pesan untuk siswa
    public function get_daftar_pesan()
    {
        $penggunaID = $this->session->userdata['id'];
        $query = "SELECT l.id, l.`jenis`, l.`isi`, os.namaPengguna, l.UUID FROM (
                SELECT o.id AS id_ortu, p.`namaPengguna` FROM tb_siswa s
                JOIN `tb_orang_tua` o
                ON s.id= o.`siswaID` 
                JOIN `tb_pengguna` p
                ON s.`penggunaID`=p.id
                WHERE s.penggunaID=$penggunaID)
                AS os JOIN `tb_laporan_ortu` l
                ON os.id_ortu=l.`id_ortu`
                WHERE l.read_status_siswa=0
                ORDER BY l.id DESC
                limit 3";
        $result = $this->db->query($query);
        return $result->result_array();
    }

    // ambil jumlah pesan untuk siswa
    public function get_count()
    {
        $penggunaID = $this->session->userdata['id'];
        $query = "SELECT COUNT(*) AS `numrows` FROM
                ( SELECT o.`id` AS id_ortu FROM tb_siswa s
                JOIN `tb_orang_tua` o
                ON s.id=o.`siswaID`
                WHERE s.penggunaID=$penggunaID) AS os
                JOIN `tb_laporan_ortu` l
                WHERE l.read_status_siswa='0' AND os.id_ortu = l.`id_ortu`";
        $result = $this->db->query($query);
        return $result->result_array()[0]['numrows'];
    }

    // update statu read siswa jadi 1
    public function update_read_siswa($UUID)
    {
        $this->db->set('read_status_siswa',1);
        $this->db->where('UUID', $UUID);
        $this->db->update('tb_laporan_ortu');
    }
}

?>