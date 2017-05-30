<!-- START Template Main -->
<section id="main" role="main"> 

	<!-- START Template Container -->
	<div class="container-fluid">
		<!-- START row -->
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-teal">
					<div class="panel-heading">
						<h3 class="panel-title">Daftar Admin Sekolah</h3>
						<!-- Start menu tambah soal -->
						<div class="panel-toolbar text-right">
						<a class="btn btn-inverse btn-outline" href="<?= base_url(); ?>index.php/pengawas/formPengawas" title="Tambah Data" ><i class="ico-plus"></i></a>
						</div>
						<!-- END menu tambah soal -->
					</div>
					<table class="table table-striped table-bordered" id="tb_pengawas" style="font-size: 13px" width="100%">
						<thead>
							<tr>
								<th >No</th>
								<th>Nama Pengguna</th>
								<th>Nama Sekolah</th>
								<th>Email</th>
								<th >Aksi</th>

							</tr>
						</thead>
						<tbody>

						</tbody>
					</table>
				</div>
			</div>
		</div>

		<!--/ END row -->

	</div>
	<!--/ END Template Container -->
</section>
<!-- END Template Main -->

<script type="text/javascript">
	var tb_pengawas;
    $(document).ready(function() {
        tb_pengawas = $('#tb_pengawas').DataTable({ 
           "ajax": {
                    "url": base_url+"index.php/adminsekolah/ajax_listadminsekolah/",
                    "type": "POST"
                    },
            "processing": true,
        });
        $(function () {
              $('[data-toggle="popover"]').popover()
            });
       
    });

    function dropAdminsekolah(uuid) {
	  swal({
	    title: "Yakin akan menghapus data ini?",
	    text: "Anda tidak dapat membatalkan ini.",
	    type: "warning",
	    showCancelButton: true,
	    confirmButtonColor: "#DD6B55",
	    confirmButtonText: "Ya,Tetap hapus!",
	    closeOnConfirm: false
	  },
	  function(){
	    var datas = {uuid:uuid};
	    $.ajax({
	      dataType:"text",
	      data:datas,
	      type:"POST",
	      url:base_url+"index.php/adminsekolah/deleteAdminsekolah/",
	      success:function(){
	        swal("Terhapus!", "Token berhasil dihapus.", "success");
	         reload_tblist();
	      },
	      error:function(){
	        sweetAlert("Oops...", "Data gagal terhapus!", "error");
	      }

	    });
	  });
    }
    function resetPassword(penggunaID) {
    	swal({
	    title: "Yakin akan meresset kata sandi data ini?",
	    text: "Anda tidak dapat membatalkan ini.",
	    type: "warning",
	    showCancelButton: true,
	    confirmButtonColor: "#DD6B55",
	    confirmButtonText: "Ya,Tetap Resset!",
	    closeOnConfirm: false
	  },
	  function(){
	     var datas = {penggunaID:penggunaID};
	    $.ajax({
	      dataType:"text",
	      data:datas,
	      type:"POST",
	      url:base_url+"index.php/adminsekolah/resetPassword/",
	      success:function(){
	        swal("Teresset!", "Password berhasil direset menjadi default.", "success");
	   
	      },
	      error:function(){
	        sweetAlert("Oops...", "Password gagal direset!", "error");
	      }

	    });
	  });
    }
    function reload_tblist(){
      tb_pengawas.ajax.reload(null,false); 
    }
</script>