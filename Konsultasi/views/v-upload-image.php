<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/library/dropzone/dropzone.min.css">

<main class="container">
	<!-- Start Field Upload Image --><br>
	<div class="form-group" id="content">
		<div id="my-dropzone" class="dropzone">
			<div class="dz-message">
				<h3>Drop files disini</h3> atau <strong>click</strong> untuk upload
			</div>
		</div>
	</div>
	<!-- END Field Upload Image -->
</main>
<script src="<?php echo base_url(); ?>assets/library/dropzone/dropzone.min.js"></script>
<script>
	Dropzone.autoDiscover = false;
	var myDropzone = new Dropzone("#my-dropzone", {
		url: "<?php echo site_url("konsultasi/do_upload/")?>",
		success:function(data){
			
		},
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