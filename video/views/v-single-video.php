
<section class="section bgcolor-white">

    <div class="container">

        <div class="row">

            <div class="col-md-9 mb15">

                <article class="panel panel-minimal overflow-hidden">

                    <section class="panel-body pl0 pr0">

                        <div class="row">

                            <div class="col-xs-9 col-sm-11 col-md-11">

                                <!-- heading -->

                                <h3 class="font-alt ellipsis mt0"><a href="javascript:void(0);" class="text-default"></a></h3>

                                <!--/ heading -->

                                <!-- meta -->

                                <p class="meta">

                                    <span class="text-muted mr5 ml5">&#8226;</span>

                                    <span class=""><a href="<?=base_url('index.php/video/videobysub') ?>/<?=$video->subBabID ?>"><i class="ico ico-facetime-video"></i> Semua Video </a></span>

                                    <span class="text-muted mr5 ml5">&#8226;</span>

                                    <a href="javascript:void(0);">6 tanggapan</a><!-- comments -->

                                    <span class="text-muted mr5 ml5">&#8226;</span>

                                    <span class="text-muted">Kategori </span><a href="javascript:void(0);"><?=$videoData->namaMataPelajaran ?></a><!-- category -->

                                    <span class="text-muted mr5 ml5">&#8226;</span>

                                    <span class="text-muted">Dibuat Oleh </span><a href="javascript:void(0);"><?=htmlspecialchars($penulis['namaDepan']." ".$penulis['namaBelakang']) ?></a><!-- author -->

                                    <hr>

                                </p>

                                <!--/ meta -->

                                <!-- video -->

                                <div class="container" style="witdh:100%;height:420px">

                                    <div class="media">

                                    <video preload controls src="<?=base_url('assets/video/');?><?=$video->namaFile ?>"></video>

                                </div>

                                

                            </div>

                            <!-- video -->

                            <!-- text -->

                            <div class="text-default">

                                <p><?=$video->deskripsi ?></p>

                            </div>

                            <!--/ text -->

                        </div>

                        <!--/ post content -->

                    </div>

                </section>

                <!--/ Content -->

                <!-- Author bio -->

                <section class="panel-body">

                    <!-- Header -->

                    <div class="section-header section-header-bordered mb15">

                        <h4 class="section-title">

                        <p class="font-alt nm">Mengenai Pembuat Video</p>

                        </h4>

                    </div>

                    <!--/ Header -->

                    <div class="well mb0">

                        <ul class="list-table">

                            <li style="width:80px;">

                                <img class="img-circle" src="<?=base_url('assets/image/avatar/avatar4.jpg');?>" alt="" width="70px" height="70px">

                            </li>

                            <li class="text-left">

                                <h5 class="semibold mt0 text-accent"><?=htmlspecialchars($penulis['namaDepan']." ".$penulis['namaBelakang']) ?></h5>

                                <p><?=htmlspecialchars($penulis['biografi']) ?></p>

                            </li>

                        </ul>

                    </div>

                </section>

                <!--/ Author bio -->

                <!-- Comments -->

                <section class="panel-body">

                    <!-- Header -->

                    <div class="section-header section-header-bordered mb15">

                        <h4 class="section-title">

                        <p class="font-alt nm">Tanggapan (1)</p>

                        </h4>

                    </div>

                    <!--/ Header -->

                    <div class="media-list media-list-bubble">

                        <?php foreach ($komen as $komenItem): ?>

                        <div class="media">

                            <a href="javascript:void(0);" class="media-object pull-left">

                                <img src="<?=base_url('assets/image/avatar/avatar1.jpg');?>" class="img-circle" alt="">

                            </a>

                            <div class="media-body">

                                <div class="media-text">

                                    <h5 class="semibold mt0 mb5 text-default"><?=htmlspecialchars($komenItem->namaPengguna) ?></h5>

                                    <p class="mb5"><?=htmlspecialchars($komenItem->isiKomen) ?></p>

                                    <!-- meta icon -->

                                    <p class="mb0">

                                        <span class="media-meta"><?=htmlspecialchars($komenItem->timestampe) ?></span>

                                        <span class="mr5 ml5 text-muted">&#8226;</span>

                                    </p>

                                    <!--/ meta icon -->

                                </div>

                            </div>

                        </div>

                        <?php endforeach ?>

                    </section>

                    <!-- Comments -->

                    <!-- Post Comments -->

                    <section class="panel-footer pb0">

                        <!-- Header -->

                        <div class="section-header section-header-bordered mb15">

                            <h4 class="section-title">

                            <p class="font-alt nm">Kirim tanggapan anda mengenai video ini</p>

                            </h4>

                        </div>

                        <!--/ Header -->

                        <!-- Login message -->

                        <!-- <div class="well text-center nm">

                            <h4 class="mt0 mb10">Login to post comment</h4>

                            <p class="text-muted mb15">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod

                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,

                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo

                            consequat.</p>

                            <a href="javascript:void(0);" class="btn btn-primary">Login Now</a>

                            <a href="javascript:void(0);" class="btn btn-link">Don't have an accound? register here.</a>

                        </div> -->

                        <!-- Login message -->

                        <form class="form-horizontal"  action="<?=base_url()?>index.php/video/comment" method="post">

                            <div class="form-group message-container">

                                <div class="alert alert-info">

                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                                    <h4 class="mt0 mb5 semibold">Info</h4>

                                    <p class="nm">Dimohon untuk tidak melakukan spam.</p>

                                </div>

                            </div>

                            <div class="form-group" >

                                <label class="col-sm-3 control-label">Tanggapan</label>

                                <div class="col-sm-9">

                                    <input type="text" name="idvideo" value="<?=$idvideo;?>" hidden="true" />

                                    <textarea class="form-control" rows="6" name="comment"><?=$idvideo;?></textarea>

                                </div>

                            </div>

                            <div class="form-group">

                                <div class="col-sm-3">

                                    <button type="reset" class="btn btn-default">Reset</button>

                                    <button type="submit" class="btn btn-success ladda-button" data-style="expand-right"><span class="ladda-label">Submit</span></button>

                                </div>

                            </div>

                        </form>

                    </section>

                    <!--/ Post Comments -->

                </article>

                <!--/ Blog post #1 -->

            </div>

            <!--/ END Left Section -->

            <!-- START Right Section -->

            <div class="col-md-3">

                <!-- Category -->

                <div class="mb15">

                    <!-- Header -->

                    <div class="section-header section-header-bordered mb10 mt15">

                        <h4 class="section-title">

                        <p class="font-alt nm">Semua Video</p>

                        </h4>

                    </div>

                    <!--/ Header -->

                    <ol class="list-unstyled">

                        <?php foreach($videobysub as $sub_bab_items): ?>

                        <li class="mb5"><a href="<?=base_url('index.php/video/seevideo/') ?><?=$sub_bab_items->id?>"><?=$sub_bab_items->judulVideo ?></a></li>

                        <?php endforeach?>

                    </ol>

                </div>

            </div>

            <!--/ Blog Post -->

        </div>

        <!--/ END Right Section -->

    </div>

    <!--/ END Row -->

</div>

</section>

<!--/ END Blog Content