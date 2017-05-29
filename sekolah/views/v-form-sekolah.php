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
						<form class="panel panel-default form-horizontal form-bordered form-sekolah" method="post">
							<div class="form-group">
								<label class="col-sm-2 control-label">Provinsi</label>
								<div class="col-sm-8">
									<!-- stkt = soal tingkat -->
									<select class="form-control" name="provinsi">
										<option value="">- Pilih Provinsi -</option>
										<?php foreach ($provinces as $province): ?>
										<option value="<?=$province['id'] ?>"><?=$province['name'] ?></option>
									<?php endforeach ?>
								</select>
							</div>


						</div>



						<div class="form-group">
							<label class="col-sm-2 control-label">Kota/Kabupaten</label>
							<div class="col-sm-8">
								<!-- stkt = soal tingkat -->
								<select class="form-control" name="kota_kabupaten">
									<option value="">- Pilih Kota / Kabupaten -</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Kecamatan</label>
							<div class="col-sm-8">
								<!-- stkt = soal tingkat -->
								<select class="form-control" name="kecamatan">
									<option value="">- Pilih Kecamatan -</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Nama Sekolah</label>
							<div class="col-sm-8">
								<!-- stkt = soal tingkat -->
								<input type="text" name="nama_sekolah" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Phone</label>
							<div class="col-sm-8">
								<!-- stkt = soal tingkat -->
								<input type="text" name="phone" class="form-control">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Alamat Sekolah</label>
							<div class="col-sm-8">
								<textarea class="form-control" name="alamat"></textarea>
							</div>
						</div>


						<div class="form-group no-border">
							<div class="col-sm-6 ml10">
								<a class="btn btn-primary simpan_token">Tambah</a> 
								<a class="btn btn-success" href="<?=base_url('sekolah/daftarsekolah') ?>">Daftar Sekolah</a> 
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
$('select[name=provinsi]').change(function(){
	id_provinsi = $('select[name=provinsi]').val();
	// console.log(id_provinsi);
	$('select[name=kota_kabupaten]').html("<option value='null'>- Loading... -</option>");

	get_data_regency(id_provinsi)
});


$('select[name=kota_kabupaten]').change(function(){
	id_kota_kabupaten = $('select[name=kota_kabupaten]').val();
	if (id_kota_kabupaten!="") {
		get_data_district(id_kota_kabupaten);
	};
});

$('.simpan_token').click(function(){
	data_serialize = $('.form-sekolah').serialize();
	if(data_serialize.indexOf('=&') > -1 || data_serialize.substr(data_serialize.length - 1) == '='){
		swal("Kesalahan Input","Silahkan Lengkapi Data","error");
	}else{
		simpan_token(data_serialize);
	}
});


function simpan_token(data_serialize){
	$.ajax({
		url:base_url+"sekolah/add_sekolah",
		data:data_serialize,
		type:"POST",
		dataType:"JSON",
		success:function(data){
			console.log(data);
			if (data.status==1) {
				swal("Berhasil","Sekolah Berhasil Ditambahkan","success");
				$('.form-sekolah')[0].reset();
			}else{
				swal("Kesalahan Input","Gagal memasukan data","error");
			}
		},error:function(){
			swal("Kesalahan Input","Silahkan Lengkapi Data","error");
		}
	});
}

function get_data_district(id_kota_kabupaten){
	url = base_url+"sekolah/get_kecamatan_by_kotakabupaten_id/"+id_kota_kabupaten;

	$('select[name=kecamatan]').html("<option value='null'>- Pilih Kecamatan -</option>");
	$.getJSON( url, function( json ) {
		$.each( json, function( key, val ) {
			$('select[name=kecamatan]').append( "<option value='" + val.id + "'>" + val.name + "</option>" );
		});
	});
}

function get_data_regency(id_provinsi){
	url = base_url+"sekolah/get_kota_kabupaten_by_provinceid/"+id_provinsi;

	$('select[name=kecamatan]').html("<option value='null'>- Pilih Kecamatan -</option>");
	$('select[name=kota_kabupaten]').html("<option value='null'>- Pilih Kota / Kabupaten -</option>");
	$.getJSON( url, function( json ) {
		$.each( json, function( key, val ) {
			$('select[name=kota_kabupaten]').append( "<option value='" + val.id + "'>" + val.name + "</option>" );
		});
	});
}
</script>