        <div class="modal fade " tabindex="-1" role="dialog" id="respon">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button><br>
                            <div class="modal-title"><h5 class="text-center">Isi Respon Untuk Komen</h5></div>
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
                                <label>Isi Respon komen<sup class="text-info">*Silahkan isi respon</sup></label>
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
                                    <h3 class="panel-title">Data Komen</h3>
                                </div>
                                <table class="table table-bordered" id="ajax-source-komen" style="padding: 10px;border: 1px solid #cfd9db;width: 100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th width="30%">Isi Komen</th>
                                            <th>Tanggal</th>
                                            <th>Judul video</th>
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
          var socket = io.connect( 'http://'+window.location.hostname+':3000' );
         var tb_komen;
            $(document).ready(function(){  
                

                tb_komen= $("#ajax-source-komen").DataTable({
                    "bProcessing": true,
                    "sAjaxSource": base_url+"komenback/ajax_data_komen",
                    "sServerMethod": "POST",
                    "bSearching": false,
                    "responsive": true,
                });



            });
            socket.on( 'new_komen', function( data ) {
              tb_komen.ajax.reload(null,false); 
            });

            function respon(komenID){
                button = "<button type='button' class='btn btn-success lapor' onclick='post("+komenID+")'>Respon</button><button type='button' class='btn btn-primary selesai' data-dismiss='modal'>Batal</button>";
                $('#respon .modal-footer').html(button);
                $('#respon').modal('show');

            }

            function post(idKomen){
                komen = $('textarea[name=respon]').val();

                var data = {
                    'idKomen':idKomen,
                    'isiKomen':komen
                };

                $.ajax({
                    url : base_url +"komenback/addkomen",
                    data:data,
                    dataType:"TEXT",
                    type:'post',
                    success:function(){
                        alert('sukses');
                    }, error:function(){
                        alert('gagal');
                    }

                });
            }

            function check(videoID){
                window.location=base_url+"komenback/seevideo/"+videoID;
            }


        </script>