<?php
date_default_timezone_set("Asia/Yekaterinburg");
include("./include/sheader.php");
include("./include/nav.php");
?>
<section>
<?php
$week = array(0=>"воскресенье","понедельник","вторник","среда","четверг","пятница","суббота");
$parity = (date("W")%2 == 0) ? 2 : 1;
$mnow = date("i");
$hnow = date("G");
$dnow = date("w");
echo "\t<h3>Расписание на {$week[date("w")]}, {$hnow}:{$mnow}</h3>\n";
include("./include/connect.php");
$result = mysql_query("SELECT `id`, `day`, `begin`, `end`, `title`, `teacher`, `room`, `parity` FROM `c3_timetable` WHERE `day` = '$dnow' ORDER BY `begin`", $db) or die("Не могу выполнить запрос.");
if(mysql_num_rows($result) > 0):
?>
	<table class="timetable">
		<thead>
		<tr>
			<th>Время</th>
			<th>Предмет</th>
			<th>Преподаватель</th>
			<th>Кабинет</th>
		</tr>
		</thead>
		<tbody>
<?php
	$iter = false;
	while ($row = mysql_fetch_assoc($result)):
		if(($row['parity'] == 0) || ($row['parity'] ==  $parity)):
			$hbegin = date("G", strtotime($row['begin']));
			$hend = date("G", strtotime($row['end']));
			$mbegin = date("i", strtotime($row['begin']));
			$mend = date("i", strtotime($row['end']));
			echo "\t<tr class=\"";
			if($iter == true):
				$iter = false;
				echo "iter ";
			else:
				$iter = true;
			endif;
			if($hnow < $hbegin) {
				echo 'newlesson';
			} else if($hnow == $hbegin && $mnow < $mbegin) {
				echo 'nearlesson';
			} else if(($hnow < $hend) || ($hnow == $hend && $mnow < $mend)) {
				echo 'thislesson';
			} else {
				echo 'oldlesson';
			} ?>">
			<td><?php echo $hbegin . ':' . $mbegin . ' - ' . $hend . ':' . $mend ?></td>
			<td><?php echo htmlspecialchars($row['title']) ?></td>
			<td><?php echo htmlspecialchars($row['teacher']) ?></td>
			<td><?php echo htmlspecialchars($row['room']) ?></td>
		</tr>
<?php
		endif;
	endwhile;
?>
		</tbody>
	</table>
	<p>Легенда: пара <span class="newlesson">будет</span> &#124; <span class="nearlesson">скоро</span> &#124; <span class="thislesson">идет</span> &#124; <span class="oldlesson">прошла</span>.</p>
<?php else: ?>
	<p>На этот день нет занятий.</p>
<?php endif; ?>
<form action="./timetable.php" method="get" class="chose_time">
	<fieldset>
		<legend>Посмотреть расписание на другой день</legend>
		<p>
			<select name="week">
				<option value="1">Понедельник</option>
				<option value="2">Вторник</option>
				<option value="3">Среда</option>
				<option value="4">Четверг</option>
				<option value="5">Пятница</option>
				<option value="6">Суббота</option>
				<option value="0">Воскресенье</option>
			</select> 
			<input type="submit" value="Открыть">
		</p>
	</fieldset>
</form>
</section>
</body>
</html>