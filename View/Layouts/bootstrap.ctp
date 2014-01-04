<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>
		Notebook
		<?php echo $title_for_layout; ?>
	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="k.k">

	<!-- Le styles -->
	<!--	http://www.bootstrapcdn.com/-->
<!--	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">-->
<!--	<link href="//netdna.bootstrapcdn.com/bootswatch/3.0.3/cerulean/bootstrap.min.css" rel="stylesheet">-->
<!--	<link href="//netdna.bootstrapcdn.com/bootswatch/3.0.2/slate/bootstrap.min.css" rel="stylesheet">-->
<!--	<link href="//netdna.bootstrapcdn.com/bootswatch/3.0.2/spacelab/bootstrap.min.css" rel="stylesheet">-->
<!--	<link href="//netdna.bootstrapcdn.com/bootswatch/3.0.2/yeti/bootstrap.min.css" rel="stylesheet">-->
<!--	<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/themes/redmond/jquery-ui.css" type="text/css" media="all" />-->
	<?php
		echo $this->Html->css('/js/vendar/bootstrap/css/bootstrap.min');
		echo $this->Html->css('/js/vendar/jqueryui/themes/cupertino/jquery-ui.min');
	?>

	<?php echo $this->Html->css('main'); ?>
	<?php echo $this->Html->css('sidebar'); ?>

	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<?php echo $this->fetch('meta'); echo $this->fetch('css'); ?>
</head>

<body>

<!--	<div id="toppanel"></div>-->

	<div id="wrapper">

		<?php echo $this->element('menu'); ?>

		<!--		<div class="container">-->
		<div id="page-content-wrapper" class="container">
			<a id="menu-toggle" href="#" class="btn btn-default">
				<i class="glyphicon glyphicon-th"></i>
			</a>

			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>

		</div>
		<!-- /container -->
	</div>

	<p class="gotop" style="display:none">
			<a href="#"><i class="glyphicon glyphicon-arrow-up"></i></a>
	</p>

	<!-- Le javascript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
<!--	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
<!--	<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>-->
<!--	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>-->
<!--	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/i18n/jquery-ui-i18n.min.js"></script>-->

	<?php
		echo $this->Html->script('vendar/jquery/jquery-1.10.2.min');
		echo $this->Html->script('vendar/jqueryui/jquery-ui.min');
		echo $this->Html->script('vendar/bootstrap/js/bootstrap.min');
		echo $this->Html->script('vendar/jquery.nicescroll/jquery.nicescroll.min');
	?>

	<?php echo $this->Html->script('main'); ?>

	<?php echo $this->fetch('script'); ?>

</body>

</html>
