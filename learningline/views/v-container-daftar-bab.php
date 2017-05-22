            <style type="text/css">
                .modal-dialog{
                    width: 850px;
                    padding: 10px;
                }
            </style>

            <!-- MODAL TABEL STEP -->
            <div class="modal fade detail_topik" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                  </div>
                  <div class="modal-body">
                      <div class="panel panel-default">
                         <div class="panel-heading">
                             <h3 class="panel-title">Tabel Topik Line</h3> 
                             <div class="panel-toolbar text-right">
                                <a class="btn btn-success add" 
                                href="<?= base_url(); ?>index.php/learningline/formlearning" 
                                target="_blank"
                                title="Tambah Data" ><i class="ico-plus"></i></a>
                                   <a class="btn btn-success list" 
                                href="<?= base_url(); ?>index.php/learningline/formlearning" 
                                target="_blank"
                                title="Lihat Data" ><i class="ico-list"></i></a>
                            </div>

                        </div>
                        <div class="panel-body">
                            <table class="daftartopik table table-striped display responsive nowrap" style="font-size: 13px" width=100%>
                                <thead>
                                    <tr>
                                    
                                        <th width="50%">Topik</th>
                                        <th>Urutan Tampil</th>
                                        <th>Status</th>
                                        <th width="20%">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>

                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL TABEL TOPIK -->

    <!-- MODAL TABEL STEP -->
    <div class="modal fade detail_step" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
          </div>
          <div class="modal-body">
              <div class="panel panel-default">
                 <div class="panel-heading">
                     <h3 class="panel-title">Tabel Step Line</h3> 
                     <div class="panel-toolbar text-right">
                        <a class="btn btn-success add" 
                        href="" 
                        target="_blank"
                        title="Tambah Data" ><i class="ico-plus"></i></a>

                         <a class="btn btn-success list" 
                        href="" 
                        target="_blank"
                        title="Lihat Data" ><i class="ico-list"></i></a>
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
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
</div>
<!-- MODAL TABEL TOPIK -->

<!-- TABEL LEARNING LINE -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Daftar Bab</h3> 

            </div>
            <div class="panel-body">
                <table class="daftarbab table table-striped display responsive nowrap" style="font-size: 13px" width=100%>
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Nama Tingkat</th>
                            <th>Pelajaran</th>
                            <th>Bab</th>
                            <th>learning Line</th>
                            <th width="15%">Aksi</th>
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


<script type="text/javascript">
    var url = base_url + "learningline/ajax_get_list_bab";
    var kelas = '.daftarbab';
    var tabel;

    var dataTableLearning ;
    var kelasDTLearning= ".daftartopik" ;
</script>