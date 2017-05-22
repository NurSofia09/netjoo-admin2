<style type="text/css">
    blockquote {
        background: #f9f9f9;
        /*margin: 1.5em 10px;*/
        padding: 0.5em 10px;
        quotes: "\201C""\201D""\2018""\2019";
        /*border: 1px solid black;*/
        border-right: 10px solid #ccc;
        margin-left: 80px;

    }
    blockquote:before {
        color: #ccc;
        content: open-quote;
        font-size: 4em;
        line-height: 0.1em;
        margin-right: 10px;
        vertical-align: -0.4em;
    }
    blockquote p {
        display: inline;
    }

    .section {
        padding: 50px 0
    }
    .section:not(:last-child) {
        border-bottom: 1px solid #e5e5e5
    }
    #macy-container::before {
        content: "";
        display: table;
        clear: both
    }
    #macy-container {
        margin-top: 22px
    }
    #macy-container::after {
        content: "";
        display: table;
        clear: both
    }
    .demo {
        margin-bottom: 24px;
        border-radius: 4px;
        overflow: hidden;
        border: 1px solid #eee;
        padding:5px;
    }
    .demo-image {
        width: 100%;
        display: block;
        height: auto
    }
    .feature-list {
        margin-bottom: 0;
        margin-left: 0;
        width: 100%;
        list-style: none
    }
    .feature-list li {
        display: inline-block;
        width: 25%;
        text-align: center
    }
    .feature-list li::before {
        color: inherit;
        content: "•";
        color: #54b9cb;
        margin-right: 7px
    }
    .btn {
        background-color: #54b9cb;
        line-height: 53px;
        padding: 0 18px 0 0;
        display: inline-block;
        text-decoration: none;
        color: #fff;
        border-radius: 4px;
        transition: all .25s ease-in-out;
        font-size: 18px
    }
    .btn:hover {
        background-color: #4CA8B9
    }
    .btn.has-icon::before {
        margin-right: 18px;
        padding: 0 18px;
        border-right: 1px solid #4daabb;
        line-height: 53px
    }
</style>
<hr class="divider-color" />


<main>
  <section class="section">
    <!-- Start Div container -->
    <div class="container">
      <!-- Start div macy-container -->
      <div id="macy-container">
        <?php $i=0;   $cekjudulsubbab=null;?>
        <?php foreach ($video_by_bab as $bab_video_items) {
          $subbab=$bab_video_items['judulSubBab'];

          if ($cekjudulsubbab != $subbab) { 
            if($i=='1'){
              // END div demo
              ?></div> <?php
          } ?>
          <!-- Start div demo -->
          <div class="demo">
              <strong><?=$subbab ?></strong><br>
              <span><a href="<?=base_url('video/seevideo/')?><?=$bab_video_items['videoID']?>#ini" title="Room" >
               <?=$bab_video_items['judulVideo'];?>           
           </a></span><br>
           <?php }else{ ?>

           <span><a href="<?=base_url('video/seevideo/')?><?=$bab_video_items['videoID']?>#ini" title="Room" >
               <?=$bab_video_items['judulVideo'];?>           
           </a></span><br>

           <?php } ?>
           <?php   $cekjudulsubbab=$subbab;
           $i='1'; ?>
           <?php } ?>
       </div>
       <!-- END DIV DEMO -->
   </div>
   <!-- END div macy-container -->
</div>
<!-- END Div container -->
</section>
</main>


<hr class="divider-color" />
<div class="grid-col-row row" id="ini" >
    <div class="container">
        <div class="grid-col grid-col-3 container" style="list-style: none;">
            <aside class="project-details">
                <br><br>
                <h5>{nama_sub}<a title="Timeline View" href="{sub_id}"><i class="glyphicon glyphicon-calendar"></i></a></h5>
                <hr class="divider-big" />
                <!-- <ul > -->
                    <?php foreach ($videobysub as $videobysub_item): ?>
                        <li ><a href="<?= base_url('index.php/video/seevideo/') ?><?= $videobysub_item->id ?>#ini"><?= $videobysub_item->judulVideo ?></a></li>
                    <?php endforeach ?>
                <!-- </ul> -->
            </aside>
        </div>

        <div class="grid-col grid-col-8 container" >
            <main>
                <section class="clear-fix">
                    <h5 class="center" >{judul_video}</h5>
                    <input type="text" name="videoID" value="{videoID}" hidden="true">
                    <hr class="divide-color">
                    <iframe width="760" height="430" src="{file}"></iframe>
                    <!-- <video preload controls src="{file}" width="750px" ></video> -->
                    <p>{deskripsi}</p>
                    <hr class="divider-color" />
                    <div class="quote-avatar-author clear-fix"><img src=" {photo}" data-at2x="{photo}" alt width="100px"><div class="author-info">{nama_penulis}<br/><span>Pembuat Video</span></div></div>
                    <p>{biografi}</p>
                </section>
                <hr class="divider-color" />
                <?php if ($this->session->userdata('HAKAKSES')=='ortu'): ?>
                <?php else: ?>
                <section class="clear-fix">
                    <form class="login-form" action ="" id="formkomen" method = "post">
                        <div id="info">
                            <div class="sukses text-info text-center hide">
                                <span>Komen anda telah terkirim, tunggu moderisasi dari guru yang bersangkutan</span>
                            </div>
                            <div class="gagal text-danger text-center hide">
                                <span>Gagal memberikan komen !</span>
                            </div> 
                            <div class="lengkapi text-danger text-center hide">
                                <span>Tolong isi komentar</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea placeholder="Tambahkan komentar" id="isiKomen" name="isiKomen" style="border: 1px solid graytext; width: 100%;padding: 10px;"></textarea>
                        </div>

                        <div class="form-group nm pull-right">
                            <button type="submit" class="button-fullwidth cws-button bt-color-3 alt"><span class="semibold">Kirim</span></button>
                        </div>
                    </form>
                </section>
                <section class="clear-fix">  
                    <!-- comments for post -->
                    <div class="comments">
                        <div id="comments">

                            <div class="comment-title" id="new_count_komen">Komentar <span>(<?=count($comments) ?>)</span></div>
                            <input type="text" name="count_komen" value="<?=count($comments) ?>" hidden="true">
                            <ol class="commentlist" id="comment-tbody">
                                <?php foreach ($comments as $comment): ?>   
                                    <li class="comment" >
                                        <div class="comment_container clear" style="margin-right: 100px">
                                            <img src="http://placehold.it/70x70" data-at2x="http://placehold.it/70x70" alt="" class="avatar">
                                            <div class="comment-text">
                                                <p class="meta">
                                                    <strong><?=$comment->namaPengguna ?></strong>
                                                    <time datetime="<?=$comment->date_created ?>"> : <?=$comment->date_created ?></time>
                                                </p>
                                                <div class="description">
                                                    <p><?=$comment->isiKomen ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach ?>

                            </ol>
                        </div>
                    </div>
                    <!-- / comments for post -->

                </section>
                <?php endif ?>
            </main>
        </div>
    </div>
</div>
<!-- sound notification -->
<audio id="notif_audio"><source src="<?php echo base_url('sounds/notify.ogg');?>" type="audio/ogg"><source src="<?php echo base_url('sounds/notify.mp3');?>" type="audio/mpeg"><source src="<?php echo base_url('sounds/notify.wav');?>" type="audio/wav"></audio>
<!-- /sound notification -->
<script src="http://macyjs.com/assets/js/macy.min.js"></script>
  <script src="<?php echo base_url('node_modules/socket.io/node_modules/socket.io-client/socket.io.js');?>"></script>
<script>
    $(document).ready(function () {
        Macy.init({
          container: '#macy-container',
          trueOrder: false,
          waitForImages: false,
          margin: 24,
          columns: 3,
          breakAt: {
            1200: 5,
            940: 3,
            520: 2,
            400: 1
        }
    });

        $("#formkomen").submit(function (e) {
            e.preventDefault();
            var isiKomen = $("#isiKomen").val();
            var videoID = <?= $this->uri->segment(3) ?>;
            if (isiKomen=="") {
                $('#info .lengkapi').removeClass('hide');
                $('#info .sukses').addClass('hide');
                $('#info .gagal').addClass('hide');
            }else{
             $.ajax({
                type: "POST",
                url: '<?php echo base_url() ?>index.php/video/addkomen',
                data: {isiKomen: isiKomen, videoID: videoID},
                dataType: "json",
                cache : false,
                success: function (data)
                {
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
                // $("#name").val(data.name);
                // $("#email").val(data.email);
                // $("#subject").val(data.subject);
                // $("#message").val(data.message);
                // $("#notif").html(data.notif);

              }
                    // IO
                },
                error: function ()
                {
                    $('#info .lengkapi').removeClass('hide');
                    $('#info .sukses').addClass('hide');
                    $('#info .gagal').removeClass('hide');
                }
            }); 
         }

     });
    });

</script>
<script type="text/javascript">
    var socket = io.connect( 'http://'+window.location.hostname+':3000' );

          // socket.on( 'new_count_komen', function( data ) {
          //   console.log(data);
          //     $( "#new_count_komen" ).html( data.new_count_komen+'<i class="ico-bell"></i>');
          //     $('#notif_audio')[0].play();

          // });

          // socket.on( 'update_count_komen', function( data ) {

          //     $( "#new_count_komen" ).html( data.update_count_komen );
            
          // });
           socket.on( 'new_komen', function( data ) {
              var videoID=$("[name=videoID]").val();
              var penggunaID = '<?=$this->session->userdata['id'];?>';
               var old_count_komen = parseInt($('[name=count_komen]').val());
                new_count_komen = old_count_komen + 1;
                if (penggunaID!=data.userID && videoID==data.videoID) {

                 $( "#new_count_komen" ).html('Komenta <span>'+new_count_komen+'<span>');  
                 $('#notif_audio')[0].play();
                 $('[name=count_komen]').val(new_count_komen);
                 $( "#comment-tbody" ).append('<li class="comment"><div class="comment_container clear" style="margin-right: 100px"><img src="http://placehold.it/70x70" data-at2x="http://placehold.it/70x70" alt="" class="avatar"><div class="comment-text"><p class="meta"><strong>'+data.namaPengguna+'</strong><time datetime="<?=$comment->date_created ?>"> : '+data.date_created+'</time></p><div class="description"><p>'+data.isiKomen+'</p></div></div></div></li>');
               }else if(videoID==data.videoID){
                $( "#new_count_komen" ).html('Komenta <span>'+new_count_komen+'<span>'); 
                $('[name=count_komen]').val(new_count_komen);
                $( "#comment-tbody" ).append('<li class="comment"><div class="comment_container clear" style="margin-right: 100px"><img src="http://placehold.it/70x70" data-at2x="http://placehold.it/70x70" alt="" class="avatar"><div class="comment-text"><p class="meta"><strong>'+data.namaPengguna+'</strong><time datetime="<?=$comment->date_created ?>"> : '+data.date_created+'</time></p><div class="description"><p>'+data.isiKomen+'</p></div></div></div></li>');
              }

           
          });


</script>