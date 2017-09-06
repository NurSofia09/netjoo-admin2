<!-- START Template Main -->
<section id="main" role="main">
    <!-- START Template Container -->

    <div class="container-fluid">
        <!-- START row -->
        <div class="row">
            <div class="col-md-8 col-md-offset-2 ">
                <?php if ($this->session->flashdata('notif') != '') {
                    ?>
                    <div class="alert alert-warning fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <span class="semibold">Note :</span><?php echo $this->session->flashdata('notif'); ?>
                    </div>
                <?php } else { ?>
                    <div class="alert alert-warning fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <span class="semibold">Note :</span>&nbsp;&nbsp;Pastikan data form di isi dengan benar.
                    </div>
                <?php }; ?>
                <!-- Form horizontal layout bordered -->
                <form class="form-horizontal panel panel-default login-form " name="form-register" action="<?= base_url() ?>index.php/siswa/editSiswa" method="post">
                    <div class="panel-heading">
                        <h3 class="panel-title">Rubah Data Siswa</h3>
                        <!-- untuk menampung bab id -->
                        <a href="<?= base_url('index.php/siswa/daftar')?>" class="btn btn-default btn-sm pull-right"style="margin-top:-33px;" >Kembali</a>
                    </div>               
                    <div class="panel-body">
                        <br>
                        <div class="">
                            <p class="text-center">IDENTITAS PENGGUNA</p>
                        </div>
                        <div class="clear-both"></div>


                        

                           
                        <div class="form-group">
                            <!--<label class="control-label col-sm-2">Judul Soal</label>-->
                            <div class="col-sm-5 col-md-offset-1">
                                <input type="text" name="idsiswa" hidden="true" value="<?=$siswa['idsiswa'];?>" >
                                <input type="text" name="penggunaID" value="<?= $siswa['penggunaID'] ?>" hidden="true">
                                <input type="text" name="namadepan" class="form-control" placeholder="Nama Depan" required="true" value="<?= $siswa['namaDepan'] ?>">
                                <span class="text-danger"> <?php echo form_error('namadepan'); ?></span>
                            </div>
                            <div class="col-sm-5">
                                <input type="text" name="namabelakang" class="form-control" placeholder="Nama Belakang"  value="<?= $siswa['namaBelakang'] ?>">

                                <span class="text-danger"> <?php echo form_error('namabelakang'); ?></span>
                            </div>

                        </div>

                         
                        <div class="form-group">
                            <div class="col-sm-10 col-md-offset-1">
                                <input type="text" class="form-control" placeholder="Alamat" name="alamat" value="<?= $siswa['alamat'] ?>" data-parsley-required required>
                                <span class="text-danger"> <?php echo form_error('alamat'); ?></span> 
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10 col-md-offset-1">
                                <input type="text" class="form-control" placeholder="No Kontak" name="nokontak" value="<?= $siswa['noKontak'] ?>" data-parsley-required required>
                                <span class="text-danger"> <?php echo form_error('nokontak'); ?></span> 
                            </div>
                        </div>

                        <hr>

                        <div class="">
                            <br>
                            <p class="text-center">IDENTITAS SEKOLAH</p>
                        </div>
                        <div class="clear-both"></div>
                        <div class="form-group">
                            <div class="col-sm-10 col-md-offset-1">
                                 <!-- menampilkan sekolah untuk memfilter kelas siswa-->
                                <select class="form-control" name="nmSekolah" id="nmSekolah"  required>
                                    <?php foreach ($sekolah as $sekolah_item): ?>
                                        <?php if ($sekolah_item['id'] ==$siswa['sekolahID']): ?>
                                            
                                            <option value="<?=$sekolah_item['id'] ?>" selected><?=$sekolah_item['namaSekolah'] ?></option>
                                        <?php else : ?>
                                            <option value="<?=$sekolah_item['id'] ?>"><?=$sekolah_item['namaSekolah'] ?></option>
                                        <?php endif; ?>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>

                     <hr>
                        <div class="">

                            <br>

                            <p class="text-center">IDENTITAS AKUN</p>

                        </div>

                        <div class="form-group">

                            <div class="col-sm-10 col-md-offset-1">

                                <input placeholder="Username" type="text" class="form-control" name="namapengguna" value="<?= $siswa['namaPengguna'] ?>"  data-parsley-required required>

                                <span class="text-danger"><?php echo form_error('namapengguna'); ?></span>

                            </div>

                        </div>

                       <!--  <div class="form-group">

                            <div class="col-sm-10 col-md-offset-1">

                                <input placeholder="Password" type="password" class="form-control" name="katasandi" maxlength="20" value="<?= $siswa['kataSandi'] ?>" required>

                                <span class="text-danger"><?php echo form_error('katasandi'); ?></span>

                            </div>

                        </div> -->

                       <!--  <div class="form-group">

                            <div class="col-sm-10 col-md-offset-1">

                                <input placeholder="Confirm Password" type="password" class="form-control" name="passconf" data-parsley-equalto="input[name=password]" maxlength="20" value="<?= $siswa['kataSandi'] ?>" required>

                                <span class="text-danger"><?php echo form_error('katasandi'); ?></span>



                            </div>

                        </div> -->
                    

                       
                        
                    <div class="panel-footer">
                        <div class="col-md-4 pull-right">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="button" class="btn btn-info">Batal</button>
                        </div>
                    </div>
                </form>
                <!--/ Form horizontal layout bordered -->
            </div>

        </div>
        <!--/ END row -->
    </div>
</section>
<!--/ END Template Main -->
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
<!-- ajax dropdown depedensi -->
<script type="text/javascript">
  function loadTingkat() {
  $(document).ready(function () {
    var oldtkt = $('#oldtkt').val();
    var tingkat_id = {"tingkat_id": $('#tingkatSekolah').val()};
        var idTingkat;
    $.ajax({
    type: "POST",
    dataType: "json",
    data: tingkat_id,
    url: "<?= base_url() ?>index.php/siswa/getTingkatSiswa",

    success: function (data) {

      $('#tingkatSekolah').html('<option value="">-- Pilih Tingkat  --</option>');

      $.each(data, function (i, data) {
        if (data.id==oldtkt) {
             $('#tingkatSekolah').append("<option value='" + data.id + "' selected>" + data.aliasTingkat + "</option>"); 
             $('.Keaktivan').removeClass('hide');
             $("#opNeutron").prop("selected",true);
        }else{
            $('#tingkatSekolah').append("<option value='" + data.id + "'>" + data.aliasTingkat + "</option>");
        }
        

        return idTingkat = data.id;

            });

          }

        });
    });
}
  loadTingkat();
  // event
  $(document).ready(function () {

    if (true) {} else {}

    $('#tingkatSekolah').change(function () {
      tingkat_id = {"tingkat_id": $('#tingkatSekolah').val()};
      loadKelas($('#tingkatSekolah').val());
 
    });
    // set option dropdown bab
    loadKelas($('#oldtkt').val());
  });

  function loadKelas(tingkatID) {
   
    var kelasID = $('#oldkelas').val();
     $.ajax({
        type: "POST",
        dataType: "json",
        data: tingkatID.tingkat_id,
        url: "<?php echo base_url() ?>index.php/siswa/getKelasSiswa/" + tingkatID,
        success: function (data) {
          $('#kelasSiswa').html('<option value="">-- Pilih Kelas  --</option>');
          $.each(data, function (i, data) {
            if (data.id==kelasID) {
                 $('#kelasSiswa').append("<option value='" + data.id + "' selected>" + data.aliasTingkat + "</option>");
            } else {
                 $('#kelasSiswa').append("<option value='" + data.id + "'>" + data.aliasTingkat + "</option>");
            }
           
          });
        }
      });
  }
</script>