<section role="main" style="padding-top:10px;background:white" >
            <!-- START Portfolio Content -->
            <section class="section bgcolor-white pt0">
                <div class="container">
                    <!-- START row -->
                    <div class="row" id="shuffle-grid">
                    	<?php for($i=1;$i<=8;$i++): ?>
                        <div class="col-sm-3 shuffle mb15" data-groups='["creative", "people"]'>
                            <!-- thumbnail -->
                            <div class="thumbnail nm">
                                <!-- media -->
                                <div class="media">
                                    <!-- indicator -->
                                    <div class="indicator"><span class="spinner"></span></div>
                                    <!--/ indicator -->
                                    <!-- toolbar overlay -->
                                    <div class="overlay">
                                        <div class="toolbar">
                                            <a href="<?=base_url('assets/image/portfolio/placeholder-grey.jpg');?>" class="btn btn-default magnific" title="Happy kid playing with toy"><i class="ico-play"></i></a>
                                        </div>
                                    </div>
                                    <!--/ toolbar overlay -->
                                    <img data-toggle="unveil" src="<?=base_url('assets/image/portfolio/placeholder-grey.jpg');?>" data-src="<?=base_url('assets/image/portfolio/placeholder-grey.jpg');?>" alt="Photo" width="100%" />
                                </div>
                                <!--/ media -->
                            </div>
                            <!--/ thumbnail -->
                            <!-- Meta -->
                            <h4 class="font-alt ellipsis text-center mb10">Judul Video</h4>
                            
                            <!--/ Meta -->
                        </div>
                        <?php endfor ?>
                    </div>

                    <!--/ END row -->
                </div>
            </section>
            <!--/ END Portfolio Content -->

            <!-- START Featured Portfolio -->
            <section class="section">
                <div class="container">
                    <!-- Header -->
                    <div class="section-header section-header-bordered mb15">
                        <h4 class="section-title">
                            <p class="font-alt nm">Video Terfavorit</p>
                        </h4>
                    </div>
                    <!--/ Header -->

                    <!-- carousel -->
                    <div class="owl-carousel" id="lovely-client">
                    	<?php for($i=1;$i<=5;$i++): ?>
                        <!-- portfolio #1 -->
                        <div class="item text-center">
                            <!-- thumbnail -->
                            <div class="thumbnail nm">
                                <!-- media -->
                                <div class="media">
                                    <!-- indicator -->
                                    <div class="indicator"><span class="spinner"></span></div>
                                    <!--/ indicator -->
                                    <!-- toolbar overlay -->
                                    <div class="overlay">
                                        <div class="toolbar">
                                            <a href="#" class="btn btn-success"><i class="ico-play"></i></a>
                                        </div>
                                    </div>
                                    <!--/ toolbar overlay -->
                                    <img data-toggle="unveil" src="<?=base_url('assets/image/portfolio/placeholder-grey.jpg');?>" data-src="<?=base_url('assets/image/portfolio/placeholder-grey.jpg');?>" alt="Photo" width="100%" />
                                </div>
                                <!--/ media -->
                            </div>
                            <!--/ thumbnail -->
                            <!-- Meta -->
                            <h5 class="font-alt text-center mb5">Judul Video <?=$i ?></h5>
                            <!--/ Meta -->
                        </div>
                        <?php endfor ?>
                        <!--/ portfolio #1 -->
                    </div>
                    <!--/ carousel -->
                    

                </div>
            </section>
            <!--/ END Featured Portfolio -->

            <!-- START To Top Scroller -->
            <a href="#" class="totop animation" data-toggle="waypoints totop" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="50%"><i class="ico-angle-up"></i></a>
            <!--/ END To Top Scroller -->
        </section>