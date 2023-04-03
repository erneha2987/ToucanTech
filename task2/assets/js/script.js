$(document).ready(function() {
	$('#search-btn').click(function() {
		var name = $('#name').val();
		$.ajax({
			url: 'search.php',
			type: 'POST',
			data: {name: name},
			success: function(response) {
				$('#results').html(response);
			}
		});
	});
});
