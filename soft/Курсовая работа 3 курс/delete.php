<?php
session_start();
include("./include/sheader.php");
include("./include/nav.php");
?>
<section>
<h3>Модерация — Удаление</h3>
<?php if(empty($_SESSION['login']) or empty($_SESSION['id'])) { ?>
<h3>Страница недоступна</h3>
<p>Привет, гость. <a href='./auth.php'>Вход</a></p>
<?php
} else {
	include("./include/usermenu.php");
	include("./include/connect.php");
	$userid = intval($_SESSION['id']);
	$result = mysql_query("SELECT `position` FROM `users` WHERE `id` = '{$userid}'", $db) or die("Не могу выполнить запрос.");
	$position = mysql_fetch_assoc($result);
	$position = intval($position['position']);
	if($position > 0) {
		if(empty($_POST['what'])) { ?><p>Нет данных!</p><?php }
		elseif($_POST['what'] == 'sms') {
			if(empty($_POST['msgid'])) { ?><p>Недостаточно данных!</p><?php return; }
			else {
				$msgid = intval($_POST['msgid']);
				mysql_query("DELETE FROM `message` WHERE `id`='$msgid'", $db) or die("Не могу выполнить запрос.");
				?><p>Удалено. <a href="./forum.php">На форум!</a></p><?php
			}
		} elseif($_POST['what'] == 'post') {
			if(empty($_POST['postid']) or empty($_POST['themeid'])) { ?><p>Недостаточно данных!</p><?php return; }
			else {
				$theme = intval($_POST['themeid']);
				$post = intval($_POST['postid']);
				mysql_query("DELETE FROM `post` WHERE `id`='$post' AND `theme`='$theme'", $db) or die("Не могу выполнить запрос.");
				$result = mysql_query("SELECT `id` FROM `post` WHERE `theme`='$theme'", $db) or die("Не могу выполнить запрос.");
				if(mysql_num_rows($result) == 0) {
					mysql_query("DELETE FROM `theme` WHERE `id`='$theme'", $db) or die("Не могу выполнить запрос.");
					echo '<p>Это последнее сообщение в теме.</p>';
				} ?>
				<p>Удалено. <a href="./forum.php">На форум!</a></p><?php
			}
		} elseif($_POST['what'] == 'theme') {
			if(empty($_POST['themeid'])) { ?><p>Недостаточно данных!</p><?php return; }
			else {
				$theme = intval($_POST['themeid']);
				mysql_query("DELETE FROM `theme` WHERE `id`='$theme'", $db) or die("Не могу выполнить запрос.");
				mysql_query("DELETE FROM `post` WHERE `theme`='$theme'", $db) or die("Не могу выполнить запрос.");
				echo '<p>Тема удалена. <a href="./forum.php">На форум!</a></p>';
			}
		} elseif($_POST['what'] == 'file') {
			if(empty($_POST['fileid'])) { ?><p>Недостаточно данных!</p><?php return; }
			else {
				$file = intval($_POST['fileid']);
				$result = mysql_query("SELECT `path` FROM `files` WHERE `id`='$file'", $db) or die("Не могу выполнить запрос.");
				$myrow = mysql_fetch_assoc($result);
				if(unlink($myrow['path'])) {
					mysql_query("DELETE FROM `files` WHERE `id`='$file'", $db) or die("Не могу выполнить запрос.");
					echo '<p>Файл удален. <a href="./files.php">К другим файлам!</a></p>';
				} else {
					echo '<p>Ошибка удаления файла.</p>';
				}
			}
		} else { ?><p>Неизвестные данные.</p><?php }
	} else { ?><p>Вы не обладаете необходимыми правами. <a href="./forum.php">На форум!</a></p><?php } } ?>
</section>
</body>
</html>