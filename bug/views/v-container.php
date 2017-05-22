        <div class="modal fade " tabindex="-1" role="dialog" id="respon">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button><br>
                            <div class="modal-title"><h5 class="text-center">Tindakan Untuk Bug</h5></div>
                            <div class="info">
                                <div class="sukses text-info text-center hide">
                                    <span>Respon telah terkirim</span>
                                </div>
                                <div class="gagal text-danger text-center hide">
                                    <span>Gagal memberikan respom !</span>
                                </div> 
                                <div class="lengkapi text-danger text-center hide">
                                    <span>isi terlebih dahulu responya</span>
                                </div>
                            </div>
                        </div>

                        <style>
                        </style>
                        <div class="modal-body">
                            <form class="form-laporan"> 
                                <label>Isi Respon komen<sup class="text-info">*Silahkan isi tindakan</sup></label>
                                <textarea name="respon" placeholder="Isi respon"
                                rows="5" aria-invalid="false" aria-required="true"  class="form-control"></textarea>
                            </form>
                        </div>
                    </p>

                    <div class="modal-footer bg-color-3">


                    </div>

                </div><!-- /.modal-content -->

            </div><!-- /.modal-dialog -->

        </div>
        <!-- page header -->

        <section id="main" role="main">
            <!-- START Template Container -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <div class="panel panel-default table-responsive" style="padding: 10px;border: 1px solid #cfd9db">
                                <div class="panel-heading" style="padding: 10px;border: 1px solid #cfd9db">
                                    <h3 class="panel-title">Data Bug</h3>
                                </div>
                                <table class="table table-bordered" id="ajax-source-komen" style="padding: 10px;border: 1px solid #cfd9db;width: 100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th width="20%">Isi Error</th>
                                            <th>Tanggal</th>
                                            <th>Alamat</th>
                                            <th>Pelapor</th>
                                            <th>Status</th>
                                            <th width="20%">Tindakan</th>
                                            <th width="18%">Aksi</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--/ END row -->

        <script type="text/javascript">
         var tb_laporan_bug;
         $(document).ready(function(){
           tb_laporan_bug= $("#ajax-source-komen").DataTable({
            "bProcessing": true,
            "sAjaxSource": base_url+"bug/ajax_data_bugs",
            "sServerMethod": "POST",
            "bSearching": false,
            "responsive": true,
        });

       });

         function respon(komenID){
            button = "<button type='button' class='btn btn-success lapor' onclick='post("+komenID+")'>Respon</button><button type='button' class='btn btn-primary selesai' data-dismiss='modal'>Batal</button>";
            $('#respon .modal-footer').html(button);
            $('#respon').modal('show');$('textarea[name=respon]').val("");

        }

        function post(idlapor){
            tindakan = $('textarea[name=respon]').val();

            var data = {
                'idKomen':idlapor,
                'isTindakan':tindakan
            };

            $.ajax({
                url : base_url +"bug/tindakan_laporan",
                data:data,
                dataType:"TEXT",
                type:'post',
                success:function(){
                    swal("Terkirim!", "Laporan bug telah direspon", "success");
                    $('#respon').modal('hide');
            reload_tblist();
                    
                }, error:function(){
                    swal("Gagal!", "Laporan bug gagal direspon", "warning");
                }

            });


        }

        function drop(idlapor){
            swal({   title: "Anda Yakin?",   
                text: "Anda akan menghapus laporan bug?",   
                type: "warning",   
                showCancelButton: true,   
                confirmButtonColor: "#DD6B55",   
                confirmButtonText: "Yup, hapus laporan",   
                closeOnConfirm: false }, 
                function(){
                    $.ajax({
                        url : base_url +"bug/delete/"+idlapor,
                        dataType:"TEXT",
                        type:'post',
                        success:function(){
                         swal("Terhapus!", "Laporan bug telah terhapus", "success");
                         reload_tblist();
                     }, error:function(){
                         swal("Gagal!", "Laporan bug gagal terhapus", "warning");
                         reload_tblist();
                     }

                 });
                });




        }
        function reload_tblist() {
            tb_laporan_bug.ajax.reload(null, false);
        }



    </script>