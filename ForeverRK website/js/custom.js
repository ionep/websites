//gallery viewer
baguetteBox.run('.tz-gallery');

//form validator
$(document).ready(function(){
$('#contact-form').validate({
	rules:{
		username:{
			required: true
		},
		email:{
			required: true,
			email: true
		},
		phone:{
		    required: true,
			number: true
		},
		message:{
			required:true
		}
	}
});
});