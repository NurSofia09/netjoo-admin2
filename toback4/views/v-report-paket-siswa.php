
<!-- konten -->
<section id="main" role="main" class="mt10">

	<div class="container-fluid">

		<!-- START row -->
		<div class="row">
			<div class="col-md-12">
				<!-- START Form panel -->
				<div class="panel panel-default">
					<div class="panel-heading">
						<h5 class="panel-title">Report Paket, Nama: <?=$siswa['namaDepan']?> <?=$siswa['namaBelakang']?> (<?=$siswa['id']?>) </h5>
					</div>

					<!-- Star Panel body -->
					<div class="panel-body">
					<!-- Start tabel report paket -->
					<table class="table table-striped" id="tblistrows" style="font-size: 13px">
							<thead>
								<tr>
									<th>No</th>
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
								<?php $i = 1; ?>
								<?php foreach ($reportPaket as $rows): ?>
									<tr>
										<td><?=$i ?></td>
										<td><?=$rows['nm_paket'] ?></td>
										<td><?=$rows['jmlh_benar'] ?></td>
										<td><?=$rows['jmlh_salah'] ?></td>
										<td><?=$rows['jmlh_kosong'] ?></td>
										<td><?=$rows['poin'] ?></td>
										<td><?=$rows['total_nilai'] ?></td>
									</tr>
									<?php $i=$i+1; ?>
								<?php endforeach ?>

							</tbody>
						</table>
					<!-- End tabel report paket -->
					</div>
					<!-- End Panel body -->
				</div>
				<!--/ END Form panel -->
			</div>
		</div>


	</section>


