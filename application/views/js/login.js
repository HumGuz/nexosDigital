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
            url : "/index.php/login/login",
            dataType : "json",
            data : object
        }).done(function(response) {    
            console.log(response);      
            app.spin('btn-login');
            // if(response.status==1)
                // location.href = './index.php/admin/';
                  
        }).fail(function(response,response2,response3) {
            console.log(response,response2,response3);      
            app.spin('btn-login');
        });
    }
}
$(document).ready(function(){login.init()});