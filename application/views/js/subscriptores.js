subscriptores = {
	initSub:function(){
		$('#side-menu').metisMenu();		
		$("[data-toggle='tooltip']").tooltip();
		if ($(".fix:not([data-fixed='true'])").length) {
			$.each($(".fix:not([data-fixed='true'])"), function(k, c) {
				app.runFixTableHead($(this));
			});
		}		
	}	
}
