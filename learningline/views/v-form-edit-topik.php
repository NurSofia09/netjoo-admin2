
<div class="row">
 <div class="col-md-12">
  <div class="panel panel-default">
   <div class="panel-heading">
    <!-- <h3 class="panel-title">Tambah Learning Topik</h3> -->
    <div class="toolbar">
      <br>
      <!-- TABEL KONTEN 1 . FORM LEARNINGNLINE -->
      <ol class="breadcrumb breadcrumb-transparent nm">
        <li><span><a href="<?=base_url('learningline')?>"><i class="ico-list"></i></a></span></li>

        <li><span>{tingkat}</span></li>
        <li>{mapel}</li>
        <li>{bab}</li>   
        <li class="active"><a href="#">{judul}</a></li>        

      </ol><br>
    </div>
  </div>
  <div class="panel-body">
    <input type="hidden" name="topikID" value="{topikID}">
    <input type="hidden" id="oldtkt" value="{tingkatID}">
    <input type="hidden"  id="oldmp"  value="{tingpelID}">
    <input type="hidden" id="oldbab"  value="{babID}">
    <!-- Start Body modal -->
    <form  class="panel panel-default form-horizontal form-bordered form-topik"  method="post" >
     <div  class="form-group">
      <label class="col-sm-3 control-label">Tingkat</label>
      <div class="col-sm-8">

       <!-- stkt = soal tingkat -->                          
       <select class="form-control" id="tingkat" id="tingkat">
         <option>-Pilih Tingkat-</option>
       </select>
     </div>
   </div>

   <div  class="form-group">
    <label class="col-sm-3 control-label">Mata Pelajaran</label>
    <div class="col-sm-8">
     <select class="form-control" id="pelajaran">

     </select>
   </div>
 </div>

 <div  class="form-group">
  <label class="col-sm-3 control-label">Bab</label>
  <div class="col-sm-8">
    <select class="form-control" id="bab" id="bab">

    </select>
  </div>
</div>

<div  class="form-group">
  <label class="col-sm-3 control-label">Nama Topik</label>
  <div class="col-sm-8">

   <input type="text" class="form-control" name="nama_topik" value="{judul}">
 </div>
</div>

<div  class="form-group">
  <label class="col-sm-3 control-label">Urutan</label>
  <div class="col-sm-8">

   <input type="text" class="form-control" name="urutan" value="{urutan}">
 </div>
</div>

<div  class="form-group">
  <label class="col-sm-3 control-label">Status</label>
  <div class="col-sm-8">
   <span class="radio custom-radio-primary">  
    <input type="radio" id="radio1" value="1" name="status"checked>  
    <label for="radio1">&nbsp;&nbsp;Published</label>   
  </span>
  <span class="radio custom-radio-primary">  
    <input type="radio" id="radio2" value="0" name="status">  
    <label for="radio2">&nbsp;&nbsp;Non Published</label>   
  </span>
</div>
</div>

<div  class="form-group">
  <label class="col-sm-3 control-label">Deskripsi</label>
  <div class="col-sm-8">
    <textarea class="form-control" name="deskripsi">{deskripsi}</textarea>
  </div>
</div>

<div class="form-group no-border">
  <label class="col-sm-3 control-label"></label>
  <div class="col-sm-9">
   <a class="btn btn-primary update_topik">Update</a>
   <button type="reset" class="btn btn-danger reset">Reset</button>
 </div>
</div>
</form>

</div>
</div>
</div>
</div>
</div>
<!-- TABEL KONTEN 1 . FORM LEARNINGNLINE -->
<script type="text/javascript">

  function loadPelajaran(tingkatID) {
        var oldmp = $('#oldmp').val();
        $.ajax({

            type: "POST",
            dataType: "json",
            data: tingkatID.tingkat_id,

            url: "<?php echo base_url() ?>index.php/videoback/getPelajaran/" + tingkatID,

            success: function (data) {

                $('#pelajaran').html('<option value="">-- Pilih Mata Pelajaran  --</option>');
                $.each(data, function (i, data) {
                    if (data.id==oldmp) {
                      $('#pelajaran').append("<option value='" + data.id + "' selected>" + data.keterangan + "</option>");
                    } else {
                      $('#pelajaran').append("<option value='" + data.id + "'>" + data.keterangan + "</option>");
                    }
                    

                });

            }

        });

  }

  function load_bab(mapelID) {
        var oldbab = $('#oldbab').val();
        $.ajax({

            type: "POST",
            dataType: "json",
            data: mapelID.mapel_id,

            url: "<?php echo base_url() ?>index.php/videoback/getBab/" + mapelID,

            success: function (data) {



                $('#bab').html('<option value="">-- Pilih Bab Pelajaran  --</option>');

                //console.log(data);

                $.each(data, function (i, data) {
                    if (data.id==oldbab) {
                       $('#bab').append("<option value='" + data.id + "' selected>" + data.judulBab + "</option>");
                    } else {
                       $('#bab').append("<option value='" + data.id + "'>" + data.judulBab + "</option>");
                    }
                   

                });

            }



        });
  }

  $(document).ready(function () {
    $('#tingkat').change(function () {
      tingkat_id = {"tingkat_id": $('#tingkat').val()};
      loadPelajaran($('#tingkat').val());
    })



    $('#pelajaran').change(function () {
      pelajaran_id = {"pelajaran_id": $('#pelajaran').val()};
      load_bab($('#pelajaran').val());
    })

    $('#eTingkat').change(function () {
      var form_data = {
        name: $('#eTingkat').val()
      };
      $.ajax({
        url: "<?php echo site_url('videoback/getPelajaran'); ?>",

        type: 'POST',
        dataType: "json",
        data: form_data,
        success: function (msg) {
          var sc = '';
          $.each(msg, function (key, val) {
            sc += '<option value="' + val.id + '">' + val.keterangan + '</option>';
          });
          $("#ePelajaran option").remove();
          $("#ePelajaran").append(sc);
        }
      });
    });
  });


  function loadTingkat() {

    jQuery(document).ready(function () {
      var oldtkt = $('#oldtkt').val();
      var tingkat_id = {"tingkat_id": $('#tingkat').val()};

      var idTingkat;
      $.ajax({

        type: "POST",
        dataType: "json",
        data: tingkat_id,

        url: "<?= base_url() ?>index.php/videoback/getTingkat",

        success: function (data) {


          $('#tingkat').html('<option value="">-- Pilih Tingkat  --</option>');

          $.each(data, function (i, data) {

            if (data.id==oldtkt) {
             $('#tingkat').append("<option value='" + data.id + "' selected>" + data.aliasTingkat + "</option>");
           } else {
            $('#tingkat').append("<option value='" + data.id + "'>" + data.aliasTingkat + "</option>");
          }



          return idTingkat = data.id;

        });

        }

      });
    });
  }

  loadTingkat();
  console.log("asd"+$('#oldtkt').val());
  loadPelajaran($('#oldtkt').val());
  load_bab($('#oldmp').val());
  console.log($('#oldmp').val());
</script>