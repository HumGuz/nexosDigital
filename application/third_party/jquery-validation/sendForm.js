(function($) {
	$.extend($.validator.messages, {
		required: "Este campo es obligatorio.",
		remote: "Por favor, rellena este campo.",
		email: "Por favor, escribe una dirección de correo válida.",
		url: "Por favor, escribe una URL válida.",
		date: "Por favor, escribe una fecha válida.",
		dateISO: "Por favor, escribe una fecha (ISO) válida.",
		number: "Por favor, escribe un número válido.",
		digits: "Por favor, escribe sólo dígitos.",
		creditcard: "Por favor, escribe un número de tarjeta válido.",
		equalTo: "Por favor, escribe el mismo valor de nuevo.",
		extension: "Por favor, selecciona un archivo con una extensión aceptada.",
		maxlength: $.validator.format("Por favor, no escribas más de {0} caracteres."),
		minlength: $.validator.format("Por favor, no escribas menos de {0} caracteres."),
		rangelength: $.validator.format("Por favor, escribe un valor entre {0} y {1} caracteres."),
		range: $.validator.format("Por favor, escribe un valor entre {0} y {1}."),
		max: $.validator.format("Por favor, escribe un valor menor o igual a {0}."),
		min: $.validator.format("Por favor, escribe un valor mayor o igual a {0}."),
		nifES: "Por favor, escribe un NIF válido.",
		nieES: "Por favor, escribe un NIE válido.",
		cifES: "Por favor, escribe un CIF válido."
	});
	$.fn.sendForm = function(object) {
		defaults = {
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
				$('.help-block').remove();
				$('.has-error').removeClass('has-error');
				$('.red.btn-outline').removeClass('red btn-outline').addClass('btn-default');
				 $.each(validator.invalid, function(id, msj) {				 	 
				 	 if($("#" + id).hasClass('selectpicker'))				 	 
				 	 	$("button[data-id='"+id+"']").removeClass('btn-default').addClass('red btn-outline').click(function(){
				 	 		$(this).removeClass('red btn-outline').addClass('btn-default');				 	 		
				 	 	});					 	 	
				 	 	mt = 0;
				 	 	if($("#" + id).parents('.form-group').hasClass('form-md-line-input')){				 	 		
				 	 		halp = $("#" + id).parents('.form-group').eq(0).find('.help-block')
	                        if(halp.length)
	                        	halp.text('msj');
	                        else
	                         $("#" + id).after(' <span class="help-block">'+msj+'</span>');
	                          // $("#" + id).parents('.form-group').eq(0).append(' <span class="help-block">'+msj+'</span>');
	                        mt = 1;
				 	 	}		 	
					 	$("#" + id).parents('.form-group').eq(0).addClass('has-error').click(function(){				 	 		
				 	 		if(mt)
				 	 			$("#" + id).parents('.form-group').eq(0).removeClass('has-error').find('.help-block').remove();
				 	 		else{
				 	 			$("#" + id).parents('.form-group').eq(0).removeClass('has-error');
				 	 			$("#"+id+"-error").remove();
				 	 		}				 	 		
				 	 	});
				 });				
			}
		};
		options = $.extend({},defaults, object);
		$(this).data('options',options);		
		validateConfig = {
			debug : true,
			submitHandler : function(form) {				
				options = $(form).data('options');				
				form = options.id_form;
				$(form).find('.error-label').remove();
				$(form).find('.has-error').removeClass('has-error');
				options.errorList = [];				
				options.form_data = {
					request : options.request
				}; 
				$(form).find('input[type="text"],input[type="password"],input[type="hidden"],input[type="number"],textarea,select').each(function(k, element) {
					if(element.id && element.id !='')
						options.form_data[element.id] = $(element).val();				
				});
				$(form).find('input[type="radio"]:checked').each(function(k, element) {
					if(element.name && element.name !=''){
						options.form_data[element.name] = $(element).val();
					}						
				});				
				$(form).find('input[type="checkbox"]:checked').each(function(k, element) {                   
                    if($(form).find('input[name="'+element.name+'"]').length==1){
                    	options.form_data[element.name] = $(element).val();
                    }else{
                    	if(!options.form_data[element.name])
	                        options.form_data[element.name] = [];                    
	                    options.form_data[element.name].push($(element).val());
                    }
                });
				$.extend(options.form_data, options.extend);
				$('.error-label').remove();
				$('.help-block').remove();
                $('.has-error').removeClass('has-error');
                if(options.form_data.trim!='' && options.form_data.trim){  
                	aux = {};		
					$.each(options.form_data,function(k,v){			
						aux[(k.replace(options.form_data.trim,''))] = v;			
					});		
					options.form_data = aux;	
                }	
				options.success(options.form_data);				
			},
			rules : options.rules,
			messages : options.messages,
			focusInvalid : false,
			onfocusout : false,
			ignore : ".ignore",
			invalidHandler : options.invalidHandler,
			showErrors: options.showErrors,
			showLabel:options.showLabel
		};			
		return $(this).validate(validateConfig);
	}
})(jQuery);
