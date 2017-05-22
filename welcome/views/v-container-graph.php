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
<div class="modal fade" tabindex="-1" role="dialog" id="latihan_persentase">
  <div class="modal-dialog" role="document" style="width: 80%">
    <div class="modal-content">
      <div class="modal-header">
        <h3>Perkembangan Latihan</h3>

      </div>
      <div class="modal-body">

        <table class="table rpersentase" width=100% style="font-size: 13px">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Bab</th>
              <th>Jumlah Soal</th>
              <th>Jumlah Salah</th>
              <th>Jumlah Kosong</th>
              <th>Jumlah Benar</th>
              <th>Score</th>
              <th>Persentase</th>
            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
      </div>

      <div class="modal-footer bg-color-3">
        <button type="button" class="cws-button bt-color-1 alt small selesai" data-dismiss="modal">Batal</button>
      </div>

    </div>
  </div>
</div>
<!-- MODAL LATIHAN PERSENTASE-->

<!-- MODAL LATIHAN PERSENTASE-->
<div class="modal fade" tabindex="-1" role="dialog" id="learning_persentase">
  <div class="modal-dialog" role="document" style="width: 80%">
    <div class="modal-content">
      <div class="modal-header">
        <h3>Progress Learning Line</h3>

      </div>
      <div class="modal-body">

        <table class="table lpersentase" width=100% style="font-size: 13px">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Topik</th>
              <th>Step Dikerjakan</th>
              <th>Jumlah Step</th>
              <th>Persentase</th>
              <th>Bar</th>
            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
      </div>

      <div class="modal-footer bg-color-3">
        <button type="button" class="cws-button bt-color-1 alt small selesai" data-dismiss="modal">Batal</button>
      </div>

    </div>
  </div>
</div>
<!-- MODAL LATIHAN PERSENTASE-->

<!-- MODAL LATIHAN PERSENTASE-->
<div class="modal fade" tabindex="-1" role="dialog" id="laporan_tryout">
  <div class="modal-dialog" role="document" style="width: 80%">
    <div class="modal-content">
      <div class="modal-header">
        <h3>Laporan Semua Paket Tryout</h3>

      </div>
      <div class="modal-body">

        <table class="table rpaket" width=100% style="font-size: 13px">
          <thead>
            <tr>
             <th>no</th>
            <th>Nama Paket</th>
            <th>Nama Tryout</th>
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

      <div class="modal-footer bg-color-3">
        <button type="button" class="cws-button bt-color-1 alt small selesai" data-dismiss="modal">Batal</button>
      </div>

    </div>
  </div>
</div>
<!-- MODAL LATIHAN PERSENTASE-->


<div class="page-title" style="background:#2b3036">
  <div class="grid-row">
    <?php if ($this->session->userdata('HAKAKSES')=='ortu'): ?>
    <h1>Halo <?=$this->session->userdata['USERNAME']?> , orang tua dari <?=$siswa?>  </h1>
    <?php else: ?>
      <h1>Halo, <?=$this->session->userdata['USERNAME']?> !  </h1>
  <?php endif ?>


  </div>
</div>

<!-- PERKEMBANGAN learning Line -->
<section class="padding-section" style="padding:0;">


<div class="grid-row clear-fix" style="padding-bottom: 0;padding-bottom:0">
    <h3>Pesan</h3> 
    <?php if ($this->session->userdata('HAKAKSES')=='ortu'): ?>
    Hi, <?=$this->session->userdata('USERNAME') ?> ! Dibawah ini adalah pesan.<br><br>
    <?php else: ?>
      Hi, <?=$this->session->userdata('USERNAME') ?> ! Dibawah ini adalah pesan. Tetap semangat!<br><br>
  <?php endif ?>

  <a href="<?=base_url('ortuback/pesan') ?>" class="cws-button bt-color-3 alt small">Selengkapnya</a> <br><br> 
 
    
    <div class="grid-col-row clear-fix">
      <?php foreach ($pesan as $key ) : ?>
        <div class="grid-col grid-col-4" title="10%">
          <div class="portfolio-item">
            <div class="picture">
              <div class="course-item">
                <div class="course-date bg-color-3 clear-fix skill-bar">
                  <h3 style="margin:0;"><a href="">Pesan</a></h3>
                  <hr style="margin-bottom: 5px">  
                  <div class="day"><?=$key['jenis']?></div><br>
                   <?php if ($key['isi']== null): ?>
                    <div class="day">{Tidak ada pesan}</div>
                      <?php else: ?>
                  <div class="day"><?php $c = $key['isi']; echo substr($c, 0, 50) ?></div>
                  <?php endif ?>
                </div>
              </div>
            </div>
          </div>
        </div>    
      <?php endforeach ?>
    </div>

  </div>


  <div class="grid-row clear-fix" style="padding-bottom: 0;padding-bottom:0">
    <?php if ($this->session->userdata('HAKAKSES')=='ortu'): ?>
    <h3>Topik yang baru saja dipelajari <?=$siswa?>..</h3> 
    Hi, <?=$this->session->userdata('USERNAME') ?> ! Dibawah ini adalah progress learning line dari <?=$siswa?>! <br><br>
  <?php else: ?>
    <h3>Topik yang baru saja dipelajari..</h3> 
    Hi, <?=$this->session->userdata('USERNAME') ?> ! Dibawah ini adalah progress learning line kamu, silahkan lanjutkan untuk bisa menyelesaikan topik-topik yang disediakan. Tetap semangat!<br><br>
    <?php endif ?>
    <a onclick="show_modal_learning()" class="cws-button bt-color-3 alt small">Selengkapnya</a> <br><br>    
    <div class="grid-col-row clear-fix">
      <?php foreach ($topik  as $item): ?>
        <?php $persentasi = (int)$item['stepDone'] / (int)$item['jumlah_step'] * 100; ?>
        <div class="grid-col grid-col-4" title="<?=(int)$persentasi ?>%">
          <div class="portfolio-item">
            <div class="picture">
              <div class="course-item">
                <div class="course-date bg-color-3 clear-fix skill-bar">
                  <h3 style="margin:0;"><a href="<?=base_url("linetopik/learningline/".$item['babID']) ?>"><?=$item['namaTopik'] ?></a></h3>
                  <hr style="margin-bottom: 5px">  
                  <div class="day"><?=(int)$persentasi ?>% Progress</div><br>
                  <div class="day"><?=$item['stepDone'] ?> / <?=$item['jumlah_step'] ?> Step Line Dikerjakan</div>
                  <div class="bar">
                    <span class="bg-color-4 skill-bar-progress" processed="true" style="width: <?=$persentasi ?>%;"></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach ?>
    </div>
  </div>
</section>
<!-- PERKEMBANGAN learning Line -->


<!-- PERKEMBANGAN learning Line -->
<section class="padding-section" style="padding:0;">
  <div class="grid-row clear-fix" style="padding-bottom: 0;padding-bottom:0">
    <?php if ($this->session->userdata('HAKAKSES')=='ortu'): ?>
    <h3>Latihan yang telah dikerjakan <?=$siswa?>..</h3> 
    Dibawah ini adalah latihan yang sudah dihitung berdasarkan babnya, silahkan untuk di lihat agar mengetahui perkembangan <?=$siswa?><br><br>
    <?php else: ?>
    Dibawah ini adalah latihan yang sudah dihitung berdasarkan babnya, silahkan untuk di lihat agar mengetahui perkembangan anda<br><br>
    <?php endif ?>
    <a onclick="show_modal_latihan()" class="cws-button bt-color-3 alt small">Selengkapnya</a> <br><br>    
    <div class="grid-col-row clear-fix">
      <?php foreach ($latihan  as $item): ?>
        <?php $persentasi = (int)$item['total_benar'] / (int)$item['total_soal'] * 100; ?>
        <div class="grid-col grid-col-4" title="<?=$item['judulBab'] ?>">
          <div class="portfolio-item">
            <div class="picture">
              <div class="course-item">
                <div class="course-date bg-color-3 clear-fix skill-bar">
                  <h3 style="margin:0;"><a href="<?=base_url("linetopik/learningline/".$item['judulBab']) ?>"><?=$item['judulBab'] ?></a></h3>
                  <hr style="margin-bottom: 5px">
                  <div class="day"><?=$item['total_benar'] ?> Benar dari <?=$item['total_soal'] ?> soal</div> <br> 
                  <div class="day"><?=(int)$persentasi ?>% Benar</div> <br>
                  <div class="day">Nilai : <bold><i><?=(int)$item['total_benar'] / (int)$item['total_soal'] * 100 ?></i></bold> </div>

                  <div class="bar">
                    <span class="bg-color-4 skill-bar-progress" processed="true" style="width: <?=$persentasi ?>%;"></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach ?>
    </div>
    <hr class="divider-color">
  </div>
</section>
<!-- PERKEMBANGAN learning Line -->

<!-- PERKEMBANGAN TO -->
<section class="padding-section" style="padding-top: 0;margin-top: 0">
  <div class="grid-row clear-fix">
    <?php if ($this->session->userdata('HAKAKSES')=='ortu'): ?>
    <h3>Grafik Tryout dari <?=$siswa?></h3>
    <p>Dibawah ini adalah grafik perkembangan TO <?=$siswa?>..</p>
  <?php else: ?>
     <h3>Grafik Tryout</h3>
    <p>Dibawah ini adalah grafik perkembangan TO kamu, jika nilaninya masih tidak memuaskan jangan khawatir pasti kamu bisa memperbaikinya dengan cara banyak mengikuti latihan. Tetap semangat! </p>
    <?php endif ?>
    <br>
    <?php if ($this->session->userdata('HAKAKSES')=='ortu'): ?>
      <a onclick="show_modal_tryout()" class="cws-button bt-color-3 alt small">Selengkapnya</a> 
    <?php else: ?>
    <?php endif ?>
<!--     <label for="" class="">
      Filter Tryout : <select class="form-control tryout_select" name="tryout_select">
      <option value="">-- Cari Berdasarkan Tryout --</option>
    </select>
  </label> -->
  <div class="panel-body" >
    <div class="panel-body pt0" id="resizeble" style="height:430px">
      <div class="container" id="chartContainer" style="width:100%">

      </div>
    </div>      
  </div>
</div>  
</section>
<hr class="divider-big">
<!-- PERKEMBANGAN TO -->

<!-- video random -->
<section class="padding-section" style="padding-bottom: : 0;">
  <div class="grid-row clear-fix">
    <h3 style="margin:0">Recent Video</h3>
    Nah, dibawah ini terdapat video terbaru loh, yuk coba tonton..
    <hr>  <br>
    <div class="grid-col-row clear-fix">
      <?php foreach ($video as $item): ?>
        <div class="grid-col grid-col-3">
          <div class=" portfolio-item">
            <div class="picture">
              <div class="hover-effect"></div>
              <div class="link-cont">
                <span></span>
                <?php $url =  base_url()."video/seevideo/".$item['videoid']?>
                <a href="<?=$url ?>" class="cws-right fa fa-play"></a>
              </div>
              <center>
                <?php if (!empty($item['link'])): ?>
                  <iframe  width="250" src="<?=$item['link'] ?>"></iframe>
                <?php endif ?>
              </center>

            </div>
            <h3><?=$item['judulVideo'] ?></h3>
            <p><?=$item['deskripsi'] ?></p>
          </div>
        </div>
      <?php endforeach ?>


    </div>
    <hr class="divider-color">  

  </div>
</section>
<!-- video random -->







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