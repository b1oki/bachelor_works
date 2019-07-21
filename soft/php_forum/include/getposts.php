<?php
session_start();
header("Content-type: text/plain; charset=utf8");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
require_once('library.php');
mylib_connect_DB();
$theme = intval($_POST['theme']);
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