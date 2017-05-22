<link rel="stylesheet" href="<?= base_url('assets/plugins/datatables/css/jquery.datatables.min.css'); ?>">
<!-- START Template Main -->
<section id="main" role="main">
    <!-- START Template Container -->
    <div class="container-fluid">

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
        <!-- START row -->
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-teal">
                    <div class="panel-heading">

                        <h3 class="panel-title ">Daftar Soal Berdasarkan Bab '<?=$judulBab;?>'</h3>
                        <!-- Start menu tambah soal -->
                        <div class="panel-toolbar text-right">
                        <input type="text" name="bab" id="babID" value="<?= $babID; ?>" hidden="true" >
                            <a class="btn btn-inverse btn-outline" href="<?= base_url(); ?>index.php/banksoal/formsoal" title="Tambah Data" ><i class="ico-plus"></i></a>
                        </div>
                         <!-- END menu tambah soal -->

                    </div>
                    <table class="table table-striped" id="tb_soalsub" style="font-size: 13px" width="100%">
                        <thead>
                            <tr>
                               <th>ID</th>
                                <th>Judul Soal</th>
                                <th>Sumber</th>
                                <th>Judul Sub Bab</th>
                                <th>Tingkat Kesulitan</th>
                                <th>Soal</th>
                                <th>Jawaban</th>
                                <th>Publish</th>
                                <!-- <th>Random</th> -->
                                <th></th>
                                <th></th>
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

<script type="text/javascript">

    var tblist_TO;
    var bab =$('#babID').val();
    // var idTo =$('#id_to').val();
  
    $(document).ready(function() {
        tblist_TO = $('#tb_soalsub').DataTable({ 
           "ajax": {
                    "url": base_url+"index.php/banksoal/ajax_soalPerBab/"+bab,
                    "type": "POST"
                    },
            "processing": true,
        });
    });


    function dropSoal(id_soal) {

        if (confirm('Apakah Anda yakin akan menghapus data inis? ')) {
               // ajax delete data to database
               console.log(id_soal);
               $.ajax({
                     url : base_url+"index.php/banksoal/deletebanksoal/"+id_soal,
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
                            console.log(errorThrown);
                    }
                });
             }
    }
    function reload_tblist(){
      tblist_TO.ajax.reload(null,false); 
    }

    function detailSoal(id_soal) {
        var kelas ='.detail-'+id_soal;
        var data = $(kelas).data('id');
        var jawaban=$('#jawaban-'+id_soal).val();
        console.log(data);
        $('h3.semibold').html(data.judul_soal);

        $('p#dsoal').html(data.soal);
        $('p#djawaban').html(jawaban);
        $('#mdetailsoal').modal('show');
    }

</script>