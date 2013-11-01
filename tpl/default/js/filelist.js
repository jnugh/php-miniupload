$(function() {
	$('#content').append(generateAccordeonFromJSON(filelist));
});

function generateAccordeonFromJSON(obj) {
	// ...see bootstrap...
	var accordeon = '<div class="accordion" id="accordion' + obj.id + '">';
	for ( var i in obj.files) {
		file = obj.files[i];
		accordeon += '<div class="accordion-group">';
		accordeon += '<div class="accordion-heading">';
		accordeon += '<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion'
				+ obj.id + '" href="#collapse' + file.id + '"';
		if (file.dir)
			accordeon += 'onclick="fetchData(this, \'' + file.id + '\');"';
		accordeon += '>';

		if (file.dir)
			accordeon += '<i class="icon-folder-close"></i>&nbsp;&nbsp;';
		else
			accordeon += '<i class="icon-file"></i>&nbsp;&nbsp;';

		accordeon += file.name;

		accordeon += '</a>';

		accordeon += '<div id="collapse' + file.id
				+ '" class="accordion-body collapse">';
		accordeon += '<div class="accordion-inner">';
		if (file.dir)
			accordeon += '<p style="font-weight:bold;" class="actions"><a href="#" onclick="uploadFile(\''
					+ file.id
					+ '\'); return false;"><i class="icon-cloud-upload"></i>&nbsp;Upload</a>&nbsp;&nbsp;&nbsp;<a href="#" onclick="createFolder(\''
					+ file.id
					+ '\'); return false;"><i class="icon-plus"></i>&nbsp;Neuer Ordner</a></p></p><div class="loading"><div class="loader-dots"></div></div>';
		else {
			accordeon += '<p><a href="download.php?file='
					+ file.id
					+ '"><i class="icon-cloud-download"></i>&nbsp;Download</a> - '
					+ Math.round(file.size / 1024) + 'KByte</p>'
			accordeon += '<p>Uploader: [TBC]<br />';
			accordeon += 'Beschreibung:<br />[TBC]</p>';
		}
		accordeon += '</div>';
		accordeon += '</div>';
		accordeon += '</div>';
		accordeon += '</div>';

	}
	accordeon += '</div>';

	return accordeon;
}

function fetchData(obj, id) {
	$(obj).attr('onclick', '').unbind('click');
	$.get('list.php', {
		start : id,
		noTpl : true,
		idMount : true
	}, function(data) {
		$($('#collapse' + id).find('.loading')[0]).remove();
		$('#collapse' + id).find('.accordion').each(function() {
			$(this).html('');
		});
		$($('#collapse' + id).find('.accordion-inner')[0]).append(
				generateAccordeonFromJSON(JSON.parse(data)));
	});
}

function uploadFile(id) {

}

var actions = {};

function createFolder(id) {
	actions[id] = $($('#collapse' + id).find('.actions')[0]).html();
	$($('#collapse' + id).find('.actions')[0])
			.html(
					'<form action="#" onsubmit="createFolderSubmit(\''
							+ id
							+ '\'); return false;"><input type="text" name="dirname" /><input type="submit" value="Ordner erstellen" /></form>');
	return false;
}

function createFolderSubmit(id) {
	var name = $($('#collapse' + id).find('[name="dirname"]')[0]);
	console.log(name.val());
	$($('#collapse' + id).find('.actions')[0]).html('...');
	$.get('createFolder.php', {
		'name' : name.val(),
		'position' : id
	}, function(data) {
		if (data != 1)
			alert(data);
		$($('#collapse' + id).find('.actions')[0]).html(actions[id]);
		fetchData(null, id);
	});
	return false;
}