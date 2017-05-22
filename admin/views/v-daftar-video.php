<link rel="stylesheet" href="<?= base_url('assets/plugins/datatables/css/jquery.datatables.min.css'); ?>">
<!-- konten -->


<section id="main" role="main" class="mt10">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-10" style="padding-left: 30px;">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">Video Yang Telah Anda Upload</h5>
                    </div>
                    <table class="table table-striped" id="zero-configuration" style="font-size: 14px">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Judul Video</th>
                                <th>Nama File</th>
                                <th>Deskripsi</th>
                                <th>Published</th>
                                <th>Pembuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($videos as $video): ?>
                                <tr>
                                    <td><?= $video->videoID ?></td>
                                    <td><?= $video->judulVideo ?></td>
                                    <td><?= $video->namaFile ?></td>
                                    <td width="20%"><p><?= mb_substr($video->deskripsi, 0, 100); ?></p></td>
                                    
                                    <td><?=$video->published ?></td>
                                    <td><?=$video->namaDepan ?> <?=$video->namaBelakang ?></td>
                                    <td class="text-center">
                                        <span><a href="" title="Publish"><i class="ico-folder-plus4"></i></a></span>&nbsp  &nbsp
                                        <!-- <span><a data-namavideo="<?= $video->namaFile ?>" data-id="<?= $video->videoID ?>" title="Delete" class="text-danger deletevideo" data-toggle="modal" data-target="#confirm-delete"><i class="icon ico-remove3"></i></a></span>
 -->                                    </td>

                            <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            Konfirmasi Hapus Video
                                        </div>
                                        <div class="modal-body">
                                            <h5 class="text-danger">Anda Yakin Akan Menghapus Video ?</h5>
                                        </div>
                                        <div class="modal-footer">x
                                            <form action="<?= base_url("index.php/video/dropvideo/$video->videoID") ?>">
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                                <button type="submit" data-dismis="modal" class="btn btn-primary">Cancel</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            </tr>
                        <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> 
    </div>
    <!--START To Top Scroller--> 
    <a href="#" class="totop animation" data-toggle="waypoints totop" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="50%"><i class="ico-angle-up"></i></a>
    <!--/ END To Top Scroller--> 
</section>


<script type="text/javascript" src="<?= base_url('assets/library/jquery/js/jquery.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/library/jquery/js/jquery-migrate.min.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/library/bootstrap/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/library/core/js/core.min.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/plugins/sparkline/js/jquery.sparkline.min.js') ?>"></script>



<script type="text/javascript" src="<?= base_url('assets/javascript/app.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/plugins/datatables/js/jquery.datatables.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/plugins/datatables/tabletools/js/tabletools.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/plugins/datatables/tabletools/js/zeroclipboard.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/plugins/datatables/js/jquery.datatables-custom.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/javascript/tables/datatable.js') ?>"></script>