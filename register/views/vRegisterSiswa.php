<main>
    <section class="fullwidth-background bg-2">

        <div class="grid-row">

            <div class="login-block" style="min-width: 75%">

                <div class="logo">

                    <img src="<?= base_url('assets/back/img/logo.png') ?>" alt>

                    <!--<h4>Login</h4>-->

                </div>

                <div class="">

                    <div class="page-header-section">

                        <h4 class="title font-alt text-center">REGISTRASI</h4>

                    </div>

                </div>

                <?php

//                if (!empty($authUrl)) {

//                    echo '<a href="' . $authUrl . '" class="btn btn-block btn-facebook">Connect with <i class="ico-facebook2 ml5"></i></a>';                  

//                }

                ?>

                <div class="clear-both"></div>



                <!-- Alert message -->

                <div class="grid-col grid-col-8">

                    <div class="alert alert-warning">

                        <span class="semibold">Catatan :</span>&nbsp;&nbsp;Silahkan diisi semua.

                    </div>

                    <hr>

                    <br>

                </div>



                <!--/ Alert message -->



                <form class="login-form" name="form-register" action="<?= base_url() ?>index.php/register/savesiswa" method="post">



                    <div class="grid-col grid-col-8">

                        <p class="text-center">IDENTITAS PENGGUNA</p>

                    </div>

                    <div class="clear-both"></div>

                    <br>



                    <div class="grid-col grid-col-4">

                        <div class="form-group">

                            <input type="text" class="login-input input-sm" name="namadepan" value="<?php echo set_value('namadepan'); ?>" placeholder="Nama Depan" required data-parsley-required>

<!--                            <span class="input-icon">

                                <i class="fa fa-user"></i>

                            </span>-->

                            <!--untuk menampilkan pesan kesalahan penginputan alamat--> 

                            <span class="text-danger"> <?php echo form_error('namadepan'); ?></span>

                        </div>

                    </div>



                    <div class="grid-col grid-col-4">

                        <div class="form-group">

                            <input type="text" class="login-input input-sm" name="namabelakang" value="<?php echo set_value('namabelakang'); ?>" placeholder="Nama Belakang" required>

                            <!-- untuk menampilkan pesan kesalahan penginputan alamat -->

                            <span class="text-danger"> <?php echo form_error('namabelakang'); ?></span>

                        </div>

                    </div>



                    <div class="grid-col grid-col-8">

                        <div class="form-group">

                            <input type="text" class="login-input input-sm" placeholder="Alamat" name="alamat" value="<?php echo set_value('alamat'); ?>" data-parsley-required required>

                            <i class="ico-home10 form-control-icon"></i>

                            <!-- untuk menampilkan pesan kesalahan penginputan alamat -->

                            <span class="text-danger"> <?php echo form_error('alamat'); ?></span> 

                        </div>

                    </div>



                    <div class="grid-col grid-col-8">

                        <div class="form-group">

                            <input type="text" class="form-control input-sm" placeholder="No Kontak" name="nokontak" value="<?php echo set_value('nokontak'); ?>" data-parsley-required required>

                            <i class="ico-phone3 form-control-icon"></i>

                            <!-- untuk menampilkan pesan kesalahan penginputan no kontak -->

                            <span class="text-danger"> <?php echo form_error('nokontak'); ?></span>

                        </div>

                        <hr>

                    </div>



                    <!-- end form data siswa -->

                    <div class="clear-both"></div>

                    <br>



                    <div class="grid-col grid-col-8">

                        <p class="text-center">IDENTITAS SEKOLAH</p>

                    </div>

                    <div class="clear-both"></div>

                    <br>



                    <!-- start form data sekolah -->

                    <div class="grid-col grid-col-8">

                        <div class="form-group">

                            <select class="form-control" name="tingkatID" id="tingkatID" required>

                                <option value="">-Pilih Tingkat Sekolah-</option>

                                <option value="6">Kelas 1 - SD</option>

                                <option value="7">Kelas 2 - SD</option>

                                <option value="8">Kelas 3 - SD</option>

                                <option value="9">Kelas 4 - SD</option>

                                <option value="10">Kelas 5 - SD</option>

                                <option value="11">Kelas 6 - SD</option>

                                <option value="12">Kelas 7 - SMP</option>

                                <option value="13">Kelas 8 - SMP</option>

                                <option value="14">Kelas 9 - SMP</option>

                                <option value="15">Kelas 10 - SMA IPA</option>

                                <option value="16">Kelas 11 - SMA IPA</option>

                                <option value="17">Kelas 12 - SMA IPA</option>

                                <option value="18">Kelas 10 - SMA IPS</option>

                                <option value="19">Kelas 11 - SMA IPS</option>

                                <option value="20">Kelas 12 - SMA IPS</option>  

                            </select>

                        </div>

                    </div>



                    <div class="grid-col grid-col-8">

                        <div class="form-group">

                            <input type="text" placeholder="Nama Sekolah" class="login-input input-sm" name="namasekolah" value="<?php echo set_value('namasekolah'); ?>"data-parsley-required required>

                            <i class="ico-home form-control-icon"></i>

                        </div>

                    </div>



                    <div class="grid-col grid-col-8">

                        <div class="form-group">

                            <input placeholder="Alamat Sekolah" type="text" class="login-input input-sm" name="alamatsekolah" value="<?php echo set_value('alamatsekolah'); ?>"data-parsley-required required>

                            <i class="ico-home form-control-icon"></i>

                        </div>



                        <hr class="nm">

                    </div>



                    <!-- end form data siswa -->

                    <div class="clear-both"></div>





                    <!-- star form akun -->

                    <br>

                    <div class="grid-col grid-col-8">

                        <p class="text-center">AKUN</p>

                    </div>

                    <div class="clear-both"></div>

                    <br>



                    <div class="grid-col grid-col-8">

                        <div class="form-group">

                            <input placeholder="Username" type="text" class="login-input input-sm" name="namapengguna" value="<?php echo set_value('namapengguna'); ?>"  data-parsley-required required>

                            <i class="ico-tag9 form-control-icon"></i>

                            <!-- untuk menampilkan pesan kesalaha penginputan nama pengguna -->

                            <span class="text-danger"><?php echo form_error('namapengguna'); ?></span>

                        </div>

                    </div>

                    <div class="grid-col grid-col-8">

                        <div class="form-group">

                            <input placeholder="Password" type="password" class="login-input input-sm" name="katasandi" maxlength="20" required>

                            <i class="ico-key2 form-control-icon"></i>

                            <!-- untuk menampilkan pesan kesalahan penginputan kata sandi -->

                            <span class="text-danger"><?php echo form_error('katasandi'); ?></span>

                        </div>

                    </div>



                    <div class="grid-col grid-col-8">

                        <div class="form-group">

                            <input placeholder="Confirm Password" type="password" class="login-input input-sm" name="passconf" data-parsley-equalto="input[name=password]" maxlength="20" required>

                            <i class="ico-asterisk form-control-icon"></i>

                            <span class="text-danger"><?php echo form_error('katasandi'); ?></span>

                        </div>

                    </div>
                    <div class="grid-col grid-col-8">
                        <p class="text-center">BIMBEL</p>
                    </div> 
                    <div class="grid-col grid-col-8">
                        <div class="form-group">
                        <select class="form-control" name="bimbel">
                                <option value="">- Pilih Bimbel Kalian -</option>
                                <option value="Neutron">Neutron</option>
                                <option value="GO">GO</option>
                                <option value="1bimbel lainya">Bimbel lainya</option>
                            </select>
                            <!-- untuk menampilkan pesan kesalaha penginputan nama pengguna -->
                            <span class="text-danger"><?php echo form_error('bimbel'); ?></span>
                        </div>
                    </div>
                    <div class="Keaktivan hide">
                        <div class="grid-col grid-col-8" >
                            <p class="text-center">DATA NEON</p>
                        </div> 
                        <div class="grid-col grid-col-8">
                            <div class="form-group">
                                <select class="form-control" name="cabang">
                                    <option value="">- Pilih Cabang -</option>
                                    <?php foreach ($cabang as $cabang_item): ?>
                                    <option value="<?=$cabang_item->id ?>"><?=$cabang_item->namaCabang ?></option>
                                    <?php endforeach ?>
                                </select>
                                <!-- untuk menampilkan pesan kesalaha penginputan nama pengguna -->
                                <span class="text-danger"><?php echo form_error('cabang'); ?></span>
                            </div>
                        </div>

                    <div class="grid-col grid-col-8">

                        <div class="form-group">

                            <input placeholder="Nomer Induk Siswa Neutron contoh : 120300xxx" type="text" class="login-input input-sm" name="noinduk" value="<?php echo set_value('noinduk'); ?>" data-parsley-required>

                            <i class="ico-tag9 form-control-icon"></i>

                            <!-- untuk menampilkan pesan kesalaha penginputan nama pengguna -->

                            <span class="text-danger"><?php echo form_error('noinduk'); ?></span>

                        </div>

                    </div>
                    </div>

                    <div class="clear-both"></div>

                    <!-- end form akun -->



                    <div class="grid-col grid-col-8">

                        <hr class="nm">


                        <br>



                        <p class="small">Untuk konfirmasi dan pengaktifan akun baru, kita akan mengirim kode aktivasi ke email kamu.</p>

                        <!-- Star form konfirmasi akun by email -->

                        <div class="form-group">

                            <input type="email" class="form-control input-sm" name="email" value="<?php echo set_value('email'); ?>" placeholder="xxx@mail.com" required>

                            <i class="ico-envelop form-control-icon"></i>

                            <!-- untuk menampilkan pesan kesalahan penginputan email -->

                            <span class="text-danger"><?php echo form_error('email'); ?></span> 

                        </div>

                    </div>



                    <div class="grid-col grid-col-8">

                        <div class="form-group nm">

                            <button type="submit" class="button-fullwidth cws-button bt-color-3 alt"><span class="semibold">Daftar</span></button>

                        </div>



                    </div>

                    <div class="clear-both"></div>

                    <!-- end form akun -->



                    <!--                    <div class="form-group">

                                            <div class="" style="float: left;background: black;">

                                                <div class="checkbox custom-checkbox">  

                                                    <input type="checkbox" name="agree" id="agree" value="1" required>  

                                                    <label for="agree"> </label>

                                                </div>

                                                <p class="small">

                                                    &nbsp;&nbsp;Saya setuju dengan <a class="semibold" href="javascript:void(0);">Ketentuan Pelayanan</a>

                                                </p>

                                            </div>

                                            <div class="text-right">

                                                <p class="small">

                                                    <a href="<?= base_url('index.php/login'); ?>">Ada akun?</a>

                                                </p>

                                                </div>

                                            <div class="clear-both"></div>

                                        </div>-->

                                        <!-- end form konfirmasi akun by email -->

                    <!--                    <div class="panel-footer">

                                            <button type="submit" class="btn btn-block btn-success" id="kirimdata" disabled><span class="semibold">Sign up</span></button>

                                        </div>-->

                                    </form>

                                    <!-- Register form -->

                                </div>

                            </div>

                            <a href="#" class="totop animation" data-toggle="waypoints totop" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="50%"><i class="ico-angle-up"></i></a>

                        </section>

                    </main>



<script type="text/javascript">
$('select[name=bimbel]').change(function(){
    var bimbel = $('select[name=bimbel]').val();
    if (bimbel=='Neutron') {
        $('.Keaktivan').removeClass('hide');
    }else{
        $('.Keaktivan').addClass('hide animate');

    }
});
</script>