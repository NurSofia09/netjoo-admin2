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
										<?php if (empty($single_sekolah)): ?>
											<option value="">- Pilih Provinsi -</option>
										<?php else: ?>
											<option value="<?=$single_sekolah['provinsiID'] ?>"><?=$single_sekolah['namaProvinsi'] ?></option>
										<?php endif ?>
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
										<?php if (empty($single_sekolah)): ?>
											<option value="">- Pilih Kota / Kabupaten -</option>
										<?php else: ?>
											<option value="<?=$single_sekolah['kotaID'] ?>"><?=$single_sekolah['namaKota'] ?></option>
										<?php endif ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label">Kecamatan</label>
								<div class="col-sm-8">
									<!-- stkt = soal tingkat -->
									<select class="form-control" name="kecamatan">
										<?php if (empty($single_sekolah)): ?>
											<option value="">- Pilih Kecamatan -</option>
										<?php else: ?>
											<option value="<?=$single_sekolah['kecamatanID'] ?>"><?=$single_sekolah['kecamatan'] ?></option>
										<?php endif ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Nama Sekolah</label>
								<div class="col-sm-8">
									<!-- stkt = soal tingkat -->
									<input type="text" name="nama_sekolah" class="form-control" 
									value="<?=(empty($single_sekolah)) ? "" : $single_sekolah['namaSekolah'] ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Phone</label>
								<div class="col-sm-8">
									<!-- stkt = soal tingkat -->
									<input type="text" name="phone" class="form-control" value="<?=(empty($single_sekolah)) ? "" : $single_sekolah['phone'] ?>">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label">Alamat Sekolah</label>
								<div class="col-sm-8">
									<textarea class="form-control" name="alamat"><?=(empty($single_sekolah)) ? "" : $single_sekolah['alamat'] ?></textarea>
								</div>
							</div>


							<div class="form-group no-border">
								<div class="col-sm-6 ml10">

									<?php if (empty($single_sekolah)): ?>
										<a class="btn btn-primary simpan_sekolah">Tambah</a>

									<?php else: ?>
										<input type="hidden" name="id" value="<?=$this->uri->segment(3) ?>">
										<a class="btn btn-primary update_sekolah">Update</a> 

									<?php endif ?>

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
		$('select[name=kota_kabupaten]').html("<option value='null'>- Loading... -</option>");
		get_data_regency(id_provinsi)
	});


	$('select[name=kota_kabupaten]').change(function(){
		id_kota_kabupaten = $('select[name=kota_kabupaten]').val();
		if (id_kota_kabupaten!="") {
			get_data_district(id_kota_kabupaten);
		};
	});

	$('.simpan_sekolah').click(function(){
		data_serialize = $('.form-sekolah').serialize();
		if(data_serialize.indexOf('=&') > -1 || data_serialize.substr(data_serialize.length - 1) == '='){
			swal("Kesalahan Input","Silahkan Lengkapi Data","error");
		}else{
			simpan_sekolah(data_serialize);
		}
	});

	$('.update_sekolah').click(function(){
		data_serialize = $('.form-sekolah').serialize();
		if(data_serialize.indexOf('=&') > -1 || data_serialize.substr(data_serialize.length - 1) == '='){
			swal("Kesalahan Input","Silahkan Lengkapi Data..","error");
		}else{
			update_sekolah(data_serialize);
		}
	});

	function update_sekolah(data_serialize){
		$.ajax({
			url:base_url+"sekolah/update_sekolah",
			data:data_serialize,
			type:"POST",
			dataType:"JSON",
			success:function(data){
				if (data.status==1) {
					swal("Berhasil","Sekolah Berhasil Diupdate","success");
					setTimeout(function(){
						window.location.reload(1);
					}, 2000);
					$('.form-sekolah')[0].reset();
				}else{
					swal("Kesalahan Input","Gagal memperbarui data","error");
				}
			},error:function(data){
				swal("Kesalahan Input","Gagal koneksi","error");
			}
		});
	}

	function simpan_sekolah(data_serialize){
		$.ajax({
			url:base_url+"sekolah/add_sekolah",
			data:data_serialize,
			type:"POST",
			dataType:"JSON",
			success:function(data){
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