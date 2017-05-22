<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>
<link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet"></link>

<section id="main" role="main">
  <!-- START Template Container -->
  <div class="container-fluid">
    <div class="col-md-12">
      <!-- section header -->
                     <!--    <div class="section-header mb15">
                            <h5 class="semibold">Justified Tabs</h5>
                          </div> -->
                          <!--/ section header -->
                          <!-- tab -->
                          <ul class="nav nav-tabs ">
                            <li class="active"><a href="#tabone2" data-toggle="tab">Semua Pertanyaan</a></li>
                            <!-- <li><a href="#tabtwo2" data-toggle="tab">Pertanyaan Setingkat</a></li> -->
                            <li><a href="#tabthree2" data-toggle="tab">Pertanyaan Saya</a></li>
                          </ul>
                          <!--/ tab -->
                          <!-- tab content -->
                          <div class="tab-content panel bacgraound">
                            <div class="tab-pane active" id="tabone2">
                              <!-- Start Pencarian tab 3 -->
                              <form action="" role="search">
                               <div class="has-icon">
                                <input type="text" class="form-control" placeholder="Search Pertanyaan..." name="cari_semua">
                                <i class="ico-search form-control-icon"></i>
                              </div>
                            </form>
                            <hr>
                            <!-- END Pencarian tab3 -->
                            <!-- Start data pertanyaan guru-->
                            <div class='main_div'>

                              <input type="text" id="cekload-all" value="<?=$cekloadAll?>" hidden="true">
                              <ul class="load_content" id="load_more_ctnt">

                               <?php foreach ($questions as $row):

                               $id=$row['pertanyaanID'];

                               $message=$row['isiPertanyaan'];
                               ?>
                               <div class="media-list">
                                 <a href="<?=base_url('konsulback/konsultasi/') ?><?=$row['pertanyaanID'] ?>" class="media border-dotted">
                                  <span class="pull-left">
                                    <img src="<?=base_url("assets/image/photo/siswa/".$row['photo'])?>" class="img-circle" width="65px" height="65px" alt="">
                                  </span>
                                  <span class="media-body">
                                    <span class="media-heading"><?=$row['namaDepan']." ".$row['namaBelakang'] ?></span>
                                    <span class="media-text ellipsis nm"><?=$row['isiPertanyaan'] ?></span>
                                    <!-- meta icon -->
                                    <span class="label label-primary"><i class=" ico-book3"></i><?=$row['judulSubBab'] ?></span>
                                    <span class="label label-success"><i class="ico-bubble2"></i><?=$row['jumlah'] ?></span>
                                    <span></span>
                                    <!--/ meta icon -->
                                  </span>
                                  <span class="pull-right">(<?=$row['date_created'] ?>)</span>
                                </a>
                              </div>
                            <?php endforeach ?>
                          </ul>
                          <div class="more_div">
                            <a href="#">
                              <div id="load_more_<?php echo $id; ?>" class="more_tab">
                                <div class="more_button more-all" id="<?php echo $id; ?>">Load More 
                                </div>
                              </a>
                            </div>
                          </div>
                        </div>
                        <!-- End data oertanyaan guru -->
                      </div>
                      <!-- Tab Semua Konsultasi -->
                      <!-- <div class="tab-pane" id="tabtwo2"> -->
                      <!-- Start Pencarian tab 3 -->
                        <!--     <form action="" role="search">
                               <div class="has-icon">
                                <input type="text" class="form-control" placeholder="Search Pertanyaan...">
                                <i class="ico-search form-control-icon"></i>
                              </div>
                            </form> -->
                            <!-- END Pencarian tab3 -->

                            <!-- </div> -->
                            <div class="tab-pane" id="tabthree2">

                             <!-- Start Koneten -->
                             <!-- Start Pencarian tab 3 -->
                             <form action="" role="search">
                               <div class="has-icon">
                                <input type="text" class="form-control" placeholder="Search Pertanyaan..." name="cari_tingkat">
                                <i class="ico-search form-control-icon"></i>
                              </div>
                            </form>
                            <!-- END Pencarian tab3 -->

                            <hr>
                            <!--  -->
                            <!--Start data Semau  pertanyaan -->
                            <div class='main_div'>
                            <input type="text" id="cekload-mapel" value="<?=$cekloadMaple?>" hidden="true">
                              <ul class="load_content" id="load_more_ctnt1">

                               <?php foreach ($my_questions as $value):

                               $id1=$value['pertanyaanID'];

                               $message1=$value['isiPertanyaan'];
                               ?>
                               <div class="media-list">
                                 <a href="<?=base_url('konsulback/konsultasi/') ?><?=$value['pertanyaanID'] ?>" class="media border-dotted">
                                  <span class="pull-left">
                                    <img src="<?=base_url("assets/image/photo/siswa/".$value['photo'])?>" class="img-circle" width="65px" height="65px" alt="">
                                  </span>
                                  <span class="media-body">
                                    <span class="media-heading"><?=$value['namaDepan']." ".$value['namaBelakang'] ?></span>
                                    <span class="media-text ellipsis nm"><?=$value['isiPertanyaan'] ?></span>
                                    <!-- meta icon -->
                                    <span class="label label-primary"><i class=" ico-book3"></i><?=$value['judulSubBab'] ?></span>
                                    <span class="label label-success"><i class="ico-bubble2"></i><?=$value['jumlah'] ?></span>
                                    <span></span>
                                    <!--/ meta icon -->
                                  </span>
                                  <span class="pull-right">(<?=$value['date_created'] ?>)</span>
                                </a>
                              </div>
                            <?php endforeach ?>
                          </ul>
                          <div class="more_div">
                            <a href="#">
                              <div id="load_more1_<?php echo $id1; ?>" class="more_tab">
                                <div class="more_button1 more-mapel" id="<?php echo $id1; ?>">Load More Pertanyaan Saya
                                </div>
                              </a>
                            </div>
                          </div>
                        </div>
                        <!--END data Semau  pertanyaan -->

                        <!--  -->
                        <!-- End Konten -->
                      </div>
                    </div>
                    <!--/ tab content -->
                  </div>
                </div>
              </section>

              <script type="text/javascript">
                $(document).ready(function(){
                  // Start cek load more all pertanyaan 
                  var cekloadAll = $('#cekload-all').val();
                  if (cekloadAll == 'false') {
                    $('.more-all').hide();
                  } 
                  // END cek load more all pertanyaan

                  // Start cek load more maple pertanyaan 
                   var cekloadMaple = $('#cekload-mapel').val();
                  if (cekloadMaple == 'false') {
                    $('.more-mapel').hide();
                  } 
                  // END cek load mmore mapel pertanyaan  

                });

                /*FUNGSI LOAD MORE*/
                $(function() {
                  $('.more_button').live("click",function() 
                  {
                    var url = base_url+"index.php/konsulback/moreallsoal";
                    var getId = $(this).attr("id");
                    if(getId)
                    {
                      $("#load_more_"+getId).html('<img src="load_img.gif" style="padding:10px 0 0 100px;"/>');  
                      $.ajax({
                        type: "POST",
                        url: url,
                        data: "getLastContentId="+ getId, 
                        cache: false,
                        success: function(html){
                          $("ul#load_more_ctnt").append(html);
                          $("#load_more_"+getId).remove();
                        }
                      });
                    }
                    else
                    {
                      $(".more_tab").html('The End');
                    }
                    return false;
                  });
                    // load more pertanyaan berdasarkan keahlian guru
                    $('.more_button1').live("click",function() 
                    {
                      var url = base_url+"index.php/konsulback/moremapelsoal";
                      var getId = $(this).attr("id");
                      if(getId)
                      {
                        $("#load_more_"+getId).html('<img src="load_img.gif" style="padding:10px 0 0 100px;"/>');  
                        $.ajax({
                          type: "POST",
                          url: url,
                          data: "getLastContentId="+ getId, 
                          cache: false,
                          success: function(html){
                            $("ul#load_more_ctnt1").append(html);
                            $("#load_more1_"+getId).remove();
                          }
                        });
                      }
                      else
                      {
                        $(".more_tab").html('The End');
                      }
                      return false;
                    });
                  });
                /*# # FUNGSI LOAD MORE*/

                /* FUNGSI SEARCH*/
                $('input[name=cari_semua]').autocomplete({
                  source:  base_url +"konsultasi/search_all",
                  select: function (event, ui) {
                    window.location = ui.item.url;
                  }
                });

                $('input[name=cari_tingkat]').autocomplete({
                  source: base_url +"konsultasi/search_tingkat",
                  select: function (event, ui) {
                    window.location = ui.item.url;
                  }
                });
                /*# # FUNGSI SEARCH*/


              </script>