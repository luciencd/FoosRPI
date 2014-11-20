$(function(){
	// Sign Out button
	$(document).on("click", "html body div#signOut", function(){
		$.post("/home/assets/ajax/signOut.php", function(){
			$("html body div#signOut").slideUp(400, function(){
				$(this).remove();
			});
			$("html body div#content div#innerContent").slideUp(600, function(){
				$("html body div#content div#innerContent").load("/home/loggedOut.php"); // Start loading in the new content...
				$(this).siblings("div#loading").slideDown(400, function(){
					setTimeout(function(){
						$("html body div#content div#loading").slideUp(400, function(){
							$("html body div#content div#innerContent").slideDown(600);
						});
					}, 1000);
				});
			});
		});
	});
	// Sliding Live Scores text
	var left = 0;
	setInterval(function(){
		if($("html body div#content div#innerContent div#liveScores").length>0){
			$box = $("html body div#content div#innerContent div#liveScores");
			$slider = $("html body div#content div#innerContent div#liveScores div#innerScores");
			if(left==parseInt($box.width())){
				left = -1*parseInt($slider.width());
			}
			$slider.css("margin-left", left + "px");
			++left;
		}
	}, 15);
	// Update live scores
	if($("html body div#content div#innerContent div#liveScores").length>0){
		$("html body div#content div#innerContent div#liveScores div#innerScores").load("/home/assets/ajax/liveScores.php");
	}
	setInterval(function(){
		if($("html body div#content div#innerContent div#liveScores").length>0){
			$("html body div#content div#innerContent div#liveScores div#innerScores").load("/home/assets/ajax/liveScores.php");
		}
	}, 1000);
});