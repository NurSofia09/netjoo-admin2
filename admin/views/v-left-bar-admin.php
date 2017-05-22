<!-- header -->
<header id="header" class="navbar navbar-fixed-top">
    <div class="navbar-header">
        <a class="navbar-brand" href="javascript:void(0);">
            <span class="logo-figure"></span>
            <span class="logo-text"></span>
        </a>
    </div>
</header>

<!-- menu kiri -->
<aside class="sidebar sidebar-left sidebar-menu">     
    <section class="content slimscroll">
        <h5 class="heading">Main Menu</h5>

        <ul class="topmenu topmenu-responsive" data-toggle="menu">
            <li >
                <a href="<?= base_url('index.php/admin') ?>" data-toggle="submenu" data-target="#chart" data-parent=".topmenu">
                    <span class="figure"><i class="ico-home"></i></span>
                    <span class="text">Dashboard</span>
                </a>

                <a href="<?= base_url('index.php/register/registerguru') ?>" data-toggle="submenu" data-target="#chart" data-parent=".topmenu">
                    <span class="figure"><i class="ico-file-upload"></i></span>
                    <span class="text">Registrasi Guru</span>
                </a>

                <a href="<?= base_url('index.php/') ?>" data-toggle="submenu" data-target="#chart" data-parent=".topmenu">
                    <span class="figure"><i class="ico-file-upload"></i></span>
                    <span class="text">Daftar Akun Guru</span>

                </a>
                <a href="<?= base_url('index.php/') ?>" data-toggle="submenu" data-target="#chart" data-parent=".topmenu">
                    <span class="figure"><i class="ico-file-upload"></i></span>
                    <span class="text">Daftar Akun Siswa</span>
                </a>

                </a>
                <a href="<?= base_url('index.php/admin/daftarvideo') ?>" data-toggle="submenu" data-target="#chart" data-parent=".topmenu">
                    <span class="figure"><i class="ico-file-upload"></i></span>
                    <span class="text">Unpublished Video</span>
                </a>

                <a href="<?= base_url('index.php/admin/semuavideo') ?>" data-toggle="submenu" data-target="#chart" data-parent=".topmenu">
                    <span class="figure"><i class="ico-file-upload"></i></span>
                    <span class="text">Pengaturan Profile </span>
                </a>

                <a href="<?= base_url('index.php/guru/pengaturanProfileGuru') ?>" data-toggle="submenu" data-target="#chart" data-parent=".topmenu">
                    <span class="figure"><i class="ico-file-upload"></i></span>
                    <span class="text">Pengaturan Profile </span>
                </a>



            </li>
        </ul>
    </section>
</aside>