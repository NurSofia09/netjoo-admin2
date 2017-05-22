<?php
if (!empty($this->session->userdata['HAKAKSES'])) {
    if ($this->session->userdata['HAKAKSES'] == 'siswa') {
        header("location:" . base_url('index.php/welcome'));
    } else if ($this->session->userdata['HAKAKSES'] == 'guru') {
        header("location:" . base_url('index.php/guru/dashboard'));
    } else if ($this->session->userdata['HAKAKSES'] == 'admin') {
        header("location:" . base_url('index.php/welcome'));
    }
} { 
}
?>