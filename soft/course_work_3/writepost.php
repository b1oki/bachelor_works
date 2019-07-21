<?php
session_start();
include("./include/sheader.php");
include("./include/nav.php");
?>
<section>
<h3>Добавление сообщения</h3>
<?php if(empty($_SESSION['login']) or empty($_SESSION['id'])) { ?>
<h3>Страница недоступна</h3>
<p>Привет, гость. <a href='.\auth.php'>Вход</a></p>
<?php
} else {
	include("./include/usermenu.php");
	if (!empty($_POST['message'])) $message = $_POST['message'];
	if (!empty($_POST['theme'])) $themeId = intval($_POST['theme']);
	if(isset($message, $themeId)) {
		if(get_magic_quotes_gpc()==1) {
			$message=stripslashes(trim($message));
		} else {
			$message=trim($message);
		}
		$message=mysql_real_escape_string($message);
		include("./include/connect.php");
		$result = mysql_query("UPDATE `theme` SET `send`=NOW() WHERE `id`='$themeId'", $db) or die("Не могу выполнить запрос.");
		$result = mysql_query("INSERT INTO `post` (`message`, `author`, `theme`) VALUES ('{$message}', '{$_SESSION['id']}', '{$themeId}')", $db) or die("Не могу выполнить запрос.");
		if(mysql_affected_rows($db) > 0) {
?>
<p>
Сообщение успешно добавлено. <a href='post.php?theme=<?php echo htmlspecialchars($themeId); ?>' target='_top'>Просмотреть тему</a>
</p>
<?php } else { ?>
<p>
Произошла ошибка, попробуйте потом. <a href='post.php?theme=<?php echo htmlspecialchars($themeId); ?>' target='_top'>Просмотреть тему</a><br>
Вот ваше сообщение:<br>
<?php echo htmlspecialchars($message); ?>
</p>
<?php } } else { ?>
<p>Вы не ввели сообщение.</p>
<?php } } ?>
</section>
</body>
</html>