 <!-- START Template Main -->

 <section id="main" role="main">

  <!-- START Template Container -->
  <script type="text/javascript" src="<?= base_url('assets/plugins/ckeditor/ckeditor.js') ?>"></script>
  <!--js buat menampilakan priview video sebelum di upload  -->
  <script type="text/javascript" src="<?= base_url('assets/javascript/components/button.js') ?>"></script>


  <script type="text/x-mathjax-config">
    MathJax.Hub.Config({tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]}});
  </script>
  <script type="text/javascript" async
  src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS_CHTML">
</script>
<!-- <script type="text/javascript" src="<?= base_url('assets/plugins/MathJax-master/MathJax.js?config=TeX-MML-AM_HTMLorMML') ?>"></script> -->
<script src="//cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-MML-AM_HTMLorMML-full"></script>

<script type="text/javascript" src="<?= base_url('assets/library/jquery/js/preview.js') ?>"></script>
<!-- Script priview mathjax form input buat rumus-->
<script>
  var Preview = {
  delay: 150,        // delay after keystroke before updating

  preview: null,     // filled in by Init below
  buffer: null,      // filled in by Init below

  timeout: null,     // store setTimout id
  mjRunning: false,  // true when MathJax is processing
  mjPending: false,  // true when a typeset has been queued
  oldText: null,     // used to check if an update is needed

  //
  //  Get the preview and buffer DIV's
  //
  Init: function () {
    this.preview = document.getElementById("MathPreview");
    this.buffer = document.getElementById("MathBuffer");
  },

  //
  //  Switch the buffer and preview, and display the right one.
  //  (We use visibility:hidden rather than display:none since
  //  the results of running MathJax are more accurate that way.)
  //
  SwapBuffers: function () {
    var buffer = this.preview, preview = this.buffer;
    this.buffer = buffer; this.preview = preview;
    buffer.style.visibility = "hidden"; buffer.style.position = "absolute";
    preview.style.position = ""; preview.style.visibility = "";
  },

  //
  //  This gets called when a key is pressed in the textarea.
  //  We check if there is already a pending update and clear it if so.
  //  Then set up an update to occur after a small delay (so if more keys
  //    are pressed, the update won't occur until after there has been 
  //    a pause in the typing).
  //  The callback function is set up below, after the Preview object is set up.
  //
  Update: function () {
    if (this.timeout) {clearTimeout(this.timeout)}
      this.timeout = setTimeout(this.callback,this.delay);
  },

  //
  //  Creates the preview and runs MathJax on it.
  //  If MathJax is already trying to render the code, return
  //  If the text hasn't changed, return
  //  Otherwise, indicate that MathJax is running, and start the
  //    typesetting.  After it is done, call PreviewDone.
  //  
  CreatePreview: function () {
    Preview.timeout = null;
    if (this.mjPending) return;
    var text = document.getElementById("MathInput").value;
    if (text === this.oldtext) return;
    if (this.mjRunning) {
      this.mjPending = true;
      MathJax.Hub.Queue(["CreatePreview",this]);
    } else {
      this.buffer.innerHTML = this.oldtext = text;
      this.mjRunning = true;
      MathJax.Hub.Queue(
       ["Typeset",MathJax.Hub,this.buffer],
       ["PreviewDone",this]
       );
    }
  },

  //
  //  Indicate that MathJax is no longer running,
  //  and swap the buffers to show the results.
  //
  PreviewDone: function () {
    this.mjRunning = this.mjPending = false;
    this.SwapBuffers();
  }

};

//
//  Cache a callback to the CreatePreview action
//
Preview.callback = MathJax.Callback(["CreatePreview",Preview]);
Preview.callback.autoReset = true;  // make sure it can run more than once

</script> 
<!--END Script priview mathjax form input buat rumus-->
<!-- Script priview mathjax untuk priview soal-->
<script>
  var Preview2 = {
  delay: 150,        // delay after keystroke before updating

  preview: null,     // filled in by Init below
  buffer: null,      // filled in by Init below

  timeout: null,     // store setTimout id
  mjRunning: false,  // true when MathJax is processing
  mjPending: false,  // true when a typeset has been queued
  oldText: null,     // used to check if an update is needed

  //
  //  Get the preview and buffer DIV's
  //
  Init: function () {
    this.preview = document.getElementById("MathPreview2");
    this.buffer = document.getElementById("MathBuffer2");
  },

  //
  //  Switch the buffer and preview, and display the right one.
  //  (We use visibility:hidden rather than display:none since
  //  the results of running MathJax are more accurate that way.)
  //
  SwapBuffers: function () {
    var buffer = this.preview, preview = this.buffer;
    this.buffer = buffer; this.preview = preview;
    buffer.style.visibility = "hidden"; buffer.style.position = "absolute";
    preview.style.position = ""; preview.style.visibility = "";
  },

  //
  //  This gets called when a key is pressed in the textarea.
  //  We check if there is already a pending update and clear it if so.
  //  Then set up an update to occur after a small delay (so if more keys
  //    are pressed, the update won't occur until after there has been 
  //    a pause in the typing).
  //  The callback function is set up below, after the Preview object is set up.
  //
  Update: function () {
    if (this.timeout) {clearTimeout(this.timeout)}
      this.timeout = setTimeout(this.callback,this.delay);
  },

  //
  //  Creates the preview and runs MathJax on it.
  //  If MathJax is already trying to render the code, return
  //  If the text hasn't changed, return
  //  Otherwise, indicate that MathJax is running, and start the
  //    typesetting.  After it is done, call PreviewDone.
  //  
  CreatePreview: function () {
    Preview2.timeout = null;
    if (this.mjPending) return;
    var text = CKEDITOR.instances.editor1.getData();
    // console.log(text);
    if (text === this.oldtext) return;
    if (this.mjRunning) {
      this.mjPending = true;
      MathJax.Hub.Queue(["CreatePreview",this]);
    } else {
      this.buffer.innerHTML = this.oldtext = text;
      this.mjRunning = true;
      MathJax.Hub.Queue(
        ["Typeset",MathJax.Hub,this.buffer],
        ["PreviewDone",this]
        );
    }
  },

  //
  //  Indicate that MathJax is no longer running,
  //  and swap the buffers to show the results.
  //
  PreviewDone: function () {
    this.mjRunning = this.mjPending = false;
    this.SwapBuffers();
  }

};

//
//  Cache a callback to the CreatePreview action
//
Preview2.callback = MathJax.Callback(["CreatePreview",Preview2]);
Preview2.callback.autoReset = true;  // make sure it can run more than once

</script>
<!-- Script priview mathjax untuk priview soal -->
<!-- END Script Matjax -->

<div class="container-fluid">
  <!-- Priview -->
  <div class="modal fade " id="modalpriview" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">

     <!-- Start Panel Priview -->
     <div class="panel panel-teal">
      <!-- Start heading -->
      <div class="panel-heading ">
        <div class="panel-toolbar">
         <h4 class="modal-title ">Priview Soal</h4>
       </div>
       <div class="panel-toolbar text-right">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       </div>
     </div>
     <!-- End heading -->
     <!-- Start body priview -->
     <div class="panel-body ">
      <!-- prev audio di modal -->
      <div class="hidden-audio" hidden="true">
       <audio class="col-sm-12 " id="prevAudio" src="" type="audio/mpeg" controls>voiv</audio>
     </div>
     <hr>
     <label class="">Sumber :</label> <a id="prevSumber"  ></a> <br>
     <label> judul  :</label> <a id="prevJudul" ></a> <br>
     <label>Soal   : </label>

     <!-- img -->
     <div class="col-sm-12">
      <img id="previewSoal2" style="max-width: 200px; max-height: 125px;  " class="img" src="" alt="" />
    </div>
    <!-- img -->
    <div class="prevSoal col-sm-12">
      <div class="a" id="MathPreview2" ></div>
      <div class="a" id="MathBuffer2" style=" 
      visibility:hidden; position:absolute; top:0; left: 0"></div>
    </div>
          <!-- <script>
      Preview2.Init();
    </script> -->
    <!-- pilihan jawaban -->
    <div class="col-sm-12">
      <ol type="A">
        <li id="a"></li>
        <li id="b"></li>
        <li id="c"></li>
        <li id="d"></li>
        <li id="e"></li>
      </ol>
    </div>
    <!-- jawaban -->
    <div class="col-sm-12"> 
      <label>Jawaban : </label> <a id="prevJawaban"></a>
    </div>

  </div>
  <!-- END body priview -->

  <!-- Start footer priview -->
  <div class="panel-footer hidden-xs">
   <button type="submit" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Keluar</button>
 </div>
 <!-- end footer priview -->

</div>
<!-- END panel Priview -->

</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Priew -->

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
        <h5 class="text-center">Type yang bisa di upload hanya ".jpg", ".jpeg", ".bmp", ".gif", ".png"</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Start Modal salah upload video -->
<div class="modal fade" id="warningupload2" tabindex="-1" role="dialog">
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
        <button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Start Modal salah upload size img -->
<div class="modal fade" id="e_size_img" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h2 class="modal-title text-center text-danger">Peringatan</h2>
      </div>
      <div class="modal-body">
        <h3 class="text-center">Silahkan cek file size Gambar!</h3>
        <h5 class="text-center">File size audio maksimal 100kb</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Start Modal salah upload audio -->
<div class="modal fade" id="warning-upload-audio" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h2 class="modal-title text-center text-danger">Peringatan</h2>
      </div>
      <div class="modal-body">
        <h3 class="text-center">Silahkan cek type extension Audio!</h3>
        <h5 class="text-center">Type yang bisa di upload hanya .mp3</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Start Modal salah upload size audio -->
<div class="modal fade" id="e_size_audio" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h2 class="modal-title text-center text-danger">Peringatan</h2>
      </div>
      <div class="modal-body">
        <h3 class="text-center">Silahkan cek file size Audio!</h3>
        <h5 class="text-center">File size audio maksimal 50Mb</h5>
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
<!-- START row -->
<div class="row">
  <div class="col-md-12">
    <!-- Form horizontal layout bordered -->
    <form class="form-horizontal form-bordered panel panel-teal form-tambahsoal" action="<?=base_url()?>index.php/banksoal/uploadsoal" method="post" accept-charset="utf-8" enctype="multipart/form-data" >
      <!-- <form class="form-horizontal form-bordered panel panel-teal form-tambahsoal" id="form_soal" action="" method="post" accept-charset="utf-8" enctype="multipart/form-data" > -->

      <div class="panel-heading">
        <h3 class="panel-title">Form Soal</h3>
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

        <div class="form-group">
          <label class="col-sm-1 control-label">Bab</label>
          <div class="col-sm-4">
            <select class="form-control" name="bab" id="bab">

            </select>
          </div>
          <label class="col-sm-2 control-label">Subab</label>
          <div class="col-sm-4">
            <select class="form-control" name="subBabID" id="subbab">

            </select>
            <span class="text-danger"><?php echo form_error('subBab'); ?></span>
          </div>
        </div>
        <!-- END Drop Down depeden -->

        <div class="form-group">
          <label class="control-label col-sm-2">Judul Soal</label>
          <div class="col-sm-8">
            <input type="text" name="judul" class="form-control" value="<?php echo set_value('judul'); ?>" required="true">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2 ">Kesulitan</label>
          <div class="col-sm-8">
            <select name="kesulitan" class="form-control">
              <option value="">--Silahkan Pilih Tingkat Kesulitan--</option>
              <option value="0">Mudah</option>
              <option value="1">Sedang</option>
              <option value="2">Sulit</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2">Sumber</label>
          <div class="col-sm-8">
            <input type="text" name="sumber" class="form-control" id="sumberp" >
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2">Audio</label>
          <div class="col-sm-8">
            <div class="col-sm-12 hidden-audio " hidden="true"> 
              <div class="col-md-5 left"> 
                <h6>Name: <span id="filenameAudio"></span></h6> 
              </div> 
              <div class="col-md-4 left"> 
                <h6>Size: <span id="filesizeAudio"></span>Kb</h6> 
              </div> 
              <div class="col-md-3 bottom"> 
                <h6>Type: <span id="filetypeAudio"></span></h6> 
              </div>
            </div>
            <div class="col-sm-12 hidden-audio" hidden="true">
              <audio class="col-sm-12" id="previewAudio" src="" type="audio/mpeg" controls >
              </audio>
            </div>
            <div class="col-sm-6 mt10">
              <label for="fileAudio" class="btn btn-sm btn-default">
                Pilih Audio
              </label>
              <input  id="fileAudio" style="display:none;" type="file" name="listening" onchange="ValidateAudioInput(this);">
              <label class="btn btn-sm btn-danger"  onclick="restAudioSoal()">Reset</label>
            </div>

          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2">Gambar Soal</label>
          <div class="col-sm-8 " >
            <div class="col-sm-12">
              <img id="previewSoal" style="max-width: 497px; max-height: 381px;  " class="img" src="" alt="" />
            </div>    
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
            <div class="col-sm-6">
              <label for="fileSoal" class="btn btn-sm btn-default">
                Pilih Gambar
              </label>
              <input style="display:none;" type="file" id="fileSoal" name="gambarSoal" onchange="ValidateSingleInput(this);"/>
              <label class="btn btn-sm btn-danger"  onclick="restImgSoal()">Reset</label>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2">Jenis Editor </label>
          <div class="col-sm-8">
            <div class="btn-group" data-toggle="buttons" >
              <label class="btn btn-teal btn-outline active " id="in-soal">
                <input type="radio" autocomplete="off" checked="true"> Input Soal
              </label>
              <label class="btn btn-teal btn-outline" id="pr-rumus">
                <input type="radio"   autocomplete="off"> Rumus Matematika
              </label>
            </div>
          </div>
        </div>

        <div class="form-group">
         <!-- Start Editor Soal -->
         <div id="editor-soal">
          <label class="control-label col-sm-2">Soal</label>
          <div class="col-sm-10">
           <textarea class="editor1 " name="editor1" id="editor1" cols="60" rows="10"  ></textarea>
         </div>
       </div>
       <!-- End Editor Soal -->
       <!-- Start Math jax -->
       <div id="editor-rumus" hidden="true">
        <label class="control-label col-sm-2">Buat rumus</label>
        <div class="col-sm-10">
         <textarea class="form-control " id="MathInput" cols="60" rows="10" onkeyup ="Preview.Update()" ></textarea>
       </div>
       <label class="control-label col-sm-2"></label>
       <div class="col-sm-10">
         <p>
           Configured delimiters:
           <ul>
             <li>TeX, inline mode: <code>\(...\)</code> or <code>$...$</code></li>
             <li>TeX, display mode: <code>\[...\]</code> or <code> $$...$$</code></li>
             <li>Asciimath: <code>`...`</code>.</li>
           </ul>
         </p>
       </div>

       <label class="control-label col-sm-2"></label>
       <div class="col-sm-10">
        <label class="control-label" >Preview :</label>
        <textarea class="form-control" id="MathPreview" ></textarea>
        <textarea class="form-control" id="MathBuffer" style=" 
        visibility:hidden; position:absolute; top:0; left: 0" cols="60" rows="10"></textarea>
      </div>
    </div>
    <script>
      Preview.Init();
    </script>
    <script>
      Preview2.Init();
    </script>
    <!-- End MathJax -->
  </div>



  <div class="form-group">
    <label class="control-label col-sm-2">Jumlah Pilihan</label>
    <div class="col-sm-8">
      <div class="btn-group" data-toggle="buttons" >
        <label class="btn btn-teal btn-outline " id="empatpil">
          <input type="radio" name="opjumlah" value="4" autocomplete="off" > 4 Pilihan
        </label>
        <label class="btn btn-teal btn-outline active" id="limapil">
          <input type="radio" name="opjumlah"  value="5" autocomplete="off" checked="true"> 5 Pilihan
        </label>
      </div>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-2">Jenis Pilihan</label>
    <div class="col-sm-8">
      <div class="btn-group" data-toggle="buttons" >
        <label class="btn btn-teal btn-outline active " id="text">
          <input type="radio" name="op-jawaban"  value="text" autocomplete="off" checked="true"> Text
        </label>
        <label class="btn btn-teal btn-outline" id="gambar">
          <input type="radio" name="op-jawaban"  value="gambar" autocomplete="off"> Gambar
        </label>
      </div>
    </div>
  </div>

  <!-- Start input jawaban A -->
  <div class="form-group">
    <label class="control-label col-sm-2">Pilihan A</label>
    <!-- Start input text A -->
    <div class="col-sm-8 piltext">
     <textarea name="a" id="pilA"  class="form-control"></textarea>
   </div>
   <!-- END input text A -->

   <!-- Start input gambar A -->
   <div class="col-sm-8 pilgambar" hidden="true">
    <div class="col-sm-12">
     <img id="previewA" style="max-width: 497px; max-height: 381px;  " class="img" src="" alt="" />
   </div>                                        
   <div class="col-sm-12">
    <div class="col-md-5 left"> 
      <h6>Name: <span id="filenameA"></span></h6> 
    </div> 
    <div class="col-md-4 left"> 
      <h6>Size: <span id="filesizeA"></span>Kb</h6> 
    </div> 

    <div class="col-md-3 bottom"> 
      <h6>Type: <span id="filetypeA"></span></h6> 
    </div>
  </div>

  <div class="col-sm-12">
    <label for="fileA" class="btn btn-sm btn-default">
      Pilih Gambar
    </label>
    <input style="display:none;" type="file" id="fileA" name="gambar1" onchange="ValidateSingleInput(this);"/>
  </div>
</div>
<!-- END input Gambar A -->
</div>
<!-- END input jawaban A -->

<!-- Start input jawaban B -->
<div class="form-group">
  <label class="control-label col-sm-2">Pilihan B</label>
  <!-- Start input text B -->
  <div class="col-sm-8 piltext">
   <textarea name="b" class="form-control"></textarea>
 </div>
 <!-- END input text B -->
 <div class="col-sm-8 pilgambar" hidden="true">
  <div class="col-sm-12">
   <img id="previewB" style="max-width: 497px; max-height: 381px;  " class="img" src="" alt="" width="" />
 </div>                                     

 <div class="col-sm-12">

  <div class="col-md-5 left"> 
    <h6>Name: <span id="filenameB"></span></h6> 
  </div> 
  <div class="col-md-4 left"> 
    <h6>Size: <span id="filesizeB"></span>Kb</h6> 
  </div> 
  <div class="col-md-3 bottom"> 
    <h6>Type: <span id="filetypeB"></span></h6> 
  </div>
</div>
<div class="col-sm-12">

  <label for="fileB" class="btn btn-sm btn-default">

    Pilih Gambar

  </label>

  <input style="display:none;" type="file" id="fileB" name="gambar2" onchange="ValidateSingleInput(this);"/>

</div>

</div>

</div>

<!-- END input jawaban  -->



<!-- Start input jawaban C -->
<div class="form-group">
  <label class="control-label col-sm-2">Pilihan C</label>
  <!-- Start input text C -->
  <div class="col-sm-8 piltext" >
   <textarea name="c" class="form-control"></textarea>
 </div>
 <!-- END input text C -->
 <!-- Start input gambar C -->
 <div class="col-sm-8 pilgambar" hidden="true">
  <div class="col-sm-12">
    <img id="previewC" style="max-width: 497px; max-height: 381px;  " class="img" src="" alt="" width="" />
  </div>                                       
  <div class="col-sm-12">
    <div class="col-md-5 left"> 
      <h6>Name: <span id="filenameC"></span></h6> 
    </div> 
    <div class="col-md-4 left"> 
      <h6>Size: <span id="filesizeC"></span>Kb</h6> 
    </div> 
    <div class="col-md-3 bottom"> 
      <h6>Type: <span id="filetypeC"></span></h6> 
    </div>
  </div>
  <div class="col-sm-12">
    <label for="fileC" class="btn btn-sm btn-default">
      Pilih Gambar
    </label>
    <input style="display:none;" type="file" id="fileC" name="gambar3" onchange="ValidateSingleInput(this);"/>
  </div>
</div>
<!-- END input Gambar C -->                       
</div>
<!-- END input Jawaban C -->

<!-- Start input jawaban D -->
<div class="form-group">
  <label class="control-label col-sm-2">Pilihan D</label>
  <!-- Start input text D -->
  <div class="col-sm-8 piltext" >
   <textarea name="d" class="form-control"></textarea>
 </div>
 <!-- END input text D -->

 <!-- Start input gambar D -->
 <div class="col-sm-8 pilgambar" hidden="true">
  <div class="col-sm-12">
   <img id="previewD" style="max-width: 497px; max-height: 381px;  " class="img" src="" alt="" width="" />
 </div>
 <div class="col-sm-12">
  <div class="col-md-5 left"> 
    <h6>Name: <span id="filenameD"></span></h6> 
  </div> 
  <div class="col-md-4 left"> 
    <h6>Size: <span id="filesizeD"></span>Kb</h6> 
  </div> 
  <div class="col-md-3 bottom"> 
    <h6>Type: <span id="filetypeD"></span></h6> 
  </div>
</div>

<div class="col-sm-12">
  <label for="fileD" class="btn btn-sm btn-default">
    Pilih Gambar
  </label>
  <input style="display:none;" type="file" id="fileD" name="gambar4" onchange="ValidateSingleInput(this);"/>
</div>
</div>
<!-- END input Gambar D -->                       
</div>
<!-- END input Jawaban D -->


<!-- Start input jawaban E -->

<div class="form-group" id="pilihan">

  <label class="control-label col-sm-2">Pilihan E</label>

  <!-- Start input text E -->

  <div class="col-sm-8 piltext" >

   <textarea name="e" class="form-control"></textarea>

 </div>

 <!-- END input text E -->

 <!-- Start input gambar E -->

 <div class="col-sm-8 pilgambar" hidden="true">

  <div class="col-sm-12">

   <img id="previewE" style="max-width: 497px; max-height: 381px;  " class="img" src="" alt="" width="" />

 </div>



 <div class="col-sm-12">

  <div class="col-md-5 left"> 

    <h6>Name: <span id="filenameE"></span></h6> 

  </div> 

  <div class="col-md-4 left"> 

    <h6>Size: <span id="filesizeE"></span>Kb</h6> 

  </div> 

  <div class="col-md-3 bottom"> 

    <h6>Type: <span id="filetypeE"></span></h6> 

  </div>

</div>



<div class="col-sm-12">

  <label for="fileE" class="btn btn-sm btn-default">

    Pilih Gambar

  </label>

  <input style="display:none;" type="file" id="fileE" name="gambar5" onchange="ValidateSingleInput(this);"/>

</div>

</div>

<!-- END input Gambar C -->                       

</div>

<!-- END input Jawaban E -->

<div class="form-group">

  <label class="control-label col-sm-2">Jawaban Benar</label>

  <div class="col-sm-8">

    <select name="jawaban" class="form-control">

      <option value="">--Silahkan Pilih Jawaban Benar--</option>

      <option value="A" >A</option>

      <option value="B" >B</option>

      <option value="C" >C</option>

      <option value="D" >D</option>

      <option value="E" id="pilihanop">E</option>

    </select>

  </div>

</div>

<div class="form-group">

  <div class="col-sm-1 col-sm-offset-4">

    <div class="checkbox custom-checkbox">  

      <input type="checkbox" name="publish" id="gift" value="1">  

      <label for="gift">&nbsp;&nbsp;Publish?</label>   

    </div>

  </div>

  <div class="col-sm-4 col-sm-offset-1">

    <div class="checkbox custom-checkbox">  

      <input type="checkbox" name="random" id="idrand" value="1">  

      <label for="idrand">Random?</label>   

    </div>

  </div>

</div>

<!-- Start button show hide pembahasan -->
<div class="form-group">
 <label class="control-label col-sm-2">Form Pembahasan</label>

 <div class="col-sm-8">
  <div class="btn-group" data-toggle="buttons" >

    <label class="btn btn-inverse btn-outline " id="show-pembahasan">

      <input type="radio" name="oppembahasan" value="4" autocomplete="off" > <i class=" ico-file6"></i> Tampil Form Pembahasan

    </label>

    <label class="btn btn-inverse btn-outline active" id="hide-pembahasan">

      <input type="radio" name="oppembahasan"  value="5" autocomplete="off" checked="true"> <i class="ico-file-remove"></i> Hide

    </label>

  </div>
</div>
</div>
<!-- END button show hide pembahasan -->

<!-- Start Form Pembahsan -->
<div class="form-group pembahasan" hidden="
true">
<!-- Start Penel Pembahasan -->
<div class="panel panel-teal">
  <div class="panel-heading">
    <h3 class="panel-title">Pembahasan</h3>
    <div class="panel-toolbar text-right">


    </div>
  </div>
  <!-- Start Panel Body Pembahasan  -->
  <div class="panel-body ">
    <!-- Start Pilihan Pembahasan  -->
    <div class="form-group">

      <label class="control-label col-sm-2">Media Pembahasan</label>

      <div class="col-sm-8">

        <div class="btn-group" data-toggle="buttons" >

          <label class="btn btn-teal btn-outline active " id="m-tex">

            <input type="radio" name="opmedia" value="text"  autocomplete="off" checked="true"> Text

          </label>

          <!-- di hilangkan dulu untuk sementara -->
          <label class="btn btn-teal btn-outline" id="m-vido">

            <input type="radio" name="opmedia" value="video" autocomplete="off"> Video

          </label>

        </div>

      </div>

    </div>
    <!-- End Pilihan Pembahasan-->

    <!-- Start Upload Gambar Pembahasan -->
    <div class="form-group tex">

      <label class="control-label col-sm-2">Gambar Pembahasan</label>

      <div class="col-sm-8 " >

        <div class="col-sm-12">

         <img id="previewPembahasan" style="max-width: 497px; max-height: 381px;  " class="img" src="" alt="" />

       </div>



       <div class="col-sm-12">

        <div class="col-md-5 left"> 

          <h6>Name: <span id="filenamePembahasan"></span></h6> 

        </div> 

        <div class="col-md-4 left"> 

          <h6>Size: <span id="filesizePembahasan"></span>Kb</h6> 

        </div> 

        <div class="col-md-3 bottom"> 

          <h6>Type: <span id="filetypePembahasan"></span></h6> 

        </div>

      </div>


      <div class="col-sm-12">

        <label for="filePembahasan" class="btn btn-sm btn-default">

          Pilih Gambar

        </label>

        <input style="display:none;" type="file" id="filePembahasan" name="gambarPembahasan" onchange="ValidateSingleInput(this);"/>
        <label class="btn btn-sm btn-danger"  onclick="restImgPembahasan()">Reset</label>

      </div>

    </div>

  </div>
  <!-- End Upload Gambar Pembahsan -->

  <!-- Start Editor Pembahasan -->
  <div  class="form-group tex "> 
   <div id="editor-soal">
    <label class="control-label col-sm-2">Pembahasan</label>
    <div class="col-sm-10">

     <textarea  name="editor2" class="form-control" id=""></textarea>

   </div>
 </div>

</div>
<!-- End Editor Pembahasan -->


<!-- Start Upload Video Pembahasan -->
<!-- pilih option upload video -->

           <!--  <div class="form-group vido" hidden="true">

                <label class="control-label col-sm-2">Pilihan Upload Video</label>

                <div class="col-sm-8">

                    <div class="btn-group" data-toggle="buttons" >

                        <label class="btn btn-teal btn-outline active" id="up_server">

                            <input type="radio" name="option_up" value="server" autocomplete="off" > Upload Video Ke server

                        </label>

                        <label class="btn btn-teal btn-outline " id="up_link">

                            <input type="radio" name="option_up"  value="link" autocomplete="off" checked="true"> Link

                        </label>

                    </div>

                </div>

              </div> -->



              <!-- untuk preview video -->

              <div  class="form-group prv_video " hidden="true">

                <div class="row" style="margin:1%;"> 

                  <div class="col-md-12">

                    <video id="preview" class="img-tumbnail image" src="" width="100%" height="50%" controls >



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



            <!--             <div class="form-group server" hidden="true">

                            <div class="col-md-11 bottom">    

                                <progress id="prog" max="100" value="0" style="display:none;"></progress>

                            </div>

                          </div> -->



                          <!-- upload ke server -->

                          <div id="upload" class="form-group server" hidden="true">

                            <label class="col-sm-2 control-label">File Video</label>

                            <div class="col-sm-4">



                              <label for="file" class="btn btn-sm btn-default">

                                Pilih Video

                              </label>

                              <input style="display:none;" type="file" id="file" name="video" onchange="ValidateInputVideo(this);"/>

                              <!-- <span class="col-sm-12 text-danger"><?php echo form_error('video'); ?></span> -->

                            </div>

                          </div>



                          <!-- upload video by link -->



                          <div class="form-group link" hidden="true">

                            <label class="col-sm-2 control-label">Link Video</label>

                            <div class="col-sm-4">

                              <input class="form-control" type="text" name="link_video">

                            </div>

                          </div>
                          <!-- end Upload Video Pembahasan-->

                        </div>
                        <!-- End Panel Body Pembahasan -->
                      </div>
                      <!-- End Panel Pembahasan -->
                    </div>
                    <!-- End Form Pembahasan -->



                  </div>



                  <div class="panel-footer">
                    <div class="col-md-2">
                      <button type="submit" class="btn btn-primary simpan">Simpan</button>
                      <a class="btn btn-info" onclick="priview()">Preview</a>
                    </div>
                    <div class="col-md-5"><br><br>
                      <div class="indicator show">
                        <!-- <span class="spinner"></span> -->
                        <div class="progress progress-striped active">
                          <div class="progress-bar progress-bar-success" style="width: 0%" id="ProgressSOal">
                            <span class="sr-only">100% Complete (success)</span>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>

                </form>

                <!--/ Form horizontal layout bordered -->

              </div>


            </div>

            <!--/ END row -->

          </div>






          <script>

        // Replace the <textarea id="editor1"> with a CKEditor

        // instance, using default configuration.

        CKEDITOR.replace( 'editor1' );
        CKEDITOR.replace( 'editor2' );

      </script>



      <!-- script untuk option hide and show -->

      <script type="text/javascript">

        $(document).ready(function(){
          CKEDITOR.instances.editor1.on( 'keyup', function( event ) {
           console.log('s');
         });
           // Start event untuk jenis editor
           $("#in-soal").click(function(){
            $("#editor-soal").show();
            $("#editor-rumus").hide();
          });

           $("#pr-rumus").click(function(){
            $("#editor-rumus").show();
            $("#editor-soal").hide();
          });
           // End event untuk jenis editor

            // Strat  event untuk pilihan jenis input  
            $("#text").click(function(){
              $(".piltext").show();
              $(".pilgambar").hide();
            });

            $("#gambar").click(function(){
              $(".pilgambar").show();
              $(".piltext").hide();     
            });
            //END  event untuk pilihan jenis input  

            // Strat  event untuk jumlah pilihan  
            $("#empatpil").click(function(){   
              $("#pilihan").hide();
              $("#pilihanop").hide();
            });

            $("#limapil").click(function(){
              $("#pilihan").show();
              $("#pilihanop").show();
            });
            // END  event untuk jumlah pilihan
          });

        </script>


        <!-- Start script untuk priview gambar soal -->
        <script type="text/javascript">
         $(function () {
            // Start event priview gambar Soal
            $('#fileSoal').on('change',function () {
              var file = this.files[0];
              var reader = new FileReader();
              var size=Math.round(file.size/1024);
                 // start pengecekan ukuran file
                 if (size>=100) {
                  $('#e_size_img').modal('show');
                  // $('.hidden-audio').hide();
                }else{
                  reader.onload = viewerSoal.load;
                  reader.readAsDataURL(file);
                  viewerSoal.setProperties(file);
                }
              });

            var viewerSoal = {
              load : function(e){
                $('#previewSoal').attr('src', e.target.result);
                $('#previewSoal2').attr('src', e.target.result);
              },
              setProperties : function(file){
                $('#filenameSoal').text(file.name);
                $('#filetypeSoal').text(file.type);
                $('#filesizeSoal').text(Math.round(file.size/1024));
              },
            }
            // End event priview gambar Soal

             // Start event priview gambar Audio
             $('#fileAudio').on('change',function () {
               $('.hidden-audio').show();
               var file = this.files[0];
               var reader = new FileReader();
               var size=Math.round(file.size/1024);
               if (size>=50000) {
                $('#e_size_audio').modal('show');
                $('.hidden-audio').hide();
              }else{
                reader.onload = viewerAudio.load;
                reader.readAsDataURL(file);
                viewerAudio.setProperties(file);
              }
              
            });

             var viewerAudio = {
              load : function(e){
                $('#previewAudio').attr('src', e.target.result);
                $('#prevAudio').attr('src', e.target.result);
              },
              setProperties : function(file){
                $('#filenameAudio').text(file.name);
                $('#filetypeAudio').text(file.type);
                $('#filesizeAudio').text(Math.round(file.size/1024));

              },
            }
            // End event priview gambar Audio
            
            // Start event priview gambar Pembahasan
            $('#filePembahasan').on('change',function () {
              var file = this.files[0];
              var reader = new FileReader();
              var size=Math.round(file.size/1024);
                 // start pengecekan ukuran file
                 if (size>=100) {
                  $('#e_size_img').modal('show');
                }else{
                  reader.onload = viewerPembahasan.load;
                  reader.readAsDataURL(file);
                  viewerPembahasan.setProperties(file);
                }
                
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

            // Start event priview gambar pilihan A
            $('#fileA').on('change',function () {
              var file = this.files[0];
              var reader = new FileReader();
              var size=Math.round(file.size/1024);
                 // start pengecekan ukuran file
                 if (size>=100) {
                  $('#e_size_img').modal('show');
                }else{
                  reader.onload = viewerA.load;
                  reader.readAsDataURL(file);
                  viewerA.setProperties(file);
                }
                
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
              var file = this.files[0];
              var reader = new FileReader();
              var size=Math.round(file.size/1024);
                 // start pengecekan ukuran file
                 if (size>=100) {
                  $('#e_size_img').modal('show');
                }else{
                 reader.onload = viewerB.load;
                 reader.readAsDataURL(file);
                 viewerB.setProperties(file);
               }
               
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
              var file = this.files[0];
              var reader = new FileReader();
              var size=Math.round(file.size/1024);
                 // start pengecekan ukuran file
                 if (size>=100) {
                  $('#e_size_img').modal('show');
                }else{
                 reader.onload = viewerC.load;
                 reader.readAsDataURL(file);
                 viewerC.setProperties(file);
               }                
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
              var file = this.files[0];
              var reader = new FileReader();
              var size=Math.round(file.size/1024);
                 // start pengecekan ukuran file
                 if (size>=100) {
                  $('#e_size_img').modal('show');
                }else{
                  reader.onload = viewerD.load;
                  reader.readAsDataURL(file);
                  viewerD.setProperties(file);
                }

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
              var file = this.files[0];
              var reader = new FileReader();
              var size=Math.round(file.size/1024);
                 // start pengecekan ukuran file
                 if (size>=100) {
                  $('#e_size_img').modal('show');
                }else{
                  reader.onload = viewerE.load;
                  reader.readAsDataURL(file);
                  viewerE.setProperties(file);
                }

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
       // cek size file video

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

    </script>
    <!-- End script untuk priview gambar soal -->
    <!-- start script js validation extension -->
    <script type="text/javascript">
// validasi upload gambar 
function ValidateSingleInput(oInput) {
  var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"]; 
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

function ValidateInputVideo(oInput) {
  var _validFileExtensions = [".mp4"]; 
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

        $('#warningupload2').modal('show');

                // alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                // oInput.value = "";
                return false;
              }
            }
          }
          return true;
        }
//validasi upload audio
function ValidateAudioInput(oInput){
  var _validFileExtensions = [".mp3"]; 
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
        restAudioSoal();
        $('#warning-upload-audio').modal('show');
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
                //console.log(data);
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
          $.each(data, function (i, data) {
            $('#subbab').append("<option value='" + data.id + "'>" + data.judulSubBab + "</option>");
          });
        }
      });
    }
    loadTingkat();
    // reset form input img soal
    function restImgSoal() {
      $("input[name=gambarSoal]").val("");
      $('#previewSoal').attr('src', "");
      $('#filenameSoal').text("");
      $('#filetypeSoal').text("");
      $('#filesizeSoal').text("");
    }
      // reset form input img pembahasan
      function restImgPembahasan() {
        $("input[name=gambarPembahasan]").val("");
        $('#previewPembahasan').attr('src', "");
        $('#filenamePembahasan').text("");
        $('#filetypePembahasan').text("");
        $('#filesizePembahasan').text("");
      }
    //reset form input audio soal
    function restAudioSoal(){
      $("input[name=listening]").val("");
      $('#previewAudio').attr('src', "");
      $('#filenameAudio').text("");
      $('#filetypeAudio').text("");
      $('#filesizeAudio').text("");
      $('.hidden-audio').hide();
    }
  </script>

  <script type="text/javascript">
    // priview soal sebelum di upload
    function priview() {
      Preview2.Update();
      var tingkat = $('select#tingkat').text();
      var judul = $("input[name=judul]").val();
      var sumber  = $("input[name=sumber]").val();
      var soal  = CKEDITOR.instances.editor1.getData();
      // var soal2 = '$E^0$';
      var jawaban = $('select[name=jawaban]').val();
      var a  =$("textarea[name=a]").val();
      var b  =$("textarea[name=b]").val();
      var c  =$("textarea[name=c]").val();
      var d  =$("textarea[name=d]").val();
      var e  =$("textarea[name=e]").val();
      $("#prevSumber").text(sumber);
      $("#prevJudul").text(judul);
      $('li#a').text(a);
      $('li#b').text(b);
      $('li#c').text(c);
      $('li#d').text(d);
      $('li#e').text(e);
      // $('div.prevSoal').text(soal2);
      $('a#prevJawaban').text(jawaban);
        $('#modalpriview').modal('show'); // show bootstrap modal
      }
      //
      // CKEDITOR.instances.editor1.on('keyup', function() {
      // // $("#editor1").keyup(function(){
      //     console.log('key up')
      // });

    </script>
    <!--END Script drop down depeden  -->
    <script src="http://malsup.github.com/jquery.form.js"></script>
<!--     <script>
     $('.simpan').click(function(){
      // data = $('#form_soal').serialize();


      data_post = {
        'subBabID':$('select[name=subBabID]').val(),
        'op-jawaban':$('input[name=op-jawaban]').val(),
        'opjumlah':$('input[name=opjumlah]').val(),
        'editor1':CKEDITOR.instances.editor1.getData(),
        'gambarSoal':$('input[name=]').val(),
        'judul':$('input[name=judul]').val(),
        'jawaban':$('select[name=jawaban]').val(),
        'kesulitan':$('select[name=kesulitan]').val(),
        'sumber':$('input[name=sumber]').val(),
        'publish':$('input[name=random]').val(),
        'random':$('input[name=random]').val(),
        'editor2':$('textarea[name=editor2]').val(),
        'opmedia':$('input[name=opmedia]').val(),
        'a':$("textarea[name=a]").val(),
        'b':$("textarea[name=b]").val(),
        'c':$("textarea[name=c]").val(),
        'd':$("textarea[name=d]").val(),
        'e':$("textarea[name=e]").val(),
      }

      $.ajax({
        type: "POST",
        url: base_url+"banksoal/uploadsoal",
        data: data_post,
        dataType: "text",
        success:function(){
          console.log('masuk');
        },error: function(XMLHttpRequest, textStatus, errorThrown) {
     console.log(XMLHttpRequest);
     console.log(textStatus);
     console.log(errorThrown);

  }
      });
    });
  </script> -->
  <!-- SCRIPT UNTUK PROGRESS BAR -->
  <!-- Untuk sementara di komen karena menyebabkan error ckeditor value always null-->
  <script>
   (function() {
    var bar = $('#ProgressSOal');
    var status = $('#status');
    $('.form-tambahsoal').ajaxForm({
      beforeSerialize:function($Form, options){
        /* Before serialize */
        for ( instance in CKEDITOR.instances ) {
          CKEDITOR.instances[instance].updateElement();
        }
        return true; 
      },
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
          title: "Selesai membuat soal",
          text: "tambah lagi atau selesai?",
          type: "success",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Buat Lagi",
          cancelButtonText: "Selesai Buat Soal",
          closeOnConfirm: false,
          closeOnCancel: false
        },
        function(isConfirm){
          if (isConfirm) {
           swal("Tambah Kembali", "Silahkan tambahkan soal lagi.", "success");
           $('#ProgressSOal').width(0);
           CKEDITOR.instances['editor1'].setData('');
           $('input[name=judul]').val('');
           $('input[name=listening]').val('');
           $('input[name=gambarSoal]').val('');
           $('input[name=gambarSoal]').val('');
           $('input[name=gambar1]').val('');
           $('input[name=gambar2]').val('');
           $('input[name=gambar3]').val('');
           $('input[name=gambar4]').val('');
           $('input[name=gambar5]').val('');
           $("select[name=jawaban]").val($("select[name=jawaban] option:first").val());
           $('input[name=publish]').prop('checked', false);
           $('input[name=random]').prop('checked', false);
           $('textarea[name=a]').val('');
           $('textarea[name=b]').val('');
           $('textarea[name=c]').val('');
           $('textarea[name=d]').val('');
           $('textarea[name=e]').val('');
         } else {
          uuid = $('input[name=UUID]').val();
          sub = $('input[name=subBabID]').val();
          window.location = base_url+"banksoal/banksoal/mysoal";
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

</section>


        <!--/ END Template Main -->