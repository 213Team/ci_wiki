<html>
<body>
<i><?=$tips?></i><br />
<?=form_open('login_controller/login')?>
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
		<td></td>
		<td><?=form_submit('submit', 'Login')?></td>
	</tr>
</table>
</form>
</body>
</html>
