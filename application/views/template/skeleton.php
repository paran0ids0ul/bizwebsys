<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title><?php echo $title ?></title>
<meta name="description" content="<?php echo $description ?>" />
<meta name="viewport" content="width=device-width">
<meta name="keywords" content="<?php echo $keywords ?>" />
<meta name="author" content="<?php echo $author ?>" />

<link rel="stylesheet" href="<?php echo base_url(CSS."bootstrap-2.3.0-custom-responsive.min.css");?>">
<link rel="stylesheet" href="<?php echo base_url(CSS."jqueryui-bootstrap/jquery-ui-1.10.0.custom.css");?>">
<link rel="stylesheet" href="<?php echo base_url(CSS."font-awesome.min.css");?>">
<!--[if IE 7]>
	<link rel="stylesheet" href="<?php echo base_url(CSS."jqueryui-bootstrap/jquery.ui.1.10.0.ie.css");?>">
	<link rel="stylesheet" href="<?php echo base_url(CSS."font-awesome-ie7.min.css");?>">
<![endif]-->


<link rel="stylesheet" href="<?php echo base_url(CSS."global.css");?>">

<!-- extra CSS-->
<?php foreach($css as $c):?>
<link rel="stylesheet" href="<?php echo base_url().CSS.$c?>">
<?php endforeach;?>

<!-- extra fonts-->
<?php foreach($fonts as $f):?>
<link href="http://fonts.googleapis.com/css?family=<?php echo $f?>"
	rel="stylesheet" type="text/css">
<?php endforeach;?>

<script src="<?php echo base_url(JS."libs/modernizr-2.6.2-custom-respond-1.1.0.min.js");?>"></script>

<!-- Le fav and touch icons -->
<link rel="shortcut icon" href="<?php echo base_url(IMAGES.'ico/favicon.ico');?>">
<link rel="apple-touch-icon" href="<?php echo base_url(IMAGES.'ico/apple-touch-icon-precompresse.png');?>">
<link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url(IMAGES.'ico/apple-touch-icon-57x57-precompressed.png');?>">
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url(IMAGES.'ico/apple-touch-icon-72x72-precompressed.png');?>">
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url(IMAGES.'ico/apple-touch-icon-114x114-precompressed.png');?>">

<?php echo $customHead; ?>
<?php echo $custom_css; ?>
</head>
<body>
	<?php echo $body ?>

	<script
		src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="<?php echo base_url(JS."libs/jquery-1.9.1.min.js");?>"><\/script>')</script>
	<script src="<?php echo base_url(JS."libs/underscore-1.4.4.min.js");?>"></script>
	<script src="<?php echo base_url(JS."bootstrap-2.3.1.min.js");?>"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/jquery-ui.min.js"></script>
	<script>window.jQuery.ui || document.write('<script src="<?php echo base_url(JS."libs/jquery-ui-1.10.1.custom.min.js");?>"><\/script>')</script>
	<script src="<?php echo base_url(JS."script.js");?>"></script>
	<script src="<?php echo base_url(JS."jquery.json-2.4.min.js");?>"></script>
	
	<!-- extra js-->
	<?php foreach($javascript as $js):?>
	<script defer src="<?php echo base_url().JS.$js?>"></script>
	<?php endforeach;?>
	<?php echo $custom_js;?>
		<!-- DATEPICKER TODO:MOVE OUT-->
								  <script>
									  $(function() {
										$( "#datepicker" ).datepicker();
									  });
								  </script>
  <script>

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-39088572-1']);
  _gaq.push(['_setDomainName', 'bizwebsys.tk']);
  _gaq.push(['_setAllowLinker', true]);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
  </script>
</body>
</html>
