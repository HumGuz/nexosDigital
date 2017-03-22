publicaciones = {	
    init : function(op) { 
    	$(window).resize(function(){			
			hed = ($(window).innerHeight()-180);
			$(".portlet-body").css('height',hed);	
			$(".portlet-body").data('height',hed);	
		}).resize();
    	//seleccion del editor   	
    	$('body').on('click','label.btn:not(label.btn.watch)',function() {
			$(this).toggleClass('btn-default').toggleClass('btn-primary');
			$(this).find('span.glyphicon').toggleClass('glyphicon-ok');
		});		
		//mostrar u ocultar
		$('body').on('click','label.watch',function() {	
			$(this).toggleClass('btn-default').toggleClass('btn-warning');
			$(this).find('span.glyphicon').toggleClass('glyphicon-eye-close').toggleClass('glyphicon-eye-open');
			$(this).find('span').eq(1).text(function(i, text) {
				return text === "Visible" ? "Oculto" : "Visible";
			});
		});	
		//activar desactivar comentarios
		$('body').on('click',"a.togle",function() {
			$(this).text(function(i, text) {
				return text === "Desactivar comentarios" ? "Activar comentarios" : "Desactivar comentarios";
			});
		});
		//cambiar valor a opciones anteriores		
		$('body').on('click',".togle",function() {
			object = $(this).data();
			$.ajax({ type : "POST",url :base_url+"articles/updateOption",dataType : "json",data:{col:object.col,id_articulo:object.id_articulo}}).done(function(response) { 
	           console.log(response);
	        }).fail(function( jqXHR, textStatus, errorThrown ) {				
				console.log(jqXHR,textStatus,errorThrown);
			}); 
		 });		 
		 $('body').on('hidden.bs.modal',".modal",function(){
		 	$(this).remove();
		 	if($(".modal").length){
		 		$("body").addClass('modal-open');
		 	}
		 }); 		 	
		 publicaciones.getArticlesTable({})
    },
    
    getArticlesTable:function( object ){
		$.ajax({type : 'POST',url : base_url+"articles/getArticlesTable",dataType:"html",data : object}).done(function(response){
			if($.trim(response)!=''){
				$("#articlesContainer tbody").html(response);
				$('#articlesContainer tbody [data-toggle="popover"]').popover();
			}
		}).fail(function( jqXHR, textStatus, errorThrown ) {console.log(jqXHR,textStatus,errorThrown);});		
	},	    
    
   	nuevaPublicacion:function(object){
   		app.spin('nuevaNP');
    	$.ajax({type : 'POST',url : base_url+'articles/nuevaPublicacion',dataType:"html",data : object}).done(function(response){		
				$("body").append(response);								
				$("#nuevaN").modal('show');
				app.spin('nuevaNP');
		}).fail(function( jqXHR, textStatus, errorThrown ) {console.log(jqXHR,textStatus,errorThrown);});
   	} ,
   	initNuevaPublicacion:function(extend,article){   		
   		$('#nuevaN .summernote').summernote({lang: 'es-ES',dialogsInBody: true});
   		$("#fecha").datetimepicker({ format: 'YYYY-MM-DD HH:mm'});
   		
   		$('#tags').tagsinput({maxTags: 10,confirmKeys: [44,32]});				
   		
   		$.validator.addMethod('filesize', function (value, element, param) {	
		    return this.optional(element) || (element.files[0].size < param)
		}, 'El tamaño de la imagen tiene que ser mayor a {0}');			
		$.validator.addMethod('minImageWidth', function(value, element, minWidth) {
		  return ($(element).data('imageWidth') || 0) > minWidth;
		}, function(minWidth, element) {
		  var imageWidth = $(element).data('imageWidth');
		  return (imageWidth)
		      ? ("El ancho de la imagen tiene que ser mayor a " + minWidth + "px")
		      : "El archivo seleccionado no es una imagen.";
		});
		$(".bootstrap-tagsinput").click(function(){
			$(this).parents('.form-group').find('.invalid').remove();
		});	
		
		$('#tags').on('beforeItemAdd', function(event) {
		 	if (event.item == '' || !(/\S*#(?:\[[^\]]+\]|\S+)/.test(event.item))) {
		 		($("#nvaP-form").validate()).showErrors({'tags':'Capture un Hastag válido'}); 
		 		event.cancel = true;     
			}	 	
		});   
		
		
		publicaciones.initValidador({});		
		if(article){			
             	a = response;
             	$("#nombre").val(a.nombre);
             	$("#descripcion").val(a.descripcion);
             	$("#id_categoria").val(a.id_categoria);             	
             	 tags = a.tags.split(',');             	 
             	 if(tags.length){
             	 	for(i=0;i<tags.length;i++){
             	 		$("#tags").tagsinput('add',tags[i]);
             	 	}
             	 }             	  		
             	$('#content').summernote('code', a.content);
             	$('#resumen').summernote('code', a.resumen);             	
             	var $img = $('<img class="center-block img-responsive"/>').attr({ src: base_url+'application/views/images/'+a.imagen });		
			    $img.on('load', function() {		      	
			        $('#imgContainer').append($img).show();	
			    });	             	             	
             	$("#fecha").val(a.fecha.replace(':00',''));
             	publicaciones.initValidador(object);
             	$("#imagen").rules("remove",'required extension minImageWidth');             
		}
		$("#nuevaN .selectpicker").selectpicker({});
   	},
   	initValidador:function(object){		
		validator = $("#nvaP-form").sendForm({request:'',extend:object,
						rules:{imagen: {required:true,extension: "png|jpg|jpeg|gif",minImageWidth: 800}},
						success:function(object){publicaciones.guardarArticulo(object);}
					});
		var  $photoInput = $('#imagen'),$imgContainer = $('#imgContainer'),$imgContainer2 = $('#imgContainer2');
		$('#imagen').change(function() {			
		  $photoInput.removeData('imageWidth');		  
		  $imgContainer.empty();			  
		  $imgContainer2.hide().empty();			  	
		  var file = this.files[0];				  
		  if (file.type.match(/image\/.*/)) {	
		    var reader = new FileReader();			    	
		    reader.onload = function() {
		      var $img = $('<img class="center-block"/>').attr({ src: reader.result });		
		      var $img2 = $('<img class="center-block img-responsive"/>').attr({ src: reader.result });		
		      $img.on('load', function() {		      	
		        $imgContainer.append($img);	
		        $imgContainer2.append($img2).show();	;	       
		        var imageWidth = $img.width();		       
		        $photoInput.data('imageWidth', imageWidth);		        
		        if (imageWidth > 800) {	
		          $img.addClass('img-responsive');		          
		        }
		        validator.element($photoInput);		        
		      });		      
		    }	
		    reader.readAsDataURL(file);
		  } else {
		    validator.element($photoInput);
		  }
		});	
	}, 
	guardarArticulo:function(object){
		imagen =($("#imagen")[0].files.length)?$("#imagen")[0].files[0].name:'';		
		var data = new FormData();	
		data.append('imagen',$("#imagen")[0].files[0]);       
		$.each(object,function(inp,vl){
	    	data.append(inp,vl); 
	    });
	    object = data;	    
		app.spin('btn-save');
		$.ajax({type:"POST", contentType:false,processData:false,cache:false,url : base_url+"Articles/guardarArticulo",dataType : "json",data:object}).done(function(response) {
			app.spin('btn-save');
			if(response.status==1){
				$("#nuevaN").modal('hide');				
				publicaciones.getArticlesTable({})
			}else{
				console.log(response);
				$.msgBox({title : "Error al guardar",content : "Ocurrió un error al guardar, comunicarse con el area de sistemas",type : "error", buttons : [{ value : "Aceptar",cls:' btn-default '}]});
			}				
		}).fail(function(response,response2,response3) {console.log(response,response2,response3);app.spin('btn-save'); });;
	},	
	borrarArticulo:function(object){
		  $.msgBox({title : "Eliminar articulo",content : "Una vez eliminado, se perderá toda la información ligada al articulo, ¿Desea continuar?",type : "alert", buttons : [{ value : "Borrar",cls:' btn-danger '},{ value : "Cancelar" }],success:function(res){
		  	if(res=='Borrar')
		  		$.ajax({ type : "POST",url :base_url+"articles/deleteArticulo",dataType : "json",data:object}).done(function(response) {publicaciones.getArticlesTable({});}); 
		  }});
	},	
	preview:function(object){		
		object.target = 'target="_blank"';
        $.ajax({ type : "POST",url :base_url+"articles/getArticlePreview",dataType : "html",data:object}).done(function(response) {             
            $("body").append(response);								
			$("#preview").modal('show');			
        }); 
	},
};

