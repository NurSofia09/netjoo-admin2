           <style type="text/css">
            blockquote{
              display:block;
              background: #fff;
              padding: 15px 20px 15px 45px;
              margin: 0 0 20px;
              position: relative;

              /*Font*/
              font-size: 13px;
              line-height: 1.2;
              color: #666;
              text-align: justify;

              /*Borders - (Optional)*/
              border-left: 10px solid #ccc;
              border-right: 2px solid #ccc;

          }

          blockquote::before{
              content: "\201C"; /*Unicode for Left Double Quote*/

              /*Font*/
              font-family: Georgia, serif;
              font-size: 20px;
              font-weight: bold;
              color: #999;

              /*Positioning*/
              position: absolute;
              left: 10px;
              top:5px;
          }

          blockquote::after{
              /*Reset to make sure*/
              content: "";
          }

          blockquote a{
              text-decoration: none;
              background: #eee;
              cursor: pointer;
              padding: 0 3px;
              color: #c76c0c;
          }

          blockquote a:hover{
             color: #666;
         }

         blockquote em{
          font-style: italic;
      }
  </style> <!-- START Blog Content -->
  <link href="http://vjs.zencdn.net/5.8.8/video-js.css" rel="stylesheet">
  <!-- If you'd like to support IE8 -->
  <script src="http://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>

  <section class="section bgcolor-white " id="main" role="main">
    <div class="container-fluid">
        <!-- START Row -->
        <div class="row">
            <!-- START Left Section -->
            <div class="col-md-12 mb15">
                <!-- Blog post #1 -->
                <!-- Content -->
                <section class="panel-body pl0 pr0">
                    <div class="row">
                    <input type="text" name="videoID" hidden="true" value="{videoID}">
                        <!-- post date -->
                        <div class="col-xs-3 col-sm-1 col-md-1 pr0">
                            <div class="panel widget">
                                <div class="pa10">
                                    <h4 class="bold nm text-primary text-center">{tanggal}</h4>
                                </div>
                                <hr class="nm">
                                <div class="pa10 bgcolor-default">
                                    <p class="semibold nm text-default text-center">{bulan}</p>
                                </div>
                            </div>
                        </div>
                        <!--/ post date -->
                        <!-- post content -->
                        <div class="col-xs-9 col-sm-11 col-md-12">
                            <!-- heading -->
                            <h3 class="font-alt ellipsis mt0"><a href="javascript:void(0);" class="text-default">{judul_header}</a></h3>
                            <!--/ heading -->
                            <div class="container-fluid">
                                <center>    
                                    {file}
                                  </center>
                                  <br>
                              </div>
                              <!-- meta -->
                              <p class="meta">
                                <a href="javascript:void(0);">{jumlah_comment} komen</a><!-- comments -->
                                <span class="text-muted mr5 ml5">&#8226;</span>
                                <span class="text-muted">In </span><a href="javascript:void(0);">{nama_sub}</a><!-- category -->
                                <span class="text-muted mr5 ml5">&#8226;</span>
                                <span class="text-muted">By </span><a href="javascript:void(0);">{nama_penulis}</a><!-- author -->
                            </p>
                            <!--/ meta -->

                            <!-- text -->
                            <div class="text-default">
                                <p>{deskripsi}</p>
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
                            <p class="font-alt nm">Tentang Penulis</p>
                        </h4>
                    </div>
                    <!--/ Header -->
                    <div class="well mb0">
                        <ul class="list-table">
                            <li style="width:80px;">
                                <img class="img-circle" src="{avatar}" alt="" width="70px" height="70px">
                            </li>
                            <li class="text-left">
                                <h5 class="semibold mt0 text-accent">{nama_penulis}</h5>
                                <p class="text-muted nm">{biografi}</p>
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
                            <p class="font-alt nm">Komen ({jumlah_comment})</p>
                        </h4>
                    </div>
                    <!--/ Header -->
                    <div class="media" id="media-comment">
                    <?php foreach ($comments as $comment): ?>
                        <div class="media-list media-list-bubble" >

                            <div class="media" >
                                <a href="javascript:void(0);" class="media-object pull-left">

                                    <img src="<?=$comment['avatar'] ?>" class="img-circle" alt="">
                                </a>

                                <div class="media-body" >

                                    <div class="media-text" style="width: 100%">
                                        <h5 class="semibold mt0 mb5 text-default"><?=$comment['namaPengguna'] ?></h5>
                                        <p class="<?=$comment['komenID'] ?> mb15"><?=$comment['isiKomen']?></p>
                                        <input type="hidden" name="<?=$comment['komenID'] ?>" value="<?=$comment['isiKomen'] ?>">
                                        <!-- meta icon -->
                                        <p class="mb0">
                                            <span class="media-meta"><?=$comment['date_created'] ?></span>
                                            <span class="mr5 ml5 text-muted">&#8226;</span>
                                            <a onclick="reply(<?=$comment['komenID'] ?>)" class="media-meta text-default" data-toggle="tooltip" title="Reply"><i class="ico-reply"></i></a>
                                        </p>
                                        <!--/ meta icon -->
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                    </div>
                </section>
                <!-- Comments -->

                <!-- Post Comments -->
                <section class="panel-footer pb0">
                    <!-- Header -->
                    <div class="section-header section-header-bordered mb15">
                        <h4 class="section-title">
                            <p class="font-alt nm">Kirim Postingan</p>
                        </h4>
                    </div>
                    <!--/ Header -->
                    <div class="container-fluid">
                        <form class="form-horizontal" data-toggle="formajax" data-options='{ "url": "server/form-ajax.php" }'>
                            <div class="form-group">
                                <div id="info">
                                    <div class="sukses text-info text-center hide">
                                    <span>Komen anda telah terkirim</span>
                                    </div>
                                    <div class="gagal text-danger text-center hide">
                                        <span>Gagal memberikan komen !</span>
                                    </div> 
                                    <div class="lengkapi text-danger text-center hide">
                                        <span>Tolong isi komentar</span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <textarea class="form-control" rows="6" name="comment"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success ladda-button" data-style="expand-right" onclick="post()"><span class="ladda-label">Post</span></button>
                                    <button type="reset" class="btn btn-default">Reset</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </section>
                <!--/ Post Comments -->
            </article>
            <!--/ Blog post #1 -->
        </div>
        <!--/ END Left Section -->

    </div>
    <!--/ END Row -->
</div>
</section>
<!--/ END Blog Content -->  
<script src="http://vjs.zencdn.net/5.8.8/video.js"></script>
<script type="text/javascript">
    function reply(komenID){
        name = 'input[name='+komenID+']';
        quote = $(name).val();

        $('textarea[name=comment]').val("<blockquote>"+quote+"</blockquote>");

    }

    function post(){
        var isiKomen = $('textarea[name=comment]').val();
        var videoID = <?= $this->uri->segment(3) ?>;
        if (isiKomen=="") {
            $('#info .lengkapi').removeClass('hide');
            $('#info .sukses').addClass('hide');
            $('#info .gagal').addClass('hide');
        }else{
           $.ajax({
            type: "POST",
            url: base_url+"/video/addkomen",
            data: {isiKomen: isiKomen, videoID: videoID},
            dataType: "json",
                cache : false,
            success: function (data)
            {
             $('#info .lengkapi').addClass('hide');
             $('#info .sukses').removeClass('hide');
             $('#info .gagal').addClass('hide');
             // set data ke server.js
             if(data.success == true){

                var socket = io.connect( 'http://'+window.location.hostname+':3000' );

                socket.emit('new_count_komen', { 
                  new_count_komen: data.new_count_komen
                });
                console.log(data);
                socket.emit('new_komen', { 
                   isiKomen: data.isiKomen,
                  videoID: data.videoID,
                  userID: data.userID,
                  UUID: data.UUID,
                  namaPengguna:data.namaPengguna,
                  date_created:data.date_created,
                  videoID:data.videoID,
                  photo:data.photo,
                  mapelID:data.mapelID

                });

              } else if(data.success == false){
                console.log("gagal");

              }

             // 
                            },
                            error: function ()
                            {
                                $('#info .lengkapi').removeClass('hide');
                                $('#info .sukses').addClass('hide');
                                $('#info .gagal').removeClass('hide');
                            }
                        }); 
       }
   }
</script>

<script type="text/javascript">
 var socket = io.connect( 'http://'+window.location.hostname+':3000' );

    socket.on( 'new_komen', function( data ) {
      var videoID = $("[name=videoID]").val();
      console.log(videoID);
     if (data.videoID==videoID) {
            $("#media-comment").append('<div class="media-list media-list-bubble" ><div class="media" ><a href="javascript:void(0);" class="media-object pull-left"><img src="'+data.photo+'" class="img-circle" alt=""></a><div class="media-body" ><div class="media-text" style="width: 100%"><h5 class="semibold mt0 mb5 text-default">'+data.namaPengguna+'</h5><p class="<?=$comment['komenID'] ?> mb15">'+data.isiKomen+'</p><input type="hidden" name="<?=$comment['komenID'] ?>" value="'+data.isiKomen+'"><p class="mb0"><span class="media-meta">'+data.date_created+'</span><span class="mr5 ml5 text-muted">&#8226;</span><a onclick="reply('+data.komenID+')" class="media-meta text-default" data-toggle="tooltip" title="Reply"><i class="ico-reply"></i></a></p></div></div></div></div>');
     }
      // media-bodey-comment

      // if (true) {

      // }
    });
</script>