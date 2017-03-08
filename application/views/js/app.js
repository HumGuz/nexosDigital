app = {
	op:1,
    init : function(op) {    	
    	app.op =op;    	       
        $("span.menu").click(function() {
			$(".list-nav").slideToggle("slow", function() {});
		});
		$("span.glyphicon-log-in").tooltip();
		if(op==1)
			app.newsletterVal();
		else	
			app.commentVal();
    }, 
    commentVal:function(){
    	$("#commentform").sendForm({
				request:'comment',			
				rules:{
					nombre:{required:true},
					mail:{email:true,required:true},
					comentario:{required:true}
				},
				success:function(obj){
					 console.log(obj);					
					 $.ajax({ type : "POST",url:base_url+'Newsletter/guardarComentario',dataType : "json",data:obj}).done(function(res) {         
			            console.log(res);
			            if(res.status==1){			            	
			            	if($(".empty-comments").length){
			            		$(".empty-comments").after(res.comentario);
			            		$(".empty-comments").remove();
			            	}else{
			            		$(".comments-main").eq(0).before(res.comentario);
			            	}			            	
			            	$("#commentform").resetForm();
			            }else{
			            	($("#commentform").validate()).showErrors(res);            
				            $("#commentform input.invalid").each(function(k,e){
				            	app.unsetInvalid(this);
				            });    
			            }
			        }).fail(function( jqXHR, textStatus, errorThrown ) {				
							console.log(jqXHR,textStatus,errorThrown);
					});;;
				}
			})	
    },
    newsletterVal:function(){
    	$("#newsletterForm").sendForm({
				request:'signup',			
				rules:{
					nombre:{required:true},
					mail:{email:true,required:true}
				},
				success:function(obj){
					 console.log(obj);					
					 $.ajax({ type : "POST",url:base_url+'Newsletter/signup',dataType : "json",data:obj}).done(function(res) {         
			            console.log(res);
			            if(res.status==1){
			            	location.href = base_url+'nexos/bienvenido';
			            }else{
			            	($("#newsletterForm").validate()).showErrors(res);            
				            $("#newsletterForm input.invalid").each(function(k,e){app.unsetInvalid(this);});    
			            }
			        }).fail(function( jqXHR, textStatus, errorThrown ) {				
							console.log(jqXHR,textStatus,errorThrown);
					});
				}
			})	
    },
     
	unsetInvalid:function(el) {
		id = $(el).attr('id');
		if ($("#" + id).hasClass('selectpicker'))
			$("button[data-id='" + id + "']").removeClass('btn-default').addClass('red btn-outline').click(function() {
				$(el).removeClass('red btn-outline').addClass('btn-default');
			});
		$("#" + id).parents('.form-group').eq(0).addClass('has-error').click(function() {
			$("#" + id).parents('.form-group').eq(0).removeClass('has-error').find('.help-block').remove();
		});
	},   
    showPassword:function() {
		var key_attr = $('#key').attr('type');
		if (key_attr != 'text') {
			$('.checkbox').addClass('show');
			$('#key').attr('type', 'text');
		} else {
			$('.checkbox').removeClass('show');
			$('#key').attr('type', 'password');
		}
	},    
    spin : function(e) {
        e = $("#" + e);
        if (e.prop('disabled'))
            e.prop('disabled', false).find('span').eq(0).css('color', e.data('color')).attr("class", e.data('class'));
        else
            e.prop('disabled', true).data('class', e.find('span').attr("class")).data('color', e.css('color')).find('span').eq(0).css('color', '#000').attr("class", "fa fa-spinner fa-spin");
    }, 
    number_format:function number_format (number, decimals, decPoint, thousandsSep) { 
	  number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
	  var n = !isFinite(+number) ? 0 : +number
	  var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
	  var sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep
	  var dec = (typeof decPoint === 'undefined') ? '.' : decPoint
	  var s = ''	
	  var toFixedFix = function (n, prec) {
	    var k = Math.pow(10, prec)
	    return '' + (Math.round(n * k) / k)
	      .toFixed(prec)
	  }	
	  // @todo: for IE parseFloat(0.55).toFixed(0) = 0;
	  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.')
	  if (s[0].length > 3) {
	    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
	  }
	  if ((s[1] || '').length < prec) {
	    s[1] = s[1] || ''
	    s[1] += new Array(prec - s[1].length + 1).join('0')
	  }	
	  return s.join(dec)
	},
	trimKeys:function(trim,object){
		aux = {};
		$.each(object, function(k, v) {
			aux[k.replace(trim, '')] = v;
		});
		return aux;
	},
	 runFixTableHead:function(table){             
               idTable = table.attr('id');               
               tcontainer = $('<div class="fix-thead fix-thead-container"></div>').attr('id',idTable+'-container');
               fixedHead = $('<table  class="fix-thead-head table table-bordered table-condensed" ></table>').attr('id',idTable+'-head'); 
               fixedBody = $('<div class="fix-thead-body" style="overflow-y:scroll;"></div>').attr('id',idTable+'-body');               
               tcontainer.insertBefore(table); 
               fixedHead.appendTo(tcontainer);
               fixedBody.appendTo(tcontainer);
               table.appendTo(fixedBody);
               table.find('thead').appendTo(fixedHead);             
               firstRowHeadCols = fixedHead.first('tr').find('td');
               firstRowBodyCols = table.first('tr').find('td');   
               config = table.data();        
               if(config.setWidth == true){       
                   table.find('td').removeAttr('width');
                   $.each(firstRowBodyCols,function(j,col){$(col).attr('width',$(firstRowHeadCols[j]).attr('width'));}); 
               }
                maxHeight = (config.container)?$("#"+config.container).innerHeight():$(window).innerHeight();                                     
               fixedBody.css('height',maxHeight-parseInt(config.height));
               table.attr('data-fixed','true');               
               if(config.maxWidth)                   
                   tcontainer.css({'max-width':parseInt(config.maxWidth),'margin':'0px auto' });               
               if(config.eval)
                   eval(config.eval);
    }
};

