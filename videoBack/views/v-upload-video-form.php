

<!-- konten -->
<section id="main" role="main" class="mt10">
    <!-- js untuk progres bar file yg di upload -->
    <script type="text/javascript" src="<?= base_url('assets/library/jquery/js/upbar.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/library/jquery/js/jequery.form.js') ?>"></script>
    <!-- Start Modal salah upload video -->
    <div class="modal fade" id="warningupload" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h2 class="modal-title text-center text-danger">Peringatan</h2>
        </div>
        <div class="modal-body">
            <h3 class="text-center">Silahkan cek type extension video!</h3>
            <h5 class="text-center">Type yang bisa di upload hanya .mp4</h5>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Start Modal salah upload file size video -->
<div class="modal fade" id="e_size_video" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h2 class="modal-title text-center text-danger">Peringatan</h2>
    </div>
    <div class="modal-body">
        <h3 class="text-center">Silahkan cek file size video!</h3>
        <h5 class="text-center">File size video maksimal 90Mb</h5>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="col-md-12">

    <!-- START Form panel -->

    <form  class="panel panel-teal form-horizontal form-bordered upload-video" action="<?= base_url() ?>index.php/videoback/cek_option_upload" method="post" accept-charset="utf-8" enctype="multipart/form-data">
        <div class="panel-heading"><h5 class="panel-title">Upload Video</h5>
        </div>
        <div class="form-group message-container">
        </div><!-- will be use as done/fail message container -->
        <div  class="form-group">
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

        <div class="form-group">
            <label class="col-sm-1 control-label">Bab</label>
            <div class="col-sm-4">
                <select class="form-control" name="bab" id="bab">

                </select>
            </div>

            <label class="col-sm-2 control-label">Subab</label>
            <div class="col-sm-4">
                <select class="form-control" name="subBab" id="subbab">

                </select>
                <span class="text-danger"><?php echo form_error('subBab'); ?></span>
            </div>
        </div>

        <!-- pilih option upload video -->
        <div class="form-group">
            <label class="control-label col-sm-2">Pilihan Upload Video</label>
            <div class="col-sm-8">
                <div class="btn-group" data-toggle="buttons" >
                    <label class="btn btn-teal btn-outline active" id="up_server">
                        <input type="radio" name="option_up" value="server" autocomplete="off" checked="true"> Upload Video Ke server
                    </label>
                    <label class="btn btn-teal btn-outline " id="up_link">
                        <input type="radio" name="option_up"  value="link" autocomplete="off" > Link
                    </label>
                </div>
            </div>
        </div>
        <!-- untuk preview video -->
        <div  class="form-group prv_video" hidden="true">
            <div class="row" style="margin:1%;"> 
                <div class="col-md-12">
                    <video id="preview" class="img-tumbnail image"  src="" width="100%" height="50%" controls >

                    </video>
                </div>
                <div class="col-md-5 left"> 
                    <h6>Name: <span id="filename"></span></h6> 
                </div> 
                <div class="col-md-4 left"> 
                    <h6>Size: <span id="filesize"></span>Kb</h6> 
                </div> 
                <div class="col-md-3 bottom"> 
                    <h6>Type: <span id="filetype"></span></h6> 
                </div>
            </div>
        </div>
        <div class="form-group server" hidden="false">
            <div class="col-md-11 bottom">		
                <progress id="prog" max="100" value="0" style="display:none;"></progress>
            </div>
        </div> 
        <!-- upload ke server -->
        <div id="upload" class="form-group server">
            <label class="col-sm-2 control-label">File Video</label>
            <div class="col-sm-4">
                <label for="file" class="btn btn-sm btn-default">

                    Pilih Video

                </label>
                <input style="display:none;" type="file" id="file" name="video" onchange="ValidateSingleInput(this);"/>
                <!-- <span class="col-sm-12 text-danger"><?php echo form_error('video'); ?></span> -->
            </div>
        </div>
        <!-- prev thumbnail -->
        <div  class="form-group prv_thumbnail" hidden="true">
            <div class="row" style="margin:1%;"> 
                <div class="col-md-12">
                    <img id="prevthumbnail" class="img-tumbnail image" src="" width="25%"  >
                </div>
                <div class="col-md-5 left"> 
                    <h6>Name: <span id="namethumbnail"></span></h6> 
                </div> 
                <div class="col-md-4 left"> 
                    <h6>Size: <span id="sizethumbnail"></span>Kb</h6> 
                </div> 
                <div class="col-md-3 bottom"> 
                    <h6>Type: <span id="typethumbnail"></span></h6> 
                </div>
            </div>
        </div>
        <!--/ prev thumbnail -->
        <!-- Upload thumbnail -->
        <div class="form-group server">
           <label class="col-sm-2 control-label">Thumbnail</label>
            <div class="col-sm-4">
                <label for="thumbnail" class="btn btn-sm btn-default">
                    Pilih gambar
                </label>
                <input style="display:none;" type="file" id="thumbnail" name="thumbnail" onchange="Validatethumbnail(this);"/>
            </div>
        </div>
         <!-- /Upload thumbnail -->
        <!-- upload video by link -->
        <div class="form-group link" hidden="true">
            <label class="col-sm-2 control-label">Link Video</label>
            <div class="col-sm-4">
                <input class="form-control" type="text" name="link_video">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2">Jenis Video</label>
            <div class="col-sm-4">
                <select name="jenis_video" class="form-control" required>
                    <option value="" selected>-Pilih Jenis Video-</option>
                    <option value="1">Room Recording</option>
                    <option value="2">Screen Recording</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Judul Video</label>
            <div class="col-sm-9">
                <input type="text" name="judulvideo" class="form-control">
                <span class="text-danger"><?php echo form_error('judulvideo'); ?></span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Deskripsi Video</label>
            <div class="col-sm-9">
                <textarea class="form-control" name="deskripsi"></textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2">Publish</label>
            <div class="col-sm-4">
                <select name="publish" class="form-control">
                    <option value="0" selected>Select</option>
                    <option value="0">Tidak</option>
                    <option value="1">Ya</option>
                </select>
            </div>
        </div>

        <div class="panel-footer">
            <div class="col-md-2 ">
                <button type="reset" class="btn btn-danger">Reset</button>
                <button type="submit" class="btn btn-primary ladda-button" data-style="zoom-in">Submit</button>
            </div>

            <div class="col-md-4"><br><br>
                <div class="indicator show">
                  <!-- <span class="spinner"></span> -->
                  <div class="progress progress-striped active">
                      <div class="progress-bar progress-bar-success" style="width: 0%" id="ProgressBarDownload">
                          <span class="sr-only">100% Complete (success)</span>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </form>
  <!--/ END Form panel -->
</div>
</section>



<!-- PROGRES BAR -->
<script src="http://malsup.github.com/jquery.form.js"></script>

<!-- SCRIPT UNTUK PROGRESS BAR -->
<script>
    (function() {
        var bar = $('#ProgressBarDownload');
        var status = $('#status');
        $('.upload-video').ajaxForm({
            beforeSend: function() {
                status.empty();
                var percentVal = '0%';
                bar.width(percentVal)
            },
            uploadProgress: function(event, position, total, percentComplete) {
                var percentVal = percentComplete + '%';
                bar.width(percentVal)
            },
            success: function() {
                var percentVal = '100%';
                bar.width(percentVal);
                swal({
                  title: "Upload selesai",
                  text: "Upload lagi atau selesai?",
                  type: "success",
                  showCancelButton: true,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "Upload Lagi",
                  cancelButtonText: "Selesai Upload",
                  closeOnConfirm: false,
                  closeOnCancel: false
              },
              function(isConfirm){
                  if (isConfirm) {
                   location.reload();
               } else {
                window.location = base_url+"videoback/daftarvideo"
            }
        });
            },
            complete: function(xhr) {
                status.html(xhr.responseText);
            }
        }); 

    })();       
</script>
<!-- ## PROGRES BAR -->

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

        $("#thumbnail").click(function () {

            $(".prv_thumbnail").show();

        });



    });





    //buat load tingkat

    function loadTingkat() {

        jQuery(document).ready(function () {
            var tingkat_id = {"tingkat_id": $('#tingkat').val()};
            var idTingkat;
            $.ajax({

                type: "POST",
                dataType: "json",
                data: tingkat_id,
                
                url: "<?= base_url() ?>index.php/videoback/getTingkat",

                success: function (data) {

                    console.log("Data" + data);

                    $('#tingkat').html('<option value="">-- Pilih Tingkat  --</option>');

                    $.each(data, function (i, data) {

                        $('#tingkat').append("<option value='" + data.id + "'>" + data.aliasTingkat + "</option>");

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



            $('#bab').change(function () {

                load_sub_bab($('#bab').val());

            })

        })

    }

    ;



    //buat load pelajaran

    function loadPelajaran(tingkatID) {

        $.ajax({

            type: "POST",
            dataType: "json",

            data: tingkatID.tingkat_id,

            url: "<?php echo base_url() ?>index.php/videoback/getPelajaran/" + tingkatID,

            success: function (data) {

                $('#pelajaran').html('<option value="">-- Pilih Mata Pelajaran  --</option>');

                $.each(data, function (i, data) {

                    $('#pelajaran').append("<option value='" + data.id + "'>" + data.keterangan + "</option>");

                });

            }

        });

    }

    //buat load bab

    function load_bab(mapelID) {

        $.ajax({

            type: "POST",
            dataType: "json",
            data: mapelID.mapel_id,

            url: "<?php echo base_url() ?>index.php/videoback/getBab/" + mapelID,

            success: function (data) {
                $('#bab').html('<option value="">-- Pilih Bab Pelajaran  --</option>');
                $.each(data, function (i, data) {
                    $('#bab').append("<option value='" + data.id + "'>" + data.judulBab + "</option>");
                });

            }



        });

    }

    //load sub bab

    function load_sub_bab(babID) {

        $.ajax({

            type: "POST",
            dataType: "json",
            data: babID.bab_id,

            url: "<?php echo base_url() ?>index.php/videoback/getSubbab/" + babID,

            success: function (data) {

                $('#subbab').html('<option value="">-- Pilih Sub Bab Pelajaran  --</option>');

                console.log(data);

                $.each(data, function (i, data) {

                    $('#subbab').append("<option value='" + data.id + "'>" + data.judulSubBab + "</option>");

                });

            }
        });
    }
    loadTingkat();

</script>

<!-- start script js validation extension -->
<script type="text/javascript">
    $(function () {
        $('#file').on('change',function () {
            var file = this.files[0];
            var reader = new FileReader();
            var size=Math.round(file.size/1024);
        // start pengecekan ukuran file
        if (size>=90000) {
            $('#e_size_video').modal('show');
            $('.prv_video').hide();
        }else{
            reader.onload = viewer.load;
            reader.readAsDataURL(file);
            viewer.setProperties(file);
        }
        
    });
        var viewer = {
            load : function(e){
                $('#preview').attr('src', e.target.result);
            },
            setProperties : function(file){
                $('#filename').text(file.name);
                $('#filetype').text(file.type);
                $('#filesize').text(Math.round(file.size/1024));
            },
        }
    });

    // prev Thumbnail 
        $(function () {
        $('#thumbnail').on('change',function () {
            var file = this.files[0];
            var reader = new FileReader();
            var size=Math.round(file.size/1024);
        // start pengecekan ukuran file
        if (size>=90000) {
            // $('#e_size_video').modal('show');
            $('.prv_thumbnail').hide();
        }else{
            reader.onload = viewer.load;
            reader.readAsDataURL(file);
            viewer.setProperties(file);
        }
        
    });
        var viewer = {
            load : function(e){
                $('#prevthumbnail').attr('src', e.target.result);
            },
            setProperties : function(file){
                $('#namethumbnail').text(file.name);
                $('#typethumbnail').text(file.type);
                $('#sizethumbnail').text(Math.round(file.size/1024));
            },
        }
    });



    var _validFileExtensions = [".mp4"];    
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
                    resetVideo();
                    $('.prv_video').hide();
                // alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                // oInput.value = "";
                return false;
            }
        }
    }
    return true;
}
function resetVideo(){
  $("input[name=video]").val("");
  $('#previewAudio').attr('src', "");
  $('#filename').text("");
  $('#filetype').text("");
  $('#filesize').text("");
}
</script>
<!-- END -->