<!DOCTYPE html>
<html class="backend">
<!-- START Head -->

<!-- test aaaa -->
<head>
  <!-- START META SECTION -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{judul_halaman}</title>
  <meta name="author" content="pampersdry.info">
  <meta name="description" content="Adminre is a clean and flat backend and frontend theme build with twitter bootstrap 3.1.1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?= base_url('assets/image/touch/apple-touch-icon-144x144-precomposed.png') ?>">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?= base_url('assets/image/touch/apple-touch-icon-114x114-precomposed.png') ?>">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?= base_url('assets/image/touch/apple-touch-icon-72x72-precomposed.png') ?>">
  <link rel="apple-touch-icon-precomposed" href="<?= base_url('assets/image/touch/apple-touch-icon-57x57-precomposed.png') ?>">
  <link rel="shortcut icon" href="<?= base_url('assets/image/favicon.ico') ?>">
  <script type="text/javascript" src="<?= base_url('assets/library/jquery/js/jquery.min.js') ?>"></script>
  <link rel="stylesheet" href="<?= base_url('assets/plugins/datatables/css/jquery.datatables.min.css'); ?>">
  <script src="<?= base_url('assets/sal/sweetalert-dev.js');?>"></script>
  <link rel="stylesheet" href="<?= base_url('assets/sal/sweetalert.css');?>">
  <script>var base_url = '<?php echo base_url() ?>'</script>
  <!--/ END META SECTION -->

  <!-- START STYLESHEETS -->
  <!-- Plugins stylesheet : optional -->


  <!--/ Plugins stylesheet -->
  <!-- css aoutocomplate -->
  <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>
  <link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet"></link>

<!-- <link href='<?php echo base_url();?>assets/css/jquery.autocomplete.css' rel='stylesheet' />
JS aoutocomplate
<script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery.autocomplete.js'></script> -->
<!-- Application stylesheet : mandatory -->
<link rel="stylesheet" href="<?= base_url('assets/library/bootstrap/css/bootstrap.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/stylesheet/layout.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/stylesheet/uielement.min.css') ?>">
<!--/ Application stylesheet -->
<!-- END STYLESHEETS -->

<!-- START JAVASCRIPT SECTION - Load only modernizr script here -->
<script src="<?= base_url('assets//library/modernizr/js/modernizr.min.js') ?>"></script>
<!--/ END JAVASCRIPT SECTION -->

</head>
<!--/ END Head -->
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
<!-- END BODY modla-->
<!-- START Body -->
<body>
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
     <form  class="panel panel-default form-horizontal form-bordered" action="<?=base_url();?>index.php/banksoal/filtersoal2" method="get" >
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

    <div  class="form-group">
     <label class="col-sm-3 control-label">Bab</label>
     <div class="col-sm-8">
      <select class="form-control getbb" name="bab" id="sbab">

      </select>
    </div>
  </div>

  <div class="form-group">
   <label class="col-sm-3 control-label">Subab</label>
   <div class="col-sm-8">
    <select class="form-control subb" name="subbab" id="ssub">

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
        <span class="icon"><i class="ico-bell"></i></span>
        <span class="hasnotification hasnotification-danger"></span>
      </span>
    </a>

    <!-- Dropdown menu -->
    <div class="dropdown-menu" role="menu">
      <div class="dropdown-header">
        <span class="title">Notification <span class="count"></span></span>
        <span class="option text-right"><a href="javascript:void(0);">Clear all</a></span>
      </div>
      <div class="dropdown-body slimscroll">
        <!-- indicator -->
        <div class="indicator inline"><span class="spinner"></span></div>
        <!--/ indicator -->

        <!-- Message list -->
        <div class="media-list">
          <a href="javascript:void(0);" class="media read border-dotted">
            <span class="media-object pull-left">
              <i class="ico-checkmark3 bgcolor-success"></i>
            </span>
            <span class="media-body">
              <span class="media-text">Lorem ipsum dolor sit amet, <span class="text-primary semibold">consectetur</span> adipisicing elit.</span>
              <!-- meta icon -->
              <span class="media-meta pull-right">14w</span>
              <!--/ meta icon -->
            </span>
          </a>
        </div>
        <!--/ Message list -->
      </div>
    </div>
    <!--/ Dropdown menu -->
  </li>
  <!--/ Notification dropdown -->

  <!-- Search form toggler  -->
  <li>
    <a href="javascript:void(0);" data-toggle="dropdown" data-target="#dropdown-form">
      <span class="meta">
        <span class="icon"><i class="ico-search"></i></span>
      </span>
    </a>
  </li>
  <!--/ Search form toggler -->
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
        <span class="avatar"><img src="<?= base_url('assets/image/avatar/avatar7.jpg') ?>" class="img-circle" alt="" /></span>
        <span class="text hidden-xs hidden-sm pl5"><?=$this->session->userdata['USERNAME'];?></span>
        <span class="caret"></span>
      </span>
    </a>
    <ul class="dropdown-menu" role="menu">
      <li><a href="javascript:void(0);"><span class="icon"><i class="ico-user-plus2"></i></span> My Accounts</a></li>

      <li><a href="javascript:void(0);"><span class="icon"><i class="ico-question"></i></span> Help</a></li>
      <li class="divider"></li>
      <li><a href="<?=base_url('index.php/logout');?>"><span class="icon"><i class="ico-exit"></i></span> Sign Out</a></li>
    </ul>
  </li>
  <!-- Profile dropdown -->

  <!-- Offcanvas right This menu will take position at the top of template header (mobile only). Make sure that only #header have the `position: relative`, or it may cause unwanted behavior -->

  <!--/ Offcanvas right -->
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
        <a href="<?= base_url('index.php/admin') ?>">
          <span class="figure"><i class="ico-trophy"></i></span>
          <span class="text">Dashboard</span>
        </a>
      </li>
      <li>
       <a href="javascript:void(0);" data-target="#mpengawas" data-toggle="submenu" data-parent=".topmenu">
        <span class="figure"><i class="ico-clipboard"></i></span>
        <span class="text">Admin Sekolah </span>
        <span class="arrow"></span>
      </a>

      <ul id="mpengawas" class="submenu collapse ">
        <li class="submenu-header ellipsis">Admin Sekolah</li>

        <li >
         <a href="<?= base_url('index.php/adminsekolah/formAdminsekolah');?>">
          <span class="text">Register Admin Sekolah</span>
        </a>
      </li>

      <li >
       <a href="<?= base_url('index.php/adminsekolah/listAdminsekolah');?>" >
        <span class="text">Daftar Admin Sekolah</span>
      </a>
    </li>
  </ul>
</li>

<li>
  <a href="javascript:void(0);" data-target="#mapel" data-toggle="submenu" data-parent=".topmenu">
    <span class="figure"><i class="ico-notebook"></i></span>
    <span class="text">Atribut</span>
    <span class="arrow"></span>
  </a>

  <ul id="mapel" class="submenu collapse ">
    <li class="submenu-header ellipsis">Atribut</li>
    <li >
      <a href="<?=base_url('index.php/admin/daftarmatapelajaran')?>">
        <span class="text">Mata Pelajaran</span>
      </a>
    </li>
    <li >
      <a href="<?=base_url('index.php/admin/daftartingkatpelajaran')?>">
        <span class="text">Tingkat</span>
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
  <a href="<?= base_url('index.php/admin/nilai_tryout');?>" data-toggle="submenu" data-parent=".topmenu">
    <span class="figure"><i class="ico-notebook"></i></span>
    <span class="text">Nilai </span>
    <span class="arrow"></span>
  </a>


</li>






<li>
 <a href="javascript:void(0);" data-target="#sekolah_menu" data-toggle="submenu" data-parent=".topmenu">
  <span class="figure"><i class="ico-clipboard"></i></span>
  <span class="text">Sekolah </span>
  <span class="arrow"></span>
</a>

<ul id="sekolah_menu" class="submenu collapse ">
  <!-- <li class="submenu-header ellipsis">Daftar S</li> -->

  <li >
   <a href="<?= base_url('index.php/sekolah/formsekolah');?>">
    <span class="text">Register Sekolah</span>
  </a>
</li>

<li >
 <a href="<?= base_url('index.php/sekolah/daftarsekolah');?>" >
  <span class="text">Daftar Sekolah</span>
</a>
</li>
</ul>
</li>

<li>
 <a href="javascript:void(0);" data-target="#siswa_menu" data-toggle="submenu" data-parent=".topmenu">
  <span class="figure"><i class="ico-book"></i></span>
  <span class="text">Siswa </span>
  <span class="arrow"></span>
</a>

<ul id="siswa_menu" class="submenu collapse ">
  <!-- <li class="submenu-header ellipsis">Daftar S</li> -->

  <li >
   <a href="<?= base_url('index.php/siswa/daftarsiswa');?>">
    <span class="text">Register Siswa</span>
  </a>
</li>

<li >
 <a href="<?= base_url('index.php/siswa/daftar');?>" >
  <span class="text">Daftar Siswa</span>
</a>
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
<li >
 <a href="<?= base_url('admincabang/laporanpaket');?>">
  <span class="text">Laporan Tryout</span>
</a>
</li>

</ul>
</li>

<li>
  <a href="<?= base_url('index.php/help_admin') ?>">
    <span class="figure"><i class="ico-book3"></i></span>
    <span class="text">User Guide</span>
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
        <h4 class="title semibold">{judul_halaman}</h4>
      </div>
      <div class="page-header-section">
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

<script type="text/javascript">
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

// ####################################################
            //buat load tingkat untuk modal buat soal
            // load tingkat untuk modal bank soal
            function loadTkt() {
             jQuery(document).ready(function () {
              var tingkat_id = {"tingkat_id": $('#stkt').val()};
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
              $('#stkt').change(function () {
               tingkat_id = {"tingkat_id": $('#stkt').val()};
               loadPel($('#stkt').val());
             });
              $('#spel').change(function () {
               pelajaran_id = {"pelajaran_id": $('#spel').val()};
               loadBb($('#spel').val());
             });
              $('#sbab').change(function () {
               loadSubb($('#sbab').val());
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
               $('#spel').html('<option value="">-- Pilih Mata Pelajaran  --</option>');
               $.each(data, function (i, data) {
                $('#spel').append("<option value='" + data.id + "'>" + data.keterangan + "</option>");
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

               $('#sbab').html('<option value="">-- Pilih Bab Pelajaran  --</option>');

               $.each(data, function (i, data) {
                $('#sbab').append("<option value='" + data.id + "'>" + data.judulBab + "</option>");
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
               $('#ssub').html('<option value="">-- Pilih Sub Bab Pelajaran  --</option>');

               $.each(data, function(i, data){
                $('#ssub').append("<option value='"+data.id+"'>"+data.judulSubBab+"</option>");
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
                // event untuk modal filter Gallery
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




// ####################################################

</script>
<!-- Cometchat -->
<link type="text/css" href="/cometchat/cometchatcss.php" rel="stylesheet" charset="utf-8">
<script type="text/javascript" src="/cometchat/cometchatjs.php" charset="utf-8"></script>
<!--/ App and page level script -->
<!--/ END JAVASCRIPT SECTION -->
</body>
<!--/ END Body -->
</html>