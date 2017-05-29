<!-- START Template Main -->
<section id="main" role="main"> 

	<!-- START Template Container -->
	<div class="container-fluid">
		<!-- START row -->
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-teal">
					<div class="panel-heading">
						<h3 class="panel-title">Daftar Sekolah</h3>						
					</div>
					
					<div class="panel-body">
						<form class="panel panel-default form-horizontal form-bordered form-step" method="post">
							<div class="form-group">
								<label class="col-sm-2 control-label">Provinsi</label>
								<div class="col-sm-8">
									<!-- stkt = soal tingkat -->
									<input type="text" class="form-control" name="jumlah_token">
								</div>

								
							</div>



							<div class="form-group">
								<label class="col-sm-2 control-label">Kota/Kabupaten</label>
								<div class="col-sm-8">
									<!-- stkt = soal tingkat -->
									<select class="form-control" name="masa_aktif">
										<option value="0">-- Pilih Masa Aktif --</option>
										<option value="30">30 Hari</option>
										<option value="100">100 Hari</option>
										<option value="365">365 Hari</option>
									</select>
								</div>
							</div>


							<div class="form-group no-border">
								<div class="col-sm-6 ml10">
									<a class="btn btn-primary simpan_token">Generate Token</a>
								</div>
							</div>

						</form>
					</div>

				</div>
			</div>
		</div>

		<!--/ END row -->

	</div>
	<!--/ END Template Container -->
</section>
<!-- END Template Main -->

<script type="text/javascript">
var tb_pengawas;
$(document).ready(function() {
	tb_pengawas = $('#tb_pengawas').DataTable({ 
		"ajax": {
			"url": base_url+"index.php/sekolah/ajax_listPengawas/",
			"type": "POST"
		},
		"processing": true,
	});
	$(function () {
		$('[data-toggle="popover"]').popover()
	});

});

function dropPengawas(uuid) {
	swal({
		title: "Yakin akan menghapus data ini?",
		text: "Anda tidak dapat membatalkan ini.",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Ya,Tetap hapus!",
		closeOnConfirm: false
	},
	function(){
		var datas = {uuid:uuid};
		$.ajax({
			dataType:"text",
			data:datas,
			type:"POST",
			url:base_url+"index.php/pengawas/deletePengawas/",
			success:function(){
				swal("Terhapus!", "Token berhasil dihapus.", "success");
				reload_tblist();
			},
			error:function(){
				sweetAlert("Oops...", "Data gagal terhapus!", "error");
			}

		});
	});
}
function resetPassword(penggunaID) {
	swal({
		title: "Yakin akan meresset kata sandi data ini?",
		text: "Anda tidak dapat membatalkan ini.",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Ya,Tetap hapus!",
		closeOnConfirm: false
	},
	function(){
		var datas = {penggunaID:penggunaID};
		$.ajax({
			dataType:"text",
			data:datas,
			type:"POST",
			url:base_url+"index.php/pengawas/resetPassword/",
			success:function(){
				swal("Terhapus!", "Password berhasil direset menjadi default.", "success");

			},
			error:function(){
				sweetAlert("Oops...", "Password gagal direset!", "error");
			}

		});
	});
}
function reload_tblist(){
	tb_pengawas.ajax.reload(null,false); 
}
</script>