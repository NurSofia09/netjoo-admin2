<script>
/*## -------------------------------LOAD TINGKAT DAN KAWAN KAWAN-------------------------------##*/
load_tingkat();
function load_tingkat() {
 jQuery(document).ready(function () {
  var idTingkat;

  $.ajax({
   type: "POST",
   url: "<?= base_url() ?>index.php/videoback/getTingkat",
   success: function (data) {
    $('select[name=select_tingkat]').html('<option value="">-- Pilih Tingkat  --</option>');
    $.each(data, function (i, data) {
     $('select[name=select_tingkat]').append("<option value='" + data.id + "'>" + data.aliasTingkat + "</option>");
     return idTingkat = data.id;
   });
  }
});

  /*## -------------------------------SALAT SELECT DIPILIH-------------------------------##*/
  $('select[name=select_tingkat]').change(function () {
   tingkat_id = $('select[name=select_tingkat]').val();
   load_pelajaran(tingkat_id);
 });


  $('select[name=select_mapel]').change(function () {
   pelajaran_id = $('select[name=select_mapel]').val()
   load_bab(pelajaran_id);
 });
  /*## -------------------------------SALAT SELECT DIPILIH-------------------------------##*/

});

};

/*## -------------------------------LOAD PELAJARAN-------------------------------##*/
function load_pelajaran(tingkatID) {
  $.ajax({
    type: "POST",
    url: "<?php echo base_url() ?>index.php/videoback/getPelajaran/" + tingkatID,
    success: function (data) {
     $('select[name=select_mapel]').html('<option value="">-- Pilih Mata Pelajaran  --</option>');
     $.each(data, function (i, data) {
      $('select[name=select_mapel]').append("<option value='" + data.id + "'>" + data.keterangan + "</option>");
    });
   }
 });
}
/*## -------------------------------LOAD PELAJARAN-------------------------------##*/


/*## -------------------------------LOAD BAB-------------------------------##*/
// load bab 
function load_bab(mapelID) {
  $.ajax({
    type: "POST",
    url: "<?php echo base_url() ?>index.php/videoback/getBab/" + mapelID,
    success: function (data) {
     $('select[name=select_bab]').html('<option value="">-- Pilih Bab Pelajaran  --</option>');
     $.each(data, function (i, data) {
      $('select[name=select_bab]').append("<option value='" + data.id + "'>" + data.judulBab + "</option>");
    });
   }
 });
}
/*## -------------------------------LOAD BAB-------------------------------##*/

/*## #########################LOAD TINGKAT DAN KAWAN KAWAN######################### ##*/


/*## ------------------------------saat button simpan diklik-------------------------------##*/
/*## ------------------------------ SIMPAN TOPIK-------------------------------##*/
$('input[name=urutan]').keyup(function () {
    if (this.value != this.value.replace(/[^0-9\.]/g, '')) {
       this.value = this.value.replace(/[^0-9\.]/g, '');
    }
});

$('.simpanlearning').click(function(){
  data = 
  {babID:$('input[name=select_bab]').val(),
  statusLearning:1,
  deskripsi:$('textarea[name=deskripsi]').val(),
  namaTopik:$('input[name=nama_topik]').val(),
  urutan:$('input[name=urutan]').val()
};
  if (data.statusLearning=="kosongundefined" || data.namaTopik=="") {
    swal('Silahkan lengkapi data');
  }else{
    var url = base_url+"learningline/ajax_insert_line_topik";
    $.ajax({
      data:data,
      datatType:"text",
      url:url,
      type:"POST",
      success:function(){
        swal('Topik berhasil ditambahkan');
        $('.form-topik')[0].reset();
        swal({
          title: "Topik berhasil ditambahkan!",
          text: "Tambahkan baru, atau selesai?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Selesai",
          cancelButtonText: "Tambah",
          closeOnConfirm: false,
          closeOnCancel: false
        },
        function(isConfirm){
          if (isConfirm) {
            swal("selesai", "Anda akan dialihkan ke daftar topik", "success");
            link = base_url+"learningline/topik/"+data.babID;
            window.location.href = link;
            console.log(link);
          } else {
          // swal("Cancelled", "Your imaginary file is safe :)", "error");
        }
      });

      },
      error:function(){
        sweetAlert('Data gagal disimpan','error');
      }
    });
  }

});
/*## ------------------------------saat button simpan diklik-------------------------------##*/
</script>