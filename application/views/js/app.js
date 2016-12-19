app = {
    init : function() {
       
        $("span.menu").click(function() {
			$(".list-nav").slideToggle("slow", function() {
				// Animation complete.
			});
		});
		$("span.glyphicon-log-in").tooltip();
        $(".logout").click(function(){$.ajax({url:"views/request.php",data:{request:'logout'}}).done(function(){location.href='../'})});
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
	}
}
$(document).ready(function() {  
    app.init();
});
