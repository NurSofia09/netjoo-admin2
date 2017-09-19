<style>
  .canvasjs-chart-credit {
   display: none;
 }
 .table th:hover{
  cursor: hand;
}

.pagination li:before{
  color:white;
}
</style>
<!-- MODAL LATIHAN PERSENTASE-->

<div class="modal fade " tabindex="-1" role="dialog" id="myModal">
 <div class="modal-dialog" role="document">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><br>
  </div>
  <div class="modal-body">
    <div id="chartContainer" style="height: 400px; width: 100%;">
    </div>
  </form>
</div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div>

<div class="page-title" style="background:#2b3036">
  <div class="grid-row">
    <?php if ($this->session->userdata('HAKAKSES')=='ortu'): ?>
      <h1>Halo <?=$this->session->userdata['USERNAME']?> , orang tua dari <?=$siswa?>  </h1>
    <?php else: ?>
      <h1>Halo, <?=$this->session->userdata['USERNAME']?> !  </h1>
    <?php endif ?>


  </div>
</div>





<!-- video random -->
<section class="section bgcolor-white"> 
  <div class="container">
    <!-- video random -->

    <div class="col-md-12">

      <!-- gallery navigation -->
      <h4>Paket Soal yang Sudah Dikerjakan</h4>
      <!-- gallery container -->
      <div class="col-md-12">
        <?php //if($paket_dikerjakan==array()): ?>
        <!-- <h5>Tidak ada paket soal.</h5> -->
        <?php //else: ?>
        <table class="table" style="font-size: 13px">
          <thead>
           <tr>
            <th>ID Paket</th>
            <th>Nama Paket Soal</th>
            <th>Tipe Paket</th>
            <th width="30%">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($paket_dikerjakan as $paketitem): ?>
            <tr>
              <td><?=$paketitem['id'] ?></td>
              <td><?=$paketitem['nm_paket'] ?></td>
              <td><?=$paketitem['jenis_penilaian'] ?></td>
              <td>
               <a onclick="detail_paket(<?=$paketitem['id_paket']?>)" 
                class="btn btn-primary modal-on<?=$paketitem['id_paket']?>"
                data-todo='<?=json_encode($paketitem)?>' title="Lihat Score"><i class="glyphicon glyphicon-list-alt"></i></a>

                <?php //if ($status_to=="done"): ?>
                <a onclick="pembahasanto(<?=$paketitem['id_paket']?>)" 
                  class="btn btn-primary"
                  data-todo='<?=json_encode($paketitem)?>' title="Pembahasan"><i class="glyphicon glyphicon-book"></i></a>
                  <?php //endif ?>
                </td>
                
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
        <?php// endif ?>

      </div>

    </div>

  </div>

  <!-- / gallery container -->
</section>

<!-- video random -->
<section class="section bgcolor-white"> 
  <div class="container">
    <!-- video random -->

    <div class="col-md-12">

      <!-- gallery navigation -->
      <h4>Nilai Pembahasan </h4>
      <!-- gallery container -->
      <div class="col-md-12">
        <?php //if($paket_dikerjakan==array()): ?>
        <!-- <h5>Tidak ada paket soal.</h5> -->
        <?php //else: ?>
        <table class="table" style="font-size: 13px">
          <thead>
           <tr>
            <th>No</th>
            <th>Nama Paket </th>
            <th>Nama Tryout</th>
            <th>Nilai Tertinggi</th>
            <th>Nilai Terendah</th>
            <th>Rata-rata</th>
          </tr>
        </thead>
        <tbody>
          <?php $no= 1; ?>
          <?php foreach ($pembahasan_maxmin as $row): ?>
            <?php $rata = floatval($row['rata']) ?>
            <tr>
              <td><?=$no++ ?></td>
              <td><?=$row['nama_paket'] ?></td>
              <td><?=$row['nama_try'] ?></td>
              <td><?=$row['nilai_tertinggi'] ?></td>
              <td><?=$row['nilai_terendah'] ?></td>
              <td><?=$rata?></td>
              
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
      <?php// endif ?>

    </div>

  </div>

</div>

<!-- / gallery container -->
</section>






<script src="<?= base_url('assets/back/plugins/canvasjs.min.js') ?>"></script>
<script>
  $(document).ready(function(){
// ## datatable latihan
url4 = base_url+"welcome/get_data_latihan";

dataTableLatihan = $('.rpersentase').DataTable({
  "ajax": {
    "url": url4,
    "type": "POST",
  },
  "emptyTable": "Tidak Ada Data Pesan",
  "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
  "bDestroy": true,
});
// ## datatable latihan

// ## datatable line log
url5 = base_url+"welcome/get_data_learning_line";

dataTableLearningLine = $('.lpersentase').DataTable({
  "ajax": {
    "url": url5,
    "type": "POST",
  },
  "emptyTable": "Tidak Ada Data Pesan",
  "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
  "bDestroy": true,
});
// ## datatable line log

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

})
</script>
<!-- LOAD GRAFIK PERSENTASE TO -->
<script type="text/javascript">

  $.getJSON(base_url+"tryout/report_to", function(data) {
    load_grafik(data);
  });

  function load_grafik(data){
    var chart = new CanvasJS.Chart("chartContainer", {
    //   title:{
    //     text:"Grafik Perkembangan Paket Tryout"        
    // },
    theme: "theme1",
    animationEnabled: true,
    axisX:{
      interval: 1,
      gridThickness: 0,
      labelFontSize: 10,
      labelFontStyle: "normal",
      labelFontWeight: "normal",
      labelFontFamily: "Lucida Sans Unicode"
    },
    data: [
    {     
      type: "column",
      name: "companies",
      axisYType: "secondary",   
      dataPoints: data
    }

    ]
  });
    chart.render();
  }
</script>
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
</script>
<script type="text/javascript">
  function show_modal_latihan() {
    $('#latihan_persentase').modal('show');
  }

  function show_modal_learning() {
    $('#learning_persentase').modal('show');
  }

  function show_modal_tryout() {
    $('#laporan_tryout').modal('show');
  }
</script>

<!--/ END Template Main -->
<script type="text/javascript"> 
  function kerjakan(id_to){
    var kelas = ".modal-on"+id_to;
    var data_to = $(kelas).data('todo');
    url = base_url+"index.php/tryout/buatto";
    console.log(data_to.jenis_penilaian);

    var datas = {
      id_paket:data_to.id_paket,
      id_tryout:data_to.id_tryout,
      id_mm_tryoutpaket:data_to.mmid
    }

    $.ajax({
      url : url,
      type: "POST",
      data: datas,
      dataType: "TEXT",
      success: function(data)
      {
       window.location.href = base_url + "index.php/tryout/mulaitest";
     },
     error: function (jqXHR, textStatus, errorThrown)
     {
      console.log("gagal");
    }
  });
  }

  function pembahasanto(id_to){
    var kelas = ".modal-on"+id_to;
    var data_to = $(kelas).data('todo');
    url = base_url+"index.php/tryout/buatpembahasan";

    var datas = {
      id_paket:data_to.id_paket,
      id_tryout:data_to.id_tryout,
      id_mm_tryoutpaket:data_to.id
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

  function detail_paket(id_to){
    var kelas = ".modal-on"+id_to;
    var data_to = $(kelas).data('todo');
    $('.modal-title').text('Grafik Paket Soal Tryout');
    $('#myModal').modal('show');
    load_grafik(data_to);
  }

  function load_grafik(data) {
    if (data.jenis_penilaian == 'SBMPTN') {
      nilai =(data.jmlh_benar * 4) + (data.jmlh_salah *(-1)) + (data.jmlh_kosong * 0);
    }
    else {
      nilai =data.jmlh_benar/ data.jumlah_soal * 100;
    }
    console.log(data.jenis_penilaian);
    var chart = new CanvasJS.Chart("chartContainer", {
     title: {
      text: "Nama Paket : "+data.nm_paket
    },
    subtitles:[
    {
      text: "Nilai : "+nilai.toFixed(2),
      //Uncomment properties below to see how they behave
      //fontColor: "red",
      fontSize: 30
    }
    ]
    ,

    animationEnabled: true,
    theme: "theme1",
    data: [
    {

      type: "doughnut",
      indexLabelFontFamily: "Garamond",
      indexLabelFontSize: 20,
      startAngle: 0,
      indexLabelFontColor: "dimgrey",
      indexLabelLineColor: "darkgrey",
      toolTipContent: "Jumlah : {y} ",
      dataPoints: [
      { y: data.jmlh_salah, indexLabel: "Salah {y}" },
      { y: data.jmlh_kosong, indexLabel: "Kosong {y}" },
      { y: data.jmlh_benar, indexLabel: "Benar {y}" },
      ]
    }
    ]
  });
    chart.render();
  }



  function lihat_grafik(id){
    var kelas = ".modal-on"+id;
    var data = $(kelas).data('todo');
    $('.modal-title').text('Grafik Latihan ');
    $('#myModal').modal('show');
    load_grafik(data);
  }



  function show_report(){
    $('#myModal2').modal('show');
    $('#myModal2 modal-title').text('Report Latihan');
  }



  $(document).ready(function() {
    $(".table").dataTable();
    $("#owl2").owlCarousel();
  });

  function forbiden(){
    swal('Maaf, to belum bisa di kerjakan!');
  }

  function habis(){
    swal('Waktu pengerjaan to sudah habis!, anda tidak dapat mengerjakan to.');
  }
</script>
<script src="<?= base_url('assets/back/plugins/canvasjs.min.js') ?>"></script>