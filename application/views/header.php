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
	<?=anchor('usercenter/dologout', "Logout")?>
	<i><?=anchor('usercenter',"[".$login_user['username']."]")?></i>
	<?php else:?>
	<?=anchor('usercenter/login', "Login")?> &bull;
	<?=anchor('usercenter/register', "Register")?>
	<?php endif;?>
</div>

<div id="container">
<div id="main">
