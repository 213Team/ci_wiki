<div class="container" style="margin-top:10px;">
<div class="row">
<div class="col-md-offset-3 col-md-6">
<div class="panel panel-default no-radius boxshadow">
    <div class="panel-heading text-center"><strong>注册 Write in Group</strong></div>
  	<div class="panel-body">
	<?php echo form_open('usercenter/doregister', 'class="form-horizontal" role="form"');
		if (isset($tips) && $tips != ''){?>
		<div class="alert alert-danger">
  			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  			<strong><?php echo $tips;?></strong>
		</div>
		<?php }?>
		<div class="form-group">
    		<label for="name" class="col-sm-2 control-label">用户名</label>
    		<div class="col-sm-10">
    		<input type="text" class="form-control" id="username" name="username" placeholder="Username">
    		</div>
  		</div>
		<div class="form-group">
    		<label for="password" class="col-sm-2 control-label">密码</label>
    		<div class="col-sm-10">
    		<input type="password" class="form-control" id="password" name="password" placeholder="Password">
    		</div>
  		</div>
  		<div class="form-group">
    		<label for="password2" class="col-sm-2 control-label">确认密码</label>
    		<div class="col-sm-10">
    		<input type="password" class="form-control" id="password2" name="password2" placeholder="Password Again">
    		</div>
  		</div>
  		<div class="form-group">
    		<label for="email" class="col-sm-2 control-label">Email</label>
    		<div class="col-sm-10">
    		<input type="email" class="form-control" id="email" name="email" placeholder="Email">
    		</div>
  		</div>
  		 <div class="form-group">
    		<label for="profile" class="col-sm-2 control-label">Profile</label>
    		<div class="col-sm-10">
    		<textarea class="form-control" rows="5" name="profile" id="profile"></textarea>
    		</div>
  		</div>
  		<div class="form-group">
    		<label for="captcha" class="col-sm-2 control-label">验证码</label>
    		<div class="col-sm-6">
    		<input type="text" class="form-control" id="captcha" name="captcha" placeholder="Captcha">
    		</div>
    		<img src="<?php echo base_url();?>index.php/captcha" class="img-thumbnail" />
  		</div>		
		<div class="form-group">
    		<div class="col-sm-offset-2 col-sm-10">
      			<button type="submit" class="btn btn-default btn-block">注册</button>
			</div>
  		</div>
	</form>
	</div>
</div>
</div>
</div>
</div>
