/* custom.js */

$(document).ready(function() {

	print_current();

	setInterval(function() { 
		print_current();
	}, 5000);

});

function print_current() {

	$.getJSON('./api/spotify/print	_current/', function(data) {
		
		if(data.status == 'playing') {
			$('#spotify_current').html('<a href="'+data.url+'" target="_blank"><i class="fa fa-fw fa-spotify" aria-hidden="true"></i> '+data.artist + ' - ' + data.track+'  #nowplaying</a>');
		}
		console.log(data);
	}).fail(function() {
		console.log('Something failed...');
	});

}