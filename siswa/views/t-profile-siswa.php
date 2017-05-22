
<div class="row">
    <!-- WELCOME -->
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Selamat datang, {namaDepan} {namaBelakang} !</h3> 
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-sm-12">
            <div class="panel-body bgcolor-info">
              <ul class="list-unstyled mt15 mb15">
                <li class="text-center">
                  <img class="img-circle img-bordered" src="{photo}" alt="" width="165px" height="165px">
                </li>
                <li class="text-center">
                  <h5 class="semibold mb0">{namaDepan} {namaBelakang}</h5>
                  <span><?=$this->session->userdata('HAKAKSES') ?></span>
                </li>
              </ul>
            </div><br>
          </div>
          <div class="col-sm-3">
            <!-- START Statistic Widget -->
            <div class="table-layout animation delay animating fadeInDown">
              <div class="col-xs-4 panel bgcolor-info">
                <div class="ico-book3 fsize24 text-center"></div>
              </div>
              <div class="col-xs-8 panel">
                <div class="panel-body text-center">
                  <h4 class="semibold nm">{jumlah_paket}</h4>
                  <p class="semibold text-muted mb0 mt5">Paket Soal</p>
                </div>
              </div>
            </div>
            <!--/ END Statistic Widget -->
          </div>

          <div class="col-sm-3">
            <!-- START Statistic Widget -->
            <div class="table-layout animation delay animating fadeInUp">
              <div class="col-xs-4 panel bgcolor-info">
                <div class="ico-notebook fsize24 text-center"></div>
              </div>
              <div class="col-xs-8 panel">
                <div class="panel-body text-center">
                  <h4 class="semibold nm">{jumlah_latihan}</h4>
                  <p class="semibold text-muted mb0 mt5">Latihan</p>
                </div>
              </div>
            </div>
            <!--/ END Statistic Widget -->
          </div>

          <div class="col-sm-3">
            <!-- START Statistic Widget -->
            <div class="table-layout animation delay animating fadeInUp">
              <div class="col-xs-4 panel bgcolor-info">
                <div class="ico-list-alt fsize24 text-center"></div>
              </div>
              <div class="col-xs-8 panel">
                <div class="panel-body text-center">
                  <h4 class="semibold nm">{jumlah_line} Step</h4>
                  <p class="semibold text-muted mb0 mt5">Learning Line</p>
                </div>
              </div>
            </div>
            <!--/ END Statistic Widget -->
          </div>

          <div class="col-sm-3">
            <!-- START Statistic Widget -->
            <div class="table-layout animation delay animating fadeInDown">
              <div class="col-xs-4 panel bgcolor-info">
                <div class="ico-qrcode2 fsize24 text-center"></div>
              </div>
              <div class="col-xs-8 panel">
                <div class="panel-body text-center">
                  <h4 class="semibold nm">{sisa} Hari</h4>
                  <p class="semibold text-muted mb0 mt5">Masa Aktif Token</p>
                </div>
              </div>
            </div>
            <!--/ END Statistic Widget -->
          </div>

        </div>
      </div>
    </div>
  </div>
    <!-- WELCOME -->

  <!-- PERKEMBANGAN TO -->
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="ico-stats-up"></i> Grafik Perkembangan Tryout</h3> 

        <div class="panel-toolbar text-right">
              <div class="col-sm-4 mt5"></div>
              <div class="col-sm-8 mt1">
               <select class="form-control tryout_select" name="tryout_select">
                <option value="">-- Cari Berdasarkan Tryout --</option>
              </select>
            </div>
          </div>

      </div>
      <div class="panel-body">
        <div class="panel-body pt0" id="resizeble" style="height:430px">
          <div class="container" id="chartContainer" style="width:100%">

          </div>
          </div       
        </div>
      </div>
    </div>
  </div>
  <!-- PERKEMBANGAN TO -->


  <!-- PERKEMBANGAN LATIHAN -->

  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="ico-stats-up">  </i> Grafik Perkembangan Latihan</h3> 

        <div class="panel-toolbar text-right">
              <div class="col-sm-4 mt5"></div>
              <div class="col-sm-8 mt1">
               <select class="form-control bab_select" name="bab_select">
                <option value="">-- Cari Berdasarkan Bab --</option>
              </select>
            </div>
          </div>

    </div>
    <div class="panel-body">
      <div class="panel-body pt0" id="resizeble2" style="height:430px">
        <div class="container" id="chartContainer2" style="width:100%">

        </div>
        </div       
      </div>
    </div>
  </div>
</div>
  <!-- PERKEMBANGAN LATIHAN -->

<!-- LAPORAN SEMUA PAKET TRYOUT -->
<div class="col-md-12">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title"><i class="ico-book">  </i> Laporan Semua Paket Tryout</h3> 
    </div>
    <div class="panel-body">
      <table class="rpaket table table-striped display responsive nowrap" style="font-size: 13px" width=100%>
        <thead>
          <tr>

            <th>no</th>
            <th>Nama Paket</th>
            <th>Jumlah Soal</th>
            <th>Benar</th>
            <th>Salah</th>
            <th>Kosong</th>
            <th>Nilai</th>
            <th>Waktu Mengerjakan</th>
            <th>Aksi</th>

          </tr>
        </thead>

        <tbody>

        </tbody>
      </table>


    </div>
  </div>
</div>
<!-- LAPORAN SEMUA PAKET TRYOUT -->

<!-- LAPORAN SEMUA LATIHAN -->
<div class="col-md-12">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title"><i class="ico-book">  </i> Laporan Semua Latihan</h3> 
    </div>
    <div class="panel-body">
      <table class="rlatihan table table-striped display responsive nowrap" style="font-size: 13px" width=100%>
        <thead>
          <tr>


            <th>no</th>
            <th>Nama Latihan</th>
            <th>Jumlah Soal</th>
            <th>Benar</th>
            <th>Salah</th>
            <th>Kosong</th>
            <th>Nilai</th>
            <th>Waktu Mengerjakan</th>
            <!-- <th>Aksi</th>  -->
          </tr>
        </thead>

        <tbody>

        </tbody>
      </table>


    </div>
  </div>
</div>
<!-- LAPORAN SEMUA LATIHAN -->

<!-- LAPORAN SEMUA LEARNING LINE -->
<div class="col-md-12">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Laporan Semua Learning Line</h3> 
    </div>
    <div class="panel-body">
      <table class="rline_log table table-striped display responsive nowrap" style="font-size: 13px" width=100%>
        <thead>
          <tr>
            <th>no</th>
            <th>Topik</th>
            <th>Jenis Step</th>
            <th>Status</th>
            <th>Jumlah Soal</th>
            <th>Nama Step</th>
          </tr>
        </thead>

        <tbody>

        </tbody>
      </table>


    </div>
  </div>
</div>
<!-- LAPORAN SEMUA LEARNING LINE -->

<!-- DAFTAR KONSULTASI -->
<div class="col-md-12">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Daftar Konsultasi</h3> 
    </div>
    <div class="panel-body">
      <table class="rkonstultasi table table-striped display responsive nowrap" style="font-size: 13px" width=100%>
        <thead>
          <tr>
            <th>no</th>
            <th>Judul</th>
            <th>Isi Pertanyaan</th>
            <th>Tanggal Dibuat</th>
            <th>Aksi</th>
          </tr>
        </thead>

        <tbody>

        </tbody>
      </table>


    </div>
  </div>
  </div>
<!-- DAFTAR KONSULTASI -->


<!-- PRODRESS LEARNING LINE -->
  <!-- Browser Breakpoint -->
  <div class="col-lg-12">
    <!-- START panel -->
    <div class="panel panel-default">
      <!-- panel heading/header -->
      <div class="panel-heading">
        <h3 class="panel-title ellipsis"><i class="ico-files mr5"></i>Progress learning Line</h3>
        <!-- panel toolbar -->
        <div class="panel-toolbar text-right">
          <!-- option -->
          <div class="option">
            <button class="btn up" data-toggle="panelcollapse"><i class="arrow"></i></button>
            <button class="btn" data-toggle="panelremove" data-parent=".col-md-12"><i class="remove"></i></button>
          </div>
          <!--/ option -->
        </div>
        <!--/ panel toolbar -->
      </div>
      <!--/ panel heading/header -->
      <!-- panel body with collapse capabale -->
      <div class="table-responsive panel-collapse pull out">
        <table class="table rpersentase" style="font-size: 13px" width=100%>
          <thead>
            <tr>
              <th>No</th>
              <th>Nama topik</th>
              <th>Dikerjakan</th>
              <th>Jumlah Step</th>
              <th>Belum Dikerjakan</th>
              <th>Progress</th>
            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
      </div>
      <!--/ panel body with collapse capabale -->
    </div>
    <!--/ END panel -->
  </div>
  <!-- Browser Breakpoint -->
<!-- PRODRESS LEARNING LINE -->



</div>

<!--datatable-->
<script type="text/javascript" src="<?= base_url('assets/plugins/datatables/js/jquery.datatables.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/plugins/datatables/tabletools/js/tabletools.min.js') ?>"></script>
<!--<script type="text/javascript" src="<?= base_url('assets/plugins/datatables/tabletools/js/zeroclipboard.js') ?>"></script>-->
<script type="text/javascript" src="<?= base_url('assets/plugins/datatables/js/jquery.datatables-custom.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/javascript/tables/datatable.js') ?>"></script>

<script type="text/javascript">
  var dataTableReportPaket,dataTableReportLatihan;

  $(document).ready(function(){
// ## datatable report tryout
url = base_url+"siswa/ajax_report_tryout";

dataTableReportPaket = $('.rpaket').DataTable({
  "ajax": {
    "url": url,
    "type": "POST",
  },
  "emptyTable": "Tidak Ada Data Pesan",
  "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
  "bDestroy": true,
});
// ## datatable report tryout



// ## datatable report latihan
url2 = base_url+"siswa/ajax_get_report_latihan";

dataTableReportPaket = $('.rlatihan').DataTable({
  "ajax": {
    "url": url2,
    "type": "POST",
  },
  "emptyTable": "Tidak Ada Data Pesan",
  "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
  "bDestroy": true,
});
// ## datatable report latihan

// ## datatable line log
url3 = base_url+"learningline/get_line_log";
dataTableReportPaket = $('.rline_log').DataTable({
  "ajax": {
    "url": url3,
    "type": "POST",
  },
  "emptyTable": "Tidak Ada Data Pesan",
  "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
  "bDestroy": true,
});

// ## datatable line log

// ## datatable konsultasi
url4 = base_url+"siswa/ajax_daftar_konsultasi";

dataTableReportPaket = $('.rkonstultasi').DataTable({
  "ajax": {
    "url": url4,
    "type": "POST",
  },
  "emptyTable": "Tidak Ada Data Pesan",
  "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
  "bDestroy": true,
});

// ## datatable konsultasi

// ## datatable persentasi learning line
url4 = base_url+"siswa/async_persentase_learning";

dataTableReportPaket = $('.rpersentase').DataTable({
  "ajax": {
    "url": url4,
    "type": "POST",
  },
  "emptyTable": "Tidak Ada Data Pesan",
  "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
  "bDestroy": true,
});

})
// ## datatable persentasi learning line

//  lihat laporan to
function lihat_laporan_latihan(data){
 var kelas ='.latihan-'+data;
 var data = $(kelas).data('todo');
 console.log(data);
}
//  lihat laporan to


function pembahasanto(id_to){
  var kelas = ".modal-on"+id_to;
  var data_to = $(kelas).data('todo');
  url = base_url+"index.php/tryout/buatpembahasan";
  
  var datas = {
    id_paket:data_to.id_paket,
    id_tryout:data_to.id_tryout,
    id_mm_tryoutpaket:data_to.id_mm_tryout_paket
  }


  $.ajax({
    url : url,
    type: "POST",
    data: datas,
    dataType: "TEXT",
    success: function(data)
    {
     window.location.href = base_url + "index.php/tryout/mulaipembahasan";
   },
   error: function (jqXHR, textStatus, errorThrown)
   {
    swal("gagal");
  }
});
}

function lihat_konsultasi(id){

}

</script>



<!-- LOAD GRAFIK PERSENTASE TO -->
<script type="text/javascript">

  $.getJSON(base_url+"siswa/persentase_json", function(data) {
    load_grafik(data);
  });

  function load_grafik(data){
    var chart = new CanvasJS.Chart("chartContainer", {
      title:{
        text:"Grafik Perkembangan Paket Tryout"        
      },
      animationEnabled: true,
      axisX:{
        interval: 1,
        gridThickness: 0,
        labelFontSize: 10,
        labelFontStyle: "normal",
        labelFontWeight: "normal",
        labelFontFamily: "Lucida Sans Unicode"

      },
      axisY2:{
        interlacedColor: "rgba(1,77,101,.2)",
        gridColor: "rgba(1,77,101,.1)"

      },

      data: [
      {     
        type: "bar",
        name: "companies",
        axisYType: "secondary",
        color: "#4dcde6",       
        dataPoints: data
      }

      ]
    });
    chart.render();
  }
</script>
<!-- LOAD GRAFIK PERSENTASE TO -->



<!-- LOAD GRAFIK PERSENTASE LATIHAN -->
<script type="text/javascript">

  $.getJSON(base_url+"latihan/get_repot_latihan_to_grafik", function(data) {
    load_grafik_latihan(data);
  });

  function load_grafik_latihan(data){
    var chart2 = new CanvasJS.Chart("chartContainer2", {

      title:{
        text:"Grafik Perkembangan Latihan"        

      },
      animationEnabled: true,
      axisX:{
        interval: 1,
        gridThickness: 0,
        labelFontSize: 10,
        labelFontStyle: "normal",
        labelFontWeight: "normal",
        labelFontFamily: "Lucida Sans Unicode"

      },
      axisY2:{
        interlacedColor: "rgba(1,77,101,.2)",
        gridColor: "rgba(1,77,101,.1)"

      },

      data: [
      {     
        type: "bar",
        name: "companies",
        axisYType: "secondary",
        color: "#4dcde6",       
        dataPoints: data
      }

      ]
    });
    chart2.render();
  }
</script>
<!-- LOAD GRAFIK PERSENTASE LATIHAN -->

<!-- FILTER PENCARIAN BAB -->
<script type="text/javascript">
 $.getJSON(base_url+"latihan/get_bab_to_option", function(data) {
    $('.bab_select').html('<option value="">-- Cari Berdasarkan Bab --</option>');
    $.each(data, function (i, data) {
      $('.bab_select').append("<option value='" + data.id + "'>" + data.judulBab + "</option>");
    });
  });

// KETIKA BAB CHANGE, LOOAD GRAFIK
 $('.bab_select').change(function () {
  id_bab = $(this).val();
  if (id_bab!="") {
    $.getJSON(base_url+"latihan/get_repot_latihan_to_grafik/"+id_bab, function(data) {
    load_grafik_latihan(data);
  });
  }else{
    $.getJSON(base_url+"latihan/get_repot_latihan_to_grafik/", function(data) {
    load_grafik_latihan(data);
  });
  }
});
// KETIKA BAB CHANGE, LOOAD GRAFIK

</script>
<!-- FILTER PENCARIAN BAB -->


<!-- FILTER PENCARIAN TO -->
<script type="text/javascript">
 $.getJSON(base_url+"siswa/get_tryout_for_select", function(data) {
    $('.tryout_select').html('<option value="">-- Cari Berdasarkan Tryout --</option>');
    $.each(data, function (i, data) {
      $('.tryout_select').append("<option value='" + data.id_tryout + "'>" + data.nm_tryout + "</option>");
    });
  });

// KETIKA BAB CHANGE, LOOAD GRAFIK
 $('.tryout_select').change(function () {
  id_to = $(this).val();
  if (id_to!="") {
    $.getJSON(base_url+"siswa/persentase_json/"+id_to, function(data) {
    load_grafik(data);
  });
  }else{
    $.getJSON(base_url+"siswa/persentase_json/", function(data) {
    load_grafik(data);
  });
  }
});
// KETIKA BAB CHANGE, LOOAD GRAFIK

</script>
<!-- FILTER PENCARIAN TO -->

<script src="<?= base_url('assets/back/plugins/canvasjs.min.js') ?>"></script>
