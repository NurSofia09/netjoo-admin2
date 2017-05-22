

<!-- konten -->

<section id="main" role="main">

 <!-- <div class="container-fluid">



  <div class="page-header page-header-block">

   <div class="page-header-section">

    <h4 class="title semibold">Dashboard</h4>

  </div>

</div> -->



<!-- profile -->

<div class="col-xs-12">

  <div class="widget panel">

    <div class="thumbnail">

      <div class="media">

        <div class="indicator"><span class="spinner"></span></div>



        <div class="meta bottom text-center">

         <img class="img-circle img-bordered-teal mb10" src="<?=$photo;?>" alt="" width="120px" height="120px">

         <h4 class="semibold nm" style="color:black"><span class="iconmoon-location-6"><?php echo $data_guru['namaDepan']." ".$data_guru['namaBelakang'] ?></span></h4>

         <!-- <h6 class="nm" style="color:black"><span class="iconmoon-location-6"><?php echo $data_guru['namaMataPelajaran'] ?></span></h6> -->
         <h6 class="nm" style="color:black"><span class="iconmoon-location-6"><?=$keahlian?></span></h6>

         <a href="<?=base_url('index.php/logout') ?>" class="btn btn-primary mt5" >Logout</a>

       </div>

       <img data-toggle="unveil" src="<?php echo base_url( 'assets/image/background/400x250/placeholder.jpg' )?>" alt="Cover" height="30%"/>

     </div>

   </div>



   <!-- meta user -->

   <div class="panel-body">

     <ul class="nav nav-section nav-justified">

       <li>

         <div class="section">

           <p class="nm text-muted">Jumlah Video</p>

           <h4 class="nm"><?php echo $jumlah_video ?></h4>

         </div>

       </li>

       <li>

         <div class="section">

           <p class="nm text-muted">Jumlah Komentar</p>

           <h4 class="nm">10</h4>

         </div>

       </li>

       <li>

         <div class="section">

           <p class="nm text-muted">Rank</p>

           <h4 class="nm">10</h4>

         </div>

       </li>



     </ul>

     <!--/ Nav section -->

   </div>

   <!--/ panel body -->

 </div>

 <!--/ END Widget Panel -->

</div>

<div class="row">

 <div class="col-xs-12">

  <?php if ($videos_uploaded==array()): ?>

  <div class="item panel no-border">

    <div class="panel-body">

      <div class="container">

        <div class="row">

          <div class="col-md-12">

            <h4 class="text-center" style="background:white">Anda Belum Memiliki Video :(</h4>

            <br><a href=""><h3 class="text-center black"><i class="ico ico-upload"></i> Mulai Mengupload</h3></a>

          </div>

        </div>

      </div>

    </div>

  </div>

<?php else :?>

  <div class="page-header-section">

    <h5 class="title semibold">Video Baru Saja Di Upload</h5>

  </div>

  <div class="container-fluid" id="stats""  style="background: white">

   

   <div class="item panel no-border" >

   <?php foreach ( $videos_uploaded as $video ): ?>

    <div class="col-md-4">



    <div class="panel-body">

      <a href=""><h6 class="semibold nm">

      <i class="ico ico-bubble-video-chat"></i><?php echo " ".$video['judulVideo'] ?></h6></a>

      <div class="media">

       <a href=""><img class="unveiled" data-toggle="unveil" src="<?php echo base_url( 'assets/image/video/video.PNG' );?>" data-src="<?php echo base_url( 'assets/image/video/video.PNG' );?>" alt="Photo" height="140px"></a>

     </div>

   </div>

</div>

   <?php endforeach ?>

 </div>



<?php endif ?>

</div>

</div>

</div>

</div>

</section>

<script type="text/javascript">

</script>