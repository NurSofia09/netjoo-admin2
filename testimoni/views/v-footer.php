<footer>
    <div class="grid-row">
        <div class="grid-col-row clear-fix">
            <section class="grid-col grid-col-4 footer-about">
                <h2 class="corner-radius">Mengenai Neon</h2>
                <div>
                    <h3>Sedikit Bahasan Mengenai Neon</h3>
                    <p>Neon Jogja adalah Singkatan Dari Neutron Online, tempat para siswa-siswa neon belajar menggunakan media pembelajaran online.</p>
                </div>

                <address>
                    <p></p> 
                    <a href="tel:(022) 87805676" class="phone-number">(022) 87805676</a>
                    <br />
                    <a href="mailto: info@neonjogja.com" class="email"> info@neonjogja.com</a>
                    <br />
                     <a href="" class="fa fa-rss">Line: @wuf2783p (NEON)</a>
                    <br />
                    <a href="http://neonjogja.com" class="site">www.neonjogja.com</a>
                    <br />
                    <a href="" class="address">Jl. Taman Siswa, Wirogunan, Mergangsan, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55151, Indonesia</a>
                </address>

                <div class="footer-social">
                    <!-- 
                                        <a href="" class="fa fa-twitter"></a>
                    
                                        <a href="" class="fa fa-skype"></a>
                    
                                        <a href="" class="fa fa-google-plus"></a>
                    
                                        <a href="" class="fa fa-rss"></a>
                    
                                        <a href="" class="fa fa-youtube"></a>
                    
                                    </div> -->

                                </section>
                                <section class="grid-col grid-col-4 footer-latest">
                                    <h2 class="corner-radius" id="masuk">Video Terbaru</h2>
                                    <div id="video_last">   
                                    </div>
                                </section>

                                <section class="grid-col grid-col-4 footer-contact-form" id="pesan">

                                    <h2 class="corner-radius">Kirim Kami Testimoni</h2>

                                    <div class="email_server_responce"></div>

                                    <form action="" id="formtestimoni" class="login-form" method="post">

                                        <div class="form-group">
                                            <textarea maxlength=520 name="testimoni" id="isitestimoni" class="form-control" placeholder="Tuliskan testimonimu (max 520 Karakter)" cols="40" rows="5" aria-invalid="false" required></textarea>
                                        </div>

                                        <a type="submit" onclick="simpan_testimonials()" class="cws-button bt-color-3 border-radius alt icon-right">Kirim <i class="fa fa-angle-right"></i></a>

                                    </form>

                                </section>

                            </div>

                        </div>

                        <div class="footer-bottom">

                            <div class="grid-row clear-fix">

                                <div class="copyright">neonjogja.com<span></span> 2016</div>

                                <nav class="footer-nav">

                                    <ul class="clear-fix">

                                        <li>

                                            <a onclick="laporkanbug()">Laporkan Bug</a>

                                        </li>



                                    </ul>

                                </nav>

                            </div>

                        </div>

                    </footer>

                    <script>
                        function simpan_testimonials(){
                            var isitestimoni = $("#isitestimoni").val();
                            $.ajax({
                                type: "POST",
                                url: '<?php echo base_url() ?>index.php/testimoni/addtestimoni',
                                data: {isitestimoni: isitestimoni},
                                success: function (data)
                                {
                                    swal("Good job!", "Testimoni mu telah terkirim!", "success")
                                    document.getElementById("isitestimoni").value = "";
                                },
                                error: function ()
                                {
                                    alert('fail');
                                }
                            });
                        }


                        $.ajax({
                           type: "POST",
                           dataType:"JSON",
                           url: "<?= base_url() ?>video/ajax_get_last_video",
                           success: function (data,i) {
            // console.log(data.data[0]);
            $('#video_last').append(data.data[0]);
            $('#video_last').append(data.data[1]);

            // console.log(data);
        }
    });

                        function kunjungivideo(data){
                            document.location = base_url+"video/seevideo/"+data;
                        }            
                    </script>

                    <!-- / footer -->
<!-- / footer -->