<?php
if ($this->session->userdata['AKTIVASI'] == 0) {
    header("location:" . base_url('index.php/register/verifikasi'));
}
?>