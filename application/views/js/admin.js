admin = {
	init:function(){
		$('#side-menu').metisMenu();
		base_url = 'http://localhost:8080/nexosDigital/';
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
		
		$("label.togle").click(function() {
			object = $(this).data();
			console.log(object);
			$.ajax({ type : "POST",url :base_url+"articles/updateOption",dataType : "json",data:{col:object.col,id_articulo:object.id_articulo}}).done(function(response) { 
	           console.log(response);
	        }).fail(function( jqXHR, textStatus, errorThrown ) {				
				console.log(jqXHR,textStatus,errorThrown);
			}); 
		 });		
		$('.summernote').summernote({lang: 'es-ES',dialogsInBody: true});		
		$(".selectpicker").selectpicker({});		
		$("#fecha").datetimepicker({ format: 'YYYY-MM-DD HH:mm'});		
		$("#nuevaN").on('show.bs.modal',function(){
			$("#nuevaN form").resetForm();
		});
		
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
		validator = $("#nvaP-form").sendForm({
			request:'',
			rules:{
				imagen: {
	                extension: "png|jpg|jpeg|gif",
	                minImageWidth: 800,
            	}
			},
			success:function(object){
				console.log(object);
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
		
		$(".bootstrap-tagsinput").click(function(){
			$(this).parents('.form-group').find('.invalid').remove();
		});
		
		
		
		
		$(window).bind("load resize", function() {
			var topOffset = 50;
			var width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
			if (width < 768) {
				$('div.navbar-collapse').addClass('collapse');
				topOffset = 100;
				// 2-row-menu
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
		// var element = $('ul.nav a').filter(function() {
		//     return this.href == url;
		// }).addClass('active').parent().parent().addClass('in').parent();
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
	},
	preview:function(object){		
		object.target = 'target="_blank"';
        $.ajax({ type : "POST",url :base_url+"articles/getArticle",dataType : "html",data:object}).done(function(response) { 
             $("#preview div.print-main").html(response);
              $("#preview").modal('show');
        }); 
	}
};
$(document).ready(function() {
	admin.init();
});
