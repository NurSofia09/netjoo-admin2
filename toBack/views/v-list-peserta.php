<section id="main" role="main">
	<div class="modal fade " tabindex="-1" role="dialog" id="myModal">
		<div class="modal-dialog" role="document" style="background: white">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><br>
				</div>
				<div class="modal-body" style="background: white">
					<div id="chartContainer" style="height: 400px; width: 100%;">
					</div>
					<div class="modal-footer bg-color-3">

					</div>
				</form>

			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
<div class="container-fluid">
	<div class="row">
		<div class="container">
			<div class="col-md-11">
				<div class="panel panel-teal">
					<!--Start untuk menampilkan nama tabel -->
					<div class="panel-heading">
						<h3>Daftar Peserta <a href="" class="btn btn-primary" title="Cetak Laporan"><i class="ico-print"></i></a></h3>
					</div>

					<div class="panel-body">
						<table class="table table-striped" id="tblistPeserta" style="font-size: 13px">
							<thead>
								<tr>
									<th>No</th>
									<th>Username</th>
									<th>Nama Peserta</th>
									<th>Cabang</th>
									<th>Status Pengerjaan</th>
									<th>Report Paket</th>
								</tr>
							</thead>
							<tbody>
								<?php $i = 1; ?>
								<?php foreach ($daftar_peserta as $peserta): ?>
									<tr>
										<td><?=$i ?></td>
										<td><?= $peserta['namaPengguna']?></td>
										<td><?=$peserta['namaDepan'] ." ".$peserta['namaBelakang']?></td>
										<td>-</td>
										<td>x dari x Paket</td>
										<td><a href="<?= base_url('index.php/toback/detailpaketsiswa/'.$peserta['id_tryout'].'/'.$peserta['penggunaID'])?>" onclick="detail_paket(<?=$peserta['penggunaID'] ?>,<?= $peserta['id_tryout']?>)" class="btn btn-info">Lihat Detail</a></td>
										<!-- <td>
											<form action="<?=base_url('toBack/reportPaketSiswa')?>" method="get">
												<input type="text" value="<?=$peserta['id_to'] ?>" name="id_to" hidden='true'>
												<input type="text" value="<?=$peserta['idPengguna'] ?>" name="id_pengguna"  hidden='true'>
												<button class="btn btn-sm" type="submit"><i class="ico-file2" title="Lihat Detail TO"></i></button>
											</form></td>
										<td>
											<a href="#" class="report-<?=$peserta['idReport'] ?>" data-todo='<?= json_encode($peserta) ?>'onclick="lihat_hasil_to(<?=$peserta['idReport'] ?>);"><i class="ico-file2" title="Lihat Detail TO"></i></a>
										</td> -->
									</tr>
									<?php $i=$i+1; ?>
								<?php endforeach ?>

							</tbody>
						</table>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
</section>
<script type="text/javascript">
	$(document).ready(function() {
		$('#tblistPeserta').DataTable( {
			"initComplete": function () {
				var api = this.api();
            // api.$('td').click( function () {
            //     api.search( this.innerHTML ).draw();
            // } );
        },"oLanguage": {
                "sSearch": "Search all columns:"
            }
    } );

	} );

	function lihat_hasil_to(id){
		var kelas = ".report-"+id;
		var data = $(kelas).data('todo');
		load_grafik(data);
		    $('.modal-title').text('Grafik Tryout ');
    $('#myModal').modal('show');
	}

	function load_grafik(data) {
		console.log(data);
		var report = {
			durasi:0,
			level:0,
			poin:0,
			konstanta:0,
			score:0};

     //report.durasi = 10;
     report.jumlah_soal = parseInt(data.jumlahSoal);
     report.level = parseInt(data.tingkatKesulitan);
     report.poin = parseInt(data.jmlh_benar);
     //report.konstanta =  report.durasi * report.jumlah_soal;
     report.score = data.jmlh_benar;


     var chart = new CanvasJS.Chart("chartContainer", {
     	title: {
     		text: "Nama Peserta : "+data.namaDepan+" "+data.namaBelakang+" - Score : "+data.total_nilai,
     	},
     	animationEnabled: true,
     	theme: "theme1",
     	data: [
     	{
     		type: "doughnut",
     		indexLabelFontFamily: "Garamond",
     		indexLabelFontSize: 20,
     		startAngle: 0,
     		indexLabelFontColor: "dimgrey",
     		indexLabelLineColor: "darkgrey",
     		toolTipContent: "Jumlah : {y} ",

     		dataPoints: [
     		{ y : data.jmlh_benar, indexLabel:"Benar {y}"},
     		{ y: data.jmlh_salah, indexLabel: "Salah {y}" },
     		{ y: data.jmlh_kosong, indexLabel: "Kosong {y}" }
     		]
     	}
     	]
     });
     chart.render();
 }
</script>
<script src="<?= base_url('assets/back/plugins/canvasjs.min.js') ?>"></script>