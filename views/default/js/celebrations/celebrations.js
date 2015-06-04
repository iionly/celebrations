define(function(require) {
	var elgg = require("elgg");
	var $ = require("jquery");
	
	$('#input_filterid').change(function() {
		var month = $(this).data('month');
		window.location = elgg.get_site_url() + "celebrations/celebrations/" + month + "/" + $(this).children('option:selected').val();
	});
});
