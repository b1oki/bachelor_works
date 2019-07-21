<?php
session_start();
header("Content-type: text/plain; charset=utf8");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
require_once('library.php');
mylib_connect_DB();
$result = mylib_select_themes_list();
$total = mysql_num_rows($result);
if($total > 0) {
	$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;
	$result = mylib_select_themes_list(false, $offset);	?>
	<table>
		<tr>
			<th>Тема</th>
			<th>Обновление</th>
<?php if(mylib_is_auth()) { ?>
			<th>Автор</th>
<?php } ?>
		</tr>
<?php while($row = mysql_fetch_assoc($result)) {
	$id = intval($row['id']);
	$title = save_string($row['title']);
	$updated = save_string($row['updated']);
	$author = intval($row['author']);
	$authorLogin = mylib_get_user_login($author); ?>
		<tr>
			<td><a href="theme.php?id=<? echo $id ?>"><? echo $title ?></a></td>
			<td><? echo $updated ?></td>
<?php if(mylib_is_auth()) { ?>
			<td><a href="user.php?id=<? echo $author ?>"><? echo $authorLogin ?></a></td>
<?php } ?>
		</tr>
<? } ?>
	</table>
<?php
	echo mylib_get_menu_of_pages($total, $offset);
} else { ?>
<p>Форум пуст</p>
<?php }