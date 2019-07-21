<?php
session_start();
include("./include/sheader.php");
include("./include/nav.php");
?>
<section>
<?php if(empty($_SESSION['login']) or empty($_SESSION['id'])) { ?>
<h3>Страница недоступна</h3>
<p>Привет, гость. <a href='./auth.php'>Вход</a></p>
<?php
} elseif(empty($_POST['newpassword']) or empty($_POST['oldpassword'])) {
	echo '<h3>Смена пароля</h3>';
	include("./include/usermenu.php");
?>
<form action="./change_password.php" method="post">
<p>Введите старый и новый пароли</p>
<p>Старый пароль: <input type="password" name="oldpassword" size="15" maxlength="15" /></p>
<p>Новый пароль: <input type="password" name="newpassword" size="15" maxlength="15" /></p>
<p><input type="submit" value="Сменить" /></p>
</form>
<?php } else {
	include("./include/connect.php");
	$userid = intval($_SESSION['id']);
	echo '<h3>Смена пароля</h3>';
	include("./include/usermenu.php");
	if(!empty($_POST['oldpassword'])) { $oldpassword = $_POST['oldpassword']; }
	else { ?><p>Вы не ввели старый пароль!</p><?php return; }
	if(!empty($_POST['newpassword'])) {$newpassword = $_POST['newpassword'];}
	else { ?><p>Вы не ввели новый пароль!</p><?php return; }
	if(get_magic_quotes_gpc()==1) {
		$oldpassword=stripslashes(trim($oldpassword));
		$newpassword=stripslashes(trim($newpassword));
	} else {
		$oldpassword=trim($oldpassword);
		$newpassword=trim($newpassword);
	}
	$oldpassword=mysql_real_escape_string($oldpassword);
	$newpassword=mysql_real_escape_string($newpassword);
	include("./include/connect.php");
	$result = mysql_query("SELECT `id`, `password` FROM `users` WHERE `id`='$userid'", $db) or die("Не могу выполнить запрос.");
	$myrow = mysql_fetch_assoc($result);
	$oldpassword = md5($oldpassword);
	$newpassword = md5($newpassword);
	if(empty($myrow['password'])) { ?><p>Извините, введенные вами логин или пароль неверные. empty</p><?php }
	else {
		if($myrow['password'] == $oldpassword) {
			$result = mysql_query("UPDATE `users` SET `password`='$newpassword' WHERE `id`='$userid'", $db) or die("Не могу сменить пароль!");
			if(mysql_affected_rows()) echo '<p>Данные обновлены.</p>';
			echo '<p>Успешная смена пароля! <a href="./forum.php">На форум!</a></p>';
		} else {
			echo '<p>Извините, введенные вами логин или пароль неверные.</p>';
		}
	}
} ?>
</section>
</body>
</html>