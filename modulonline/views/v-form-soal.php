 <!-- START Template Main -->

<section id="main" role="main">
        <script type="text/javascript" src="<?= base_url('assets/library/jquery/js/preview.js') ?>"></script>

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
        <h3 class="text-center">Silahkan cek type extension file! </h3>
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

                <form class="form-horizontal form-bordered panel panel-teal" action="<?=base_url()?>index.php/modulonline/uploadmodul" method="post" accept-charset="utf-8" enctype="multipart/form-data" >

                    <div class="panel-heading">

                        <h3 class="panel-title">Form Upload Modul</h3>

                        <!-- untuk menampung bab id -->

                        <!-- <input type="text" name="subBabID" value="<?=$subBab;?>"  hidden="true"> -->

                    </div>               

                    <div class="panel-body">
                      <!-- Start Dropd Down depeden -->
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
            
                      <!-- END Drop Down depeden -->

                        <div class="form-group">

                            <label class="control-label col-sm-2">Judul Modul</label>

                            <div class="col-sm-10">

                                <input type="text" name="judul" class="form-control" value="<?php echo set_value('judul'); ?>" required="true">

                            </div>

                            

                        </div>

                        <div class="form-group">

                            <label class="control-label col-sm-2">Deskripsi Modul</label>

                            <!-- Start input text A -->

                            <div class="col-sm-10 piltext">

                               <textarea name="deskripsi"  class="form-control"> </textarea>

                            </div>

                          </div>

                         <div class="form-group">

                            <label class="control-label col-sm-2">File Modul</label>

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

                                    <label for="fileSoal" class="btn btn-sm btn-default">

                                        Pilih File

                                    </label>

                                    <input style="display:none;" type="file" id="fileSoal" name="gambarSoal" onchange="ValidateSingleInput(this);"/>

                                </div>

                            </div>

                        </div>

                        

                        <div class="form-group">
                           <label class="control-label col-sm-2">Publish File</label>

                            <div class="col-sm-3">

                                <div class="checkbox custom-checkbox">  

                                    <input type="checkbox" name="publish" id="gift" value="1">  

                                    <label for="gift"><small>&nbsp;&nbsp;Check = Yes</small></label>   
                                </div>
                            </div>
                        </div>                       
                    </div>

       

                    <div class="panel-footer">

                        <div class="col-sm-1 col-sm-offset-2 ">

                            <button type="submit" class="btn btn-primary">Simpan</button>

                        </div>

                        

                    </div>

                </form>

                <!--/ Form horizontal layout bordered -->

            </div>



        </div>

        <!--/ END row -->

    </div>

<!-- start script js validation extension -->
<script type="text/javascript">
// validasi upload gambar 
function ValidateSingleInput(oInput) {
  var _validFileExtensions = [".doc", ".docx", ".ppt", ".pptx", ".pdf"]; 
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
// validation upload video
    
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


        // Start Eveb Show Hide Form Pembahasan
        $("#show-pembahasan").click(function(){
           $(".pembahasan").show();
        });
        $("#hide-pembahasan").click(function(){
           $(".pembahasan").hide();
        });

        $("#m-tex").click(function(){
           $(".vido").hide();
           $(".tex").show();

           $(".link").hide();
            $(".server").hide();
            $(".prv_video").hide();
        });
        $("#m-vido").click(function(){
           $(".tex").hide();
           $(".vido").show();
            $(".server").show();

            
        });
        // End Even Show Hide Form Pembahasan



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
    loadTingkat();

</script>
<!--END Script drop down depeden  -->
 

    <!-- Start script untuk priview gambar soal -->

    <script type="text/javascript">

        $(function () {



            // Start event priview gambar Soal

            $('#fileSoal').on('change',function () {

                var file = this.files[0];

                var reader = new FileReader();

                reader.onload = viewerSoal.load;

                reader.readAsDataURL(file);

                viewerSoal.setProperties(file);

            });

            var viewerSoal = {

                load : function(e){

                    // $('#previewSoal').attr('src', e.target.result);

                },

                setProperties : function(file){

                    $('#filenameSoal').text(file.name);

                    $('#filetypeSoal').text(file.type);

                    $('#filesizeSoal').text(Math.round(file.size/1024));

                },

            }

            // End event priview gambar Soal

            // Start event priview gambar Pembahasan

            $('#filePembahasan').on('change',function () {

              console.log('pembahasan');
                var file = this.files[0];

                var reader = new FileReader();

                reader.onload = viewerPembahasan.load;

                reader.readAsDataURL(file);

                viewerPembahasan.setProperties(file);

            });

            var viewerPembahasan = {

                load : function(e){

                    $('#previewPembahasan').attr('src', e.target.result);

                },

                setProperties : function(file){

                    $('#filenamePembahasan').text(file.name);

                    $('#filetypePembahasan').text(file.type);

                    $('#filesizePembahasan').text(Math.round(file.size/1024));

                },

            }

            // End event priview gambar Soal
        });

    </script>

     <!-- End script untuk priview gambar soal -->
</section>


        <!--/ END Template Main -->