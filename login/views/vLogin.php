<main>

    <section class="fullwidth-background bg-2">

        <div class="grid-row">

            <div class="login-block" style="min-width: 35%">

                <div class="logo">

                    
                    <!--<h4>Login</h4>-->

                </div>

                <div class="">

                    <div class="page-header-section">

                        <h4 class="title font-alt text-center">Silahkan Login</h4>

                    </div>

                </div>

                <?php

//                if (!empty($authUrl)) {

//                    echo '<a href="' . $authUrl . '" class="btn btn-block btn-facebook">Connect with <i class="ico-facebook2 ml5"></i></a>';                  

//                }

                ?>

                <div class="clear-both"></div>

                <!--                <div class="login-or">

                                    <hr class="hr-or">

                                    <span class="span-or">or</span>

                                </div>-->

                <?php if ($this->session->flashdata('notif') != '') {

                    ?>

                    <div class="alert alert-warning">

                        <span class="semibold">Note :</span><?php echo $this->session->flashdata('notif'); ?>

                    </div>

                <?php } else { ?>

                    <div class="alert alert-warning">

                        Siap berpetualang? Isi form, tekan Login!

                    </div>

                <?php }; ?>

                <hr>

                <br>

                <form class="login-form" action = "<?= base_url('index.php/login/validasiLogin'); ?>" method = "post">

                    <div class="form-group">

                        <input type="text" name="username" class="login-input" placeholder="Username / email" required>

                        <span class="input-icon">

                            <i class="fa fa-user"></i>

                        </span>

                    </div>

                    <div class="form-group">

                        <input name="password" type="password" class="login-input" placeholder="Password" required>

                        <span class="input-icon">

                            <i class="fa fa-lock"></i>

                        </span>

                    </div>



                    <div class="form-group">

                        <div class="" style="float: left;">

                            <p class="small">

                                <a href="<?= base_url('index.php/register/lupapassword'); ?>">Lupa Password?</a>

                            </p>

                        </div>

                        <div class="text-right">

                            <p class="small">

                                <a href="<?= base_url('index.php/register'); ?>">Belum punya akun?</a>

                            </p><!--

                            --></div>

                        <div class="clear-both"></div>

                    </div>

                    <div class="form-group nm">

                        <button type="submit" class="button-fullwidth cws-button bt-color-3 alt"><span class="semibold">Login</span></button>

                    </div>

                </form>



            </div>

        </div>

        <a href="#" class="totop animation" data-toggle="waypoints totop" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="50%"><i class="ico-angle-up"></i></a>

    </section>

</main>

