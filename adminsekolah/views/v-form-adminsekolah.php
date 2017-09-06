  <!-- START Template Main -->
  <section id="main" role="main">
    <!-- START Register Content -->
    <section class="container">
        <div class="row">
            <div class="col-md-11">
               
                <!-- Register form -->

                <form class="panel nm" name="form-register" action="<?=base_url()?>index.php/adminsekolah/saveAdminsekolah" method="post">
                 <div class="text-center" style="margin-bottom:20px;">
                    <br><h5 class="semibold text-muted mt-5"><br>Membuat Akun Admin Sekolah</h5>
                </div>
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

                       

                        <div  class="form-group">
          <label class="col-sm-12 control-label">Nama Sekolah</label><br>
          <div class="col-sm-12">
            <select class="form-control" name="sekolah" id="sekolah">
              <option>-Pilih Sekolah-</option>
            </select>
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


//buat load tingkat
    function loadSekolah() {
      jQuery(document).ready(function () {
        var sekolah_id = {"sekolah_id": $('#sekolah').val()};
        var idSekolah;
        $.ajax({
          type: "POST",
          dataType: "json",
          data: sekolah_id,

          url: "<?= base_url() ?>index.php/adminsekolah/getsekolah",

          success: function (data) {

            console.log("Data" + data);

            $('#sekolah').html('<option value="">-- Pilih Sekolah  --</option>');

            $.each(data, function (i, data) {

              $('#sekolah').append("<option value='" + data.id + "'>" + data.namaSekolah + "</option>");

              return idSekolah = data.id;

            });

          }

        });

        $('#sekolah').change(function () {
          sekolah_id = {"sekolah_ids": $('#sekolah').val()};
          loadPelajaran($('#sekolah').val());
        })

        $('#pelajaran').change(function () {
          pelajaran_id = {"pelajaran_id": $('#pelajaran').val()};
          load_bab($('#pelajaran').val());
        })
        $('#bab').change(function () {
          load_sub_bab($('#bab').val());
        })
      })
    }
    ;
    loadSekolah();

</script>