subscriptores = {
	initSub:function(){
		$('#side-menu').metisMenu();		
		$("[data-toggle='tooltip']").tooltip();
		if ($(".fix:not([data-fixed='true'])").length) {
			$.each($(".fix:not([data-fixed='true'])"), function(k, c) {
				app.runFixTableHead($(this));
			});
		}		
	},
	borrarSubscriptor:function(object){
		  $.msgBox({title : "Eliminar subscriptor",content : "Una vez eliminado, se perderá toda la información ligada a el, ¿Desea continuar?",type : "alert", buttons : [{ value : "Borrar",cls:' btn-danger '},{ value : "Cancelar" }],success:function(res){
		  	if(res=='Borrar')
		  		$.ajax({ type : "POST",url :base_url+"Newsletter/deleteSubscriptor",dataType : "json",data:object}).done(function(response) {location.reload();}); 
		  }});
	},	
}
