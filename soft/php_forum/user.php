<?php
session_start();
require_once('include/library.php');
mylib_connect_DB();
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="include/style.css" />
	<title>Форум</title>
</head>
<body>
<?php
if(mylib_is_auth(true)) {
	if(isset($_GET['id'])) {
			$user = intval($_GET['id']);
		} else {
			$user = intval($_SESSION['id']);
		}
		$isOwner = ($_SESSION['id'] == $user) ? true : false;
		$info = mylib_get_user_info($user);
		include('include/menu.php'); ?>
<h3>Форум - Пользователь <?php echo save_string($info['login']); ?></h3>
<?php

	if(isset($_POST['let']) and $_POST['let'] == "change") {
		if(empty($_POST['val'])) {
			echo '<p>Нет данных.</p>';
		} else {
			if($_POST['what'] == "name") {
				$value = save_string($_POST['val']);
				$result = mysql_query("UPDATE `users` SET `name`='$value' WHERE `id`='$user'", $db);
				if(mysql_affected_rows($db)) {
					echo '<p>Данные о имени обновлены.</p>';
				}
			} elseif ($_POST['what'] == "email") {
				$value = save_string($_POST['val']);
				$result = mysql_query("UPDATE `users` SET `email`='$value' WHERE `id`='$user'", $db);
				if(mysql_affected_rows($db)) {
					echo '<p>Данные о почте обновлены.</p>';
				}
			} elseif ($_POST['what'] == "birth") {
				$value = save_string($_POST['val']);
				$result = mysql_query("UPDATE `users` SET `birthday`='$value' WHERE `id`='$user'", $db);
				if(mysql_affected_rows($db)) {
					echo '<p>Данные о дате рождения обновлены.</p>';
				}
			} else {
				echo '<p>Нет данных.</p>';
			}
		}
	} else {		
?>
<p>
	<table>
		<tr>
			<th>Имя</th>
			<td><?php echo save_string($info['name']); ?></td>
		</tr>
		<tr>
			<th>Дата рождения</th>
			<td><?php echo save_string($info['birthday']); ?></td>
		</tr>
		<tr>
			<th>Почта</th>
			<td><?php echo save_string($info['email']); ?></td>
		</tr>
	</table>
</p>
<?php if($isOwner) { ?>
	<h3>Изменить данные</h3>
	<form method="post">
		<input type="text" name="let" hidden value="change"/>
		<p>
			Что:<br>
			<select name="what" id="what" require onChange="
			var val = document.getElementById('val');
			var what = document.getElementById('what').value;
			switch(what) {
				case 'name':
				val.value='<?php echo save_string($info['name']);?>';
				break
				case 'birth':
				val.value='<?php echo save_string($info['birthday']);?>';
				break
				case 'email':
				val.value='<?php echo save_string($info['email']);?>';
				break
			}">
				<option value="name">Имя</option>
				<option value="birth">Дата рождения</option>
				<option value="email">E-mail</option>
			</select>
		</p>
		<p>
			Значение:
			<input type="text" name="val" id="val" require />
		</p>
		<p><input type="submit"/></p>
	</form>
<?php }
	}
} else {
	include('include/menu.php');
	echo '<p>Сейчас вам недоступна эта страница.</p>';
} ?>
</body>
</html>