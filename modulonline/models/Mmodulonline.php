<?php

/**
 * 
 */
class Mmodulonline extends CI_Model {
    # Start Function untuk form soal#	

    public function insert_soal($dataSoal) {
        $this->db->insert('tb_modul', $dataSoal);
    }

    public function get_soalID($UUID) {
        $this->db->where('UUID', $UUID);
        // $this->db->where('publish', 1);
        // $this->db->where('status', 1);
        
        $this->db->select('id_soal')->from('tb_banksoal');
        $query = $this->db->get();
        return $query->result_array();
    }

    //insert pilihan jawaban berupa text
    public function insert_jawaban($dataJawaban) {
        $this->db->insert_batch('tb_piljawaban', $dataJawaban);
    }


    //insert pilihan jawaban berupa gambar
    public function insert_gambar($datagambar) {
        $this->db->insert_batch('tb_piljawaban', $datagambar);
        echo "masuk insert gambar";
        var_dump($datagambar);
    }

    # END Function untuk form soal#

    public function get_pelajaran($tingkatID) {
        $this->db->where('tingkatID', $tingkatID);
        $this->db->select('*')->from('tb_tingkat-pelajaran');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_bab($tingkatPelajaranID) {
        $this->db->where('tingkatPelajaranID', $tingkatPelajaranID);
        $this->db->select('*')->from('tb_bab');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_subbab($babID) {
        $this->db->where('babID', $babID);
        $this->db->select('*')->from('tb_subbab');
        $query = $this->db->get();
        return $query->result_array();
    }
    // get data soal persobbab
    public function get_soal($subbID) {
        $this->db->select('id_soal,sumber,kesulitan,judul_soal,jawaban,UUID,publish,random,soal,tp.keterangan,soal.id_subbab');
        $this->db->from('tb_tingkat-pelajaran tp');
        $this->db->join('tb_bab bab','bab.tingkatPelajaranID=tp.id');
        $this->db->join('tb_subbab subbab','subbab.babID = bab.id');
        $this->db->join('tb_banksoal soal', 'subbab.id = soal.id_subbab');
        $this->db->where('id_subbab', $subbID);
        $this->db->where('soal.status','1');
        $query = $this->db->get();
        return $query->result_array();
    }
 
    //get pilihan berdasarkan subbab MP
    public function get_pilihan($subbID) {
        $this->db->select('*,pil.id_soal as pilID, soal.id_soal as soalID, pil.jawaban as jawabanBenar');
        $this->db->from('tb_banksoal soal');
        $this->db->join('tb_piljawaban pil', ' pil.id_soal= soal.id_soal');
        $this->db->where('id_subbab', $subbID);
        $query = $this->db->get();
        return $query->result_array();
    }
    // get soal per baba
    public function get_soal_bab($babID) {
        $this->db->select('id_soal,sumber,kesulitan,judul_soal,jawaban,UUID,publish,random,soal,tp.keterangan,soal.id_subbab,judulSubBab');
        $this->db->from('tb_tingkat-pelajaran tp');
        $this->db->join('tb_bab bab','bab.tingkatPelajaranID=tp.id');
        $this->db->join('tb_subbab subbab','subbab.babID = bab.id');
        $this->db->join('tb_banksoal soal', 'subbab.id = soal.id_subbab');
        $this->db->where('bab.id', $babID);
        $this->db->where('soal.status','1');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    //get pilihan berdasarkan bab
    public function get_pilihan_bab($babID) {
        $this->db->select('*,pil.id_soal as pilID, soal.id_soal as soalID, pil.jawaban as jawabanBenar');
        $this->db->from('tb_banksoal soal');
        $this->db->join('tb_piljawaban pil', ' pil.id_soal= soal.id_soal');
        $this->db->join('tb_subbab sub', 'sub.id = soal.id_subbab');
        $this->db->join('tb_bab bab','sub.babID = bab.id');
        $this->db->where('bab.id', $babID);
        $query = $this->db->get();
        return $query->result_array();
    }
    // get soal per matapelajaran
    public function get_soal_mp($idMp) {

        $this->db->select('mdl.id, mdl.judul, mdl.deskripsi, mdl.url_file, mdl.publish');
        $this->db->from('tb_modul as mdl');
        $this->db->where('mdl.status','1');
        $this->db->where('mdl.id_tingkatpelajaran', $idMp);


        // $this->db->select('id_soal,sumber,kesulitan,judul_soal,jawaban,UUID,publish,random,soal,tp.keterangan,soal.id_subbab,judulBab');
        // $this->db->from('tb_tingkat-pelajaran tp');
        // $this->db->join('tb_bab bab','bab.tingkatPelajaranID=tp.id');
        // $this->db->join('tb_subbab subbab','subbab.babID = bab.id');
        // $this->db->join('tb_banksoal soal', 'subbab.id = soal.id_subbab');
       
        // $this->db->where('soal.status','1');
        $query = $this->db->get();
        return $query->result_array();
     
    }
      // get soal per tingkat
    public function get_soal_tkt($tingkatID) {
        $this->db->select('mdl.id, mdl.judul, mdl.deskripsi, mdl.url_file, mdl.publish');
        $this->db->from('tb_modul as mdl');
        $this->db->join('tb_tingkat-pelajaran tp','tp.id = mdl.id_tingkatpelajaran');
        // $this->db->join('tb_bab bab','bab.tingkatPelajaranID=tp.id');
        // $this->db->join('tb_subbab subbab','subbab.babID = bab.id');
        // $this->db->join('tb_banksoal soal', 'subbab.id = soal.id_subbab');
        $this->db->where('mdl.status','1');
        $this->db->where('tp.tingkatID', $tingkatID);

        $query = $this->db->get();
        return $query->result_array();
     
    }
    public function ch_soal($data) {
        $this->db->set($data['dataSoal']);
        $this->db->where('uuid', $data['uuid']);
        $this->db->update('tb_modul');
    }

    public function get_onesoal($uuid) {
        $this->db->where('uuid', $uuid);
        $this->db->select('*')->from('tb_modul');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_piljawaban($id_soal) {
        $this->db->where('id_soal', $id_soal);
        $this->db->select('*')->from('tb_piljawaban');
        $query = $this->db->get();
        return $query->result_array();
    }

    //get old gambar soal

    public function get_oldgambar_soal($UUID)
    {
        $this->db->where('uuid', $UUID);
        $this->db->select('id,url_file')->from('tb_modul');
        $query = $this->db->get();
        return $query->result_array();
    }

    //get old gambar pilihan jawaban
    public function get_oldgambar($soalID) {
        $this->db->where('id_soal', $soalID);
        $this->db->select('id_pilihan,gambar')->from('tb_piljawaban');
        $query = $this->db->get();
        return $query->result_array();
    }

    //function untuk update pilihan jawaban text
    public function ch_jawaban($data) {
        $this->db->where('id_soal',$data['id_soal']);
        $this->db->update_batch('tb_piljawaban', $data['dataJawaban'], 'pilihan');
    }

    public function ch_gambar($datagambar) {
        $this->db->update_batch('tb_piljawaban', $datagambar, 'id_pilihan');
        // var_dump($datagambar);
    }

    # END Function untuk form update soal#
    # Start Function untuk form delete bank soal#
    //dalam pengahapusan data bank soal tidak benar2 di hapus tetapi status di rubah dari 1 -> 0

    public function del_banksoal($data) {
        $this->db->where('id', $data);
        $this->db->set('status', '0');
        $this->db->update('tb_modul');
    }

    # END Function untuk form delete bank soal#

    //
    public function get_allsoal()
    {

        $this->db->select('mdl.id, mdl.judul, mdl.deskripsi, mdl.url_file, mdl.publish,mdl.uuid,mdl.id_tingkatpelajaran');
        $this->db->from('tb_modul as mdl');
        $this->db->where('mdl.status','1');

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_allpilihan()
    {
        $this->db->select('*,pil.id_soal as pilID, soal.id_soal as soalID, pil.jawaban as jawabanBenar');
        $this->db->from('tb_banksoal soal');
        $this->db->join('tb_piljawaban pil', ' pil.id_soal= soal.id_soal');
        $query = $this->db->get();
        return $query->result_array();
    }

    #ambil soal yang belum terdaftar dalam paket soal.
    public function get_soal_terdaftar($data){
       $paket = $data['id_paket'];
         $subBabId = $data['subBabId'];   
              
        $myquery ="SELECT * FROM `tb_banksoal` bank
            WHERE bank.publish = 1
            AND bank.id_subbab = $subBabId
            AND bank.jawaban <>''
            AND bank.status = 1
            AND bank.id_soal NOT IN
            (
             SELECT pb.`id_soal`
             FROM `tb_banksoal` b
             JOIN `tb_mm-paketbank` pb 
             ON pb.`id_soal`= b.`id_soal`
             JOIN `tb_paket` p ON
             p.`id_paket` = pb.`id_paket`
            AND p.`id_paket` = $paket
           )"
            ;

    $result = $this->db->query($myquery);
    
    return $result->result_array();
    }

    // hitung jumlah pilihan berdasarkan id
    public function get_count_pilihan($id_soal)
    {
        $this->db->where('id_soal',$id_soal);
        $this->db->from('tb_piljawaban');
        $count= $this->db->count_all_results();
        // var_dump($num_rows) ;
        return $count;
    }

    // delete one piljawaban by id_soal
    public function del_oneJawaban($id_soal)
    {   
        $this->db->where('id_soal', $id_soal);
        $this->db->where('pilihan','E');
        $this->db->delete('tb_piljawaban');
        // var_dump($data['dataJawaban']);
    }
    // add one piljawaban by id_soal
    public function add_oneJawaban($pil_E)
    {
       $this->db->insert('tb_piljawaban',$pil_E);
        // var_dump($data['dataJawaban']);
    }

    // get info data soal berdasarkan bab
    public function get_judulBab($bab)
    {
        $this->db->select('judulBab,tingkatPelajaranID');
        $this->db->from('tb_bab');
        $this->db->where('id',$bab);
        $query = $this->db->get();
        return $query->result()[0];
    }
    //get nama mp untuk judul halaman
    public function get_namaMp($tingkatPelajaranID)
    {
          $this->db->select('keterangan');
        $this->db->from('tb_tingkat-pelajaran');
        $this->db->where('id',$tingkatPelajaranID);
        $query = $this->db->get();
        return $query->result()[0]->keterangan;
    }
    // get data sub
    public function dat_sub($subBab)
    {
        $this->db->select('judulSubBab,babID');
        $this->db->from('tb_subbab');
        $this->db->where('id',$subBab);
        $query = $this->db->get();
        return $query->result()[0];
    }

    public function get_namaTingkat($tingkatPelajaranID)
    {
        $this->db->select('aliasTingkat');
        $this->db->from('tb_tingkat');
        $this->db->where('id',$tingkatPelajaranID);
        $query = $this->db->get();
        return $query->result()[0]->aliasTingkat;
    }
    // mengetahui info tingkat soal
    public function get_info_soal($tingkatID)
    {
        $this->db->select('tkt.id as id_tingkat ,aliasTingkat,tp.id as id_mp,tp.keterangan as mp');
        $this->db->from('tb_tingkat tkt' );
        $this->db->join('tb_tingkat-pelajaran tp','tp.tingkatID=tkt.id');
        $this->db->where('tp.id',$tingkatID);
        $query = $this->db->get();
        return $query->result_array()[0];
    }

    /*
     * get rows from the posts table
     */
    function getRows($params = array()){

        // $this->db->select('mdl.id, mdl.judul, mdl.deskripsi, mdl.url_file, mdl.publish,mdl.uuid,mdl.id_tingkatpelajaran');
        // $this->db->from('tb_modul as mdl');
        // $this->db->where('mdl.status','1');

        // $query = $this->db->get();
        // return $query->result_array();

        $this->db->select('*');
        $this->db->from('tb_modul');

        //filter data by searched keywords
        if(!empty($params['search']['keywords'])){
            $this->db->like('judul',$params['search']['keywords']);
        }

        //sort data by ascending or desceding order
        if(!empty($params['search']['sortBy'])){
            switch ($params['search']['sortBy']) {
                case 'date_created':
                    $this->db->order_by($params['search']['sortBy'],'desc');
                    break;
                case 'asc':
                    $this->db->order_by('judul','asc');
                    break;
                case 'desc':
                    $this->db->order_by('judul','desc');
                    break;
                echo $output; // The output should be: 0.7
            }
        }else{
            $this->db->order_by('id','desc');
        }

        //set start and limit
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        //get records
        $query = $this->db->get();
        //return fetched data
        return ($query->num_rows() > 0)?$query->result_array():FALSE;
    }
    
    public function tambahdownload($id,$temp){

        $this->db->set('download',$temp);

        $this->db->where('id', $id);

        $this->db->update('tb_modul');
    }

    public function ambilnilai($id)
    {
        $this->db->select('download');
        $this->db->from('tb_modul');
        $this->db->where('id',$id);
        $query = $this->db->get();
        return $query->result_array()[0];
    }

     public function get_modulteratas(){
        $this->db->select('mdl.id, mdl.judul, mdl.deskripsi, mdl.url_file, mdl.publish,mdl.uuid,mdl.id_tingkatpelajaran,mdl.download');
        $this->db->from('tb_modul as mdl');
        $this->db->where('mdl.status','1');
        $this->db->order_by('download desc'); 
        $this->db->limit(2);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function modulsd(){
        $this->db->select('mdl.id, mdl.judul, mdl.deskripsi, mdl.url_file, mdl.publish,mdl.uuid,mdl.id_tingkatpelajaran,tp.id');
        $this->db->from('tb_modul as mdl');
        $this->db->join('tb_tingkat-pelajaran as tp','tp.id = mdl.id_tingkatpelajaran');
        $this->db->where('mdl.status','1');
        $this->db->where('tp.tingkatID','1');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function modulsmp(){
        $this->db->select('mdl.id, mdl.judul, mdl.deskripsi, mdl.url_file, mdl.publish,mdl.uuid,mdl.id_tingkatpelajaran,tp.id');
        $this->db->from('tb_modul as mdl');
        $this->db->join('tb_tingkat-pelajaran as tp','tp.id = mdl.id_tingkatpelajaran');
        $this->db->where('mdl.status','1');
        $this->db->where('tp.tingkatID','2');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function modulsma(){
        $this->db->select('mdl.id, mdl.judul, mdl.deskripsi, mdl.url_file, mdl.publish,mdl.uuid,mdl.id_tingkatpelajaran,tp.id');
        $this->db->from('tb_modul as mdl');
        $this->db->join('tb_tingkat-pelajaran as tp','tp.id = mdl.id_tingkatpelajaran');
        $this->db->where('mdl.status','1');
        $this->db->where('tp.tingkatID','3');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function modulsmaipa(){
        $this->db->select('mdl.id, mdl.judul, mdl.deskripsi, mdl.url_file, mdl.publish,mdl.uuid,mdl.id_tingkatpelajaran,tp.id');
        $this->db->from('tb_modul as mdl');
        $this->db->join('tb_tingkat-pelajaran as tp','tp.id = mdl.id_tingkatpelajaran');
        $this->db->where('mdl.status','1');
        $this->db->where('tp.tingkatID','4');
        $query = $this->db->get();
        return $query->result_array();
    }


    public function modulsmaips(){
        $this->db->select('mdl.id, mdl.judul, mdl.deskripsi, mdl.url_file, mdl.publish,mdl.uuid,mdl.id_tingkatpelajaran,tp.id');
        $this->db->from('tb_modul as mdl');
        $this->db->join('tb_tingkat-pelajaran as tp','tp.id = mdl.id_tingkatpelajaran');
        $this->db->where('mdl.status','1');
        $this->db->where('tp.tingkatID','5');
        $query = $this->db->get();
        return $query->result_array();
    }


      function getRowssd($params = array()){

        $this->db->select('mdl.id, mdl.judul, mdl.deskripsi, mdl.url_file, mdl.publish,mdl.uuid,mdl.id_tingkatpelajaran,tp.id');
        $this->db->from('tb_modul as mdl');
        $this->db->join('tb_tingkat-pelajaran as tp','tp.id = mdl.id_tingkatpelajaran');
        $this->db->where('mdl.status','1');
        $this->db->where('tp.tingkatID','1');
        
        //filter data by searched keywords
        if(!empty($params['search']['keywords'])){
            $this->db->like('judul',$params['search']['keywords']);
            $this->db->where('mdl.status','1');
            $this->db->where('tp.tingkatID','1');
        }

        //sort data by ascending or desceding order
        if(!empty($params['search']['sortBy'])){
            switch ($params['search']['sortBy']) {
                case 'date_created':
                    $this->db->order_by($params['search']['sortBy'],'desc');
                    break;
                case 'asc':
                    $this->db->order_by('mdl.judul','asc');
                    break;
                case 'desc':
                    $this->db->order_by('mdl.judul','desc');
                    break;
                echo $output; // The output should be: 0.7
            }
        }else{
            $this->db->order_by('mdl.id','desc');
        }

        //set start and limit
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        //get records

        $query = $this->db->get();
        //return fetched data
        return ($query->num_rows() > 0)?$query->result_array():FALSE;
    }

    function getRowssmp($params = array()){

        $this->db->select('mdl.id, mdl.judul, mdl.deskripsi, mdl.url_file, mdl.publish,mdl.uuid,mdl.id_tingkatpelajaran,tp.id');
        $this->db->from('tb_modul as mdl');
        $this->db->join('tb_tingkat-pelajaran as tp','tp.id = mdl.id_tingkatpelajaran');
        $this->db->where('mdl.status','1');
        $this->db->where('tp.tingkatID','2');
        
        //filter data by searched keywords
        if(!empty($params['search']['keywords'])){
            $this->db->like('judul',$params['search']['keywords']);
            $this->db->where('mdl.status','1');
            $this->db->where('tp.tingkatID','2');
        }

        //sort data by ascending or desceding order
        if(!empty($params['search']['sortBy'])){
            switch ($params['search']['sortBy']) {
                case 'date_created':
                    $this->db->order_by($params['search']['sortBy'],'desc');
                    break;
                case 'asc':
                    $this->db->order_by('mdl.judul','asc');
                    break;
                case 'desc':
                    $this->db->order_by('mdl.judul','desc');
                    break;
                echo $output; // The output should be: 0.7
            }
        }else{
            $this->db->order_by('mdl.id','desc');
        }

        //set start and limit
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        //get records

        $query = $this->db->get();
        //return fetched data
        return ($query->num_rows() > 0)?$query->result_array():FALSE;
    }

    function getRowssma($params = array()){

        $this->db->select('mdl.id, mdl.judul, mdl.deskripsi, mdl.url_file, mdl.publish,mdl.uuid,mdl.id_tingkatpelajaran,tp.id');
        $this->db->from('tb_modul as mdl');
        $this->db->join('tb_tingkat-pelajaran as tp','tp.id = mdl.id_tingkatpelajaran');
        $this->db->where('mdl.status','1');
        $this->db->where('tp.tingkatID','3');
        
        //filter data by searched keywords
        if(!empty($params['search']['keywords'])){
            $this->db->like('judul',$params['search']['keywords']);
            $this->db->where('mdl.status','1');
            $this->db->where('tp.tingkatID','3');
        }

        //sort data by ascending or desceding order
        if(!empty($params['search']['sortBy'])){
            switch ($params['search']['sortBy']) {
                case 'date_created':
                    $this->db->order_by($params['search']['sortBy'],'desc');
                    break;
                case 'asc':
                    $this->db->order_by('mdl.judul','asc');
                    break;
                case 'desc':
                    $this->db->order_by('mdl.judul','desc');
                    break;
                echo $output; // The output should be: 0.7
            }
        }else{
            $this->db->order_by('mdl.id','desc');
        }

        //set start and limit
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        //get records

        $query = $this->db->get();
        //return fetched data
        return ($query->num_rows() > 0)?$query->result_array():FALSE;
    }

     function getRowssmaipa($params = array()){

        $this->db->select('mdl.id, mdl.judul, mdl.deskripsi, mdl.url_file, mdl.publish,mdl.uuid,mdl.id_tingkatpelajaran,tp.id');
        $this->db->from('tb_modul as mdl');
        $this->db->join('tb_tingkat-pelajaran as tp','tp.id = mdl.id_tingkatpelajaran');
        $this->db->where('mdl.status','1');
        $this->db->where('tp.tingkatID','4');
        
        //filter data by searched keywords
        if(!empty($params['search']['keywords'])){
            $this->db->like('judul',$params['search']['keywords']);
            $this->db->where('mdl.status','1');
            $this->db->where('tp.tingkatID','4');
        }

        //sort data by ascending or desceding order
        if(!empty($params['search']['sortBy'])){
            switch ($params['search']['sortBy']) {
                case 'date_created':
                    $this->db->order_by($params['search']['sortBy'],'desc');
                    break;
                case 'asc':
                    $this->db->order_by('mdl.judul','asc');
                    break;
                case 'desc':
                    $this->db->order_by('mdl.judul','desc');
                    break;
                echo $output; // The output should be: 0.7
            }
        }else{
            $this->db->order_by('mdl.id','desc');
        }

        //set start and limit
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        //get records

        $query = $this->db->get();
        //return fetched data
        return ($query->num_rows() > 0)?$query->result_array():FALSE;
    }

     function getRowssmaips($params = array()){

        $this->db->select('mdl.id, mdl.judul, mdl.deskripsi, mdl.url_file, mdl.publish,mdl.uuid,mdl.id_tingkatpelajaran,tp.id');
        $this->db->from('tb_modul as mdl');
        $this->db->join('tb_tingkat-pelajaran as tp','tp.id = mdl.id_tingkatpelajaran');
        $this->db->where('mdl.status','1');
        $this->db->where('tp.tingkatID','5');
        
        //filter data by searched keywords
        if(!empty($params['search']['keywords'])){
            $this->db->like('judul',$params['search']['keywords']);
            $this->db->where('mdl.status','1');
            $this->db->where('tp.tingkatID','5');
        }

        //sort data by ascending or desceding order
        if(!empty($params['search']['sortBy'])){
            switch ($params['search']['sortBy']) {
                case 'date_created':
                    $this->db->order_by($params['search']['sortBy'],'desc');
                    break;
                case 'asc':
                    $this->db->order_by('mdl.judul','asc');
                    break;
                case 'desc':
                    $this->db->order_by('mdl.judul','desc');
                    break;
                echo $output; // The output should be: 0.7
            }
        }else{
            $this->db->order_by('mdl.id','desc');
        }

        //set start and limit
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        //get records

        $query = $this->db->get();
        //return fetched data
        return ($query->num_rows() > 0)?$query->result_array():FALSE;
    }


}

?>