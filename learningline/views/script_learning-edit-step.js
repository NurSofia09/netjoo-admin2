<script>
var value;




$(document).ready(function(){


	relasi = $('input[name=relasi]').val();
	value = $('input[name=jenis_step]').val();

	if (value==1) {
	$('select[name=select_jenis]').html("<option value='1'>Video</option>");
	}else if(value==2){
	$('select[name=select_jenis]').html("<option value='2'>Materi</option>");
	}else{
	$('select[name=select_jenis]').html("<option value='3'>Latihan</option>");

	}


	// 
	if (value==1) {
		load_video();
	}else if(value==2){
		load_materi();
		// $('.jenis').html("<h4 class='text-center animation animating pulse'>Materi</h4>");
	}else if(value==3){
		$('.jenis').html("<h4 class='text-center animation animating pulse'>Latihan</h4>");		
	}else{
		$('.jenis').html("<h4 class='text-center animation animating pulse'>Error</h4>");
	}
})

function update(data){
	var url = base_url+"learningline/ajax_update_learning_step/";

	if (data.urutan=="" || data.namastep=="" || data.select_jenist) {
		swal('Silahkan lengkapi data');
	}else{
		$.ajax({
			data:data,
			datatType:"text",
			url:url,
			type:"POST",
			success:function(){
				swal('step berhasil Diperbaharui');
				// $('.form-line')[0].reset();
				swal({
					title: "step berhasil Diperbaharui!",
					text: "Tambahkan baru, atau selesai?",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Selesai",
					cancelButtonText: "Tambah",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					if (isConfirm) {
						swal("selesai", "Anda akan dialihkan ke daftar step", "success");
						// window.location.href = base_url+"learningline";
					} else {
						swal("Tambah Data", "silahkan ambahkan data");
						$('.jenis').html("<h4 class='text-center animation animating pulse'>Pilih Jenis Terlebih Dahulu</h4>");	
					}
				});

			},
			error:function(){
				sweetAlert('Data gagal disimpan','error');
			}
		});
	}
}
$('.update_step').click(function(){
	var form = {
		urutan:$('input[name=urutan]').val(),
		namastep:$('input[name=namastep]').val(),
		select_jenis:$('select[name=select_jenis]').val()
	};
	var data;
	if (value==1) {
		data = {
			videoID:$('input[name=video]:checked').val(),
			urutan:form.urutan,
			namastep:form.namastep,
			select_jenis:form.select_jenis,
			id:$('input[name=id]').val()
		};
		update(data);
	}else if(value==2){
		data = {
			materiID:$('input[name=materi]:checked').val(),
			urutan:form.urutan,
			namastep:form.namastep,
			select_jenis:form.select_jenis,
			id:$('input[name=id]').val()
		};
		update(data);
	}else if(value==3){

	}else{
		swal('Silahkan Pilih Jenis Step!');
	}


});
//biar inputin number aja
$('input[name=urutan]').keyup(function () {
	if (this.value != this.value.replace(/[^0-9\.]/g, '')) {
		this.value = this.value.replace(/[^0-9\.]/g, '');
	}
});

//# ketika tombol di klik
function detail(id){
	var kelas ='.detail-'+id;
	var data = $(kelas).data('id');
	var links;

	$('h3.semibold').html(data.judulMateri);
		// links = '<?=base_url();?>assets/video/' + data.namaFile;
		$('#isicontent').html(data.isiMateri); 
		$('.detail_materi').modal('show');


	}
//##

// load video pada saat dipilih jenis video
function load_video(){
	var tabel;
	$('.jenis').html("<h4 class='text-center animation animating pulse'>Daftar Video</h4>");
	$('.jenis').append('<div class="panel panel-default">'+
		'<div class="panel-heading">'+
		'<h3 class="panel-title">Tabel Topik Line</h3> '+
		'<div class="panel-toolbar text-right">'+
		'</div>'+

		'</div>'+
		'<div class="panel-body">'+
		'<table class="daftarvideo table table-striped display responsive nowrap" style="font-size: 13px" width=100%>'+
		'<thead>'+
		'<tr>'+
		'<th>Id video</th>'+
		'<th>Judul Sub Bab</th>'+

		'<th>Judul Video</th>'+
		'<th width="10%">pilih</th>'+
		'</tr>'+
		'</thead>'+

		'<tbody>'+

		'</tbody>'+
		'</table>'+
		'</div>'+

		'</div>');

	// var url = base_url+"learningline/ajax_get_video/"+<?=$this->uri->segment(3)?>+"";
	babID = $('input[name=babID]').val();	
	var url = base_url+"learningline/ajax_get_video_edit/"+babID+"/"+relasi;
	console.log(url);	

	tabel = $('.daftarvideo').DataTable({
		"ajax": {
			"url": url,
			"type": "POST"
		},
		"emptyTable": "Tidak Ada Data Pesan",
		"info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
	});

}
// load video pada saat dipilih jenis video

// load video pada saat dipilih jenis video
function load_materi(){
	var tabel;
	$('.jenis').html("<h4 class='text-center animation animating pulse'>Daftar Materi</h4>");
	$('.jenis').append('<div class="panel panel-default">'+
		'<div class="panel-heading">'+
		'<h3 class="panel-title">Tabel Topik Line</h3> '+
		'<div class="panel-toolbar text-right">'+
		'</div>'+

		'</div>'+
		'<div class="panel-body">'+
		'<table class="daftarvideo table table-striped display responsive nowrap" style="font-size: 13px" width=100%>'+
		'<thead>'+
		'<tr>'+
		'<th>Id Materi</th>'+
		'<th>Judul Materi</th>'+
		'<th>Isi Materi</th>'+
		'<th width="10%">pilih</th>'+
		'</tr>'+
		'</thead>'+

		'<tbody>'+

		'</tbody>'+
		'</table>'+
		'</div>'+

		'</div>');

	// var url = base_url+"learningline/ajax_get_video/"+<?=$this->uri->segment(3)?>+"";
	babID = $('input[name=babID]').val();	
	var url = base_url+"learningline/ajax_get_materi_edit/"+babID+"/"+relasi;
	console.log(url);

	tabel = $('.daftarvideo').DataTable({
		"ajax": {
			"url": url,
			"type": "POST"
		},
		"emptyTable": "Tidak Ada Data Pesan",
		"info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
	});
}
// load video pada saat dipilih jenis video
$(".video_checkbox").change(function(){
		alert(',asdu');
});

// the selector will match all input controls of type :checkbox
// and attach a click event handler 
/*$("input['name=video']").on('click', function() {
  // in the handler, 'this' refers to the box clicked on
  var $box = $(this);
  alert('nasyj');
  if ($box.is(":checked")) {
    // the name of the box is retrieved using the .attr() method
    // as it is assumed and expected to be immutable
    var group = "input:checkbox[name='" + $box.attr("name") + "']";
    // the checked state of the group/box on the other hand will change
    // and the current value is retrieved using .prop() method
    $(group).prop("checked", false);
    $box.prop("checked", true);
  } else {
    $box.prop("checked", false);
  }
});*/
</script>