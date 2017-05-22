<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Paket Soal Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <div class="panel-body">
                     <!-- START PESAN ERROR EMPTY INPUT -->
                     <div class="form-group alert alert-dismissable alert-danger" id="e_paket" hidden="true" >
                        <button type="button" class="close" onclick="hide_e_paket()" >×</button>
                        <strong>O.M.G.!</strong> Silahkan Diisi Semua.
                    </div>
                    <!-- END PESAN ERROR EMPTY INPUT -->
                    <div class="form-group">
                        <div class="row">
                            <input type="hidden" value="" name="id_paket"/>
                            <div class="col-sm-12">

                                <label class="control-label">Nama Paket <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-7">
                                <span class="text-danger"><?php echo form_error('nama_paket'); ?></span>
                                <input type="text" name="nama_paket" class="form-control" placeholder="First" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label class="control-label">Deskripsi </span></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <textarea class="form-control" name="deskripsi" id="deskripsi"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="control-label">Jumlah Soal <span class="text-danger">*</span></label>
                                <select name="jumlah_soal" class="form-control" id="jumlah_soal" required>
                                    <option value="">-Pilih Jumlah Soal-</option>
                                    <?php for ($i=5;$i<=60;$i++): 
                                    if ($i % 5 ==0) { ?>
                                    <option value=<?=$i ?>><?=$i ?></option>
                                    <?php } endfor ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="control-label">Durasi <span class="text-danger">*</span></label>
                                <!-- <input type="text" name="durasi"  class="form-control" id="durasi" required> -->
                                <select name="durasi"  class="form-control" id="durasi" required="true">
                                  <option value="">-Pilih Durasi-</option>
                                  <option value="15">15</option>
                                  <option value="30">30</option>
                                  <option value="45">45</option>
                                  <option value="60">60</option>
                                  <option value="75">75</option>
                                  <option value="90">90</option>
                                  <option value="105">105</option>
                                  <option value="120">120</option>
                                  <option value="135">135</option>
                              </select>
                          </div>
                      </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <label class="control-label">Apakah soal akan di random?</label>
                            <div class="checkbox custom-checkbox">  
                                <input type="checkbox" name="random" id="idrand" value="1">  
                                <label for="idrand"> Random
                                </label> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <button type="submit" class="btn btn-primary" name="proses" id="btnSave" onclick="save()" >Simpan</button>
                <button type="reset" class="btn btn-danger" id="btnReset">reset</button>
            </div>
        </div>
    </form>
</div>
</div>
</div>    
</div>
<div class="modal fade" id="modal_addsoal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Paket Soal Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <div class="panel-body">
                        <div class="panel-footer">
                            <button type="submit" class="btn btn-primary" name="proses" id="btnSave" onclick="save()" >Proses</button>
                            <button type="reset" class="btn btn-inverse" id="btnReset">reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>    
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-inverse mr10 ml10">
            <div class="panel-heading">
                <h3 class="panel-title">Paket Soal        
                </div>
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <form class="panel panel-teal" action="" data-parsley-validate>
                                <div class="panel-heading">
                                    <h3 class="panel-title"><i class="ico-books"></i>Daftar Paket Soal</h3>
                                    <div class="panel-toolbar text-right">
                                        <a onclick="add_paket()" class="btn btn-inverse btn-outline"><i class="glyphicon glyphicon-plus" title="Add Paket Soal"></i></a>
                                        <a onclick="reload_table()" class="btn btn-inverse "><i class="glyphicon glyphicon-refresh" title="Refresh"></i></a>
                                    </div>
                                </div>               
                                <div class="panel-body">
                                    <table class="table table-striped table-bordered" style="font-size: 13px" id="tbpaket" width="100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th>Nama Paket Soal</th>
                                                <th>Jumlah soal</th>
                                                <th class="text-center">Durasi</th>
                                                <th>Random</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th>Nama Paket Soal</th>
                                                <th>Jumlah soal</th>
                                                <th class="text-center">Durasi</th>
                                                <th>Random</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<script type="">
    var save_method; //for save method string
    var table;
    $(document).ready(function() {
      table = $('#tbpaket').DataTable({ 
       "ajax": {
        "url": base_url+"index.php/paketsoal/ajax_list",
        "type": "POST"
      },
      "language": {
        "blengthMenu": "Menampilkan _MENU_ records per page",
        "bzeroRecords": "Maaf Tidak ada yang ditemukan",
        "binfo": "Menampilkan page _PAGE_ dari _PAGES_",
        "binfoEmpty": "Tidak Ada Record Guru",
        "binfoFiltered": "(filtered from _MAX_ total records)"
      },

      "processing": true,


    });

    });

//panggil modal

function hide_e_paket() {
    $("#e_paket").hide();
}

function add_paket(){
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Tambah Paket Baru'); // Set Title to Bootstrap modal title
}

//fungsi simpan
// dari sini 
function save(){
    var id_paket =$('[name="id_paket"]').val();
    var nama_paket= $('[name="nama_paket"]').val();
    var jumlah_soal  = $('[name="jumlah_soal"]').val();
    var durasi = $('[name="durasi"]').val();
    var deskripsi= $('[name="deskripsi"]').val();
    var random = $('input[name=random]:checked').val();

    if (!random) {
        random = 0;
    };
    
    var url;

    if(save_method == 'add') {

        url = base_url+"index.php/paketsoal/addpaketsoal";

    } else {
        console.log("ini budi");
        url = base_url+"index.php/paketsoal/updatepaketsoal";

    }



    if (nama_paket != "" && jumlah_soal != ""  && durasi != ""  ) {
         $('#btnSave').text('saving...'); //change button text
         $('#btnSave').attr('disabled',true); //set button disable 

             // ajax adding data to database
             var datas = {id_paket:id_paket,
                            nama_paket:nama_paket,
                          jumlah_soal:jumlah_soal,
                          deskripsi:deskripsi,
                          durasi:durasi,
                          random:random};

             $.ajax({
                url : url,
                type: "POST",
                data: datas,
                dataType: "TEXT",
                success: function(data)
                {

                   $('#modal_form').modal('hide');
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable
                reload_table(); 
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable 
            }
        });
         } else {
           $("#e_paket").show();
       }
   }
// sampai sini

function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}

function delete_paket(id)
{

// =============
url = base_url+"index.php/paketsoal/droppaketsoal/"+id;
  swal({
    title: "Yakin akan menghapus Paket ini?",
    text: "Anda tidak dapat membatalkan ini.",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Ya,Tetap hapus!",
    closeOnConfirm: false
  },
  function(){
    var datas = {id:id};
    $.ajax({
      dataType:"text",
      data:datas,
      type:"POST",
      url:url,
      success:function(){
        swal("Terhapus!", "Paket berhasil dihapus.", "success");
        reload_table();
      },
      error:function(){
        sweetAlert("Oops...", "Data gagal terhapus!", "error");
      }
    });
  });

// ======================

}

function edit_paket(id)
{

    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    //Ajax Load data from ajax
    $.ajax({
        url : base_url+"index.php/paketsoal/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id_paket"]').val(data.id_paket);
            $('[name="nama_paket"]').val(data.nm_paket);
            $('[name="deskripsi"]').val(data.deskripsi);
            $('[name="jumlah_soal"]').val(data.jumlah_soal);
            $('[name="durasi"]').val(data.durasi);
            if (data.random ==1) {
               $('#idrand').attr('checked', true);
           } else {
               $('#idrand').attr('unchecked', true);
           }
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Paket Soal'); // Set title to Bootstrap modal title
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            error('Error get data from ajax');
        }
    });
}

function add_soal(id){
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_addsoal').modal('show'); // show bootstrap modal
    $('.modal-title').text('Tambah Bank Soal'); // Set Title to Bootstrap modal title
}

</script>