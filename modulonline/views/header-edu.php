		<div class="modal fade" tabindex="-1" role="dialog" id="laporkanbug">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span></button><br>
						<div class="modal-title"><h5 class="text-center">Laporkan bug atau error</h5></div>
						<div class="info">
							<div class="sukses text-info text-center hide">
								<span>Laporan anda telah terkirim, Kami akan segera memperbaikinya. terimakasih sudah melapor!</span>
							</div>
							<div class="gagal text-danger text-center hide">
								<span>Gagal memberikan komen !</span>
							</div> 
							<div class="lengkapi text-danger text-center hide">
								<span>Tolong lengkapi data agar kami lebih cepat memperbaiki errornya :)</span>
							</div>
						</div>
					</div>
					<div class="modal-body">
						<form class="form-laporan">	
							<label>Halaman<sup class="text-info">*contoh : neon/welcome</sup></label>
							<input type="text" name="halaman" class="form-control" placeholder="Alamat terjadi error">
							<br>
							<label>Isi Pesan Error<sup class="text-info">*Copy paste pesan error disini</sup></label>
							<textarea name="message" placeholder="Isi Error"
							rows="5" aria-invalid="false" aria-required="true"  class="form-control"></textarea>
						</form>
					</div>
					
					<div class="modal-footer bg-color-3">
						<button type="button" class="cws-button bt-color-2 alt small lapor" onclick="post_bug()">Laporkan</button>
						<button type="button" class="cws-button bt-color-1 alt small selesai" data-dismiss="modal">Batal</button>
					</div>

				</div><!-- /.modal-content -->

			</div><!-- /.modal-dialog -->

		</div>
		<!-- page header -->

		<header class="only-color">

			<!-- header top panel -->

			<div class="page-header-top">
				<div class="grid-row clear-fix">
					<address>
						<a href="tel:(0274) 450300 " class="phone-number"><i class="fa fa-phone"></i>(0274) 450300 </a>
						<a href="mailto:info@neonjogja.com  " class="email"><i class="fa fa-envelope-o"></i>info@neonjogja.com </a>

					</address>

				</div>

			</div>

			<!-- / header top panel -->

			<!-- sticky menu -->

			<div class="sticky-wrapper">

				<div class="sticky-menu">

					<div class="grid-row clear-fix">

						<!-- logo -->

						<a href="<?=base_url() ?>" class="logo">

							<img src="<?=base_url('assets/back/img/logo.png')?>"  data-at2x="<?=base_url('assets/back/img/logo@2x.png')?>" height="30px">

							<h1> </h1>

						</a>

						<!-- / logo -->

						<nav class="main-nav">

							<ul class="clear-fix">
								<li>

									<a href="<?=base_url('welcome') ?>">Home</a>

								</li>

								<li>

									<a href="<?=base_url('konsultasi') ?>">Konsultasi</a>

								</li>
								<li>

									<a href="<?=base_url('tryout') ?>">Try Out</a>

								</li>



								<li>

									<a href="<?=base_url('tesonline/daftarlatihan') ?>">Latihan</a>

								</li>

								<li>

									<a href="<?=base_url('tesonline/daftarlatihan') ?>">Modul</a>

								</li>

								<li>
									<a href="#">Hallo <?= $this->session->userdata['USERNAME']?></a>
									<ul>
										<li><a href="<?=base_url('siswa/profilesetting') ?>" class="active">Pengaturan Profil</a></li>
										<li><a href="<?=base_url('logout') ?>">Logout</a></li>
									</ul>
								</li>

							</ul>

						</nav>

					</div>

				</div>

			</div>

			<!-- sticky menu -->

		<script type="text/javascript">
			function laporkanbug() {
				$('#laporkanbug').modal('show');
				$('#laporkanbug .info .lengkapi').addClass('hide');
				$('#laporkanbug .info .gagal').addClass('hide');
				$('#laporkanbug .info .sukses').addClass('hide');

			}

			function post_bug(){
				var datas = {
					'isi' : $('input[name=halaman]').val(),
					'alamat': $('textarea[name=message]').val()
				};
				

				$('.lapor').text('Lapor'); //change button text
                $('.lapor').attr('disabled',false); //set button enable
				$('.selesai').text('Batal'); //change button text
				if (datas.isi=="" || datas.alamat=="") {
					$('#laporkanbug .info .lengkapi').removeClass('hide');
					$('#laporkanbug .info .sukses').addClass('hide');
					$('#laporkanbug .info .gagal').addClass('hide');
				}else{
					url = base_url+"bug/ajax_add_bug";
					$.ajax({
						dataType:'text',
						data:datas,
						type:'POST',
						url: url,
						success:function(data){
							$('#laporkanbug .info .lengkapi').addClass('hide');
							$('#laporkanbug .info .sukses').removeClass('hide');
							$('#laporkanbug .info .gagal').addClass('hide');
							$('.form-laporan')[0].reset();

							$('.lapor').text('Melapor..'); //change button text
                			$('.lapor').attr('disabled',true); //set button enable
							$('.selesai').text('selesai..'); //change button text


            },error:function(){
            	$('#laporkanbug .info .lengkapi').removeClass('hide');
            	$('#laporkanbug .info .sukses').addClass('hide');
            	$('#laporkanbug .info .gagal').removeClass('hide');
            }
        });
				}
				
			}
		</script>