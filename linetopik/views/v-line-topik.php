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

<!-- Autocomplate -->
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>
<link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet"></link>
<!-- /Autocomplate -->
<div class="page-title" style="background:#2b3036">

    <div class="grid-row">

        <h1>{judul_header2}</h1>

    </div>

</div>
<!-- CSS TIME LINE -->
 <link rel="stylesheet" href="<?= base_url('assets/css/custom-time-line.css') ?>">
<!--  -->

	   <!-- content -->
    <div class="page-content grid-row" >
        <div class="grid-col-row clear-fix" >
          <div class="grid-col grid-col-3 " >
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
                <!-- Pengecekan jika step line tidak ada -->
                <aside class="widget-categories">
                <?php if ($datline!='' || $datline!=''): ?>
                     <!-- widget Topik -->
                
                    <h2>Topik</h2>
                    <hr class="divider-big" />
                    <ul>
                      <?php   $x=0; ?>
                    <?php foreach ($topik as $rows): ?>
                        <li class="cat-item cat-item-1 current-cat"><a href="#topik<?=$x?>"><?=$rows['namaTopik']?><span></span></a>
                        <?php $x++; ?>
                    <?php endforeach ?>
                    </ul>
                <!--/ widget Topik -->
                <?php endif ?>
                  </aside>
               
      </div>
            <div class="grid-col grid-col-9">
                <main> <?php   $i=0;
                                $noTopik=0; 
                                    $namaTopik=''; ?>
                            <?php foreach ($datline as $key ): ?>
                                
                                <?php if ($namaTopik != $key['namaTopik'] && $i==0): ?>
                <!-- start header line-->
                    <!-- post item -->
                    <div class="blog-post" id="topik<?=$noTopik;?>">
                    <?php $noTopik++; ?>
                        <article>
                        <div class="post-info">
                            
                            <div class="post-info-main">
                                <div class="author-post" >nama Topik:' <?=$key['namaTopik']?> '</div>
                            </div>
                            <div class="comments-post"><i class="fa fa-comment"></i>Line</div>
                        </div>
                         <h3>Deskripsi:' <?=$key['deskripsi']?> '</h3>
                         <!-- Start Time Line -->
                         <h4>Time Line</h4>
                         <hr>
                            <ul class="media-list media-list-feed " >
                <!-- end header line-->
                                <?php elseif($namaTopik != $key['namaTopik']) : ?>
                <!-- END body line -->
                            </ul>
                            <!-- END Tieme line -->
                        </article>
                        <div class="tags-post">
                            <a href="#" rel="tag"><?=$key['tingkat']?></a><!-- 
                         --><a href="#" rel="tag"><?=$key['mapel']?></a>
                            <a href="#" rel="tag"><?=$key['bab']?></a>
                        </div>
                    </div>
                    <!-- / post item -->
                    <hr class="divider-color" />
                <!-- END body line -->
                <!-- start header line-->
                    <!-- post item -->
                    <div class="blog-post" id="topik<?=$noTopik;?>">
                    <?php $noTopik++; ?>
                        <article>
                        <div class="post-info">
                            
                            <div class="post-info-main">
                                <div class="author-post" >nama Topik:' <?=$key['namaTopik']?> '</div>
                            </div>
                            <div class="comments-post"><i class="fa fa-comment"></i>Line</div>
                        </div>
                         <h3>Deskripsi:' <?=$key['deskripsi']?> '</h3>
                         <!-- Start Time Line -->
                         <h4>Time Line</h4>
                         <hr>
                            <ul class="media-list media-list-feed " >
                <!-- end header line-->
                                <?php endif ?>
                                <li for class="media">
                                     <div class="media-object pull-left " >
                                        <i  class="<?=$key['icon']?> " id="ico-<?=$i;?>"></i>
                                    </div>
                                    <div class="media-body">
                                    <!-- Untuk menampung staus step disable or enable -->
                                     <input type="text" id="status-<?=$i;?>" value="<?=$key["status"];?>" hidden="true">
                                     <!-- // Untuk menampung staus step disable or enable  -->
                                        <a  href="<?=$key['link'];?>" class="media-heading" id="font-<?=$i;?>" ><?=$key['namaStep']?></a>
                                    </div>
                                </li> 
                                <!-- </a>       -->
                                 <?php $i++;  ?>
                                <?php  $namaTopik=$key['namaTopik'];  ?>
                                

                                
                            <?php endforeach ?>
                            
                            </ul>
                            <!-- END Tieme line -->
                        <!-- menampung nilai panjang array -->
                      <input id="n" type="text"  value="<?=$i;?>" hidden="true">
                            <?php if ($datline!= array()): ?>
                        </article>
                        <div class="tags-post">
                                <a href="#" rel="tag"><?=$key['tingkat']?></a> 
                                <a href="#" rel="tag"><?=$key['mapel']?></a>
                                <a href="#" rel="tag"><?=$key['bab']?></a>
                          </div>
                          </div>
                    <!-- / post item -->
                    <hr class="divider-color" />
                            <?php else: ?>
                                <div class="container-404">
                                <div class="number">U<span>P</span>S</div>
                                    <p><span>Maaf:(</span><br>Step Line Belum Tersedia.</p>
                                   
                                </div>
                            <?php endif ?>
                        


                </main>
            </div>
          
        </div>
    </div>
    <!-- / content -->
<!-- JQ utuk add css step line -->
<script type="text/javascript">
    $(document).ready(function() { 
        var n = $("#n").val();
        for (i = 0; i < n; i++) {
        var status = $("#status-"+i).val();
        
            if (status=="disable") {
                 $("#ico-"+i).css("background","#b0b0b0");
                 $("#font-"+i).css("color","#b0b0b0");
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


