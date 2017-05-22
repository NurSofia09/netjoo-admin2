<!-- START Template Main -->
<script type="text/javascript" src="<?= base_url('assets/plugins/MathJax-master/MathJax.js?config=TeX-MML-AM_HTMLorMML') ?>"></script>
<!-- ENND pengecekan jika pilihan 5 atau 4 pilihan -->
<!-- START Template Main -->
<section id="main" role="main">
    <!-- START Template Container -->
    <script type="text/javascript" src="<?= base_url('assets/plugins/ckeditor/ckeditor.js') ?>"></script>

    <div class="container-fluid">
<!-- Start Modal salah upload gambar -->
<div class="modal fade" id="warningupload" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h2 class="modal-title text-center text-danger">Peringatan</h2>
      </div>
      <div class="modal-body">
        <h3 class="text-center">Silahkan cek type extension gambar! </h3>
        <h5 class="text-center">Type yang bisa di upload hanya ".doc", ".docx", ".ppt", ".pptx", ".pdf"</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

        <!-- START row -->
        <div class="row">
            <div class="col-md-12">
                <!-- Form horizontal layout bordered -->
                <form class="form-horizontal form-bordered panel panel-teal" action="<?=base_url()?>index.php/modulonline/updatebanksoal" method="post" accept-charset="utf-8" enctype="multipart/form-data" >
                    <div class="panel-heading">
                        <h3 class="panel-title">Form Update Soal</h3>
                        <!-- untuk menampung bab id -->
                        <!-- <input type="text" name="subBabID" value="<?=$subBabID;?>"  hidden="true"> -->
                        <input type="text" name="soalID" value="<?=$banksoal['id'];?>" hidden="true">
                        <input type="text" name="UUID" value="<?=$banksoal['uuid'];?>"  hidden="true">
                        <!-- Start old info data soal -->
                        <input type="text" id="oldtkt" value="<?=$infosoal['id_tingkat'];?>" hidden="true">
                        <input type="text"  id="oldmp"  value="<?=$infosoal['id_mp'];?>" hidden="true">
                        <!-- <input type="text" id="oldbab"  value="<?=$infosoal['id_bab'];?>" hidden="true"> -->
                        <!-- <input type="text" id="oldsub"  value="<?=$infosoal['id_subbab'];?>" hidden="true"> -->
                        <!-- END old info data soal -->
                    </div>               
                    <div class="panel-body">
                     <!-- Start Dropd Down depeden -->
                    
                      <div  class="form-group " >

                        <label class="col-sm-1 control-label">Tingkat</label>

                        <div class="col-sm-4">

                          <select class="form-control" name="tingkat" id="tingkat">

                            <option>-Pilih Tingkat-</option>

                          </select>

                        </div>



                        <label class="col-sm-2 control-label">Mata Pelajaran</label>

                        <div class="col-sm-4">

                          <select class="form-control" name="mataPelajaran" id="pelajaran">



                          </select>

                        </div>

                      </div>

                      <!-- END Drop Down depeden -->
                        <div class="form-group">
                            <label class="control-label col-sm-2">Judul Modul</label>
                            <div class="col-sm-8">
                                <input type="text" name="judul" value="<?=$banksoal['judul'];?>" class="form-control">
                            </div>
                        </div>

                         <div class="form-group">

                            <label class="control-label col-sm-2">Deskripsi Modul</label>

                            <!-- Start input text A -->

                            <div class="col-sm-8 piltext">

                               <textarea name="deskripsi"  class="form-control">  <?=$banksoal['deskripsi'];?> </textarea>

                            </div>

                          </div>

                           <div class="form-group">
                           <label class="control-label col-sm-2">Publish File</label>

                            <div class="col-sm-3">

                                <div class="checkbox custom-checkbox">  
                                    <input type="text" id="tamppublish" value="<?=$banksoal['publish'];?>" hidden="true">
                                    <input type="checkbox" name="publish" id="gift" value="1">  

                                    <label for="gift"><small>&nbsp;&nbsp;Check = Yes</small></label>   
                                </div>
                            </div>
                        </div>    
                       
                        <?php
                            if ($banksoal['url_file'] == null) { ?>
                                 <div class="form-group">
                                    <label class="control-label col-sm-2">File Modul</label>
                                        <div class="col-sm-8"> 
                                             <div class="col-sm-12">
                                                 <div class="col-md-5 left"> 
                                                        <h6>Name: <span id="filenameSoal"></span></h6> 
                                                </div> 
                                                <div class="col-md-4 left"> 
                                                        <h6>Size: <span id="filesizeSoal"></span>Kb</h6> 
                                                </div> 
                                                <div class="col-md-3 bottom"> 
                                                        <h6>Type: <span id="filetypeSoal"></span></h6> 
                                                </div>
                                             </div>
                                             <div class="col-sm-12">
                                                <input class="btn btn-default" required="true" type="file" id="fileSoal" name="gambarSoal" onchange="ValidateSingleInput(this);"/>
                                            </div>
                                        </div>
                                 </div>
                         <?php       
                            }else{ ?>
                            <div class="form-group">
                                    <label class="control-label col-sm-2">File Modul</label>
                                        <div class="col-sm-8"> 
                                             <div class="col-md-5 left"> 
                                            <h6><span id="filenameSoal1"><?=$banksoal['url_file'];?></span></h6> 
                                            </div> 
                                            <div class="col-md-4 left"> 
                                                    <a href="<?= base_url('assets/modul/'.$banksoal['url_file'])?>" class="btn btn-sm btn-default" target="_blank" >Download</a>
                                            </div> 
                                        </div>
                                 </div>

                        <?php
                            }
                        ?>
                          <div class="form-group">
                            <label class="control-label col-sm-2">File Baru</label>
                             <div class="col-sm-8 " >                                            
                               
                                    <div class="col-sm-12">

                                    <div class="col-md-5 left"> 

                                            <h6>Name: <span id="filenameSoal"></span></h6> 

                                    </div> 

                                    <div class="col-md-4 left"> 

                                            <h6>Size: <span id="filesizeSoal"></span>Kb</h6> 

                                    </div> 

                                    <div class="col-md-3 bottom"> 

                                            <h6>Type: <span id="filetypeSoal"></span></h6> 

                                    </div>

                                </div>
                                      

                                <div class="col-sm-12">
                                    <input class="btn btn-default" type="file" id="fileSoal" name="gambarSoal" onchange="ValidateSingleInput(this);"/>
                                </div>                                                            
                            </div>
                        </div>
                        
                    </div>
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                       
                    </div>
                </form>
                <!--/ Form horizontal layout bordered -->
            </div>

        </div>
        <!--/ END row -->
    </div>

    <!-- script untuk option hide and show -->
    <script type="text/javascript">
       
        $(document).ready(function(){
        
            //set opton dropdown mp
              loadPelajaran($('#oldtkt').val());
            // #########################


     
          // ########################

      
          // set option publish################
           var tamppublish=$('#tamppublish').val();
          if (tamppublish ==1) {
             $('#gift').attr('checked','checked');
          }else{
          }
          // ########################

    
          // ########################


       

        });
    </script>

    <!-- Start script untuk priview gambar soal -->
    <script type="text/javascript">
        $(function () {
            // Start event priview gambar Soal
            $('#fileSoal').on('change',function () {
                console.log('test');
                var file = this.files[0];
                var reader = new FileReader();
                reader.onload = viewerSoal.load;
                reader.readAsDataURL(file);
                viewerSoal.setProperties(file);
            });
            var viewerSoal = {
                load : function(e){
                    $('#previewSoal').attr('src', e.target.result);
                },
                setProperties : function(file){
                    $('#filenameSoal').text(file.name);
                    $('#filetypeSoal').text(file.type);
                    $('#filesizeSoal').text(Math.round(file.size/1024));
                },
            }
            // End event priview gambar soal
            // Start event priview gambar pilihan A
            $('#fileA').on('change',function () {
                var file = this.files[0];
                var reader = new FileReader();
                reader.onload = viewerA.load;
                reader.readAsDataURL(file);
                viewerA.setProperties(file);
            
            });
            var viewerA = {
                load : function(e){
                    $('#previewA').attr('src', e.target.result);
                },
                setProperties : function(file){
                    $('#filenameA').text(file.name);
                    $('#filetypeA').text(file.type);
                    $('#filesizeA').text(Math.round(file.size/1024));
                },
            }
            // End event priview gambar pilihan A

            // Start event priview gambar pilihan B
            $('#fileB').on('change',function () {
                console.log('test');
                var file = this.files[0];
                var reader = new FileReader();
                reader.onload = viewerB.load;
                reader.readAsDataURL(file);
                viewerB.setProperties(file);
            });
            var viewerB = {
                load : function(e){
                    $('#previewB').attr('src', e.target.result);
                },
                setProperties : function(file){
                    $('#filenameB').text(file.name);
                    $('#filetypeB').text(file.type);
                    $('#filesizeB').text(Math.round(file.size/1024));
                },
            }

            // End event priview gambar pilihan B

            // Start event priview gambar pilihan C
            $('#fileC').on('change',function () {
                console.log('test');
                var file = this.files[0];
                var reader = new FileReader();
                reader.onload = viewerC.load;
                reader.readAsDataURL(file);
                viewerC.setProperties(file);
            });
            var viewerC = {
                load : function(e){
                    $('#previewC').attr('src', e.target.result);
                },
                setProperties : function(file){
                    $('#filenameC').text(file.name);
                    $('#filetypeC').text(file.type);
                    $('#filesizeC').text(Math.round(file.size/1024));
                },
            }

            // End event priview gambar pilihan C

            // Start event priview gambar pilihan D
            $('#fileD').on('change',function () {
                console.log('test');
                var file = this.files[0];
                var reader = new FileReader();
                reader.onload = viewerD.load;
                reader.readAsDataURL(file);
                viewerD.setProperties(file);
            });
            var viewerD = {
                load : function(e){
                    $('#previewD').attr('src', e.target.result);
                },
                setProperties : function(file){
                    $('#filenameD').text(file.name);
                    $('#filetypeD').text(file.type);
                    $('#filesizeD').text(Math.round(file.size/1024));
                },
            }

            // End event priview gambar pilihan D

            // Start event priview gambar pilihan E
            $('#fileE').on('change',function () {
                console.log('test');
                var file = this.files[0];
                var reader = new FileReader();
                reader.onload = viewerE.load;
                reader.readAsDataURL(file);
                viewerE.setProperties(file);
            });
            var viewerE = {
                load : function(e){
                    $('#previewE').attr('src', e.target.result);
                },
                setProperties : function(file){
                    $('#filenameE').text(file.name);
                    $('#filetypeE').text(file.type);
                    $('#filesizeE').text(Math.round(file.size/1024));
                },
            }

            // End event priview gambar pilihan E

        });
    </script>
     <!-- End script untuk priview gambar soal -->
<!-- start script js validation extension -->
<script type="text/javascript">
 var _validFileExtensions = [".doc", ".docx", ".ppt", ".pptx", ".pdf"];    
function ValidateSingleInput(oInput) {
    if (oInput.type == "file") {
        var sFileName = oInput.value;
         if (sFileName.length > 0) {
            var blnValid = false;
            for (var j = 0; j < _validFileExtensions.length; j++) {
                var sCurExtension = _validFileExtensions[j];
                if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                    blnValid = true;
                    break;
                }
            }
             
            if (!blnValid) {
             $('#warningupload').modal('show');
                // alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                // oInput.value = "";
                return false;
            }
        }
    }
    return true;
}
</script>
<!-- END -->
   <!--Start  Script drop down depeden -->

<script>

    // Script for getting the dynamic values from database using jQuery and AJAX

    $(document).ready(function () {

        $('#eTingkat').change(function () {

            var form_data = {

                name: $('#eTingkat').val()

            };

            $.ajax({

                url: "<?php echo site_url('videoback/getPelajaran'); ?>",

                type: 'POST',
                dataType: "json",
                data: form_data,

                success: function (msg) {

                    var sc = '';

                    $.each(msg, function (key, val) {

                        sc += '<option value="' + val.id + '">' + val.keterangan + '</option>';

                    });

                    $("#ePelajaran option").remove();

                    $("#ePelajaran").append(sc);

                }

            });

        });

        // Strat  event untuk pilihan jenis input  

        $("#up_server").click(function () {

            $(".server").show();

            $(".link").hide();

        });

        $("#up_link").click(function () {

            $(".link").show();

            $(".server").hide();

            $(".prv_video").hide();

        });

        $("#file").click(function () {

            $(".prv_video").show();

        });



    });




    //buat load tingkat

    function loadTingkat() {

        jQuery(document).ready(function () {
            var oldtkt = $('#oldtkt').val();
            var tingkat_id = {"tingkat_id": $('#tingkat').val()};

            var idTingkat;

            $.ajax({

                type: "POST",
                dataType: "json",
                data: tingkat_id,

                url: "<?= base_url() ?>index.php/videoback/getTingkat",

                success: function (data) {


                    $('#tingkat').html('<option value="">-- Pilih Tingkat  --</option>');

                    $.each(data, function (i, data) {

                      if (data.id==oldtkt) {
                         $('#tingkat').append("<option value='" + data.id + "' selected>" + data.aliasTingkat + "</option>");
                      } else {
                        $('#tingkat').append("<option value='" + data.id + "'>" + data.aliasTingkat + "</option>");
                      }
                       
                        

                        return idTingkat = data.id;

                    });

                }

            });



            $('#tingkat').change(function () {

                tingkat_id = {"tingkat_id": $('#tingkat').val()};

                loadPelajaran($('#tingkat').val());

            })



            $('#pelajaran').change(function () {

                pelajaran_id = {"pelajaran_id": $('#pelajaran').val()};

                load_bab($('#pelajaran').val());

            })

        })

    }

    ;



    //buat load pelajaran

    function loadPelajaran(tingkatID) {
        var oldmp = $('#oldmp').val();
        $.ajax({

            type: "POST",
            dataType: "json",
            data: tingkatID.tingkat_id,

            url: "<?php echo base_url() ?>index.php/videoback/getPelajaran/" + tingkatID,

            success: function (data) {

                $('#pelajaran').html('<option value="">-- Pilih Mata Pelajaran  --</option>');

                $.each(data, function (i, data) {
                    if (data.id == oldmp ) {
                      $('#pelajaran').append("<option value='" + data.id + "' selected>" + data.keterangan + "</option>");
                    } else {
                      $('#pelajaran').append("<option value='" + data.id + "'>" + data.keterangan + "</option>");
                    }
                    

                });

            }

        });

    }

    //buat load bab

    
    





    loadTingkat();

</script>
<!--END Script drop down depeden  -->
    


</section>
        <!--/ END Template Main