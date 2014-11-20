$(function(){
	// For page load
	$("html body div#content div#innerContent").hide();
	$("html body div#content div#loading").show();
	setTimeout(function(){
		$("html body div#content div#loading").slideUp(400, function(){
			$("html body div#content div#innerContent").slideDown(600);
		});
	}, 1000);
});