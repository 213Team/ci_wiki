<html>
<body>
<?php foreach($query as $item):?>
	<?=form_open('edit_controller/update')?>
	<?=form_hidden('id', $item->id)?>
<table>
	<tr>
		<td><strong><?="Subject :"?></strong></td>
		<td><?=form_input('subject', $item->subject)?></td>
	</tr>
	<tr>
		<td><strong><?="Body :"?></strong></td>
		<td><?=form_textarea('body', $item->body)?></td>
	</tr>
	<tr>
		<td></td>
		<td><?=form_submit('submit', 'Submit')?></td>
	</tr>
</table>
</form>
<?php endforeach;?>
</body>
</html>
