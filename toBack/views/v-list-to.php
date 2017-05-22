</style>
<section id="main" role="main">
    <!-- START MODAL EDIT TRYOUT -->
    <!-- START Modal ADD TO -->
<div class="modal fade" id="modalto" tabindex="-1" role="dialog">
  <!--START modal dialog  -->
  <div class="modal-dialog" role="document">
   <!-- STRAT MOdal Content -->
   <div class="modal-content">
    <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
     <h4 class="modal-title">Buat TO</h4>
   </div>

   <!-- START Modal Body -->
   <div class="modal-body">

     <!-- START PESAN ERROR EMPTY INPUT -->
     <div class="alert alert-dismissable alert-danger" id="e_crtTo" hidden="true" >
      <button type="button" class="close" onclick="hide_e_crtTo()" >×</button>
      <strong>O.M.G.!</strong> Tolong di ISI semua.
    </div>
    <!-- END PESAN ERROR EMPTY INPUT -->
    <!-- START PESAN ERROR EMPTY INPUT -->
     <div class="alert alert-dismissable alert-danger" id="e_wktTo" hidden="true" >
      <button type="button" class="close" onclick="hide_e_wktTo()" >×</button>
      <strong>ilahkan cek kembali!</strong> Waktu mulai dan tanggal waktu tidak sesuai.
    </div>
    <!-- END PESAN ERROR EMPTY INPUT -->
    <!-- START PESAN ERROR EMPTY INPUT -->
    <div class="alert alert-dismissable alert-danger" id="e_tglTo" hidden="true" >
      <button type="button" class="close" onclick="hide_e_tglTo()" >×</button>
      <strong>Silahkan cek kembali!</strong> Tanggal mulai dan tanggal akhir tidak sesuai.
    </div>
    <!-- END PESAN ERROR EMPTY INPUT -->
    <form class="panel panel-default form-horizontal form-bordered" action="javascript:void(0);" method="post" id="form_to">
      <div  class="form-group">
       <label class="col-sm-3 control-label">Nama Tryout</label>
       <div class="col-sm-8">
        <input type="text" class="form-control" name="nmpaket" id="to_nm">
      </div>
    </div>
    <div  class="form-group">
     <label class="col-sm-3 control-label">Tanggal Mulai</label>
     <div class="col-sm-4">
      <input type="date" class="form-control" name="tglmulai" id="to_tglmulai">
    </div >
    <div class="col-sm-4">
      <input type="time" class="form-control" name="wktmulai" id="to_wktmulai" >
    </div>
  </div>
  <div  class="form-group">
   <label class="col-sm-3 control-label">Tanggal Berakhir</label>
   <div class="col-sm-4">
    <input type="date" class="form-control" name="tglakhir" id="to_tglakhir">
  </div>
  <div class="col-sm-4">
    <input type="time" class="form-control" name="wktakhir" id="to_wktakhir" >
  </div>
</div>

<div class="form-group">
 <label class="col-sm-3 control-label">Publish</label>
 <div class="col-sm-8">
  <div class="checkbox custom-checkbox">  
   <input type="checkbox" name="publish" id="to_publish" value="1">  
   <label for="to_publish" >&nbsp;&nbsp;</label>   
 </div>
</div>
</div> 
</div>
<!-- END Modal Body -->
<!-- START Modal Footer -->
<div class="modal-footer">
  <button type="submit" id="myFormSubmit" class="btn btn-primary" onclick="crtTo()"  >Proses</button>
</div>
</form>
<!-- START Modal Footer -->
</div>
<!-- END MOdal Content -->
</div>
<!--END modal dialog  -->
</div>
<!-- END Modal ADD TO -->
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
                    <!-- START PESAN ERROR EMPTY INPUT -->
                     <div class="alert alert-dismissable alert-danger" id="e_editTo" hidden="true" >
                      <button type="button" class="close" onclick="hide_e_editTo()" >×</button>
                      <strong>O.M.G.!</strong> Tolong di ISI semua.
                    </div>
                    <!-- END PESAN ERROR EMPTY INPUT -->
                    <!-- START PESAN ERROR EMPTY INPUT -->
                     <div class="alert alert-dismissable alert-danger" id="e_editWkt" hidden="true" >
                      <button type="button" class="close" onclick="hide_e_editWkt()" >×</button>
                      <strong>Silahkan cek kembali!</strong> Waktu mulai dan waktu berakhir tidak sesuai.
                    </div>
                    <!-- END PESAN ERROR EMPTY INPUT -->
                    <!-- START PESAN ERROR EMPTY INPUT -->
                    <div class="alert alert-dismissable alert-danger" id="e_editTgl" hidden="true" >
                      <button type="button" class="close" onclick="hide_e_editTgl()" >×</button>
                      <strong>Silahkan cek kembali!</strong> Tanggal mulai dan tanggal akhir tidak sesuai.
                    </div>
                    <!-- END PESAN ERROR EMPTY INPUT -->
                    <!-- Start Form Edit TO -->
                    <form action="javascript:void(0);" id="formeditTO"  class="panel panel-default form-horizontal form-bordered">
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
                                <div class="col-sm-4">
                                  <input type="date" class="form-control" name="tgl_mulai">
                                </div>
                                 <div class="col-sm-4">
                                   <input type="time" class="form-control" name="wkt_mulai"  >
                                  </div>
                            </div>
                            <div  class="form-group">
                                <label class="col-sm-3 control-label">Tanggal Berakhir</label>
                                <div class="col-sm-4">
                                  <input type="date" class="form-control" name="tgl_berhenti">
                              </div>
                                <div class="col-sm-4">
                                  <input type="time" class="form-control" name="wkt_akhir"  >
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
                            <button type="submit" class="btn btn-primary" name="proses" onclick="saveedit()" >Proses</button>
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
    	<div class="row">
            <div class="col-md-12">
    			<div class="panel panel-teal">
                    <!--Start untuk menampilkan nama tabel -->
                    <div class="panel-heading">
                    	<h3 class="panel-title">List Try Out</h3>
                       <div class="panel-toolbar text-right">
                            <a class="btn btn-inverse btn-outline" href="javascript:void(0);" onclick="add_to()"><i class="ico-plus"></i></a>
                        </div>
                    </div>
                    <div class="panel-body">
                    	<table class="table table-striped" id="tblistTO" style="font-size: 13px" width="100%">
                    		<thead>
                    			<tr>
                    				<th>NO</th>
                    				<th>Nama TO</th>
                    				<th>Tanggal Mulai</th>
                                    <th>Waktu Mulai</th>
                    				<th>Tanggal Berakhir</th>
                                    <th>Waktu Berakhir</th>
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
                    $('[name="wkt_mulai"]').val(data.wkt_mulai);
                    $('[name="tgl_berhenti"]').val(data.tgl_berhenti);
                    $('[name="wkt_akhir"]').val(data.wkt_berakhir);
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
          
            var url;
            

            // VAR U/ PENGECEKAN INPUT
            var nm_paket   =   $('[name="nama_tryout"]').val();
            var tgl_mulai  =   $('[name="tgl_mulai"]').val();
            var tgl_akhir  =   $('[name="tgl_berhenti"]').val();
            var wkt_mulai  =   $('[name="wkt_mulai"]').val();
            var wkt_akhir  =   $('[name="wkt_akhir"]').val();
            // /
            // pengecekan inputan pembuatan to
            // cek inputan kosong
            if (nm_paket != "" && tgl_mulai != "" && tgl_akhir!= "" && wkt_mulai != "" && wkt_akhir != "" ) {
                // validasi tanggal mulai dan tanggal akhir
                if (tgl_mulai<tgl_akhir) {
                  var datas = $('#formeditTO').serialize();
                  // JIKA BERHASIL
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
                          reload_tblist(); 
                      },
                      error: function (jqXHR, textStatus, errorThrown)
                      {
                          alert('Error adding / update data');

                      }
                  });
                }else if(tgl_mulai==tgl_akhir) {
                    if (wkt_mulai>=wkt_akhir) {
                      $("#e_editWkt").show();
                    }else{
                      var datas = $('#formeditTO').serialize();
                      // JIKA BERHASIL
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
                              reload_tblist(); 
                          },
                          error: function (jqXHR, textStatus, errorThrown)
                          {
                              alert('Error adding / update data');

                          }
                      });
                    }
              }else {
                 $("#e_editTgl").show();
               }
               
            }else{
               $("#e_editTo").show();
            }

        }

    // ##opik##
    function show_peserta(uuid){
        window.location = 'reportto/'+uuid;
    }

    // 
    function hide_e_editTo() {
       $("#e_editTo").hide();
    }
    function hide_e_editTgl() {
       $("#e_editTgl").hide();
    }
    function hide_e_editWkt() {
       $("#e_editWkt").hide();
    }
    // 
    </script>
    <!-- Script utuk add TO -->
<script type="text/javascript">
 function add_to() {
  $('#modalto').modal('show'); // show bootstrap modal
  // if (halaman) {
  //   $('#modalto').modal('show'); // show bootstrap modal
  // }else{
  //   var konfirm = window.confirm("Anda akan dialihkan pada halaman tryout?");
  //   if (konfirm) {
  //   document.location.href = base_url+"index.php/toback/listTo";
  //   }
  // }

}
 function hide_e_crtTo() {
    $("#e_crtTo").hide();
  }
  function hide_e_tglTo() {
    $("#e_tglTo").hide();
  }
  function hide_e_wktTo() {
    $("#e_wktTo").hide();
  }
  function crtTo() {
    var nm_paket   =   $('#to_nm').val();
    var tgl_mulai  =   $('#to_tglmulai').val();
    var tgl_akhir  =   $('#to_tglakhir').val();
    var wkt_mulai  =   $('#to_wktmulai').val();
    var wkt_akhir  =   $('#to_wktakhir').val();
    var publish;
    if ($('#to_publish:checked')==true) {
     publish = 1;
   } else{
     publish = 0;
   }
// pengecekan inputan pembuatan to
// cek inputan kosong
if (nm_paket != "" && tgl_mulai != "" && tgl_akhir!= "" && wkt_mulai != "" && wkt_akhir != "" ) {
    // validasi tanggal mulai dan tanggal akhir
    if (tgl_mulai<tgl_akhir) {

      
     var url = base_url+"index.php/toback/buatTo";
     $.ajax({
      url : url,
      type: "POST",
      data: { nmpaket : nm_paket,
       tglmulai:tgl_mulai,
       tglakhir:tgl_akhir,
       wktmulai:wkt_mulai,
       wktakhir:wkt_akhir,
       publish :publish 

     },
       // cache: false,
       // dataType: "JSON",
       success: function(data,respone)
      {   
        reload_tblist();  
        $("#e_crtTo").hide(); 
        $('#modalto').modal('hide'); 
        $('#form_to')[0].reset(); // reset form on modals
        $('#modalto').removeClass('has-error'); // clear error class  

        },
        error: function (jqXHR, textStatus, errorThrown)
        {

                            // $("#e_crtTo").show();
        lert('Error adding / update data');
        }
        });
   }else if(tgl_mulai==tgl_akhir) {
    if (wkt_mulai>=wkt_akhir) {
      $("#e_wktTo").show();
    }else{
          var url = base_url+"index.php/toback/buatTo";
     $.ajax({
      url : url,
      type: "POST",
      data: { nmpaket : nm_paket,
       tglmulai:tgl_mulai,
       tglakhir:tgl_akhir,
       wktmulai:wkt_mulai,
       wktakhir:wkt_akhir,
       publish :publish 

     },
       // cache: false,
       // dataType: "JSON",
       success: function(data,respone)
      {   
        reload_tblist();  
        $("#e_crtTo").hide(); 
        $('#modalto').modal('hide'); 
        $('#form_to')[0].reset(); // reset form on modals
        $('#modalto').removeClass('has-error'); // clear error class  

        },
        error: function (jqXHR, textStatus, errorThrown)
        {

                            // $("#e_crtTo").show();
        lert('Error adding / update data');
        }
        });
    }
    
   }else {
     $("#e_tglTo").show();
   }
   
 }else{

   $("#e_crtTo").show();
 }
}
</script>
</section>