<script type="text/javascript" src="<?= base_url('assets/library/jquery/js/upbar.js') ?>"></script>

<script type="text/javascript" src="<?= base_url('assets/library/jquery/js/jequery.form.js') ?>"></script>

<!-- START Template Main -->
<section id="main" role="main">

  <!-- get data siswa unutk di tampilkan di form -->

        <!-- START row -->

        <div class="row">

            <!-- Left / Top Side -->

            <div class="col-lg-3">

                <!-- tab menu -->

                <ul class="list-group list-group-tabs">
                    <li class="list-group-item active"><a href="#profile" data-toggle="tab"><i class="ico-user2 mr5"></i> Profile</a></li>
                    <li class="list-group-item"><a href="#photo" data-toggle="tab"><i class="ico-camera3 mr5"></i>Photo</a></li>
                    <li class="list-group-item"><a href="#email" data-toggle="tab"><i class="ico-envelop2 mr5"></i>Email</a></li>
                    <li class="list-group-item"><a href="#password" data-toggle="tab"><i class="ico-key2 mr5"></i> Password</a></li>
                </ul>
                <!-- tab menu -->
                <hr><!-- horizontal line -->
                <!-- figure with progress -->
                <ul class="list-table">
                    <li style="width:70px;">
                        <img class="img-circle img-bordered" src="<?=$photo;?>" alt="" width="65px">
                    </li>
                    <li class="text-left">
                        <h5 class="semibold ellipsis mt0"><?=$this->session->userdata['USERNAME'] ;?></h5>
                        <div style="max-width:200px;">
                            <div class="progress progress-xs mb5">
                                <div class="progress-bar progress-bar-warning" style="width:100%"></div>
                            </div>
                            <p class="text-muted clearfix nm">
                                <span class="pull-left"><?=$guru["namaDepan"].' '.$guru["namaBelakang"];?></span>
                            </p>
                        </div>
                    </li>
                </ul>
                <!--/ figure with progress -->
                <hr><!-- horizontal line -->
            </div>
            <!--/ Left / Top Side -->
            <!-- Left / Bottom Side -->
            <div class="col-lg-9">
                <!-- START Tab-content -->
                <div class="tab-content">
                    <!-- tab-pane: profile -->
                    <div class="tab-pane active" id="profile">
                        <!-- form profile -->
                        <form class="panel form-horizontal form-bordered" name="form-profile" action="<?=base_url()?>index.php/guru/ubahprofileguru" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                            <div class="panel-body pt0 pb0">
                                <div class="form-group header bgcolor-default">
                                    <div class="col-md-12">
                                        <h4 class="semibold text-primary mt0 mb5">Profile </h4>
                                        <p class="text-default nm">This information appears on your public profile, search results, and beyond.</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Name</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" name="namadepan" value="<?=$guru['namaDepan'];?>">
                                        <span class="text-danger"> <?php echo form_error('namadepan'); ?></span>
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" name="namabelakang" value="<?=$guru['namaBelakang'];?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Matapelajaran</label>
                                    <div class="col-sm-6">
                                      <select class="form-control" name="mataPelajaran" id="mataPelajaran">
                                        <option value="">-Pilih Matapelajaragn-</option>
                                        <?php 
                                        foreach ($mataPelajaran as $row) {
                                            $id = $row['id'];
                                            $aliasMataPelajaran = $row['aliasMataPelajaran'];
                                            echo "<option value='".$id."'' id='id-".$id."'>".$aliasMataPelajaran." </option>";
                                        } ;
                                        ?> 
                                    </select>
                                     <input type="text" name="sumMapel" value="0" hidden="true">
                                     <input type="text" name="reset" value="0"  hidden="true">
                                </div>
                            </div>
                            <div class="form-group" id="keahlian-guru">
                                <a class="btn btn-sm btn-danger ml10" id="resetMapel">Reset</a>
                                <?php echo $guruMapel; ?>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Alamat</label>
                                <div class="col-sm-6">
                                   <input type="text" class="form-control" name="alamat" value="<?=$guru['alamat']; ?>">
                                   <span class="text-danger"> <?php echo form_error('namadepan'); ?></span>
                               </div>
                           </div>
                           <div class="form-group">
                            <label class="col-sm-3 control-label">No Kontak</label>
                            <div class="col-sm-6">
                               <input type="text" class="form-control" name="nokontak" value="<?=$guru['noKontak'];?>">
                               <span class="text-danger"> <?php echo form_error('nokontak'); ?></span>
                           </div>
                       </div>
                       <div class="form-group">
                        <label class="col-sm-3 control-label">Bio</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" rows="3" placeholder="Describe about yourself" name="biografi"><?=$guru['biografi'];?></textarea>
                            <p class="help-block">About yourself in 160 characters or less.</p>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <button type="reset" class="btn btn-default">Reset</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
            <!--/ form profile -->

        </div>

        <!--/ tab-pane: profile -->



        <!-- tab-pane: phto -->

        <div class="tab-pane" id="photo">

            <!-- form photo -->

            <form class="panel form-horizontal form-bordered" name="form-account" action="<?=base_url()?>index.php/guru/upload/<?=$oldphoto; ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data" >

                <div class="panel-body pt0 pb0">

                    <div class="form-group header bgcolor-default">

                        <div class="col-md-12">

                            <h4 class="semibold text-primary mt0 mb5">Photo</h4>

                            <p class="text-default nm">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p>

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





            </div>

            <div class="panel-footer">

                <button type="reset" class="btn btn-default">Reset</button>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>

            </div>

        </form>

        <!--/ form Photo -->

    </div>

    <!--/ tab-pane: photo -->





    <!-- tab-pane: email -->

    <div class="tab-pane" id="email">

        <!-- form email -->

        <form class="panel form-horizontal form-bordered" name="form-account" action="<?=base_url()?>index.php/guru/ubahemailGuru" method="POST" >

            <div class="panel-body pt0 pb0">

                <div class="form-group header bgcolor-default">

                    <div class="col-md-12">

                        <h4 class="semibold text-primary mt0 mb5">Email</h4>

                        <p class="text-default nm">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p>

                    </div>

                </div>



                <div class="form-group">

                    <label class="col-sm-3 control-label">Email</label>

                    <div class="col-sm-5">

                        <input type="email" class="form-control" name="email" value="<?=$eMail;?>" required="true">

                        <span class="text-danger"> <?php echo form_error('email'); ?></span>



                    </div>

                </div>





            </div>

            <div class="panel-footer">

                <button type="reset" class="btn btn-default">Reset</button>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>

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

                        <h4 class="semibold text-primary mt0 mb5">Kata Sandi</h4>

                        <p class="text-default nm">Change your password or recover your current one.</p>

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

            </div>

            <div class="panel-footer">

                <button type="reset" class="btn btn-default">Reset</button>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>

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

<!--/ END Template Container -->



<!-- START To Top Scroller -->

<a href="#" class="totop animation" data-toggle="waypoints totop" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="50%"><i class="ico-angle-up"></i></a>

<!--/ END To Top Scroller -->



   



</section>

        <!--/ END Template Main -->
<script type="text/javascript">
$(function () {
  $('#file').on('change',function () {
    var file = this.files[0];
    var reader = new FileReader();
    reader.onload = viewer.load;
    reader.readAsDataURL(file);
    viewer.setProperties(file);
  });
  var viewer = {
    load : function(e){
      $('#preview').attr('src', e.target.result);
    },
    setProperties : function(file){
      $('#filename').text(file.name);
      $('#filetype').text(file.type);
      $('#filesize').text(Math.round(file.size/1024));
    },
  }
});
</script>
<script type="text/javascript">
  $(document).ready(function(){ 
      var i =0;

    $('#mataPelajaran').change(function () {
      i ++;
      var idMapel =$('#mataPelajaran').val();
      var mapel =$('#mataPelajaran option:selected').text();
      $("#keahlian-guru").append('<span class="note note-success mb15 mr15 mt15 pickMapel" id="mapelke-'+i+'"> <i class="ico-remove" onClick="removeMapel('+i+','+idMapel+')"></i> '+mapel+' </span> <input type="text" name="mapelIDke-'+i+'" value="'+idMapel+'" hidden="true" id="mapelIDke-'+i+'">');
        // var ini = $("mapelke-"+i).text();
        // console.log(ini);
      $('[name=sumMapel]').val(i);
      //remove mapel dari dropdown
      $("#id-"+idMapel).addClass("hidden");
    });
    $( "#resetMapel" ).click(function() {
         i=0;
        $('.op').removeClass("hidden"); 
         $('[name=sumMapel]').val(i);
      $('.pickMapel').remove();
      $('[name=reset]').val(1);

    }); 
  }); 
</script>