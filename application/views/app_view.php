<html>
<body>
<?=form_open('app_controller/add')?>
<?=form_hidden('eid', $eid)?>
<table>
	<tr>
		<td><strong><?="Username :"?></strong></td>
		<td><?=form_input('uname')?></td>
	</tr>
	<tr>
		<td><strong><?="Details :"?></strong></td>
		<td><?=form_textarea('details')?></td>
	</tr>
	<tr>
		<td></td>
		<td><?=form_submit('submit', 'Submit')?></td>
	</tr>
</table>
</form>
</body>
</html>
