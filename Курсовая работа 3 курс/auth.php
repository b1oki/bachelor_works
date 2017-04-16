<?php
session_start();
include("./include/sheader.php");
include("./include/nav.php");
?>
<section>
<h3>Форум - авторизация</h3>
<?php
if(empty($_SESSION['login']) or empty($_SESSION['id'])) {
	if(empty($_GET['what'])):
?>
<div class="auth">
	<form action="./auth.php?what=login" method="post">
	<span><p>Авторизация</p></span>
	<p>Логин: <input type="text" name="login" size="20" maxlength="20" /></p>
	<p>Пароль: <input type="password" name="password" size="20" maxlength="15" /></p>
	<span><p><input type="submit" value="Войти" name="log_in" /></p></span>
	</form>
	<br />
	<form action="./auth.php?what=registration" method="post">
	<span><p>Регистрация</p></span>
	<p>Логин: <input type="text" name="login" size="20" maxlength="20"/></p>
	<p>Пароль: <input type="password" name="password" size="20" maxlength="15" /></p>
	<span><p><input type="submit" value="Зарегистрироваться" name="log_in" /></p></span>
	</form>
</div>
<?php
	elseif($_GET['what']=="login"):
		if(empty($_POST['login']) or empty($_POST['password'])) { ?>
<p>Вы не ввели данные. <a href='./forum.php'>На форум.</a></p>
<?php return; }
		$login = $_POST['login'];
		$password = $_POST['password'];
		if(get_magic_quotes_gpc()==1) {
			$login=stripslashes(trim($login));
			$password=stripslashes(trim($password));
		} else {
			$login=trim($login);
			$password=trim($password);
		}
		$login=mysql_real_escape_string($login);
		$password=mysql_real_escape_string($password);
		include("./include/connect.php");
		$result = mysql_query("SELECT * FROM users WHERE login='$login'", $db) or die("Не могу выполнить запрос.");
		$myrow = mysql_fetch_assoc($result);
		if(empty($myrow['password'])) { ?>
<p>Извините, введенные вами логин или пароль неверные. <a href="./auth.php">Еще раз!</a></p>
<?php } else {
			if($myrow['password'] == md5($password)) {
				$_SESSION['login'] = $myrow['login'];
				$_SESSION['id'] = $myrow['id'];
				echo '<p>Успешная авторизация! <a href="./forum.php">На форум!</a></p>';
			} else {
				echo '<p>Извините, введенные вами логин или пароль неверные. <a href="./auth.php">Еще раз!</a></p>';
			}
		}
	elseif($_GET['what']=="registration"):
/*	echo '<p>Регистрация отключена. <a href="./auth.php">Авторизоваться.</a> </p>';
/* */
		if(empty($_POST['login']) or empty($_POST['password'])) { ?>
<p>Вы не ввели данные. <a href='./forum.php'>На форум.</a></p>
<?php return; }
		$login = $_POST['login'];
		$password = $_POST['password'];
		if(get_magic_quotes_gpc()==1) {
			$login=stripslashes(trim($login));
			$password=stripslashes(trim($password));
		} else {
			$login=trim($login);
			$password=trim($password);
		}
		$login=mysql_real_escape_string($login);
		$password=mysql_real_escape_string($password);
		include("./include/connect.php");
		$result = mysql_query("SELECT * FROM `users` WHERE `login`='$login'", $db) or die("Не могу выполнить запрос.");
		$myrow = mysql_fetch_assoc($result);
		if(empty($myrow['password'])) {
			$password = md5($password);
			$result = mysql_query("INSERT INTO `users` (login, password) VALUES ('{$login}', '{$password}')", $db) or die("Не могу выполнить запрос.");
			if(mysql_affected_rows($db) > 0) {
				$_SESSION['login'] = $login;
				$_SESSION['id'] = intval(mysql_insert_id($db));;
				echo '<p>Успешная регистрация! <a href="forum.php">На форум!</a></p>';
			} else {
				echo '<p>Ошибка. <a href="./auth.php">Еще раз!</a></p>';
			}
		} else { ?>
<p>Этот логин занят. <a href="./auth.php">Еще раз!</a></p>
<?php }
//*/
	endif;
} else {
	if($_GET['what']=='logout') {
		unset($_SESSION['login']);
		unset($_SESSION['id']);
		session_destroy();
		echo '<p>До свидания! <a href="http://google.ru">Уйти.</a></p>';
	} else {?>
<p>Вы уже авторизованы. <a href="forum.php">На форум!</a></p>
<?php } } ?>
</section>
</body>
</html>