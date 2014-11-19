jQuery(document).ready(function($){
	"use strict";
var validator = $("#contactForm").validate({
			submitHandler: function(form) {
				
				//console.log($('#name',form).val());
				var data = $("#contactForm").serialize();
			 //	console.log(data);
				$.ajax({
						url: 'submit_contact.php',
						type: 'POST',
						dataType: 'json',
						data: data,
						success: function(result) {							
							if(result.errors!=undefined){
								var errors = {};
							   console.log(result.errors);
								$.each(result.errors,function(index,value){						
									
									if(value.target!= 'result' && value.error!=undefined){ 									
									var tar = value.target;
									var err = value.error;									
									errors[tar] = err;									
									}
									if(value.target == 'result'){																
										$('#result').html(value.error);
									}								
								});																												
										validator.showErrors(errors);									
									
							}
							if(result.success != undefined){
$('#result').html(result.success.message);
}
						}
			});			
			}
		});
});