<main>
    <section class="fullwidth-background bg-2">
        <div class="grid-row">
            <div class="login-block" style="min-width: 75%">
                <div class="logo">
                    <img src="<?= base_url('assets/back/img/logo.png') ?>" alt>
                    <!--<h4>Login</h4>-->
                </div>
                <?php
//                if (!empty($authUrl)) {
//                    echo '<a href="' . $authUrl . '" class="btn btn-block btn-facebook">Connect with <i class="ico-facebook2 ml5"></i></a>';                  
//                }
                ?>
                <div class="clear-both"></div>

                <!-- Alert message -->
                <div class="grid-col grid-col-8">
                    <div class="page-header-section">
                        <h4 class="title font-alt text-center">Konfirmasi Akun</h4>
                    </div>
                    <!-- Alert message -->
                    <div class="alert alert-warning">
                        <span class="semibold">Info :</span>&nbsp;&nbsp; Kode aktivasi telah dikirim ke emailmu. Silahkan cek email. 
                        <a href="<?= base_url('index.php/register/resend_mail/'); ?>"> <b>Tidak terkirim? Kirim ulang email</b> </a>
                    </div>
                    <!--/ Alert message -->

                    <hr class="nm">
                    <br>

                    <p class="semibold text-muted">Jika email verifikasi tidak terkirim, masukan kembali emailmu dengan benar?</p>

                    <br>
                </div>
                <div class="clear-both"></div>

                <div class="grid-col grid-col-8">
                    <form class="login-form" name="form-register" action="<?= base_url() ?>index.php/register/ch_mail_aktivasi" method="post">
                        <!-- Star form konfirmasi akun by email -->
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="xxx@mail.com">
                            <i class="ico-envelop form-control-icon"></i>
                            <!-- untuk menampilkan pesan kesalahan penginputan email -->
                            <span class="text-danger"><?php echo form_error('email'); ?></span>
                        </div>
                        <!-- end form konfirmasi akun by email -->
<!--                        <div class="panel-footer">
                            <button type="submit" class="button-fullwidth cws-button bt-color-3 alt"><span class="semibold">Kirim Ulang Kode Verifikasi</span></button>
                        </div>  -->
                        <div class="form-group nm">
                            <button type="submit" class="button-fullwidth cws-button bt-color-3 alt"><span class="semibold">Kirim Ulang Kode Verifikasi</span></button>
                        </div>
                    </form>
                </div>

                <!--/ Alert message -->
                <div class="clear-both"></div>
            </div>
        </div>
        <a href="#" class="totop animation" data-toggle="waypoints totop" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="50%"><i class="ico-angle-up"></i></a>
    </section>
</main>