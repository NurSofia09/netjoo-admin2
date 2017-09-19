<section class="main">
	<div class="row">
		<div class="col-md-12">
		<!-- panel -->
			<div class="panel panel-teal">
			<!-- panel heading -->
			<div class="panel-heading">
				<h3 class="panel-title">Backup Excel Import</h3>
			</div>
			<!-- panel heading -->
				<!-- panel body -->
				<div class="panel-body">
					<div class="row">
						<div class=" table-responsive col-md-12">
							<!--  tabel-->
							<table class="table table-bordered" id="tb_xlsx">
								<thead>
									<tr>
										<th width="5%">No</th>
										<th width="15%">Tanggal Import</th>
										<th width="15%">Nama File</th>
										<th width="15%">url file</th>
										<th width="10%">Ketrangan</th>
										<th width="30%">Aksi</th>
									</tr>
								</thead>
								<tbody>

								</tbody>
							</table>
							<!--  /tabel-->
						</div>
					</div>
				</div>
				<!-- /panel body -->
			</div>
			<!-- /panel -->
		</div>
	</div>
</section>
<!-- Start Modal rollback -->
<div class="modal fade" id="modal_rollback" tabindex="-1" role="dialog" width="50%">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">validasi Rollback</h4>
			</div>
			<!-- Start Body modal -->
			<div class="modal-body">
				<form class="form-horizontal form-bordered pt0 pb0 pl0 pr0" action="javascript:void(0);">
					<div class="form-group ">
						<label class="col-sm-3 control-label">kodevalidasi</label>
						<div class="col-sm-8">
						<input class="form-control" type="password" name="kode_validasi">
						</div>

					</div>
				</form>
			</div>
			<!-- end Body modal -->
			<!-- footer modal -->
			<div class="modal-footer">
				<button class="btn btn-sm btn-danger">Submit</button>
			</div>
			<!-- /footer modal -->
		</div>
	</div>
</div>
<!-- /.modal-content -->
<script type="text/javascript">
var tabel_xlsx ;
	$(document).ready(function(){
		var url_xlsx=base_url+"import_user/ajax_xlsx";
		 tabel_xlsx = $('#tb_xlsx').DataTable( {
         "ajax": {
                    "url": url_xlsx,
                    "type": "POST"
                    },
            "processing": true,    });
		
	});
	// roolback data / exls
	function rollback(uuid,url_file) {
		swal({
  title: "Masukan kodevalidasi!",
  text: "Data yang telah di roolback tidak dapat dikembalikan:",
  type: "input",
  showCancelButton: true,
  closeOnConfirm: false,
  inputPlaceholder: "Write something"
}, function (inputValue) {
  if (inputValue === false) return false;
  if (inputValue === "") {
    swal.showInputError("Silahkan Masukan kodevalidasi!");
    return false
  }else{
  	 action_rollback(uuid,url_file,inputValue);
  }
 
});
	
	}

	function action_rollback(uuid,url_file,inputValue) {
				var url_post=base_url+"import_user/rollback_xlsx";
		var datas = {uuid:uuid,kodevalidasi:inputValue};
			$.ajax({
			url:url_post,
			data:datas,
			type:"post",
			dataType:"text",
			success:function(Data){
				 var ob_data=JSON.parse(Data);
      if (ob_data.msg==="true") {
       swal("Success","rollback berhasil","success");
       reset_form_rollback();
     } else if(ob_data.msg==="false2"){
       swal("oops","Data import tidak ditemukan!","error");
     }else{
        swal("oops","Kode validasi tidak sesuai","error");
     }
			},
		});
	}

	function del_excel(id,url_file,nama_file) {

		 swal({
    title: "Yakin menghapus data excel '"+nama_file+"' ini?",
    text: "Data akan di hapus permanaent!",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Ya,Tetap rollback!",
    closeOnConfirm: false
  },
  function(){
   var url_post=base_url+"import_user/del_bup_import_excel";
		var datas={id:id,url_file:url_file};
		$.ajax({
			url:url_post,
			data:datas,
			type:"post",
			dataType:"text",
			success:function(Data){
				// relode datatable
				tabel_xlsx.ajax.reload();
				swal(":(","data berhasil dihapus","success");

			}
		});
 });
		
	}
</script>