(function( $ ) {
    'use strict';

	$(document).ready(function() {

        // Style issue for form fields
		$('textarea,input[type="text"],input[type="url"],input[type="email"]').each(function(){
			$(this).addClass( 'form-control' );
		});

        // Toggle classes when display on phone device
        // so that the mobile menu is displayed correctly
        function bindNavbar() {
            if ($(window).width() < 992) {
               
                if ($('body').hasClass('has-thumbnail')&&$('nav').hasClass('navbar-dark')) {
                  $('.navbar-toggler').click(function(){
                    $('nav').toggleClass('navbar-dark');
                    $('nav').toggleClass('navbar-light');
                    $('section.jumbotron').toggleClass('top-not');
                  });
                }
                if (!$('body').hasClass('has-thumbnail')&&!$('nav').hasClass('navbar-dark')) {
                  $('.navbar-toggler').click(function(){
                    $('section.jumbotron').toggleClass('top-not');
                  });
                }

            }
        }

        $(window).resize(function() {
            bindNavbar();
        });

        bindNavbar();

        // Navbar Dropdown on Hover event
        $( '.navbar .dropdown-menu button.dropdown-toggle' ).on( 'click', function ( e ) {
            var $el = $( this );
            var $parent = $( this ).offsetParent( ".dropdown-menu" );
            if ( !$( this ).next().hasClass( 'show' ) ) {
                $( this ).parents( '.dropdown-menu' ).first().find( '.show' ).removeClass( "show" );
            }
            var $subMenu = $( this ).next( ".dropdown-menu" );
            $subMenu.toggleClass( 'show' );
            
            $( this ).parent( "li" ).toggleClass( 'show' );

            $( this ).parents( 'li.nav-item.dropdown.show' ).on( 'hidden.bs.dropdown', function ( e ) {
                $( '.dropdown-menu .show' ).removeClass( "show" );
            } );
            
             if ( !$parent.parent().hasClass( 'navbar-nav' ) ) {
                $el.next().css( { "top": $el[0].offsetTop, "left": $parent.outerWidth() - 4 } );
            }

            return false;
        } );

        // Enable popovers and tooltips components
        $('[data-toggle="tooltip"]').tooltip();
        $('[data-toggle="popover"]').popover();

        // Adding a class to a carousel item into widgets area on the fronpage.
        $('section .carousel-item:first').addClass('active');

        // Scroll-to-Top button
        $(window).scroll(function () {
            if ($(this).scrollTop() > 50) {
                $('#back-to-top').fadeIn();
            } else {
                $('#back-to-top').fadeOut();
            }
        });
        // scroll body to 0px on click
        $('#back-to-top').click(function () {
            $('body,html').animate({
                scrollTop: 0
            }, 400);
            return false;
        });

    });

    /**
     * Cropping a text string by a fadeOut effect in the dropdown menu item
     */
    function maxSymbols ($elem, num, fadeLength) {
        var text = $elem.text(),
            temp = text.split(''),
            step,
            fade,
            result;
        
        if (!fadeLength) {
            fadeLength = 10;
        }
        
        if (temp.length < num) {
            return;
        }
        
        fade = temp.slice(num - fadeLength, num);
        temp.length = num - fadeLength;
        
        result = temp.join('');
        
        for (var i = 0; i < fadeLength; i++) {
            step = +(1 - (1 / fadeLength * i)).toFixed(1);
            result += '<span style="opacity: ' + step + '">' + fade[i] + '</span>';
        }
        
        $elem.html(result);
    }

	/**
	 *
	 * Navbar Dropdown on Hover event
	 * 
	 */
	const $dropdown = $(".navbar .dropdown");
	const $dropdownToggle = $(".navbar .dropdown-toggle");
	const $dropdownMenu = $(".navbar .dropdown-menu");
	const showClass = "show";
	 
	$(window).on("load resize", function() {
		if (this.matchMedia("(min-width: 768px)").matches) {
			$dropdown.hover(
			  function() {
			    const $this = $(this);
			    $this.addClass(showClass);
			    $this.find($dropdownToggle).attr("aria-expanded", "true");
			    $this.find($dropdownMenu).addClass(showClass);
			  },
			  function() {
			    const $this = $(this);
			    $this.removeClass(showClass);
			    $this.find($dropdownToggle).attr("aria-expanded", "false");
			    $this.find($dropdownMenu).removeClass(showClass);
			  }
			);
	        // crop text by maxSymbols func
		    $('.navbar .dropdown-item.unit-item').each(function () {
		        maxSymbols($(this), 17, 5);
		        // arguments: the character limit, 
		        // the number of characters with the fadeOut effect
		    });
		} else {
			$dropdown.off("mouseenter mouseleave");
		}
	});

   /**
    *
    * Filterable Grid 
    * 
    */
    $('.filter-menu a').click(function() {
        $('.filter-menu .active').removeClass('active');
        $(this).addClass('active');
        var strFilter = "";
        $.each($('.active'), function(i){
            strFilter += $(this).attr('data-filter');
        });
        $('.card').fadeOut(0);
        $('.card'+strFilter).fadeIn(400);
    });

})( jQuery );