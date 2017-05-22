<!DOCTYPE html>
<html class="backend">
<!-- START Head -->
<head>
 <!-- START META SECTION -->
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <title><?=$judul_halaman;?></title>
 <meta name="author" content="pampersdry.info">
 <meta name="description" content="Adminre is a clean and flat backend and frontend theme build with twitter bootstrap 3.1.1">
 <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

 <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?= base_url('assets/image/touch/apple-touch-icon-144x144-precomposed.png') ?>">
 <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?= base_url('assets/image/touch/apple-touch-icon-114x114-precomposed.png') ?>">
 <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?= base_url('assets/image/touch/apple-touch-icon-72x72-precomposed.png') ?>">
 <link rel="apple-touch-icon-precomposed" href="<?= base_url('assets/image/touch/apple-touch-icon-57x57-precomposed.png') ?>">
 <link rel="shortcut icon" href="<?= base_url('assets/image/favicon.ico') ?>">
 <link rel="stylesheet" href="<?= base_url('assets/plugins/datatables/css/jquery.datatables.min.css'); ?>">
 <script src="<?= base_url('assets/sal/sweetalert-dev.js');?>"></script>
 <link rel="stylesheet" href="<?= base_url('assets/sal/sweetalert.css');?>">

 <script type="text/javascript" src="<?= base_url('assets/library/jquery/js/jquery.min.js') ?>"></script>
 <script type="text/javascript" src="<?=base_url('assets/plugins/owl/js/owl.carousel.min.js');?>"></script>
 <!-- socket.io -->
 <script src="<?php echo base_url('node_modules/socket.io/node_modules/socket.io-client/socket.io.js');?>"></script>
 <!-- /socket.io -->
 
 <script>var base_url = '<?php echo base_url() ?>'</script>
 <!--/ END META SECTION -->

 

 <!-- START STYLESHEETS -->
 <!-- Plugins stylesheet : optional -->


 <!--/ Plugins stylesheet -->

 <!-- Application stylesheet : mandatory -->
 <link rel="stylesheet" href="<?= base_url('assets/library/bootstrap/css/bootstrap.min.css') ?>">
 <link rel="stylesheet" href="<?= base_url('assets/stylesheet/layout.min.css') ?>">
 <link rel="stylesheet" href="<?= base_url('assets/stylesheet/uielement.min.css') ?>">
 <!--/ Application stylesheet -->
 <!-- END STYLESHEETS -->

 <link rel="stylesheet" href="<?= base_url('assets/plugins/steps/css/jquery-steps.min.css') ?>">

 <!-- css aoutocomplate -->
 <link href='<?php echo base_url();?>assets/css/jquery.autocomplete.css' rel='stylesheet' />
 <!-- JS aoutocomplate -->
 <script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery.autocomplete.js'></script>

 <!-- START JAVASCRIPT SECTION - Load only modernizr script here -->
 <script src="<?= base_url('assets//library/modernizr/js/modernizr.min.js') ?>"></script>
 <!--/ END JAVASCRIPT SECTION -->
</head>
<!--/ END Head -->

<!-- START Body -->
<body>

  <!-- sound notification -->
  <audio id="notif_audio"><source src="<?php echo base_url('sounds/notify.ogg');?>" type="audio/ogg"><source src="<?php echo base_url('sounds/notify.mp3');?>" type="audio/mpeg"><source src="<?php echo base_url('sounds/notify.wav');?>" type="audio/wav"></audio>
  <!-- /sound notification -->

  <!-- START Modal ADD BANK SOAL -->
  <div class="modal fade" id="modalmodul" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
     <div class="modal-content">
      <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       <h4 class="modal-title">Form Modul</h4>
     </div>


     <!-- Start Body modal -->
     <div class="modal-body">
      <!--      <form  class="panel panel-default form-horizontal form-bordered" action="<?=base_url();?>index.php/banksoal/listsoal" method="get" > -->
      <form  class="panel panel-default form-horizontal form-bordered" action="<?=base_url();?>index.php/modulonline/filtermodul" method="post" >
        <div  class="form-group">
         <label class="col-sm-3 control-label">Tingkat</label>
         <div class="col-sm-8">
           <!-- stkt = soal tingkat -->
           <select class="form-control gettkt" name="tingkat" id="stkt">
             <option>-Pilih Tingkat-</option>
           </select>
         </div>
       </div>

       <div  class="form-group">
         <label class="col-sm-3 control-label">Mata Pelajaran</label>
         <div class="col-sm-8">
          <select class="form-control getpel" name="mataPelajaran" id="spel">

          </select>
        </div>
      </div>


    </div>
    <!-- END BODY modla-->
    <div class="modal-footer">
      <button type="submit" id="myFormSubmit" class="btn btn-primary">Proses</button>                
    </div>
  </form> 
</div><!-- /.modal-content -->

</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- END  Modal ADD BANK SOAL-->

<!-- START Modal ADD BANK SOAL -->
<div class="modal fade" id="modalsoal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
   <div class="modal-content">
    <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
     <h4 class="modal-title">Form Soal</h4>
   </div>


   <!-- Start Body modal -->
   <div class="modal-body">
    <!--      <form  class="panel panel-default form-horizontal form-bordered" action="<?=base_url();?>index.php/banksoal/listsoal" method="get" > -->
    <form  class="panel panel-default form-horizontal form-bordered" action="<?=base_url();?>index.php/banksoal/filtersoal2" method="get" >
      <div  class="form-group">
       <label class="col-sm-3 control-label">Tingkat</label>
       <div class="col-sm-8">
         <!-- stkt = soal tingkat -->
         <select class="form-control gettkt" name="tingkat" id="stkt2">
           <option>-Pilih Tingkat-</option>
         </select>
       </div>
     </div>

     <div  class="form-group">
       <label class="col-sm-3 control-label">Mata Pelajaran</label>
       <div class="col-sm-8">
        <select class="form-control getpel2" name="mataPelajaran" id="spel2">

        </select>
      </div>
    </div>

    <div  class="form-group">
     <label class="col-sm-3 control-label">Bab</label>
     <div class="col-sm-8">
      <select class="form-control getbb2" name="bab" id="sbab2">

      </select>
    </div>
  </div>

  <div class="form-group">
   <label class="col-sm-3 control-label">Subab</label>
   <div class="col-sm-8">
    <select class="form-control subb2" name="subbab" id="ssub2">

    </select>
  </div>
</div>

</div>
<!-- END BODY modla-->
<div class="modal-footer">
  <button type="submit" id="myFormSubmit" class="btn btn-primary"  >Proses</button>                
</div>
</form> 
</div><!-- /.modal-content -->

</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- END  Modal ADD BANK SOAL-->

<!-- START Modal Filter Video -->
<div class="modal fade" id="modalvideo" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
   <div class="modal-content">
    <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
     <h4 class="modal-title">Filter Video</h4>
   </div>


   <!-- Start Body modal -->
   <div class="modal-body">
     <form  class="panel panel-default form-horizontal form-bordered" action="<?=base_url();?>index.php/videoback/filter_video" method="post" >
      <div  class="form-group">
       <label class="col-sm-3 control-label">Tingkat</label>
       <div class="col-sm-8">
         <!-- vtkt = video tingkat -->
         <select class="form-control gettkt" name="tingkat" id="vtkt">
           <option>-Pilih Tingkat-</option>
         </select>
       </div>
     </div>

     <div  class="form-group">
       <label class="col-sm-3 control-label">Mata Pelajaran</label>
       <div class="col-sm-8">
        <select class="form-control getpel" name="mataPelajaran" id="vpel">

        </select>
      </div>
    </div>

    <div  class="form-group">
     <label class="col-sm-3 control-label">Bab</label>
     <div class="col-sm-8">
      <select class="form-control getbb" name="bab" id="vbab">

      </select>
    </div>
  </div>

  <div class="form-group">
   <label class="col-sm-3 control-label">Subab</label>
   <div class="col-sm-8">
    <select class="form-control subb" name="subbab" id="vsub">

    </select>
  </div>
</div>

</div>
<!-- END BODY modla-->
<div class="modal-footer">
  <button type="submit" id="myFormSubmit" class="btn btn-primary"  >Proses</button>                
</div>
</form> 
</div><!-- /.modal-content -->

</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- END  Modal Filter Video -->

<!-- Start Modal Tambah Gallery -->
<div class="modal fade" id="modalgallery" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambah Gallery</h4>
      </div>


      <!-- Start Body modal -->
      <div class="modal-body">
        <form  class="panel panel-default form-horizontal form-bordered" action="<?=base_url();?>index.php/gallery/formGallery" method="post" >
          <div  class="form-group">
            <label class="col-sm-3 control-label">Tingkat</label>
            <div class="col-sm-8">
              <!-- vtkt = video tingkat -->
              <select class="form-control gettkt" name="tingkat" id="galtkt" required="true">
                <option>-Pilih Tingkat-</option>
              </select>
            </div>
          </div>

          <div  class="form-group">
            <label class="col-sm-3 control-label">Mata Pelajaran</label>
            <div class="col-sm-8">
              <select class="form-control getpel" name="mataPelajaran" id="galpel" required="true">

              </select>
            </div>
          </div>

          <div  class="form-group">
            <label class="col-sm-3 control-label">Bab</label>
            <div class="col-sm-8">
              <select class="form-control getbb" name="bab" id="galbab" required="true">

              </select>
            </div>
          </div>

          <div class="modal-footer">
            <button type="submit" id="myFormSubmit" class="btn btn-primary"  >Proses</button>                
          </div>
        </form> 
      </div>
    </div>
  </div>
</div>
<!-- /.modal-content -->
<!-- Start Modal Filter Gallery  -->
<div class="modal fade" id="modalfilter-gallery" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Filter Gallery</h4>
      </div>


      <!-- Start Body modal -->
      <div class="modal-body">
        <form  class="panel panel-default form-horizontal form-bordered" action="<?=base_url();?>index.php/gallery/filtergallery" method="post" >
          <div  class="form-group">
            <label class="col-sm-3 control-label">Tingkat</label>
            <div class="col-sm-8">
              <!-- vtkt = video tingkat -->
              <select class="form-control gettkt" name="tingkat" id="fgaltkt">
                <option>-Pilih Tingkat-</option>
              </select>
            </div>
          </div>

          <div  class="form-group">
            <label class="col-sm-3 control-label">Mata Pelajaran</label>
            <div class="col-sm-8">
              <select class="form-control getpel" name="mataPelajaran" id="fgalpel">

              </select>
            </div>
          </div>

          <div  class="form-group">
            <label class="col-sm-3 control-label">Bab</label>
            <div class="col-sm-8">
              <select class="form-control getbb" name="bab" id="fgalbab">

              </select>
            </div>
          </div>

          <div class="modal-footer">
            <button type="submit" id="myFormSubmit" class="btn btn-primary"  >Proses</button>                
          </div>
        </form> 
      </div>
    </div>
  </div>
</div>
<!-- /.modal-content -->



<!-- START Template Header -->
<header id="header" class="navbar navbar-fixed-top">
  <!-- START navbar header -->
  <div class="navbar-header" style="background:#f27c66;">
   <!-- Brand -->
   <a class="navbar-brand" href="javascript:void(0);">
    <span class="logo-figure"></span>
    <span class="logo-text"></span>
  </a>
  <!--/ Brand -->
</div>
<!--/ END navbar header -->

<!-- START Toolbar -->
<div class="navbar-toolbar clearfix">
 <!-- START Left nav -->
 <ul class="nav navbar-nav navbar-left">
  <!-- Sidebar shrink -->
  <li class="hidden-xs hidden-sm">
   <a href="javascript:void(0);" class="sidebar-minimize" data-toggle="minimize" title="Minimize sidebar">
    <span class="meta">
     <span class="icon"></span>
   </span>
 </a>
</li>
<!--/ Sidebar shrink -->

<!-- Offcanvas left: This menu will take position at the top of template header (mobile only). Make sure that only #header have the `position: relative`, or it may cause unwanted behavior -->
<li class="navbar-main hidden-lg hidden-md hidden-sm">
 <a href="javascript:void(0);" data-toggle="sidebar" data-direction="ltr" rel="tooltip" title="Menu sidebar">
  <span class="meta">
   <span class="icon"><i class="ico-paragraph-justify3"></i></span>
 </span>
</a>
</li>
<!--/ Offcanvas left -->

<!-- Notification dropdown -->
<li class="dropdown custom" id="header-dd-notification">
 <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
  <span class="meta">
   <input type="int" name="count_komen" value="<?=$count_komen; ?>" hidden="true">
   <span class="icon" id="new_count_komen">
     <span class="jumlah_notifikasi"><?=$count_komen; ?></span>
     <i class="ico-bell"></i></span>

     <!-- <?php if ($count_komen!=0): ?>
     <?php echo $count_komen ?> -->
     <span class="hasnotification hasnotification-danger"></span>
     <!-- <?php endif ?> -->
   </span>
 </a>


 <!-- Dropdown menu -->
 <div class="dropdown-menu" role="menu">
  <div class="dropdown-header">
   <span class="title">Notification <?=$count_komen ?><span class="count"></span></span>
   <span class="option text-right"><a href="javascript:void(0);" title="Close Notifikasi"><i class="ico-close3"></i></a></span>
 </div>
 <div class="dropdown-body slimscroll">
   <!-- indicator -->
   <!-- <div class="indicator inline"><span class="spinner"></span></div> -->
   <!--/ indicator -->

   <!-- Message list -->
   <div class="media-list" id="message-tbody">

    <?php foreach ($datKomen as $key ): ?>
      <a href="<?=base_url()?>komenback/seevideo/<?=$key['videoID']?>/<?=$key['UUID']?>" class="media border-dotted read">
        <span class="pull-left">
          <img src="<?=base_url()?>assets\image\photo\siswa\<?=$key['siswa_photo']?>" class="media-object img-circle" alt="">
        </span>
        <span class="media-body">
          <span class="media-heading"><?=$key['namaPengguna']?></span>
          <span class="media-text ellipsis nm"><?=$key['isiKomen']?></span>
          <!-- meta icon -->
          <span class="media-meta pull-right"><?=$key['date_created']?></span>
          <!--/ meta icon -->
        </span>
      </a>
    <?php endforeach ?>

    <?php foreach ($konsultasi as $value ): ?>
      <?php $photos = base_url('assets/image/photo/siswa/'.$value['photo']) ?>
      <a href="<?= base_url('konsultasi/singlekonsultasi/'.$value['id'])?>" class="media border-dotted read pertanyaan-<?=$value['id']?>"><span class="pull-left">
        <img src='<?=$photos ?>' class="media-object img-circle" alt=""></span><span class="media-body"><span class="media-heading"><?=$value['nama_lengkap'] ?></span>
        <span class="media-text ellipsis nm"><span>Konsultasi :</span> <?=$value['judulPertanyaan'] ?></span><span title="Ditujukan Pada Anda"><i class="ico-star"></i></span>
        <!-- meta icon --><span class="media-meta pull-right"><span class="text-info">Status Belum Direspon
        | 
      </span><?=$value['date_created'] ?></span><!--/ meta icon --></span></a>
    <?php endforeach ?>

     <?php foreach ($notif_pertanyaan_mentor as $value ): ?>
      <?php $photos = base_url('assets/image/photo/siswa/'.$value['photo']) ?>
      <a href="<?= base_url('konsultasi/singlekonsultasi/'.$value['id'])?>" class="media border-dotted read pertanyaan-<?=$value['id']?>"><span class="pull-left">
        <img src='<?=$photos ?>' class="media-object img-circle" alt=""></span><span class="media-body"><span class="media-heading"><?=$value['nama_lengkap'] ?></span>
        <span class="media-text ellipsis nm"><span>Konsultasi :</span> <?=$value['judulPertanyaan'] ?></span><span title="Pelajaran <?=$value['namaMataPelajaran'] ?>"><i class="ico-star-empty"></i></span>
        <!-- meta icon --><span class="media-meta pull-right"><span class="text-info">Status Belum Direspon
        | 
      </span><?=$value['date_created'] ?></span><!--/ meta icon --></span></a>
    <?php endforeach ?>

  </div>
  <!--/ Message list -->
</div>
</div>
<!--/ Dropdown menu -->
</li>
<!--/ Notification dropdown -->


</ul>
<!--/ END Left nav -->

<!-- START navbar form -->
<div class="navbar-form navbar-left dropdown" id="dropdown-form">
  <form action="" role="search">
   <div class="has-icon">
    <input type="text" class="form-control" placeholder="Search application...">
    <i class="ico-search form-control-icon"></i>
  </div>
</form>
</div>
<!-- START navbar form -->

<!-- START Right nav -->
<ul class="nav navbar-nav navbar-right">
  <!-- Profile dropdown -->
  <li class="dropdown profile">
   <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
    <span class="meta">
     <span class="avatar">

     </span>
     <span class="text hidden-xs hidden-sm pl5"><?=$this->session->userdata['NAMAGURU'];?></span>
     <span class="caret"></span>
   </span>
 </a>
 <ul class="dropdown-menu" role="menu">
  <li><a href="javascript:void(0);"><span class="icon"><i class="ico-user-plus2"></i></span> My Accounts</a></li>
  <li><a href="<?=base_url('index.php/guru/pengaturanProfileguru');?>"><span class="icon"><i class="ico-cog4"></i></span> Profile Setting</a></li>
  <li><a href="javascript:void(0);"><span class="icon"><i class="ico-question"></i></span> Help</a></li>
  <li class="divider"></li>
  <li><a href="<?=base_url('index.php/logout');?>"><span class="icon"><i class="ico-exit"></i></span> Sign Out</a></li>
</ul>
</li>
<!-- Profile dropdown -->


</ul>
<!--/ END Right nav -->
</div>
<!--/ END Toolbar -->
</header>
<!--/ END Template Header -->

<!-- START Template Sidebar (Left) -->
<aside class="sidebar sidebar-left sidebar-menu">
  <!-- START Sidebar Content -->
  <section class="content slimscroll">
   <h5 class="heading">Main Menu</h5>
   <!-- START MENU -->
   <ul class="topmenu topmenu-responsive" data-toggle="menu">
    <li >
     <a href="<?= base_url('index.php/guru/dashboard/') ?>">
      <span class="figure"><i class="ico-trophy"></i></span>
      <span class="text">Dashboard</span>
    </a>
  </li>

  <li>
   <a href="javascript:void(0);" data-target="#video" data-toggle="submenu" data-parent=".topmenu">
    <span class="figure"><i class="ico-facetime-video"></i></span>
    <span class="text">Video</span>
    <span class="arrow"></span>
  </a>

  <ul id="video" class="submenu collapse ">
    <li class="submenu-header ellipsis">Video</li>

    <li >
     <a href="<?=base_url('index.php/videoback/formupvideo')?>">
      <span class="text">Upload Video</span>
    </a>
  </li>

  <li>
    <a href="javascript:void(0);" data-target="#filtervideo" data-toggle="submenu"  >

      <span class="text">Daftar video</span>

      <span class="arrow"></span>

    </a>

    <ul id="filtervideo" class="submenu collapse ">

      <li class="submenu-header ellipsis">Daftar video</li>

      <li><a href="<?=base_url()?>index.php/videoback/managervideo"><span class="text">My video</span></a></li>
      <li >
       <a href="<?=base_url('/index.php/videoback/daftarvideo')?>">
        <span class="text">Daftar Semua video</span>
      </a>
    </li>

    <li><a href="javascript:void(0);" onclick="filter_video()"><span class="text">Filter Video</span></a></li>
  </ul>
</li>
</ul>
</li>
<li>
  <a href="javascript:void(0);" data-target="#gallery" data-toggle="submenu" data-parent=".topmenu">
    <span class="figure"><i class="ico-images"></i></span>
    <span class="text">Gallery</span>
    <span class="arrow"></span>
  </a>

  <ul id="gallery" class="submenu collapse ">
    <li class="submenu-header ellipsis">gallery</li>
    <li >
      <a href="<?=base_url('index.php/gallery')?>">
        <span class="text">Gallery</span>
      </a>
    </li>
    <li >
      <a href="javascript:void(0)" onclick="filter_gallery()">
        <span class="text">Filter Gallery</span>
      </a>
    </li>
    <li >
      <a href="javascript:void(0)" onclick="add_gallery()">
        <span class="text">Tambahkan gallery</span> 
      </a>
    </li>

  </ul>
</li>
<li>
 <a href="javascript:void(0);" data-target="#banksoal" data-toggle="submenu" data-parent=".topmenu">
  <span class="figure"><i class="ico-clipboard2"></i></span>
  <span class="text">Bank Soal</span>
  <span class="arrow"></span>
</a>

<ul id="banksoal" class="submenu collapse ">
  <li class="submenu-header ellipsis">Bank Soal</li>

  <li >
   <a href="javascript:void(0);" onclick="add_soal()">
    <span class="text">Tambahkan Bank Soal</span> 
  </a>
</li>
<li >
 <a href="javascript:void(0);" data-target="#subbanksoal" data-toggle="submenu"  >
  <span class="text">Daftar Bank Soal</span>
  <span class="arrow"></span>
</a>
<ul id="subbanksoal" class="submenu collapse ">
  <li class="submenu-header ellipsis">Sub Bank Soal</li>
  <li><a href="<?=base_url('index.php/banksoal/mysoal')?>"><span class="text">Daftar Soal Saya</span>
  </a></li>
  <li><a href="<?=base_url('index.php/banksoal/listsoal')?>"><span class="text">Daftar Semua Soal</span>
  </a></li>
  <li><a href="<?=base_url('index.php/banksoal/allsoal')?>"><span class="text">Daftar Tabel Soal</span>
  </a></li>
  <li><a href="javascript:void(0);" onclick="add_soal()"><span class="text">Filter Bank Soal</span>
  </a></li>


</ul>
</li>

</ul>
</li>

<li>
 <a href="javascript:void(0);" data-target="#tryout" data-toggle="submenu" data-parent=".topmenu">
  <span class="figure"><i class="ico-clipboard"></i></span>
  <span class="text">Try Outs</span>
  <span class="arrow"></span>
</a>

<ul id="tryout" class="submenu collapse ">
  <li class="submenu-header ellipsis">Try Out</li>

  <li >
   <a href="<?= base_url('index.php/paketsoal/tambahpaketsoal');?>">
    <span class="text">Paket Soal</span>
  </a>
</li>

<li >
 <a href="<?= base_url('index.php/toback/listTo');?>">
  <span class="text">Daftar Try Out</span>
</a>
</li>

</ul>
</li>

<!--Start menu konsultasi -->
<li>
 <a href="javascript:void(0);" data-target="#konsultasi" data-toggle="submenu" data-parent=".topmenu">
  <span class="figure"><i class="ico-clipboard"></i></span>
  <span class="text">Konsultasi Forum</span>
  <span class="arrow"></span>
</a>

<ul id="konsultasi" class="submenu collapse ">
  <li class="submenu-header ellipsis">Konsultasi Forum/li>

    <li >
     <a href="<?= base_url('index.php/konsulback/myhistory');?>">
      <span class="text">Daftar Konsultasi Forum</span>
    </a>
  </li>

  <li >
   <a href="<?= base_url('index.php/konsulback/myhistory');?>">
    <span class="text">History</span>
  </a>
</li>

</ul>
</li>

<li>
  <a href="<?=base_url('komenback') ?>" data-toggle="submenu" data-parent=".topmenu">
    <span class="figure"><i class="ico-comments"></i></span>
    <span class="text">Komen</span>
    <span class="arrow"></span>
  </a>
</li>
<!--END menu konsultasi -->



<li>
 <a href="javascript:void(0);" data-target="#modulonline" data-toggle="submenu" data-parent=".topmenu">
  <span class="figure"><i class="ico-clipboard2"></i></span>
  <span class="text">Modul Online</span>
  <span class="arrow"></span>
</a>

<ul id="modulonline" class="submenu collapse ">
  <li class="submenu-header ellipsis">Modul Online</li>

  <li >
   <a href="javascript:void(0);" onclick="add_modul()">
    <span class="text">Tambahkan Modul</span> 
  </a>
</li>
<li >
 <a href="<?=base_url('index.php/modulonline/allsoal')?>" data-target="#submodul" data-toggle="submenu"  >
  <span class="text">Daftar Modul</span>
</a>
</li>

</ul>
</li>
<li>
 <a href="<?= base_url('learningline') ?>">
  <span class="figure"><i class="ico-list-ol"></i></span>
  <span class="text">Learningline</span>
</a>
</li>
</ul>
<!--/ END Template Navigation/Menu -->
</section>
<!--/ END Sidebar Container -->
</aside>
<!--/ END Template Sidebar (Left) -->

<!-- START Template Main -->
<section id="main" role="main">
  <!-- START Template Container -->
  <div class="container-fluid">
   <!-- Page Header -->
   <div class="page-header page-header-block">
    <div class="page-header-section">
     <h4 class="title semibold"><?=$judul_halaman;?></h4>
   </div>

 </div>

 <?php
 foreach ($files as $file) {
  include $file;
}
?>

<!-- Page Header -->
</div>
<!--/ END Template Container -->

<!-- START To Top Scroller -->
<a href="#" class="totop animation" data-toggle="waypoints totop" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="50%"><i class="ico-angle-up"></i></a>
<!--/ END To Top Scroller -->

</section>
<!--/ END Template Main -->



<!-- START JAVASCRIPT SECTION (Load javascripts at bottom to reduce load time) -->
<!-- Library script : mandatory -->
<script type="text/javascript" src="<?= base_url('assets/library/jquery/js/jquery-migrate.min.j') ?>s"></script>
<script type="text/javascript" src="<?= base_url('assets/library/bootstrap/js/bootstrap.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/library/core/js/core.min.js') ?>"></script>
<!--/ Library script -->

<!-- App and page level script -->
<script type="text/javascript" src="<?= base_url('assets/plugins/sparkline/js/jquery.sparkline.min.js') ?>"></script><!-- will be use globaly as a summary on sidebar menu -->
<script type="text/javascript" src="<?= base_url('assets/javascript/app.min.js') ?>"></script>

<!--datatable-->
<script type="text/javascript" src="<?= base_url('assets/plugins/datatables/js/jquery.datatables.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/plugins/datatables/tabletools/js/tabletools.min.js') ?>"></script>
<!--<script type="text/javascript" src="<?= base_url('assets/plugins/datatables/tabletools/js/zeroclipboard.js') ?>"></script>-->
<script type="text/javascript" src="<?= base_url('assets/plugins/datatables/js/jquery.datatables-custom.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/javascript/tables/datatable.js') ?>"></script>

<script type="text/javascript" src="<?=base_url('assets/javascript/forms/wizard.js')?>"></script>
<script type="text/javascript" src="<?=base_url('assets/plugins/parsley/js/parsley.min.js')?>"></script>

<script type="text/javascript" src="<?=base_url('assets/plugins/steps/js/jquery.steps.min.js')?>"></script>

<script type="text/javascript" src="<?=base_url('assets/plugins/inputmask/js/inputmask.min.js')?>"></script>

<script type="text/javascript">
  var keahlian = JSON.parse('<?=$keahlian_detail ?>');

  jQuery(document).ready(function () {
    var socket = io.connect( 'http://'+window.location.hostname+':3000' );
    var idPengguna=('<?=$this->session->userdata['id'];?>');
    var idGuru = ('<?=$this->session->userdata['id_guru']?>');
    var new_count_komen = 0;
    var mapelID=8;
    var obMapel ='';
    var url = "<?= base_url() ?>index.php/guru/ajax_mapelID";
    console.log(idGuru);

    socket.on( 'new_komen', function( data ) {
      var userID = data.userID;
      var mapelID = data.mapelID;
      var photo = data.photo; 
          //ajax untuk get data mapelid guru
          $.ajax({
            url:url,
            success:function(mapel){
              //ubah type data mapel id guru dari jason ke objek
              obMapel =JSON.parse(mapel);
              for (i = 0; i < obMapel.length; i++) { 
                mapelIdGuru=obMapel[i].mapelID;
                //cek data koemn jika data komen bukan milik dia dan mapel id sesuai dengan mapel id guru 
                if (idPengguna!=userID && mapelID==mapelIdGuru) {
                  //jika true 
                  var old_count_komen = parseInt($('[name=count_komen]').val());
                  new_count_komen = old_count_komen + 1;
                  $('[name=count_komen]').val(new_count_komen);
                  $( "#new_count_komen" ).html( new_count_komen+'<i class="ico-bell"></i>');  
                  // play sound notification
                  $('#notif_audio')[0].play();
                  //add komen baru ke data notif id message-tbody
                  $( "#message-tbody" ).prepend(' <a href="'+base_url+'komenback/seevideo/'+data.videoID+'/'+data.UUID+'" class="media border-dotted read"><span class="pull-left"><img src="'+photo+'" class="media-object img-circle" alt=""></span><span class="media-body"><span class="media-heading">'+data.namaPengguna+'</span><span class="media-text ellipsis nm">'+data.isiKomen+'</span><!-- meta icon --><span class="media-meta pull-right">'+data.date_created+'</span><!--/ meta icon --></span></a>');
                }
              }
            },              
          });
          
        });

    // SOCKET CREATE PERTANYAAN
    socket.on('create_pertanyaan', function(data){
      $.getJSON( base_url+"konsultasi/jumlah_komen/", function( datas ) {
        $('.jumlah_notifikasi').text(datas);
      });

      obj = JSON.parse(data.data);
      photo = base_url+"assets/image/photo/siswa/"+obj.photo;
      tampil = false;
      status =  (obj.statusRespon==0) ? "Belum Direspon" : "Sudah Direspon";

      // cek gurunya yang dituju bukan?
      if (obj.mentorID==idGuru) {
        tampil = true;
        //langsung ke mentor
        konten = '<a href="'+base_url+'konsultasi/singlekonsultasi/'+obj.id+'" class="media border-dotted read"><span class="pull-left"><img src="'+photo+'" class="media-object img-circle" alt=""></span><span class="media-body"><span class="media-heading">'+obj.nama_lengkap+'</span><span class="media-text ellipsis nm"><span cla>Konsultasi :</span> '+obj.judulPertanyaan+'</span><!-- meta icon --> <span title="Ditujukan pada anda"><i class="ico-star"></i></span> <span class="media-meta pull-right"><span class="text-info">Status: '+status+' | </span>'+obj.date_created+'</span><!--/ meta icon --></span></a>';
      }else{
        // jika matapelajaran yang diampu
        for (i = 0; i < keahlian.length; i++) { 
          tampil = true;
          if(keahlian[i].mapelID==obj.mapelID){
            konten = '<a href="'+base_url+'konsultasi/singlekonsultasi/'+obj.id+'" class="media border-dotted read"><span class="pull-left"><img src="'+photo+'" class="media-object img-circle" alt=""></span><span class="media-body"><span class="media-heading">'+obj.nama_lengkap+'</span><span class="media-text ellipsis nm"><span cla>Konsultasi :</span> '+obj.judulPertanyaan+'</span><!-- meta icon --> <span title="Matapelajaran '+keahlian[i].aliasMataPelajaran+'"><i class="ico-star-empty"></i></span> <span class="media-meta pull-right"><span class="text-info">Status: '+status+' | </span>'+obj.date_created+'</span><!--/ meta icon --></span></a>';
            break;
          }else{
            tampil = false;
          }

        }
      }

      if (tampil) {
        $('#notif_audio')[0].play();
        $( "#message-tbody" ).prepend(konten);
      }

  });
    // SOCKET CREATE PERTANYAAN
    
    // SOCKET REMOVE NOTIFIKASI
    socket.on('remove_notifikasi', function(data){
      console.log(data.datas.pertanyaanID);
      $('.pertanyaan-'+data.datas.pertanyaanID).remove();
      $('#notif_audio')[0].play();

      $.getJSON( base_url+"konsultasi/jumlah_komen/", function( datas ) {
        $('.jumlah_notifikasi').text(datas);
      });

    });
    // SOCKET REMOVE NOTIFIKASI


  
  });

</script>

<script type="text/javascript">



  function add_modul() {
$('#modalmodul').modal('show'); // show bootstrap modal
}

//panggil modal
function add_soal() {
$('#modalsoal').modal('show'); // show bootstrap modal
}

function filter_video() {
$('#modalvideo').modal('show'); // show bootstrap modal
}



</script>
<!-- drop down dependend for get subbab -->
<script type="text/javascript">
  $.ajax({
   type: "POST",
   url: "<?= base_url() ?>guru/get_avatar_guru",
   success: function (data) { 
    $('span.avatar').html(data);
  }
});
// ####################################################
            //buat load tingkat untuk modal buat soal
            // load tingkat untuk modal bank soal
            function loadTkt() {
             jQuery(document).ready(function () {
              var tingkat_id = {"tingkat_id": $('#stkt2').val()};
              // tingkat id untuk modal video
              // var tingkat_idv = {"tingkat_id": $('vstkt').val()}
              var idTingkat;

              $.ajax({
               type: "POST",
               data: tingkat_id,
               url: "<?= base_url() ?>index.php/videoback/getTingkat",
               success: function (data) {

                $('.gettkt').html('<option value="">-- Pilih Tingkat  --</option>');
                $.each(data, function (i, data) {
                 $('.gettkt').append("<option value='" + data.id + "'>" + data.aliasTingkat + "</option>");
                 return idTingkat = data.id;
               });
              }
            });
              // event untuk modal bank soal
              // #############################
              $('#stkt2').change(function () {
               tingkat_id = {"tingkat_id": $('#stkt2').val()};
               loadPel($('#stkt2').val());
             });
              $('#spel2').change(function () {
               pelajaran_id = {"pelajaran_id": $('#spel2').val()};
               loadBb($('#spel2').val());
             });
              $('#sbab2').change(function () {
               loadSubb($('#sbab2').val());
               // loadPel(idTingkat);
             });
              // #############################

              // event untuk modal video
              // ##############################
              $('#vtkt').change(function () {
               tingkat_id = {"tingkat_id": $('#vtkt').val()};
               loadPelv($('#vtkt').val());
             });
              $('#vpel').change(function () {
               pelajaran_id = {"pelajaran_id": $('#vpel').val()};
               loadBbv($('#vpel').val());
             });
              $('#vbab').change(function () {
               loadSubbv($('#vbab').val());
               // loadPel(idTingkat);
             });
               // ##############################
             })
           }
           ;

            //buat load pelajaran untuk  modal bank soal
            function loadPel(tingkatID) {
             $.ajax({
              type: "POST",
              data: tingkatID.tingkat_id,
              url: "<?php echo base_url() ?>index.php/videoback/getPelajaran/" + tingkatID,
              success: function (data) {
               $('#spel2').html('<option value="">-- Pilih Mata Pelajaran  --</option>');
               $.each(data, function (i, data) {
                $('#spel2').append("<option value='" + data.id + "'>" + data.keterangan + "</option>");
              });
             }
           });
           }
            //buat load pelajaran untuk  modal filter video
            function loadPelv(tingkatID) {
             $.ajax({
              type: "POST",
              data: tingkatID.tingkat_id,
              url: "<?php echo base_url() ?>index.php/videoback/getPelajaran/" + tingkatID,
              success: function (data) {
               $('#vpel').html('<option value="">-- Pilih Mata Pelajaran  --</option>');
               $.each(data, function (i, data) {
                $('#vpel').append("<option value='" + data.id + "'>" + data.keterangan + "</option>");
              });
             }
           });
           }
            // load bab untuk modal bank soal
            function loadBb(mapelID) {
             $.ajax({
              type: "POST",
              data: mapelID.mapel_id,
              url: "<?php echo base_url() ?>index.php/videoback/getBab/" + mapelID,
              success: function (data) {

               $('#sbab2').html('<option value="">-- Pilih Bab Pelajaran  --</option>');

               $.each(data, function (i, data) {
                $('#sbab2').append("<option value='" + data.id + "'>" + data.judulBab + "</option>");
              });
             }

           });
           }
             //load bab untuk modal video
             function loadBbv(mapelID) {
               $.ajax({
                type: "POST",
                data: mapelID.mapel_id,
                url: "<?php echo base_url() ?>index.php/videoback/getBab/" + mapelID,
                success: function (data) {

                 $('#vbab').html('<option value="">-- Pilih Bab Pelajaran  --</option>');

                 $.each(data, function (i, data) {
                  $('#vbab').append("<option value='" + data.id + "'>" + data.judulBab + "</option>");
                });
               }

             });
             }

            //load sub bab untuk modal soal
            function loadSubb(babID){
             $.ajax({
              type: "POST",
              data: babID.bab_id,
              url: "<?php echo base_url() ?>index.php/videoback/getSubbab/"+babID,
              success: function(data){
               $('#ssub2').html('<option value="">-- Pilih Sub Bab Pelajaran  --</option>');

               $.each(data, function(i, data){
                $('#ssub2').append("<option value='"+data.id+"'>"+data.judulSubBab+"</option>");
              });
             }

           });
           }
            // load sub bab untk modal video
            function loadSubbv(babID){
             $.ajax({
              type: "POST",
              data: babID.bab_id,
              url: "<?php echo base_url() ?>index.php/videoback/getSubbab/"+babID,
              success: function(data){
               $('#vsub').html('<option value="">-- Pilih Sub Bab Pelajaran  --</option>');

               $.each(data, function(i, data){
                $('#vsub').append("<option value='"+data.id+"'>"+data.judulSubBab+"</option>");
              });
             }

           });
           }



           loadTkt();
// ####################################################
function add_gallery() {
  $('#modalgallery').modal('show'); // show bootstrap modal
}
function filter_gallery() {
  $('#modalfilter-gallery').modal('show'); // show bootstrap modal
}
  // event untuk modal tambah Gallery
              // ##############################
              $('#galtkt').change(function () {
               tingkat_id = {"tingkat_id": $('#galtkt').val()};
               loadPelgal($('#galtkt').val());
             });
              $('#galpel').change(function () {
               pelajaran_id = {"pelajaran_id": $('#galpel').val()};
               loadBbgal($('#galpel').val());
             });
               // ##############################
                // event untuk modal tambah Gallery
              // ##############################
              $('#fgaltkt').change(function () {
               tingkat_id = {"tingkat_id": $('#fgaltkt').val()};
               loadPelfgal($('#fgaltkt').val());
             });
              $('#fgalpel').change(function () {
               pelajaran_id = {"pelajaran_id": $('#fgalpel').val()};
               loadBbfgal($('#fgalpel').val());
             });
               // ##############################


            //buat load pelajaran untuk  modal tambah gallery video
            function loadPelgal(tingkatID) {
             $.ajax({
              type: "POST",
              data: tingkatID.tingkat_id,
              url: "<?php echo base_url() ?>index.php/videoback/getPelajaran/" + tingkatID,
              success: function (data) {
               $('#galpel').html('<option value="">-- Pilih Mata Pelajaran  --</option>');
               $.each(data, function (i, data) {
                $('#galpel').append("<option value='" + data.id + "'>" + data.keterangan + "</option>");
              });
             }
           });
           }

            //buat load pelajaran untuk  modal filter gallery
            function loadPelfgal(tingkatID) {
             $.ajax({
              type: "POST",
              data: tingkatID.tingkat_id,
              url: "<?php echo base_url() ?>index.php/videoback/getPelajaran/" + tingkatID,
              success: function (data) {
               $('#fgalpel').html('<option value="">-- Pilih Mata Pelajaran  --</option>');
               $.each(data, function (i, data) {
                $('#fgalpel').append("<option value='" + data.id + "'>" + data.keterangan + "</option>");
              });
             }
           });
           }
             //load bab untuk modal tambah gallery
             function loadBbgal(mapelID) {
               $.ajax({
                type: "POST",
                data: mapelID.mapel_id,
                url: "<?php echo base_url() ?>index.php/videoback/getBab/" + mapelID,
                success: function (data) {

                 $('#galbab').html('<option value="">-- Pilih Bab Pelajaran  --</option>');

                 $.each(data, function (i, data) {
                  $('#galbab').append("<option value='" + data.id + "'>" + data.judulBab + "</option>");
                });
               }

             });
             }

             //load bab untuk modal filter gallery
             function loadBbfgal(mapelID) {
               $.ajax({
                type: "POST",
                data: mapelID.mapel_id,
                url: "<?php echo base_url() ?>index.php/videoback/getBab/" + mapelID,
                success: function (data) {

                 $('#fgalbab').html('<option value="">-- Pilih Bab Pelajaran  --</option>');

                 $.each(data, function (i, data) {
                  $('#fgalbab').append("<option value='" + data.id + "'>" + data.judulBab + "</option>");
                });
               }

             });
             }

           </script>
           <!-- Cometchat -->
           <link type="text/css" href="/cometchat/cometchatcss.php" rel="stylesheet" charset="utf-8">
           <script type="text/javascript" src="/cometchat/cometchatjs.php" charset="utf-8"></script>
           <!--/ App and page level script -->
           <!--/ END JAVASCRIPT SECTION -->

         </body>
         <!--/ END Body -->
         </html>