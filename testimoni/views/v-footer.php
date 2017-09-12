<footer>
    <div class="grid-row">
        <div class="grid-col-row clear-fix">
            <section class="grid-col grid-col-4 footer-about">
                

                <div class="footer-social">
                    <!-- 
                                        <a href="" class="fa fa-twitter"></a>
                    
                                        <a href="" class="fa fa-skype"></a>
                    
                                        <a href="" class="fa fa-google-plus"></a>
                    
                                        <a href="" class="fa fa-rss"></a>
                    
                                        <a href="" class="fa fa-youtube"></a>
                    
                                    </div> -->

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