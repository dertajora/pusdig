/* JS File */

// Start Ready
$(document).ready(function() {  

	// Icon Click Focus
	$('div.icon').click(function(){
		$('input#search').focus();
	});

	// Live Search
	// On Search Submit and Get Results
	function search() {
		var query_value = $('input#search').val();
		$('b#search-string').html(query_value);
		if(query_value !== ''){
			$.ajax({
				type: "POST",
				url: "/search.php",
				data: { query: query_value },
				cache: false,
				success: function(html){
					$("ul#results").html(html);
				}
			});
			$.ajax({
				type: "POST",
				url: "/searchstatus.php",
				data: { query: query_value },
				cache: false,
				success: function(html){
					$("ul#resultslima").html(html);
				}
			});
		}return false; 
		    
	}

	$("input#search").live("keyup", function(e) {
		// Set Timeout
		clearTimeout($.data(this, 'timer'));

		// Set Search String
		var search_string = $(this).val();

		// Do Search
		if (search_string == '') {
			$("ul#results").fadeOut();
			$('h4#results-text').fadeOut();
			$("ul#resultslima").fadeOut();
			$('h4#resultslima-text').fadeOut();
		}else{
			$("ul#results").fadeIn();
			$('h4#results-text').fadeIn();
			$("ul#resultslima").fadeIn();
			$('h4#resultslima-text').fadeIn();
			$(this).data('timer', setTimeout(search, 100));
		};
	});

});

/* JS File */

// Start Ready
$(document).ready(function() {  

	// Icon Click Focus
	$('div.icon').click(function(){
		$('input#searchsatu').focus();
	});

	// Live Search
	// On Search Submit and Get Results
	function search() {
		var query_value = $('input#searchsatu').val();
		$('b#searchsatu-string').html(query_value);
		if(query_value !== ''){
			$.ajax({
				type: "POST",
				url: "/search.php",
				data: { query: query_value },
				cache: false,
				success: function(html){
					$("ul#resultssatu").html(html);
				}
			});
			$.ajax({
				type: "POST",
				url: "/searchstatus.php",
				data: { query: query_value },
				cache: false,
				success: function(html){
					$("ul#resultsenam").html(html);
				}
			});
		}return false;    
	}

	$("input#searchsatu").live("keyup", function(e) {
		// Set Timeout
		clearTimeout($.data(this, 'timer'));

		// Set Search String
		var search_string = $(this).val();

		// Do Search
		if (search_string == '') {
			$("ul#resultssatu").fadeOut();
			$('h4#resultssatu-text').fadeOut();
			$("ul#resultsenam").fadeOut();
			$('h4#resultsenam-text').fadeOut();
		}else{
			$("ul#resultssatu").fadeIn();
			$('h4#resultssatu-text').fadeIn();
			$("ul#resultsenam").fadeIn();
			$('h4#resultsenam-text').fadeIn();
			$(this).data('timer', setTimeout(search, 100));
		};
	});

});

/* JS File */

// Start Ready
$(document).ready(function() {  

	// Icon Click Focus
	$('div.icon').click(function(){
		$('input#searchdua').focus();
	});

	// Live Search
	// On Search Submit and Get Results
	function search() {
		var query_value = $('input#searchdua').val();
		$('b#searchdua-string').html(query_value);
		if(query_value !== ''){
			$.ajax({
				type: "POST",
				url: "/search.php",
				data: { query: query_value },
				cache: false,
				success: function(html){
					$("ul#resultsdua").html(html);
				}
			});
			$.ajax({
				type: "POST",
				url: "/searchstatus.php",
				data: { query: query_value },
				cache: false,
				success: function(html){
					$("ul#resultstujuh").html(html);
				}
			});
		}return false;    
	}

	$("input#searchdua").live("keyup", function(e) {
		// Set Timeout
		clearTimeout($.data(this, 'timer'));

		// Set Search String
		var search_string = $(this).val();

		// Do Search
		if (search_string == '') {
			$("ul#resultsdua").fadeOut();
			$('h4#resultsdua-text').fadeOut();
			$("ul#resultstujuh").fadeOut();
			$('h4#resultstujuh-text').fadeOut();
		}else{
			$("ul#resultsdua").fadeIn();
			$('h4#resultsdua-text').fadeIn();
			$("ul#resultstujuh").fadeIn();
			$('h4#resultstujuh-text').fadeIn();
			$(this).data('timer', setTimeout(search, 100));
		};
	});

});
/* JS File */

// Start Ready
$(document).ready(function() {  

	// Icon Click Focus
	$('div.icon').click(function(){
		$('input#searchtiga').focus();
		
	});

	// Live Search
	// On Search Submit and Get Results
	function search() {
		var query_value = $('input#searchtiga').val();
		//var nib = $('input#searchtiga').val();
		
		
		if(query_value !== ''){
			$.ajax({
				type: "POST",
				url: "/searchmember.php",
				data: { query: query_value},
				cache: false,
				success: function(html){
					$("ul#resultstiga").html(html);
				}
			});
		}return false;    
	}

	$("input#searchtiga").live("keyup", function(e) {
		// Set Timeout
		clearTimeout($.data(this, 'timer'));

		// Set Search String
		var search_string = $(this).val();

		// Do Search
		if (search_string == '') {
			$("ul#resulttiga").fadeOut();
			$('h4#resulttiga-text').fadeOut();
		}else{
			$("ul#resulttiga").fadeIn();
			$('h4#resulttiga-text').fadeIn();
			$(this).data('timer', setTimeout(search, 100));
		};
	});

});

/* JS File */

// Start Ready
$(document).ready(function() {  

	// Icon Click Focus
	$('div.icon').click(function(){
		$('input#searchempat').focus();
		$('input#jumlah').focus();
	});

	// Live Search
	// On Search Submit and Get Results
	function search() {
		var query_value = $('input#searchempat').val();
		var nib = $('input#searchempat').val();
		var jumlah = $('input#jumlah').val();
		
		if(query_value !== ''){
			$.ajax({
				type: "POST",
				url: "/searchbook.php",
				data: { query: nib ,jumlah: jumlah},
				cache: false,
				success: function(html){
					$("ul#resultsempat").html(html);
				}
			});
		}return false;    
	}

	$("input#searchempat").live("keyup", function(e) {
		// Set Timeout
		clearTimeout($.data(this, 'timer'));

		// Set Search String
		var search_string = $(this).val();

		// Do Search
		if (search_string == '') {
			$("ul#resultsempat").fadeOut();
			$('h4#resultsempat-text').fadeOut();
		}else{
			$("ul#resultsempat").fadeIn();
			$('h4#resultsempat-text').fadeIn();
			$(this).data('timer', setTimeout(search, 100));
		};
	});

});