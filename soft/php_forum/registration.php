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
<h3>Регистрация</h3>
<?php
if(!mylib_is_auth()) {
	if(isset($_POST['let']) and $_POST['let'] == "reg") {
		if(empty($_POST['user']) or empty($_POST['pswd'])) {
			echo '<p>Не заполнены все поля! <a href="registration.php">Заново</a>.</p>';
		} else {
			$login = save_string($_POST['user']);
			$password = md5($_POST['pswd']);
			$result = @mysql_query("SELECT `password` FROM `users` WHERE `login` = '$login'", $db);
			$myrow = mysql_fetch_assoc($result);
			if(empty($myrow['password'])) {
				$result = mysql_query("INSERT INTO `users` (`login`, `password`) VALUES ('{$login}', '{$password}')", $db) or die("Не могу выполнить запрос.");
				if(mysql_affected_rows($db) > 0) {
					$_SESSION['id'] = intval(mysql_insert_id($db));
					echo '<p>Успешная регистрация! На <a href="index.php">форум</a>.</p>';
				} else {
					'<p>Мы в чем-то ошиблись. <a href="registration.php">Заново</a>.</p>';
				}
			} else {
				echo '<p>Попробуйте другой логин, этот уже занят. <a href="registration.php">Заново</a>.</p>';
			}
		}
	} else { ?>
	<form method="post">
		<input type="text" name="let" hidden value="reg"/>
		<p>Логин: <input type="text" name="user" require /></p>
		<p>Пароль: <input type="password" name="pswd" require /></p>
		<p><input type="submit"/></p>
	</form>
	<?php }
} else {
	echo '<p>Вы авторизованы, ' . mylib_get_user_login($_SESSION['id']) . '. На <a href="index.php">форум</a>. Или <a href="authorization.php?logout=exit">выйти из аккаунта</a></p>';
}
?>
</body>
</html>