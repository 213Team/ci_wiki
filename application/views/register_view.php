<html>
<body>
<?=form_open('register_controller/add')?>
<table>
	<tr>
		<td><strong><?="Username :"?></strong></td>
		<td><?=form_input('name')?></td>
	</tr>
	<tr>
		<td><strong><?="Password :"?></strong></td>
		<td><?=form_password('password')?></td>
	</tr>
	<tr>
		<td><strong><?="Email :"?></strong></td>
		<td><?=form_input('email')?></td>
	</tr>	
	<tr>
		<td><strong><?="Profile :"?></strong></td>
		<td><?=form_textarea('profile')?></td>
	</tr>
	<tr>
		<td></td>
		<td><?=form_submit('submit', 'Submit')?></td>
	</tr>
</table>
</form>
</body>
</html>
