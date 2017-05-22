<script>
$('.update_topik').click(function(){
	data = 
	{babID:$('#bab').val(),
	statusLearning:1,
	deskripsi:$('textarea[name=deskripsi]').val(),
	namaTopik:$('input[name=nama_topik]').val(),
	urutan:$('input[name=urutan]').val(),
	topikID:$('input[name=topikID]').val(),
};
if (data.statusLearning=="kosongundefined" || data.namaTopik=="") {
	swal('Silahkan lengkapi data');
}else{
	var url = base_url+"learningline/ajax_update_line_topik";
	console.log(data);
	$.ajax({
		data:data,
		datatType:"text",
		url:url,
		type:"POST",
		success:function(){
			swal('Topik berhasil diperbaharui');
			swal({
				title: "Topik berhasil Diperbaharui!",
				text: "Edit lagi, atau selesai?",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Selesai",
				cancelButtonText: "Edit",
				closeOnConfirm: false,
				closeOnCancel: false
			},
			function(isConfirm){
				if (isConfirm) {
					swal("selesai", "Anda akan dialihkan ke daftar topik", "success");
					window.location.href = base_url+"learningline/topik/"+data.babID;
				} else {
          // swal("Cancelled", "Your imaginary file is safe :)", "error");
      }
  });

		},
		error:function(){
			sweetAlert('Data gagal perbaharui','error');
		}
	});
}
})
</script>