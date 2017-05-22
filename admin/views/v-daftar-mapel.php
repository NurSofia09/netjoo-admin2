<link rel="stylesheet" href="<?= base_url('assets/plugins/datatables/css/jquery.datatables.min.css'); ?>">
<!-- konten -->

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5 class="panel-title">Daftar Mata Pelajaran</h5>
                <!-- Trigger the modal with a button -->
                <button title="Tambah Data" type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#myModal" style="margin-top:-30px;" ><i class="ico-plus"></i></button>
                <br>
                <!--<a data-toggle="modal" class="btn btn-default pull-right"  "  data-target="#myModal">Tambah</a>-->
            </div>
            <table class="table table-striped" id="zero-configuration" style="font-size: 13px">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th>Nama Mata Pelajaran</th>
                        <th>Alias</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($mapels as $mapel): ?>
                        <tr>
                            <td class="text-center"><?= $mapel->id ?></td>
                            <td><?= $mapel->namaMataPelajaran ?></td>
                            <td><?= $mapel->aliasMataPelajaran ?></td>
                            <td class="text-center">
                                <!--<button type="button" id="rubahBtn" class="btn btn-default" data-toggle="modal" data-id="<?= $mapel->id ?>" data-namaMP="<?= $mapel->namaMataPelajaran ?>" data-aliasMP="<?= $mapel->aliasMataPelajaran ?>" title="RubahData"><i class="ico-file5"></i></button>-->
                                <button type="button" id="rubahBtn" class="btn btn-default" data-toggle="modal" data-id="<?= $mapel->id ?>" data-alias="<?= $mapel->aliasMataPelajaran ?>" data-nama="<?= $mapel->namaMataPelajaran ?>" title="Rubah Data"><i class="ico-file5"></i></button>
                                <button type="button" id="hapusBtn" class="btn btn-default" data-toggle="modal" data-id="<?= $mapel->id ?>" data-nama="<?= $mapel->namaMataPelajaran ?>" title="Hapus Data"><i class="ico-remove"></i></button>
                            </td>
                            <!-- Modal -->
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tambah Data Mata Pelajaran</h4>
            </div>
            <form action="<?= base_url('index.php/admin/tambahMP') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group input-group">
                        <span class="input-group-addon"><i class="ico-notebook"></i></span>
                        <input name="namaMP" type="text" class="form-control" placeholder="Nama Mata Pelajaran" required> <br>
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon"><i class="ico-file-upload"></i></span>
                        <input name="aliasMP" type="text" class="form-control"  placeholder="Alias" required> <br>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="modalRubah" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Rubah Data Mata Pelajaran</h4>
            </div>
            <form action="<?= base_url('index.php/admin/rubahMP') ?>" method="post">
                <div class="modal-body rubah">
                    <div class="form-group input-group">
                        <span class="input-group-addon"><i class="ico-notebook"></i></span>
                        <input name="namaMP" id="namaMP" type="text" class="form-control" placeholder="Nama Mata Pelajaran" required> <br>
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon"><i class="ico-file-upload"></i></span>
                        <input name="aliasMP" id="aliasMP" type="text" class="form-control"  placeholder="Alias" required> <br>
                    </div>
                    <div class="form-group input-group">
                        <input type="text" hidden="true" name="idMP" id="idMP" value=""/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Yakin</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="modalHapus" class="modal fade" role="dialog">
    <div class="modal-dialog">
         Modal content
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Hapus Data </h4>
            </div>
            <form action="<?= base_url('index.php/admin/hapusMP') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group input-group">
                        <span><h4 class="text-center">Yakin akan menghapus data mata pelajaran</h4></span>  
                        <input type="text" hidden="true" name="idMP" id="idMP" value=""/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Yakin</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).on("click", "#rubahBtn", function () {
        var Id = $(this).data('id');
        var alias = $(this).data('alias');
        var nama = $(this).data('nama');
        $(".rubah #idMP").val(Id);
        $(".rubah #namaMP").val(nama);
        $(".rubah #aliasMP").val(alias);
        // As pointed out in comments, 
        // it is superfluous to have to manually call the modal.
        $('#modalRubah').modal('show');
    });

    $(document).on("click", "#hapusBtn", function () {
        var Id = $(this).data('id');
        $(".modal-body #idMP").val(Id);
        // As pointed out in comments, 
        // it is superfluous to have to manually call the modal.
        $('#modalHapus').modal('show');
    });
</script>