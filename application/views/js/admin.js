admin = {
	init:function(){
		$('#side-menu').metisMenu();		
		$("[data-toggle='tooltip']").tooltip();
		if ($(".fix:not([data-fixed='true'])").length) {
			$.each($(".fix:not([data-fixed='true'])"), function(k, c) {
				app.runFixTableHead($(this));
			});
		}
		$("label.btn").not('.watch').click(function() {
			$(this).toggleClass('btn-default').toggleClass('btn-primary');
			$(this).find('span.glyphicon').toggleClass('glyphicon-ok');
		});		
		$("label.watch").click(function() {
			$(this).toggleClass('btn-default').toggleClass('btn-warning');
			$(this).find('span.glyphicon').toggleClass('glyphicon-eye-close').toggleClass('glyphicon-eye-open');
			$(this).find('span').eq(1).text(function(i, text) {
				return text === "Visible" ? "Oculto" : "Visible";
			});
		});	
		$("a.togle").click(function() {
			$(this).text(function(i, text) {
				return text === "Desactivar comentarios" ? "Activar comentarios" : "Desactivar comentarios";
			});
		});		
		$(".togle").click(function() {
			object = $(this).data();
			$.ajax({ type : "POST",url :base_url+"articles/updateOption",dataType : "json",data:{col:object.col,id_articulo:object.id_articulo}}).done(function(response) { 
	           console.log(response);
	        }).fail(function( jqXHR, textStatus, errorThrown ) {				
				console.log(jqXHR,textStatus,errorThrown);
			}); 
		 });		
		$('.summernote').summernote({lang: 'es-ES',dialogsInBody: true});		
		$(".selectpicker").selectpicker({});		
		$("#fecha").datetimepicker({ format: 'YYYY-MM-DD HH:mm'});
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
		admin.initValidador({});			
		$(".bootstrap-tagsinput").click(function(){
			$(this).parents('.form-group').find('.invalid').remove();
		});		
		
		$('.modal').on('hidden.bs.modal',function(){
				if($(".modal.fade.in").length)
					$('body').addClass('modal-open');
		});		
		$("#nuevaN").on('hide.bs.modal',function(){
			$("#nuevaN form").resetForm();
			$("#nuevaN .selectpicker").selectpicker('refresh');
			$('#content').summernote('code','');
			$('#resumen').summernote('code','');
			$('#tags').tagsinput('removeAll');
			$('#imgContainer').hide().empty();
		});	
	},
	preview:function(object){		
		object.target = 'target="_blank"';
        $.ajax({ type : "POST",url :base_url+"articles/getArticle",dataType : "html",data:object}).done(function(response) { 
             $("#preview div.print-main").html(response);
              $("#preview").modal('show');
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
			console.log(response);
			$("#nuevaN").modal('hide');
			app.spin('btn-save');
			location.reload();
		}).fail(function(response,response2,response3) {
            console.log(response,response2,response3);      
            app.spin('btn-save');
        });;
	},	
	borrarArticulo:function(object){
		  $.msgBox({title : "Eliminar articulo",content : "Una vez eliminado, se perderá toda la información ligada al articulo, ¿Desea continuar?",type : "alert", buttons : [{ value : "Borrar",cls:' btn-danger '},{ value : "Cancelar" }],success:function(res){
		  	if(res=='Borrar')
		  		$.ajax({ type : "POST",url :base_url+"articles/deleteArticulo",dataType : "json",data:object}).done(function(response) { 
		        	location.reload();
		        }); 
		  }});
	},
	editarArticulo:function(object){
		 $.ajax({ type : "POST",url :base_url+"articles/getArticulo",dataType : "json",data:object}).done(function(response) { 
       		if(response.id_articulo){ 
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
             	admin.initValidador(object);
             	$("#nuevaN").modal('show');
             	$(".selectpicker").selectpicker('refresh');
             	$("#imagen").rules("remove",'required extension minImageWidth');
             }
        }); 
	},
	initValidador:function(object){		
		validator = $("#nvaP-form").sendForm({
			request:'',
			extend:object,
			rules:{
				imagen: {
					required:true,
					extension: "png|jpg|jpeg|gif",
		            minImageWidth: 800
	            }
			},
			success:function(object){			
				admin.guardarArticulo(object);
			}
		});
		var  $photoInput = $('#imagen'),$imgContainer = $('#imgContainer');
		$('#imagen').change(function() {			
		  $photoInput.removeData('imageWidth');		  
		  $imgContainer.hide().empty();			  	
		  var file = this.files[0];				  
		  if (file.type.match(/image\/.*/)) {	
		    var reader = new FileReader();			    	
		    reader.onload = function() {
		      var $img = $('<img class="center-block"/>').attr({ src: reader.result });		
		      $img.on('load', function() {		      	
		        $imgContainer.append($img).show();		       
		        var imageWidth = $img.width();		       
		        $photoInput.data('imageWidth', imageWidth);		        
		        if (imageWidth < 800) {		         
		          $imgContainer.hide();		          
		        }else {		        	
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
	
	/* categorias */
	
	initCat:function(){
		$('#side-menu').metisMenu();		
		$("[data-toggle='tooltip']").tooltip();
		if ($(".fix:not([data-fixed='true'])").length) {
			$.each($(".fix:not([data-fixed='true'])"), function(k, c) {
				app.runFixTableHead($(this));
			});
		}		
		$('.modal').on('hidden.bs.modal',function(){
				if($(".modal.fade.in").length)
					$('body').addClass('modal-open');
		});		
		$("#nuevaN").on('hide.bs.modal',function(){
			$("#nuevaN form").resetForm();			
		});	
		
		
		$("#btnnvac").on('click',function(){
			$("#nvaP-form").sendForm({
				request:'',
				rules:{},
				success:function(object){			
					admin.guardarCategoria(object);
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
						admin.guardarCategoria(ob);
					}
				});
             }
        }); 
	},
		
	/* subscriptores */
	initSub:function(){
		$('#side-menu').metisMenu();		
		$("[data-toggle='tooltip']").tooltip();
		if ($(".fix:not([data-fixed='true'])").length) {
			$.each($(".fix:not([data-fixed='true'])"), function(k, c) {
				app.runFixTableHead($(this));
			});
		}		
	}
		
};
$(document).ready(function(){
	$(window).bind("load resize", function() {
			var topOffset = 50;
			var width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
			if (width < 768) {
				$('div.navbar-collapse').addClass('collapse');
				topOffset = 100;
			} else {
				$('div.navbar-collapse').removeClass('collapse');
			}	
			var height = ((this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height) - 1;
			height = height - topOffset;
			if (height < 1)
				height = 1;
			if (height > topOffset) {
				$("#page-wrapper").css("min-height", (height) + "px");
			}
		});	
		var url = window.location;
		var element = $('ul.nav a').filter(function() {
			return this.href == url;
		}).addClass('active').parent();	
		while (true) {
			if (element.is('li')) {
				element = element.parent().addClass('in').parent();
			} else {
				break;
			}
		}	
});
