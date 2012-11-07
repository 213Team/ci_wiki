<html>
<head>
	<title><?=$title?></title>
	<?=link_tag('stylesheet.css')?>
</head>
<body>

<div id="header">
	<h1><?=$title?></h1>
</div>

<div id="menu">
	<?=anchor('', "Home")?> &bull;
	<?php if ($login_user):?>
	<?=anchor('logout_controller', "Logout")?>
	<i><?="[$login_user]"?></i>
	<?php if ($login_user== 'wind' ):?>
	<i><?=anchor('app_controller/get', "[Apps]")?></i>
	<?php endif;?>
	<?php else:?>
	<?=anchor('login_controller', "Login")?> &bull;
	<?=anchor('register_controller', "Register")?>
	<?php endif;?>
</div>

<div id="container">
<div id="main">
