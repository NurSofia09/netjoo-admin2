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
                            <input type="text" id="oldtkt" value="<?=$siswa['tingkatID'];?>" hidden >
                            <input type="text" id="oldkelas" value="<?=$siswa['kelasID'];?>" hidden>
                        </div>
                        <div class="clear-both"></div>
                        <div class="form-group">
                            <div class="col-sm-5 col-md-offset-1">
                                <!-- menampilkan tingkat sekolah untuk memfilter kelas siswa-->
                                <select class="form-control" name="tingkatSiswaID" id="tingkatSekolah"  required>
                                
                                 
                                </select>
                            </div>
                            <!-- menampilkan kelas siswa yg telah di filer berdasarkan tingkat sekolah -->
                             <div class="col-sm-5 ">
                                <select class="form-control" name="tingkatID" id="kelasSiswa"  required>
                                
                                  
                                </select>
                            </div>
                        </div>
                          
                        <div class="form-group">
                            <div class="col-sm-10 col-md-offset-1">
                                <input type="text" placeholder="Nama Sekolah" class="form-control" name="namasekolah" value="<?= $siswa['namaSekolah']?>" data-parsley-required required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-10 col-md-offset-1">
                                <input placeholder="Alamat Sekolah" type="text" class="form-control" name="alamatsekolah" value="<?= $siswa['alamatSekolah']?>" data-parsley-required required>
                            </div>
                        </div>

                     <hr>
                     <!-- Start form data bimbel -->
                        <div  class="form-group">
                             <div class="col-sm-10 col-md-offset-1">


                                <p class="text-center">BIMBEL</p>

                                <!-- list Bimbel -->
                                <select class="form-control" name="bimbel">
                                    <option value="">- Pilih Bimbel Kalian -</option>
                                    <option value="Neutron" id="opNeutron">Neutron</option>
                                    <option value="GO">GO</option>
                                    <option value="1bimbel lainya">Bimbel lainya</option>
                                </select>
                                    <!-- untuk menampilkan pesan kesalaha penginputan nama pengguna -->
                                    <span class="text-danger"><?php echo form_error('bimbel'); ?></span>
                             
                                <!--  -->

                            </div>
                        </div>
                       
                        <hr class="Keaktivan hide" >
                        <!-- start from data siswa neon -->
                            <div class="form-group Keaktivan hide " >
                                 <div class="col-sm-10 col-md-offset-1">
                                <p class="text-center">DATA NEON</p>
                                </div>
                            </div> 
                            <div class="form-group Keaktivan hide ">
                                <div class="col-sm-10 col-md-offset-1">
                                    <select class="form-control" name="cabang">
                                        <option value="">- Pilih Cabang -</option>
                                        <?php foreach ($cabang as $cabang_item): ?> 

                                        <?php if ($cabang_item->id==$siswa['cabangID']): ?>
                                            <option value="<?=$cabang_item->id ?>" selected><?=$cabang_item->namaCabang ?></option>
                                        <?php endif ?>
                                            <option value="<?=$cabang_item->id ?>" ><?=$cabang_item->namaCabang ?></option>
                                            
                                        <?php endforeach ?>
                                    </select>
                                    <!-- untuk menampilkan pesan kesalaha penginputan nama pengguna -->
                                    <span class="text-danger"><?php echo form_error('cabang'); ?></span>
                                </div>
                            </div>

                            <div class="form-group Keaktivan hide">

                                <div class="col-sm-10 col-md-offset-1">

                                    <input placeholder="Nomer Induk Siswa Neutron contoh : 120300xxx" type="text" class="form-control" name="noinduk" value="<?php echo set_value('noinduk'); ?>" data-parsley-required>

                                    <i class="ico-tag9 form-control-icon"></i>

                                    <!-- untuk menampilkan pesan kesalaha penginputan nama pengguna -->

                                    <span class="text-danger"><?php echo form_error('noinduk'); ?></span>

                                </div>

                            </div>
                        <!-- end from data siswa neon  -->
       
                        <!-- end form data bimbel -->
                        
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