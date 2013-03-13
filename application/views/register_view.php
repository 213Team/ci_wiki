<html>
<body>
<?=form_open('register_controller/add')?>
<table>
	<tr>
		<td><i><?="Username :"?></i></td>
		<td><?=form_input('name')?></td>
	</tr>
	<tr>
		<td><i><?="Password :"?></i></td>
		<td><?=form_password('password')?></td>
	</tr>
	<tr>
		<td><i><?="Email :"?></i></td>
		<td><?=form_input('email')?></td>
	</tr>	
	<tr>
		<td><i><?="Profile :"?></i></td>
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
