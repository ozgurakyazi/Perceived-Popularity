( function( $ ) {

	$('#searchField').on('click', function(){
		$('#searchForm').toggleClass('is-active');
	});

  // SmoothScroll
  $(window).scroll(function(){
      if ($(this).scrollTop() < 1000) {
    $('#smoothup') .fadeOut();
      } else {
    $('#smoothup') .fadeIn();
      }
  });
  $('#smoothup').on('click', function(){
    $('html, body').animate({scrollTop:0}, 'fast');
    return false;
  });


	$(window).bind('scroll', function() {
			navStick();
	});

	function navStick(){
		var navHeight = $(window).scrollTop();
			// FIX NAV TO TOP WHEN SCROLLED >=900PX []
			if (navHeight > ($('#masthead').height()) )
		{
			$('.main-navigation').addClass('fixed');
					$('.main-navigation .menu').addClass('fixed-nav');
			}
			else {
					$('.main-navigation').removeClass('fixed');
					$('.main-navigation .menu').removeClass('fixed-nav');
			}
	}


/* ---------------------------------------------------------------- */
/* Custom select
/* ---------------------------------------------------------------- */

$('.orderby').customSelect({customClass: 'savilerowSelect'});
$('.widget select').customSelect({customClass: 'widgetSelect'});


} )( jQuery );

jQuery(document).ready(function($) {
    $(".search-toggle").click(function() {
        $(".search-container").slideToggle('300', function() {
            $('.search-toggle').toggleClass('active');
        });
        return false;
    });
});


(function() {
    var header = document.querySelector( ".main-navigation" );
    if(window.location.hash) {
      header.classList.add( "slide--up" );
    }

    new Headroom(header, {
        tolerance: {
          down : 10,
          up : 20
        },
        offset : 205,
        classes: {
          initial: "slide",
          pinned: "slide--reset",
          unpinned: "slide--up"
        }
    }).init();

}());
