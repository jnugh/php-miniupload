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
			accordeon += '<div class="loading"><div class="loader-dots"></div></div>';
		else{
			accordeon += '<p><a href="download.php?file='+file.id+'"><i class="icon-cloud-download"></i>&nbsp;Download</a> - ' + Math.round(file.size / 1024) + 'KByte</p>'
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
		$($('#collapse' + id).find('.accordion-inner')[0]).append(
				generateAccordeonFromJSON(JSON.parse(data)));
	});
}