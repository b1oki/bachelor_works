<?php
session_start();
include("./include/sheader.php");
include("./include/nav.php");
?>
<section>
<h3>Отправка сообщения</h3>
<?php if(empty($_SESSION['login']) or empty($_SESSION['id'])) { ?>
<h3>Страница недоступна</h3>
<p>Привет, гость. <a href='./auth.php'>Вход</a></p>
<?php
} else {
	include("./include/usermenu.php");
	if (empty($_POST['message']) or empty($_POST['reciver'])) {
		echo '<p>Вы не ввели сообщение.</p>';
		return;
	}
	$reciver = intval($_POST['reciver']);
	$message = $_POST['message'];
	$message = htmlspecialchars($message);
	$message = mysql_real_escape_string($message);
	$message = trim($message);
	include("./include/connect.php");
	$result = mysql_query("INSERT INTO `message` (`message`, `from`, `to`) VALUES ('{$message}', '{$_SESSION['id']}', '{$reciver}')", $db) or die("Не могу выполнить запрос.");
	if(mysql_affected_rows($db) > 0) {
		echo "<p>Сообщение успешно добавлено. <a href='./message.php' target='_top'>Просмотреть</a></p>";
	} else {
		echo '<p>Произошла ошибка, попробуйте потом. ';
		echo "<a href='./message.php' target='_top'>Назад</a>";
		echo '<br>Вот ваше сообщение:<br>' . $message . '</p>';
	}
} ?>
</section>
</body>
</html>