require('./bootstrap');

function clientName() {
	var clientName = $('#client-name-input').value;
	$('#client-name-output').innerHtml = clientName;
}
