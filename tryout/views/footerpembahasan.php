<script type="text/javascript" src="<?= base_url('assets/library/jquery/js/jquery.min.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/library/bootstrap/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/library/core/js/core.min.js'); ?>"></script>
<script>
    function disableF5(e) {
        if ((e.which || e.keyCode) == 116)
            e.preventDefault();
    }

    $(document).on("keydown", disableF5);

    $(document).bind("contextmenu", function (e) {
        e.preventDefault();
    });
</script>
<script type="text/javascript" src="<?= base_url('assets/plugins/owl/js/owl.carousel.min.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/javascript/pages/frontend/home.js'); ?>"></script>


<!-- Start Math jax --> 
<script type="text/x-mathjax-config"> 
    MathJax.Hub.Config({ 
    tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]} 
    }); 
</script> 
<script type="text/javascript" async 
        src="<?= base_url('assets/plugins/MathJax-master/MathJax.js?config=TeX-MML-AM_HTMLorMML') ?>">
</script> 
<!-- end Math jax -->
</body>