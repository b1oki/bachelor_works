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
include("include/menu.php"); ?>
<h3>Форум - Список тем</h3>
<div id="content">
<?php
$result = mylib_select_themes_list();
$total = mysql_num_rows($result);
if($total > 0) {
	$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;
	$result = mylib_select_themes_list(false, $offset); ?>
	<table>
		<tr>
			<th>Тема</th>
			<th>Обновление</th>
<?php if(mylib_is_auth()) { echo '<th>Автор</th>'; } ?>
		</tr>
<?php while($row = mysql_fetch_assoc($result)) {
		$id = intval($row['id']);
		$title = save_string($row['title']);
		$updated = save_string($row['updated']);
		$author = intval($row['author']);
		$authorLogin = mylib_get_user_login($author); ?>
		<tr>
			<td><a href="theme.php?id=<?php echo $id ?>"><?php echo $title ?></a></td>
			<td><?php echo $updated ?></td>
<?php	if(mylib_is_auth()) {
			echo '<td><a href="user.php?id='.$author.'">'.$authorLogin.'</a></td>';
		}
		echo '</tr>';
	}
echo '</table>';
echo mylib_get_menu_of_pages($total, $offset);
} else {
	echo '<p>Форум пуст</p>';
}
echo '</div>';
if(mylib_is_auth()) { ?>
	<form>
		<p>
			Добавить тему:<br>
			<input id="title" type="text"><br>
			Сообщение:<br>
			<textarea id="message"></textarea><br>
			<input type="button" value="Отправить" onclick='addtheme()'><br>
			<span id="box"></span>
		</p>
	</form>
<?php } ?>
</body>
</html>