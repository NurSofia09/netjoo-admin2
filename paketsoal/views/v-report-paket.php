
<!-- konten -->
<section id="main" role="main" class="mt10">

	<!-- Start Container Fluid -->
	<div class="container-fluid">

		<!-- START row -->
		<div class="row">
			<!-- List Report -->
			<div class="col-md-12">
				<!-- START Form panel -->
				<div class="panel panel-default">
					<div class="panel-heading">
						<h5 class="panel-title">Report Paket X</h5>
					</div>

					<!-- Star Panel body -->
					<div class="panel-body">
						<!-- Start tabel report paket -->
						<table class="table table-striped" id="zero-configuration" style="font-size: 13px">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama</th>
									<th>Nama Paket</th>
									<th>Jumlah Benar</th>
									<th>Jumlah Salah</th>
									<th>Jumlah Kosong</th>
									<th>Poin</th>
									<th>Nilai</th>
									<!-- <th>Aksi</th> -->
								</tr>
							</thead>
							<tbody>
								<?php $i = 1; 
								$tampBenar=0;
								$maxBenar=0;
								$minBenar=0;
								$tampSalah=0;
								$maxSalah=0;
								$minSalah=0;
								$sumBenar=0;
								$sumSalah=0;
								$sumPoin=0;
								$sumTotal_nilai=0;
								?>
								<?php foreach ($report as $rows): ?>
									<tr>
										<td><?=$i ?></td>
										<td><?=$rows['namaDepan'] ?>  <?=$rows['namaBelakang'] ?></td>
										<td><?=$rows['nm_paket'] ?></td>
										<td><?=$rows['jmlh_benar'] ?></td>
										<td><?=$rows['jmlh_salah'] ?></td>
										<td><?=$rows['jmlh_kosong'] ?></td>
										<td><?=$rows['poin'] ?></td>
										<td><?=$rows['total_nilai'] ?></td>
									</tr>
									
									<!--Start penghitungan untuk tabel kesimpulan  -->
									<?php 
											if ($tampBenar>=$rows['jmlh_benar']) {
												$minBenar=$rows['jmlh_benar'];
											}elseif ($tampBenar<$rows['jmlh_benar']) {
												$maxBenar=$rows['jmlh_benar'];
											}

											if ($tampSalah>=$rows['jmlh_salah']) {
												$minSalah=$rows['jmlh_salah'];
											}elseif ($tampSalah<$rows['jmlh_salah']) {
												$maxSalah=$rows['jmlh_salah'];
											}

											if ($i == 1) {
												$sumSoal = $rows['jmlh_benar']+$rows['jmlh_salah']+$rows['jmlh_kosong'];
											}
											$tampBenar=$rows['jmlh_benar'];
											$tampSalah=$rows['jmlh_salah'];

											$sumBenar+=$rows['jmlh_benar'];
											$sumSalah+=$rows['jmlh_salah'];
											$sumPoin+=$rows['poin'];
											$sumTotal_nilai+=$rows['total_nilai'];

									 ?>
									 <?php $i=$i+1; ?>
									 <!--END penghitungan untuk tabel kesimpulan   -->
								<?php endforeach ?>

							</tbody>
						</table>
						<!-- End tabel report paket -->
					</div>
					<!-- End Panel body -->
				</div>
				<!--/ END Form panel -->
			</div>
			<!-- END Report -->
			<!--Start Tabel Kesimpulan -->
				<div class="col-md-12">
				<!-- START Form panel -->
				<div class="panel panel-default">
					<div class="panel-heading">
						<h5 class="panel-title">Tabel Kesimpulan </h5>
					</div>

					<!-- Star Panel body -->
					<div class="panel-body">
						<!-- Start tabel report paket -->
						<table class="table table-striped" id="zero-configuration" style="font-size: 13px">
							<thead>
								<tr>
									<th>Jumlah Benar Terbanyak</th>
									<th>Jumlah Benar Terkecil</th>
									<th>Jumlah Salah Terbanyak</th>
									<th>jumlah Salah Terkecil</th>
									<th>Rata Jumlah Benar (%)</th>
									<th>Rata-rata Jumalah salah (%)</th>
									<th>Rata-rata Poin</th>
									<th>Rata-rata Nilai</th>
								</tr>
							</thead>
							<tbody>
								<th><?=$maxBenar?></th>
								<th><?=$minBenar?></th>
								<th><?=$maxSalah?></th>
								<th><?=$minSalah?></th>
								<th><?= ($sumBenar/($i-1))/$sumSoal *100 ?>%</th>
								<th><?=($sumSalah/($i-1))/$sumSoal *100 ?>%</th>
								<th><?=($sumPoin/($i-1))?></th>
								<th><?=($sumTotal_nilai/($i-1)) ?></th>

							</tbody>
						</table>
						<!-- End tabel report paket -->
					</div>
					<!-- End Panel body -->
				</div>
				<!--/ END Form panel -->
			</div>
			<!--END Tabel Kesimpulan -->
		</div>
		<!-- END ROW -->
	</div>
	<!-- END Container Fluid -->

	</section>


