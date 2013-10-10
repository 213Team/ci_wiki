<div class="container" style="margin-top:30px;">
<div class="row">
<div class="col-md-8">
<?php echo form_open("books/dopullrequest/{$bookid}/{$cid}",'class="form-horizontal" role="form"');?>
		<div class="form-group">
    		<textarea class="form-control" rows="25" name="body" id="body"><?php if($body) echo $body->body;?></textarea>
  		</div>
  		<div class="form-group">
    		<div class="col-sm-offset-2 col-sm-10">
      			<button type="submit" class="btn btn-primary">保存</button>
			</div>
  		</div>
</div>
</div>
</div>
