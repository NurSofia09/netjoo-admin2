<?php



class Mregister extends CI_Model {



    //merupakan function untuk menyimpan data guru ke tabel guru di databse Neon  



    public function insert_guru($data_guru) {

        $this->db->insert('tb_guru', $data_guru);



//         if ($this->db->affected_rows() === 1) {

//             $penggunaID = $data_guru['penggunaID'];

//             $this->set_verifikasicode($penggunaID);

//             $this->session->set_userdata($sess_array);

//             $this->send_verifikasi_email();

//         } else {

// //            echo"masuk else"; //for testign

//         }

    }



    //merupakan function untuk menyimpan data guru ke tabel penggunas di databse Neon  

    public function insert_pengguna($data) {



        $this->db->insert('tb_pengguna', $data);

    }



    //merupakan function untuk menyimpan data guru ke tabel siswa di databse Neon  

    public function insert_siswa($data_siswa, $sess_array) {

        $this->db->insert('tb_siswa', $data_siswa);



        if ($this->db->affected_rows() === 1) {

            $penggunaID = $data_siswa['penggunaID'];

            $this->set_verifikasicode($penggunaID);

            $this->session->set_userdata($sess_array);

            $this->send_verifikasi_email();

            // redirect(base_url('index.php/register/verifikasiemail'));

        } else {

//            echo"masuk else";

        }

    }



    //untuk mngambil nilai id penngguna untuk digunakan FK di tb_siswa

    public function get_idPengguna($data) {

        $this->db->where('namaPengguna', $data);

        $this->db->select('id')->from('tb_pengguna');

        $query = $this->db->get();

        return $query->result_array();

    }



    //set verifikasi code untuk memverifikasi email

    private function set_verifikasicode($penggunaID) {

        $sql = "SELECT regTime FROM tb_pengguna WHERE id= '" . $penggunaID . "'";

        $result = $this->db->query($sql);

        $row = $result->row();

        $verifikasiCode = md5((string) $row->regTime);

        $sess_array = array(

            'verifikasiCode' => $verifikasiCode,

        );

        $this->session->set_userdata($sess_array);

    }



    // function untuk mengirim code verifikasi email ke email user/siswa 

    public function send_verifikasi_email() {

        $this->load->library('email'); // load email library

        $verifikasiCode = $this->session->userdata['verifikasiCode'];

        $address = $this->session->userdata['eMail'];

        $this->email->from('noreply@sibejooclass.com', 'Neon');

        $this->email->to($address);

        $this->email->subject('Verifikasi Email');

        $message = '<html><meta/><head/><body>';

        $message .='<p> Dear' . ' ' . $this->session->userdata['USERNAME'] . ',</p>';

        $message .='<p>Terimakasih telah mendaftar di Neon. Untuk dapat menggunakan semua fitur silahkan <strong><a href="' . base_url() . 'index.php/register/verifikasi_email/' . $address . '/' . $verifikasiCode . '">klik disini</a></strong> untuk aktifasi akun mu.</p>';

        $message .= '<p>Terimakasih</p>';

        $message .= '<p>Neon</p>';

        $message .= '</body></html>';

        $this->email->message($message);

        $this->email->send();



//        if ($this->email->send())

////            echo "Mail Sent!"; //untuk testing

//    }else

////            echo "There is error in sending mail!"; //untuk testing

//    }

    }



    public function verifikasi_email($address, $code) {

        $sql = "SELECT regTime FROM tb_pengguna WHERE eMail = '" . $address . "'";

        $result = $this->db->query($sql);

        $row = $result->row();



        if ($result->num_rows() === 1) {

            if (md5((string) $row->regTime) === $code)

                $result = $this->aktifasi_akun($address);

//            if ($result === true) {

//                echo "akun telah di aktifasi"; // for testing

//            } else {

//                echo "gagal di aktifasi"; //for testing

//            }

        } else {

            //xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx

        }

    }



    //funtion updatae aktivasi email 

    public function aktifasi_akun($address) {

        if ($address == $this->session->userdata['eMail']) {

            $this->db->where('eMail', $address);

            $this->db->set('aktivasi', '1');

            $this->db->update('tb_pengguna');

            return true;

        } else {

            return false;

        }

    }



    //cek user dari validasi email

    public function cekUser($email) {

        $this->db->select('*');

        $this->db->from('tb_pengguna');

        $this->db->where('eMail', $email);

        $this->db->limit(1);



        $query = $this->db->get();

        if ($query->num_rows() == 1) {

//            echo "ada akun";

            return $query->result(); //if data is true

        } else {

//            echo 'tidak ada akun';

            return false; //if data is wrong

        }

    }



    //function untuk merubah aktivasi email

    public function update_email_ak($email) {

        $id = $this->session->userdata['id'];

        $this->db->where('id', $id);

        $this->db->set('eMail', $email);

        $this->db->update('tb_pengguna');

        $sess_array = array('eMail' => $email);

        $this->session->set_userdata($sess_array);

    }



    //function unutk dropdown mata pelajran

    public function get_matapelajaran() {

        $this->db->select('id,aliasMataPelajaran')->from('tb_mata-pelajaran');

        $query = $this->db->get();

        return $query->result_array();

    }



    public function send_reset_email($email) {

        $this->set_resetcode($email);

        $this->load->library('email'); // load email library

        $verifikasiCode = $this->verifikasiCode;

        $address = $email;

        $this->email->from('noreply@sibejooclass.com', 'Neon');

        $this->email->to($address);

        $this->email->subject('Reset Password');

        $message = '<html><meta/><head/><body>';

        $message .='<p> Permintaan reset password telah diproses,</p>';

        $message .='<p>Silahkan <strong><a href="' . base_url() . 'index.php/register/verifikasiPassword/' . $address . '/' . $verifikasiCode . '">klik disini</a></strong> untuk melakukan reset password akun anda. </p>';

        $message .= '<p>Terimakasih</p>';

        $message .= '<p>Neon</p>';

        $message .= '</body></html>';

        $this->email->message($message);

        $this->email->send();

//        if ($this->email->send())

//            echo "Mail Sent!"; //untuk testing

//        else

//            echo "There is error in sending mail!"; //untuk testing

    }



    private function set_Resetcode($email) {

        $this->db->select('regTime');

        $this->db->from('tb_pengguna');

        $this->db->where('eMail', $email);

        $this->db->limit(1);



        $result = $this->db->get();

        $row = $result->row();

        $this->verifikasiCode = md5((string) $row->regTime);

    }



    public function verifikasi_password($address, $code) {

        $this->db->select('regTime');

        $this->db->from('tb_pengguna');

        $this->db->where('eMail', $address);

        $this->db->limit(1);

        $result = $this->db->get();

        $row = $result->row();



        if ($result->num_rows() === 1) {

            if (md5((string) $row->regTime) === $code) {

                $this->session->set_userdata('reset_email', $address);

                $this->session->set_userdata('reset_password', '1');

                redirect(base_url('index.php/register/resetpassword'));

            } else {

                redirect(base_url());

            }

        } else {

            redirect(base_url());

        }

    }



    public function reset_katasandi($data) {

        $email = $this->session->userdata['reset_email'];

        $this->db->where('eMail', $email);

        $this->db->set('kataSandi', $data);

        $this->db->update('tb_pengguna');

    }



    //merupakan function untuk menyimpan data guru ke tabel siswa di databse Neon  

    public function insert_siswabyadmin($data_siswa, $email, $username) {

        $this->db->insert('tb_siswa', $data_siswa);

        if ($this->db->affected_rows() === 1) {

            $penggunaID = $data_siswa['penggunaID'];

            $code = $this->set_verifikasicodebyadmin($penggunaID);

            $this->send_verifikasi_emailbyadmin($code, $email, $username);

            $this->session->set_flashdata('notif', ' Data siswa telah berhasil dibuat');

        } else {

            $this->session->set_flashdata('notif', ' Data siswa gagal dibuat');

        }

    }



    //set verifikasi code untuk memverifikasi email

    private function set_verifikasicodebyadmin($penggunaID) {

        $sql = "SELECT regTime FROM tb_pengguna WHERE id= '" . $penggunaID . "'";

        $result = $this->db->query($sql);

        $row = $result->row();

        $verifikasiCode = md5((string) $row->regTime);



        return $verifikasiCode;

    }



    public function send_verifikasi_emailbyadmin($code, $email, $username) {

        $this->load->library('email'); // load email library

        $verifikasiCode = $code;

        $address = $email;

        $this->email->from('noreply@sibejooclass.com', 'Neon');

        $this->email->to($address);

        $this->email->subject('Verifikasi Email');

        $message = '<html><meta/><head/><body>';

        $message .='<p> Dear' . ' ' . $username . ',</p>';

        $message .='<p>Terimakasih telah mendaftar di Neon. Untuk dapat menggunakan semua fitur silahkan <strong><a href="' . base_url() . 'index.php/register/verifikasi_email/' . $address . '/' . $verifikasiCode . '">klik disini</a></strong> untuk aktifasi akun mu.</p>';

        $message .= '<p>Terimakasih</p>';

        $message .= '<p>Neon</p>';

        $message .= '</body></html>';

        $this->email->message($message);

        $this->email->send();



//        if ($this->email->send())

////            echo "Mail Sent!"; //untuk testing

//    }else

////            echo "There is error in sending mail!"; //untuk testing

//    }

    }


    public function get_guruID_by_penggunaID($penggunaID='')
    {
        $this->db->select('id');
        $this->db->from('tb_guru');
        $this->db->where('penggunaID',$penggunaID);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function in_guruMapel($datArr='')
    {
       $this->db->insert('tb_mm-gurumapel', $datArr);
    }



}



?>