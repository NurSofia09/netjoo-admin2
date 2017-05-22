<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>
<link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet"></link>
<section class="id="main" role="main"">
	<!-- Start Container -->
	<div class="container-fluid">
		<!-- Start Pnel -->
		<div class="panel panel-teal">
			<!-- Start Pnel Heading -->
			<div class="panel-heading">
				<h3 class="panel-title"><?=$judul_panel;?></h3>
				<div class="panel-toolbar text-right">
					<!-- <form class="form-group">
						<p class="input-icon"> -->
							<!-- <i class="fa fa-search"></i> -->
							<!-- <input class="form-control" type="text" placeholder="Cari Pertanyaan..." name="search_data_1" id="search1">
						</p>
					</form> -->
				</div>
			</div>
			<!-- End Panel Heading -->
			<!-- Start Pnel body -->
			<div class="panel-body">
				<!-- Start row -->
				<div class="row" id="id="shuffle-grid"">
					<?php foreach ($datImg as $key ): ?>
						<div class="col-md-3 shuffle" data-groups='["nature"]' data-date-created="2014-01-02" data-title="background1">
							<!-- thumbnail -->
							<div class="thumbnail">
								<!-- media -->
								<div class="media">
									<!-- indicator -->
									<div class="indicator"><span class="spinner"></span>
									</div>
									<!--/ indicator -->
									<!-- toolbar overlay -->
									<div class="overlay">
										<div class="toolbar">
											<input type="text" value="<?=$key['file_name']?>" id="name_img" hidden="true">
											<a href="<?=base_url('/assets/image/gallery/').$key['file_name'] ;?>" target="_blank" class="btn btn-teal magnific" title="view picture"><i class="ico-search"></i></a>
											<a href="javascript:void(0);" class="btn btn-danger" title="Hapus Gambar" onclick='hapusImg("<?=$key["UUID"]?>")'><i class="ico-trash"></i></a>
										</div>
									</div>
									<!--/ toolbar overlay -->
									<!-- meta -->
									<span class="meta bottom darken">
										<h5 class="nm semibold">
											<?=$key['file_name'] ?> <br/>
											<small><i class="ico-calendar2"></i> <?=$key['date_created']?></small>
										</h5>
									</span>
									<!--/ meta -->
									<img data-toggle="unveil" src="<?=base_url('/assets/image/gallery/').$key['file_name'] ;?>" data-src="<?=base_url('/assets/image/gallery/').$key['file_name'] ;?>" alt="Photo" width="300px" height="200px" />
								</div>
								<!--/ media -->
							</div>
							<!--/ thumbnail -->
						</div>
					<?php endforeach ?>
					
					
				</div>
				<!-- END row -->
			</div>
			<!-- End Panel Body -->
			
		</div>
		<!-- End Pnel -->
	</div>
	<!-- END Container -->
</section>

<script type="text/javascript">
	$(document).ready(function() {  

		$('#search1').autocomplete({
			source:  base_url +"gallery/search_gallery",
			select: function (event, ui) {
				window.location = ui.item.url;
			}
		});
	});
	function hapusImg(UUID) {
		var name = $('#name_img').val();
		// if (confirm('Apakah Anda yakin akan menghapus data ini? ')) {
  //              // ajax delete data to database
               
  //              $.ajax({
  //              	url : base_url+"index.php/gallery/remove_img/",
  //              	type: "POST",
  //              	data: { file: name,
  //              		UUID : UUID},
  //              		dataType: "TEXT",
  //              		success: function(data,respone)
  //              		{  
               			
  //              			Swal('Berhasil Dihapus');
  //              		},
  //              		error: function (jqXHR, textStatus, errorThrown)
  //              		{
  //              			swal("Gagal!", "Menghapus gambar gagal", "warning");
  //              		}
  //              	});
  //          }

           //
		url = base_url+"index.php/gallery/remove_img/",
       swal({
        title: "Apakah Anda yakin akan menghapus Gambar ini?",
        text: "Anda tidak dapat membatalkan ini.",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya,Tetap hapus!",
        closeOnConfirm: false
      },
      function(){
        $.ajax({
          dataType:"text",
          data:{file:name,UUID:UUID},
          type:"POST",
          url:url,
          success:function(data,respone){
          	swal("Terhapus!", "ambar soal berhasil dihapus.", "success");
          	window.location = base_url();
           
          },
          error:function(){
            sweetAlert("Oops...", "Data gagal terhapus!", "error");
          }

        });
      });

           //
       }
   </script>