<html>
<body>
<?php foreach($query as $item):?>
	<h2><?=$item->subject?></h2><br />
<i>
	<?="Last modified on "?>
	<?=date("D jS F Y g.iA", strtotime($item->time))?>
</i>
<?php if($login_user and $login_user != 'wind'):?>
<?php if(!$author):?>
<strong><?=anchor('app_controller/index/' . $item->id, ' [want to edit]')?></strong>
<?php elseif($author == $login_user):?>
<strong><?=anchor('edit_controller/index/' . $item->id, ' [edit]')?></strong>
<?php endif;?>
<?php endif;?>

<p>
	<i><?=nl2br($item->body)?></i>
</p>

<h3><?="Comments:"?></h3>
<?php $i = 1;?>
<p>
<ul>
<?php if(!$c_query):?>
<i><?="No comments!"?></i>
<?php endif;?>

<?php foreach($c_query as $c_item):?>
<li>
<i>
	<?="Comment#$i: by "?><strong><?=$c_item->uname?></strong><?=" on "?>
	<?=date("D jS F Y g.iA", strtotime($c_item->time))?>
<p>
	<?=nl2br($c_item->body)?>
</p>
</i>
</li>
<?php $i++;?>
<?php endforeach;?>
</ul>
</p>

<?php if($login_user):?>
<h3><?="Leave a comment?"?></h3>
<p>
<?=form_open('comment_controller')?>
<?=form_hidden('eid', $item->id)?>
<table>
	<tr>
		<td><i><?="Username :"?></i></td>
		<td><?=form_input('uname')?></td>
	</tr>
	<tr>
		<td><i><?="Comments :"?></i></td>
		<td><?=form_textarea('body')?></td>
	</tr>
	<tr>
		<td></td>
		<td><?=form_submit('submit', 'Submit')?></td>
	</tr>
</table>
</form>
</p>
<?php endif;?>
<?php endforeach;?>
</body>
</html>
