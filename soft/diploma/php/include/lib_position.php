<?php
function getposition($input) {
	$input = intval($input);
	switch($input) {
		case 0: $return = 'Пользователь';
		break;
		case 1: $return = 'Модератор';
		break;
		case 2: $return = 'Администратор';
		break;
		default: $return = 'HACK!';
		break;
	}
	return $return;
}