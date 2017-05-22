    <div class="page-content grid-row">
        <main>
            <div class="grid-col-row clear-fix">
                <?php foreach ($semuavideo as $semuavideos): ?>
                <div class="grid-col grid-col-3">
                    <!-- course item -->
                    
                    <div class="course-item">
                        <div class="course-hover">
                            <img src="http://placehold.it/370x280" data-at2x="http://placehold.it/370x280" alt>
                            <div class="hover-bg bg-color-3"></div>
                            <a href="<?=base_url('index.php/video/seevideo') ?>/<?=$semuavideos->id ?>">Pelajari</a>
                        </div>
                        <div class="course-name clear-fix">
                            <center><h3 style="text-align:center"><a href="<?=base_url('index.php/video/seevideo') ?>/<?=$semuavideos->id ?>"><?=$semuavideos->judulVideo ?></a></h3></center>
                        </div>
                        <div class="course-date bg-color-3 clear-fix">
                            <div class="day"><i class="fa fa-calendar"></i><?=date('M : Y',strtotime($semuavideos->date_created));?></div>
                            <div class="divider"></div>
                            <div class="description"> <?=substr($semuavideos->deskripsi, 0, 90); ?> <span style="color:black;bold:bolder">Selengkapnya<span></div>
                        </div>
                    </div>
                    
                    <!-- / course item -->
                </div>
                <?php endforeach ?>


            </div>
        </main>
    </div>