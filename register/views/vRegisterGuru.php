  <!-- START Template Main -->
  <section id="main" role="main">
    <!-- START Register Content -->
    <section class="container">
        <div class="row">

            <div class="col-md-10">

                <div class="text-center" style="margin-bottom:20px;">

                    <img src="<?=base_url('assets/back/img/logo-tara.png') ?>" > 

                    <br><h5 class="semibold text-muted mt-5"><br>Membuat Akun Guru</h5>

                </div>

                <!-- Register form -->
                <form class="panel nm" name="form-register" action="<?=base_url()?>index.php/register/test" method="post">

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

                            <label class="col-md-12 control-label">Nama</label>

                            <div class="col-md-6">

                                <div class="has-icon pull-left">

                                    <input type="text" class="form-control" name="namadepan" value="<?php echo set_value('namadepan'); ?>" placeholder="Nama Depan" required>

                                    <i class="ico-user2 form-control-icon"></i>

                                    <!-- untuk menampilkan pesan kesalahan penginputan alamat -->

                                    <span class="text-danger"> <?php echo form_error('namadepan'); ?></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                             <input type="text" class="form-control" name="namabelakang" value="<?php echo set_value('namabelakang'); ?>" placeholder="Nama Belakang" data-parsley-required>
                         </div>
                     </div>
                     <div class="col-md-12 form-group">
                         <label class="control-label">Mata Pelajaran</label>
                         <div class="has-icon pull-left">
                            <select class="form-control"  name="mataPelajaran" id="mataPelajaran" required>
                                <option value >-Pilih Matapelajaran-</option>
                                <?php 
                                foreach ($mataPelajaran as $row) {
                                    $id = $row['id'];
                                    $aliasMataPelajaran = $row['aliasMataPelajaran'];
                                    echo "<option class='op' value='".$id."'' id='id-".$id."'>".$aliasMataPelajaran." </option>";

                                } ;

                                ?> 
                            </select>
                            <input type="text" name="sumMapel" value="" hidden="true">
                            <span class="text-danger"> <?php echo form_error('mataPelajaran'); ?></span>

                        </div>
                    </div>

                    <div class="col-md-6 form-group" id="keahlian-guru">
                    <a class="btn btn-sm btn-danger" id="resetMapel">Reset</a>
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

                    <div class="col-md-12 form-group fg-nmPengguna">

                        <label class="control-label">Nama Pengguna</label>

                        <div class="has-icon pull-left">

                            <input type="text" class="form-control " name="namapengguna" value="<?php echo set_value('namapengguna'); ?>" onblur="cekNamaPengguna()" required  >
                            

                            <i class="ico-tag9 form-control-icon"></i>

                            <!-- untuk menampilkan pesan kesalaha penginputan nama pengguna -->

                            <span class="text-danger msg-namaPengguna hidden ">*Nama pengguna sudah terpakai</span>

                        </div>

                    </div>

                    <div class="col-md-12 form-group">

                        <label class="control-label">Kata Sandi</label>

                        <div class="has-icon pull-left">

                            <input type="password" class="form-control" name="katasandi" required>

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

                    <div class="form-group fg-email">

                        <label class="control-label">Email</label>

                        <div class="has-icon pull-left">

                            <input type="email" class="form-control" name="email" value="<?php echo set_value('email'); ?>" onblur="cekEmail()" placeholder="you@mail.com">

                            <i class="ico-envelop form-control-icon"></i>

                            <!-- untuk menampilkan pesan kesalahan penginputan email -->

                             <span class="text-danger msg-email hidden ">*Email sudah terpakai</span>

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

                    <button type="submit" class="btn btn-block btn-success" id="kirimdata"  disabled ><span class="semibold" >Sign up</span></button>

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

<!--  -->
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

    }); 


      // var datas = {
      //       subBab:subBab,
      //       option_up:option_up,
      //       video:video,
      //       link_video:link_video,
      //       tumbnail:tumbnail,
      //       jenis_video:jenis_video,
      //       judulvideo:judulvideo,
      //       deskripsi:deskripsi,
      //       publish:publish
      // };
      
      // $('#kirimdata').click(function () {
      //   for (x = 1; x < i+1; x++) {
      //     var mapelID = $('#mapelIDke-'+x).val();
      //     console.log(mapelID);
      //   }
     
      // });


  });

// function removeMapel(i,idMapel) {
//   // $("#mapelke-"+i).remove();
//   $("#id-"+idMapel).removeClass("hidden");  
//       i=0;
//       $('.pickMapel').remove();
// }


</script>

<!--   Event      -->
<script type="text/javascript">
  function cekNamaPengguna() {
    var namaPengguna=$('[name=namapengguna]').val();
    if (namaPengguna) {
      var url =base_url + "index.php/guru/cekNamaPengguna/";
      $.ajax({
        dataType:"text",
        data:{namapengguna:namaPengguna},
        type:"POST",
        url:url,
        success:function(data){
          var parData=JSON.parse(data);
          if (parData=="FALSE") {
            console.log("das");
            $(".msg-namaPengguna").removeClass('hidden');
            $(".fg-nmPengguna").addClass('has-error');
            $(".fg-nmPengguna").removeClass('has-success');
          } else {
             $(".fg-nmPengguna").addClass('has-success');
             $(".fg-nmPengguna").removeClass('has-error');
             $(".msg-namaPengguna").addClass('hidden');
          }
          
        }


      });
    }else{
       $(".fg-nmPengguna").addClass('has-error');
    }
  }


  function cekEmail() {
    var email=$('[name=email]').val();
    if (email) {
      var url =base_url + "index.php/guru/cekEmail/";
      $.ajax({
        dataType:"text",
        data:{email:email},
        type:"POST",
        url:url,
        success:function(data){
          var parData=JSON.parse(data);
          if (parData=="FALSE") {
            console.log("das");
            $(".msg-email").removeClass('hidden');
            $(".fg-email").addClass('has-error');
            $(".fg-email").removeClass('has-success');
          } else {
             $(".fg-email").addClass('has-success');
             $(".fg-email").removeClass('has-error');
             $(".msg-email").addClass('hidden');
          }
          
        }


      });
    }else{
       $(".fg-email").addClass('has-error');
    }
  }
</script>
