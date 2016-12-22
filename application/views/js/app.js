app = {
    init : function() {       
        $("span.menu").click(function() {
			$(".list-nav").slideToggle("slow", function() {
				// Animation complete.
			});
		});
		$("span.glyphicon-log-in").tooltip();
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
               console.log(config);               
               if(config.setWidth == true){       
               // if(table.attr('data-set-width') == '' || table.attr('data-set-width') !='false'){
                   table.find('td').removeAttr('width');
                   $.each(firstRowBodyCols,function(j,col){$(col).attr('width',$(firstRowHeadCols[j]).attr('width'));}); 
               }
                maxHeight = (config.container)?$("#"+config.container).innerHeight():$(window).innerHeight();                         
               // maxHeight = (table.attr('data-container'))?$("#"+table.attr('data-container')).innerHeight():$(window).innerHeight();               
               fixedBody.css('height',maxHeight-parseInt(config.height));
               //fixedBody.css('height',maxHeight-parseInt(table.attr('data-height')));
               table.attr('data-fixed','true');
               // table.data('fixed',true);               
               // if(table.attr('data-max-width'))  
               	// tcontainer.css({'max-width':parseInt(table.attr('data-max-width')),'margin':'0px auto' });                   
               // if(table.attr('data-eval'))
                   // eval(table.attr('data-eval'));               
               if(config.maxWidth)                   
                   tcontainer.css({'max-width':parseInt(config.maxWidth),'margin':'0px auto' });               
               if(config.eval)
                   eval(config.eval);
    }
};
$(document).ready(function() {  
    app.init();
    base_url = 'http://localhost:8080/nexosDigital/';
});
