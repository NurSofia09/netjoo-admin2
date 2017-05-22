<link rel="stylesheet" href="<?= base_url('assets/plugins/datatables/css/jquery.datatables.min.css'); ?>">
<script type="text/javascript" src="<?= base_url('assets/plugins/ckeditor/ckeditor.js') ?>"></script>

<section id="main" role="main">
    <div class="col-md-12">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Daftar Subscribe</h4>
                    <!-- Trigger the modal with a button -->
                    <!--<a href="<?= base_url('index.php/siswa/daftarsiswa') ?>" title="Tambah Data" type="button" class="btn btn-default pull-right" style="margin-top:-30px;" ><i class="ico-plus"></i></a>-->
                    <br>
                    <!--<a data-toggle="modal" class="btn btn-default pull-right"  "  data-target="#myModal">Tambah</a>-->
                </div>

                <table class="daftarsubs table table-striped display responsive nowrap" style="font-size: 13px">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    var tb_subs;
    $(document).ready(function () {
        tb_subs = $('.daftarsubs').DataTable({
            "ajax": {
                "url": base_url + "subscribe/ajax_daftar_subs",
                "type": "POST"
            },
            "emptyTable": "Tidak Ada Data Subscribe",
            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
        });
    });

    function dropSubs(id_subs) {
        if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
            // ajax delete data to database
//            console.log(base_url + "index.php/Subscribe/deletePesan/" + id_subs);
            $.ajax({
                url: base_url + "index.php/subscribe/deletesubs/" + id_subs,
                data: "id_subs=" + id_subs,
                type: "POST",
                dataType: "TEXT",
                success: function (data, respone)
                {
                    reload_tblist();
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    swal('Error deleting data');
                    // console.log(jqXHR);
                    // console.log(textStatus);
                    console.log(errorThrown);
                }
            });
        }
    }
    function reload_tblist() {
        tb_subs.ajax.reload(null, false);
    }

</script>