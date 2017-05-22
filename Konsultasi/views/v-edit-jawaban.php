<main class="container">
	<script type="text/javascript" src="<?= base_url('assets/plugins/ckeditor/ckeditor.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/plugins/ckeditor/adapters/jquery.js') ?>"></script>



	<!-- modal preview -->
	<div class="modal fade" id="preview" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<div class="alert alert-dismissable alert-danger" id="info" hidden="true" >
						<button type="button" class="close" onclick="hideme()" >×</button>
						<strong>Terjadi Kesalahan</strong> <br>isi tanggapan anda.
					</div>

					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h2 class="modal-title text-center text-danger">Preview Postingan</h2>
				</div>
				<div class="modal-body">
					<div class="container judul"></div>
					<hr>
					<div class="container isi"></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-success" onclick="save()">Post</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<!-- modal preview -->

	<!-- modal preview -->
	<div class="modal fade" id="show_gambar" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document" style="width: 90%">
			<div class="modal-content">
				<div class="modal-header">
					<h2 class="modal-title text-center text-danger">Daftar Gambar</h2>
				</div>
				<div class="modal-body">
					<table class="table_img" style="font-size: 13px;width="100%"">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama File</th>
								<th>Tanggal</th>
								<th>Image</th>
								<th>Link/URL</th>
								<th width="30%">Aksi</th>
							</tr>
						</thead>
						<tbody>

						</tbody>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<!-- modal preview -->


	<div class="page-content">
		<section>
			<input type="hidden" name="babid" value="{bab}">

			<div class="form-group">
				<div class="container">
					
					<!-- Start Editor Soal -->
					<div id="editor-soal">
						
						<div class="col-sm-12">
							<br>
							Isi Pertanyaan :
							<textarea  name="editor1" class="form-control" id="isi"></textarea>
							<br>
							<form action="<?=base_url('konsultasi/do_upload') ?>" method="post" enctype="multipart/form-data" id="form-gambar">
								Upload Gambar : 
								<input type="file" class="cws-button bt-color-3 alt smaller post" name="file" style="display: inline">

								<a onclick="submit_upload()" style="border: 2px solid #18bb7c; padding: 2px;display: inline" title="Upload"><i class="fa fa-cloud-download"></i></a> 
								<div id="output" style="display: inline">
									<a style="border: 2px solid grey; padding: 2px;display: inline" title="Sisipkan" disabled><i class="fa fa-cloud-upload"></i></a> 
								</div>

								
								<input type="submit" class="fa fa-cloud-upload submit-upload" style="margin-top: 3px;display: none" value="Upload">							
							</a>
						</form>
						<!-- <a class="cws-button bt-color-3 alt smaller" onclick="preview()">Preview</a>  -->
						<a onclick="save()" class="cws-button bt-color-3 alt smaller post">Post</a>
						<br>
						<br>
						<hr>
					</div>

				</div>
			</div>
		</div>
	</section>
</div>
</main>
<!-- UPLOAD -->
<input type="text" value="<?=(htmlspecialchars($edit['isiJawaban'])) ?>" name="isi_jawaban">

<script type="text/javascript"> 
	var ckeditor;
	$(document).ready(function(){
		ckeditor = CKEDITOR.replace( 'editor1' );
		isiJawaban = $('input[name=isi_jawaban]').val();

		CKEDITOR.instances.isi.setData(isiJawaban);
	});

	function submit_upload(){
		$('.submit-upload').click();
	}
	jQuery(document).ready(function() { 
		jQuery('#form-gambar').on('submit', function(e) {
			e.preventDefault();
			jQuery('#submit-button').attr('disabled', ''); 
			jQuery("#output").html('<div style="padding:10px"><img src="<?php echo base_url('assets/image/loading/spinner11.gif'); ?>" alt="Please Wait"/> <span>Mengunggah...</span></div>');
			jQuery(this).ajaxSubmit({
				target: '#output',
				success:  sukses 
			});
		});
	}); 

	function sukses()  { 
		jQuery('#form-upload').resetForm();
		jQuery('#submit-button').removeAttr('disabled');

	} 

	function insert(){
		nama_file = $('.insert').data('nama');
		url = base_url+"assets/image/konsultasi/"+nama_file;

		CKEDITOR.instances.isi.insertHtml('<img src='+url+' ' + CKEDITOR.instances.isi.getSelection().getNative()+'>');

	}

	
	// masukin text ke posisi tertentu
	jQuery.fn.extend({
		insertAtCaret: function(myValue){
			return this.each(function(i) {
				if (document.selection) {
					this.focus();
					sel = document.selection.createRange();
					sel.text = myValue;
					this.focus();
				}
				else if (this.selectionStart || this.selectionStart == '0') {
					var startPos = this.selectionStart;
					var endPos = this.selectionEnd;
					var scrollTop = this.scrollTop;
					this.value = this.value.substring(0, startPos)+myValue+this.value.substring(endPos,this.value.length);
					this.focus();
					this.selectionStart = startPos + myValue.length;
					this.selectionEnd = startPos + myValue.length;
					this.scrollTop = scrollTop;
				} else {
					this.value += myValue;
					this.focus();
				}
			})
		}
	});
	// masukin text ke posisi tertentu

	
</script>
<!-- UPLOAD -->
<script>
	function preview(){
		var desc = ckeditor.getData();jqXHR
		var data = {
			namapertanyaan : $('input[name=namaPertanyaan]').val(),
			isi : desc,
		}

		$('.modal-body .judul').html("<h5>Judul</h5>");		
		$('.modal-body .judul').append(data.namapertanyaan);
		$('.modal-body .isi').html("<h5>Isi Pertanyaan</h5>	");
		$('.modal-body .isi').append(data.isi);


		if (data.namapertanyaan == "" || data.namapertanyaan == "") {
			swal("Tolong, isi judul dan pertanyaan anda..")

		}else{
			$('#preview').modal('show');
		}
	}

	function save(){
		var desc = ckeditor.getData();
		console.log(desc);
		var data = {
			isi : desc+"<br>",
			id:"<?=$edit['id'] ?>"
		}

		console.log(data);

		if (data.isi == "") {
			$('#info').show();
		}else{
			url = base_url+"konsultasi/ajax_update_jawaban/";
			$.ajax({
				url : url,
				type: "POST",
				data: data,
				dataType: "TEXT",
				success: function(data)
				{
					console.log(data);
                $('.post').text('Posting..'); //change 
                $('.post').attr('disabled',false); //set 
                window.location = base_url+"konsultasi/singlekonsultasi/"+<?=$edit['pertanyaanID'] ?>;
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
            	swal('Error adding / update data');
            	console.log(data);
            }
        });
		}
	}

	function hideme(){
		$('#info').hide();
	}
	var table_gambar;
	function show_image(){
		$('#show_gambar').modal('show');
		table_gambar = $('.table_img').DataTable({
			"ajax": {
				"url": base_url+"konsultasi/list_image_uploaded",
				"type": "POST"
			},
			"emptyTable": "Tidak Ada Data Pesan",
			"info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
			"bDestroy": true,
		});
	}

	function upload_gambar_konsultasi(){

	}
</script>