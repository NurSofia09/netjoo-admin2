<link rel="stylesheet" href="<?= base_url('assets/plugins/datatables/css/jquery.datatables.min.css'); ?>">
<!-- START Template Main -->
<section id="main" role="main">
    <!-- START Template Container -->
    <div class="container-fluid">

        <!-- START row -->
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Zero configuration</h3>

                    </div>
                    <table class="table table-striped" id="zero-configuration" style="font-size: 13px">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Bab</th>
                                <th>Keterangan</th>
                                <th>Lihat Soal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($bab as $row): ?>
                                <tr>
                                    <td><?= $row['id']; ?></td>
                                    <td><?= $row['judulBab']; ?></td>
                                    <td><?= $row['keterangan']; ?></td>
                                    <td>
                                        <form action="<?= base_url(); ?>index.php/banksoal/listsubbab" method="get">
                                            <input type="text" name="bab" value="<?= $row['id']; ?>" hidden="true">
                                            <button class="btn btn-primary">Lihat Sub Bab</button>
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
<!--/ END Template Main -->