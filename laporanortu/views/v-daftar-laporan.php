<!-- Start Modal salah upload gambar -->
<div class="modal fade" id="cekInput" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h2 class="modal-title text-center text-danger">Peringatan</h2>
      </div>
      <div class="modal-body">
        <h3 class="text-center">Silahkan pilih nama cabang, nama tryout dan nama paket ! </h3>
        <!-- <h5 class="text-center">Type yang bisa di upload hanya ".jpg", ".jpeg", ".bmp", ".gif", ".png"</h5> -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="row">
  <div class="col-md-12 kirim_token">
    <div class="panel panel-teal">
      <div class="panel-heading">
        <h3 class="panel-title">Daftar Laporan </h3> 
        <div class="panel-toolbar text-right">
        <div class="col-md-11">

           <div class="col-sm-4" id="cabang">
             <select class="form-control" name="cabang">
              <option value="all">Semua Cabang</option>
              <?php foreach ($cabang as $item): ?>
                <option value="<?=$item->id ?>"><?=$item->namaCabang ?></option>
              <?php endforeach ?>
            </select>
          </div>

          <div class="col-sm-4">
            <select class="form-control" name="tingkat_pel">
              <option value="all">Semua Tingkat</option>
              <option value="SD">SD</option>
              <option value="SMP">SMP</option>
              <option value="SMA">SMA</option>
            </select>
          </div>

        <div class="kelas col-sm-4">
          <select class="form-control col-sm-6" name="kelas">
            <option value="all">Semua Kelas</option>
          </select>
        </div>

        </div>
    </div>

</div>

<div class="panel-body">
  <div class="nama_cabang">
  </div>
  <div class="tingkat_pilih">
  </div>
  <form  class="panel panel-default form-horizontal form-bordered form-step"  method="post" >
         <div  class="form-group">
           <label class="col-sm-2 control-label">Jenis Laporan</label>
           <div class="col-sm-9">
             <!-- stkt = soal tingkat -->
             <select class="form-control" name="jenis">
              <option value="all">-- Pilih Jenis --</option>
              <option value="nilai">Nilai</option>
              <option value="absen">Absen</option>
              <option value="umum">Umum</option>
            </select>
          </div>
        </div>
      </form>
  <table class="daftarreport table table-striped display responsive nowrap" style="font-size: 13px" width=100%>
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Orang Tua</th>
        <th>Nama Siswa</th>
        <th>Username</th>
        <th>Message</th>

        <!-- <th>
          <span class="checkbox custom-checkbox check-all">
            <input type="checkbox" name="checkall" id="check-all">
              <label for="check-all">&nbsp;&nbsp;</label>
          </span> 
        </th> -->
      </tr>
    </thead>

    <tbody>

    </tbody>
  </table>
  <!-- <a class="btn btn-primary send_laporan">Kirim</a> -->
</div>

</div>
</div>   
</div>
<script type="text/javascript">
var dataTableReport;
$(document).ready(function(){
  var mySelect = $('select[name=cabang]').val();
  dataTableReport = $('.daftarreport').DataTable({
    "ajax": {
      "url": base_url+"laporanortu/laporanortu_ajax",
      "type": "POST"
    },
    "emptyTable": "Tidak Ada Data Pesan",
    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
    "bDestroy": true,
  });


});


// CABANG KETIKA DI CHANGE
$('select[name=cabang]').change(function(){

  cabang = $('select[name=cabang]').val();
  tingkat = $('select[name=tingkat_pel]').val();
  kelas = $('select[name=kelas]').val();
  jenis_lapor = $('select[name=jenis]').val();

  url = base_url+"laporanortu/laporanortu_ajax/"+cabang+"/"+tingkat+"/"+kelas+"/"+jenis_lapor;

  dataTableReport = $('.daftarreport').DataTable({
    "ajax": {
      "url": url,
      "type": "POST"
    },
    "emptyTable": "Tidak Ada Data Pesan",
    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
    "bDestroy": true,
  });
  set_cab(cabang);
});


// TINGKAT KETIKA DI CHANGE
$('select[name=tingkat_pel]').change(function(){
  cabang = $('select[name=cabang]').val();
  tingkat = $('select[name=tingkat_pel]').val();
  kelas = $('select[name=kelas]').val();
  jenis_lapor = $('select[name=jenis]').val();

  url = base_url+"laporanortu/laporanortu_ajax/"+cabang+"/"+tingkat+"/"+kelas+"/"+jenis_lapor;

  dataTableReport = $('.daftarreport').DataTable({
    "ajax": {
      "url": url,
      "type": "POST"
    },
    "emptyTable": "Tidak Ada Data Pesan",
    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
    "bDestroy": true,
  });

  load_kelas(tingkat);
  $('.tingkat_pilih').html("<h4>Tingkat : "+tingkat+"</h4>");

});

// LOAD KELAS
function load_kelas(tingkat){
 $.ajax({
  type: "POST",
  url: "<?php echo base_url() ?>laporanortu/get_kelas/"+tingkat,
  success: function(data){
   $('select[name=kelas]').html('<option value="all">-- Pilih Kelas  --</option>');

   $.each(data, function(i, data){
    $('select[name=kelas]').append("<option value='"+data.aliasTingkat+"'>"+data.aliasTingkat+"</option>");
  });
 }

});
}

// GET CABANG UNTUK DITAMPILKAN
function set_cab(id_cabang){
 $.ajax({
  type: "POST",
  url: "<?php echo base_url() ?>laporanortu/set_cabang/"+id_cabang,
  success: function(data){

   $.each(data, function(i, data){
    $('.nama_cabang').html("<h4>Cabang : "+data.namaCabang+"</h4>");
  });
 }

});
}

// KELAS KETIKA DI CHANGE
$('select[name=kelas]').change(function(){

  cabang = $('select[name=cabang]').val();
  tingkat = $('select[name=tingkat_pel]').val();
  kelas = $('select[name=kelas]').val();
  jenis_lapor = $('select[name=jenis]').val();

  url = base_url+"laporanortu/laporanortu_ajax/"+cabang+"/"+tingkat+"/"+kelas+"/"+jenis_lapor;

  dataTableReport = $('.daftarreport').DataTable({
    "ajax": {
      "url": url,
      "type": "POST"
    },
    "emptyTable": "Tidak Ada Data Pesan",
    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
    "bDestroy": true,
  });

  $('.tingkat_pilih').html("<h4>Tingkat : "+kelas+"</h4>");

});

// JENIS KETIKA DI CHANGE
$('select[name=jenis]').change(function(){

  cabang = $('select[name=cabang]').val();
  tingkat = $('select[name=tingkat_pel]').val();
  kelas = $('select[name=kelas]').val();
  jenis_lapor = $('select[name=jenis]').val();

  url = base_url+"laporanortu/laporanortu_ajax/"+cabang+"/"+tingkat+"/"+kelas+"/"+jenis_lapor;

  dataTableReport = $('.daftarreport').DataTable({
    "ajax": {
      "url": url,
      "type": "POST"
    },
    "emptyTable": "Tidak Ada Data Pesan",
    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
    "bDestroy": true,
  });
});

function pdf() {
  /// TOMBOL PDF KETIKA DI KLIK
  cabang = $('select[name=cabang]').val();
  tryout = $('select[name=to]').val();
  paket = $('select[name=paket]').val();
  if (cabang != "all" && tryout != "all" && paket != "all") {
      url = base_url+"admincabang/admincabang/laporanPDF/"+cabang+"/"+tryout+"/"+paket;
      window.open(url, '_blank');
  }else{
    $("#cekInput").modal("show");
  }
}

$('[name="checkall"]:checkbox').click(function () {
 if($(this).attr("checked")){
  $('table.daftarreport tbody input:checkbox').prop( "checked", true );
} else{ 
  $('table.daftarreport tbody input:checkbox').prop( "checked", false );
}
});

// KETIKA BUTTON KIRIM DIKLIK
$('.send_laporan').click(function(){
  kirim_laporan();
  console.log("masuk");
});

//fungsi kirim laporan
function kirim_laporan(){
  //tampung id ortu
  id_ortu = [];

  // tamopung isi pesan
  pesan = [];
  
  //tampung jenis laporan
  jenis_lapor = $('select[name=jenis]').val();

  //cek kalo belum set masa aktif
  if (jenis_lapor==0) {
    swal('silahkan tentukan jenis terlebih dahulu');
    $('select[name=jenis]').focus();
  }else{
   $('.daftarreport tbody td :checkbox:checked').each(function(i){
     id_ortu[i] = $(this).val();
   }); 

   $('.pesan').each(function(i){
     pesan[i] = $(this).val();
   }); 
   
   jumlah_ortu = id_ortu.length;

   // cek jumlah ortu yang dipilih
   if (jumlah_ortu==0) {
    swal('Silahkan tentukan ortu terlebih dahulu');
  }else{
      data = {
        id_ortu:id_ortu,
        jumlah_ortu:jumlah_ortu,
        jenis_lapor:jenis_lapor,
        isi:pesan
      };
      $.ajax({
        url:base_url+"laporanortu/kirim_laporan",
        data:data,
        type:"POST",
        dataType:"TEXT",
        success:function(){
          swal('Laporan Berhasil Di Kirim');
          reload();
        },error:function(){
          swal('Gagal mengirim Laporan');
        }
      });
    
  }
}

}

function reload(){
  dataTableReport.ajax.reload(null,false); 
}

</script>
