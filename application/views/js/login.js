login = {
    validationParams: {
        request : 'login',
        rules: {
            email: {email:true,required: true},
            key: {required: true},
        },
        messages: {
           email: {email:"El nombre de usuario no es válido.",required: "Nombre de usuario requerido." },
           key: {required: "Capture su contraseña."}
        },
        success : function(object) {
            $('.text-danger').remove();
            login.sendData(object);
        }
    },
    init:function(){
        $(document).ready(function(){
              $("#login-form").sendForm(login.validationParams);
        });
    },  
    sendData : function(object) {
         app.spin('btn-login');
        $.ajax({
            type:'POST',
            url : base_url+"login/login",
            dataType : "json",
            data : object
        }).done(function(response) {    
            console.log(response);      
            app.spin('btn-login');  
            if(response.status == 1)
            	location.href = 'admin/dashboard';
            else{
            	($("#login-form").validate()).showErrors(response);            
	            $("#login-form input.invalid").each(function(k,e){
	            	id = $(this).attr('id');
	            	if ($("#" + id).hasClass('selectpicker'))
							$("button[data-id='" + id + "']").removeClass('btn-default').addClass('red btn-outline').click(function() {
								$(this).removeClass('red btn-outline').addClass('btn-default');
							});
						$("#" + id).parents('.form-group').eq(0).addClass('has-error').click(function() {							
							$("#" + id).parents('.form-group').eq(0).removeClass('has-error').find('.help-block').remove();
						});
	            });       
            }	                 
        }).fail(function(response,response2,response3) {
            console.log(response,response2,response3);      
            app.spin('btn-login');
        });
    }
}
$(document).ready(function(){login.init()});