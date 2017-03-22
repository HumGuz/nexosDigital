admin = {
	init:function(){
		$('#side-menu').metisMenu();		
		$("[data-toggle='tooltip']").tooltip();	
		$('.modal').on('hidden.bs.modal',function(){
				if($(".modal.fade.in").length)
					$('body').addClass('modal-open');
		});	
		$( document ).ajaxComplete(function( event, xhr, data) {            
            if(data.dataType=='html')            
                if($(".tab-body:visible .fix:not([data-fixed='true']),.modal .fix:not([data-fixed='true'])").length ){                
                    $.each($(".tab-body:visible .fix:not([data-fixed='true']),.modal .fix:not([data-fixed='true'])"),function(k,c){                        
                        app.runFixTableHead($(this));
                    });
                }
        });   
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
	},		
};
