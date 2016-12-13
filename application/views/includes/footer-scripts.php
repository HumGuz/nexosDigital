<script src="<?php echo base_url();?>application/views/js/jquery.min.js"></script>
<!-- script for menu -->
<script>
	$("span.menu").click(function() {
		$(".list-nav").slideToggle("slow", function() {
			// Animation complete.
		});
	}); 
</script>
<!-- script for menu -->