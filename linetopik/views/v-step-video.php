<?php 
//============================================================+
// File name   : v-step-materi.php
// Begin       : 2017-
// Last Update : 2017-03-15
//
// Description : List pagination siswa
//               Untuk menggantikan v-daftar-siswa yg berupa datatable
//
// Author: MrBebek
//
// (c) Copyright:
//               MrBebek
//               neonjogja.com

//============================================================+

/**
 * @author MrBebek
 * @since  2017-
 */
?>
<!-- Automplate -->
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>
<link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet"></link>
<!-- /Automplate -->
<!-- Custom timeline -->
<link rel="stylesheet" href="<?= base_url('assets/css/custom-time-line.css') ?>">
<!-- /Custom timeline -->
<div class="page-title" style="background:#2b3036">

    <div class="grid-row">

        <h1>{judul_header2}</h1>

    </div>

</div>

			   <!-- content -->
    <div class="page-content grid-row">
        <div class=" grid-col-row clear-fix">
        	<div class="grid-col grid-col-3 sidebar ">
             <!-- Pencarian -->
             <aside class="widget-search">
                <form method="get" class="search-form" action="<?=base_url()?>index.php/linetopik/cariTopik"  accept-charset="utf-8" enctype="multipart/form-data">
                    <label>
                        <span class="screen-reader-text">Search for:</span>
                        <input type="search" class="ui-autocomplete-input" placeholder="Search"  name="keycari" title="Search for:" id="caritopik">
                    </label>
                    <input type="submit" class="search-submit" value="GO">
                </form>
            </aside>
            <!-- /Pencarian -->
               <h2 ><a href="<?=base_url('index.php/linetopik/timeLine/').$topikUUID?>"><?= $datVideo['namaTopik']; ?></a></h2> 
                <hr class="divider-big">
                            <!-- Start Time Line -->
                            <ul class="media-list media-list-feed grid-col-3" >
                            <?php $i=0; ?>
                            <?php foreach ($datline as $key ): ?>
                                <li class="media" id="bg-<?=$i;?>">
                                     <div class="media-object pull-left ">
                                        <a href="<?=$key['link'];?>"  class="<?=$key['icon']?> " id="ico-<?=$i;?>"></a>
                                    </div>
                                    <div class="media-body">
                                    <!-- Untuk menampung staus step disable or enable -->
                                     <input type="text" id="status-<?=$i;?>" value="<?=$key["status"];?>" hidden="true">
                                     <!-- // Untuk menampung staus step disable or enable  -->
                                        <a href="<?=$key['link'];?>" class="media-heading" id="font-<?=$i;?>" ><?=$key['namaStep']?></a>
                                    </div>
                                </li>
                            <?php $i++; ?>
                            <?php endforeach ?>
                            </ul>
                            <!-- menampung nilai panjang array -->
                            <input id="n" type="text"  value="<?=$i;?>" hidden="true">
                            <!-- END Tieme line -->
            </div>
            <div class="grid-col grid-col-9">
                <main>
		 <!-- post item -->
                    <div class="blog-post">
                        <article>
                        <div class="post-info">
							<div class="date-post"><div class="day"><?=$tgl?></div><div class="month"><?=$bulan?></div></div>
							<div class="post-info-main">
								<div class="post"><?=$datVideo['judulVideo']?></div>
							</div>
							<div class="comments-post">Logo</div>
						</div>
                        <?php if ($datVideo['link']=='' || $datVideo['link']==' '): ?>
                            <div class="container-video color-palette bg-color-6alt">
                                <video class="" width="100%" height="100%"  controls>
                              <source src="<?=base_url();?>assets/video/<?=$datVideo['namaFile'];?>" >
                                  Your browser does not support the video tag.
                              </video>
                            </div>
                        <?php endif ?>
                        <?php if ($datVideo['namaFile']=='' || $datVideo['namaFile']==' '): ?>
                            <div class="video-player" style="background:grey;">
                                 <iframe src="<?=$datVideo['link']?>"></iframe> 
                            </div>
                        <?php endif ?>
						



                                

                         

						<h3>Deskripsi</h3>
						<p><?=$datVideo['deskripsiVideo']?></p>
				<div class="tags-post">
                            <a href="#" rel="tag"><?=$tingkat;?></a><!-- 
                         --><a href="#" rel="tag"><?=$mapel;?></a>
                            <a href="#" rel="tag"><?=$bab;?></a>
                            <a href="#" rel="tag">Topik : <?=$topik;?> </a>
                        </div>
						
                           
                        </article>
                        
                    </div>
                    <!-- / post item -->
                    <hr class="divider-color" />
                  

                </main>
            </div>
            
        </div>
    </div>
    <!-- / content -->
<!-- JQ UNTUK RUBAH STYLE CSS STEPLINE BY MrBebek-->
<script type="text/javascript">
    $(document).ready(function() { 
        var n = $("#n").val();
        for (i = 0; i < n; i++) {
        var status = $("#status-"+i).val();
            // cek status disable
        if (status=="disable") {
          // jika status disable
          $("#ico-"+i).css("background","#b0b0b0");
          $("#font-"+i).css("color","#b0b0b0");
        }else if(status =="current"){
          // jika step line yg sedang di buka
          $("#ico-"+i).css("background","#D26161");
          $("#font-"+i).css("color","#D26161");
          $("#bg-"+i).css({ "background-color":"","box-shadow": "inset 0 0 0 1px #E4E4E4,inset 0 1px 6px #E6E6E6"});
        }
           
        }
    });
</script>

<!-- JQ untuk autocomplate search topik -->
<script type="text/javascript">

  $(document).ready(function() { 
    var site = "<?php echo site_url();?>";
    $( "#caritopik" ).autocomplete({
        source:  site+"/linetopik/autocompleteTopik",
        select: function (event, ui) {
                window.location = ui.item.url;
                }
    });

});
</script>