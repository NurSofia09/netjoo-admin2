</style>
<section id="main" role="main">
    <!-- START MODAL EDIT TRYOUT -->
    <script type="text/javascript">halaman = true;</script>
    <div class="modal fade" id="modal_editTO" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <!--START Header Modal -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">Ubah Try Out</h3>
                </div>
                <!--END Header Modal -->
                <!--START Body Modal -->
                <div class="modal-body form">
                    <!-- Start Form Edit TO -->
                    <form action="#" id="formeditTO" class="panel panel-default form-horizontal form-bordered">
                        <div class="panel-body">
                           <div class="form-group">
                                <input type="hidden" value="" name="id_tryout"/>
                                <label class="col-sm-3 control-label">Nama Tryout</label>
                                <div class="col-sm-8">
                                      <input type="text" class="form-control" name="nama_tryout">
                                </div>
                           </div>
                           <div  class="form-group">
                                <label class="col-sm-3 control-label">Tanggal Mulai</label>
                                <div class="col-sm-8">
                                  <input type="date" class="form-control" name="tgl_mulai">
                                </div>
                            </div>
                            <div  class="form-group">
                                <label class="col-sm-3 control-label">Tanggal Berakhir</label>
                                <div class="col-sm-8">
                                  <input type="date" class="form-control" name="tgl_berhenti">
                              </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Publish?</label>
                                <div class="col-sm-8">
                                    <div class="checkbox custom-checkbox">  
                                        <input type="checkbox" name="publish" id="publish" value="1">  
                                        <label for="publish">&nbsp;&nbsp;</label>   
                                    </div>
                                </div>
                            </div> 
                        </div>
                        <div class="panel-footer">
                            <button type="submit" class="btn btn-primary" name="proses" id="btneditTo" onclick="saveedit()" >Proses</button>
                            <button type="reset" class="btn btn-inverse" id="btnReset">reset</button>
                        </div>
                    </form>
                    <!-- END Form Edit TO   -->
                </div>
                <!--END Body Modal -->
            </div>
        </div>
    </div>
    <!-- END MODAL EDIT TRYOUT -->

    <!-- START Template Container -->
    <div class="container-fluid">
    	<div class="row">
    		<div class="container">
            <div class="col-md-11">
    			<div class="panel panel-teal">
                    <!--Start untuk menampilkan nama tabel -->
                    <div class="panel-heading">
                    	<h3>List Try Out</h3>
                    </div>
                    <div class="panel-body">
                    	<table class="table table-striped" id="tblistTO" style="font-size: 13px">
                    		<thead>
                    			<tr>
                    				<th>ID</th>
                    				<th>Nama TO</th>
                    				<th>Tanggal Mulai</th>
                    				<th>Tanggal Berakhir</th>
                                    <th>Status Publish</th>
                    				<th>Aksi</th>
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
    </div>
    <script type="text/javascript">
         var tblist_TO;
        $(document).ready(function() {
            tblist_TO = $('#tblistTO').DataTable({ 
             "ajax": {
                "url": base_url+"index.php/toback/ajax_listsTO/",
                "type": "POST"
            },
            "processing": true,
            });
        });

        function dropTO(id_tryout) {
             if (confirm('Apakah Anda yakin akan menghapus data ini? ')) {
               // ajax delete data to database
                $.ajax({
                     url : base_url+"index.php/toback/dropTO/"+id_tryout,
                     type: "POST",
                     dataType: "TEXT",
                     success: function(data,respone)
                     {  
                            console.log(data);
                            console.log(respone);
                            //if success reload ajax table
                            // $('#modal_form').modal('hide');
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

        function edit_TO(id_tryout) 
        {
            $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string  
            $('#modal_editTO').modal('show'); 
                $.ajax({
                url : base_url+"index.php/toback/ajax_edit/" + id_tryout,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    $('[name="id_tryout"]').val(data.id_tryout);
                    $('[name="nama_tryout"]').val(data.nm_tryout);
                    $('[name="tgl_mulai"]').val(data.tgl_mulai);
                    $('[name="tgl_berhenti"]').val(data.tgl_berhenti);
                     // $('[name="publish"]').val(data.publish);
                     if (data.publish==1) {
                        $('#publish').attr('checked',true)
                     } else {
                        $('#publish').attr('unchecked',true)
                     }
                    $('#modal_editTO').modal('show');  // show bootstrap modal when complete loaded
                    // $('.modal-title').text('Edit Paket Soal'); // Set title to Bootstrap modal title

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }
        function saveedit(){
            $('#btneditTo').text('saving...'); //change button text
            $('#btneditTo').attr('disabled',true); //set button disable 
            var url;
            var datas = $('#formeditTO').serialize();
            console.log("asd"+datas);
            url = base_url+"index.php/toback/editTryout/";
            // ajax adding data to database
            $.ajax({
                url : url,
                type: "POST",
                data: datas,
                dataType: "TEXT",
                success: function(data)
                {
                    $('#modal_editTO').modal('hide'); 
                    $('#btneditTo').text('save'); //change button text
                    $('#btneditTo').attr('disabled',false); //set button enable
                    reload_tblist(); 
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error adding / update data');
                    $('#btneditTo').text('save'); //change button text
                    $('#btneditTo').attr('disabled',false); //set button enable 

                }
            });

        }

    // ##opik##
    function show_peserta(uuid){
        window.location = 'reportto/'+uuid;
    }
    </script>
</section>