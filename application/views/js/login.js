login = {
    validationParams: {
        x : 'login',
        rules: {
            mail: {email:true,required: true},
            pass: {required: true},
        },
        messages: {
           mail: {email:"El nombre de usuario no es válido.",required: "Nombre de usuario requerido." },
           pass: {required: "Capture su contraseña."}
        },
        success : function(object) {
            $('.text-danger').remove();
            login.sendData(object);
        },
        invalidHandler:function(events, validator) {
                $('.text-danger').remove();
                 $.each(validator.invalid, function(id, msj) {  
                        $("#" + id).parents('li').eq(0).after('<li id="'+id+'-error" class="text-danger">'+msj+'</li>');
                         $("#" + id).click(function(){
                           $('#'+id+'-error').remove();  
                        });
                 });
            }
    },
    init:function(){
        $(document).ready(function(){
              $("#form_loginIndex").sendForm(login.validationParams);
        });
    },  
    sendData : function(object) {
         app.spin('bt-sub-in');
        $.ajax({
            type:'POST',
            url : "geotires/views/usuarios/login.php",
            dataType : "json",
            data : object
        }).done(function(response) {    
            console.log(response);      
            app.spin('bt-sub-in');
            if(response.codigo==10012)
                location.href = 'geotires/';
            else if(response.codigo==20254){                
                $("#pass").val('');
                        $("#mail").parents('li').eq(0).after('<li id="mail-error" class="text-danger">'+response.msj+'</li>');
                        $("#mail").click(function(){
                           $('#mail-error').remove();  
                        });
            }else if(response.codigo==20255){
                        $("#pass").parents('li').eq(0).after('<li id="pass-error" class="text-danger">'+response.msj+'</li>');
                        $("#pass").click(function(){
                           $('#pass-error').remove();  
                        });
            }               
        }).fail(function(response) {
            console.log(response);      
            app.spin('bt-sub-in');
            console.log( "Ha ocurrido un error!! estamos trabajando el ello..." );
        });
    }
}
$(document).ready(function(){login.init()});