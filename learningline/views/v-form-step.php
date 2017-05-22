    <div class="modal fad mdetailsoal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h3 class="semibold mt0 text-accent text-center"></h3>
          </div>
          <div class="modal-body">
            <label>Soal :</label>
            <p class="text-justify" id="dsoal">
            </p>
            <label>Jawaban :</label>
            <p class="text-justify" id="djawaban">
            </p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger mb5" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!-- End Modal Detail Soal-->              
    <!-- MODAL TABEL STEP -->
    <div class="modal fade detail_video" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
          </div>
          <div class="modal-body">

            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- MODAL TABEL -->
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
    <!-- MODAL daftar step -->
    <div class="modal fade daftar_step">
      <div class="modal-dialog" role="document">
        <div class="modal-content" style="width:800px">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h3 class="semibold mt0 text-accent text-center">Daftar Step {namaTopik}</h3>
          </div>
          <div class="modal-body">
            <table class="daftarsteptable table table-striped display responsive nowrap" style="font-size: 13px" width=100%>
              <thead>
                <tr>
                  <th width="3%">ID Step</th>
                  <th width="3%">Urutan</th>

                  <th>Nama step</th>

                  <th>Jenis Materi</th>
                  <th width="20%">Aksi</th>
                </tr>
              </thead>

              <tbody>

              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <input type="hidden" name="babID" value={babID}>
    <!-- TABEL KONTEN 1 . FORM LEARNINGNLINE -->
    <div class="row">
     <div class="col-md-12">
      <div class="panel panel-default">
       <div class="panel-heading">
        <!-- <h3 class="panel-title">Tambah Learning Step</h3> -->
        <div class="toolbar">
          <ol class="breadcrumb breadcrumb-transparent nm">
            <br>
            <li><span><a href="<?=base_url('learningline')?>"><i class="ico-list"></i></a></span></li>

            <li><span>{tingkat}</span></li>
            <li>{mapel}</li>
            <li>{bab}</li> 
            <li class="active"><a href="#">{namaTopik}</a></li>        

          </ol><br>
        </div>
<!--       <div class="panel-toolbar text-right">
        <a class="btn btn-success" 
        href="<?= base_url(); ?>index.php/learningline" 
        title="Lihat Topik" ><i class="ico-th-list"></i></a>
      </div>  -->
    </div>
    <div class="panel-body">
      <!-- Start Body modal -->
      <form  class="panel panel-default form-horizontal form-bordered form-line"  method="post" >
       <div  class="form-group">
        <label class="col-sm-3 control-label">Nama Topik</label>
        <div class="col-sm-8">
         <!-- stkt = soal tingkat -->
         <input type="text" class="form-control" value="{namaTopik}" disabled="true">
         <input type="hidden" class="form-control" name="id" value="{id}" disabled="true">

       </div>
     </div>

     <div  class="form-group">
      <label class="col-sm-3 control-label">Urutan</label>
      <div class="col-sm-8">
       <!-- stkt = soal tingkat -->
       <input type="text" class="form-control nomor" name="urutan">
     </div>
   </div>

   <div  class="form-group">
    <label class="col-sm-3 control-label">Nama Step</label>
    <div class="col-sm-7">
      <input type="text" class="form-control" name="namastep">
    </div>
    <a title="Lihat Daftar Step" class="btn btn-success lihat_step"><i class="ico-list-alt"></i></a>
  </div>

  <div  class="form-group">
    <label class="col-sm-3 control-label">Jenis Step</label>
    <div class="col-sm-3">
      <select class="form-control" name="select_jenis">
        <option value="0">-- Pilih Jenis Step --</option>
        <option value="1">Video</option>
        <option value="2">Materi</option>
        <option value="3">Latihan</option>
      </select>
    </div>
    <label class="col-sm-3 control-label">Status Depedensi</label>
    <div class="col-sm-3">
      <input type="radio" name="dependensi" class="mt10" value="1"> <i class="ico-ok-sign"></i> Ya 
      <input type="radio" name="dependensi" class="mt10" value="2" checked="true"> <i class="ico-remove-sign"></i> Tidak 
    </div>
  </div>
  <div  class="form-group jenis container-fluid">
    <h4 class="text-center">Pilih Jenis Terlebih Dahulu</h4>

  </div>

  <div class="form-group no-border">
    <div class="col-sm-1"></div>
    <div class="col-sm-11">
     <a class="btn btn-primary simpan_step">Simpan</a>
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
