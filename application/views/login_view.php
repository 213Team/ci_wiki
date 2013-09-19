<i><?=$tips?></i><br />
<?php echo form_open('usercenter/dologin');?>
<table>
	<tr>
		<td><i><?="Username :"?></i></td>
		<td><?=form_input('username')?></td>
	</tr>
	<tr>
		<td><i><?="Password :"?></i></td>
		<td><?=form_password('password')?></td>
	</tr>
	<tr>
		<td></td>
		<td><?=form_submit('submit', 'Login')?></td>
	</tr>
</table>
</form>
