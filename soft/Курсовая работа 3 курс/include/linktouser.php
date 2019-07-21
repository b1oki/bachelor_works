<?php
function linktouser($input) {
	$authorId = intval($input);
	$result = mysql_query("SELECT `firstname`, `lastname` FROM `users` WHERE `id` = '{$authorId}'") or die("Не могу выполнить запрос.");
	$row = mysql_fetch_assoc($result);
	$return = '<a href="./user.php?id='. $authorId . '">' . htmlspecialchars($row['firstname']) . ' ' . htmlspecialchars($row['lastname']) . '</a>';
	return $return;
}