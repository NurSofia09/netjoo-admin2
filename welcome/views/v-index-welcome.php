<!DOCTYPE HTML>
<html>
<head>
	<title>{judul_halaman}</title>
	<script src="<?=base_url('assets/back/js/jquery.min.js') ?>"></script>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
	<!-- style -->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> integrity="sha384-2hfp1SzUoho7/TsGGGDaFdsuuDL0LX2hnUp6VkX3CUQ2K4K+xjboZdsXyp4oUHZj" crossorigin="anonymous">
	
	<link rel="shortcut icon" href="<?=base_url('assets/back/img/favicon.png') ?>">
	<link rel="stylesheet" href="<?=base_url('assets/back/css/font-awesome.css') ?>">
	<link rel="stylesheet" href="<?=base_url('assets/back/fi/flaticon.css') ?>">
	<link rel="stylesheet" href="<?=base_url('assets/back/css/main.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/back/css/jquery.fancybox.css') ?>" />
	<link rel="stylesheet" href="<?=base_url('assets/back/css/owl.carousel.css') ?>"/>
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/back/rs-plugin/css/settings.css') ?>" media="screen">
	<link rel="stylesheet" href="<?=base_url('assets/back/css/animate.css') ?>">

	<!--styles -->
</head>
<body>
<?php foreach ($files as $key) {
	include ($key);
	}	
 ?>


<script type='text/javascript' src="<?=base_url('assets/back/js/jquery.validate.min.js') ?>"></script>
<script src="<?=base_url('assets/back/js/jquery.form.min.js') ?>"></script>
<script src="<?=base_url('assets/back/js/TweenMax.min.js') ?>"></script>
<script src="<?=base_url('assets/back/js/main.js') ?>"></script>
<!-- jQuery REVOLUTION Slider  -->
<script type="text/javascript" src="<?=base_url('assets/back/rs-plugin/js/jquery.themepunch.tools.min.js') ?>"></script>
<script type="text/javascript" src="<?=base_url('assets/back/rs-plugin/js/jquery.themepunch.revolution.min.js') ?>"></script>
<script type="text/javascript" src="<?=base_url('assets/back/rs-plugin/js/extensions/revolution.extension.slideanims.min.js') ?>"></script>
<script type="text/javascript" src="<?=base_url('assets/back/rs-plugin/js/extensions/revolution.extension.actions.min.js') ?>"></script>
<script type="text/javascript" src="<?=base_url('assets/back/rs-plugin/js/extensions/revolution.extension.layeranimation.min.js') ?>"></script>
<script type="text/javascript" src="<?=base_url('assets/back/rs-plugin/js/ex tensions/revolution.extension.kenburn.min.js') ?>"></script>
<script type="text/javascript" src="<?=base_url('assets/back/rs-plugin/js/extensions/revolution.extension.navigation.min.js') ?>"></script>
<script type="text/javascript" src="<?=base_url('assets/back/rs-plugin/js/extensions/revolution.extension.migration.min.js') ?>"></script>
<script type="text/javascript" src="<?=base_url('assets/back/rs-plugin/js/extensions/revolution.extension.parallax.min.js') ?>"></script>		
<script src="<?=base_url('assets/back/js/jquery.isotope.min.js') ?>"></script>

<script src="<?=base_url('assets/back/js/owl.carousel.min.js') ?>"></script>
<script src="<?=base_url('assets/back/js/jquery-ui.min.js') ?>"></script>
<script src="<?=base_url('assets/back/js/jflickrfeed.min.js') ?>"></script>
<script src="<?=base_url('assets/back/js/jquery.tweet.js') ?>"></script>
<script src="<?=base_url('assets/back/js/jquery.fancybox.pack.js') ?>"></script>
<script src="<?=base_url('assets/back/js/jquery.fancybox-media.js') ?>"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="<?=base_url('assets/back/js/retina.min.js') ?>"></script>
<script type="text/javascript">
	 $("#myCarousel").carousel();
</script>
</body>
</html>