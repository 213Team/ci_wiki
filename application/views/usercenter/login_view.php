<div class="container" style="margin-top:10px;">
<div class="row">
<div class="col-md-offset-3 col-md-6">
<div class="panel panel-default no-radius boxshadow">
    <div class="panel-heading text-center">登陆 Write in Group</div>
  	<div class="panel-body">
	<?php echo form_open('usercenter/dologin','class="form-horizontal" role="form"');?>
		<div class="form-group">
    		<label for="username" class="col-sm-2 control-label">用户名</label>
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
    		<div class="col-sm-offset-2 col-sm-10">
      			<button type="submit" class="btn btn-default btn-block">登陆</button>
			</div>
  		</div>
	</form>
	</div>
</div>
</div>
</div>
</div>
