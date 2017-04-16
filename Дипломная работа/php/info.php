<?php
session_start();
include("./include/sheader.php");
include("./include/nav.php");
?>
<section>
	<h3>Информация о сайте</h3>
<?php if(empty($_SESSION['login']) or empty($_SESSION['id'])) { ?>
	<p>Страница одной из групп УрФУ.</p>
<?php } else { ?>
	<p>Сайт создан Александром Собяниным.</p>
	<p>Информация для группы УрФУ, ИМКН, ПИ-301, Набор 2010-2014.</p>
<?php } ?>
</section>
</body>
</html>