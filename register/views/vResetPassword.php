<main>
    <section class="fullwidth-background bg-2">
        <div class="grid-row">
            <div class="login-block" style="min-width: 50%">
                <div class="logo">
                    <img src="<?= base_url('assets/back/img/logo.png') ?>" alt>
                    <!--<h4>Login</h4>-->
                </div>
                <div class="">
                    <div class="page-header-section">
                        <h4 class="title font-alt text-center">RESET PASSWORD</h4>
                    </div>
                </div>
                
                <form class="login-form" name="form-register" action="<?= base_url() ?>index.php/register/resetdatapassword" method="post">

                    <!-- Alert message -->
                    <div class="alert alert-warning">
                        <span class="semibold">Info :</span>&nbsp;&nbsp;Masukan password baru mu
                    </div>
                    <!--/ Alert message -->
                    
                    <hr class="nm">
                    <br>
                    <!-- Star form konfirmasi akun by email -->
                    <div class="form-group">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            <i class="ico-lock2 form-control-icon"></i>

                    </div>
                    <div class="form-group">
                            <input type="password" class="form-control" id="password2" name="oldpassword" placeholder="Confirm Password" required onkeyup="checkPass(); return false;">
                            <span id="confirmMessage" class="confirmMessage"></span>
                            <i class="ico-lock2 form-control-icon"></i>

                    </div>
                    <!-- end form konfirmasi akun by email -->
                    <div class="">
                        <button type="submit" class="button-fullwidth cws-button bt-color-3 alt"><span class="semibold">Submit</span></button>
                    </div>
                </form>

            </div>
        </div>
        <a href="#" class="totop animation" data-toggle="waypoints totop" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="50%"><i class="ico-angle-up"></i></a>
    </section>
</main>
<!--/ END Template Main -->
<script type="text/javascript">
    function checkPass() {
        //Store the password field objects into variables ...
        var pass1 = document.getElementById('password');
        var pass2 = document.getElementById('password2');
        //Store the Confimation Message Object ...
        var message = document.getElementById('confirmMessage');
        //Set the colors we will be using ...
        var goodColor = "#66cc66";
        var badColor = "#ff6666";
        var blank = "#fff"
        //Compare the values in the password field
        //and the confirmation field

        if (pass2.value == "") {
            message.style.color = blank;
            message.innerHTML = ""
        } else if (pass1.value == pass2.value) {
            //The passwords match.
            //Set the color to the good color and inform
            //the user that they have entered the correct password
            message.style.color = goodColor;
            message.innerHTML = "Passwords Cocok!"
        } else {
            //The passwords do not match.
            //Set the color to the bad color and
            //notify the user.
            message.style.color = badColor;
            message.innerHTML = "Passwords Tidak Cocok!"
        }
    }

</script>

