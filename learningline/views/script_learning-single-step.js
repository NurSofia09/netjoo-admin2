<script>
var topikID = <?=$this->uri->segment(3);?>;
var url = base_url+"learningline/ajax_list_get_step/"+topikID;
console.log(url);
$(document).ready(function(){
	dataTableLearning = $('.daftarstep ').DataTable({
		"ajax": {
			"url": url,
			"type": "POST"
		},
		"emptyTable": "Tidak Ada Data Pesan",
		"info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
		"bDestroy": true,

	});
});

function play(data){
	kelas = '.detail-'+data;
	meta = $(kelas).data('todo');
	// console.log(meta);
	url = base_url+"learningline/ajax_detail_video/"+meta.videoID;
	get_detail_video(url);
	$('.detailstep').modal('show');


}

function materi_detail(id){
	var kelas ='.detail-'+id;
	var data = $(kelas).data('todo');
	$('.detailstep .modal-header').html('<h3 class="semibold mt0 text-accent text-center">'+data.namaStep+'</h3>');
	url = base_url+"learningline/ajax_detail_materi/"+data.materiID;

	get_detail_materi(data.materiID,url);
	$('.detailstep').modal('show');

}

function get_detail_materi(id,url){

	$.ajax({
		url:url,
		type:"POST",
		dataType:"json",
		success:function(data){
			$.each(data, function(i,val){
				console.log('jasd');
				$('.detailstep .modal-body').html('<p id="isicontent">'+val.isiMateri+'</p>');
			});
		},error:function(){
			console.log('jassasdd');

		}
	});
}

function get_detail_video(url){
	console.log(url);
	$.ajax({
		url:url,
		type:"POST",
		dataType:"json",
		success:function(data){
			val = data['data'];
				console.log(val);
				judul = " <h4 class='modal-title' style='display: inline'>Preview Video "+val.judulVideo;
				if (val.namaFile==null) {
					console.log(meta.link);
					video = '<iframe width="100%" height="400"'+
					'src="'+val.link+'">'+
					'</iframe>';
					$('.detailstep .modal-body').html(video);
				}else{
					file = base_url+"assets/video/"+val.namaFile;
					video = '<video width="320" height="240" controls>'+
					'<source src="'+file+'" type="video/mp4">'+
					'<source src="movie.ogg" type="video/ogg">Your browser does not support the video tag.'+
					'</video>';
					$('.detailstep .modal-body').html(video);
				}
				$('.detailstep .modal-header').html(judul);
		},error:function(){
			console.log('gagal');
		}
	});
}

function latihan_detail(id, url){
	var kelas ='.detail-'+id;
	var data = $(kelas).data('todo');
	$('.detailstep .modal-header').html('<h3 class="semibold mt0 text-accent text-center">'+data.namaStep+'</h3>');
	console.log(data.latihanID);
	konten = '<div class="panel panel-default">'+
	'<div class="panel-heading">'+
	'<h3 class="panel-title">Tabel Soal</h3> '+
	'<div class="panel-toolbar text-right">'+
	'</div>'+

	'</div>'+
	'<div class="panel-body">'+
	'<table class="daftarsoal table table-striped display responsive nowrap" style="font-size: 13px" width=100%>'+
	'<thead>'+
	'<tr>'+
	'<th></th>'+
	'<th>Judul Soal</th>'+
	'<th>Sumber</th>'+
	'<th width="10%">Soal</th>'+
	'<th width="10%">Kesulitan</th>'+
	'<th width="5%">Aksi</th>'+

	'</tr>'+
	'</thead>'+

	'<tbody>'+

	'</tbody>'+
	'</table>'+
	'<div class="panel-footer">'+
	'<div class="form-group no-border">'+
	'<label class="col-sm-1 control-label"></label>'+
	'<div class="col-sm-9">'+
	'<a onclick="tambahkan_soal()" class="btn btn-primary tambahkan">Tambahkan</a>'+
	'</div>'+
	'</div>'+
	'</div>'+
	'</div>'+

	'</div>';
	url = base_url+"learningline/ajax_detail_latihan/"+data.latihanID;
	console.log(url);
	$('.detailstep .modal-body').html(konten);
	tabel = $('.daftarsoal').DataTable({
		"ajax": {
			"url": url,
			"type": "POST"
		},
		"emptyTable": "Tidak Ada Data Pesan",
		"info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
		"pageLength": 5,
	});
	$('.detailstep').modal('show');

}


function drop_step(idstep){
	url = base_url+"learningline/drop_step";
	swal({
		title: "Yakin akan hapus Step?",
		text: "Jika anda menghapus Step",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Ya,Tetap hapus!",
		closeOnConfirm: false
	},
	function(){
		var datas = {id:idstep};
		$.ajax({
			dataType:"text",
			data:datas,
			type:"POST",
			url:url,
			success:function(){
				swal("Terhapus!", "Step berhasil dihapus.", "success");
				reload();
			},
			error:function(){
				sweetAlert("Oops...", "Data gagal terhapus!", "error");
			dataTableLearning.ajax.reload(null,false);

			}

		});
	});
}
</script>