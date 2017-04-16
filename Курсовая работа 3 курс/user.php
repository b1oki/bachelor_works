<?php
session_start();
include("./include/jsheader.php");
include("./include/nav.php");
?>
<section>
<?php if(empty($_SESSION['login']) or empty($_SESSION['id'])) { ?>
<h3>Страница недоступна</h3>
<p>Привет, гость. <a href='./auth.php'>Вход</a></p>
<?php
} else {
	include("./include/connect.php");
	$mypage = false;
	if(!empty($_GET['id'])) {
		$userid = intval($_GET['id']);
		if($userid == intval($_SESSION['id'])) $mypage = true;
	} else {
		$userid = intval($_SESSION['id']);
		$mypage = true;
	}
	$result = mysql_query("SELECT `login`, `position`, `firstname`, `lastname`, `birth`, `phone`, `email` FROM `users` WHERE `id` = '{$userid}'", $db) or die("Не могу выполнить запрос.");
	$info = mysql_fetch_assoc($result);
	echo '<h3>Информация о пользователе ' . htmlspecialchars($info['login']) . "</h3>\n";
	include("./include/usermenu.php");
	include("./include/lib_position.php");
?>
<table class="user_info">
<tr>
<th>Логин</th>
<td><?php echo htmlspecialchars($info['login']); ?></td>
</tr>
<tr>
<th>Имя</th>
<td><?php echo htmlspecialchars($info['firstname']); ?></td>
</tr>
<tr>
<th>Фамилия</th>
<td><?php echo htmlspecialchars($info['lastname']); ?></td>
</tr>
<tr>
<th>Должность</th>
<td><?php echo getposition($info['position']); ?></td>
</tr>
<tr>
<th>Дата рождения</th>
<td><?php echo htmlspecialchars($info['birth']); ?></td>
</tr>
<tr>
<th>Телефон</th>
<td><?php echo htmlspecialchars($info['phone']); ?></td>
</tr>
<tr>
<th>Почта</th>
<td><a href='mailto:<?php echo htmlspecialchars($info['email']); ?>'><?php echo htmlspecialchars($info['email']); ?></a></td>
</tr>
</table>
<?php if($mypage) echo '<p><a href="./change_password.php">Сменить пароль</a></p>'; } ?>
</section>
</body>
</html>