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
    Hi, <?=$this->session->userdata('USERNAME') ?> ! Dibawah ini adalah pesan. Tetap semangat!<br><br>
    
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
                  <div class="day"><?=$key['isi']?></div>
                  <div class="bar">
                    <span class="bg-color-4 skill-bar-progress" processed="true" style="width: 100%;"></span>
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


