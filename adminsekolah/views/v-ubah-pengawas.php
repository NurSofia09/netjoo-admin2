  <!-- START Template Main -->

  <section id="main" role="main">

    <!-- START Register Content -->

    <section class="container">

        <div class="row">

            <div class="col-md-10">

                <div class="text-center" style="margin-bottom:20px;">

                    <img src="<?=base_url('assets/back/img/logo-tara.png') ?>" > 

                    <br><h5 class="semibold text-muted mt-5"><br>Ubah Akun Admin Sekolah</h5>

                </div>

                <!-- Register form -->
                <form class="panel nm" name="form-register" action="<?=base_url()?>index.php/adminsekolah/editAdminsekolah" method="post">
                <input type="text" value="<?=$oldData['uuid'];?>" name="uuid" hidden="true">
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
                        

          <label class="col-sm-12 control-label">Nama Sekolah</label><br>
          <input name="sekolah" type="text" id="oldtkt" value="<?=$oldData['sekID'];?>" hidden="true">
          <div class="col-sm-12">
            <select class="form-control" name="sekolah" id="sekolah">
              <option>-Pilih Sekolah-</option>
            </select>
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


<script type="text/javascript">
    

//buat load tingkat
    function loadSekolah() {
      jQuery(document).ready(function () {
        var oldtkt = $('#oldtkt').val();
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
            if (data.id==oldtkt) {
               $('#sekolah').append("<option value='" + data.id + "' selected>" + data.namaSekolah + "</option>");
             } else {
              $('#sekolah').append("<option value='" + data.id + "'>" + data.namaSekolah + "</option>");
          }

              return idSekolah = data.id;

            });

          }

        });


        $('#sekolah').change(function () {
          sekolah_id = {"sekolah_ids": $('#sekolah').val()};
        })

        
      })
    }
    ;
    loadSekolah();




</script>






