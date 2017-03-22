categorias = {
	initCat:function(){
		$("#nuevaN").on('hide.bs.modal',function(){
			$("#nuevaN form").resetForm();			
		});	
		$("#btnnvac").on('click',function(){
			$("#nvaP-form").sendForm({
				request:'',
				rules:{},
				success:function(object){			
					categorias.guardarCategoria(object);
				}
			});	
		});	
	},	
	guardarCategoria:function(object){		
		app.spin('btn-save');
		$.ajax({type:"POST",url : base_url+"Articles/guardarCategoria",dataType : "json",data:object}).done(function(response) {
			console.log(response);
			$("#nuevaN").modal('hide');			
			location.reload();
		}).fail(function(response,response2,response3) {
            console.log(response,response2,response3);      
            app.spin('btn-save');
        });;
	},	
	borrarCategoria:function(object){
		  $.msgBox({title : "Eliminar categoría",content : "Una vez eliminada, se perderá toda la información ligada a ella, ¿Desea continuar?",type : "alert", buttons : [{ value : "Borrar",cls:' btn-danger '},{ value : "Cancelar" }],success:function(res){
		  	if(res=='Borrar')
		  		$.ajax({ type : "POST",url :base_url+"articles/deleteCategoria",dataType : "json",data:object}).done(function(response) { 
		        	location.reload();
		        }); 
		  }});
	},
	editarCategoria:function(object){
		 $.ajax({ type : "POST",url :base_url+"articles/getCategoria",dataType : "json",data:object}).done(function(response) { 
       		if(response.id_categoria){ 
             	a = response;
             	$("#nombre").val(a.nombre);
             	$("#descripcion").val(a.descripcion);        
             	$("#nuevaN").modal('show');   
             	$("#nvaP-form").sendForm({
					request:'',
					rules:object,
					success:function(ob){
						ob.id_categoria = a.id_categoria;
						categorias.guardarCategoria(ob);
					}
				});
             }
        }); 
	},		
}
