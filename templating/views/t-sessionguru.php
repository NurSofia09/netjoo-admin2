<?php
if (empty($this->session->userdata['HAKAKSES'])) {
    header("location:" . base_url('index.php/login'));
} else {
    if ($this->session->userdata['HAKAKSES'] == 'siswa') {
        header("location:" . base_url('index.php/welcome'));
    } else if ($this->session->userdata['HAKAKSES'] == 'admin') {
        header("location:" . base_url('index.php/welcome'));
    }
}
?>