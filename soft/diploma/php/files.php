<?php
session_start();
include("./include/jsheader.php");
include("./include/nav.php");
?>
<section>
<h3>Файлы</h3>
<?php
if(empty($_SESSION['login']) or empty($_SESSION['id'])) { ?>
<h3>Страница недоступна</h3>
<p>Привет, гость. <a href="./auth.php">Вход</a></p>
<?php
} else {
if(empty($_FILES['userfile'])) {
	include("./include/usermenu.php");
	include("./include/connect.php");
	$userid = intval($_SESSION['id']);
	$result = mysql_query("SELECT `position` FROM `users` WHERE `id` = '{$userid}'", $db) or die("Не могу выполнить запрос.");
	$position = mysql_fetch_assoc($result);
	$result = mysql_query("SELECT `id`, `name`, `path`, `author`, DATE_FORMAT(`send`, '%H:%i %d.%m.%Y') as uploaded FROM `files` ORDER BY `send`", $db) or die("Не могу выполнить запрос.");
	if(mysql_num_rows($result) > 0) {
		include("./include/linktouser.php");
?>
<table>
	<tr>
		<th>Файл</th>
		<th>Закачен</th>
		<th>Автор</th>
		<?php if($position > 0) echo '<th>Удалить</th>'; ?>
	</tr>
<?php while($myrows = mysql_fetch_assoc($result)) { ?>
	<tr>
		<td>
		<a href="<?php echo htmlspecialchars($myrows['path']); ?>" target="_blank"><?php echo htmlspecialchars($myrows['name']); ?></a>
		</td>
		<td><?php echo htmlspecialchars($myrows['uploaded']); ?></td>
		<td><?php echo linktouser($myrows['author']); ?></td>
		<?php if($position > 0) echo '<td><form action="./delete.php" method="post"><input type="text" value="'. $myrows['id'] . '" name="fileid" hidden><input type="text" value="file" name="what" hidden><input type="submit" value="Удалить"></form></td>'; ?>
	</tr>
<?php } ?>
</table>
<?php } ?>
<div class='spoiler'>
	<a class='spoiler-head' href='#'>Добавить файл</a>
	<div class='spoiler-body'>
		<form enctype="multipart/form-data" action="./files.php" method="POST">
		<input type="hidden" name="MAX_FILE_SIZE" value="30000000" />
		Отправить этот файл: <input name="userfile" type="file" />
		<input type="submit" value="Загрузить" />
		</form>
	</div>
	<div class='clear'></div>
	</div>
<?php } else {
	include("./include/usermenu.php");
	$uploaddir = './files/';
	$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
	if($_FILES['userfile']['size'] <= 30000000) {
		if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
			$userid = intval($_SESSION['id']);
			include("./include/connect.php");
			mysql_query("INSERT INTO `files` (`name`, `path`, `author`) VALUES ('{$_FILES['userfile']['name']}', '{$uploadfile}', '{$userid}')", $db) or die("Не могу выполнить запрос.");
			if(mysql_affected_rows($db) > 0) {
				echo '<p>Файл корректен и был успешно загружен.</p>';
			} else {
				echo '<p>Файл в порядке, но проблемы с БД.</p>';
			}
		} else {
			echo '<p>Невозможно загрузить файл.</p>';
		}
	} else {
		echo '<p>Превышен лимит в 30 Мб.</p>';
	}
} } ?>
</section>
</body>
</html>