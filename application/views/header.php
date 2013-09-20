<?php
$class = $this->router->class;
$method = $this->router->method;
$echoactive = function($controller, $func = "") use ($class, $method){
	if(($controller == $class) && ($func == "" || $func == $method))
		echo 'class="active"';
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8">
  	<title><?php echo $title?></title>
  	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  	<meta name="description" content="">
  	<meta name="author" content="">

	<!--link rel="<?php echo base_url();?>/stylesheet/less" href="less/bootstrap.less" type="text/css" /-->
	<!--link rel="<?php echo base_url();?>/stylesheet/less" href="less/responsive.less" type="text/css" /-->
	<!--script src="<?php echo base_url();?>/js/less-1.3.3.min.js"></script-->
	<!--append ‘#!watch’ to the browser URL, then refresh the page. -->
	
	<link href="<?php echo base_url();?>/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url();?>/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link href="<?php echo base_url();?>/css/style.css" rel="stylesheet">
	
	<style type="text/css">
	.no-radius{
		-webkit-border-radius: 0;
	    -moz-border-radius: 0;
	    border-radius: 0;
    }
    .boxshadow{box-shadow: 0 0 1em #ccc;}
	</style>

  <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
    <script src="<?php echo base_url();?>/js/html5shiv.js"></script>
  <![endif]-->

  <!-- Fav and touch icons -->
  <link rel="shortcut icon" href="<?php echo base_url();?>/img/favicon.png">
  
	<script type="text/javascript" src="<?php echo base_url();?>/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>/js/scripts.js"></script>
</head>

<body style="padding-top: 50px;">

<div class="container">
	<div class="row">
		<div class="col-md-12">
		
			<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
				<!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="<?php echo base_url();?>">协同写作</a>
  </div>
						 <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav">
      <li <?php $echoactive("index");?>><a href="<?php echo base_url();?>">首页</a></li>
      <li <?php $echoactive("books");?>><?php echo anchor('books','浏览公开书籍');?></li>
	  <li <?php $echoactive("about");?>><?php echo anchor('about','关于');?></li>
    </ul>
    
    <ul class="nav navbar-nav navbar-right">
    <?php if (isset($login_user) && $login_user):?>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $login_user['username']?><b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li role="presentation" class="dropdown-header">导航</li>
          <li><a href="#">Another action</a></li>
          <li><a href="#">Something else here</a></li>
          <li class="divider"></li>
          <li><?php echo anchor('usercenter','进入用户中心');?></li>
          <li><?php echo anchor('usercenter/dologout','注销');?></li>
        </ul>
      </li>
    <?php else:?>
          <li <?php $echoactive("usercenter","register");?>><?php echo anchor('usercenter/register','注册');?></li>
		  <li <?php $echoactive("usercenter", "login");?>><?php echo anchor('usercenter/login','登陆');?></li>
	<?php endif;?>
    </ul>
  </div><!-- /.navbar-collapse -->
   </nav>
 </div>
 </div>
 </div>


