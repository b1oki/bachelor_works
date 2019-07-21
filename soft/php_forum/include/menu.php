<?php
@include('../include/_html_google.php'); ?>
<table>
	<tr>
		<td>Меню:</td>
		<td><a href="index.php">Форум</a></td>
		<td><a href="user.php">Юзер</a></td>
		<?php if(mylib_is_auth()) { ?>
		<td><a href="authorization.php?logout=exit">Выйти</a></td>
		<?php } ?>
	</tr>
</table>
