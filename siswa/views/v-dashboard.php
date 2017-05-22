<div class="page-content grid-row">
	<main>
		<div class="grid-col-row clear-fix">
			<div class="grid-col grid-col-3">
				<div class="portfolio-item">
					<div class="picture">
						<img src="<?=base_url().'assets/image/photo/siswa/'.$siswa['photo'] ?>" data-at2x="{}" alt="">
					</div>
					<h3><?=$siswa['namaDepan'] ." ".$siswa['namaBelakang']?></h3>
				</div>
			</div>

			<div class="grid-col grid-col-3">
				<div class="portfolio-item" style="padding: 0">
					<h5 class="text-center">Rekap Latihan</h5>
				</div>
			</div>

			<div class="grid-col grid-col-3">
				<div class="portfolio-item" style="padding: 0">
					<h5 class="text-center">Rekap Try Out</h5>
				</div>
			</div>

			<div class="grid-col grid-col-3">
				<div class="portfolio-item" style="padding: 0">
					<h5 class="text-center">Token</h5>
						<h1 class="text-center"><?=$token ?> Hari</h1>
				</div>
			</div>


		</div>

	</main>
</div>