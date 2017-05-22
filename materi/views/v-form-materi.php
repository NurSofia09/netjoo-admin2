<section class="id="main" role="main"">
	<div class="container-fluid">
		<!-- Start row -->
		<div class="row">
			
			<div class="col-md-12">
				<!-- Start Panel -->
				<form class="form-horizontal form-bordered  panel panel-teal" action="<?=base_url()?>index.php/materi/uploadMateri" method="post" accept-charset="utf-8" enctype="multipart/form-data">
					<!-- Start HEading Panel -->
					<div class="panel-heading">
						<h3 class="panel-title">Form Input Materi</h3>
					</div>
					<!-- End Panel Heading -->

					<!-- Start Pnel Body -->
					<div class="panel-body">
						<!-- Start Dropd Down depeden -->
						<div  class="form-group">
							<label class="col-sm-1 control-label">Tingkat</label>
							<div class="col-sm-4">
								<select class="form-control" name="tingkat" id="tingkat">
									<option>-Pilih Tingkat-</option>
								</select>
							</div>
							<label class="col-sm-2 control-label">Mata Pelajaran</label>
							<div class="col-sm-4">
								<select class="form-control" name="mataPelajaran" id="pelajaran">

								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-1 control-label">Bab</label>
							<div class="col-sm-4">
								<select class="form-control" name="bab" id="bab">

								</select>
							</div>
							<label class="col-sm-2 control-label">Subab</label>
							<div class="col-sm-4">
								<select class="form-control" name="subBabID" id="subbab" required="">

								</select>
								<span class="text-danger"><?php echo form_error('subBab'); ?></span>
							</div>
						</div>
						<!-- END Drop Down depeden -->
						<div class="form-group">
							<label class="col-sm-2 control-label">Judul Materi</label>
							<div class="col-sm-9">
								<input class="form-control" type="text" name="judul" required=""  >
							</div>
						</div>
						<!-- Start field input materi -->
						<div class="form-group">
							<label class="control-label col-sm-2">Jenis Editor</label>
							<div class="col-sm-8">
								<div class="btn-group" data-toggle="buttons" >
									<label class="btn btn-teal btn-outline active " id="in-materi">
										<input type="radio" autocomplete="off" checked="true"> Input Materi
									</label>
									<label class="btn btn-teal btn-outline" id="pr-rumus">
										<input type="radio"   autocomplete="off"> Rumus Matematika
									</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<!-- Start Editor Soal -->
							<div id="editor-soal">
								<label class="control-label col-sm-2">Materi</label>
								<div class="col-sm-10">
									<textarea  name="editor1" class="form-control" id="">



									</textarea>
								</div>
							</div>
							<!-- End Editor Soal -->
							<!-- Start Math jax -->
							<div id="editor-rumus" hidden="true">
								<label class="control-label col-sm-2">Buat rumus</label>
								<div class="col-sm-10">
									<textarea class="form-control" id="MathInput" cols="60" rows="10" onkeyup="Preview.Update()" >
									</textarea>
								</div>
								<label class="control-label col-sm-2"></label>
								<div class="col-sm-10">
									<p>
										Configured delimiters:
										<ul>
											<li>TeX, inline mode: <code>\(...\)</code> or <code>$...$</code></li>
											<li>TeX, display mode: <code>\[...\]</code> or <code> $$...$$</code></li>
											<li>Asciimath: <code>`...`</code>.</li>
										</ul>
									</p>
								</div>
								<label class="control-label col-sm-2"></label>
								<div class="col-sm-10">
									<label class="control-label" >Preview is shown here:</label>
									<div class="form-control" id="MathPreview" ></div>
									<div class="form-control" id="MathBuffer" style=" 
									visibility:hidden; position:absolute; top:0; left: 0"></div>
								</div>
							</div>
							<script>
								Preview.Init();
							</script>
							<!-- End MathJax -->
						</div>
						<!-- END  field input materi -->

						<div class="form-group">
							<div class="col-sm-8 col-sm-offset-2">
								<div class="checkbox custom-checkbox">  
									<input type="checkbox" name="stpublish" id="giftcheckbox" value="1">  
									<label for="giftcheckbox" >&nbsp;&nbsp;Publish</label>   
								</div>
							</div>
						</div>

					</div>
					<!-- End Panel Body -->
					<!-- Start Penl Footer -->
					<div class="panel-footer">
						<div class="col-sm-7">
							<button type="submit" class="btn btn-primary">Simpan</button>
						</div>
					</div>
					<!-- End Panel Footer -->
				</form>
				<!-- End Pnel -->
			</div>
		</div>
	</div>
</section>
<script type="text/javascript" src="<?= base_url('assets/plugins/ckeditor/ckeditor.js') ?>"></script>
<script type="text/javascript">
	// Replace the <textarea id="editor1"> with a CKEditor
   // instance, using default configuration.

   CKEDITOR.replace( 'editor1' );


    // Script for getting the dynamic values from database using jQuery and AJAX

    $(document).ready(function () {
    	// Start event untuk jenis editor
    	$("#in-materi").click(function(){
    		$("#editor-soal").show();
    		$("#editor-rumus").hide();
    	});

    	$("#pr-rumus").click(function(){
    		$("#editor-rumus").show();
    		$("#editor-soal").hide();
    	});
           // End event untuk jenis editor
	// Strt dropp down depeden
	$('#eTingkat').change(function () {
		var form_data = {
			name: $('#eTingkat').val()
		};

		$.ajax({
			url: "<?php echo site_url('videoback/getPelajaran'); ?>",
			type: 'POST',
			dataType: "json",
			data: form_data,
			success: function (msg) {
				var sc = '';
				$.each(msg, function (key, val) {
					sc += '<option value="' + val.id + '">' + val.keterangan + '</option>';

				});
				$("#ePelajaran option").remove();
				$("#ePelajaran").append(sc);
			}
		});
	});

});

    //buat load tingkat
    function loadTingkat() {
    	jQuery(document).ready(function () {
    		var tingkat_id = {"tingkat_id": $('#tingkat').val()};
    		var idTingkat;
    		$.ajax({
    			type: "POST",
    			dataType: "json",
    			data: tingkat_id,
    			url: "<?= base_url() ?>index.php/videoback/getTingkat",
    			success: function (data) {
    				console.log("Data" + data);
    				$('#tingkat').html('<option value="">-- Pilih Tingkat  --</option>');
    				$.each(data, function (i, data) {
    					$('#tingkat').append("<option value='" + data.id + "'>" + data.aliasTingkat + "</option>");
    					return idTingkat = data.id;
    				});
    			}
    		});


    		$('#tingkat').change(function () {
    			tingkat_id = {"tingkat_id": $('#tingkat').val()};
    			loadPelajaran($('#tingkat').val());
    		})

    		$('#pelajaran').change(function () {
    			pelajaran_id = {"pelajaran_id": $('#pelajaran').val()};
    			load_bab($('#pelajaran').val());
    		})

    		$('#bab').change(function () {
    			load_sub_bab($('#bab').val());
    		})

    	})
    }
    ;



    //buat load pelajaran

    function loadPelajaran(tingkatID) {
    	$.ajax({
    		type: "POST",
    		dataType: "json",
    		data: tingkatID.tingkat_id,
    		url: "<?php echo base_url() ?>index.php/videoback/getPelajaran/" + tingkatID,
    		success: function (data) {
    			$('#pelajaran').html('<option value="">-- Pilih Mata Pelajaran  --</option>');
    			$.each(data, function (i, data) {
    				$('#pelajaran').append("<option value='" + data.id + "'>" + data.keterangan + "</option>");
    			});
    		}
    	});
    }

    //buat load bab

    function load_bab(mapelID) {
    	$.ajax({
    		type: "POST",
    		dataType: "json",
    		data: mapelID.mapel_id,
    		url: "<?php echo base_url() ?>index.php/videoback/getBab/" + mapelID,
    		success: function (data) {
    			$('#bab').html('<option value="">-- Pilih Bab Pelajaran  --</option>');
                //console.log(data);
                $.each(data, function (i, data) {
                	$('#bab').append("<option value='" + data.id + "'>" + data.judulBab + "</option>");
                });
              }
            });
    }

    //load sub bab

    function load_sub_bab(babID) {
    	$.ajax({
    		type: "POST",
    		dataType: "json",
    		data: babID.bab_id,
    		url: "<?php echo base_url() ?>index.php/videoback/getSubbab/" + babID,
    		success: function (data) {
    			$('#subbab').html('<option value="">-- Pilih Sub Bab Pelajaran  --</option>');
    			$.each(data, function (i, data) {
    				$('#subbab').append("<option value='" + data.id + "'>" + data.judulSubBab + "</option>");
    			});

    		}
    	});
    }


    loadTingkat();
	// End Drop down depeden
</script>