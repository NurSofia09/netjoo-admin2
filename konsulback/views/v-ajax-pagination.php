        <section id="main" role="main" >
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
                            <li class="active"><a href="#tabmyask" data-toggle="tab">Pertanyaan Saya</a></li>
                            <li><a href="#taballask" data-toggle="tab">Semua Pertanyaan</a></li>
                          </ul>
                          <!--/ tab -->
                          <!-- tab content -->
                          <div class="tab-content panel" id="relodeask" >
                            <!-- Start Tab one -->
                           
                              <?php
                              foreach ($myasks as $myask) {
                                include $myask;
                              }?>
                            
                          <!-- End Tab One -->
                          <!-- Start Tab 2 -->

                            
                              <?php
                              foreach ($allasks as $allask) {
                                include $allask;
                              }
                              ?>
                              
                          <!-- End Tab 2 -->
                        </div>
                        <!--/ tab content -->
                      </div>
                    </div>
                  </section>
                  <!-- Include all compiled plugins (below), or include individual files as needed -->
                  <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
                  <script>
                  // mykonsul
                  $("body").on("click", ".mykonsul a", function() {
                     var url = $(this).attr('href');
                     $("#relodeask").load(url);
                     return false;
                   });
                   $("body").on("click", ".semuakonsul a", function() {
                     var url = $(this).attr('href');
                     $("#relodeask").load(url);
                     return false;
                   });
                   
                 </script>