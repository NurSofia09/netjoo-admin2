<!-- LOADING -->
<style>
  .no-js #loader { display: none;  }
  .js #loader { display: block; position: absolute; left: 100px; top: 0; }
  .se-pre-con {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url(http://www.thebuddhistchef.com/wp-content/themes/culinier-theme/images/loader.gif) center no-repeat #fff;
  }
</style>
<!-- LOADING -->

<style>
 #jwb_sisJ {
  border-radius: 12px;
  /*background: #fff;*/
  padding: 2px 4px 2px 4px; 
  width: 20px;
  height: 20px;
  color : #06C;
    font-size: 12px;
  text-align: center;
  text-decoration: none;
  border: 1px solid #63d3e9; 
  margin-left: 27px;
  margin-top: 4px;
}

#flex-item {
  float:left;
  width: 48px;
  height: 48px;
  /*margin: 1px;*/
  padding: 2px;
  margin-top: 12px; 

}


#lihatStatus{
  /*position: fixed;*/
  /*top: 0;*/
  /*left: 10px;*/
  /*z-index: 99;*/
  /*border-bottom: 1px solid #ddd;*/
  min-width: 10%;
  /*padding: 9px;*/
  /*background-color: #fff;*/
  /*border: 1px solid #555;*/
}
#lihat{
  margin: 5px;
}
#kotak{
  width: 30px;
  height: 30px;
  border: 1px solid aqua;
  margin: 5px;
  float: left;
  padding: 5px;
  /*position: absolute;*/
}

label > input{ /* HIDE RADIO */
  visibility: hidden;  
  position: absolute; /* Remove input from document flow */
}

label:hover{ /* HIDE RADIO */
  background-color: #63d3e9;
}

.terpilih{
  background-color: #63d3e9;
}

.modal-dialog {
  width: 100%;
  height: 100%;
  margin: 0;
  padding: 0;
}

.modal-content {
  height: auto;
  height: 100%;
  min-height: 100%;
  border-radius: 0;
}

</style>
<!-- START Body -->

<body class="bgcolor-white">
  <div class="se-pre-con">
  </div>
  <!-- START Template Main -->
  <script src="<?= base_url('assets/js/bjqs-1.10.js') ?>"></script>
  <script type="text/javascript">
    jQuery(document).ready(function ($) {
     $('#my-slideshow').bjqs({
//                'height': 400,
                // 'width': 600,
                // 'responsive': false
              });
   });


    $(window).load(function() {
    // Animate loader off screen
    $(".se-pre-con").fadeOut("slow");;
  });
</script>




<section id="main" role="main">
  <!-- Trigger the modal with a button -->
  <!-- START modal-lg -->
  <div class="modal fade" id="pesan_habis">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header text-center">
          <div class="ico-clock mb15 mt15" style="font-size:36px;"></div>
          <h3 class="semibold modal-title text-primary">Waktu Habis</h3>
          <p class="text-danger">
            Waktu Habis, silahkan kumpulkan jawaban.
          </p>
        </div>
        <div class="modal-body">
         <center><a onclick="kirim_hasil_habis()" class="btn btn-default">Kirim Jawaban</a></center>
       </div>
       <div class="modal-footer">
         <!-- <a onclick="kirim_hasil_habis()" class="btn btn-default">Kirim Jawaban</a> -->
       </div>
     </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
 </div>
 <!--/ END modal-lg -->
</div>



<!-- START page header -->
<section class="page-header page-header-block nm" style="">
 <!-- pattern -->
 <!--/ pattern -->
 <div class="container pt15 pb15">
  <div class="">
   <div class="page-header-section text-center">
    <img src="<?= base_url('assets/back/img/logo.png') ?>" width="70px"  alt>
    <p class="title font-alt">Tryout Online 
    </p>
    <?php foreach ($topaket as $key): ?>
     <div class="text-center"><div style="font-size:20px;"><?= $key['namato'] ?>/<?= $key['namapa'] ?></div></div>
   <?php endforeach ?>

   <!-- info untuk soal -->
     <!-- <div class="col-md-12 animation animating pulse pesan-jawaban">
      <div class="alert alert-success fade in">
       <a type="button" class="close" onclick="close_info_jawaban()" aria-hidden="true">×</a>
       <center>
        <h4 class="semibold">Jawaban Anda</h4>
        <h4 class="mb10 notif-jawaban" id="MathOutput">$${}$$</h4>
        <h4 class="mb10 notif-jawaban" id="box" style="visibility:hidden"></h4>
      </div>
    </div> -->
    <!-- info untuk soal -->

  </div>
</section>
<!--/ END page header -->

<!-- START Register Content -->
<section class="section bgcolor-white">
 <div class="container-fluid">
  <div class="row">
   <div class="col-md-10 col-md-offset-1">
    <form action="<?= base_url('index.php/tryout/cekjawaban') ?>" method="post" id="hasil">
     <div class="col-md-8" style="margin-bottom:30">

      <?php $i = 1; $nosoal = 1; $soal_bu = 0;?>
      <div id="my-slideshow" style="">
       <ul class="bjqs" style="display: block;list-style: none">
        <?php foreach ($soal as $key): ?>

         <li class="bjqs-slide" style="display: none;">
          <div class="">
           <div class="panel panel-default" style="">
            <div class="panel-heading">
             <!-- <h1>Selamat datang</h1> -->
             <div class="row">
              <div class="col-md-6 center"><h4 class=""><h4 class="">ID Soal : <small> <?= $key['judul'] ?></small></h4></div>

              <div class="col-md-2"></div>
              <div class="col-md-6 text-right" style="margin-top:5">
               <a class="btn btn-sm btn-success" onclick="bataljawab('pil[<?= $key['soalid']?>]','<?=$i?>',<?= $key['soalid']?>)">Batal Jawab</a>&nbsp&nbsp&nbsp
               <a class="btn btn-sm btn-warning" onclick="raguColor(<?= $i ?>)">Ragu Ragu</a>&nbsp&nbsp&nbsp
               <!-- JANGAN DIHAPUS, TOMBOL LIHAT JAWABAN -->
               <!-- <a class="btn btn-sm btn-success" onclick="lihatJawaban('<?= $key['soalid']?>')">Lihat jawaban</a> -->
               <!-- JANGAN DIHAPUS, TOMBOL LIHAT JAWABAN -->
             </div>
           </div>
         </div>
         <div class="panel-collapse">
           <div class="panel-body">
            <div class="row">

              <?php if (!empty($key['audio'])): ?>
                <!-- Start Audio listening -->
                <div class="col-md-12">
                 <audio class="col-md-12" controls>
                  <source src="<?=base_url()?>assets/audio/soal/<?=$key['audio']?>" type="audio/mpeg">
                  </audio>
                </div>
                <!-- End Audio Listening  -->
              <?php endif ?>

              <!-- untuk nomor soal -->
              <div class="col-md-1 text-right">
               <p><h4><?= $i ?>.</h4></p>
             </div>
             <!-- untuk nomor soal -->



             <div class="col-md-11">
             <?php $gambar=$key['gambar']; ?>
               <?php if (!empty($gambar) && $gambar!="" && $gambar!=' ') { ?>  

               <img src="<?= base_url('./assets/image/soal/' . $gambar) ?>">   
               <?php } ?>

               <h5><?= $key['soal'] ?></h5>
               <br>
             </div>  
           </div>
           <div class="row">
            <div class="col-md-10 col-md-offset-1">

             <?php $k = $key['soalid']; $pilihan = array("A", "B", "C", "D", "E"); $indexpil = 0; ?>

             <!-- cacah pilihan jawaban -->
             <?php foreach ($pil as $row): ?>
              <?php if ($row['pilid'] == $k) { ?>
              <div class="mb10">
               <?php $soal_bu = $key['soal'] ?>

               <!-- characterna di ganti, karena gaboleh kirim \\ ke paramter -->
               <?php 
               $param = array(
                'value'=>$key['soalid'].$indexpil,
                'soalid'=>$key['soalid']
                ) ?>

                <?php $param_send = html_entity_decode(json_encode($param)); ?>
                <input type="hidden" name="pilsoal-<?=$key['soalid'].$indexpil;?>" value="<?=$row['piljaw'] ?>">
                <label id="<?=$key['soalid'].$indexpil;?>" 

                  onclick='changeColor(<?=$param_send ?>)' 

                  alt="<?=$key['soalid'];?>" 
                  style="border:1px solid #63d3e9; padding: 5px;width:100% ">

                  <input type="radio" 
                  id="<?= $i ?>" 
                  value="<?= $row['pilpil'].$pilihan[$indexpil]; ?>" 
                  name="pil[<?= $row['pilid']; ?>]" 
                  onclick="updateColor(<?= $i ?>)">

                  <!-- INDEX PILIHAN -->
                  <div class ="btn">
                   <?=  $pilihan[$indexpil];?>.
                 </div>
                 <!-- INDEX PILIHAN -->

                 <!-- INDEX PILIHAN KALO ADA GAMBAR-->
                 <?php if (empty($row['pilgam'])) {
                   echo '';
                 } else { ?>
                 <img src="<?= base_url('./assets/image/jawaban/' . $row['pilgam']) ?>">
                 <?php } ?>
                 <!-- INDEX PILIHAN KALO ADA GAMBAR-->

                 <?= $row['piljaw'] ?>
                 <?php $indexpil++;?>
               </label> 
             </div>
             <?php
           } else {
           // $indexpil=0;
           }
           ?>
         <?php endforeach ?>
         <span class="soal-<?=$key['soalid']?>"></span>
       </div>
     </div>
   </div>
 </div>
</div>
</div>
</li>
<?php
$i++;
$nosoal++;
?>
<?php endforeach; ?>
</ul>
</div>
<div style="margin-left:40">
 <div class="col-md-6">
  <button class="btn btn-info btn-block" id="btnPrev">Sebelumnya</button>
  <!--<button type="button" class="btn btn-primary btn-block">Selanjutnya</button>-->
</div>
<div class="col-md-6"> 
  <button class="btn btn-info btn-block" id="btnNext">Selanjutnya</button>
  <!--<button type="button" class="btn btn-teal btn-block">Sebelumnya</button>-->
</div>
</div>
</div>

<!--<div style="clear: both"></div>-->
<div class="col-md-4">
  <div class="panel panel-default"  style="min-height:170px;">
   <!--panel heading/header--> 
   <div class="panel-heading">
    <div class="row">
     <!--<div class="text-center"><h4>Lembar Jawaban</h4></div>-->
     <div class="text-center"> <h4><span id="timer"></span></h4></div>
     <input type="text" hidden="true" id="durasi" value="" name="durasi" />
   </div>
 </div>
 <!--/ panel heading/header--> 
 <!--panel body with collapse capabale--> 
 <div class="panel-collapse">
  <div class="panel-body">
   <div class="row">
    <div class="col-md-10 col-md-offset-1">
     <!--<li class="pageNumbers"></li>-->
     <div class="ljk" style="margin-top:-20">
      <?php
      $nojwb = 1;
      foreach ($soal as $jwb) {
       ?>
       <div id="flex-item" >
        <div id ="jwb_sisJ" class ="jwb<?= $nojwb ?>"></div>
        <a href ="#" id ="nom_sisS" class ="go_slide btn" style ="border:1px solid #63d3e9" alt="<?= $nojwb ?>"><?= $nojwb ?></a>
      </div>
      <?php
      $nojwb++;
    }
    ?>
  </div>

</div>
<!--</ul>-->  

<div class="clear" style="clear:both"></div>

<div class="col-md-12" style="">
 <hr> 
 <button type="button" class="btn btn-info btn-block" onclick="kirimHasil();">Kumpulkan Jawaban</button>
</div>

</div>
</div> 
<!--/ panel body with collapse capabale--> 
</div>
<!--/ END panel--> 
</div>
</div>
</form>
</div>
</div>

</div>
</section>

<!--/ END Register Content -->

<!-- START To Top Scroller -->

<a href="#" class="totop animation" data-toggle="waypoints totop" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="50%"><i class="ico-angle-up"></i></a>

<!--/ END To Top Scroller -->

</section>
<!--/ END Template Main -->
<script>
  function updateColor(id) {
   $(".jwb" + id).html($('input[id="' + id + '"]:checked').val()[1]);
   $('a[alt="' + id + '"]').css({"background-color": "#5bc0de", "color": "#fff", "border": "none"});
 }

 function raguColor(id) {
   $('a[alt="' + id + '"]').css({"background-color": "#ffd66a", "color": "#fff", "border": "none"});
 }


 function bataljawab(idsoal,idpil,grouppil){
   clearRadioGroup(idsoal);
   clearpiljaw(idpil,grouppil);
 }


 function clearRadioGroup(GroupName)
 {
   var ele = document.getElementsByName(GroupName);
   for(var i=0;i<ele.length;i++)
    ele[i].checked = false;
}

function clearpiljaw(id,groupname){
 $(".jwb" + id).html("");
 $('a[alt="' + id + '"]').css({"background-color": "#fff", "color": "#00b1e1", "border": "1px solid #63d3e9"});
 $('label[alt="' + groupname + '"]').removeClass( "terpilih" );
}

function changeColor(data){
  console.log(data);
  $('label[alt="' + data.soalid + '"]').removeClass( "terpilih" );
  var d = document.getElementById(data.value);
  d.className = "terpilih";
  pilihan_jawaban = $('input[name=pilsoal-'+data.value+']').val();
   // simpan di local storage
   backup_jawaban = {id:data.soalid,pilihan:pilihan_jawaban};
   localStorage.setItem('soal-'+data.soalid, JSON.stringify(backup_jawaban));
 }


  // lihat jawaban yang sudah di jawab Sebelumnya
  function lihatJawaban(data){
   //ambil local storage berdasarkan id soal
   var retrievedObject = localStorage.getItem('soal-'+data);
   //cek apakah objek yang di cari ada?
   if(retrievedObject){
    // kalo ada masukin ke notif jawaban sebelumna
    backup = JSON.parse(retrievedObject);
    var pilihan = backup.pilihan;

    // kalo di str nya ada delimeter
    if(~pilihan.indexOf("$")){
      //kalo ada render ke mathjax
      backup_replace = pilihan.replace(/\$/g, '');

      // jalan kan fungsi render
      UpdateMath(backup_replace);
    }else{
      // kalo enggak ada pake html biasa aja
      $('#MathOutput').html(backup.pilihan);
    }
  }else{
    // kalo enggak ada, keluarin notifikasi soal belum pernah dijawab
    swal("Anda Belum Menjawab Soal ini!");
  }
}

function close_info_jawaban(){
  $('.pesan-jawaban').toggle();
}

function allStorage() {

  var values = [],
  keys = Object.keys(localStorage),
  i = keys.length;

  while ( i-- ) {
    values.push( localStorage.getItem(keys[i]) ); 
  }

  return values;
}

  // lihat jawaban yang sudah di jawab Sebelumnya
  function show_storage(data){
    console.log(data);
    $.each( data, function( key, value ) {
     backup = JSON.parse(value);
     $('span.soal-'+backup.id).html("Jawaban Sebelumnya : "+backup.pilihan);
   });
  }

  show_storage(allStorage());
</script>