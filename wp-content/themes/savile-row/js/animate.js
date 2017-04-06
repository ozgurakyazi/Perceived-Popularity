jQuery(function($){

	$(".animated").on("inview", function(isVisible) {
	  // Event is triggered once the element becomes visible in the browser's viewport, and once when it becomes invisible
	  if (isVisible) {
		  $(this).css('visibility','visible');
		  $(this).addClass($(this).data('fx')); 
	  }
	});
});