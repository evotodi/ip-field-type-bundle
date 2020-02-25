function isValid(ipaddress, parent_id)
{
	let ip_conf = JSON.parse(document.getElementById(parent_id).dataset['ip_conf']);
	let split_val = ipaddress.split(ip_conf['sep']);
	if (split_val.length !== ip_conf['group']) {
		return false;
	}

	for (let i = split_val.length - 1; i >= 0; i--) {
		let num = parseInt(split_val[i], ip_conf['base']);

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
	let parent = document.getElementById(e['target'].dataset['parent']);
	let ip_conf = JSON.parse(parent.dataset['ip_conf']);
	let pastedText = undefined;
	if (window.clipboardData && window.clipboardData.getData) { // IE
		pastedText = window.clipboardData.getData('Text');
	} else if (e.clipboardData && e.clipboardData.getData) {
		pastedText = e.clipboardData.getData('text/plain');
	}

	if (isValid(pastedText, e['target'].dataset['parent']))
	{
		let split_val = pastedText.split(ip_conf['sep']);

		for (i = 0; i < ip_conf['group']; i++){
			let field = document.getElementById(e['target'].dataset['parent']+i);
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
	let inps = document.querySelectorAll('input[data-ip_conf]');
	inps.forEach(function (value, index) {
		let field;
		let i;
		let ip_conf = JSON.parse(value.dataset['ip_conf']);

		let hidden = document.getElementById(value['id']);

		for (i = 0; i < ip_conf['group']; i++){
			field = document.getElementById(value['id'] + i);
			field.onpaste = onPaste;
			field.oncopy = onCopy;
		}

		let split_ip = hidden.value.split(ip_conf['sep']);

		if (split_ip.length !== ip_conf['group'])
		{
			hidden.value = "";
			for (i = 0; i < ip_conf['group'] - 1; i++)
			{
				hidden.value += ip_conf['sep'];
			}
			return ;
		}

		for (i = 0; i < ip_conf['group']; i++){
			field = document.getElementById(value['id']+i);
			field.value = split_ip[i];
		}
	})

}

if (document.readyState === "complete") {
	init();
}else {
	window.onload = init;
}