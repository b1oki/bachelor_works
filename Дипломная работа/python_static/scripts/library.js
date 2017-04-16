jQuery(document).ready(function() {
	var root = "http://" + location.host + "/diploma/python/"

    $('a.spoiler-head').click(function(){
        $(this).next().toggle(200);
		return false;
    });
	$('form.chose_time').submit(function() {
		return false;
	});
	$('form.chose_time input').click(function() {
		selected = $('form.chose_time select :selected').val();
		window.location = root + "timetable/day/" + selected;
		return false;
	});
	if(window.location == root || window.location == root + "timetable/"){
		$('tbody tr td:first-child').each(function(){
			var time = $(this).text();
			var timeArr = time.match(/\d{1,2}/g);
			var bhour = Number(timeArr[0]);
			var bmin = Number(timeArr[1]);
			var ehour = Number(timeArr[2]);
			var emin = Number(timeArr[3]);
			var date = new Date($.now());
			var chour = date.getHours();
			var cmin = date.getMinutes();
			if(chour < bhour) $(this).parent('tr').addClass('newlesson');
			else if(chour == bhour & cmin < bmin) $(this).parent('tr').addClass('nearlesson');
			else if(chour < ehour || (chour == ehour & cmin < emin)) $(this).parent('tr').addClass('thislesson');
			else $(this).parent('tr').addClass('oldlesson');
		});
	}
});