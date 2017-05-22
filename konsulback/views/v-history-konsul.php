<div id="container">

  <!-- Top Stats -->
  <div class="row">
    <div class="col-sm-3">
      <!-- START Statistic Widget -->
      <div class="table-layout animation delay animating fadeInDown">
        <div class="col-xs-4 panel bgcolor-success">
          <div class="ico-users3 fsize24 text-center"></div>
        </div>
        <div class="col-xs-8 panel">
          <div class="panel-body text-center">
            <h4 class="semibold nm"><?=$nama;?></h4>
          </div>
        </div>
      </div>
      <!--/ END Statistic Widget -->

    </div>
    <div class="col-sm-3">
      <!-- START Statistic Widget -->
      <div class="table-layout animation delay animating fadeInDown">
        <div class="col-xs-4 panel bgcolor-info">
          <div class="ico-bubbles10 fsize24 text-center"></div>
        </div>
        <div class="col-xs-8 panel">
          <div class="panel-body text-center">
            <h4 class="semibold nm"><?=$countJawab;?></h4>
            <p class="semibold text-muted mb0 mt5">Respon Jawab</p>
          </div>
        </div>
      </div>
      <!--/ END Statistic Widget -->
    </div>
    <div class="col-sm-3">
      <!-- START Statistic Widget -->
      <div class="table-layout animation delay animating fadeInUp">
        <div class="col-xs-4 panel bgcolor-danger">
          <div class=" ico-heart fsize24 text-center"></div>
        </div>
        <div class="col-xs-8 panel">
          <div class="panel-body text-center">
            <h4 class="semibold nm"><?=$countLove;?></h4>
            <p class="semibold text-muted mb0 mt5">Love</p>
          </div>
        </div>
      </div>
      <!--/ END Statistic Widget -->
    </div>
    <div class="col-sm-3">
      <!-- START Statistic Widget -->
      <div class="table-layout animation delay animating fadeInDown">
        <div class="col-xs-4 panel bgcolor-teal">
          <div class="ico-trophy-star fsize24 text-center"></div>
        </div>
        <div class="col-xs-8 panel">
          <div class="panel-body text-center">
            <h4 class="semibold nm"><?=$poin;?></h4>
            <p class="semibold text-muted mb0 mt5">Poin</p>
          </div>
        </div>
      </div>
      <!--/ END Statistic Widget -->
    </div>

  </div>
  <!--/ Top Stats -->
  <!-- menu tab -->
  <div>
   <ul class="nav nav-tabs">
    <li class="active"><a href="#respon" data-toggle="tab">History Respone</a></li>
    <li><a href="#komen" data-toggle="tab">History Komen Love</a></li>
    <li><a href="#pertanyaan" data-toggle="tab">Pertanyaan Pada Anda</a></li>

  </ul>
</div>
<!-- End menu tab -->
<!-- START TAB KONTEN -->
<div class="tab-content">
  <!-- Start tab pane history respon -->
  <div class="tab-pane active" id="respon">
    <!-- Start Penel -->
    <div class="panel ">
     <!-- Start Panel Body -->
     <div class="panel-body">
       <!-- Start Tabel -->
       <table class="table table-striped respon" style="font-size: 12px">
        <thead>
         <tr>
           <th>No</th>
           <th>Judul Pertanyaan</th>
           <th>Pertanyaan</th>
           <th>Jawaban</th>
           <th>Tanggal</th>
           <th>Detail</th>
         </tr>
       </thead>
       <tbody>
        <?php $no=1; ?>
        <?php foreach ($respon as $value): ?>
         <tr>
          <td><?=$no;?></td>
          <td>><?=$value['judulPertanyaan']?></td>
          <td><?=$value['isiPertanyaan']?></td>
          <td><?=htmlspecialchars(substr($value['isiJawaban'], 0, 100))?>...</td>
          <td><?=$value['tgl']?></td>
          <td><a class="btn btn-sm bgcolor-success text-center"  title="Detail" href=""><i class="ico-bubble11 fsize23"></i></a></td>
        </tr>
        <?php $no++; ?>
      <?php endforeach ?>
    </tbody>
  </table>
  <!-- Start Tabel -->
</div>
<!-- END Panel Body -->
</div>
<!-- End Panel -->
</div>
<!-- END tab pane history respon -->

<!-- Start tab pane history respon -->
<div class="tab-pane" id="komen">
  <!-- Start Penel -->
  <div class="panel ">
   <!-- Start Panel Body -->
   <div class="panel-body">
     <!-- Start Tabel -->
     <table class="table table-striped komen" style="font-size: 12px">
      <thea d>
       <tr>
         <th>No</th>
         <th>Nama</th>
         <th>Komentar</th>
         <th>Tanggal</th>
       </tr>
     </thead>
     <tbody>
      <?php $no='1'; ?>
      <?php foreach ($komen as $rows ): ?>
        <tr>
          <td><?=$no;?></td>
          <td><?=$rows['namaDepan'];?> <?=$rows['namaBelakang'];?></td>
          <td><?=$rows['komentar'];?></td>
          <td><?=$rows['tgl'];?></td>
        </tr>
        <?php $no++; ?>
      <?php endforeach ?>
    </tbody>
  </table>
  <!-- Start Tabel -->
<!-- END tab pane history respon -->
</div>
</div>
<!-- END TAB KONTEN -->
</div>


  <!-- Start tab pane history pertanyaan -->
  <div class="tab-pane" id="pertanyaan">
    <!-- Start Penel -->
    <div class="panel ">
     <!-- Start Panel Body -->
     <div class="panel-body">
       <!-- Start Tabel -->
       <table class="table table-striped pertanyaan" style="font-size: 12px">
        <thead>
         <tr>
           <th>No</th>
           <th>Judul Pertanyaan</th>
           <th>Isi Pertanyaan</th>
           <th>Nama Matapelajaran</th>
           <th>Judul Bab</th>
           <th>Respon</th>
           <th>Tanggal</th>
         </tr>
       </thead>
       <tbody>
        <?php $no='1'; ?>
        <?php foreach ($question_to_teacher as $rows ): ?>
          <tr>
            <td><?=$no;?></td>
            <td><a title="kunjungi <?=$rows['judulPertanyaan'] ?>" href="<?=base_url('konsultasi/singlekonsultasi/'.$rows['pertanyaanID']) ?>"><?=$rows['judulPertanyaan'];?></a></td>
            <td><?=$rows['isiPertanyaan'];?></td>
            <td><?=$rows['namaMataPelajaran'];?></td>
            <td><?=$rows['judulBab'];?></td>
            <td><?=$rows['jumlah'];?></td>
            <td><?=$rows['date_created'];?></td>
          </tr>
          <?php $no++; ?>
        <?php endforeach ?>
        
      </tbody>
    </table>
    <!-- Start Tabel -->
  </div>
  <!-- END Panel Body -->
</div>
<!-- End Panel -->
</div>


<script type="text/javascript">
 function detail_konsul() {
  $('#detail-konsul').modal('show');
  console.log('masuk js modal');
}


$(document).ready(function(){
    $('.pertanyaan').dataTable();
    $('.respon').dataTable();
    $('.respon').dataTable();
});
</script>