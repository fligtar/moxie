// Starts backfetch request
function backfetch() {
	$('#refresh-trigger').hide();
	$('#backfetching').slideDown();
	$.ajax({
		url: "backfetch.php?project=" + projectName,
		cache: false,
		success: function() {
			$('#backfetching').slideUp();
			$('#backfetched').slideDown();
		}
	});
}

// Highlights user boxes with the selected field
function highlight(field) {
	$('#highlight-' + field).toggleClass('on').blur();
	$('#highlight-' + field + ' a').blur();
	
	$('#content').toggleClass('highlight-' + field);
}

// Goes to selected project
function selectProject() {
	var project = $('#project-selector').val();
	
	if (project != '') {
		window.location = './' + project;
	}
}