<?php
$db = mysql_connect("localhost", "diploma", "qwerty123") or die("Нет соединения с сервером.");
mysql_select_db("diploma", $db) or die(mysql_error());
mysql_query("SET NAMES 'utf8'");