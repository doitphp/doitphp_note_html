<?php if(!defined('IN_DOIT')) exit(); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $title; ?> | DoitPHP 2.3</title>
<meta name="Keywords" content="DoitPHP应用" />
<meta name="description" content="DoitPHP V2.3演示实例, DoitPHP编写的留言本" />
<meta name="Copyright" content="Copyright(c) 2015 www.doitphp.com" />
<meta name="generator" content="DoitPHP 2.3" />
<link href="<?php echo $assetUrl; ?>/css/screen.css" rel="stylesheet" type="text/css">
<!--[if lt IE 8]><link rel="stylesheet" href="<?php echo $assetUrl; ?>/css/ie.css" type="text/css"><![endif]-->

<!-- 加载doitphp所集成分页的css文件  -->
<?php echo $paginationCss; ?>
<!-- 加载doitphp所集成的jquery,及其form插件  -->
<?php echo Script::add('jquery'), Script::add('form'); ?>

<!-- 加载JS函数库文件  -->
<script type="text/javascript" src="<?php echo $assetUrl; ?>/js/mainlibs.js?version=2.3"></script>
<!-- JS代码，用于处理页面数据提交  -->
<?php echo $javaScript; ?>
</head>

<body>
<div class="container" style="margin-top:20px; padding:30px; background:#FFFFFF; width:900px;">
	<!-- top -->
	<div class="header">
		<div><a href="<?php echo $this->getBaseUrl(); ?>"><img src="<?php echo $assetUrl; ?>/images/logo.jpg" width="350" height="70" border="0" title="doitphp tools logo"></a></div>
		<div class="text-align-right" style="padding-right:15px;"><?php Controller::widget('loginStatus'); ?></div>
		<!-- main menu-->
		<?php Controller::widget('mainMenu'); ?>
		<!-- /main menu-->
	</div>
	<hr class="space clear"/>
	<!-- /top -->

	<!-- content -->
	<?php echo $viewContent; ?>
	<!-- /content -->

	<!-- footer-->
	<div class="footer">CopyRight <a href="http://www.doitphp.com" target="_blank">www.doitphp.com</a> 2010 - 2015</div>
	<!-- /footer-->
</div>
</body>
</html>