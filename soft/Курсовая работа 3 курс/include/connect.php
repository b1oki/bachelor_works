<?php
$db = mysql_connect("localhost", "website", "qwe123asd") or die("Нет соединения с сервером.");
mysql_select_db("website", $db) or die(mysql_error());
mysql_query("SET NAMES 'utf8'");