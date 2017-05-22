<div class="row">
  <div class="col-md-12 kirim_token">
    <div class="panel panel-teal">
      <div class="panel-heading">
        <h3 class="panel-title">Daftar Paket TO    </h3> 
        <div class="panel-toolbar text-right">
          <div class="col-md-11">
           <div class="col-sm-4">
             <select class="form-control" name="cabang">
              <option value="all">Semua Cabang</option>
              <?php foreach ($cabang as $item): ?>
                <option value="<?=$item->id ?>"><?=$item->namaCabang ?></option>
              <?php endforeach ?>
            </select>
          </div>

          <div class="col-sm-4">
           <select class="form-control" name="to">
            <option value="all">Semua Tryout</option>
            <?php foreach ($to as $item): ?>
              <option value="<?=$item['id_tryout']?>"><?=$item['nm_tryout'] ?></option>
            <?php endforeach ?>
          </select>
        </div>

        <div class="col-sm-4">
         <select class="form-control col-sm-6" name="paket">
          <option value="all">Semua paket</option>

          </select>
          <!-- <button class="btn btn-sm btn-inverse " onclick="pdf()">PDF</button> -->
        </div>
      </div>
      <button class="btn btn-sm btn-inverse col-sm-1" onclick="pdf()">PDF</button>
    </div>

  </div>

  <div class="panel-body">
    <table class="daftarpaket table table-striped display responsive nowrap" style="font-size: 13px" width=100%>
      <thead>
        <tr>
          <th>id</th>
          <th>Username</th>
          <th>Nama Paket</th>
          <th>Cabang</th>
          <th>Nama SIswa</th>
          <th>Jumlah Soal</th>
          <th>Benar</th>
          <th>Salah</th>
          <th>Kosong</th>
          <th>Nilai</th>
          <th>Waktu Mengerjakan</th>
        </tr>
      </thead>

      <tbody>

      </tbody>
    </table>
  </div>

</div>
</div>   
</div>
<script type="text/javascript">
  $(document).ready(function(){
    url_1 = base_url+"admincabang/get_laporan ";

    var mySelect = $('select[name=cabang]').val();

    dataTablePaket = $('.daftarpaket').DataTable({
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": url_1,
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ -1 ], //last column
            "orderable": false, //set not orderable
        },
        ],
  });


  });


// CABANG KETIKA DI CHANGE
$('select[name=cabang]').change(function(){

  cabang = $('select[name=cabang]').val();
  tryout = $('select[name=to]').val();
  paket = $('select[name=paket]').val();

  url = base_url+"admincabang/admincabang/laporanto/"+cabang+"/"+tryout+"/"+paket;

  dataTablePaket = $('.daftarpaket').DataTable({
    "ajax": {
      "url": url,
      "type": "POST"
    },
    "emptyTable": "Tidak Ada Data Pesan",
    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
    "bDestroy": true,
  });
});


// TO KETIKA DI CHANGE
$('select[name=to]').change(function(){
  cabang = $('select[name=cabang]').val();
  tryout = $('select[name=to]').val();
  paket = $('select[name=paket]').val();

  url = base_url+"admincabang/admincabang/laporanto/"+cabang+"/"+tryout+"/"+paket;

  dataTablePaket = $('.daftarpaket').DataTable({
    "ajax": {
      "url": url,
      "type": "POST"
    },
    "emptyTable": "Tidak Ada Data Pesan",
    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
    "bDestroy": true,
  });

  load_paket(tryout);

});

//ketika paket di change
function load_paket(id_to){
 $.ajax({
  type: "POST",
  url: "<?php echo base_url() ?>admincabang/get_paket/"+id_to,
  success: function(data){
   $('select[name=paket]').html('<option value="all">-- Pilih Paket  --</option>');

   $.each(data, function(i, data){
    $('select[name=paket]').append("<option value='"+data.id_paket+"'>"+data.nm_paket+"</option>");
  });
 }

});
}


// TO KETIKA DI CHANGE
$('select[name=paket]').change(function(){
  cabang = $('select[name=cabang]').val();
  tryout = $('select[name=to]').val();
  paket = $('select[name=paket]').val();

  url = base_url+"admincabang/admincabang/laporanto/"+cabang+"/"+tryout+"/"+paket;

  dataTablePaket = $('.daftarpaket').DataTable({
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


</script>