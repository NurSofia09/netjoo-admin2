  <!-- START Template Main -->

  <section id="main" role="main">

    <!-- START Register Content -->

    <section class="container">

        <div class="row">

            <div class="col-md-10">

                <div class="text-center" style="margin-bottom:20px;">

                    <img src="<?=base_url('assets/back/img/logo-tara.png') ?>" > 

                    <br><h5 class="semibold text-muted mt-5"><br>Membuat Akun Pengawas</h5>

                </div>

                <!-- Register form -->

                <form class="panel nm" name="form-register" action="<?=base_url()?>index.php/pengawas/savePengawas" method="post">
                    <ul class="list-table pa15">
                        <li>
                            <!-- Alert message -->
                            <div class="alert alert-info nm text-center">
                                <span class="semibold text-center">Catatan :</span>&nbsp;&nbsp;Silahkan diisi Semua.
                            </div>
                            <!--/ Alert message -->
                        </li>
                        <li class="text-right" style="width:20px;"><a href="javascript:void(0);"><i class="ico-question-sign fsize16"></i></a></li>
                    </ul>





                    <hr class="nm">

                    <div class="panel-body">

                        <div class="form-group">

                            <label class="col-md-12 control-label">Nama Cabang Atau Sekolah</label>

                            <div class="col-md-12">

                                <div class="has-icon pull-left">

                                    <input type="text" class="form-control" name="nama" value="<?php echo set_value('nama'); ?>" placeholder="neonjogja_23 atau smanpurnama_12" data-parsley-required>

                                    <i class="ico-user2 form-control-icon"></i>

                                    <!-- untuk menampilkan pesan kesalahan penginputan alamat -->

                                    <span class="text-danger"> <?php echo form_error('nama'); ?></span>

                                </div>

                            </div>



                     </div>



    



                    <div class="col-md-12 form-group">

                        <label class="control-label">Alamat</label>

                        <div class="has-icon pull-left">

                            <input type="text" class="form-control" name="alamat" value="<?php echo set_value('alamat'); ?>" data-parsley-required>

                            <i class="ico-home10 form-control-icon"></i>

                            <!-- untuk menampilkan pesan kesalahan penginputan alamat -->

                            <span class="text-danger"> <?php echo form_error('alamat'); ?></span>

                        </div>

                    </div>



                    <div class="col-md-12 form-group">

                        <label class="control-label">No Kontak</label>

                        <div class="has-icon pull-left">

                            <input type="number" class="form-control" name="nokontak" value="<?php echo set_value('nokontak'); ?>" data-parsley-required>

                            <i class="ico-phone3 form-control-icon"></i>

                            <!-- untuk menampilkan pesan kesalahan penginputan alamat -->

                            <span class="text-danger"> <?php echo form_error('nokontak'); ?></span>

                        </div>

                    </div>



                </div>



                <hr class="nm">

                <div class="panel-body">

                    <div class="col-md-12 form-group">

                        <label class="control-label">Nama Pengguna</label>

                        <div class="has-icon pull-left">

                            <input type="text" class="form-control" name="namapengguna" value="<?php echo set_value('namapengguna'); ?>" placeholder="Sekolah_code (neonBandung23  / sman_putracahaya23)" data-parsley-required>

                            <i class="ico-tag9 form-control-icon"></i>

                            <!-- untuk menampilkan pesan kesalaha penginputan nama pengguna -->

                            <span class="text-danger"><?php echo form_error('namapengguna'); ?></span>

                        </div>

                    </div>

                    <div class="col-md-12 form-group">

                        <label class="control-label">Kata Sandi</label>

                        <div class="has-icon pull-left">

                            <input type="password" class="form-control" name="katasandi" data-parsley-required>

                            <i class="ico-key2 form-control-icon"></i>

                            <!-- untuk menampilkan pesan kesalahan penginputan kata sandi -->

                            <span class="text-danger"><?php echo form_error('katasandi'); ?></span>

                        </div>

                    </div>

                    <div class="col-md-12 form-group">

                        <label class="control-label">Ulangi Kata Sandi</label>

                        <div class="has-icon pull-left">

                            <input type="password" class="form-control" name="passconf" data-parsley-equalto="input[name=password]">

                            <i class="ico-asterisk form-control-icon"></i>

                            <span class="text-danger"><?php echo form_error('katasandi'); ?></span>

                        </div>

                    </div>

                </div>



                <hr class="nm">

                <div class="panel-body">

                    <p class="semibold text-muted">Untuk konfirmasi dan pengaktifan akun baru anda, kita akan mengirim aktivasi code ke email anda.</p>

                    <div class="form-group">

                        <label class="control-label">Email</label>

                        <div class="has-icon pull-left">

                            <input type="email" class="form-control" name="email" value="<?php echo set_value('email'); ?>" placeholder="you@mail.com">

                            <i class="ico-envelop form-control-icon"></i>

                            <!-- untuk menampilkan pesan kesalahan penginputan email -->

                            <span class="text-danger"><?php echo form_error('email'); ?></span>

                        </div>

                    </div>

                    <div class="form-group">

                        <div class="checkbox custom-checkbox">  

                            <input type="checkbox" name="agree" id="agree" value="1" required>  

                            <label for="agree">&nbsp;&nbsp;Saya setuju dengan <a class="semibold" href="javascript:void(0);">Ketentuan Pelayanan</a></label>   

                        </div>

                    </div> 



                </div>

                <!-- end form konfirmasi akun by email -->

                <div class="panel-footer">



                    <button type="submit" class="btn btn-block btn-success" id="kirimdata" disabled><span class="semibold">Sign up</span></button>

                </div>

            </form>

            <!-- Register form -->

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



<script type="text/javascript">

    function enable() {

        if (this.checked) {

         document.getElementById("kirimdata").disabled = false;

     } else {

         document.getElementById("kirimdata").disabled = true;

     }

 }

 document.getElementById("agree").addEventListener("change", enable);



</script>