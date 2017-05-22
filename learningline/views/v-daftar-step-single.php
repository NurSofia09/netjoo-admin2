    <div class="modal fad detailstep">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="semibold mt0 text-accent text-center"></h3>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger mb5" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>  
    </div>


    <!-- MODAL TABEL STEP -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                  <div class="toolbar">
                    <ol class="breadcrumb breadcrumb-transparent nm">
                        <br>
                        <li><span><a href="<?=base_url('learningline')?>"><i class="ico-list"></i></a></span></li>

                        <li><span>{tingkat}</span></li>
                        <li>{mapel}</li>
                        <li>{bab}</li>
                        <li>{namaTopik}</li>

                        <li><a class="btn btn-success" 
                            href="<?= base_url("index.php/learningline/formstep/".$this->uri->segment(3)); ?>" 
                            target="_blank"
                            title="Tambah Data" ><i class="ico-plus"></i></a></li>       
                        </ol><br>
                    </div>
                </div>
                <div class="panel-body">

                  <table class="daftarstep table table-striped display responsive nowrap" style="font-size: 13px" width=100%>
                    <thead>
                        <tr>
                            <th width="10%">Id</th>
                            <th>Step</th>
                            <th>jenis</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- TABEL LEARNING LINE -->