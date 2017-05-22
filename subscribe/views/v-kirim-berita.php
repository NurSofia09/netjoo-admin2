<link rel="stylesheet" href="<?= base_url('assets/plugins/datatables/css/jquery.datatables.min.css'); ?>">
<script type="text/javascript" src="<?= base_url('assets/plugins/ckeditor/ckeditor.js') ?>"></script>

<section id="main" role="main">
    <div class="col-md-12">
        <div class="row">
            <?php if ($this->session->flashdata('notif') != '') {
                ?>

                <div class="alert alert-warning fade in">

                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

                    <span class="semibold">Note :</span><?php echo $this->session->flashdata('notif'); ?>

                </div>

            <?php } ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Berita Terbaru</h4>
                    <!-- Trigger the modal with a button -->
                    <!--<a href="<?= base_url('index.php/siswa/daftarsiswa') ?>" title="Daftar Berita" type="button" class="btn btn-default pull-right" style="margin-top:-30px;" >Daftar Berita</a>-->
                    <!--<br>-->
                    <!--<a data-toggle="modal" class="btn btn-default pull-right"  "  data-target="#myModal">Tambah</a>-->
                </div>
                <form class="" method="post" action="<?= base_url('index.php/subscribe/addberita') ?>">
                    <div class="form-group">
                        <!--<label class="control-label col-md-1 text-right">Judul</label>-->
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="judul" maxlength=100 placeholder="Judul Berita" required>
                        </div>
                    </div>
                    <br>
                    <br>
                    <br>
                    <div class="form-group">
                        <div class="col-md-12">
                            <textarea name="editor1" class="form-control" id="isiberita" required></textarea>
                            <br>
                        </div>

                        <div class="panel-footer">
                            <button type="submit" class="btn btn-primary pull-right">Kirim Berita</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<script>

    // Replace the <textarea id="editor1"> with a CKEditor

    // instance, using default configuration.

    CKEDITOR.replace('editor1');

</script>