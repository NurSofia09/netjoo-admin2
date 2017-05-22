<style type="text/css">
	.komen {
		width:80%;
		margin-left: 120px;
		/*border: 1px solid pink;*/

	}
	.komen li{
		margin: 0;
		padding: 0;
		line-height:1.8;
	}
	.komen quote{
		/*border: 1px solid black;*/
		padding: 3px 20px;
		width: inherit;
		background: rgba(0,0,0,.1);
		font-style: italic;
	}
	blockquote {
		background: #f9f9f9;
		border-left: 10px solid #ccc;
		margin: 1.5em 10px;
		padding: 0.5em 10px;
		quotes: "\201C""\201D""\2018""\2019";
	}
	blockquote:before {
		color: #ccc;
		content: open-quote;
		font-size: 4em;
		line-height: 0.1em;
		margin-right: 0.25em;
		vertical-align: -0.4em;
	}
	blockquote p {
		display: inline;
	}
</style>
<script type="text/javascript" src="<?= base_url('assets/plugins/ckeditor/ckeditor.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/plugins/ckeditor/config.js') ?>"></script>
<script src="http://macyjs.com/assets/js/macy.min.js"></script>
<script src="<?php echo base_url('node_modules/socket.io/node_modules/socket.io-client/socket.io.js');?>"></script>
<script type="text/javascript" src="<?= base_url('assets/plugins/ckeditor/adapters/jquery.js') ?>"></script>



<main>	
	<br>
	<div class="modal fade " tabindex="-1" role="dialog" id="myModal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span></button><br>
						<div class="modal-title">Balas</div>
					</div>


					<div class="modal-body">

						
					</div>
					<div class="modal-footer bg-color-3">
						
					</div>

				</div><!-- /.modal-content -->

			</div><!-- /.modal-dialog -->

		</div>

		<div class="modal fade " tabindex="-1" role="dialog" id="modalJawab">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span></button><br>
							<div class="modal-title">Balas</div>
						</div>


						<div class="modal-body">
							<div class='quotes kuote'><p><i></p><i></div>
							<textarea name='editor1' class='form-control' id="komenText"></textarea>
						</div>
						<div class="modal-footer bg-color-3">
							<a type='button' class='cws-button bt-color-1 alt small' data-dismiss='modal'>Batal</a><a type='a' class='cws-button bt-color-2 alt small mulai-btn post' onclick='simpan_jawaban()'>Post</a>
						</div>

					</div><!-- /.modal-content -->

				</div><!-- /.modal-dialog -->

			</div>
			<div class="container">	

				<div class="blog-post"><article>
					<div class="post-info">
						<div class="date-post"><div class="day">{tanggal}</div><div class="month">{bulan}</div></div>
						<div class="post-info-main">
							<input type="hidden" value="{id_pertanyaan}" name="idpertanyaan">
							<input type="hidden" value="{id_pengguna}" name="idpengguna">
							<input type="hidden" value="{statusRespon}" name="statusRespon">


							<div class="author-post">by {author}</div>
						</div>
						<div class="comments-post"><i class="fa fa-comment"></i> {jumlah}</div>
					</div>

					<div class="quotes clear-fix" >
						<div class="quote-avatar-author clear-fix">
							<img src="{photo}" data-at2x="{photo}" alt="{namaPengguna}" width="60px">
							<div class="author-info">{author}<br><span>{akses}</span></div>
						</div>

						<div>
							<h4 style="display:inline">{judul_header}</h4>
							<div class="komen"><?=$isi ?>
							</div>
							<!-- <input type="hidden" name="" value="{isi}"> -->
							<input type="hidden" name="single" value="<?=htmlspecialchars($isi) ?>">


						</div>

					</div><br>

					<div>
						| <span rel="tag"><i class="fa fa-tags"></i> {bab}</span> |
						<a onclick="quote('single')" rel="tag"><i class="fa fa-quote-right"></i> Quote</a> |
						<a onclick="quote(0)" rel="tag"><i class="fa fa-comment-o"></i> Balas</a> |
						<?php if ($username==$this->session->userdata('USERNAME')): ?>
							<a onclick="edit()"><i class="fa fa-pencil"></i> Edit</a> |
						<?php endif ?>
					</div>
				</article>
			</div>
			<?php $number = 1; ?>
			<?php if ($data_postingan!=array()): ?>
				<?php foreach ($data_postingan as $item_postingan): ?>
					<!-- <?php print_r($item_postingan) ?> -->
					<?php $link = base_url('konsultasi/show_post/').$item_postingan['jawabID'] ?>
					<?php $number++; ?>
					<div class="blog-post">
						<article>
							<div class="row bg-color-2">
								<div class="container"><?=$item_postingan['date_created'] ?> |
									<a title="view single post" href="<?=$link ?>">#<?=$number ?></a></div>
								</div><br>

								<div class="quotes clear-fix" >
									<div class="quote-avatar-author clear-fix">

										<?php 
										if ($item_postingan['hakAkses']=="siswa") {
											$gbr = base_url().'assets/image/photo'."/".$item_postingan['hakAkses']."/".$item_postingan['siswa_photo'];
										}else{
											$gbr = base_url().'assets/image/photo'."/".$item_postingan['hakAkses']."/".$item_postingan['guru_photo'];
										}
										?>
										<img src="<?=$gbr ?>" width="60px">
										<div class="author-info"><?=$item_postingan['namaPengguna'] ?><br><span><?=$item_postingan['hakAkses'] ?></span></div>
									</div>

									<div>
										<?php $value =htmlspecialchars($item_postingan['isiJawaban']). 
										"<span style='font-style:italic'><br>Post By:".ucfirst($item_postingan['namaPengguna']).
										"<a title='view single post' href='".$link."'><i class='fa fa-arrow-circle-o-right'> > </i></a>"?>
										<div class="komen"><?=$item_postingan['isiJawaban'] ?>
											<input type="hidden" name="<?=$item_postingan['jawabID'] ?>" 
											value="<?=$value ?>">
										</div>

									</div>

								</div><br>

								<?php if ($this->session->userdata('HAKAKSES')=="guru"): ?>
									<div class="text-right">
										<a onclick="quote(<?=$item_postingan['jawabID'] ?>)" >
											<i class="fa fa-quote-right ">
											</i> Quote	
										</a>
									</div>
								<?php else :?>
									<?php if ($item_postingan['namaPengguna']==$this->session->userdata('USERNAME')): ?>
										<div class="text-right">
											<a onclick="quote(<?=$item_postingan['jawabID'] ?>)">
												<i class="fa fa-quote-right ">
												</i> Quote	
											</a> |

											<a href="<?=base_url('konsultasi/editpost/'.$item_postingan['jawabID']) ?>">
												<i class="fa fa-pencil smaller">
												</i> Edit	
											</a>
										</div>

									<?php else :?>
										<div class="text-right">
											<a onclick="point(<?=$item_postingan['jawabID'] ?>)">
												<i class="fa fa-heart">
												</i> Point
											</a> |

											<a onclick="quote(<?=$item_postingan['jawabID'] ?>)">
												<i class="fa fa-quote-right ">
												</i> Quote	
											</a>
										</div>
									<?php endif ?>

								<?php endif ?>




							</article>
						</div>
					<?php endforeach ?>
				<?php endif ?>
				<div class="blog-post add-pertanyaan">
					
				</div>
				<section>

					<div class="grid-col-row clear-fix">

						<center>
							<div class="page-pagination clear-fix margin-none" style="width: 100%">
								<?php echo $links; ?>
							</div>
						</center>

					</div>
				</section>


				<!-- editor reply -->
				<div class="container">	
					<hr>	
					<div class="col-sm-12" id="jawaban">
						<br>
						<span>Isi Jawaban :</span>
						<textarea  name="respon" class="form-control" id="isi" row=10 cols=80></textarea>
						<br>
						<form action="<?=base_url('konsultasi/do_upload') ?>" method="post" enctype="multipart/form-data" id="form-gambar">
							<span>Upload gambar :</span> 
							<input type="file" class="cws-button bt-color-3 alt smaller post" name="file" style="display: inline">

							<a onclick="submit_upload()" style="border: 2px solid #18bb7c; padding: 2px;display: inline" title="Upload"><i class="fa fa-cloud-download"></i></a> 
							<div id="output" style="display: inline">
								<a style="border: 2px solid grey; padding: 2px;display: inline" title="Sisipkan" disabled><i class="fa fa-cloud-upload"></i></a> 
							</div>


							<input type="submit" class="fa fa-cloud-upload submit-upload" style="margin-top: 3px;display: none" value="Upload">							
						</a>
					</form>
					<!-- <br> -->
					<!-- <a class="cws-button bt-color-3 alt smalls" onclick="preview()">Preview</a>  -->
					<a onclick="simpan_jawaban()" class="cws-button bt-color-3 alt smaller post">Post</a>
					<br>
					<br>
					<hr>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			

			function append_new(datas){
				if (datas.hakAkses=='guru') {
					photo = base_url+"assets/image/photo/"+datas.hakAkses+"/"+datas.guru_photo;
				}else{
					photo = base_url+"assets/image/photo/"+datas.hakAkses+"/"+datas.siswa_photo;
				}
				konten = '<div class="blog-post">'+
				'<article>'+
				'<div class="row bg-color-2">'+
				'<div class="container">'+datas.date_created+'|'+
				'<a title="view single post" href=""> New Post</a></div>'+
				'</div></div><br>'+
				'<div class="quotes clear-fix" >'+
				'<div class="quote-avatar-author clear-fix">'+
				'<img src="'+photo+'" width="60px">'+
				'<div class="author-info">'+datas.namaPengguna+'<br><span>'+datas.hakAkses+'</span></div></div>'+
				'<div>'+
				'<span style="font-style:italic">'+
				// '<a title="view single post" href=""><i class="fa fa-arrow-circle-o-right">  </i></a>'+
				'<div class="komen">'+datas.isiJawaban+'<input type="hidden" name="'+datas.jawabID+'" value="">'+
				'</div>'+
				'</div>'+
				'</div><br>'+
				'</article>'+
				'</div>';
				$('.add-pertanyaan').prepend(konten);
			}

			function insert(){
				nama_file = $('.insert').data('nama');
				url = base_url+"assets/image/konsultasi/"+nama_file;

				CKEDITOR.instances.isi.insertHtml('<img src='+url+' ' + CKEDITOR.instances.isi.getSelection().getNative()+'>');
			}

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

			function sukses(){ 
				jQuery('#form-upload').resetForm();
				jQuery('#submit-button').removeAttr('disabled');
			}

			var ckeditor;



			$(document).ready(function(){
				CKEDITOR.replace( 'respon', {
					height: 260,
					/* Default CKEditor styles are included as well to avoid copying default styles. */
				} );

				/*ckeditor = CKEDITOR.replace('respon');	*/
			});

			var ckeditor;
			var string;
			var txt = 1;
			function quote(data){
				if (data==0) {						
					// balas
					$('html, body').animate({
						scrollTop: $("#jawaban").offset().top
					}, 2000);
				}else{
					//quote
					$('html, body').animate({
						scrollTop: $("#jawaban").offset().top
					}, 2000);

					string = $('input[name='+data+']').val();

					CKEDITOR.instances.isi.setData("<blockquote>"+string+"</blockquote><br>");
				}

			}
			function simpan_jawaban(){
				hak_akses = ("<?=$this->session->userdata('HAKAKSES') ?>");

				var socket = io.connect( 'http://'+window.location.hostname+':3000' );

				// get text from ck editor
				txt = CKEDITOR.instances.isi.getData();
				
				var datas = {
					isiJawaban : txt,
					penggunaID : $('input[name=idpengguna]').val(),
					pertanyaanID : $('input[name=idpertanyaan]').val(),
					statusRespon : $('input[name=statusRespon]').val()
				};

				url = base_url+"konsultasi/ajax_add_jawaban/";
				$.ajax({
					url : url,
					type: "POST",
					data: datas,
					dataType: "TEXT",
					success: function(data){
						if (hak_akses=='guru') {
							if (datas.statusRespon!=1) {
								socket.emit('remove_notifikasi', {
									datas
								});	
							}
						// add ke konten yang di insert
					}
					$.getJSON( base_url+"konsultasi/get_last_jawaban/", function( datas ) {
						swal('Posting berhasil...');
						append_new(datas);
					});
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					alert('Error adding / update data');
				}
			});

			}

			function point(data){
				elemen = "<textarea class='form-control' name='komentar'></textarea>";
				$('.modal-body').html(elemen);
				$('.modal-header .modal-title').html("Berikan Komentar");
				$('#myModal').modal('show');
				button = "<button type='button' class='cws-button bt-color-1 alt small' data-dismiss='modal'>Batal</button><button type='button' class='cws-button bt-color-2 alt small mulai-btn post'onclick='komen("+data+")'>Berikan</button>";

				$('.modal-footer').html(button);


			}

			function komen(data){
				var isikomentar = $('textarea[name=komentar]').val();
				url = base_url+"konsultasi/check_point/"+data;

				datas = {
					isiKomentar : isikomentar,
					idJawaban : data
				}
				var stat;
				$.ajax({
					url : url,
					type: "POST",
					data: datas,
					dataType: "json",
					success: function(data, status, jqXHR)
					{
						stat = get_data(data, datas);
					},
					error: function (jqXHR, textStatus, errorThrown)
					{
						swal('Error adding / update data');
					}
				});

			}

			function get_data(data, datas){
				status = data;
				postingan = datas;
				if (status==1) {
					swal("Tidak Dapat Memberikan Point")
				}else{
					console.log(postingan.idJawaban);
					url = base_url+"konsultasi/ajax_add_point/"+postingan.idJawaban;
					$.ajax({
						url : url,
						type: "POST",
						data: datas,
						dataType: "text",
						success: function()
						{
							swal("sudah ditambahkan");
						},
						error: function (jqXHR, textStatus, errorThrown)
						{
							swal('Error adding / update data');
						}
					});
				}
			}
		</script>

		<!-- FUNGSI EDIT -->
		<script>
			function edit(){

			}	
		</script>
		<!-- FUNGSI EDIT -->
