<?php
require_once 'diff/htmldiff.php';
?>
<style type="text/css">
      .diffdel {color:#aa0000;}
      .diffins {color:#00aa00;}
      .diffmod {color:#bbbb00;}
</style>
<script>
$(function(){
	$("#left").css("height", $("#right").height());
})

function doacpr(pid){
	$('#myForm').attr('action', "<?php echo site_url('usercenter/doacpr/');?>/"+pid);
	$('#myForm').submit();
}

function dodcpr(pid){
	$('#myForm').attr('action', "<?php echo site_url('usercenter/dodcpr/');?>/"+pid);
	$('#myForm').submit();
}

function pending(){
	window.location="<?php echo site_url('usercenter/pullrequest');?>"
}
</script>
<div class="col-md-8" style="margin-top:70px;">
<div class="row">
<div class="col-md-11 col-md-offset-1">
<div class="panel panel-default boxshadow no-radius">

	<div class="panel-heading">
	<div class="col-md-2">
		<strong><?php echo $pullrequest->btitle;?></strong>
		</div>
		<div class="col-md-offset-2">
  		<span>章节标题：</span>
  		<span><?php echo $pullrequest->ctitle;?></span>
	</div>
	</div>
	<?php echo form_open("usercenter/doacpr/{$pullrequest->pid}",'class="form-horizontal" role="form" id="myForm" name="myForm"')?>	
	
	<div class="panel-body">
	<div class="row">
		<div class="col-md-6" style="overflow-y:scroll;" id="left", name="left">
		<p>
	<?php if (!$body) $body = ""; else $body = $body->body;
	
	$htmldiff = new HtmlDiff($body, $pullrequest->newbody);
	echo str_replace("\n", "</br>", $htmldiff->build());
	?>
	</p>
		</div>
		<div class="col-md-offset-6" id="right", name="right">
		<textarea class="form-control" style="width:100%;" rows="20" id="body" name="body"><?php echo $body;?></textarea>
		<button type="button" class="btn btn-primary" onclick="javascript:doacpr(<?php echo $pullrequest->pid;?>)">接受并保存修改</button>
		<button type="button" class="btn btn-danger" onclick="javascript:dodcpr(<?php echo $pullrequest->pid;?>)">忽略此申请</button>
		<button type="button" class="btn btn-info" onclick="javascript:pending()">以后再说</button>
		</div>
	</div>
	</div>
	
	<div class="panel-footer">
	</div>
	
</form>	
	
</div>
</div>
</div>
</div>
