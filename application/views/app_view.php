<html>
<body>
<?=form_open('app_controller/add')?>
<?=form_hidden('eid', $eid)?>
<table>
	<tr>
		<td><i><?="Username :"?></i></td>
		<td><?=form_input('uname')?></td>
	</tr>
	<tr>
		<td><i><?="Details :"?></i></td>
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
