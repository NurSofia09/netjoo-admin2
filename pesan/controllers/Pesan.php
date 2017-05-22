<?php

/**
 *
 */
class Pesan extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mpesan');
        $this->load->helper('session');
        $this->load->library('parser');

                        $this->load->library('sessionchecker');
        //cek login
        $this->sessionchecker->checkloggedin();
    }

    public function index() {
        $data['judul_halaman'] = "Pengelolaan Pesan";
        $data['files'] = array(
            APPPATH . 'modules/pesan/views/v-daftar-pesan.php',
        );

        $this->parser->parse('admin/v-index-admin', $data);
    }

    public function ajax_daftar_pesan() {
        $list = $this->Mpesan->tampil_pesan();

        $data = array();
        $no = 0;
        //mengambil nilai list
        $baseurl = base_url();
        foreach ($list as $list_pesan) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $list_pesan['name'];
            $row[] = $list_pesan['phone'];
            $row[] = $list_pesan['alamat'];
            $row[] = $list_pesan['pesan'];
            $row[] = $list_pesan['tgl_pesan'];
            $row[] = '<a class="btn btn-sm btn-danger"  title="Hapus" onclick="dropPesan(' . "" . $list_pesan['id_pesan'] . ')"><i class="ico-remove"></i></a>';

            $data[] = $row;
        }

        $output = array(
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function deletePesan() {
        $idpesan = $this->input->post('id_pesan');
//        var_dump($idpesan);
        $this->Mpesan->hapus_pesan($idpesan);
    }

}

?>
