<style type="text/css">

  .section {
    padding: 50px 0
  }
  .section:not(:last-child) {
    border-bottom: 1px solid #e5e5e5
  }
  #macy-container::before {
    content: "";
    display: table;
    clear: both
  }
  #macy-container {
    margin-top: 22px
  }
  #macy-container::after {
    content: "";
    display: table;
    clear: both
  }
  .demo {
    margin-bottom: 24px;
    border-radius: 4px;
    overflow: hidden;
    border: 1px solid #eee;
    padding:5px;
  }
  .demo-image {
    width: 100%;
    display: block;
    height: auto
  }
  .feature-list {
    margin-bottom: 0;
    margin-left: 0;
    width: 100%;
    list-style: none
  }
  .feature-list li {
    display: inline-block;
    width: 25%;
    text-align: center
  }
  .feature-list li::before {
    color: inherit;
    content: "•";
    color: #54b9cb;
    margin-right: 7px
  }
  .btn {
    background-color: white;
    line-height: 53px;
    padding: 0 18px 0 0;
    display: inline-block;
    text-decoration: none;
    color: #fff;
    border-radius: 4px;
    border-color: #1D4B66; 
    transition: all .25s ease-in-out;
    font-size: 18px
  }
  .btn:hover {
    background-color: #4CA8B9
  }
  .btn:active {
    background-color: black;
    color: black;
  }
  .btn.has-icon::before {
    margin-right: 18px;
    padding: 0 18px;
    border-right: 1px solid #4daabb;
    line-height: 53px
  }

</style>
<form>
  <input type="hidden" name="tingkat" value="{alias_tingkat}">
  <input type="hidden" name="pelajaran" value="{alias_pelajaran}">
</form>
<div class="page-content grid-row">

  <div class="row">
    <div class="col-md-6">
     <h5>Type : <div class="btn-group" data-toggle="buttons" > 

       <label class="btn active cws-button  btn-primary  small" onclick="semua()"> 
        <input type="radio" name="options"  autocomplete="off" checked="true" title="Tampilkan Semua Jenis Video"> All
      </label>

      <label class="btn cws-button  btn-primary  small" title="Tampilkan Jenis Video Room" onclick="justroom()"> 
        <input type="radio" name="options" autocomplete="off"> Room
      </label> 

      <label class="btn cws-button  btn-primary   small"  title="Tampilkan Jenis Video Screen" onclick="justscreen()"> 
        <input type="radio" name="options" autocomplete="off"> Screen
      </label> 

    </div></h5>

  </div>
  <div class="col-md-6">
   <h5>Video : <div class="btn-group" data-toggle="buttons" > 

     <label class="btn cws-button  active btn-primary  small" id="in-soal"> 
      <input type="radio" name="options"  autocomplete="off" checked="true"> By Video
    </label> 

    <label class="btn cws-button  btn-primary  small" id="pr-rumus" onclick="direct()"> 
      <input type="radio" name="options"   autocomplete="off"> By Sub Bab
    </label> 

  </div></h5>

</div>

</div>

<br>

<hr class="divider-color">

<main>
  <section class="section">
    <!-- Start Div container -->
    <div class="container">

      <!-- Start div macy-container -->
      <div id="macy-container">

        <?php $i=0;   $cekjudulbab=null;?>
        <?php foreach ($bab_video as $bab_video_items) {
          $judulbab=$bab_video_items->judulBab;
          $subbab=$bab_video_items->judulSubBab;

          if ($cekjudulbab != $judulbab) { 
            if($i=='1'){
              // END div demo
              ?></div> <?php
            } ?>
            <!-- Start div demo -->
            <div class="demo" style="list-style: none;">

              
                 
                    <strong><?=$judulbab ?></strong><br>
  
              <?php if ($bab_video_items->jenis_video == 1): ?>
                <li class="room"><a href="<?=base_url('video/videosub/');?><?=$bab_video_items->subbabID;?>#ini"><?php echo $bab_video_items->judulVideo ;?>(S)</a></li>
              <?php else: ?>
                <li class="screen"><a href="<?=base_url('video/videosub/')?><?=$bab_video_items->subbabID?>#ini" ><?php echo $bab_video_items->judulVideo ;?>(R)</a></li>
              <?php endif ?>


              <?php }else{ ?>
              <?php if ($bab_video_items->jenis_video == 1): ?>
                <li class="room"><a href="<?=base_url('video/videosub/')?><?=$bab_video_items->subbabID?>#ini"><?php echo $bab_video_items->judulVideo ;?>(S)</a></li>
              <?php else: ?>
                <li class="screen"><a href="<?=base_url('video/videosub/')?><?=$bab_video_items->subbabID?>#ini" ><?php echo $bab_video_items->judulVideo ;?>(R)</a></li>
                <?php endif ?>
                <?php } ?>
                <?php   $cekjudulbab=$judulbab;
                $i='1'; ?>
                <?php } ?>
              </div>
              <!-- END DIV DEMO -->
            </div>
            <!-- END div macy-container -->
          </div>
          <!-- END Div container -->
        </section>
      </main>
    </div>

    <!-- ucapan selamat datang -->
   <!--  <main>
      <div class="page-content grid-row">
        <div class="porfolio-item">
          <div class="col-md-2"><img src="<?=base_url('assets/back/img/logo.png')?>"  width="200px" data-at2x="<?=base_url('assets/back/img/logo@2x.png')?>" alt></div>
          <div class="col-md-10">
            <h4>Selamat Datang Di Neon!</h4>
            <p>Sudah siap memulai belajar dengan cara asyik dan santai? mulailah dengan memilih mata pelajaran yang sesuai dengan tingkatanmu.</p>
          </div>
          <br><br>
          <br><br>
        </div>
      </div>
    </main> -->

    <!-- ucapan selamat datang -->
    <script src="http://macyjs.com/assets/js/macy.min.js"></script>
    <script type="text/javascript">
      function direct(){
        var tingkat = $("input[name='tingkat']").val();
        var aliasMapel = $("input[name='pelajaran']").val();
        window.location = base_url+"video/daftarvideo/"+<?=$this->uri->segment(3) ?>;
      }

      function justroom(){
        $('.screen').hide("slow");
        $('.room').show("slow");
      }

      function justscreen(){
        $('.screen').show("slow");
        $('.room').hide("slow");
      }

      function semua(){
        $('.screen').show("slow");
        $('.room').show("slow");
      }

      $(document).ready(function(){
        Macy.init({
          container: '#macy-container',
          trueOrder: false,
          waitForImages: false,
          margin: 24,
          columns: 3,
          breakAt: {
            1200: 5,
            940: 3,
            520: 2,
            400: 1
          }
        });
      });
    </script>




