<section class="section bgcolor-white"> 
<div class="container">
 <div class="row">
            <style type="text/css">

                .table th:hover{

                    cursor: hand;

                }

                .pagination li:before{

                    color:white;

                }

</style>
<div class="col-md-12">
<h3>Daftar Pesan</h3>
<div  style="right: 13px; width: 49%;" >
            <select class="form-control" name="jenis">
              <option value="all">Semua Jenis</option>
              <option value="nilai">Nilai</option>
              <option value="absen">Absen</option>
              <option value="umum">Umum</option>
            </select>
          </div>
         <br>
     <table class=" table daftarreport nowrap" style="font-size: 13px">
    <thead>
      <tr>
        <th>No</th>
        <th>Jenis</th>
        <th>Pesan</th>
      </tr>
    </thead>

    <tbody>

    </tbody>
  </table>
      </div>
  </div>

</div>
</div>   
</div>
 </section>
<script type="text/javascript">
var dataTableReport;
$(document).ready(function(){
  var mySelect = $('select[name=cabang]').val();
  dataTableReport = $('.daftarreport').DataTable({
    "ajax": {
      "url": base_url+"ortuback/report_ajax",
      "type": "POST"
    },
    "emptyTable": "Tidak Ada Data Pesan",
    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
    "bDestroy": true,
  });


});


// JENIS KETIKA DI CHANGE
$('select[name=jenis]').change(function(){

  jenis = $('select[name=jenis]').val();

  url = base_url+"ortuback/report_ajax/"+jenis;

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


// TINGKAT KETIKA DI CHANGE
$('select[name=tingkat_pel]').change(function(){
  cabang = $('select[name=cabang]').val();
  tingkat = $('select[name=tingkat_pel]').val();
  kelas = $('select[name=kelas]').val();

  url = base_url+"laporanortu/laporanortu_ajax/"+cabang+"/"+tingkat+"/"+kelas;

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

// KELAS KETIKA DI CHANGE
$('select[name=kelas]').change(function(){

  cabang = $('select[name=cabang]').val();
  tingkat = $('select[name=tingkat_pel]').val();
  kelas = $('select[name=kelas]').val();

  url = base_url+"laporanortu/laporanortu_ajax/"+cabang+"/"+tingkat+"/"+kelas;

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
