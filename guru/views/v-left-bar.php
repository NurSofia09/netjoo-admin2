<!-- header -->
<header id="header" class="navbar navbar-fixed-top">
    <div class="navbar-header">
        <a class="navbar-brand" href="javascript:void(0);">
            <span class="logo-figure"></span>
            <span class="logo-text"></span>
        </a>
    </div>
</header>

<!-- menu kiri -->
<aside class="sidebar sidebar-left sidebar-menu">     
 <section class="content slimscroll">
 <h5 class="heading">Main Menu</h5>

 <ul class="topmenu topmenu-responsive" data-toggle="menu">
  <li >
   <a href="<?=base_url('index.php/guru/dashboard') ?>" data-toggle="submenu" data-target="#chart" data-parent=".topmenu">
       <span class="figure"><i class="ico-home"></i></span>
       <span class="text">Dashboard</span>
   </a>
   <a href="<?=base_url('index.php/videoBack/managervideo') ?>" data-toggle="submenu" data-target="#chart" data-parent=".topmenu">
       <span class="figure"><i class="ico-folder"></i></span>
       <span class="text">Pengelolaan Video</span>
   </a>
   <a href="<?=base_url('index.php/videoBack/formupvideo') ?>" data-toggle="submenu" data-target="#chart" data-parent=".topmenu">
       <span class="figure"><i class="ico-file-upload"></i></span>
       <span class="text">Upload Video</span>
   </a>
    <a href="<?=base_url('index.php/guru/pengaturanProfileGuru') ?>" data-toggle="submenu" data-target="#chart" data-parent=".topmenu">
       <span class="figure"><i class="ico-file-upload"></i></span>
       <span class="text">Pengaturan Profile</span>
   </a>


  </li>
 </ul>
 </section>
</aside>