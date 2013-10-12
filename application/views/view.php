<?php 
include_once 'markdown/Michelf/Markdown.php';
include_once 'markdown/Michelf/MarkdownExtra.php';
use \Michelf\MarkdownExtra;
?>

<div class="container" style="margin-top:30px;">
<div class="row">
<div class="col-md-8">
<?php
if($body)
	echo MarkdownExtra::defaultTransform($body->body);
?>

<div class="panel panel-default boxshadow no-radius"  style="margin-top:70px;">
<table class="table table-hover table-striped">
<?php if(!$comments):?>
	<div class="alert alert-info no-radius">
  			<strong>本节还没有任何评论。</strong>
	</div>
<?php else:?>
	<thead>
		<tr>
			<th>用户名</th>
			<th>评论</th>
			<th>发表时间</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($comments as $row): ?>	
            <tr>
              <td><?php echo $row->username;?></td>
              <td width="60%"><?php echo $row->comment;?> </td>
              <td><?php echo $row->lastmod;?></td>
            </tr>
		<?php endforeach;endif;?>
	</tbody>
</table>
<div class="panel-footer">
	<?php if (isset($tips) && $tips != ''){?>
		<div class="alert alert-danger">
  			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  			<strong><?php echo $tips;?></strong>
		</div>
	<?php }?>
	<?php if($cid != -1){
		echo form_open("books/doaddcomment/{$bookid}/{$cid}",'class="form-inline" role="form"');?>
  		<div class="form-group">
    		<label for="comment" class="sr-only">添加评论</label>
    		<div class="col-sm-10">
      			<input type="text" class="form-control" id="comment" name="comment" placeholder="添加评论">
    		</div>
  		</div>

  		<div class="form-group">
    		<div class="col-sm-offset-2 col-sm-10">
     			<button type="submit" class="btn btn-default">添加</button>
    		</div>
  		</div>
	</form>
	<?php } ?>

</div>
</div>
</div>
</div>

