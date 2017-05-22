<section id="main" role="main">
	<div>
		<div class="col-md-12">
			<div class="row">
				<!-- Panel -->
				<div class="panel panel-default">
						<!-- Panel Heading -->
					  <div class="panel-heading">
              <h4 class="panel-title">Daftar Guru</h4>
              <div class="panel-toolbar text-right">
              	<a href="http://localhost/netjoo-2/register/registerGuru" class="btn btn-success"><i class="ico-user-plus"></i></a>
              </div>
            </div>
            <!-- /Panel Heading -->
            <!-- Panel Body -->
            <div class="panel-body">
            	<!-- Tabel Guru -->
            	<table class="daftarsiswa table table-striped display responsive nowrap" style="font-size: 13px" width=100%>
	            	<thead>
	            	<form action="<?=base_url()?>index.php/guru/cariGuru" method="get">
	            			<div class="input-group mb10">
	            				<input id="carisoal" type="text" name="keyword" class="form-control " placeholder="Search...">
	            				<span class="input-group-btn">
	            					<button class="btn  btn-success" type="submit" >Cari</button>
	            				</span>
	            			</div>
	            		</form>
	            		<tr>
	            			<th>No</th>
	            			<th>Nama Pengguna</th>
	            			<th>Nama</th>
	            			<th>Mengajar</th>
	            			<th>Email</th>
	            			<th>Tanggal Terdaftar</th>
	            			<th>Aksi</th>
	            		</tr>
	            	</thead>
	            	<tbody>
	            			<?=$tb_guru?>
	            	</tbody>
            	</table>
            	<!-- /Tabel Guru -->
            </div>
            <div class="panel-footer">
            	<ul class="pagination mt0 mb0 col-sm-6">
								<?php 
										echo $this->pagination->create_links();
								 ?>
							</ul>
							<div class="text-right col-sm-6"><a href="javascript:void(0);"><?=$jumlahGuru?> terdaftar</a></div>
            </div>
            <!-- /Panel Body -->
				</div>
				<!-- /Panel -->


			</div>
		</div>
	</div>
</section>
<!-- Modal form ubah email -->
<div class="modal fade" id="modal-chEmail">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<!-- Modal header -->
			<div class="modal-header">

				<button type="button" class="close" data-dismiss="modal" aria-label="Close">

					<span aria-hidden="true">&times;</span>

				</button>

				<h4 class="modal-title">Ubah Email</h4>

			</div>
			<!-- /Modal Header -->
			<div class="modal-body">
				<input class="form-control hidden" type="text" name="penggunaID" value="" >
				<input class="form-control" type="email" name="email" value="">
			</div>
			<!-- Modal Body -->

			<!-- /Modal Body -->

			<!-- Modal Footer -->
			<div class="modal-footer">
				<button class="btn btn-success" onclick="updateEmail()">Simpan Perubahan</button>
			</div>
			<!-- /Modal Footer -->
		</div>
	</div><
</div>
<!-- /Modal form ubah email -->
<!-- Modal form ubah data guru -->
<div class="modal fade" id="modal-chguru">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<!-- Modal header -->
			<div class="modal-header">

				<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="resetUlangMapel()">

					<span aria-hidden="true">&times;</span>

				</button>

				<h4 class="modal-title">Detail Data Guru</h4>

			</div>
			<!-- /Modal Header -->
			<div class="modal-body">
				<form class="form-bordered" id="formUpdateGuru" action="javascript:void(0)">
				 <div class="form-group">
				 	<input type="text" name="guruID" value="" class="form-control col-md-6 hidden"  >
					<label>Nama Depan</label>
					<input type="text" name="namaDepan" value="" class="form-control col-md-6"/> 
				</div>
				 <div class="form-group">
					<label>Nama Belakang</label>
					<input type="text" name="namaBelakang" value="" class="form-control col-md-6" />
				</div>
				<div class="form-group">
					<label>Mengajar</label>
					<input class="hidden" type="text" name="sumMapel" value="0" >
					<select class="form-control selectMapel"  name="mataPelajaran" id="mataPelajaran" required>
					</select>
				</div>
				<div class="form-group" id="listGuruMapel">
					<a class="btn btn-sm btn-danger" id="resetMapel">Reset</a>
				</div>
				 <div class="form-group">
					<label>Alamat</label>
					<input type="text" name="alamat" value="" class="form-control col-md-6" />
				</div>
				
				 <div class="form-group">
					<label>No Kontak</label>
					<input type="text" name="nokontak" value="" class="form-control col-md-6" />
				</div>
				
				 <div class="form-group">
					<label>Biografi</label>

					<textarea type="text" name="biografi" value="" class="form-control col-md-6" ></textarea>
				</div>
				<hr>
				<button type="submit" class="btn btn-success" >Simpan Perubahan</button>
				</form>
			
			</div>
			<!-- Modal Body -->

			<!-- /Modal Body -->

			<!-- Modal Footer onclick="updateDatGuru()" -->
			
			<!-- /Modal Footer -->
		</div>
	</div>
</div>
<!-- /Modal form ubah data guru -->

<!-- script event -->
<script type="text/javascript">
	function resetSandi(penggunaID='',namaPengguna='') {
		 url = base_url + "index.php/guru/resetPassword/";
		 var data;
	  swal({
	    title: "Yakin akan me-reset katasandi "+namaPengguna+"?",
	    text: "Anda tidak dapat membatalkan ini.",
	    type: "warning",
	    showCancelButton: true,
	    confirmButtonColor: "#DD6B55",
	    confirmButtonText: "Ya,Tetap me-reset katasandi!",
	    closeOnConfirm: false
	  },
	  function(){
	    var datas = {penggunaID:penggunaID,
	    							namaPengguna:namaPengguna};
	    $.ajax({
	      dataType:"text",
	      data:datas,
	      type:"POST",
	      url:url,
	      success:function(data){

	        swal("kata sandi baru : [namaPengguna]+[tgl sekarang] !", "Katasandi Baru = "+data, "success");
	       // window.location.href =base_url+"videoback/daftarvideo";
	      },
	      error:function(){
	        sweetAlert("Oops...", "Ktasandi gagal di reset!", "error");
	      }

	    });
	  });
	}

	function modalChEmail(penggunaID='',email='') {
		$('#modal-chEmail').modal('show');
		$('[name=email]').val(email);
		$('[name=penggunaID]').val(penggunaID);
	}

	function updateEmail() {
		var newEmail=$('[name=email]').val();
		var penggunaID=$('[name=penggunaID]').val();

		url = base_url + "index.php/guru/updateEmail/";
		 var data;
	  swal({
	    title: "Yakin akan mngubah Email "+penggunaID+"?",
	    text: "Anda tidak dapat membatalkan ini.",
	    type: "warning",
	    showCancelButton: true,
	    confirmButtonColor: "#DD6B55",
	    confirmButtonText: "Ya,Tetap menyimpan perubahan Email!",
	    closeOnConfirm: false
	  },
	  function(){
	    var datas = {penggunaID:penggunaID,
	    							email:newEmail};
	    $.ajax({
	      dataType:"text",
	      data:datas,
	      type:"POST",
	      url:url,
	      success:function(data){
	      	var ret= JSON.parse(data);
	      	if (ret=="FALSE") {
	      		sweetAlert("Oops...", "Email anda sudah terpakai!", "error");
	      	} else {
	      		swal("Email berhasil diperbaharui !", "Email Baru = "+data, "success");
	      	}
	        
	       // window.location.href =base_url+"videoback/daftarvideo";
	      },
	      error:function(){
	        sweetAlert("Oops...", "Email gagal diperbaharui!", "error");
	      }

	    });
	  });
	}
	
	function detail(n) {
		$("#modal-chguru").modal('show');
		var id = "#data-"+n;
		var datas = $(id).data('todo');
		var guruID = datas.guruID;
		$('[name=guruID]').val(guruID);
		$('[name=namaDepan]').val(datas.namaDepan);
		$('[name=namaBelakang]').val(datas.namaBelakang);
		$('[name=alamat]').val(datas.alamat);
		$('[name=nokontak]').val(datas.noKontak);
		$('[name=biografi]').val(datas.biografi);

		// get all mapel
		var url1=base_url+"index.php/guru/get_allMapel/";
		// 
		$.ajax({
			dataType:'text',
			data:{guruID:guruID},
			type:"POST",
			url:url1,
			success:function (data) {
				var obData =JSON.parse(data);
		
				if (obData!="FALSE") {
					$(".selectMapel").append(obData);
				} else {
					console.log(obData);
				}
			},
			error:function(){
				swal("Oops..","ada Kesalahan uu!","error");
			}
		});
		// get mapel guru
		var url2 = base_url+"index.php/guru/get_mapelGuru/";
		$.ajax({
			dataType:'text',
			data:{guruID:guruID},
			type:"POST",
			url:url2,
			success:function(data){
				var ob2Data=JSON.parse(data);
				
				// listGuruMapel
				if (ob2Data !="FALSE") {
					$("#listGuruMapel").append(ob2Data);
					$('#resetMapel').removeClass('hidden');
					$("#mataPelajaran").addClass("hidden");
				}else{
					$("#listGuruMapel").append("<h4 class='pickMapel' style='color:red;'>Belum Memilih Mapel</h4>");
					$('#resetMapel').addClass('hidden');
					$("#mataPelajaran").removeClass("hidden");

				}
			},
			error:function(){
				swal("Oops..","ada Kesalahan!","error");
			}
		});
	}

	function updateDatGuru() {
		var guruID = $('[name=guruID]').val();
		var namaDepan = $('[name=namaDepan]').val();
		var namaBelakang = $('[name=namaBelakang]').val();
		var alamat = $('[name=alamat]').val();
		var nokontak = $('[name=nokontak]').val();
		var biografi = $('[name=biografi]').val();
		url = base_url + "index.php/guru/updateDatGuru/";
		var datas = {	guruID:guruID,
									namaDepan:namaDepan,
	    						namaBelakang:namaBelakang,
	    						alamat:alamat,
	    						nokontak:nokontak,
	    						biografi:biografi
	    						};
	    $.ajax({
	      dataType:"text",
	      data:datas,
	      type:"POST",
	      url:url,
	      success:function(data){
	      	console.log(datas);
	        swal("Data Guru berhasil diperbaharui!","--","success");
	        window.location.href =base_url+"guru/daftar/";
	      },
	      error:function(){
	        sweetAlert("Oops...", "Data Guru gagal diperbaharui!", "error");
	      }
	    });
	}

	function del_guru(n) {
		var id = "#data-"+n;
		var datGuru = $(id).data('todo');
		var penggunaID = datGuru.penggunaID;
		var namaPengguna = datGuru.namaPengguna;
		var guruID	=	datGuru.guruID;
		url = base_url + "index.php/guru/drop_teacher/";

		 swal({
	    title: "Yakin akan menghapus data "+namaPengguna+"?",
	    text: "Anda tidak dapat membatalkan ini.",
	    type: "warning",
	    showCancelButton: true,
	    confirmButtonColor: "#DD6B55",
	    confirmButtonText: "Ya,Tetap Hapus!",
	    closeOnConfirm: false
	  },
	  function(){
	    var datas = {penggunaID:penggunaID,
	    							guruID:guruID};
	    $.ajax({
	      dataType:"text",
	      data:datas,
	      type:"POST",
	      url:url,
	      success:function(data){
	      	swal("Data Guru "+namaPengguna+" Behasil Dihapus !", "", "success");
	      	window.location.href =base_url+"guru/daftar/";
	      },
	      error:function(){
	        sweetAlert("Oops...", "Data Guru "+namaPengguna+" Gagal Dihapus!", "error");
	      }

	    });
	  });

	}

	function resetUlangMapel() {
		$('.pickMapel').remove();
		$('.op').remove();
	}
</script>
<script type="text/javascript">
	 $(document).ready(function(){ 
    var i =0;

    $('#mataPelajaran').change(function () {
      i ++;
      var idMapel =$('#mataPelajaran').val();
      var mapel =$('#mataPelajaran option:selected').text();
      $("#listGuruMapel").append('<span class="note note-success mb15 mr15 mt15 pickMapel" id="mapelke-'+i+'"> <i class="ico-remove" onClick="removeMapel('+i+','+idMapel+')"></i> '+mapel+' </span> <input type="text" name="mapelIDke-'+i+'" value="'+idMapel+'" hidden="true" id="mapelIDke-'+i+'">');
      // var ini = $("mapelke-"+i).text();
      // console.log(ini);
      $('[name=sumMapel]').val(i);
      //remove mapel dari dropdown
      $("#id-"+idMapel).addClass("hidden");
      $('#resetMapel').removeClass('hidden');
    }); 
    $( "#resetMapel" ).click(function() {
      i=0;
      $('.op').removeClass("hidden");  
      $('[name=sumMapel]').val(i);
      $('.pickMapel').remove();
      $('#resetMapel').addClass('hidden');
      $("#mataPelajaran").removeClass("hidden");
    }); 

    $("#formUpdateGuru").submit(function(e) { 
    		var url = base_url+"index.php/guru/update_guru_jsonDat/";
    		var formUp=$("#formUpdateGuru");
    		 $.ajax({
	      dataType:"text",
	      data:formUp.serialize(),
	      type:"POST",
	      url:url,
	      success:function(data){
	      	swal("Data Guru berhasil diperbaharui!","--","success");
	        window.location.href =base_url+"guru/daftar/";
	      },
	      error:function(){
	        sweetAlert("Oops...", "Email gagal diperbaharui!", "error");
	      }

	    });
    }); 

  }); 
	 
</script>