<?php
session_start();
require_once('include/library.php');
mylib_connect_DB();
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<script src="include/script.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="include/style.css" />
	<title>Форум</title>
</head>
<body>
<?php
mylib_is_auth(true);
include('include/menu.php');
if(isset($_GET['id'])) {
	$theme = intval($_GET['id']);
	$title = mylib_get_theme_title($theme);
?>
<h3>Форум - Тема "<?php echo $title ?>"</h3>
<div id="content">
<?php
	$number = 15;
	$result = mylib_select_theme($theme);
	$total = mysql_num_rows($result);
	if($total > 0) {
	$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;
	$result = mylib_select_theme($theme, false, $offset, $number); ?>
	<table>
		<tr>
			<th>Сообщение</th>
			<th>Отправлено</th>
<?php if(mylib_is_auth()) { ?>
			<th>Автор</th>
<?php } ?>
		</tr>
	<?php
	while($row = mysql_fetch_assoc($result)) {
	$message = save_string($row['message']);
	$sended = save_string($row['sended']);
	$author = intval($row['author']);
	$authorLogin = mylib_get_user_login($author); ?>
		<tr>
			<td><?php echo $message ?></td>
			<td><?php echo $sended ?></td>
<?php if(mylib_is_auth()) { ?>
			<td><a href="user.php?id=<?php echo $author ?>"><?php echo $authorLogin ?></a></td>
<?php } ?>
		</tr>
<?php } ?>
	</table>
<?php
	echo mylib_get_menu_of_pages($total, $offset, $number);
	}
} else { ?>
	<p>Такой темы нет на форуме.</p>
<?php } ?>
</div>
<?php
if(mylib_is_auth()) { ?>
	<form>
		<p>
			Написать сообщение:<br>
			<textarea id="message"></textarea><br>
			<input id="theme" type="text" value="<?php echo $theme; ?>" hidden>
			<input type="button" value="Отправить" onclick='addpost()'><br>
			<span id="box"></span>
		</p>
	</form>
<?php } ?>
</body>
</html>