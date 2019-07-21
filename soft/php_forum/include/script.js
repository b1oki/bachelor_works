function XmlHttp()
{
	var xmlhttp;
	try{xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");}
	catch(e)
	{
		try {xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");} 
		catch (E) {xmlhttp = false;}
	}
	if (!xmlhttp && typeof XMLHttpRequest!='undefined')
	{
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}

function ajax(param)
{
	if (window.XMLHttpRequest) req = new XmlHttp();
	method=(!param.method ? "POST" : param.method.toUpperCase());

	if(method=="GET")
	{
		send=null;
		param.url=param.url+"&ajax=true";
	}
	else
	{
		send="";
		for (var i in param.data) send+= i+"="+param.data[i]+"&";
		send=send+"ajax=true";
	}
	
	req.open(method, param.url, true);
	if(param.statbox) document.getElementById(param.statbox).innerHTML = '<img src="images/wait.gif" width="32" height="32">';
	req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	req.send(send);
	req.onreadystatechange = function()
	{
		if (req.readyState == 4 && req.status == 200) //если ответ положительный
		{
			if(param.success) param.success(req.responseText);
		}
	}
}
function addpost() {
	if(document.getElementById("message").value=="") {
		document.getElementById("box").innerHTML="Напишите сообщение!";
	} else {
		ajax({
				       url:"include/addpost.php",
				       statbox:"box",
				       method:"POST",
				       data:
				       {
						message:document.getElementById("message").value,
						theme:document.getElementById("theme").value
					},
				       success:function(data){
						document.getElementById("box").innerHTML=data;
						message:document.getElementById("message").value="";
						ajax({
						       url:"include/getposts.php",
						       statbox:"content",
						       method:"POST",
						       data:{
							       theme:document.getElementById("theme").value
								},
						       success:function(data){
								document.getElementById("content").innerHTML=data;
							}
						});
					}
		});
	}
}
function addtheme() {
	if(document.getElementById("message").value=="") {
		document.getElementById("box").innerHTML="Не хватает данных!";
	} else {
		ajax({
				       url:"include/addtheme.php",
				       statbox:"box",
				       method:"POST",
				       data:{
						message:document.getElementById("message").value,
						title:document.getElementById("title").value
					   },
				       success:function(data){
						document.getElementById("box").innerHTML=data;
						document.getElementById("message").value="";
						document.getElementById("title").value="";
						ajax({
						   url:"include/getthemes.php",
						   statbox:"content",
						   method:"POST",
						   data:{},
							success:function(data){
								document.getElementById("content").innerHTML=data;
							}
						});
					}
		});
	}
}