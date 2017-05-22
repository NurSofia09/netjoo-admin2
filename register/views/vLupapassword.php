<main>
    <section class="fullwidth-background bg-2">
        <div class="grid-row">
            <div class="login-block" style="min-width: 50%">
                <div class="logo">
                    <img src="<?= base_url('assets/back/img/logo.png') ?>" alt>
                    <!--<h4>Login</h4>-->
                </div>
                <div class="">
                    <div class="page-header-section">
                        <h4 class="title font-alt text-center">LUPA PASSWORD</h4>
                    </div>
                </div>
                <form class="login-form" name="form-register" action="<?= base_url() ?>index.php/register/ch_sent_reset" method="post">

                    <!-- Alert message -->
                    <!--                                <div class="alert alert-warning">
                                                        <span class="semibold">Info :</span>&nbsp;&nbsp;Kami akan kirimkan kode reset password ke email akun mu.
                                                    </div>-->
                    <!--/ Alert message -->
                    <?php if ($this->session->flashdata('notif') != '') {
                        ?>
                        <div class="alert alert-warning">
                            <span class="semibold">Note :</span><?php echo $this->session->flashdata('notif'); ?>
                        </div>
                    <?php } else { ?>
                        <div class="alert alert-warning">
                            <span class="semibold">Note :</span>&nbsp;&nbsp;Kami akan kirimkan kode reset password ke email akun mu.
                        </div>
                    <?php }; ?>
                    <hr class="nm">
<br>
                    <!-- Star form konfirmasi akun by email -->
                        <div class="form-group">
                            <div class="has-icon">
                                <input type="email" class="form-control" name="email" placeholder="xxx@mail.com" required>
                                <i class="ico-envelop form-control-icon"></i>
                                <!-- untuk menampilkan pesan kesalahan penginputan email -->
                            </div>
                        </div>

                    <!-- end form konfirmasi akun by email -->
                    <div class="">
                        <button type="submit" class="button-fullwidth cws-button bt-color-3 alt"><span class="semibold">Submit</span></button>
                    </div>
                </form>

            </div>
        </div>
        <a href="#" class="totop animation" data-toggle="waypoints totop" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="50%"><i class="ico-angle-up"></i></a>
    </section>
</main>
