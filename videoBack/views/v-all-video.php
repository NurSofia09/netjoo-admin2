<div id="container">
	<!-- Start Modal Detail Video dari server -->
	<div class="modal fade" id="mdetailvideo">

		<div class="modal-dialog" role="document">

			<div class="modal-content">

				<div class="modal-header">

					<button type="button" class="close" data-dismiss="modal" aria-label="Close">

						<span aria-hidden="true">&times;</span>

					</button>

					<h3 class="modal-title text-center"></h3>

				</div>

				<video class=" modal-body img-tumbnail image" src="" width="100%" height="50%" controls id="video-ply" style="background:grey;">
				</video>

				<div class="modal-footer">

					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

				</div>

			</div>

		</div>

	</div>
	<!-- End Modal Detail Video -->
	<!-- Start Modal Detail Video dari link -->
	<div class="modal fade" id="mvideolink">

		<div class="modal-dialog" role="document">

			<div class="modal-content">

				<div class="modal-header">

					<button type="button" class="close" data-dismiss="modal" aria-label="Close">

						<span aria-hidden="true">&times;</span>

					</button>

					<h3 class="modal-title text-center"></h3>

				</div>

				<iframe class=" modal-body img-tumbnail image" src=""  controls id="video-ply-link" width="100%" height="315" style="background:grey;">
				</iframe>

				<div class="modal-footer">

					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

				</div>

			</div>

		</div>

	</div>
	<!-- End Modal Detail Video -->
	<div class="panel panel-teal">
		<div class="panel-heading">

				<h5 class="panel-title">Daftar Semua Video</h5>
				 <!-- Start menu upload video -->
                        <div class="panel-toolbar text-right">
                            <a class="btn btn-inverse btn-outline" href="<?=base_url('index.php/videoback/formupvideo')?>" title="Tambah Data" ><i class="ico-plus"></i></a>
                        </div>
                         <!-- END menu upload video -->

		</div>
		<table class="table table-striped" id="zero-configuration" style="font-size: 12px" width="100%">
			<thead>
				<tr>
					<th>ID</th>
					<th>Judul Video</th>
					<th>Nama File</th>
					<th>Matapelajaran</th>
					<th>Bab</th>
					<th>Subbab</th>
					<th>Deskripsi</th>
					<th>Upload by</th>
					<th>Status</th>
					<th width="20%">Aksi</th>
				</tr>
			</thead>
			<tbody>

			</tbody>
		</table>
	</div>
</div>

<script type="text/javascript">
	var  tblist_video;
	$(document).ready(function() {
		//#get list by id guru
		tblist_video = $('#zero-configuration').DataTable({ 
			"processing": true,
			"ajax": {
				"url": base_url+"index.php/videoback/ajax_get_all_video",
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

	$('h3.modal-title').html(data.judulVideo);
	if (data.namaFile != null) {
		links = '<?=base_url();?>assets/video/' + data.namaFile;
		$('#video-ply').attr('src',links); 
		$('#mdetailvideo').modal('show');
	}else if(data.link != null){
		links = data.link;
		$('#video-ply-link').attr('src',links); 
		$('#mvideolink').modal('show');
	}else{

	}
	
}
//##

//# fungsi menghapus video
function drop_video(videoID){
	if(confirm('Are you sure delete this data?')){
		$.ajax({
			url : base_url+"index.php/videoback/del_file_video/"+videoID,
			type: "POST",
			dataType: "TEXT",
			success: function(data)
			{
				swal('success');
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
	tblist_video.ajax.reload(null,false);
}

</script>