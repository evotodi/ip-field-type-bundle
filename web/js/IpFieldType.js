function isValid(ipaddress, parent_id)
{
	var ip_conf = JSON.parse(document.getElementById(parent_id).dataset['ip_conf']);
	var split_val = ipaddress.split(ip_conf['sep']);
	if (split_val.length != ip_conf['group']) {
		return false;
	}

	for (var i = split_val.length - 1; i >= 0; i--) {
		var num = parseInt(split_val[i], ip_conf['base']);

		if (isNaN(num)){
			return false;
		}
		if (num < 0 || num > ip_conf['max_value']) {
			return false;
		}
	}
	return true;
}

function onPaste(e)
{
	var parent = document.getElementById(e['target'].dataset['parent']);
	var ip_conf = JSON.parse(parent.dataset['ip_conf']);
	var pastedText = undefined;
	if (window.clipboardData && window.clipboardData.getData) { // IE
		pastedText = window.clipboardData.getData('Text');
	} else if (e.clipboardData && e.clipboardData.getData) {
		pastedText = e.clipboardData.getData('text/plain');
	}

	if (isValid(pastedText, e['target'].dataset['parent']))
	{
		var split_val = pastedText.split(ip_conf['sep']);

		for (i = 0; i < ip_conf['group']; i++){
			var field = document.getElementById(e['target'].dataset['parent']+i);
			field.value = split_val[i];
		}
	}
	else
	{
		alert('no valid');
	}

	return false;
}

function onCopy(e)
{

	var ip = document.getElementById(e['target'].dataset['parent']).value;
	console.log(ip);
	if (isValid(ip, e['target'].dataset['parent']))
	{
		if (window.clipboardData && window.clipboardData.setData) { // IE
			window.clipboardData.setData('Text', ip);
		} else if (e.clipboardData && e.clipboardData.setData) {
			e.clipboardData.setData('text/plain', ip);
		}
		return false;
	}
	return true;
}

function init() {
	var inps = document.querySelectorAll('input[name^="{{ fname }}"][data-ip_conf]');

	inps.forEach(function (value, index) {
		var ip_conf = JSON.parse(value.dataset['ip_conf']);

		var hidden = document.getElementById(value['id']);
		console.log(hidden);

		for (i = 0; i < ip_conf['group']; i++){
			var field = document.getElementById(value['id']+i);
			field.onpaste = onPaste;
			field.oncopy = onCopy;
		}

		var split_ip = hidden.value.split(ip_conf['sep']);
		console.log(split_ip);

		if (split_ip.length != ip_conf['group'])
		{
			hidden.value = "";
			for (var i = 0; i < ip_conf['group'] - 1; i++)
			{
				hidden.value += ip_conf['sep'];
			}
			return ;
		}

		for (i = 0; i < ip_conf['group']; i++){
			var field = document.getElementById(value['id']+i);
			field.value = split_ip[i];
		}
	})

}

if (document.readyState == "complete") {
	init();
}else {
	window.onload = init;
}