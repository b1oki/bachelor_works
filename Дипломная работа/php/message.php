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
<p>Привет, гость. <a href='.\auth.php'>Вход</a></p>
<?php
} else {
	include("./include/usermenu.php");
	$userid = intval($_SESSION['id']);
	include("./include/connect.php");
	$result = mysql_query("SELECT `position` FROM `users` WHERE `id` = '{$userid}'", $db) or die("Не могу выполнить запрос.");
	$position = mysql_fetch_assoc($result);
	$position = intval($position['position']);
	$result = mysql_query("SELECT `id`, `message`, `from`, `to`, DATE_FORMAT(`send`, '%H:%i %d.%m.%Y') as sendtime FROM `message` WHERE `from` = '{$userid}' OR `to` = '{$userid}' ORDER BY `send` DESC", $db) or die("Не могу выполнить запрос.");
	if(mysql_num_rows($result) > 0) {
		include("./include/linktouser.php");
?>
<table class="forum">
	<tr>
		<th>Сообщение</th>
		<th>Отправлено</th>
		<th>Автор</th>
		<th>Получатель</th>
		<?php if($position > 10) echo '<th>Удалить</th>'; ?>
	</tr>
<?php while($msg = mysql_fetch_assoc($result)) { ?>
	<tr>
		<td class="msg"><?php echo htmlspecialchars($msg['message']); ?></td>
		<td><?php echo htmlspecialchars($msg['sendtime']); ?></td>
		<td><?php echo linktouser($msg['from']); ?></td>
		<td><?php echo linktouser($msg['to']); ?></td>
		<?php if($position > 10) echo '<td><form action="./delete.php" method="post"><input type="text" value="'. $msg['id'] . '" name="msgid" hidden><input type="text" value="sms" name="what" hidden><input type="submit" value="Удалить"></form></td>'; ?>
	</tr>
<?php } ?>
</table>
<?php } ?>
<div class='spoiler'>
	<a class='spoiler-head' href='#'>Отправить сообщение</a>
	<div class='spoiler-body'>
		<form action='sendmessage.php' method='post'>
			<select name='reciver' required>
				<option disabled>Выберите получателя</option>
<?php
$result = mysql_query("SELECT `id`, `firstname`, `lastname` FROM `users` WHERE `id` != '{$userid}'", $db) or die("Не могу выполнить запрос.");
while($man = mysql_fetch_assoc($result)) {
	echo '<option value="' . htmlspecialchars($man['id']) . '">' . htmlspecialchars($man['firstname'])
	. ' ' . htmlspecialchars($man['lastname']) . '</option>';
}
?>
			</select><br>
			<textarea name='message' placeholder='Сообщение' cols='30' rows='4' required></textarea><br>
			<input type='submit' value='Отправить сообщение' />
		</form>
	</div>
	<div class='clear'></div>
</div>
<?php
}
?>
</section>
</body>
</html>