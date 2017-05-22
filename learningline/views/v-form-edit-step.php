  <div class="modal fade detail_materi">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          <h3 class="semibold mt0 text-accent text-center"></h3>
        </div>
        <div class="modal-body">
          <p id="isicontent">

          </p>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>

  </div>
  <input type="hidden" name="id" value={id}>
  <input type="hidden" name="babID" value={babid}>
  <input type="hidden" name="jenis_step" value="{id_relasi}">
  <input type="hidden" name="relasi" value="{relasi_step}">

  <!-- TABEL KONTEN 1 . FORM LEARNINGNLINE -->
  <div class="row">
   <div class="col-md-12">
    <div class="panel panel-default">
     <div class="panel-heading">
      <h3 class="panel-title">Edit Learning Step</h3>
      <div class="panel-toolbar text-right">
        <a class="btn btn-success" 
        href="<?= base_url(); ?>index.php/learningline" 
        title="Lihat Topik" ><i class="ico-th-list"></i></a>
      </div> 
    </div>
    <div class="panel-body">
      <!-- Start Body modal -->
      <form  class="panel panel-default form-horizontal form-bordered form-line"  method="post" >
       <div  class="form-group">
        <label class="col-sm-3 control-label">Nama Topik</label>
        <div class="col-sm-8">
         <!-- stkt = soal tingkat -->
         <input type="input" class="form-control" name="id" value="{namaTopik}" disabled="true">

       </div>
     </div>

     <div  class="form-group">
      <label class="col-sm-3 control-label">Urutan</label>
      <div class="col-sm-8">
       <!-- stkt = soal tingkat -->
       <input type="text" class="form-control" name="urutan" value="{urutan}">
     </div>
   </div>

   <div  class="form-group">
    <label class="col-sm-3 control-label">Nama Step</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="namastep" value="{namastep}">
    </div>
  </div>

  <div  class="form-group">
    <label class="col-sm-3 control-label">Jenis Step</label>
    <div class="col-sm-8">
      <select class="form-control" name="select_jenis">
        <option value="0">-- Pilih Jenis Step --</option>
        <option value="1">Video</option>
        <option value="2">Materi</option>
        <option value="3">Latihan</option>
      </select>
    </div>
  </div>

  <div  class="form-group jenis container-fluid">
    <h4 class="text-center">Pilih Jenis Terlebih Dahulu</h4>

  </div>

  <div class="form-group no-border">
    <div class="col-sm-1"></div>
    <div class="col-sm-11">
     <a class="btn btn-primary update_step">Update</a>
     <button type="reset" class="btn btn-danger reset">Reset</button>
   </div>
 </div>
</form>

</div>
</div>
</div>
</div>
</div>
<!-- TABEL KONTEN 1 . FORM LEARNINGNLINE -->
