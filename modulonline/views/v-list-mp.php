<link rel="stylesheet" href="<?= base_url('assets/plugins/datatables/css/jquery.datatables.min.css'); ?>">
<!-- konten -->
<!-- START Template Main -->
<section id="main" role="main">
    <!-- START Template Container -->
    <div class="container-fluid">

        <!-- START row -->
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <!--Start untuk menampilkan nama tabel -->
                    <div class="panel-heading">
                        <?php
                        foreach ($tingkat as $rosw):
                            $id = $row['id'];
                            if ($tingkatID == $id) {
                           
                            }
                        endforeach
                        ?>
                        
                                <h3 class="panel-title">Silahkan pilih mata pelajaran pada List Mata Pelajaran <?= $row['aliasTingkat']; ?> di bawah ini! </h3>
                    </div>
                    <!--END untuk menampilkan nama tabel -->
                    <table class="table table-striped" id="zero-configuration" style="font-size: 13px">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Mata Pelajaran</th>
                                <th>Lihat Bab</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pelajaran as $row): ?>
                                <tr>
                                    <td><?= $row['id']; ?></td>
                                    <td><?= $row['keterangan']; ?></td>
                                    <td>
                                        <form action="<?= base_url(); ?>index.php/banksoal/listbab" method="get">
                                            <input type="text" name="mpID" value="<?= $row['id']; ?>" hidden="true" >
                                            <button type="submit" class="btn btn-primary">Lihat Bab</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--/ END row -->

    </div>
    <!--/ END Template Container -->

    <!-- START To Top Scroller -->
    <a href="#" class="totop animation" data-toggle="waypoints totop" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="50%"><i class="ico-angle-up"></i></a>
    <!--/ END To Top Scroller -->

</section>