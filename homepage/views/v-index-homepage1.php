<!DOCTYPE HTML>

<html>

    <head>

        <title>{judul_halaman}</title>

        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

        <!-- style -->

        <link rel="shortcut icon" href="<?= base_url('assets/back/img/favicon.png') ?>">

        <link rel="stylesheet" href="<?= base_url('assets/back/css/font-awesome.css') ?>">

        <link rel="stylesheet" href="<?= base_url('assets/back/fi/flaticon.css') ?>">

        <link rel="stylesheet" href="<?= base_url('assets/back/css/main.css') ?>">

        <link rel="stylesheet" type="text/css" href="<?= base_url('assets/back/tuner/css/colorpicker.css') ?>" />

        <link rel="stylesheet" type="text/css" href="<?= base_url('assets/back/tuner/css/styles.css') ?>" />

        <link rel="stylesheet" type="text/css" href="<?= base_url('assets/back/css/jquery.fancybox.css') ?>" />

        <link rel="stylesheet" href="<?= base_url('assets/back/css/owl.carousel.css') ?>"/>

        <link rel="stylesheet" type="text/css" href="<?= base_url('assets/back/rs-plugin/css/settings.css') ?>" media="screen">

        <link rel="stylesheet" href="<?= base_url('assets/back/css/animate.css') ?>">

 <script type="text/javascript" src="<?= base_url('assets/library/jquery/js/jquery.min.js') ?>"></script>


        <!--styles -->

    </head>

    <body>

        <?php include 'v-header.php' ?>

        <?php include 'v-revolution-slidder.php' ?>




        <hr class="divider-color">

        <!-- content -->

        <div id="home" class="page-content padding-none">

            <?php include 'v-last-courses.php'; ?>

            <hr class="divider-color" id="service" />

            <!-- section -->

            <section class="fullwidth-background padding-section" >

                <div class="grid-row clear-fix">

                    <div class="grid-col-row">

                        <div class="grid-col grid-col-6">

                            <a onclick="changekonten('Konsultasi')" title="Konsultasi" class="service-icon"><i class="flaticon-speech"></i></a>

                            <a onclick="changekonten('VideoBelajar')" title="Video Belajar" class="service-icon"><i class="fa fa-caret-square-o-right"></i></a>

                            <a onclick="changekonten('Tryout')" title="Tryout" class="service-icon"><i class="flaticon-pencil"></i></a>

                            <a onclick="changekonten('latihan')" title="Latihan" class="service-icon"><i class="fa fa-book"></i></a>

                            <a onclick="changekonten('edudrive')" title="Edu Drive" class="service-icon"><i class="fa fa-book"></i></a>

                            <a onclick="changekonten('toflfokus')" title="Tofl Fokus" class="service-icon"><i class="fa fa-book"></i></a>

                            <a onclick="changekonten('penjurusan')" title="Penjurusan" class="service-icon"><i class="fa fa-graduation-cap"></i></a>

                            <a onclick="changekonten('raportonline')" title="Raport Online" class="service-icon"><i class="fa fa-book"></i></a>





                        </div>
                        <div></div>
                        <div class="grid-col grid-col-6 clear-fix konten" >

                            <h2>Layanan Kita</h2>

                            <p>Silahkan klik icon yang tersedia untuk melihat penjelasan dari layanan apa saja yang terdapat di neon.</p>

                        </div>

                    </div>

                </div>

            </section>

            <!-- / section -->

            <!-- paralax section -->

            <div class="parallaxed">

                <div class="parallax-image" data-parallax-left="0.5" data-parallax-top="0.3" data-parallax-scroll-speed="0.5">

                    <img src="<?= base_url('assets/back/img/parallax.png') ?>" alt="">



                </div>

                <div class="them-mask bg-color-1"></div>

                <div class="grid-row">

                    <div class="grid-col-row clear-fix">

                        <div class="grid-col grid-col-3 alt">

                            <div class="counter-block">

                                <i class="flaticon-book1"></i>

                                <div class="counter" data-count="{jumlah_mapel}">0</div>

                                <div class="counter-name">Pelajaran</div>

                            </div>

                        </div>

                        <div class="grid-col grid-col-3 alt">

                            <div class="counter-block">

                                <i class="flaticon-multiple"></i>

                                <div class="counter" data-count="{jumlah_siswa}">0</div>

                                <div class="counter-name">Siswa</div>

                            </div>       

                        </div>

                        <div class="grid-col grid-col-3 alt">

                            <div class="counter-block">

                                <i class="flaticon-pencil"></i>

                                <div class="counter" data-count="{jumlah_guru}">0</div>

                                <div class="counter-name">Pengajar</div>

                            </div>

                        </div>

                        <div class="grid-col grid-col-3 alt">

                            <div class="counter-block last">

                                <i class="fa fa-caret-square-o-right"></i>

                                <div class="counter" data-count="{jumlah_video}">0</div>

                                <div class="counter-name">Video</div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- / paralax section -->

            <hr class="divider-color" />



            <hr class="divider-color"/>

            <?php include 'v-about-us.php' ?>

            <!-- parallax section -->

            <div class="parallaxed">

                <div class="parallax-image" data-parallax-left="0.5" data-parallax-top="0.3" data-parallax-scroll-speed="0.5">

                    <img src="<?= base_url('assets/back/img/parallax.png') ?>" alt="">

                </div>

                <div class="them-mask bg-color-2" id="subs"></div>

                <div class="grid-row center-text">

                    <div class="font-style-1 margin-none">Berinteraksi Dengan Kami.</div>

                    <div class="divider-mini"></div>

                    <p class="parallax-text">Neon hadir untuk kalian yang pengen pinter dengan cara mudah dan asyik. Ayo bergabung dengan Neon. Silahkan masukkan email kalian.</p>
                    <?php if ($this->session->flashdata('notif') != '') {
                        ?>

                        <div class="alert alert-warning fade in">

                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

                            <span class="semibold"></span><?php echo $this->session->flashdata('notif'); ?>

                        </div>

                    <?php } ?>
                    <form class="subscribe login-form" action="<?= base_url('index.php/Homepage/addsubs') ?>" method="post">
                        <!-- untuk menampilkan pesan kesalahan penginputan email -->
                        <input type="email" class="form-control input-sm" name="email" id="emailsubs" method="post" value="<?php echo set_value('email'); ?>" placeholder="xxx@mail.com" required><input type="submit" value="Subscribe">    

                       <!--<input type="email" class="form-control input-sm" name="emailsubs" id="emailsubs" value="<?php echo set_value('emailsubs'); ?>" placeholder="xxx@mail.com" required><input type="submit" value="Subscribe">-->
                        <!-- untuk menampilkan pesan kesalahan penginputan email -->
                        <span class="text-danger"><?php echo form_error('email'); ?></span> 
                    </form>

                </div>

            </div>

            <!-- parallax section -->

            <?php include 'v-favorite-guru.php' ?>

            <hr class="divider-color" />

            <!-- section -->

            <section class="padding-section">

                <div class="grid-row clear-fix">

                    <div class="grid-col-row">

                        <div class="grid-col grid-col-6">

                            <div class="video-player">

                                <iframe src="https://www.youtube.com/embed/gcKzTfCsFSM"></iframe>

                            </div>

                        </div>

                        <div class="grid-col grid-col-6 clear-fix">

                            <h2>Yuk, kenali lebih mengenal neon lewat video pendek disamping.</h2>

                            <p>Untuk lebih dapat mengenal neon itu apa, silahkan klik tombol mulai pada video disamping ini. semoga teman-teman bisa tambah kenal sama neon yah.</p>

                            <br/>

                            <br/>

                            <br/>

                            <br/>

                            <!-- <a href="page-about-us.html" class="cws-button bt-color-3 border-radius alt icon-right float-right">Watch More<i class="fa fa-angle-right"></i></a> -->

                        </div>

                    </div>

                </div>

            </section>

            <!-- / section -->

            <hr class="divider-color" />



            <?php include 'v-pricing-table.php'; ?>

            <!-- parallax section -->

<div class="parallaxed">

                <div class="parallax-image" data-parallax-left="0.5" data-parallax-top="0.3" data-parallax-scroll-speed="0.5">

                    <img src="<?= base_url('assets/back/img/parallax.png') ?>" alt="">

                </div>

                <div class="them-mask bg-color-3"></div>

                <div class="grid-row center-text">

                    <!-- twitter -->

                    <div class="twitter-1"></div>

                    <!-- / twitter -->

                </div>

            </div>
<section class="fullwidth-background testimonial padding-section" id="testimonials">

                <div class="grid-row">

                    <h2 class="center-text">Testimonials</h2>

                    <div class="owl-carousel testimonials-carousel">


                        <?php
                        foreach ($testimoni as $key) {
                            ?>
                            <div class="gallery-item">

                                <div class="quote-avatar-author clear-fix"><img src="<?= base_url('assets/image/photo/siswa/'.$key['photo']) ?>" data-at2x="http://placehold.it/94x94" alt=""><div class="author-info"><?= $key['namaDepan']." ".$key['namaBelakang']?><br><span><?=$key['namaSekolah']?></span></div></div>

                                <p><?= $key['testimoni']?></p>

                            </div>
                            <?php
                        }
                        ?>
                    </div>

                </div>

            </section>
        <?php include 'v-footer.php' ?>

        <script src="<?= base_url('assets/back/js/jquery.min.js') ?>"></script>

        <script type="text/javascript">
            $(".main-nav li a.testimonials").click(function() {
                $('html, body').animate({
                    scrollTop: $("#testimonials").offset().top
                }, 2000);
            });

            $(".main-nav li a.service").click(function() {
                $('html, body').animate({
                    scrollTop: $("#service").offset().top
                }, 2000);
            });

            $(".main-nav li a.subs").click(function() {
                $('html, body').animate({
                    scrollTop: $("#subs").offset().top
                }, 2000);
            });


            function changekonten(data){

                var judul;

                var isi;

                if (data=="VideoBelajar") {

                    judul = "Video Belajar";

                    isi = "Neon Menyediakan Video Belajar yang lengkap, asyik dan mudah dipahami. Tidak hanya itu Neon juga memberikan 2 jenis video yang bisa kalian sesuaiank dengan kecepatan akses internet kalian. Video Screen Recording untuk akses badwith dan kuota yang tidak terlalu besar dan Teacher Recording untuk kalian punya akses internet cepat dan kuota besar. Neon juga  menyediakan video2 pembahasan soal."

                }else if(data=="Konsultasi"){

                    judul = "Konsultasi";

                    isi = "Neon menyediakan tentor-tentor piket yang setiap saat akan menjawab pertanyaan-pertanyaan kalian ni guys, so jangan kuatir kalo tiba2 kalian mendaadak ada pertanyaan yang harus segera diselesaikan, kalian bisa langsung hubungi tentor neon."

                }else if(data=="Tryout"){

                    judul = "TryOut Online"

                    isi = "Kalian bisa menikmati latihan semester, latihan UN, Latian SBMPTN atau TryOut yang lain secara online. Soal-soal yang disediakan variatif, asyik dan tentunya sangat bagus untuk meningkatkan kemampuan kalian."

                }else if(data=="edudrive"){

                    judul = "Edu Drive";

                    isi = "Edu drive ini semacam gudang file, yang isinya macam2 jenis file yang bisa digunakan untuk belajar. Misalnya di edudrive ada soal-soal UN terbaru, Soal SMBPTN terbaru, Prediksi soal UAS dll. Kalian bisa mengakses atau mendownloadnya sesuka kalian.";

                }else if(data=="toflfokus"){

                    judul = "TOEFL Fokus";

                    isi = "Pagi kalian yg pengen memperdalam bahasa inggris denga belajar toefl disini tempatnya. Cukup menjadi member neon anda bisa belajar toefl sesuka dan sepuasnya sampaikalian benar-benar bisa.";

                }else if(data=="penjurusan"){

                    judul = "Penjurusan";

                    isi = "Masih bingung pilih jurusan untuk tempat kuliah kalian ? . Tenang, neon akan membatu  kalian. Dengan sistem DETECTION kami akan membantu kalia menemukan jurusan yang tepat untuk kuliah kalian.";

                }else if(data=="raportonline"){

                    judul = "Raport Online";

                    isi = "Rapor online akan merekan semua kegiatan kalian selama menjadi member.Informasi tentang video pembelajaran yang kalian akses, latihan dan TO yang kalian kerjakan akan bisa kalian lihat dalam rapor online."

                }else{

                    //latihan

                    judul = "Latihan Online";

                    isi = "Nah ini ni... bagi kamu yang demen nguji kemampuan diri kalian, dengan latihan online ini, kalian bisa latihan kapapun selama kalian mau. Dan Asyiknya lagi kalian bisa pilih sendiri level soalnya dari yang mudah sampai yang susah.";

                }

                    $('.konten h2').html(judul).animate();

                    $('.konten p').html(isi);





            }

        </script>

        <script type='text/javascript' src="<?= base_url('assets/back/js/jquery.validate.min.js') ?>"></script>

        <script src="<?= base_url('assets/back/js/jquery.form.min.js') ?>"></script>

        <script src="<?= base_url('assets/back/js/TweenMax.min.js') ?>"></script>

        <script src="<?= base_url('assets/back/js/main.js') ?>"></script>

        <!-- jQuery REVOLUTION Slider  -->

        <script type="text/javascript" src="<?= base_url('assets/back/rs-plugin/js/jquery.themepunch.tools.min.js') ?>"></script>

        <script type="text/javascript" src="<?= base_url('assets/back/rs-plugin/js/jquery.themepunch.revolution.min.js') ?>"></script>

        <script type="text/javascript" src="<?= base_url('assets/back/rs-plugin/js/extensions/revolution.extension.slideanims.min.js') ?>"></script>

        <script type="text/javascript" src="<?= base_url('assets/back/rs-plugin/js/extensions/revolution.extension.actions.min.js') ?>"></script>

        <script type="text/javascript" src="<?= base_url('assets/back/rs-plugin/js/extensions/revolution.extension.layeranimation.min.js') ?>"></script>


        <script type="text/javascript" src="<?= base_url('assets/back/rs-plugin/js/extensions/revolution.extension.navigation.min.js') ?>"></script>

        <script type="text/javascript" src="<?= base_url('assets/back/rs-plugin/js/extensions/revolution.extension.migration.min.js') ?>"></script>

        <script type="text/javascript" src="<?= base_url('assets/back/rs-plugin/js/extensions/revolution.extension.parallax.min.js') ?>"></script>      

        <script src="<?= base_url('assets/back/js/jquery.isotope.min.js') ?>"></script>



        <script src="<?= base_url('assets/back/js/owl.carousel.min.js') ?>"></script>

        <script src="<?= base_url('assets/back/js/jquery-ui.min.js') ?>"></script>

        <script src="<?= base_url('assets/back/js/jflickrfeed.min.js') ?>"></script>

        <script src="<?= base_url('assets/back/js/jquery.tweet.js') ?>"></script>


        <script src="<?= base_url('assets/back/js/jquery.fancybox.pack.js') ?>"></script>

        <script src="<?= base_url('assets/back/js/jquery.fancybox-media.js') ?>"></script>

        <script src="<?= base_url('assets/back/js/retina.min.js') ?>"></script>

    </body>

</html>
