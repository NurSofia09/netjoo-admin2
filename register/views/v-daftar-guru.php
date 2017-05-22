<div class="modal fade" id="modalku">

	<div class="modal-dialog" role="document">

		<div class="modal-content">



			<div class="modal-header">

				<button type="button" class="close" data-dismiss="modal" aria-label="Close">

					<span aria-hidden="true">&times;</span>

				</button>

				<h4 class="modal-title"></h4>

			</div>



			<div class="modal-body">

				<p>Nama Depan</p>

				<input type="text" name="namaDepan" value="" class="form-control col-md-6"/> <br>

				<p>Nama Belakang</p>

				<input type="text" name="namaBelakang" value="" class="form-control col-md-6" />

				<p>Alamat</p>

				<input type="text" name="alamat" value="" class="form-control col-md-6" />

				<p>No Kontak</p>

				<input type="text" name="nokontak" value="" class="form-control col-md-6" />

				<p>Nama Pengguna</p>

				<input type="text" name="namaPengguna" value="" class="form-control col-md-6" />

				<p>Email</p>

				<input type="text" name="Email" value="" class="form-control col-md-6" />

				<p>Status</p>

				<input type="text" name="Status" value="" class="form-control col-md-6" />

				<br>

			</div>



			<div class="modal-footer">

				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

				<button type="button" class="btn btn-primary">Save changes</button>

			</div>



		</div>

	</div>

</div>



<section class="row">

	<section class="col-md-12">

		<div class="panel panel-default">

			<!-- panel heading/header -->

			<div class="panel-heading">

				<h3 class="panel-title"><i class="ico-user"></i> Daftar Guru <a href="<?=base_url('register/registerGuru') ?>" class="btn btn-success"><i class="ico-user-plus"></i></a></h3>



			</div>

			<!--/ panel heading/header -->

			<!-- panel body with collapse capabale -->

			<div class="panel-collapse pull out">

				<div class="panel-body">

					<div class="row">

						<div class="col-md-12" style="background: white"><br>

							<table class="daftarguru table table-striped mt15" style="font-size: 13px">

								<thead>

									<tr>
										<th>no</th>
										<th>Nama Lengkap</th>
										<th>Nama Pengguna</th>
										<th>Kelompok Keahlian</th>
										<th>Tanggal Daftar</th>
										<th>Email</th>
										<th>Aksi</th>
									</tr>

								</thead>



								<tbody>



								</tbody>

							</table>

						</div>

					</div>

				</div>

			</div>

			<!--/ panel body with collapse capabale -->

		</div>



	</section>

	<script type="text/javascript">

		var table;



		$(document).ready(function() {

			url = base_url+"guru/ajax_list_guru";

			//load daftar guru.

			$(document).ready(function() {

				table = $('.daftarguru').DataTable({ 

					"ajax": {

						"url": url,

						"type": "POST"

					},

					"processing": true,

				});

			});


		});

		//function reload

		function reload(){

			table.ajax.reload();

		}



		//function delete gur

		function delete_teacher(id,idp){

			// console.log(base_url+"guru/drop_teacher/"+id);

			if(confirm('Yakin akan hapus data ini?')){

				$.ajax({

					url : base_url+"guru/drop_teacher/"+id+"/"+idp,

					type: "POST",

					dataType: "JSON",

					success: function(data)

					{

						reload();

					},

					error: function (jqXHR, textStatus, errorThrown)

					{

						swal('Error deleting data');

					}

				});

			}

		}





		function detail_teacher(data){

			var kelas = ".detail-"+data;

			var datas = $(kelas).data('todo');
			console.log(datas);
			$('[name=namaDepan]').val(datas.namaDepan);

			$('[name=namaBelakang]').val(datas.namaBelakang);

			$('[name=alamat]').val(datas.eMail);

			$('[name=nokontak]').val(datas.noKontak);

			$('[name=namaPengguna]').val(datas.namaPengguna);

			$('[name=Email]').val(datas.eMail);

			// $('[name=Status]').val(datas.status);

			if (datas.status=='1') {

				$('[name=Status]').val("Aktif")				

			}else{

				$('[name=Status]').val("Tidak Aktif")							

			}



			$('h4.modal-title').html("Detail untuk data : "+datas.namaDepan+" "+datas.namaBelakang)

			$('#modalku').modal('show');

		}

	</script>