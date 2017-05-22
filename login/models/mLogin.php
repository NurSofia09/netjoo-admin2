<?php
class Mlogin extends CI_Model {
    //put your code here
    public $id_akun;



    public function __construct() {
        parent::__construct();
    }



    public function cekUser($username, $password) {
        $user = $this->db->escape_str($username);
        $this->db->select('*');

        $this->db->from('tb_pengguna pengguna');
        $this->db->where('kataSandi', $password);
        $this->db->where('pengguna.status','1');
        $this->db->where("(namaPengguna='$user' OR eMail='$user')", NULL, FALSE);
        
        $this->db->limit(1);

        

        $query = $this->db->get();

        if ($query->num_rows() == 1) {

            return $query->result(); //if data is true

        } else {

            return false; //if data is wrong

        }

    }



    public function cekUser3($id) {

        $this->db->select('*');

        $this->db->from('tb_pengguna');

        $this->db->where('eMail', $id);
        $this->db->where('status','1');
        $this->db->limit(1);



        $query = $this->db->get();

        if ($query->num_rows() == 1) {

            return $query->result(); //if data is true

        } else {

            return false; //if data is wrong

        }

    }



    public function cekGuru($id) {

        $this->db->select('tb_guru.id,namaDepan,namaBelakang');

        $this->db->from('tb_guru');

        $this->db->where('tb_guru.penggunaID', $id);
        $this->db->where('status','1');
        $this->db->limit(1);



        $query = $this->db->get();

        if ($query->num_rows() == 1) {

            return $query->result(); //if data is true

        } else {

            return false; //if data is wrong

        }

    }



    public function checkUserFb($data = array(), $data2 = array()) {



        $this->db->select('*');

        $this->db->from('tb_pengguna');

        $this->db->where(array('eMail' => $data['email']));



        $cekEmail = $this->db->get();

        $hasil = $cekEmail->num_rows();

        if ($hasil > 0) {

            $tampunganA = $cekEmail->row_array();

            $data['last_akses'] = date("Y-m-d H:i:s");

            $update = $this->db->update('tb_pengguna', $data, array('id' => $tampunganA['id']));

            $userID = $tampunganA['id'];

        } else {

            $this->db->select('id');

            $this->db->from('tb_pengguna');

            $this->db->where(array('oauth_provider' => $data['oauth_provider'], 'oauth_uid' => $data['oauth_uid']));

            $cekAkun = $this->db->get();

            $akun = $cekAkun->num_rows();



            if ($akun > 0) {

                $tampunganB = $cekAkun->row_array();

                $data['last_akses'] = date("Y-m-d H:i:s");

                $update = $this->db->update('tb_pengguna', $data, array('id' => $tampunganB['id']));

                $userID = $tampunganB['id'];

            } else {

                $data['last_akses'] = date("Y-m-d H:i:s");

                $insert = $this->db->insert('tb_pengguna', $data);



                $this->db->select('id');

                $this->db->from('tb_pengguna');

                $this->db->where(array('oauth_provider' => $data['oauth_provider'], 'oauth_uid' => $data['oauth_uid']));

                $pengguna = $this->db->get();

                $tampunganB = $pengguna->row_array();



                $data2['penggunaID'] = $tampunganB['id'];



                $insert = $this->db->insert('tb_siswa', $data2);

                $userID = $this->db->insert_id();

            }

        }

        return $userID ? $userID : FALSE;

    }


    public function get_namaSiswa($idPengguna)
    {
       $this->db->select('namaDepan, namaBelakang');
       $this->db->from('tb_siswa');
       $this->db->where('penggunaID',$idPengguna);
       $query = $this->db->get();

       if ($query->num_rows() == 1) {
            return  $query->result_array()[0]; //if data is true
        } else {
            return array(); //if data is wrong
        }
       
    }

    public function get_ortu($idPengguna)
    {
       $this->db->select('id,namaOrangTua');
       $this->db->from('tb_orang_tua');
       $this->db->where('penggunaID',$idPengguna);
       $query = $this->db->get();

       if ($query->num_rows() == 1) {
            return  $query->result_array()[0]; //if data is true
        } else {
            return array(); //if data is wrong
        }
       
    }
    public function get_ortu2($idortu)
    {
       $this->db->select('*');
       $this->db->from('tb_orang_tua ortu');
       $this->db->join('tb_siswa siswa ',' ortu.siswaID = siswa.id');
       $this->db->join('tb_pengguna peng ',' siswa.penggunaID = peng.id');
       $this->db->where('ortu.id',$idortu);
       $query = $this->db->get();

       if ($query->num_rows() == 1) {
            return  $query->result_array()[0]; //if data is true
        } else {
            return array(); //if data is wrong
        }
       
    }



}

?>