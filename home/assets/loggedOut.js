$(function(){
	// For login input hovers
	$(document).on("focus", "html body div#content div#innerContent div.signInUp form#signInForm input", function(){
		switch($(this).attr("id")){
			case 'email':
				if($(this).val()=="Email")
					$(this).val("");
				break;
			case 'passwordFake':
				$(this).hide();
				$(this).siblings("input#password").show().focus();
				break;
		}
	}).on("blur", "html body div#content div#innerContent div.signInUp form#signInForm input", function(){
		switch($(this).attr("id")){
			case 'email':
				if($(this).val()=="")
					$(this).val("Email");
				break;
			case 'password':
				if($(this).val()==""){
					$(this).hide();
					$(this).siblings("input#passwordFake").show();
				}
				break;
		}
	});
	// For join input hovers
	$(document).on("focus", "html body div#content div#innerContent div.signInUp form#joinForm input", function(){
		switch($(this).attr("id")){
			case 'name':
				if($(this).val()=="Full Name")
					$(this).val("");
				break;
			case 'email':
				if($(this).val()=="Email")
					$(this).val("");
				break;
			case 'rin':
				if($(this).val()=="RIN Number")
					$(this).val("");
				break;
			case 'passwordFake':
				$(this).hide();
				$(this).siblings("input#password").show().focus();
				break;
			case 'password2Fake':
				$(this).hide();
				$(this).siblings("input#password2").show().focus();
				break;
		}
	}).on("blur", "html body div#content div#innerContent div.signInUp form#joinForm input", function(){
		switch($(this).attr("id")){
			case 'name':
				if($(this).val()=="")
					$(this).val("Full Name");
				break;
			case 'email':
				if($(this).val()=="")
					$(this).val("Email");
				break;
			case 'rin':
				if($(this).val()=="")
					$(this).val("RIN Number");
				break;
			case 'password':
				if($(this).val()==""){
					$(this).hide();
					$(this).siblings("input#passwordFake").show();
				}
				break;
			case 'password2':
				if($(this).val()==""){
					$(this).hide();
					$(this).siblings("input#password2Fake").show();
				}
				break;
		}
	});
	// Parse join data
	$(document).on("submit", "html body div#content div#innerContent div.signInUp form#joinForm", function(e){
		e.preventDefault();
		$.post("/home/assets/ajax/join.php", $(this).serialize(), function(d){
			if(d=="success"){
				$("html body div#content div#innerContent div.signInUp form#joinForm").slideUp(600, function(){
					$(this).html("Thank you! Please check your email to complete joining.");
					$(this).slideDown(400);
				});
			}else{
				$("html body div#content div#innerContent div.signInUp form#joinForm div.error").slideUp(400, function(){
					$(this).html(d);
					$(this).slideDown(400);
				});
			}
		});
		return false;
	});
	// Parse sign in data
	$(document).on("submit", "html body div#content div#innerContent div.signInUp form#signInForm", function(e){
		e.preventDefault();
		$.post("/home/assets/ajax/signIn.php", $(this).serialize(), function(d){
			if(d=="success"){
				$("html body div#content div#innerContent").slideUp(600, function(){
					$("html body div#content div#innerContent").load("/home/loggedIn.php"); // Start loading in the new content...
					$(this).siblings("div#loading").slideDown(400, function(){
						setTimeout(function(){
							$("html body div#content div#loading").slideUp(400, function(){
								$("html body div#content div#innerContent").slideDown(600);
								// Add sign out button
								$("html body").prepend('<div id="signOut" class="button" style="display: none;">Sign Out</div>');
								$("html body div#signOut").slideDown(400);
							});
						}, 1000);
					});
				});
			}else{
				$("html body div#content div#innerContent div.signInUp form#signInForm div.error").slideUp(400, function(){
					$(this).html(d);
					$(this).slideDown(400);
				});
			}
		});
		return false;
	});
});