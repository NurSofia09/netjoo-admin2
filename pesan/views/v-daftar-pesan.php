<link rel="stylesheet" href="<?= base_url('assets/plugins/datatables/css/jquery.datatables.min.css'); ?>">
<section id="main" role="main">
    <div class="col-md-12">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Daftar Pesan</h4>
                    <!-- Trigger the modal with a button -->
                    <!--<a href="<?= base_url('index.php/siswa/daftarsiswa') ?>" title="Tambah Data" type="button" class="btn btn-default pull-right" style="margin-top:-30px;" ><i class="ico-plus"></i></a>-->
                    <br>
                    <!--<a data-toggle="modal" class="btn btn-default pull-right"  "  data-target="#myModal">Tambah</a>-->
                </div>

                <table class="daftarpesan table table-striped display responsive nowrap" style="font-size: 13px" width=100%>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pengirim Pesan</th>
                            <th>Telepon</th>
                            <th>Email</th>
                            <th>Pesan</th>
                            <th>Tgl Pesan</th>
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
    var tb_pesan;
    $(document).ready(function () {
        tb_pesan = $('.daftarpesan').DataTable({
            "ajax": {
                "url": base_url + "pesan/ajax_daftar_pesan",
                "type": "POST"
            },
            "emptyTable": "Tidak Ada Data Pesan",
            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
        });
    });

    function dropPesan(id_pesan) {
        swal({   title: "Anda Yakin?",   
            text: "Anda akan menghapus pesan?",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Yup, hapus pesan",   
            closeOnConfirm: false }, 
            function(){
                $.ajax({
                    url: base_url + "index.php/pesan/deletePesan/" + id_pesan,
                    data: "id_pesan=" + id_pesan,
                    type: "POST",
                    dataType: "TEXT",
                    success: function (data, respone)
                    {
                        swal("Terhapus!", "Pesan Telah terhapus", "success");

                        reload_tblist();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal('Error deleting data');
                    }
                });
            });
    }
    function reload_tblist() {
        tb_pesan.ajax.reload(null, false);
    }

</script>