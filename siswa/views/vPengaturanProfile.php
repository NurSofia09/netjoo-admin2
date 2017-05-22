  <!-- get data siswa unutk di tampilkan di form -->

    <?php 

        foreach ($siswa as $row) {

            $namaDepan = $row['namaDepan'];

            $namaBelakang = $row['namaBelakang'];

            $alamat = $row['alamat'];

            $noKontak = $row['noKontak'];

            $biografi = $row['biografi'];

            $namaSekolah = $row['namaSekolah'];

            $alamatSekolah  = $row['alamatSekolah']; 

            $photo=base_url().'assets/image/photo/siswa/'.$row['photo'];

            $oldphoto=$row['photo'];

        } ;

     ?>           



<script type="text/javascript" src="<?= base_url('assets/library/jquery/js/preview.js') ?>"></script>

<script type="text/javascript" src="<?= base_url('assets/library/jquery/js/upbar.js') ?>"></script>

<script type="text/javascript" src="<?= base_url('assets/library/jquery/js/jequery.form.js') ?>"></script>

        <!-- START Template Main -->

        <section id="main" role="main">



            <!-- START Template Container -->

            <div class="container">

             <!-- START row -->

                <div class="row">

                    <!-- Left / Top Side -->

                    <div class="col-lg-3">

                        <!-- tab menu -->
                        <aside class="widget-categories">
                            <h2>Pengaturan</h2>
                            <hr class="divider-big" />
                            <ul>
                              <!--   <li class="cat-item cat-item-1 current-cat"><a href="#">Profile</a></li>
                                <li class="cat-item cat-item-1 current-cat"><a href="#">Photo</a></li>
                                <li class="cat-item cat-item-1 current-cat"><a href="#">Email</a></li>
                                <li class="cat-item cat-item-1 current-cat"><a href="#">Password</a></li> -->
                            <li class="cat-item cat-item-1 current-cat"><a href="#profile" data-toggle="tab"><i class="ico-user2 mr5"></i> Profile</a></li>

                            <li class="cat-item cat-item-1 current-cat"><a href="#photo" data-toggle="tab"><i class="ico-camera3 mr5"></i>Photo</a></li>

                            <li class="cat-item cat-item-1 current-cat"><a href="#email" data-toggle="tab"><i class="ico-envelop2 mr5"></i>Email</a></li>

                            <li class="cat-item cat-item-1 current-cat"><a href="#password" data-toggle="tab"><i class="ico-key2 mr5"></i> Password</a></li>
                            </ul>
                        </aside>
                    </div>

                    <!--/ Left / Top Side -->



                    <!-- Left / Bottom Side -->

                    <div class="col-lg-9">

                        <!-- START Tab-content -->

                        <div class="tab-content">
                             <?php if ($this->session->flashdata('updsiswa') != '') {

                                ?>

                                <div class="alert alert-warning fade in">

                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

                                    <span class="semibold">Note :</span><?php echo $this->session->flashdata('updsiswa'); ?>

                                </div>

                            <?php } else { ?>

                                <div class="alert alert-warning fade in">

                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

                                    <span class="semibold">Note :</span>&nbsp;&nbsp;Pastikan data form di isi dengan benar.

                                </div>

                            <?php }; ?>
                       

                            <!-- tab-pane: profile -->

                            <div class="tab-pane active" id="profile">

                                <!-- form profile -->

                                <form class="panel form-horizontal form-bordered" name="form-profile" action="<?=base_url()?>index.php/siswa/ubahprofilesiswa" method="post" accept-charset="utf-8" enctype="multipart/form-data">



                                    <div class="panel-body pt0 pb0">

                                        <div class="form-group header bgcolor-default">

                                            <div class="col-md-12">
                                                
                                                <h4 class="semibold mt0 mb5">Profile </h4>

                                                <p class="text-default nm">This information appears on your public profile, search results, and beyond.</p>

                                            </div>

                                        </div>

                                        

                                        <div class="form-group">

                                            <label class="col-sm-3 control-label">Name</label>

                                            <div class="col-sm-3">

                                                <input type="text" class="form-control" name="namadepan" value="<?=$namaDepan;?>">

                                                <span class="text-danger"> <?php echo form_error('namadepan'); ?></span>

                                            </div>

                                              <div class="col-sm-3">

                                                <input type="text" class="form-control" name="namabelakang" value="<?=$namaBelakang;?>">

                                            </div>



                                        </div>

                                        <div class="form-group">

                                            <label class="col-sm-3 control-label">Alamat</label>

                                            <div class="col-sm-6">

                                                 <input type="text" class="form-control" name="alamat" value="<?=$alamat; ?>">

                                                 <span class="text-danger"> <?php echo form_error('namadepan'); ?></span>

                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <label class="col-sm-3 control-label">No Kontak</label>

                                            <div class="col-sm-6">

                                                 <input type="text" class="form-control" name="nokontak" value="<?=$noKontak;?>">

                                                 <span class="text-danger"> <?php echo form_error('nokontak'); ?></span>

                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <label class="col-sm-3 control-label">Bio</label>

                                            <div class="col-sm-6">

                                                <textarea class="form-control" rows="3" placeholder="Describe about yourself" name="biografi"><?=$biografi;?></textarea>

                                                <p class="help-block">About yourself in 160 characters or less.</p>

                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <label class="col-sm-3 control-label">Nama Sekolah</label>

                                            <div class="col-sm-5">

                                                <input type="text" class="form-control" name="namasekolah" value="<?=$namaSekolah;?>">    

                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <label class="col-sm-3 control-label">Alamat Sekolah</label>

                                            <div class="col-sm-5">

                                                <input type="text" class="form-control" name="alamatsekolah" value="<?=$alamatSekolah;?>">

                                                <br>

                                            </div>

                                        </div>


                                        <div class="form-group">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-9">

                                                <!-- <input type="text" class="form-control" name="alamatsekolah" value="<?=$alamatSekolah;?>"> -->

                                                <button type="reset" class="btn btn-default">Reset</button>

                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                

                                            </div>

                                        </div>

                                    </div>

                                    <!-- <div class="">

                                        <button type="reset" class="btn btn-default">Reset</button>

                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>

                                    </div> -->

                                </form>

                                <!--/ form profile -->

                            </div>

                            <!--/ tab-pane: profile -->



                            <!-- tab-pane: phto -->

                            <div class="tab-pane" id="photo">

                                <!-- form photo -->

                                <form class="panel form-horizontal form-bordered" name="form-account" action="<?=base_url()?>index.php/siswa/upload/<?=$oldphoto; ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data" >

                                    <div class="panel-body pt0 pb0">

                                        <div class="form-group header bgcolor-default">

                                            <div class="col-md-12">

                                                <h4 class="semibold mt0 mb5">Photo</h4>

                                                <p class="text-default nm">pilih photo baru untuk merubah photo profilmu !</p>

                                            </div>

                                        </div>



                                        <div class="form-group">

                                            <label class="col-sm-3 control-label">Photo</label>

                                            <div class="col-sm-9">

                                                <div class="btn-group pr5">

                                                  

                                                   <img id="preview" class="img-circle img-bordered" src="<?=$photo;?>" alt="" width="34px" />

                                                   

                                                </div>

                                                <div class="btn-group">

                                                   

                                                <input type="file" id="file" name="photo" class="btn btn-default" required="true"/>

                                                </div>


                                            </div>

                                        </div>

                                         <div class="form-group">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-9">

                                                <!-- <input type="text" class="form-control" name="alamatsekolah" value="<?=$alamatSekolah;?>"> -->
                                                <br>
                                                <button type="reset" class="btn btn-default">Reset</button>

                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                

                                            </div>

                                        </div>

                                    </div>

                                </form>

                                <!--/ form Photo -->

                            </div>

                            <!--/ tab-pane: photo -->





                            <!-- tab-pane: email -->

                            <div class="tab-pane" id="email">

                                <!-- form email -->

                                <form class="panel form-horizontal form-bordered" name="form-account" action="<?=base_url()?>index.php/siswa/ubahemailsiswa" method="POST" >

                                    <div class="panel-body pt0 pb0">

                                        <div class="form-group header bgcolor-default">

                                            <div class="col-md-12">

                                                <h4 class="semibold mt0 mb5">Email</h4>

                                                <p class="text-default nm">Masukan email barumu, untuk merubah email yang sekarang digunakan</p>

                                            </div>

                                        </div>



                                        <div class="form-group">

                                            <label class="col-sm-3 control-label">Email</label>

                                            <div class="col-sm-5">

                                                <input type="email" class="form-control" name="email" value="" required="true">

                                                <span class="text-danger"> <?php echo form_error('email'); ?></span>



                                            </div>

                                        </div>

                                         <div class="form-group">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-9">

                                                <!-- <input type="text" class="form-control" name="alamatsekolah" value="<?=$alamatSekolah;?>"> -->
                                                <br>
                                                <button type="reset" class="btn btn-default">Reset</button>

                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                

                                            </div>

                                        </div>




                                    </div>

                                </form>

                                <!--/ form email -->

                            </div>

                            <!--/ tab-pane: email -->







                            <!-- tab-pane: katasandi -->

                            <div class="tab-pane" id="password">

                                <!-- form password -->

                                <form class="panel form-horizontal form-bordered" name="form-password" action="<?=base_url()?>index.php/siswa/ubahkatasandi" method="POST">

                                    <div class="panel-body pt0 pb0">

                                        <div class="form-group header bgcolor-default">

                                            <div class="col-md-12">

                                                <h4 class="semibold mt0 mb5">Kata Sandi</h4>

                                                <p class="text-default nm">Ingin merubah password?</p>

                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <label class="col-sm-3 control-label">Kata Sandi Lama</label>

                                            <div class="col-sm-5">

                                                <input type="password" class="form-control" name="sandilama" required="true">

                                                <p class="help-block"><a href="javascript:void(0);">Forgot password?</a></p>

                                                 <span class="text-danger"> <?php echo form_error('sandilama'); ?></span>

                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <label class="col-sm-3 control-label">Kata Sandi Baru</label>

                                            <div class="col-sm-5">

                                                <input type="password" class="form-control" name="newpass" required="true">

                                                 <span class="text-danger"> <?php echo form_error('newpass'); ?></span>

                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <label class="col-sm-3 control-label">Verifikasi Kata Sandi</label>

                                            <div class="col-sm-5">

                                                <input type="password" class="form-control" name="verifypass" required="true">

                                                 <span class="text-danger"> <?php echo form_error('verifypass'); ?></span>

                                            </div>

                                        </div>
                                         <div class="form-group">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-9">

                                                <!-- <input type="text" class="form-control" name="alamatsekolah" value="<?=$alamatSekolah;?>"> -->
                                                <br>
                                                <button type="reset" class="btn btn-default">Reset</button>

                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                

                                            </div>

                                        </div>

                                    </div>

                                </form>

                            </div>

                            <!--/ tab-pane: password -->

                        </div>

                        <!--/ END Tab-content -->

                    </div>

                    <!--/ Left / Bottom Side -->

                </div>

                <!--/ END row -->

            </div>

            <!--/ END Template Container -->



            <!-- START To Top Scroller -->

            <a href="#" class="totop animation" data-toggle="waypoints totop" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="50%"><i class="ico-angle-up"></i></a>

            <!--/ END To Top Scroller -->



        </section>

        <!--/ END Template Main -->