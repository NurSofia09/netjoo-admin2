<div class="row">
  <div class="col-md-12">

    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title judul_infog"> 
          <i class="ico-stats-up"></i><span> Silahkan pilih tryout terlebih dahulu!</span>
        </h3>


        <div class="panel-toolbar text-right">
         <div class="col-sm-3 mt10">

           <span><b>Try Out: </b></span>
           <i class="ico-file-check mt10"></i>  
         </div>
         <div class="col-sm-4">
           <select class="form-control" name="masa_aktif" id="tryout_select">
            <option value="all">Pilih Tryout</option>
            <?php foreach ($to as $item): ?>
              <option value="<?=$item['id_tryout']?>"><?=$item['nm_tryout'] ?></option>
            <?php endforeach ?>
          </select>
        </div>

        <div class="col-sm-4">
         <select class="form-control" id="cabang_select">
          <option value="all">Semua Cabang</option>
          <?php foreach ($cabang as $item): ?>
            <option value="<?=$item->id?>"><?=$item->namaCabang?></option>
          <?php endforeach ?>
        </select>
      </div>


    </div>
  </div>
  <div class="panel-body">

    <div class="col-lg-6">
      <div class="panel panel-default">
        <!-- panel heading/header -->
        <div class="panel-heading">
          <div class="panel-title">Siswa Terdaftar</div>
          <!-- panel toolbar -->
          <div class="panel-toolbar text-right">
            <!-- option -->
            <div class="option">
              <button class="btn up" data-toggle="panelcollapse"><i class="arrow"></i></button>
            </div>
            <!--/ option -->
          </div>
          <!--/ panel toolbar -->
        </div>
        <!--/ panel heading/header -->
        <!-- panel body with collapse capabale -->
        <div class="panel-collapse pull out">
          <div class="panel-body">
            <div class="container" id="siswa_terdaftar" style="width:100%;height:350px">
            </div>
            <!-- Loading indicator -->
            <div class="indicator"><span class="spinner"></span></div>
            <!--/ Loading indicator -->

          </div>

        </div>
        <!--/ panel body with collapse capabale -->
      </div>
    </div>
    
    <div class="col-lg-6">
      <div class="panel panel-default">
        <!-- panel heading/header -->
        <div class="panel-heading">
          <div class="panel-title">Paket</div>
          <!-- panel toolbar -->
          <div class="panel-toolbar text-right">
            <!-- option -->
            <div class="option">
              <button class="btn up" data-toggle="panelcollapse"><i class="arrow"></i></button>
            </div>
            <!--/ option -->
          </div>
          <!--/ panel toolbar -->
        </div>
        <!--/ panel heading/header -->
        <!-- panel body with collapse capabale -->
        <div class="panel-collapse pull out">
          <div class="panel-body">
            <div class="container" id="paket_terdaftar" style="width:100%;height:350px">
            </div>
            <!-- Loading indicator -->
            <div class="indicator"><span class="spinner"></span></div>
            <!--/ Loading indicator -->

          </div>

        </div>
        <!--/ panel body with collapse capabale -->
      </div>
    </div>
    

  </div>
</div>
</div>  
</div>

<!-- LOAD GRAFIK PERSENTASE TO -->
<script type="text/javascript">
  function load_grafik_siswa_daftar(data){

    partisipan = data[2].y

    if (partisipan!=0) {
      var chart = new CanvasJS.Chart("siswa_terdaftar", {
        data: [              
        {
          type: "bar",
          dataPoints: data
        }
        ]
      });
      chart.render();
    }else{
      swal('Maaf, TO yang anda pilih tidak ada yang terdaftar');
      $('#siswa_terdaftar').html("");
      $('#paket_terdaftar').html("");

    }
  }
</script>
<!-- LOAD GRAFIK PERSENTASE TO -->

<!-- LOAD GRAFIK PERSENTASE TO -->
<script type="text/javascript">
  function load_grafik_paket(data){
    paket = data[0].y;
    if (paket!=0) {
      var chart = new CanvasJS.Chart("paket_terdaftar", {
        data: [              
        {
          type: "bar",
          dataPoints: data
        }
        ]
      });
      chart.render();
    }else{
      swal('Maaf, tidak ada siswa yang terdaftar')
      $('#paket_terdaftar').html("");
      $('#siswa_terdaftar').html("");

    }
    
  }
</script>
<script>
  $('#tryout_select').change(function(){
    // get parameter untuk dikirim ke fungsi get info tryout
    id_to = ($(this).val());
    nama_to = $("#tryout_select option:selected").text();
    var param = {
      'id': $('#tryout_select').val(),
      'nama_to' :$("#tryout_select option:selected").text(), 
      'id_cabang' :$('#cabang_select').val(),
      'nama_cabang' :$("#cabang_select option:selected").text(),
    }
    get_info_tryout(param);
  });

  $('#cabang_select').change(function(){
    // get parameter untuk dikirim ke fungsi get info tryout
    id_to = $('#tryout_select').val();
    nama_to = $("#tryout_select option:selected").text();
    var param = {
      'id': $('#tryout_select').val(),
      'nama_to' :$("#tryout_select option:selected").text(), 
      'id_cabang' :$('#cabang_select').val(),
      'nama_cabang' :$("#cabang_select option:selected").text()
    }
    get_info_tryout(param);
  });

  // fungsi untuk ambil data dari json
  function get_info_tryout(param){
    $('.judul_infog span').html("Infograph Untuk Tryout "+param.nama_to+" : "+param.nama_cabang);

    $.getJSON(base_url+"admincabang/get_siswa_regist_parti/"+param.id+"/"+param.id_cabang, function(data) {
      datas = JSON.stringify(data);
      load_grafik_siswa_daftar(data);
    });

    $.getJSON(base_url+"admincabang/get_paket_registrasi/"+param.id+"/"+param.id_cabang, function(data) {
      datas = JSON.stringify(data);
      console.log(base_url+"admincabang/get_paket_registrasi/"+param.id+"/"+param.id_cabang);
      load_grafik_paket(data);
    });
  }
</script>
<!-- LOAD GRAFIK PERSENTASE TO -->
<script src="<?= base_url('assets/back/plugins/canvasjs.min.js') ?>"></script>
