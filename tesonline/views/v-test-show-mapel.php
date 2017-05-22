<div class="page-content grid-row">

    <main>

        <div class="modal fade " tabindex="-1" role="dialog" id="myModal">

            <div class="modal-dialog" role="document">

                <div class="modal-content">

                    <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                        <h4 class="modal-title">Modal title</h4>

                    </div>

                    <div class="modal-body">

                        <form class="form-group" id="formlatihan" method="post" onsubmit="return false;">



                            <div class="alert alert-dismissable alert-danger" id="info" hidden="true" >

                              <button type="button" class="close" onclick="hideme()" >×</button>

                              <strong>Terjadi Kesalahan</strong> <br>Silahkan Lengkapi Data.

                          </div>



                          <p class="has-success">

                            <label>Bab</label>

                            <select class="form-control" name="bab" id="babSelect"  ><option value=0>-Pilih Bab-</option></select>

                        </p>

                        <p class="has-success">

                            <label >Sub Bab</label>

                            <select class="form-control" name="subab" id="subSelect"  ><option value=0>-Pilih Sub-</option></select>                       

                        </p>

                        <p class="has-success">

                            <label>Tingkat Kesulitan</label>

                            <select class="form-control" name="kesulitan" id="kesulitan">

                                <option value=0>-Pilih Tingkat Kesulitan-</option>

                                <option value="mudah">Mudah</option>

                                <option value="sedang">Sedang</option>

                                <option value="sulit">Sulit</option>

                            </select>                       

                        </p>

                        <p class="has-success">

                            <label>Jumlah Soal</label>

                            <select class="form-control" name="jumlahsoal">

                                <option value=0>-Pilih Jumlah Soal-</option>

                                <option value="5">5</option>

                                <option value="10">10</option>

                                <option value="15">15</option>

                            </select>                       

                        </p>

                        <div class="modal-footer bg-color-3">

                            <button type="button" class="cws-button bt-color-1 border-radius alt small" data-dismiss="modal">Batal</button>

                            <button type="button" class="cws-button bt-color-2 border-radius alt small mulai-btn">Mulai Latihan</button>

                            <button type="button" class="cws-button bt-color-5 border-radius alt small latihan-nnti-btn">Latihan nanti</button>



                        </div>

                    </form>



                </div>

            </div><!-- /.modal-content -->

        </div><!-- /.modal-dialog -->

    </div>



    <div class="grid-col-row clear-fix">

        <div class="row">

            <div class="container"><h1 class="text-center">Sekarang pilih Matapelajaran untuk memulai!</h1><br></div>



        </div>

        <?php $no = 1 ?>

        <?php foreach ($mapel as $mapelitem): ?>

            <div class="grid-col grid-col-4">

                <form action="<?= base_url() ?>index.php/tesonline/mulai" method="post" class="hide">

                    <input type="hiden" value="<?= $mapelitem['tingpelID'] ?>" class="hide" name="id">

                    <button type="submit" class="kirim<?= $mapelitem['tingpelID'] ?>" 

                        data-todo='{"id":"<?= $mapelitem['tingpelID'] ?>","namapelajaran":"<?= $mapelitem['namaMataPelajaran'] ?>"}'

                        >kirim</button>

                    </form>

                    <div class="course-item">

                        <div class="course-hover">

                            <img src="http://placehold.it/370x280" data-at2x="http://placehold.it/370x280" alt>

                            <div class="hover-bg bg-color<?= $no ?>"></div>

                            <a href="javascript:submit(<?= $mapelitem['tingpelID'] ?>);">mulai tesonline!</a>

                        </div>





                        <div class="course-name clear-fix">

                            <center><h3 style="text-align:center"><a href=""></a></h3></center>

                        </div>

                        <div class="course-date bg-color-<?= $no ?> clear-fix">

                            <div class="description"><?= $mapelitem['namaMataPelajaran'] ?><br></div>



                            <div class="divider"></div>

                            <p><?= $mapelitem['keterangan'] ?></p>

                        </div>

                    </div>

                </div>

                <?php $no++; ?>

            <?php endforeach ?>

        </div>

    </main>

    <br>

    <hr class="divider-color">

</div>

<script type="text/javascript">



    $('#babSelect').change(function () {
        load_sub($('#babSelect').val());
    });



    function submit(id) {
        //passing data to modals.
        var tingPelID = $('.kirim' + id).data('todo').id;
        //untuk ditampilkan di modal
        var namaPelajaran = $('.kirim' + id).data('todo').namapelajaran;
        $('#myModal').modal('show');
        $('.modal-title').text('Mulai Latihan untuk pelajaran ' + namaPelajaran);
        load_bab(tingPelID);
    }



    //fungsi untuk ngeload bab berdasarkan tingkat-pelajaran id
    function load_bab(tingPel) {
        $('#babSelect').find('option').remove();
        $('#babSelect').append('<option value=1>Bab Pelajaran</option>');
        var babID;
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() ?>index.php/matapelajaran/get_bab_by_tingpel_id/" + tingPel,
            success: function (data) {

                $.each(data, function (i, data) {
                    $('#babSelect').append("<option value='" + data.id + "'>" + data.judulBab + "</option>");
                    babid = data.id;
                });
            }
        });

    }



    function load_sub(babID) {
        $.ajax({
            type: "POST",
            data: babID.bab_id,
            url: "<?php echo base_url() ?>index.php/videoback/getSubbab/" + babID,
            success: function (data) {
                $('#subSelect').html('<option value=0>-- Pilih Sub Bab Pelajaran  --</option>');
                $.each(data, function (i, data) {
                    $('#subSelect').append("<option value='" + data.id + "'>" + data.judulSubBab + "</option>");
                });
            }
        });
    }



    function mulai(test) {
        var sub_bab_id = $('#subSelect').val();
        var kesulitan = $("select[name=kesulitan]").val();
        var jumlahsoal = $("select[name=jumlahsoal]").val();
        var subabid = $("select[name=subab]").val();
        var babid = $("select[name=bab]").val();



        var data = {
            kesulitan: kesulitan,
            jumlahsoal: jumlahsoal,
            subab: subabid,
            bab:babid
        };
        if (data.kesulitan == 0 || data.jumlahsoal == 0) {
            $('#info').show();
        }else{
            $('.mulai-btn').text('Proses...'); //change button text
            $('.mulai-btn').attr('disabled', true); //set button disable 

            if (data.subab==0) {
                url = "<?php echo base_url() ?>index.php/latihan/tambah_latihan_ajax_bab";
                console.log(data);
            }else{
                url = "<?php echo base_url() ?>index.php/latihan/tambah_latihan_ajax";
            }

            $.ajax({
                url: url,
                type: "POST",
                dataType: 'text',
                data: data,
                success: function (data, respone)
                {
                    $('#myModal').modal('hide');
                    $('.mulai-btn').text('save'); //change button text
                    $('.mulai-btn').attr('disabled', false); //set button enable 
                    $('#formlatihan')[0].reset(); // reset form on modals
                if (test == 'mulai') {
                    window.location.href = base_url + "index.php/tesonline/mulaitest";
                } else {
                    window.location.href = base_url + "index.php/tesonline/daftarlatihan";
                }
            },
            error: function (respone, jqXHR, textStatus, errorThrown)
            {
                swal('Error adding / update data');
            }
        });
        }
    }


    function hideme(){
        $('#info').hide();
    }

    $('.mulai-btn').click(function () {
        mulai('mulai');
    });



    $('.latihan-nnti-btn').click(function () {
        mulai('nanti');

    });







</script>