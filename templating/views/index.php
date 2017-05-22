<html>

<head>

    <title>{judul_halaman}</title>
    <meta charse="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    
    <!-- style -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/back/rs-plugin/css/settings.css') ?>" media="screen">
    <link rel="stylesheet" href="<?= base_url('assets/back/css/animate.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/library/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>"/>
    <link rel="stylesheet" href="<?= base_url('assets/plugins/owl/css/owl.carousel.min.css'); ?>">
    <link rel="shortcut icon" href="<?= base_url('assets/back/img/favicon.png') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/back/css/font-awesome.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/back/fi/flaticon.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/back/css/main.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/back/css/jquery.fancybox.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/back/css/owl.carousel.css') ?>"/>
    <script type="text/javascript" src="<?= base_url('assets/library/jquery/js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/sal/sweetalert-dev.js');?>"></script>
    <link rel="stylesheet" href="<?= base_url('assets/sal/sweetalert.css');?>">
    <!--styles -->

</head>
<body>


    <script type="text/javascript">var base_url = "<?= base_url() ?>"</script>
    <script src="<?= base_url('assets/back/js/jquery.min.js') ?>"></script>
    <?php
    
    foreach ($files as $key) {
        include ($key);
    }
    ?>

    <script type='text/javascript' src="<?= base_url('assets/back/js/jquery.validate.min.js') ?>"></script>
    <script src="<?= base_url('assets/back/js/jquery.form.min.js') ?>"></script>
    <script src="<?= base_url('assets/back/js/TweenMax.min.js') ?>"></script>
    <script src="<?= base_url('assets/back/js/main.js') ?>"></script>

    <!-- jQuery REVOLUTION Slider  -->

    <script type="text/javascript" src="<?= base_url('assets/back/rs-plugin/js/jquery.themepunch.tools.min.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/back/rs-plugin/js/jquery.themepunch.revolution.min.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/back/rs-plugin/js/extensions/revolution.extension.slideanims.min.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/back/rs-plugin/js/extensions/revolution.extension.actions.min.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/back/rs-plugin/js/extensions/revolution.extension.layeranimation.min.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/back/rs-plugin/js/extensions/revolution.extension.kenburn.min.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/back/rs-plugin/js/extensions/revolution.extension.navigation.min.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/back/rs-plugin/js/extensions/revolution.extension.migration.min.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/back/rs-plugin/js/extensions/revolution.extension.parallax.min.js') ?>"></script>		
    <script src="<?= base_url('assets/back/js/jquery.isotope.min.js') ?>"></script>



    <script src="<?= base_url('assets/back/js/owl.carousel.min.js') ?>"></script>
    <script src="<?= base_url('assets/back/js/jquery-ui.min.js') ?>"></script>
    <script src="<?= base_url('assets/back/js/jflickrfeed.min.js') ?>"></script>
    <script src="<?= base_url('assets/back/js/jquery.tweet.js') ?>"></script>
    <script src="<?= base_url('assets/back/js/jquery.fancybox.pack.js') ?>"></script>
    <script src="<?= base_url('assets/back/js/jquery.fancybox-media.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/library/bootstrap/js/bootstrap.min.js') ?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/plugins/owl/js/owl.carousel.min.js');?>"></script>
    <script src="<?= base_url('assets/back/js/retina.min.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/plugins/datatables/js/jquery.datatables.min.js') ?>"></script>

    <!--datatable-->
    <script type="text/javascript" src="<?= base_url('assets/plugins/datatables/js/jquery.datatables.min.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/plugins/datatables/tabletools/js/tabletools.min.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/plugins/datatables/js/jquery.datatables-custom.min.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/javascript/tables/datatable.js') ?>"></script>

</body>

</html>