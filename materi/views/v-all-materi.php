<!-- Start Modal Detail Video dari server -->
	<div class="modal fade" id="mdetailvideo">

		<div class="modal-dialog" role="document">

			<div class="modal-content">

				<div class="modal-header">

					<button type="button" class="close" data-dismiss="modal" aria-label="Close">

						<span aria-hidden="true">&times;</span>

					</button>

					<h3 class="semibold mt0 text-accent text-center"></h3>

				</div>

				<div class="modal-body">
					<p id="isicontent">
						
					</p>
				</div>

				<div class="modal-footer">

					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

				</div>

			</div>

		</div>

	</div>
	<!-- End Modal Detail Video -->
<section class="id="main" role="main"">
	<div class="container-fluid">
		<!-- Start row -->
		<div class="row">
			
			<div class="col-md-12">
				<!-- Start Panel -->
				<div class="panel panel-teal" >
				<!-- Start Pnel Heading -->
				<div class="panel-heading">
					<h3 class="panel-title">List Materi</h3>
					<!-- Start menu tambah materi -->
                        <div class="panel-toolbar text-right">
                            <a class="btn btn-inverse btn-outline" href="<?= base_url(); ?>index.php/materi/form_materi" title="Tambah Data" ><i class="ico-plus"></i></a>
                        </div>
                         <!-- END menu tambah materi -->

				</div>
				<!-- End Panel Heading -->
				<!-- Start Panel Body -->
				<div class="panel-body">
					<table class="table table-striped" id="zero-configuration" style="font-size: 12px" width="100%">
						<thead>
							<tr>
							<th>No</th>
								<th>Judul</th>
								<th>Tingkat</th>
								<th>Matapelajarn</th>
								<th>Bab</th>
								<th>Sub Bab</th>
								<th>Tanggal di buat</th>
								<th>Status</th>
								<th width="20%">Aksi</th>
							</tr>
						</thead>
						<tbody>

						</tbody>
					</table>
				</div>
				<!-- END Panel Body -->
				</div>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
	var  $list_materi;
	$(document).ready(function() {
		//#get list by id guru
		$list_materi = $('#zero-configuration').DataTable({ 
			"processing": true,
			"ajax": {
				"url": base_url+"index.php/materi/ajax_get_all_materi",
				"type": "POST"
			},
		});
		//##

	});

//# ketika tombol di klik
function detail(id){
	var kelas ='.detail-'+id;
	var data = $(kelas).data('id');
	var links;

	$('h3.semibold').html(data.judulMateri);
		// links = '<?=base_url();?>assets/video/' + data.namaFile;
		$('#isicontent').html(data.isiMateri); 
		$('#mdetailvideo').modal('show');
	
	
}
//##

//# fungsi menghapus video
function drop_materi(UUID){
	if(confirm('Are you sure delete this data?')){
		$.ajax({
			url : base_url+"index.php/materi/del_materi/"+UUID,
			type: "POST",
			dataType: "TEXT",
			success: function(data)
			{
				console.log('success');
				reload_tblist();
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				swal('Error deleting data');
			}
		});
	}
}
// fungsi updt


//fungsi reload table
function  reload_tblist(){
	$list_materi.ajax.reload(null,false);
}

</script>