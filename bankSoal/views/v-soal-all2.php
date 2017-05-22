
<div class="row">
    <div class="col-sm-5">
       <form class="mb15" action="<?=base_url()?>index.php/banksoal/cari" method="post" accept-charset="utf-8" enctype="multipart/form-data" >

        <div class="input-group">
            <input id="carisoal" type="text" name="keyword" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
                <button class="btn btn-primary" type="submit"><i class="ico-search"></i></button>
            </span>
        </div>
    </form>
</div>
        <div class="col-sm-7 ">
            <div class="note note-warning mb15">
                <a href="javascript:void(0)" style="color:white;" onclick="hidePesan()"><i class="ico-close"> </i></a><span>catatan: Anda hanya diperkenankan mengubah atau menghapus soal yang anda buat!!</span>
            </div>
        </div>
    <div class="col-sm-12">
        <!-- get page pagination -->
        <?php $page=$this->uri->segment('3');  ?>
        <!--Pengulangan list soal  -->
        <?php 
        $no = $this->uri->segment('3') + 1;
        foreach ($datSoal as $key): ?>
        <!-- START panel soal -->
        
        <div class="panel panel-teal mt10 mb0">
            <!-- panel-toolbar -->
            <div class="panel-heading ">
                <div class="panel-toolbar">
                    <h5 class="semibold nm ellipsis">Sumber Soal : <?=$key['sumber'];?></h5>
                </div>
                <div class="panel-toolbar text-right">
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-inverse btn-outline"><b style="color:white;">Aksi</b></button>
                        <button type="button" class="btn btn-sm btn-inverse btn-outline" data-toggle="dropdown"><span class="caret"></span></button>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li class="dropdown-header">Pilih Aksi :</li>
                            <li ><a href="javascript:void(0)" data-toggle="panelcollapse">Pembahasan (hide/unhide)</a></li>
                            <?php 
                            $idPengguna = $this->session->userdata['id'];
                              $hakakses = $this->session->userdata['HAKAKSES'];
                            $create_by = $key['create_by'];
                             ?>
                            <?php if ($idPengguna == $create_by || $hakakses == 'admin' ): ?>
                                <li><a href="<?=base_url()?>banksoal/formUpdate?UUID=<?=$key['UUID']?>&subBab=<?=$key['id_subbab']?>&page=<?=$page?>">Edit</a></li>
                            <li><a href="javascript:void(0)" onclick="drop_soal(<?=$key['id_soal'];?>)">Hapus</a></li>
                            <?php endif ?>  
                        </ul>
                        <!-- tambah soal -->
                         <a class="btn btn-sm  btn-inverse btn-outline" href="<?= base_url(); ?>index.php/banksoal/formsoal" title="Tambah Data Soal" ><i class="ico-plus"></i></a>
                    </div>
                </div>
            </div>
            <!--/ panel-toolbar -->
            <!-- panel-body -->
            <div class="panel-body ">
                <h6>Soal: <?=$key['judulSoal']?></h6>
                <!-- Start Gambar soal -->
                <?php $imgSoal = $key['imgSoal'] ?>
                <?php if ($imgSoal != '' && $imgSoal != ' '): ?>
                    <div class="overlay text-center">
                        <img class="unveiled" src="<?=$imgSoal ;?>" alt="imgSoal" style="max-width:400px;">
                    </div>
                <?php endif ?>

                <!-- END Gambar soal -->
                <!-- Start content soal -->
                <p class="text-justify ">
                    <?=$key['soal']; ?>
                </p>
                <!-- END start Content -->
                <!-- Start audio -->
                                <?php $audio =$key['audio'] ?>
                <?php if ($audio != '' && $audio != ' '): ?>
                    <audio class="col-sm-12" controls>
                         <source src="<?=base_url()?>assets/audio/soal/<?=$audio?>" type="audio/mpeg">
                    </audio>
                <?php endif ?>
            </div>
            <!--/ panel-body -->
            <div class="panel-body pt10 table-responsive panel-collapse pull in ">
                <h6>Pembahasan : </h6>
                <!-- Start img pembahasan -->
                <?php $imgBahas = $key['imgBahas'] ?>
                <?php if ($imgBahas != '' && $imgBahas != ' '): ?>
                    <div class="overlay text-center">
                        <img class="unveiled" src="<?=$imgBahas ;?>" alt="imgSoal" style="max-width:400px;">
                    </div>
                <?php endif ?>
                <!-- END img Pembahsan -->
                <!-- Start Video Pembahasan -->
                <?php $video = $key['videoBahas']; ?>
                <?php if ($video != '' && $video != ' '): ?>
                    <video class=" modal-body img-tumbnail image" src="<?=$video;?>" width="100%" height="50%" controls="" id="video-ply" style="background:grey;">
                    </video>
                <?php endif ?>
                <!-- END Video Pembahasan -->
                <p><?=$key['pembahasan'];?></p>
                <p class="col-sm-6 pl0">Jawaban : <?=$key['jawaban'];?>. <?=$key['isiJawaban'];?> 
                    <img src="<?=$key['imgJawaban'];?>" style="max-width: 200px; max-height: 125px; ">
                </p>
                
                <div class="text-right col-md-6" ">
                    <button type="button" class="btn btn-sm btn-inverse mb5" data-toggle="panelcollapse" title="Sembunyikan"><i class="ico-arrow-up12"></i> </button></div>

                </div>

                <!--  -->
                <!-- panel-footer -->
                <div class="panel-footer hidden-xs">
                    <ul class="nav nav-section nav-justified">

                        <li>
                            <div class="section">
                                <i class="ico-file"></i>
                               <span class="mls"> Kesulitan : <?=$key['kesulitan']; ?> </span>
                            </div>
                        </li>
                        <li>
                            <div class="section">
                                <i class="ico-file"></i>
                             <span class="mls">   Tingkat : <?=$key['tingkat']?></span>
                            </div>
                        </li>
                        <li>
                            <div class="section">
                                <i class="ico-file"></i>
                               <span class="mls"> mapel : <?=$key['mapel'];?></span>
                            </div>
                        </li>
                        <li>
                            <div class="section">
                                <i class="ico-file"></i>
                               <span class="mls"> Bab : <?=$key['bab'];?> </span>
                            </div>
                        </li>
                        <li>
                            <div class="section">
                                <i class="ico-file"></i>
                                <span class="mls">Subab:  <?=$key['subBab'];?> </span>
                            </div>
                        </li>
                    </ul>
                </div>
                <!--/ panel-footer -->
            </div >
            <!--/ END panel soal -->
        <?php endforeach ?>
        <!-- end Pengulangan list soal -->
    <nav aria-label="Page navigation mt10 pt10"><center>
        <ul class="pagination ">
        <?php 
        echo $this->pagination->create_links();
        ?>
        </ul>
        </center>
    </nav>

    </div>
</div>
                        <!--/ Website States
                        <!-- Start javascript -->
                        <!-- Start Math jax --> 
                        <script type="text/x-mathjax-config"> 
                            MathJax.Hub.Config({ 
                            tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]} 
                        }); 
                    </script> 
                    <script type="text/javascript" async 
                    src="<?= base_url('assets/plugins/MathJax-master/MathJax.js?config=TeX-MML-AM_HTMLorMML') ?>">
                </script> 
                <!-- end Math jax -->
<!-- End javascrip>-->
<script type="text/javascript">
    function drop_soal(id_soal){
  url = base_url+"banksoal/deletebanksoal2/"+id_soal;
  swal({
    title: "Yakin akan menghapus soal ini?",
    text: "Anda tidak dapat membatalkan ini.",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Ya,Tetap hapus!",
    closeOnConfirm: false
  },
  function(){
    var datas = {id:id_soal};
    $.ajax({
      dataType:"text",
      data:datas,
      type:"POST",
      url:url,
      success:function(){
        swal("Terhapus!", "Soal berhasil dihapus.", "success");
       window.location.href =base_url+"banksoal/listsoal";
      },
      error:function(){
        sweetAlert("Oops...", "Data gagal terhapus!", "error");
      }

    });
  });
}

function hidePesan() {
   $('.note').hide();
}
// function drop_soal(id_soal) {
//     console.log(id_soal);
// }
</script>

<!-- on keypres cari soal -->
<script type="text/javascript">
var site = "<?php echo site_url();?>";
  $(function() {
    $( "#carisoal" ).autocomplete({
        source: site+'/banksoal/autocomplete',
               select: function (event, ui) {
                window.location = ui.item.url;
                }
    });
});
</script>