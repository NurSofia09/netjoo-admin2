  <!-- START Template Main -->

  <section id="main" role="main">

    <!-- START Register Content -->

    <section class="container">

        <div class="row">

            <div class="col-md-10">

                <div class="text-center" style="margin-bottom:20px;">

                    <img src="<?=base_url('assets/back/img/logo-tara.png') ?>" > 

                    <br><h5 class="semibold text-muted mt-5"><br>Ubah Akun Pengawas</h5>

                </div>

                <!-- Register form -->
                <form class="panel nm" name="form-register" action="<?=base_url()?>index.php/pengawas/editPengawas" method="post">
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
                                    <input type="text" class="form-control" name="nama" value="<?=$oldData['nama']?>" placeholder="neonjogja_23 atau smanpurnama_12" data-parsley-required>
                                    <i class="ico-user2 form-control-icon"></i>

                                    <!-- untuk menampilkan pesan kesalahan penginputan alamat -->
                                    <span class="text-danger"> <?php echo form_error('nama'); ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group" hidden>
                            <input class="form-control" type="text" name="uuid" value="<?=$oldData['uuid']?>" >
                        </div>

                    <div class="col-md-12 form-group">

                        <label class="control-label">Alamat</label>

                        <div class="has-icon pull-left">

                            <input type="text" class="form-control" name="alamat" value="<?=$oldData['alamat']?>" data-parsley-required>

                            <i class="ico-home10 form-control-icon"></i>

                            <!-- untuk menampilkan pesan kesalahan penginputan alamat -->

                            <span class="text-danger"> <?php echo form_error('alamat'); ?></span>

                        </div>

                    </div>



                    <div class="col-md-12 form-group">

                        <label class="control-label">No Kontak</label>

                        <div class="has-icon pull-left">

                            <input type="number" class="form-control" name="nokontak" value="<?=$oldData['noKontak']?>" data-parsley-required>

                            <i class="ico-phone3 form-control-icon"></i>

                            <!-- untuk menampilkan pesan kesalahan penginputan alamat -->

                            <span class="text-danger"> <?php echo form_error('nokontak'); ?></span>

                        </div>

                    </div>



                </div>


                <hr class="nm">

                <div class="panel-body">

                    <p class="semibold text-muted">Untuk konfirmasi dan pengaktifan akun baru anda, kita akan mengirim aktivasi code ke email anda.</p>

                    <div class="form-group">

                        <label class="control-label">Email</label>

                        <div class="has-icon pull-left">

                            <input type="email" class="form-control" name="email" value="<?=$oldData['email']?>" placeholder="you@mail.com">

                            <i class="ico-envelop form-control-icon"></i>

                            <!-- untuk menampilkan pesan kesalahan penginputan email -->

                            <span class="text-danger"><?php echo form_error('email'); ?></span>

                        </div>

                    </div>




                </div>

                <!-- end form konfirmasi akun by email -->

                <div class="panel-footer">



                    <button type="submit" class="btn btn-block btn-success"  ><span class="semibold">Simpan</span></button>

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






