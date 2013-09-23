<?php
$class = $this->router->class;
$method = $this->router->method;
$echoactive = function($controller, $func = "") use ($class, $method){
	if(($controller == $class) && ($func == "" || $func == $method))
		echo 'style="background-color: #efefef"';
}
?>
<div class="col-md-4" style="margin-top:70px;">
<div class="row">
<div class="col-md-offset-3 col-md-8">
<div class="panel panel-default boxshadow no-radius">
<ul class="nav nav-stacked">
	<li <?php $echoactive("usercenter","dashboard");?>><?php echo anchor("usercenter", "用户首页");?></li>
	<li <?php $echoactive("usercenter","mybooks");?>><?php echo anchor("usercenter/mybooks", "我创作的书籍");?></li>
	<li <?php $echoactive("usercenter","mycontrib");?>><?php echo anchor("usercenter/mycontrib", "我参与贡献的书籍");?></li>
	<li <?php $echoactive("usercenter","modrequest");?>><?php echo anchor("usercenter/modrequest", "修改申请");?></li>
	<li class="nav-divider"></li>
	<li <?php $echoactive("usercenter","account");?>><?php echo anchor("usercenter/account", "账户管理");?></li>
	<li><?php echo anchor("usercenter/dologout", "退出");?></li>
</ul>
</div>
</div>
</div>
</div>
