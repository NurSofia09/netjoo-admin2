<?php

/**
 *
 */
class Testimoni extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mtestimoni');
        $this->load->helper('session');
        $this->load->library('parser');
        $this->load->library('sessionchecker');
        //cek login
        $this->sessionchecker->checkloggedin();
        // sessionkonfirm();
        // get_session_siswa();
    }

    public function index() {
        $data['judul_halaman'] = "Pengelolaan Testimoni";
        $data['files'] = array(
            APPPATH . 'modules/testimoni/views/v-daftar-testimoni.php',
        );

        $this->parser->parse('admin/v-index-admin', $data);
    }

    public function ajax_daftar_testimoni() {
        $list = $this->Mtestimoni->tampil_testimoni();

        $data = array();
        $no = 0;
        //mengambil nilai list
        $baseurl = base_url();
        foreach ($list as $list_testi) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $list_testi['namaDepan'] . " " . $list_testi['namaBelakang'];
            $row[] = $list_testi['testimoni'];
            $row[] = $list_testi['date_created'];
            if ($list_testi['publish'] == 1) {
                  $row[] = '<form action="" class="text-center"><input class="drop" type="checkbox" onchange="droptea(' . "" . $list_testi['id_testimoni'] . ')" value="'.$list_testi['publish'].'" checked></form>';
            }else{
                  $row[] = '<form action="" class="text-center"><input class="publish" type="checkbox" onchange="updatea(' . "" . $list_testi['id_testimoni'] . ')" value="'.$list_testi['publish'].'"></form>';
            }
          
//            $row[] = $list_testi['alamat'];
//            $row[] = $list_testi['pesan'];
            $row[] = '<a class="btn btn-sm btn-danger"  title="Hapus" onclick="dropTestimoni(' . "" . $list_testi['id_testimoni'] . ')"><i class="ico-remove"></i></a>';

            $data[] = $row;
        }

        $output = array(
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function deleteTesti() {
        $idtesti= $this->input->post('id_testi');
//        var_dump($idpesan);
        $this->Mtestimoni->hapus_testi($idtesti);
    }

    public function addtestimoni() {
        $data['testimoni'] = $this->input->post('isitestimoni');
        $data['id_user'] = $this->session->userdata['id'];
        $this->Mtestimoni->addtestimoni($data);
    }
    
    public function publishtestimoni() {
        $id = $this->input->post('id_testi');
        $this->Mtestimoni->publishtestimoni($id);
    }
    
    public function disabletestimoni() {
        $id = $this->input->post('id_testi');
        $this->Mtestimoni->disabletestimoni($id);
    }

}

?>
