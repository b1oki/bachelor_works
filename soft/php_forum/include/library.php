<?php
function mylib_is_auth($print = false) {
	if(!isset($_SESSION['id'])) {
		if($print) {
			echo '<p>Вы не авторизованы. <a href="authorization.php">Авторизация</a></p>';
		}
		return false;
	} else {
		return true;
	}
}
function mylib_select_theme($theme, $all = true, $offset = 5, $number = 5) {
	global $db;
	if(isset($theme)) {
		$id = intval($theme);
		if($all) {
			return mysql_query("SELECT `id` FROM `posts` WHERE `theme` = '$id' ORDER BY `sended` DESC", $db);
		} else {
			$offset = intval($offset);
			$number = intval($number);
			return mysql_query("SELECT * FROM `posts` WHERE `theme` = '$id' ORDER BY `sended` DESC LIMIT $offset, $number", $db);
		}
	} else {
		return false;
	}
}
function mylib_select_themes_list($all = true, $offset = 5, $number = 5) {
	global $db;
	if($all) {
		return mysql_query("SELECT `id` FROM `themes` ORDER BY `updated` DESC", $db);
	} else {
		$offset = intval($offset);
		$number = intval($number);
		return mysql_query("SELECT * FROM `themes` ORDER BY `updated` DESC LIMIT $offset, $number", $db);
	}
}
function mylib_get_theme_title($theme) {
	global $db;
	$id = intval($theme);
	$result = mysql_query("SELECT `title`, `id` FROM `themes` WHERE `id` = '$id'", $db);
	$row = mysql_fetch_assoc($result);
	return save_string($row['title']);
}
function mylib_add_post($message, $theme, $author) {
	global $db;
	if(isset($theme) and isset($message) and isset($author)) {
		$msg = save_string($message);
		$id = intval($theme);
		$user = intval($author);
		$result = mysql_query("INSERT INTO `posts` (`message`, `theme`, `author`) VALUES ('$msg', '$id', '$user')", $db);
		if(mysql_affected_rows($db) > 0) {
			mysql_query("UPDATE `themes` SET `updated`=NOW() WHERE `id`='$id'", $db);
			return true;
		} else {
			return false;
		}
	} else {
		return false;
	}
}
function mylib_add_theme($message, $title, $author) {
	global $db;
	if(isset($title) and isset($message) and isset($author)) {
		$msg = save_string($message);
		$title = save_string($title);
		$user = intval($author);
		$result = mysql_query("INSERT INTO `themes` (`title`, `author`) VALUES ('$title', '$user')", $db);
		$id = intval(mysql_insert_id($db));
		if(mysql_affected_rows($db) > 0) {
			$result = mysql_query("INSERT INTO `posts` (`message`, `theme`, `author`) VALUES ('$msg', '$id', '$user')", $db);
			if(mysql_affected_rows($db) > 0) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	} else {
		return false;
	}
}
function mylib_get_user_login($user) {
	global $db;
	$id = intval($user);
	$result = mysql_query("SELECT `id`, `login` FROM `users` WHERE `id` = '$id'", $db);
	$row = mysql_fetch_assoc($result);
	return save_string($row['login']);
}
function mylib_get_user_info($user) {
	global $db;
	$id = intval($user);
	$result = mysql_query("SELECT `id`, `login`, `name`, `birthday`, `email` FROM `users` WHERE `id` = '$id'", $db);
	return mysql_fetch_assoc($result);;
}
function mylib_connect_DB() {
	global $db;
	$db = mysql_connect('localhost', 'phplessons', 'qwerty123');
	if($db) {
		mysql_select_db('phplessons', $db);
		mysql_set_charset("utf8", $db);
		return true;
	} else {
		return false;
	}
}
function mylib_mail_to_admin($msg = 'Пустое сообщение.<br>Простите за беспокойство.') {
	$to  = 'delta01j@gmail.com';
	//$to . =', ' . 'solodushkin_s@mail.ru'; // несколько получателей, обратите внимание на запятую
	// тема письма
	$subject = 'Сообщение с сайта b1oki.dyndns.info';
	// текст письма
	$message = '<html><head><title>Birthday Reminders</title></head><body><p>';
	$message .= save_string($msg);
	$message .= '</p></body></html>';
	// Для отправки HTML-письма должен быть установлен заголовок Content-type
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	// Дополнительные заголовки
	$headers .= 'To: delta01j@gmail.com' . "\r\n";
	$headers .= 'From:  <admin@b1oki.dyndns.info>' . "\r\n";
	// Отправляем
	return mail($to, $subject, $message, $headers);
}
function save_string($string) {
	$string=trim($string);
	if(get_magic_quotes_gpc()==1) {
		$string=stripslashes($string);
	} else {
	$string=mysql_real_escape_string($string);
	return $string;
	}
}
function mylib_get_menu_of_pages($total, $offset = 0, $number = 5) {
	function getGoodUrl($url, $cur) {
		if ($_SERVER['QUERY_STRING'] == "") {
			return $url . "?offset=" . $cur;
		} else {
			if (substr_count($_SERVER['QUERY_STRING'], "offset=") > 0) {
				$url = preg_replace("/offset=\d+/i", "offset=" . $cur, $url);
				return $url;
			} else {
				return $url . "&offset=" . $cur;
			}
		}
	}
	if ($total <= $number) {
		return;
	}
	$url = $_SERVER['REQUEST_URI'];
	$int = intval($total / $number);
	$rest = $total % $number;
	$menu = '<div class="MenuOffset">';
	for ($i = 0; $i < $int; $i++) {
		$cur = $i * $number;
		if ($cur == $offset) {
			$menu .= '<span class="MenuOffsetCurrent">' . ($cur + 1) . '-' . ($cur + $number) . '</span>';
		} else {
			$menu .= '<a href="' . getGoodUrl($url, $cur) . '">' . ($cur + 1) . '-' . ($cur + $number) . '</a>';
		}
	}
	if ($rest > 0) {
		$cur += $number;
		if ($cur == $offset) {
			if ($rest == 1) {
				$menu .= '<span class="MenuOffsetCurrent">' . ($cur + 1) . '</span>';
			} else {
				$menu .= '<span class="MenuOffsetCurrent">' . ($cur + 1) . "-" . ($cur + $rest) . "</span>\n";
			}
		} else {
			if ($rest == 1) {
				$menu .= '<a href="' . getGoodUrl($url, $cur) . '">' . ($cur + 1) . '</a>';
			} else {
				$menu .= '<a href="' . getGoodUrl($url, $cur) . '">' . ($cur + 1) . "-" . ($cur + $rest) . '</a>';
			}
		}
	}
	$menu .= '</div>';
	return $menu;
}