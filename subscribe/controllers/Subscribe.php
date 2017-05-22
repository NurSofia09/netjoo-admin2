<?php

/**
 *
 */
class Subscribe extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Msubscribe');
        $this->load->helper('session');
        $this->load->library('parser');

        // sessionkonfirm();
        // get_session_siswa();
    }

    public function index() {
        $data['judul_halaman'] = "Pengelolaan Subscribe";
        $data['files'] = array(
            APPPATH . 'modules/subscribe/views/v-kirim-berita.php',
        );

        $this->parser->parse('admin/v-index-admin', $data);
    }

    public function ajax_daftar_subs() {
        $list = $this->Msubscribe->tampil_subs();

        $data = array();
        $no = 0;
        //mengambil nilai list
        $baseurl = base_url();
        foreach ($list as $list_subs) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $list_subs['email'];
            $row[] = '<a class="btn btn-sm btn-danger"  title="Hapus" onclick="dropSubs(' . "" . $list_subs['id'] . ')"><i class="ico-remove"></i></a>';
            $data[] = $row;
        }

        $output = array(
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function deleteSubs() {
        $idsubs = $this->input->post('id_subs');
        $this->Msubscribe->hapus_subs($idsubs);
    }

    public function addberita() {
        $data['judul'] = $this->input->post('judul');
        $data['isiberita'] = $this->input->post('editor1');
        $data['create_by'] = $this->session->userdata['USERNAME'];
        $this->Msubscribe->addberita($data);
        $this->kirimberita($data);
        redirect(base_url('subscribe'));
    }

    function kirimberita($datas) {
        $this->load->library('email');
        $sukses = 0;
        $gagal = 0;
        //Data penerima email
        $data['email'] = $this->Msubscribe->get_emailsubs();

        foreach ($data['email'] as $key) {
            $this->email->clear();
            $this->email->from('noreply@sibejooclass.com', 'Neon');
            $this->email->to($key['emailsub']);
            $this->email->subject($datas['judul']);

            $message = '<html><meta/><head/><body>';

            $message .= $datas['isiberita'];

            $message .= '</body></html>';

            $this->email->message($message);


//
            if ($this->email->send()) {
//                echo "Mail Sent!"; //untuk testing
//                $this->session->set_flashdata('notif', ' Berita Telah Terkirim');
                $sukses++;
            } else {
//                echo "There is error in sending mail!";
//                $this->session->set_flashdata('notif', ' Berita gagal Terkirim');
                $gagal++;
            }
            $this->session->set_flashdata('notif', ' Berita Telah Terkirim, Berita sukses terkirim ' . $sukses . ' , berita gagal terkirim ' . $gagal);
        }
    }

    function daftarsubs() {
        $data['judul_halaman'] = "Pengelolaan Subscribe";
        $data['files'] = array(
            APPPATH . 'modules/subscribe/views/v-daftar-subscribe.php',
        );

        $this->parser->parse('admin/v-index-admin', $data);
    }

}

?>
