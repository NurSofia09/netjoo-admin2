<html>

<head>

    <title>{judul_halaman}</title>
    <meta charse="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    
    <!-- style -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/back/rs-plugin/css/settings.css') ?>" media="screen">
    <link rel="stylesheet" href="<?= base_url('assets/back/css/animate.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/library/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>"/>
    <link rel="stylesheet" href="<?= base_url('assets/plugins/owl/css/owl.carousel.min.css'); ?>">
    <link rel="shortcut icon" href="<?= base_url('assets/back/img/favicon.png') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/back/css/font-awesome.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/back/fi/flaticon.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/back/css/main.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/back/css/jquery.fancybox.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/back/css/owl.carousel.css') ?>"/>
    <script type="text/javascript" src="<?= base_url('assets/library/jquery/js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/sal/sweetalert-dev.js');?>"></script>
    <link rel="stylesheet" href="<?= base_url('assets/sal/sweetalert.css');?>">
    <!--styles -->

</head>
<body>
<!-- sound notification -->
  <audio id="notif_audio"><source src="<?php echo base_url('sounds/notify.ogg');?>" type="audio/ogg"><source src="<?php echo base_url('sounds/notify.mp3');?>" type="audio/mpeg"><source src="<?php echo base_url('sounds/notify.wav');?>" type="audio/wav"></audio>
  <!-- /sound notification -->
    <script type="text/javascript">var base_url = "<?= base_url() ?>"</script>
    <script src="<?= base_url('assets/back/js/jquery.min.js') ?>"></script>
    <?php
    
    foreach ($files as $key) {
        include ($key);
    }
    ?>

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
    <script type="text/javascript" src="<?= base_url('assets/back/rs-plugin/js/extensions/revolution.extension.kenburn.min.js') ?>"></script>
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
    <script type="text/javascript" src="<?= base_url('assets/library/bootstrap/js/bootstrap.min.js') ?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/plugins/owl/js/owl.carousel.min.js');?>"></script>
    <script src="<?= base_url('assets/back/js/retina.min.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/plugins/datatables/js/jquery.datatables.min.js') ?>"></script>

    <!--datatable-->
    <script type="text/javascript" src="<?= base_url('assets/plugins/datatables/js/jquery.datatables.min.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/plugins/datatables/tabletools/js/tabletools.min.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/plugins/datatables/js/jquery.datatables-custom.min.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/javascript/tables/datatable.js') ?>"></script>

    <script type="text/javascript">
  var keahlian = JSON.parse('<?=$keahlian_detail ?>');

  jQuery(document).ready(function () {
    var socket = io.connect( 'http://'+window.location.hostname+':3000' );
    var idPengguna=('<?=$this->session->userdata['id'];?>');
    var idGuru = ('<?=$this->session->userdata['id_guru']?>');
    var new_count_komen = 0;
    var mapelID=8;
    var obMapel ='';
    var url = "<?= base_url() ?>index.php/guru/ajax_mapelID";
    console.log(idGuru);

     socket.on( 'pesan_baru', function( data ) {
        tampil = true;
        $('#notif_audio')[0].play();
     });

    socket.on( 'pesan_baru', function( data ) {
      var userID = data.userID;
      var mapelID = data.mapelID;
      var photo = data.photo; 
          //ajax untuk get data mapelid guru
          $.ajax({
            url:url,
            success:function(mapel){
              //ubah type data mapel id guru dari jason ke objek
              obMapel =JSON.parse(mapel);
              for (i = 0; i < obMapel.length; i++) { 
                mapelIdGuru=obMapel[i].mapelID;
                //cek data koemn jika data komen bukan milik dia dan mapel id sesuai dengan mapel id guru 
                if (idPengguna!=userID && mapelID==mapelIdGuru) {
                  //jika true 
                  var old_count_komen = parseInt($('[name=count_komen]').val());
                  new_count_komen = old_count_komen + 1;
                  $('[name=count_komen]').val(new_count_komen);
                  $( "#new_count_komen" ).html( new_count_komen+'<i class="ico-bell"></i>');  
                  // play sound notification
                  $('#notif_audio')[0].play();
                  //add komen baru ke data notif id message-tbody
                  $( "#message-tbody" ).prepend(' <a href="'+base_url+'komenback/seevideo/'+data.videoID+'/'+data.UUID+'" class="media border-dotted read"><span class="pull-left"><img src="'+photo+'" class="media-object img-circle" alt=""></span><span class="media-body"><span class="media-heading">'+data.namaPengguna+'</span><span class="media-text ellipsis nm">'+data.isiKomen+'</span><!-- meta icon --><span class="media-meta pull-right">'+data.date_created+'</span><!--/ meta icon --></span></a>');
                }
              }
            },              
          });
          
        });

    // SOCKET CREATE PERTANYAAN
    socket.on('create_pertanyaan', function(data){
      $.getJSON( base_url+"konsultasi/jumlah_komen/", function( datas ) {
        $('.jumlah_notifikasi').text(datas);
      });

      obj = JSON.parse(data.data);
      photo = base_url+"assets/image/photo/siswa/"+obj.photo;
      tampil = false;
      status =  (obj.statusRespon==0) ? "Belum Direspon" : "Sudah Direspon";

      // cek gurunya yang dituju bukan?
      if (obj.mentorID==idGuru) {
        tampil = true;
        //langsung ke mentor
        konten = '<a href="'+base_url+'konsultasi/singlekonsultasi/'+obj.id+'" class="media border-dotted read"><span class="pull-left"><img src="'+photo+'" class="media-object img-circle" alt=""></span><span class="media-body"><span class="media-heading">'+obj.nama_lengkap+'</span><span class="media-text ellipsis nm"><span cla>Konsultasi :</span> '+obj.judulPertanyaan+'</span><!-- meta icon --> <span title="Ditujukan pada anda"><i class="ico-star"></i></span> <span class="media-meta pull-right"><span class="text-info">Status: '+status+' | </span>'+obj.date_created+'</span><!--/ meta icon --></span></a>';
      }else{
        // jika matapelajaran yang diampu
        for (i = 0; i < keahlian.length; i++) { 
          tampil = true;
          if(keahlian[i].mapelID==obj.mapelID){
            konten = '<a href="'+base_url+'konsultasi/singlekonsultasi/'+obj.id+'" class="media border-dotted read"><span class="pull-left"><img src="'+photo+'" class="media-object img-circle" alt=""></span><span class="media-body"><span class="media-heading">'+obj.nama_lengkap+'</span><span class="media-text ellipsis nm"><span cla>Konsultasi :</span> '+obj.judulPertanyaan+'</span><!-- meta icon --> <span title="Matapelajaran '+keahlian[i].aliasMataPelajaran+'"><i class="ico-star-empty"></i></span> <span class="media-meta pull-right"><span class="text-info">Status: '+status+' | </span>'+obj.date_created+'</span><!--/ meta icon --></span></a>';
            break;
          }else{
            tampil = false;
          }

        }
      }

      if (tampil) {
        $('#notif_audio')[0].play();
        $( "#message-tbody" ).prepend(konten);
      }

  });
    // SOCKET CREATE PERTANYAAN
    
    // SOCKET REMOVE NOTIFIKASI
    socket.on('remove_notifikasi', function(data){
      console.log(data.datas.pertanyaanID);
      $('.pertanyaan-'+data.datas.pertanyaanID).remove();
      $('#notif_audio')[0].play();

      $.getJSON( base_url+"konsultasi/jumlah_komen/", function( datas ) {
        $('.jumlah_notifikasi').text(datas);
      });

    });
    // SOCKET REMOVE NOTIFIKASI


  
  });

</script>


</body>

</html>