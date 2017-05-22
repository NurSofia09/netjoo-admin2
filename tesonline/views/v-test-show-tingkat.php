    <div class="page-content grid-row">

        <main>

            <div class="grid-col-row clear-fix">

            <div class="row">

                    <div class="container"><h1 class="text-center">Silahkan pilih tingkat untuk melakukan latihan online!</h1><br></div>

                </div>

                <?php $no=[1,4,5] ;$namaFile=""?>

                <?php $i=0; ?>


                <?php foreach ($tingkat as $tingkatitem): ?>

                <?php $namaFile = strtolower(str_replace(" ", "-", $tingkatitem['aliasTingkat'])) ?>

                <?php $no[$i] ?>

                <div class="grid-col grid-col-4">

                    <div class="course-item">

                        <div class="course-hover">

                            <img src="<?=base_url('assets/back/img/illustrasi/') ?><?=$namaFile ?>.png" data-at2x="<?=base_url('assets/back/img/illustrasi/') ?><?=$namaFile ?>.png" alt>

                            <div class="hover-bg bg-color<?=$no[$i]?>"></div>

                            <?php $id = $tingkatitem['id'] ?>

                            <a href="<?=base_url()?>index.php/tesonline/pilihmapel/<?=$id ?>">Lihat Mata Pelajaran</a>

                        </div>

                        <div class="course-name clear-fix">

                            <center><h3 style="text-align:center"><a href=""></a></h3></center>

                        </div>

                        <div class="course-date bg-color-<?=$no[$i]?> clear-fix">

                            <div class="description"><?=$tingkatitem['namaTingkat'] ?><br></div>

                            <div class="divider"></div>

                        </div>

                    </div>

                </div>

                <?php $i = $i+1; ?>

                <?php endforeach ?>


                <!-- <div class="grid-col col-md-12">
                    <div class="hover-effect"></div>
                    <h3 class="center"><strong>Latihan Online Sedang dipersiapkan</strong></h3>              
                </div> -->


            </div>

        </main>

        <br>

        <hr class="divider-color">

    </div>