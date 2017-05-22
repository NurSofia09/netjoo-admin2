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
  <form  class="panel panel-default form-horizontal form-bordered form-step"  method="post" >
         <div  class="form-group">
           <label class="col-sm-2 control-label">Jenis Laporan</label>
           <div class="col-sm-9">
             <!-- stkt = soal tingkat -->
             <select class="form-control" name="jenis">
              <option value="0">-- Pilih Jenis --</option>
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
        <th>Pesan</th>
        <th>
          <span class="checkbox custom-checkbox check-all">
            <input type="checkbox" name="checkall" id="check-all">
              <label for="check-all">&nbsp;&nbsp;</label>
          </span> 
        </th>
      </tr>
    </thead>

    <tbody>

    </tbody>
  </table>
  <a class="btn btn-primary send_laporan">Kirim</a>
</div>

</div>
</div>   
</div>

<!-- sound notification -->
<audio id="notif_audio"><source src="<?php echo base_url('sounds/notify.ogg');?>" type="audio/ogg"><source src="<?php echo base_url('sounds/notify.mp3');?>" type="audio/mpeg"><source src="<?php echo base_url('sounds/notify.wav');?>" type="audio/wav"></audio>
<!-- /sound notification -->
<script src="http://macyjs.com/assets/js/macy.min.js"></script>
  <script src="<?php echo base_url('node_modules/socket.io/node_modules/socket.io-client/socket.io.js');?>"></script>

<script type="text/javascript">
var dataTableReport;
$(document).ready(function(){
  var mySelect = $('select[name=cabang]').val();
  dataTableReport = $('.daftarreport').DataTable({
    "ajax": {
      "url": base_url+"laporanortu/addlaporanortu_ajax",
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

  url = base_url+"laporanortu/addlaporanortu_ajax/"+cabang+"/"+tingkat+"/"+kelas;

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

  url = base_url+"laporanortu/addlaporanortu_ajax/"+cabang+"/"+tingkat+"/"+kelas;

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

  url = base_url+"laporanortu/addlaporanortu_ajax/"+cabang+"/"+tingkat+"/"+kelas;

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
});

//fungsi kirim laporan
function kirim_laporan(){
  //tampung id ortu
  id_ortu = [];

  // tampung isi pesan
  pesan = [];
  
  //tampung jenis laporan
  jenis_lapor = $('select[name=jenis]').val();

  //cek kalo belum set jenis laporan
  if (jenis_lapor==0) {
    swal('silahkan tentukan jenis terlebih dahulu');
    $('select[name=jenis]').focus();
  }else{
   $('.daftarreport tbody td :checkbox:checked').each(function(i){
     id_ortu[i] = $(this).val();
   }); 

   $('.pesan').each(function(i){
    tempt_pesan = $(this).val();
     
   }); 

   jumlah_ortu = id_ortu.length;

   // cek jumlah ortu yang dipilih
      if (jumlah_ortu==0) {
        swal('Silahkan tentukan ortu terlebih dahulu');
      }else{
          // cek dulu isi pesannya kosong gak?
          if (tempt_pesan==null || tempt_pesan=="") {
            swal('Pesan tidak boleh kosong');
          }else{
            // ini buat ngehapus array
            pesan.push(tempt_pesan);        
         
            $.ajax({
              type:"POST",
              url:base_url+"laporanortu/kirim_laporan",
              data:{id_ortu:id_ortu,
              jumlah_ortu:jumlah_ortu,
              jenis_lapor:jenis_lapor,
              isi:pesan},
              dataType: "json",
              cache : false,
              success: function(data){

                // AWAL IO
                if(data.success == true){
                
                  var socket = io.connect( 'http://'+window.location.hostname+':3000' );

                socket.emit('new_count_pesan', { 
                        new_count_pesan: data.new_count_pesan
                      });

                console.log(data);

                socket.emit('pesan_baru', { 
                        id_ortu: data.id_ortu,
                        jenis_lapor: data.jenis_lapor,
                        isi: data.isi,
                        namaPengguna : data.namaPengguna,
                        UUID: data.UUID,
                        siswaID: data.siswaID

                      });

                swal('Laporan Berhasil Di Kirim');
                reload();


                 } else if(data.success == false){
                      console.log("gagal");
                    }

                // END IO
              },error:function(){
                swal('Gagal mengirim Laporan');
              }
            });
          }
        
      }
    }

}

function reload(){
  dataTableReport.ajax.reload(null,false); 
}

</script>
