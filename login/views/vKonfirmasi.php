<!-- START Template Main -->
<section id="main" role="main">
    <!-- START page header -->
    <section class="page-header page-header-block nm">
        <!-- pattern -->
        <div class="pattern pattern9"></div>
        <!--/ pattern -->
        <div class="container pt15 pb15">
            <div class="page-header-section">
                <h4 class="title font-alt">Konfirmasi Akun</h4>
            </div>
            <div class="page-header-section">
                <!-- Toolbar -->
                <div class="toolbar">
                    <ol class="breadcrumb breadcrumb-transparent nm">
                        <li><a href="<?= base_url(); ?>">Beranda</a></li>
                        <li class="active"><a href="<?php echo base_url('index.php/logout'); ?>">Logout</a></li>
                        
                    </ol>
                </div>
                <!--/ Toolbar -->
            </div>
        </div>
    </section>
    <!--/ END page header -->

    <!-- START Register Content -->
    <section class="section bgcolor-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Header -->
                    <div class="section-header section-header-bordered text-center">
                        <h2 class="section-title">
                            <p class="font-alt nm">Konfirmasi Akun Joonet</p>
                        </h2>
                    </div>
                    <!--/ Header -->
                </div>

                <div class="col-md-6 col-md-offset-3">
                    <form class="panel" name="form-login" action="#" method="post">
                        <div class="panel-body">
                            <!-- Alert message -->
                            <div class="alert alert-warning">
                                <span class="semibold">Info :</span>&nbsp;&nbsp;Kami sudah mengirimkan kode aktivasi. Silahkan cek email Anda. 
                                <a href="#">Kirim ulang email ?</a>
                            </div>
                            <!--/ Alert message -->
                           
                        </div>
                    </form>
                    <!-- Login form -->
                </div>
            </div>
        </div>
    </section>
    <!--/ END Register Content -->

    <!-- START To Top Scroller -->
    <a href="#" class="totop animation" data-toggle="waypoints totop" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="50%"><i class="ico-angle-up"></i></a>
    <!--/ END To Top Scroller -->
</section>
<!--/ END Template Main -->
