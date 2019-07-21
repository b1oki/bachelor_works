<?php
session_start();
require_once('include/library.php');
mylib_connect_DB();
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<script src="include/script.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="include/style.css" />
	<title>Авторизация</title>
</head>
<body>
<?php include("include/menu.php"); ?>
<h3>Авторизация</h3>
<?php
if(!mylib_is_auth()) {
	if(isset($_POST['let']) and $_POST['let'] == "log") {
		$login = save_string($_POST['user']);
		$password = md5($_POST['pswd']);
		$result = @mysql_query("SELECT `id` FROM `users` WHERE `login` = '$login' AND `password` = '$password'", $db);
		if(@mysql_num_rows($result) > 0) {
			$row = @mysql_fetch_assoc($result);
			$_SESSION['id'] = intval($row['id']);
			echo '<p>Вы авторизованы, ' . mylib_get_user_login($_SESSION['id']) . '. На <a href="index.php">форум</a>.</p>';
		} else {
			echo '<p>Вы не зарегистрированы. На <a href="index.php">форум</a> или <a href="authorization.php">попробовать ещё</a>.</p>';
		}
	} else { ?>
<form method="post">
	<input type="text" name="let" hidden value="log"/>
	<p>Логин: <input type="text" name="user" require /></p>
	<p>Пароль: <input type="password" name="pswd" require /></p>
	<p><input type="submit"/></p>
</form>
<h3><a href="registration.php">Регистрация</a></h3>
<?php
	}
} else {
	if(isset($_GET['logout'])) {
		session_unset();
		session_destroy();
		echo "<p>Возвращайся!</p>";
	} else {
		echo '<p>Вы авторизованы, ' . mylib_get_user_login($_SESSION['id']) . '. На <a href="index.php">форум</a>. Или <a href="authorization.php?logout=exit">выйти из аккаунта</a></p>';
	}
}
?>
</body>
</html>