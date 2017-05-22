<main>
    <div class="page-content container clear-fix">
        <div class="container-404">
            <p>{pesan}</p>
            <center>    <input type="text" name="kode_token" style="width: 40%;margin-bottom: 10px" placeholder="Masukan Kode Token"><a class="cws-button bt-color-3 alt isi_button">Isi!</a></center>
        </div>
    </div>
</main>


<script type="">
    $('.isi_button').click(function(){
        kode_token = $('input[name=kode_token]').val();
        url = base_url+"token/isi_token";
        $.ajax({
            type:'POST',
            data:{kode_token:kode_token},
            url:base_url+"token/isi_token",
            dataType:"TEXT",
            success:function(data){
                console.log(data);
                if (data=="1") {     
                    swal('Token Berhasil di aktifkan, silahkan menikmati layanan kami !');
                   window.location = base_url+"welcome";
                }else{
                    swal('Kode Token salah');
                }
            },error:function(){
                console.log('masuk 1');
            }
        });
    })


</script>