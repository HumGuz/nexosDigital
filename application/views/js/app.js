app = {
    init : function() {
        $('#side-menu').metisMenu();
        $(window).bind("load resize", function() {
            var topOffset = 0;
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
        $.each($("#side-menu a[data-js]"),function(k,a){
              $(a).click(function(){
                  lnk = $(this);
                  if(lnk.attr('data-fn')!=undefined)
                    app.script(lnk.attr('data-js'),lnk.attr('data-fn'),{});
                  else
                    app.script(lnk.attr('data-js'),'listar',{});
              });
        }); 
        //filters
        $('body').on('click', 'button.btn-filtro', function(e) {
           e.stopPropagation();
           $(this).toggleClass('active').toggleClass('open-filter');
           $(this).find('span:eq(1)').toggleClass('glyphicon-chevron-right').toggleClass('glyphicon-chevron-left')
           $(this).prev('div.filtro').toggle(200);
        });
        //auto close filters
        $('body').on('click', '.filtro,.selectpicker-dropdown-menu', function(e) {
           if($(".selectpicker-dropdown-menu.open:visible").length==0)
                e.stopPropagation();
        });
        $('body').click(function(e){            
            if($(".selectpicker-dropdown-menu.open:visible").length==0)            
                $(this).find('.btn-filtro.open-filter').click();
        });
         $('body').on('click', 'div.close-filter', function(e) {             	
                $('.btn-filtro.open-filter').click();
         });
        // stack modals
        $('body').on('hidden.bs.modal', '.modal', function(e) {
           $(this).remove();
        });
        //evento delegado para los botones de ordenamiento ASC-DESC
        $('body').on('click', 'button.sort', function(e) {     
            if(!$(this).hasClass('active')){
               $(this).toggleClass('btn-primary').toggleClass('btn-default').toggleClass('active');       
               $(this).siblings('button.sort').eq(0).toggleClass('btn-primary').toggleClass('btn-default').toggleClass('active');
               eval($(this).attr('controller')).options.sort_kind = $(this).attr('value');
            }         
        });
        $( document ).ajaxComplete(function( event, xhr, data) {            
            if(data.dataType=='html')            
                if($(".tab-body:visible .fix:not([data-fixed='true']),.modal .fix:not([data-fixed='true'])").length ){                
                    $.each($(".tab-body:visible .fix:not([data-fixed='true']),.modal .fix:not([data-fixed='true'])"),function(k,c){                        
                        app.runFixTableHead($(this));
                    });
                }
        });        
		$(document).ajaxStart(function() {
			$('.cssload-loader').fadeIn(100);
		});
		$(document).ajaxStop(function() {
			$('.cssload-loader').fadeOut(100);
		}); 

        
        $(".logout").click(function(){$.ajax({url:"views/request.php",data:{request:'logout'}}).done(function(){location.href='../'})});
    },    
    runFixTableHead:function(table){             
               idTable = table.attr('id');               
               tcontainer = $('<div class="fix-thead fix-thead-container"></div>').attr('id',idTable+'-container');
               fixedHead = $('<table  class="fix-thead-head table" ></table>').attr('id',idTable+'-head'); 
               fixedBody = $('<div class="fix-thead-body" style="overflow-y:scroll;"></div>').attr('id',idTable+'-body');               
               tcontainer.insertBefore(table); 
               fixedHead.appendTo(tcontainer);
               fixedBody.appendTo(tcontainer);
               table.appendTo(fixedBody);
               table.find('thead').appendTo(fixedHead);             
               firstRowHeadCols = fixedHead.first('tr').find('td');
               firstRowBodyCols = table.first('tr').find('td');               
               if(table.attr('data-set-width') == '' || table.attr('data-set-width') !='false'){
                   table.find('td').removeAttr('width');
                   $.each(firstRowBodyCols,function(j,col){$(col).attr('width',$(firstRowHeadCols[j]).attr('width'));}); 
               }                    
               maxHeight = (table.attr('data-container'))?$("#"+table.attr('data-container')).innerHeight():$(window).innerHeight();               
               fixedBody.css('height',maxHeight-parseInt(table.attr('data-height')));
               table.attr('data-fixed','true');
               if(table.attr('data-max-width'))                   
                   tcontainer.css({'max-width':parseInt(table.attr('data-max-width')),'margin':'0px auto' });               
               if(table.attr('data-eval'))
                   eval(table.attr('data-eval'));
    },    
    runResizeTabBody:function(){
        
    },
    spin : function(e) {
        e = $("#" + e);
        if (e.prop('disabled'))
            e.prop('disabled', false).find('span').eq(0).css('color', e.data('color')).attr("class", e.data('class'));
        else
            e.prop('disabled', true).data('class', e.find('span').attr("class")).data('color', e.css('color')).find('span').eq(0).css('color', '#000').attr("class", "fa fa-spinner fa-spin");
    },
    loading:function(dump){
      $("#"+dump).html( '<div class="cssload-thecube"><div class="cssload-cube cssload-c1"></div><div class="cssload-cube cssload-c2"></div><div class="cssload-cube cssload-c4"></div><div class="cssload-cube cssload-c3"></div></div>');  
    },
     load:function(pw){  
      app.unload();     
      pw = $("#"+((pw)?pw:'page-wrapper'));        
      w7l = $('<div class="demowpa"><div class="circle"></div> <div class="circle"></div> <div class="circle"></div><div class="circle"></div><div class="circle"></div></div>');      
      w7l.css({'top':'45px','width':(pw.innerWidth()-25)});
      pw.append(w7l);
      app.tl = new TimelineMax();
      app.tl.staggerTo(".circle", 3.5, {x:($(".demowpa").innerWidth()+25), repeat:-1, repeatDelay:1.5, force3D:true, ease:SlowMo.ease.config(0.3,0.7 )}, 0.2);
      w7l.show();
    },
    unload:function(){ $('.demowpa').remove(); ;delete app.tl; },
    loaded : {},
    script : function(script, fn, object) {
        if (app.loaded[script] && app.loaded[script] == 1) {
            if (eval(script) && fn)               
                eval(script)[fn](object);              
        } else {
            $.ajax({
                type : "GET",
                url : "js/" + script + ".js",
                dataType : "script"
            }).done(function(response) {
                if (response) {
                    app.loaded[script] = 1;
                    if (fn)
                        eval(response)[fn](object);
                    else
                        eval(response);
                }
            });
        }
    },
    /** 
     * Set the events to load under request the tab content on each module and mix the defaults values with the current applied filter
     *
     * @param  object controller -> The full js controller of the actual module
     * @param  object object -> an object whith the defaults of each tab                           
     *             object mixed -> an external object to merge with the current Tab defaults
     *             int active -> the index of the tabs to show at load time
     *             string fn -> the string name of the funcion to execute when the tab is activated
     *             string dump -> the #id of the dev to dump the content of the result if 
     * @return undefined
     */
    setList:function(controller,object){
        if(!controller.filter)
             controller.currTab = {};             
        $.each(object.tabs,function(st,tab){           
            $("a[href='#"+tab.dump+"']").click(function(){ 
                 controller.currTab = $.extend(controller.currTab,tab);
            });         
            $("a[href='#"+tab.dump+"']").one( "click", function() {   
                if(st==object.active)
                    tab = $.extend(tab,object.mixed);
                controller[object.fn](tab);
            });         
        });
        $("a[href='#"+object.tabs[object.active].dump+"']").click(); 
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
    if($("#page-wrapper").length)
    app.init();
})
