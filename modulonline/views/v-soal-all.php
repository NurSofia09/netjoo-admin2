<!-- START Template Main -->
<section id="main" role="main">


<!-- Start Modal konfirmasi hapus -->
<div class="modal fade" id="konfirmasiDlt" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">

    <div class="alert alert-danger ">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="semibold">Anda Yakin Menghapus DATA INI?</h4>
        <p class="mb10">Silahkan cek kembali, jika anda yakin silahkan klik tombol di bawah ini untuk melanjutkan proses hapus data.</p>
        <button type="button" class="btn btn-danger btn-right" onclick="konfirmasiHapus()">hapus Data</button>
    </div>

</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Start Modal Detail Soal dari server -->
    <div class="modal fade" id="mdetailsoal">

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
    <!-- START Template Container -->
    <div class="container-fluid">


        <!-- START row -->
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-teal">
                    <div class="panel-heading">
                        <h3 class="panel-title">Daftar Semua Modul</h3>
                         <!-- Start menu tambah soal -->
                        <div class="panel-toolbar text-right">
                            <a class="btn btn-inverse btn-outline" href="<?= base_url(); ?>index.php/modulonline/formmodul" title="Tambah Data" ><i class="ico-plus"></i></a>
                        </div>
                         <!-- END menu tambah soal -->
                    </div>
                    <table class="table table-striped table-bordered" id="tb_allSoal" style="font-size: 13px" width="100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Judul Modul</th>
                                <th>Deksripsi</th>
                                <!-- <th>Create By</th> -->
                                <th>Publish</th>
                                <th>Download</th>
                                <th>Edit</th>
                                <th>Hapus</th>
                                <!-- <th></th>
                                <th></th>
                                <th></th>
                                <th></th> -->
                            </tr>
                        </thead>
                        <tbody>
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!--/ END row -->

    </div>
    <!--/ END Template Container -->

    <!-- START To Top Scroller -->
    <a href="#" class="totop animation" data-toggle="waypoints totop" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="50%"><i class="ico-angle-up"></i></a>
    <!--/ END To Top Scroller -->
</section>
<!--/ END Template Main -->
<!-- Start Math jax --> 
<script type="text/x-mathjax-config"> 
    MathJax.Hub.Config({ 
    tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]} 
    }); 
</script> 
<script type="text/javascript" async 
        src="<?= base_url('assets/plugins/MathJax-master/MathJax.js?config=TeX-MML-AM_HTMLorMML') ?>">
</script> 
<!-- end Math jax -->
<!-- /javascript/app.min.js -->
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
 <script type="text/javascript" src="<?=base_url('assets/javascript/app.min.js')?>"></script>
<script type="text/javascript">


    var tb_allSoal;
    $(document).ready(function() {
        tb_allSoal = $('#tb_allSoal').DataTable({ 
           "ajax": {
                    "url": base_url+"index.php/modulonline/ajax_listAllSoal/",
                    "type": "POST"
                    },
            "processing": true,
        });
        $(function () {
              $('[data-toggle="popover"]').popover()
            });
       
    });

    function dropSoal(id) {
        if (confirm('Apakah Anda yakin akan menghapus data ini? ')) {
               // ajax delete data to database
               
               $.ajax({
                     url : base_url+"index.php/modulonline/deletebanksoal/"+id,
                     type: "POST",
                     dataType: "TEXT",
                     success: function(data,respone)
                     {  
                       
                            reload_tblist();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                            alert('Error deleting data');
                            // console.log(jqXHR);
                            // console.log(textStatus);
                            // console.log(errorThrown);
                    }
                });
             }
    }

    function reload_tblist(){
      tb_allSoal.ajax.reload(null,false); 
    }

    // tampil modal kofirmasi hapus
    function konfirmasiHapus (id_soal) {
        $('#konfirmasiDlt').modal('show');
    }

    // Fungsi untuk detail soal
    function detailSoal(id_soal) {
        var kelas ='.detail-'+id_soal;
        var data = $(kelas).data('id');
        var jawaban=$('#jawaban-'+id_soal).val();
        $('h3.semibold').html(data.judul_soal);

        $('p#dsoal').html(data.soal);
        $('p#djawaban').html(jawaban);
        $('#mdetailsoal').modal('show');
    }
</script>