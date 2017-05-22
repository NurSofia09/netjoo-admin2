<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/library/dropzone/dropzone.min.css">
<style type="text/css">
	body {
			background: #f7f7f7;
			font-family: 'Montserrat', sans-serif;
		}

		.dropzone {
			background: #fff;
			border: 2px dashed #ddd;
			border-radius: 5px;
		}

		.dz-message {
			color: #999;
		}

		.dz-message:hover {
			color: #464646;
		}

		.dz-message h3 {
			font-size: 200%;
			margin-bottom: 15px;
		}
</style>
<section class="id="main" role="main"">
	<div class="container-fluid">
		<!-- Start row -->
		<div class="row">
			
			<div class="col-md-12">
			<!-- Start Panel -->
			<form class="form-horizontal form-bordered panel panel-teal">
				<!-- Start Pnel Heading -->
				<input type="text" name="tampBabID" id="tampBabID" value="<?=$idBab?>"  hidden="true"  >
				<div class="panel-heading">
					<h3 class="panel-title">Form Upload Imgae Gallery</h3>
				</div>
				<!-- End Panel Heading -->
				<!-- Start Panel Body -->
				<div class="panel-body">
					<!-- Start Dropd Down depeden -->
					<div  class="form-group">

						<label class="col-sm-1 control-label">Tingkat</label>

						<div class="col-sm-2">

							<div class="note note-success mb15"><?=$datAttr['aliasTingkat']?></div>

						</div>



						<label class="col-sm-2 control-label">Mata Pelajaran</label>

						<div class="col-sm-3">

							<div class="note note-info mb15"><?=$datAttr['mp']?></div>

						</div>


							<label class="col-sm-1 control-label">Bab</label>

						<div class="col-sm-3">

							<div class="note note-inverse mb15"><?=$datAttr['judulBab']?></div>

						</div>


					</div>

					<!-- Start Field Upload Image -->
					<div class="form-group" id="content">
						<div id="my-dropzone" class="dropzone">
							<div class="dz-message">
								<h3>Drop files disini</h3> atau <strong>click</strong> untuk upload
							</div>
						</div>
					</div>
					<!-- END Field Upload Image -->

				<!-- End Panel Body -->
			</form>
			<!-- End Panel -->
			</div>
		</div>
		<!-- End Row -->
		
	</div>
</section>
	<script src="<?php echo base_url(); ?>assets/library/dropzone/dropzone.min.js"></script>
<!--Start Scriot Dropdown depeden -->
<script type="text/javascript">


	var babaID = $('#tampBabID').val();;					
		Dropzone.autoDiscover = false;
		var myDropzone = new Dropzone("#my-dropzone", {
			url: "<?php echo site_url("gallery/upload/")?>"+babaID,
			acceptedFiles: "image/*",
			addRemoveLinks: true,

			removedfile: function(file) {
				var name = file.name;
				$.ajax({
					type: "post",
					url: "<?php echo site_url("gallery/remove") ?>",
					data: { file: name },
					dataType: 'html'
				});

				// remove the thumbnail
				var previewElement;
				return (previewElement = file.previewElement) != null ? (previewElement.parentNode.removeChild(file.previewElement)) : (void 0);
			},
			init: function() {
				var me = this;
				$.get("<?php echo site_url("gallery/list_files") ?>", function(data) {
					// if any files already in server show all here
					if (data.length > 0) {
						$.each(data, function(key, value) {
							var mockFile = value;
							me.emit("addedfile", mockFile);
							me.emit("thumbnail", mockFile, "<?php echo base_url(); ?>uploads/" + value.name);
							me.emit("complete", mockFile);
						});
					}
				});
			}
		});


	</script>