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
blockquote{
	display:block;
	background: #fff;
	padding: 15px 20px 15px 45px;
	margin: 0 0 20px;
	position: relative;

	/*Font*/
	font-size: 13px;
	line-height: 1.2;
	color: #666;
	text-align: justify;

	/*Borders - (Optional)*/
	border-left: 10px solid #ccc;
	border-right: 2px solid #ccc;

}

blockquote::before{
	content: "\201C"; /*Unicode for Left Double Quote*/

	/*Font*/
	font-family: Georgia, serif;
	font-size: 20px;
	font-weight: bold;
	color: #999;

	/*Positioning*/
	position: absolute;
	left: 10px;
	top:5px;
}

blockquote::after{
	/*Reset to make sure*/
	content: "";
}

blockquote a{
	text-decoration: none;
	background: #eee;
	cursor: pointer;
	padding: 0 3px;
	color: #c76c0c;
}

blockquote a:hover{
	color: #666;
}

blockquote em{
	font-style: italic;
}

</style>
<script type="text/javascript" src="<?= base_url('assets/plugins/ckeditor/ckeditor.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/plugins/ckeditor/adapters/jquery.js') ?>"></script>


<main>	
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
							<a type='button' class='btn btn-sm btn-danger' data-dismiss='modal'>Batal</a><a type='a' class='btn btn-sm btn-primary post' onclick='simpan_jawaban()'>Post</a>
						</div>

					</div><!-- /.modal-content -->

				</div><!-- /.modal-dialog -->

			</div>


			<section id="main" role="main">
				<!-- START Template Container -->
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<!-- Start Panel -->
							<div class="panel panel-teal">
								<!-- panel heading/header -->
								<div class="panel-heading">
									<h3 class="panel-title col-md-6">Konsultasi {author}</h3>
								</div>
								<!--/ panel heading/header -->
								<!-- Start panel Body -->
								<div class="panel-body">
									<!-- Start media List -->
									<div class="media-list">
										<!-- Stat Media wall -->
										<div class="media well mb0">
											<span class="pull-left">
												<img src="{photo}" class="img-circle" width="65px" height="65px" alt="">
											</span>
											<span class="media-body">
												<input type="hidden" value="{id_pertanyaan}" name="idpertanyaan">
												<input type="hidden" value="{id_pengguna}" name="idpengguna">
												<span class="media-heading">{author}</span>
												<span class="media-text ellipsis nm"><?=$isi ?></span>
												<input type="hidden" value="<?=$isi ?>" name="single">
												<!-- meta icon -->
												<span></span>
												<!-- <span class="label label-inverse">{akses}</span> -->
												<span class="label label-primary"><i class=" ico-book3"></i>{sub}</span>
												<!-- <span class="label label-success"><i class="ico-bubble2"></i>{jumlah}</span> -->
												<a href="javascript:void(0);"><span class="label label-success" onclick="quote()" rel="tag">Balas <i class="ico-bubble-dots3"></i></span></a>
												<a href="javascript:void(0);"><span class="label label-inverse" onclick="quote('single')" >Quote <i class="ico-bubble-quote"></i></span></a>
												<span class="pull-right">{tanggal}|{bulan}</span>
												<!--/ meta icon -->
											</span>
										</div>
										<!-- Stat Media wall -->
									</div>
									<!-- END media List -->
									<!-- Start media list Respon -->
									<hr>
									<div class="media-list">

										<!-- <hr class="divider-big"><?php echo "hakakses ".$this->session->userdata('HAKAKSES')?> -->
										<?php if ($data_postingan!=array()): ?>
										<?php foreach ($data_postingan as $item_postingan): ?>
										<?php 
										if ($item_postingan['hakAkses']=="siswa") {
										$gbr = base_url().'assets/image/photo'."/".$item_postingan['hakAkses']."/".$item_postingan['siswa_photo'];
										}else{
										$gbr = base_url().'assets/image/photo'."/".$item_postingan['hakAkses']."/".$item_postingan['guru_photo'];
										}
									?>
										<div class="blog-post">
											<article>
												<!-- Start Respon Guru -->
												<div class="media border-dotted">
													<span class="pull-left">
														<img src="<?=$gbr?>" class="img-circle" width="65px" height="65px" alt="">
													</span>
													<div class="media-body">
														<h5 class="semibold mt0 text-accent"><?=$item_postingan['namaPengguna'] ?></h5>
														<p class="media-text ellipsis nm"><?=$item_postingan['isiJawaban'] ?>
															<input type="hidden" name="<?=$item_postingan['jawabID'] ?>" value="<?=$item_postingan['isiJawaban']."<span style='font-style:italic'><br>Post By:".$item_postingan['namaPengguna']?>">
														</p>
														<!-- meta icon -->
														<span></span>
														<!-- <span class="label label-inverse">{akses}</span> -->
														<span class="label label-primary"><i class=" ico-book3"></i>{sub}</span>

														<!-- Start Pengecekan quote  n love -->
														<?php if ($this->session->userdata('HAKAKSES')=="guru"): ?>
														<a onclick="quote(<?=$item_postingan['jawabID'] ?>)" class="label label-inverse">
															Quote <i class="ico-bubble-quote"></i>	
														</a>
													<?php else :?>
													<?php if ($item_postingan['namaPengguna']==$this->session->userdata('USERNAME')): ?>
													<a onclick="quote(<?=$item_postingan['jawabID'] ?>)" class="label label-inverse">
														Quote <i class="ico-bubble-quote"></i>
													</a>

												<?php else :?>

												<a onclick="quote(<?=$item_postingan['jawabID'] ?>)" class="label label-inverse">
													Quote <i class="ico-bubble-quote"></i>
												</a>
											<?php endif ?>

										<?php endif ?>
										<!-- END Pengecekan quote  n love -->
										<span class="pull-right"><?=$item_postingan['date_created'] ?></span>
										<!--/ meta icon -->
									</div>
									<hr>
								</div>

								<!-- END Respon Guru -->




							</article>
						</div>
					<?php endforeach ?>
				<?php endif ?>
			</div>
			<!-- End media list Respon -->


		</div>
		<!-- END panel Body -->

	</div>
	<!-- END Panel -->
</div>
</div>
</div>
</section>




<script type="text/javascript">

	var ckeditor;
	var string;
	var txt = 1;


	function quote(data=0){
		if (data==0) { 	
			$('#modalJawab .modal-body .quotes p i').html("");
			$('#modalJawab .modal-header .modal-title').html("Balas Pertanyaan");
			string = 0;
			$('#modalJawab').modal('show');
			// ckeditor.setData(data);
		}else{
			$('#modalJawab .modal-header .modal-title').html("Quote Jawaban");
			string = $('input[name='+data+']').val();
			$('#modalJawab .modal-body .quotes p i').html("<blockquote>"+string+"</blockquote>");
			// ckeditor.setData(string);
			$('#modalJawab').modal('show');
		}
			// ckeditor = CKEDITOR.replace( 'editor1' );

		}

// 	function save(){
// 		//kalo kosong
// 		if (string==0) {
// 			var desc = ckeditor.getData();

// 			var data = {
// 				isiJawaban : desc+"",
// 				penggunaID : $('input[name=idpengguna]').val(),
// 				pertanyaanID : $('input[name=idpertanyaan]').val(),
// 			}
// 			idpertanyaan= data.pertanyaanID;
// 		}else{
// 			console.log(string);
// 			quote = "<blockquote>"+string+"</blockquote>";
// 			var desc = quote+ckeditor.getData();
// 			console.log(desc);

// 			var data = {
// 				isiJawaban : desc+"",
// 				penggunaID : $('input[name=idpengguna]').val(),
// 				pertanyaanID : $('input[name=idpertanyaan]').val(),
// 			}
// 			console.log(data);
// 			idpertanyaan= data.pertanyaanID;
// 		// console.log(data);

// 	}





// 	if (data.isiJawaban == "") {
// 		$('#info').show();
// 	}else{
// 		url = base_url+"konsultasi/ajax_add_jawaban/";
// 		$.ajax({
// 			url : url,
// 			type: "POST",
// 			data: data,
// 			dataType: "TEXT",
// 			success: function(data)
// 			{
// 				// alert('masd');
//                 $('.post').text('Posting..'); //change button text
//                 $('.post').attr('disabled',false); //set button enable
//                 // alert('berhasil');
//                 window.location = base_url+"konsulback/konsultasi/"+idpertanyaan;
//             },
//             error: function (jqXHR, textStatus, errorThrown)
//             {
//             	alert('Error adding / update data');
//             }
//         });
// 	}
// }

function simpan_jawaban(){
	txt = $('#komenText').val();
	console.log(txt);
	console.log(string);
		//kalo kosong
		if (string==0) {
			var desc = txt;/*ckeditor.getData();*/
			var data = {
				isiJawaban : desc,
				penggunaID : $('input[name=idpengguna]').val(),
				pertanyaanID : $('input[name=idpertanyaan]').val(),
			}
			idpertanyaan= data.pertanyaanID;
		}else{
			quote = "<blockquote>"+string+"</blockquote>"+txt;


			var data = {
				isiJawaban : quote,
				penggunaID : $('input[name=idpengguna]').val(),
				pertanyaanID : $('input[name=idpertanyaan]').val(),
			}
			idpertanyaan= data.pertanyaanID;
		}
		if (data.isiJawaban == "") {
			$('#info').show();
		}else{
			url = base_url+"konsulback/ajax_add_jawaban/";
			$.ajax({
				url : url,
				type: "POST",
				data: data,
				dataType: "TEXT",
				success: function(data)
				{
				// alert('masd');
                $('.post').text('Posting..'); //change button text
                $('.post').attr('disabled',false); //set button enable
                // alert('berhasil');
                window.location =  base_url+"konsulback/konsultasi/"+idpertanyaan;
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
            	swal('Error adding / update data');	
            }
        });
		}
	}
	function point(data){
		elemen = "<textarea class='form-control' name='komentar'></textarea>";
		$('.modal-body').html(elemen);
		$('.modal-header .modal-title').html("Berikan Komentar");
		$('#myModal').modal('show');
		button = "<button type='button' class='btn btn-sm btn-danger' data-dismiss='modal'>Batal</button><button type='button' class='btn btn-sm btn-success mulai-btn post'onclick='komen("+data+")'>Berikan</button>";

		$('.modal-footer').html(button);


	}

	function komen(data){
		var isikomentar = $('textarea[name=komentar]').val();

	// url = base_url+"konsultasi/ajax_add_point/"+data;
	url = base_url+"konsulback/check_point/"+data;

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
		url = base_url+"konsulback/ajax_add_point/"+postingan.idJawaban;
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
				alert('Error adding / update data');
			}
		});
	}
}


</script>