<section class="main">
	<div class="row">
		<div class="col-md-5">
      <!-- panel -->
      <div class="panel panel-danger">
        <!-- panel heading -->
        <div class="panel-heading">
         <h3 class="panel-title">Rollback Import excel</h3>
       </div>
       <!-- /panel heading -->
       <!-- panel body -->
       <div class="panel-body">
         <form class="" id="form_rollback" action="javascript:void(0)">
          <div class="form-group">
       <div class="row">
        <label class="col-sm-3 control-label">Hakakses</label>
        <div class="col-sm-9">
         <select class="form-control" name="hakakses">
          <option class="" value="siswa">Siswa</option>
          <option class="" value="guru">Guru</option>
        </select>
      </div>
    </div>
  </div>
        <div class="form-group" id="cabang">
           <div class="row">
            <label class="col-sm-3 control-label">Cabang </label>
            <div class="col-sm-9">
             <select  class="form-control" name="cabangID" id="op_cabang">
                      <option >Pilih Cabang</option>
                    </select>
           </div>
         </div>
       </div>
          <div class="form-group">
           <div class="row">
            <label class="col-sm-3 control-label">Batas Awal Rollback </label>
            <div class="col-sm-9">
             <input type="datetime-local" class="form-control" name="tanggal_mulai">
           </div>
         </div>
       </div>
       <div class="form-group">
         <div class="row">
          <label class="col-sm-3 control-label">Batas Akhir Rollback</label>
          <div class="col-sm-9">
           <input type="datetime-local" class="form-control" name="tanggal_akhir">
         </div>
       </div>
     </div>
  <div class="form-group">
   <div class="row">
    <label class="col-sm-3 control-label">Vlidasi rollback</label>
    <div class="col-sm-9">
     <input type="password" class="form-control" name="kode_validasi" placeholder="">
   </div>
 </div>
</div>
</form>
</div>
<!-- /panel body -->
<!-- panel footer -->
<div class="panel-footer">
<button class="btn btn-sm btn-danger" id="btn_rollback">Rollback Data Import</button>
</div>
<!-- /panel footer -->
</div>
<!-- /panel    -->
</div>
</div>
</section>
<script type="text/javascript">
  $(document).ready(function(){
    //belum bisa digunakan 
    //roolback siswa berdasarkan cabang
     $("#cabang").hide();
    $("select[name=hakakses]").change(function() {
       var hakakses=$("select[name=hakakses]").val();
      if (hakakses=="guru") {
        $("#cabang").hide(1000);
      }else{
         $("#cabang").show(1000);
      }
     
    });
    //event ketika btn rollback di klik
    //melakukan pengecekan input
   $("#btn_rollback").click(function(){
    var cek_tanggal_mulai=$("input[name=tanggal_mulai]").val();
    var cek_tanggal_akhir=$("input[name=tanggal_akhir]").val();
    var hakakses=$("select[name=hakakses]").val();
    var kode_validasi=$("input[name=kode_validasi]").val();
      if (cek_tanggal_mulai==" "||cek_tanggal_akhir==" "||hakakses==" "||kode_validasi==" "||cek_tanggal_mulai==""||cek_tanggal_akhir==""||hakakses==""||kode_validasi=="") {
        swal("Opss","Inputan tidak boleh kosong!","error");
      } else {
        validasi_input_tgl();
      }
 });
   //load set_op_cabang
   set_op_cabang();
 });
  function validasi_input_tgl() {
        var tanggal_mulai=$("input[name=tanggal_mulai]").val();
    var tanggal_akhir=$("input[name=tanggal_akhir]").val();
    var format_tgl_mulai=  dateFormat(new Date(tanggal_mulai), "dd-mmm-yy, h:MM TT");
    var format_tgl_akhir=dateFormat(new Date(tanggal_akhir), "dd-mmm-yy, h:MM TT");
    // cek input tanggal
    if (tanggal_mulai  <= tanggal_akhir) {
     konfirmasi_rollback(format_tgl_mulai,format_tgl_akhir); 
   } else {
     swal("Upss","Batas awal rollback tidak boleh melebihi batas akhir rollback","error");
   }
  }
// konfirmasi roolback
function konfirmasi_rollback(format_tgl_mulai,format_tgl_akhir) {
  swal({
    title: "Yakin melakukan rollback data?",
    text: format_tgl_mulai+" Sampai "+format_tgl_akhir,
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Ya,Tetap rollback!",
    closeOnConfirm: false
  },
  function(){
   action_rollback();
 });
}
  // post data untuk melakuan roolback
  function action_rollback() {
    var url_rollback=base_url+"import_user/validasi_rollback";
    var form=$("#form_rollback");
    $.ajax({
     url:url_rollback,
     data:form.serialize(),
     type:"post",
     dataType:"text",
     success:function(Data){
      var ob_data=JSON.parse(Data);
      if (ob_data.msg==="true") {
       swal("Success","rollback berhasil","success");
       reset_form_rollback();
     } else if(ob_data.msg==="false2"){
       swal("oops","Data pada tanggal tersebut tidak ada!","error");
     }else{
        swal("oops","Kode validasi tidak sesuai","error");
     }

   },
 });
  }
  // reset form
  function reset_form_rollback() {
     $('#form_rollback')[0].reset();
  }

  //set cabang
  function set_op_cabang(){
  var url_cabang=base_url+"import_user/get_cabang";
  $.ajax({
      url:url_cabang,
      type:"post",
      dataType:"text",
      success:function(Data){
        var ob_data = JSON.parse(Data);
        var sc = '';
    $.each(ob_data, function (key, val) {
        sc += '<option value="' + val.id + '">' + val.namaCabang + '</option>';
    });
    $("#op_cabang option").remove();
    $("#op_cabang").append(sc);
      },
      error:function(){
      }
    });
}

// format date
var dateFormat = function () {
  var token = /d{1,4}|m{1,4}|yy(?:yy)?|([HhMsTt])\1?|[LloSZ]|"[^"]*"|'[^']*'/g,
  timezone = /\b(?:[PMCEA][SDP]T|(?:Pacific|Mountain|Central|Eastern|Atlantic) (?:Standard|Daylight|Prevailing) Time|(?:GMT|UTC)(?:[-+]\d{4})?)\b/g,
  timezoneClip = /[^-+\dA-Z]/g,
  pad = function (val, len) {
    val = String(val);
    len = len || 2;
    while (val.length < len) val = "0" + val;
    return val;
  };
    // Regexes and supporting functions are cached through closure
    return function (date, mask, utc) {
      var dF = dateFormat;

        // You can't provide utc if you skip other args (use the "UTC:" mask prefix)
        if (arguments.length == 1 && Object.prototype.toString.call(date) == "[object String]" && !/\d/.test(date)) {
          mask = date;
          date = undefined;
        }

        // Passing date through Date applies Date.parse, if necessary
        date = date ? new Date(date) : new Date;
        if (isNaN(date)) throw SyntaxError("invalid date");

        mask = String(dF.masks[mask] || mask || dF.masks["default"]);

        // Allow setting the utc argument via the mask
        if (mask.slice(0, 4) == "UTC:") {
          mask = mask.slice(4);
          utc = true;
        }

        var _ = utc ? "getUTC" : "get",
        d = date[_ + "Date"](),
        D = date[_ + "Day"](),
        m = date[_ + "Month"](),
        y = date[_ + "FullYear"](),
        H = date[_ + "Hours"](),
        M = date[_ + "Minutes"](),
        s = date[_ + "Seconds"](),
        L = date[_ + "Milliseconds"](),
        o = utc ? 0 : date.getTimezoneOffset(),
        flags = {
          d:    d,
          dd:   pad(d),
          ddd:  dF.i18n.dayNames[D],
          dddd: dF.i18n.dayNames[D + 7],
          m:    m + 1,
          mm:   pad(m + 1),
          mmm:  dF.i18n.monthNames[m],
          mmmm: dF.i18n.monthNames[m + 12],
          yy:   String(y).slice(2),
          yyyy: y,
          h:    H % 12 || 12,
          hh:   pad(H % 12 || 12),
          H:    H,
          HH:   pad(H),
          M:    M,
          MM:   pad(M),
          s:    s,
          ss:   pad(s),
          l:    pad(L, 3),
          L:    pad(L > 99 ? Math.round(L / 10) : L),
          t:    H < 12 ? "a"  : "p",
          tt:   H < 12 ? "am" : "pm",
          T:    H < 12 ? "A"  : "P",
          TT:   H < 12 ? "AM" : "PM",
          Z:    utc ? "UTC" : (String(date).match(timezone) || [""]).pop().replace(timezoneClip, ""),
          o:    (o > 0 ? "-" : "+") + pad(Math.floor(Math.abs(o) / 60) * 100 + Math.abs(o) % 60, 4),
          S:    ["th", "st", "nd", "rd"][d % 10 > 3 ? 0 : (d % 100 - d % 10 != 10) * d % 10]
        };

        return mask.replace(token, function ($0) {
          return $0 in flags ? flags[$0] : $0.slice(1, $0.length - 1);
        });
      };
    }();

// Some common format strings
dateFormat.masks = {
  "default":      "ddd mmm dd yyyy HH:MM:ss",
  shortDate:      "m/d/yy",
  mediumDate:     "mmm d, yyyy",
  longDate:       "mmmm d, yyyy",
  fullDate:       "dddd, mmmm d, yyyy",
  shortTime:      "h:MM TT",
  mediumTime:     "h:MM:ss TT",
  longTime:       "h:MM:ss TT Z",
  isoDate:        "yyyy-mm-dd",
  isoTime:        "HH:MM:ss",
  isoDateTime:    "yyyy-mm-dd'T'HH:MM:ss",
  isoUtcDateTime: "UTC:yyyy-mm-dd'T'HH:MM:ss'Z'"
};

// Internationalization strings
dateFormat.i18n = {
  dayNames: [
  "Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat",
  "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"
  ],
  monthNames: [
  "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec",
  "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"
  ]
};

// For convenience...
Date.prototype.format = function (mask, utc) {
  return dateFormat(this, mask, utc);
};
	// formmat date
</script>