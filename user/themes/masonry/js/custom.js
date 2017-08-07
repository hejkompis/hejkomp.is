/* custom.js */

$(document).ready(function() {

	print_current();

	setInterval(function() { 
		print_current();
	}, 10000);

});

$(window).load(function() {

	$(function() {
		$("img.lazy").show().lazyload({
			threshold : 200,
			effect : "fadeIn"
		});
	});

});

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

function print_current() {

	$.getJSON('./api/spotify/print	_current/', function(data) {
		
		if(data.status == 'playing') {
			$('.spotify_current').html('<a href="./api/leaving/?for='+data.url+'&referrer=Website" target="_blank"><i class="fa fa-fw fa-spotify" aria-hidden="true"></i> '+data.artist + ' - ' + data.track+'  #nowplaying</a>');
		}
		else if(data.status == 'paused') {
			$('.spotify_current').html('<a href="./api/leaving/?for=https://open.spotify.com/user/amadore&referrer=Website"><i class="fa fa-fw fa-spotify" aria-hidden="true"></i> amadore</a>');
		}

	}).fail(function() {
		console.log('Something failed...');
	});

}