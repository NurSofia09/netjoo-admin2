<!-- START asdasd Header -->
<header id="header" class="navbar navbar-fixed-top">
    <div class="container">
        <!-- START navbar header -->
        <div class="navbar-header">
            <!-- Brand -->
            <a class="navbar-brand" href="javascript:void(0);">
                <span class="logo-figure" style="margin-left:-4px;"></span>
                <!-- <span class="logo-text"></span> -->
                <span>Neon</span>
            </a>
            <!--/ Brand -->
        </div>
        <!--/ END navbar header -->

        <!-- START Toolbar -->
        <div class="navbar-toolbar clearfix">
            <!-- START Left nav -->
            <ul class="nav navbar-nav">
                <!-- Navbar collapse: This menu will take position at the top of template header (mobile only). Make sure that only #header have the `position: relative`, or it may cause unwanted behavior -->
                <li class="navbar-main navbar-toggle">
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#navbar-collapse">
                        <span class="meta">
                            <span class="icon"><i class="ico-paragraph-justify3"></i></span>
                        </span>
                    </a>
                </li>
                <!--/ Navbar collapse -->
            </ul>
            <!--/ END Left nav -->



            <!-- START nav collapse -->
            <div class="collapse navbar-collapse navbar-collapse-alt" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
<!--                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="meta">
                                <span class="text">Test Online</span>
                                <span class="caret"></span>
                            </span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?= base_url('index.php/tesonline'); ?>">Latihan Soal</a></li>
                            <li><a href="<?= base_url('index.php/tesonline/test'); ?>">TO UN/SBMPTN</a></li>
                            <li><a href="<?= base_url('index.php/tesonline/test'); ?>">TO Perguruan Tinggi</a></li>
                        </ul>
                    </li>-->
<!--                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="meta">
                                <span class="text">Video Belajar</span>
                                <span class="caret"></span>
                            </span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?= base_url('index.php/video/videobelajar'); ?>">Materi</a></li>
                            <li><a href="<?= base_url('index.php/video/videobelajarsingle'); ?>">Soal</a></li>
                            <li><a href="<?= base_url('index.php/video/daftarvideo'); ?>">Daftar Video</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="meta">
                                <span class="text">Konsultasi</span>
                                <span class="caret"></span>
                            </span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?= base_url('index.php/konsultasi');?>">Pelajaran</a></li>
                            <li><a href="<?= base_url('index.php/konsultasi');?>">Jurusan</a></li>
                        </ul>
                    </li>-->
                    <li class="dropdown">
                        <a href="<?= base_url('index.php/register');?>">
                            <span class="meta">
                                <span class="text">Daftar</span>
                            </span>
                        </a>

                    </li>
                    <li class="dropdown">
                        <a href="<?= base_url('index.php/login');?>">
                            <span class="meta">
                                <!--<button class="btn btn-primary">Login</button>-->
                                <span class="text">Masuk</span>
                            </span>
                        </a>

                    </li>

                </ul>
            </div>
            <!--/ END nav collapse -->
        </div>
        <!--/ END Toolbar -->
    </div>
</header>
<!--/ END Template Header -->
