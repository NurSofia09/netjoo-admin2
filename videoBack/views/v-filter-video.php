<div id="container">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h5 class="panel-title">Video Yang Telah Anda Upload</h5>
		</div>
		<table class="table table-striped" id="zero-configuration" style="font-size: 12px">
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
				"url": base_url+"index.php/videoback/ajax_get_video_by_id_guru",
				"type": "POST"
			},
		});
		//##

	});

//# ketika tombol di klik
function detail(id){console.log(id);
	var kelas ='.detail-'+id;
	var data = $(kelas).data('id');
}
//##

//# fungsi menghapus video
function drop_video(videoID){
	if(confirm('Are you sure delete this data?')){
		$.ajax({
			url : base_url+"index.php/videoback/del_file_video/"+videoID,
			type: "POST",
			dataType: "JSON",
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