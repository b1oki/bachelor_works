<?php
session_start();
include("./include/jsheader.php");
include("./include/nav.php");
?>
<section>
<?php
if(empty($_SESSION['login']) or empty($_SESSION['id'])) { ?>
<h3>Страница недоступна</h3>
<p>Привет, гость. <a href='.\auth.php'>Вход</a></p>
<?php
} else {
	if(!empty($_GET['theme'])) {
		$themeid = intval($_GET['theme']);
		include("./include/connect.php");
		$userid = intval($_SESSION['id']);
		$result = mysql_query("SELECT `position` FROM `users` WHERE `id` = '{$userid}'", $db) or die("Не могу выполнить запрос.");
		$position = mysql_fetch_assoc($result);
		$position = intval($position['position']);
		$result = mysql_query("SELECT `title` FROM `theme` WHERE `id` = '{$themeid}'", $db) or die("Не могу выполнить запрос.");
		$theme = mysql_fetch_assoc($result);
?>
<h3>Тема &laquo;<?php echo htmlspecialchars($theme['title']); ?>&raquo;</h3>
<?php
		include("./include/usermenu.php");
		$result = mysql_query("SELECT `id`, `message`, DATE_FORMAT(`send`, '%H:%i %d.%m.%Y') as send, `author` FROM `post` WHERE `theme` = '{$themeid}' ORDER BY `send`", $db) or die("Не могу выполнить запрос.");
		if(mysql_num_rows($result)) {
			include("./include/linktouser.php");
?>
<table class="forum">
	<tr>
		<th>Сообщение</th>
		<th>Отправлено</th>
		<th>Автор</th>
		<?php if($position > 0) echo '<th>Удалить</th>'; ?>
	</tr>
<?php while($post = mysql_fetch_assoc($result)) { ?>
<tr>
	<td class="msg"><?php echo htmlspecialchars($post['message']); ?></td>
	<td><?php echo htmlspecialchars($post['send']); ?></td>
	<td><?php echo linktouser($post['author']); ?></td>
	<?php if($position > 0) echo '<td><form action="./delete.php" method="post"><input type="text" value="'. $themeid . '" name="themeid" hidden><input type="text" value="'. $post['id'] . '" name="postid" hidden><input type="text" value="post" name="what" hidden><input type="submit" value="Удалить"></form></td>'; ?>
	</tr>
<?php } ?>
</table>
<?php } ?>
<div class='spoiler'>
<a class='spoiler-head' href='#'>Написать сообщение</a>
<div class='spoiler-body'>
	<form action='writepost.php' method='post'>
		<textarea name='message' placeholder='Сообщение' cols='30' rows='4' required></textarea><br>
		<input type='hidden' name='theme' value='<?php echo htmlspecialchars($themeid); ?>' />
		<input type='submit' value='Отправить сообщение' />
	</form>
</div>
<div class='clear'></div>
</div>
<?php } else { ?>
<h3>Тема не найдена</h3>
<p><a href='./forum.php'>Поищите другую</a></p>
<?php } } ?>
</section>
</body>
</html>