<?php
$week = array(0=>"воскресенье",1=>"понедельник",2=>"вторник",3=>"среда",4=>"четверг",5=>"пятница",6=>"суббота");
$parity = (date("W")%2 == 0) ? 2 : 1;
if(isset($_GET['week'])) {
	$weekint = abs(intval($_GET['week']));
	if($weekint > -1 || $weekint < 7) {
		if((string)$weekint !== $_GET['week']) {
			header("HTTP/1.1 301 Moved Permanently");
			header("Location: http://b1oki.hut4.ru/software/course3/timetable.php?week=" . $weekint);
			exit;
		}
		$dnow = $weekint;
	}
	else {
		header("HTTP/1.1 301 Moved Permanently");
		header("Location: http://b1oki.hut4.ru/software/course3/index.php");
		exit;
	}
}
include("./include/sheader.php");
include("./include/nav.php");
?>
<section>
<h3>Расписание на <?php echo $week[$dnow]; ?>:</h3>
<?php
include("./include/connect.php");
$result = mysql_query("SELECT `id`, `day`, `begin`, `end`, `title`, `teacher`, `room`, `parity` FROM `c3_timetable` WHERE `day` = '$dnow' ORDER BY `begin`", $db) or die("Не могу выполнить запрос.");
if(mysql_num_rows($result)>0):
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
			$mend = date("i", strtotime($row['end'])); ?>
		<tr>
			<td><?php echo $hbegin . ':' . $mbegin . ' - ' . $hend . ':' . $mend ?></td>
			<td><?php echo htmlspecialchars($row['title']) ?></td>
			<td><?php echo htmlspecialchars($row['teacher']) ?></td>
			<td><?php echo htmlspecialchars($row['room']) ?></td>
		</tr>
<?php endif; endwhile; ?>
		</tbody>
	</table>
<?php else:	echo "<p>На этот день нет занятий.</p>"; endif; ?>
<form action="timetable.php" method="get" class="chose_time">
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