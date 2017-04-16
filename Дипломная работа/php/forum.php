<?php
session_start();
include("./include/jsheader.php");
include("./include/nav.php");
?>
<section>
<h3>Форум</h3>
<?php
if(empty($_SESSION['login']) or empty($_SESSION['id'])) { ?>
<h3>Страница недоступна</h3>
<p>Привет, гость. <a href="./auth.php">Вход</a></p>
<?php
} else {
	include("./include/usermenu.php");
	include("./include/connect.php");
	$userid = intval($_SESSION['id']);
	$result = mysql_query("SELECT `position` FROM `users` WHERE `id` = '{$userid}'", $db) or die("Не могу выполнить запрос.");
	$position = mysql_fetch_assoc($result);
	$result = mysql_query("SELECT theme.id as themeId, theme.title, theme.author as themeAuthor, DATE_FORMAT(theme.send, '%H:%i %d.%m.%Y') as updated FROM theme", $db) or die("Не могу выполнить запрос.");
	if(mysql_num_rows($result) > 0) {
		include("./include/linktouser.php");
?>
<table class="forum">
	<tr>
		<th>Тема</th>
		<th>Обновлено</th>
		<th>Автор</th>
		<?php if($position > 0) echo '<th>Удалить</th>'; ?>
	</tr>
<?php while($themes = mysql_fetch_assoc($result)) { ?>
	<tr>
		<td class="msg">
		<a href="post.php?theme=<?php echo htmlspecialchars($themes['themeId']); ?>" target="_top"><?php echo htmlspecialchars($themes['title']); ?></a>
		</td>
		<td><?php echo htmlspecialchars($themes['updated']); ?></td>
		<td><?php echo linktouser($themes['themeAuthor']); ?></td>
		<?php if($position > 0) echo '<td><form action="./delete.php" method="post"><input type="text" value="'. $themes['themeId'] . '" name="themeid" hidden><input type="text" value="theme" name="what" hidden><input type="submit" value="Удалить"></form></td>'; ?>
	</tr>
<?php } ?>
</table>
<?php } ?>
<div class='spoiler'>
	<a class='spoiler-head' href='#'>Создать тему</a>
	<div class='spoiler-body'>
		<form action='./addtheme.php' method='post'>
			<input name='title' type='text' maxlength='30' placeholder='Заголовок' required /><br>
			<textarea name='message' placeholder='Сообщение' cols='30' rows='4' required></textarea><br>
			<input type='submit' value='Добавить тему' />
		</form>
	</div>
	<div class='clear'></div>
	</div>
<?php } ?>
</section>
</body>
</html>