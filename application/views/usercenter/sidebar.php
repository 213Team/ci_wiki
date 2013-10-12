<?php
$class = $this->router->class;
$method = $this->router->method;
$ci = &get_instance();
$ci->load->model('pullrequest_model');
$pn = $ci->pullrequest_model->getPullrequestsCount(array('uid'=>$login_user['uid']));
$echoactive = function($controller, $func = "") use ($class, $method){
	if(($controller == $class) && ($func == "" || $func == $method))
		echo 'style="background-color: #efefef"';
}
?>
<div class="col-md-4" style="margin-top:70px;">
<div class="row">
<div class="col-md-offset-3 col-md-8">
<div class="">
<ul class="nav nav-stacked">
	<li <?php $echoactive("usercenter","dashboard");?>><?php echo anchor("usercenter", "用户首页");?></li>
	<li <?php $echoactive("usercenter","mybooks");?>><?php echo anchor("usercenter/mybooks", "我创作的书籍");?></li>
	<li <?php $echoactive("usercenter","mycontrib");?>><?php echo anchor("usercenter/mycontrib", "我参与贡献的书籍");?></li>
	<li <?php $echoactive("usercenter","pullrequest");?>><a href="<?php echo site_url('usercenter/pullrequest')?>"><span class="badge pull-right"><?php echo $pn;?></span>修改申请</a></li>
	<li class="nav-divider"></li>
	<li <?php $echoactive("usercenter","account");?>><?php echo anchor("usercenter/account", "账户管理");?></li>
	<li><?php echo anchor("usercenter/dologout", "退出");?></li>
</ul>
</div>
</div>
</div>
</div>
