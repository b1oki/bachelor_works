<?php
session_start();
header("Content-type: text/plain; charset=utf8");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
require_once('library.php');
if(mylib_connect_DB() and mylib_add_post($_POST['message'], $_POST['theme'], $_SESSION['id'])) {
	echo 'Отправлено';
} else {
	echo 'Ошибка';
}