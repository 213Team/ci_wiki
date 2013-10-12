<script>
function submitFXCK(cid){
	$('#myForm').attr('action', "<?php echo site_url('usercenter/doupdatebody/');?>/"+cid);
	$('#myForm').submit();
}

function submitCheckpoint(cid){
	$('#myForm').attr('action', "<?php echo site_url('usercenter/doupdatebody/');?>/"+cid+"/checkpoint");
	$('#myForm').submit();
}

</script>

<div class="col-md-8" style="margin-top:70px;">
<div class="row">
<div class="col-md-11 col-md-offset-1">
<div class="panel panel-default boxshadow no-radius">

	<div class="panel-heading">
	<div class="col-md-2">
		<strong><?php echo anchor("usercenter/catalog/{$book->id}", "{$book->title}");?></strong>
		</div>
		<div class="input-group col-md-offset-2">
  		<span class="input-group-addon">标题</span>
  		<input id="title" name="title" type="text" class="form-control" value="<?php echo $cata->title;?>" />
	</div>
	</div>
	<?php echo form_open("usercenter/doupdatebody/{$cata->id}",'class="form-horizontal" role="form" id="myForm" name="myForm"')?>	
	
	<div class="panel-body">
	
	<textarea id="body" name="body" class="form-control" rows="20"><?php if($body) echo $body->body;?></textarea>
	</div>
	
	<div class="panel-footer">
     	<button type="button" class="btn btn-primary" onclick="javascript:submitFXCK(<?php echo $cata->id;?>)">保存</button>
     	<button type="button" class="btn btn-default" onclick="javascript:submitCheckpoint(<?php echo $cata->id;?>)">保存并创建历史还原点</button>
	</div>
</form>
</div>
</div>
</div>
</div>
