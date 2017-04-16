<?php
session_start();
include("./include/sheader.php");
include("./include/nav.php");
?>
<section>
<h3>Создание темы</h3>
<?php
if(empty($_SESSION['login']) or empty($_SESSION['id'])) { ?>
<h3>Страница недоступна</h3>
<p>Привет, гость. <a href='./auth.php'>Вход</a></p>
<?php }
else {
	include("./include/usermenu.php");
	if (empty($_POST['message']) or empty($_POST['title'])) { ?>
<p>Вы не ввели данные. <a href='./forum.php'>На форум.</a></p>
	<?php return; }
	if(get_magic_quotes_gpc()==1) {
		$message=stripslashes(trim($_POST["message"]));
		$title=stripslashes(trim($_POST["title"]));
	} else {
		$message=trim($_POST["message"]);
		$title=trim($_POST["title"]);
	}
	$message=mysql_real_escape_string($message);
	$title=mysql_real_escape_string($title);
	include("./include/connect.php");
	$result = mysql_query("INSERT INTO theme (title, author) VALUES ('{$title}', '{$_SESSION['id']}')", $db) or die("Не могу выполнить запрос.");
	$themeId = intval(mysql_insert_id($db));
	if($result) {
		$result = mysql_query("INSERT INTO post (message, author, theme) VALUES ('{$message}', '{$_SESSION['id']}', '{$themeId}')", $db) or die("Не могу выполнить запрос.");
		if(mysql_affected_rows($db) > 0) {
?>
<p>Сообщение успешно добавлено. <a href='post.php?theme=<?php echo htmlspecialchars($themeId); ?>' target='_top'>Просмотреть тему</a>.</p>
<?php } else { ?>
<p>
Произошла ошибка, попробуйте потом. <a href='./post.php?theme=<?php echo htmlspecialchars($themeId); ?>' target='_top'>Просмотреть тему</a><br>
Вот ваше сообщение на тему "<?php echo htmlspecialchars($title); ?>":<br>
<?php echo htmlspecialchars($message); ?>
</p>
<?php } } else { ?>
<p>Произошла ошибка, попробуйте потом. <a href='./forum.php' target='_top'>Назад</a><br>
Вот ваше сообщение на тему "<?php echo htmlspecialchars($title); ?>":<br>
<?php echo htmlspecialchars($message); ?></p>
<?php } } ?>
</section>
</body>
</html>