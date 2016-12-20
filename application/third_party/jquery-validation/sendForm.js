(function($) {
	$.fn.sendForm = function(object) {
		defaults = {
			invalid_char_list : ['"', '!', '#', '$', '%', '&', '/', '(', ')', '=', '?', '¡', "'", '*', '+', '´', '¨', '~', '^', '@', '{', '}', ' ', '|', '¬', '°', '[', ']', ',', '.'],
			errorList : [],
			form_data : {},
			id_form : '#' + $(this).attr('id'),
			rules : {},
			messages : {},
			request : '',
			extend : {},
			showLabel:true,
			success : function(form_data) {
			},
			invalidHandler:function(events, validator) {				
				// console.log(events);
				$('.help-block').remove();
				$('.has-error').removeClass('has-error');
				$('.red.btn-outline').removeClass('red btn-outline').addClass('btn-default');
				$.each(validator.invalid, function(id, msj) {
					if ($("#" + id).hasClass('selectpicker'))
						$("button[data-id='" + id + "']").removeClass('btn-default').addClass('red btn-outline').click(function() {
							$(this).removeClass('red btn-outline').addClass('btn-default');
						});
					$("#" + id).parents('.form-group').eq(0).addClass('has-error').click(function() {							
						$("#" + id).parents('.form-group').eq(0).removeClass('has-error').find('.help-block').remove();
					});
				});
	
			}
		};
		$.extend(defaults, object);
		
		validateConfig = {
			debug : true,
			submitHandler : function(form) {
				form = defaults.id_form;
				$(form).find('.error-label').remove();
				$(form).find('.has-error').removeClass('has-error');
				defaults.errorList = [];				
				defaults.form_data = {
					request : defaults.request
				}; 
				$(form).find('input[type="email"],input[type="text"],input[type="password"],input[type="hidden"],input[type="number"],textarea,select').each(function(k, element) {
					if(element.id && element.id !='')
						defaults.form_data[element.id] = $(element).val();				
				});
				$(form).find('input[type="radio"]:checked,input[type="checkbox"]:checked').each(function(k, element) {
					if(element.name && element.name !='')
						defaults.form_data[element.name] = $(element).val();
				});
				$.extend(defaults.form_data, defaults.extend);
				$('.error-label').remove();
				$('.help-block').remove();
                $('.has-error').removeClass('has-error');
                if(defaults.form_data.trim!='' && defaults.form_data.trim){  
                	aux = {};		
					$.each(defaults.form_data,function(k,v){			
						aux[(k.replace(defaults.form_data.trim,''))] = v;			
					});		
					defaults.form_data = aux;	
                }	
				defaults.success(defaults.form_data);				
			},
			rules : defaults.rules,
			messages : defaults.messages,
			focusInvalid : false,
			onfocusout : false,
			ignore : ".ignore",
			errorClass :'invalid',
			invalidHandler : defaults.invalidHandler,
			showErrors: defaults.showErrors,
			showLabel:defaults.showLabel
		};	
		$(this).validate(validateConfig);
		return $(this);
	}
})(jQuery);
