<div class="page-content grid-row">

  <div class="row">
    <h1>{judul_header}</h1>
  </div>
  <hr class="divider-color">

<main>
      <?php
      $cekjudulbab=null;
      $i='0'; 
      ?>
      <!-- Awal 1 -->
      <div class="grid-col-row clear-fix" >
        <div class="grid-col grid-col-3">
          <div class="hover-effect"></div>        
          <!-- Awal 1 -->
          <?php foreach ($bab_video as $bab_video_items) {
            $judulbab=$bab_video_items->judulBab;
            $subbab=$bab_video_items->judulSubBab;
            if ($cekjudulbab != $judulbab) { 
              if($i=='1'){?>
              </ol>
            </div>
            <!--Akhir 1-->



            <!-- Awal 2 -->
            <div class="grid-col-row clear-fix" >
              <div class="grid-col grid-col-3">
                <div class="hover-effect"></div>
                <!-- Awal 2 -->
                <?php
              }
              ?>

              <h4><strong><?php echo $judulbab ;?><br></strong></h4>
              <ol>
                <li><a href="<?=base_url('video/videosub/')?><?=$bab_video_items->subbabID?>"><?php echo $subbab ;?></a></li>
                <?php        
              }else{
               ?>
               <li><a href="<?=base_url('video/videosub/')?><?=$bab_video_items->subbabID?>"><?php echo $subbab ;?></a></li>
               <?php
             }
             $cekjudulbab=$judulbab;
             $i='1';
             ?>
             <?php } 
             ?>
             <!-- Ahir 2 -->
           </ol>
         </div>
         <!-- Akhir 2 -->
         <!-- END TAMPIL DAFTAR -->
       </main>
  <hr class="divider-big">

</div>



  <script type="text/javascript">
    function direct(){
      var tingkat = $("input[name='tingkat']").val();
      var aliasMapel = $("input[name='pelajaran']").val();
      window.location = base_url+"video/daftarallvideo/"+<?=$this->uri->segment(3) ?>;
    }

  </script>