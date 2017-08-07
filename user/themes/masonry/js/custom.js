/* custom.js */

$(document).ready(function() {

	print_current();

	setInterval(function() { 
		print_current();
	}, 10000);

	var $grid = $('.masonry').isotope({
		itemSelector: 'article.post',
		masonry: {
			// use outer width of grid-sizer for columnWidth
			// columnWidth: '.masonry-sizer'
		}
	});

	$grid.imagesLoaded().progress( function() {
  		$grid.isotope('layout');
	});

});

$(window).load(function() {

	$(function() {
		$("img.lazy").show().lazyload({
			threshold : 200,
			effect : "fadeIn"
		});
	});

});

function print_current() {

	$.getJSON('./api/spotify/print	_current/', function(data) {
		
		if(data.status == 'playing') {
			$('#spotify_current').html('<a href="'+data.url+'" target="_blank"><i class="fa fa-fw fa-spotify" aria-hidden="true"></i> '+data.artist + ' - ' + data.track+'  #nowplaying</a>');
		}
		else if(data.status == 'paused') {
			$('#spotify_current').html('');
		}

	}).fail(function() {
		console.log('Something failed...');
	});

}