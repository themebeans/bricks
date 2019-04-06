// IF JS IS ENABLED, REMOVE 'no-js' AND ADD 'js' CLASS
jQuery('html').removeClass('no-js').addClass('js');

jQuery(document).ready(function($) {

	//FITVIDS
	$("body").fitVids();

	//PROJECT FILTER
	var overContainer = $('.project-filter'),
	    overTrigger = $('#filter-toggle')
	    mobileFilter = $('.mobile-project-filter'),

	overTrigger.toggle(function(){
		overContainer.slideDown(parseInt(200));
		mobileFilter.addClass( "open" );
	}, function(){
		overContainer.slideUp(parseInt(200));
		mobileFilter.removeClass( "open" );
	});

	//PROJECT FILTERING
	$('#projects.projects-grid').mixItUp({
		animation: {
			duration: 400,
			effects: 'stagger(34ms) fade',
			easing: 'cubic-bezier(0.55, 0.085, 0.68, 0.53)'
		}
	});

	//PROJECT FULLWIDTH LAZY LOADING
	if ($('body').hasClass('page-template-template-portfolio-fullwidth-php')) {
     	$(".projects-fullwidth img").unveil(300, function() {
			$(this).load(function() {
				this.style.opacity = 1;
			});
		});
    }

    	//PROJECT SLIDER BACKGROUNDCHECK
	if ($('body').hasClass('page-template-template-portfolio-slider-php')) {
	    	BackgroundCheck.init({
			targets: '.header, .slides-pagination, #nav-toggle',
			images: '.attachment-port-full'
		});
    	}

	//DROPDOWNS - SUPERFISH
	$('.header ul')
		.superfish({
    		delay: 100,
    		animation: { opacity:'show', height:'show' },
    		speed: 150,
    		cssArrows: false,
    		disableHI: true
	});

	//THEME STRUCTURE
	! function(a) {
	    "use strict";
	    a(document).ready(function() {

	    		var pageHeight = jQuery(window).height();

			if( a("body").hasClass('page-template-template-portfolio-grid-lightbox-php') ) {
				$('.content-wrapper.row').css({ "height": pageHeight + 'px' });
			}

			a(window).resize(function(){

			var pageHeight = jQuery(window).height();

		   	if( a("body").hasClass('page-template-template-portfolio-grid-lightbox-php') ) {
				$('.content-wrapper.row').css({ "height": pageHeight + 'px' });
			}

			});
	    })
	}(window.jQuery);

	//LIGHTBOX TRIGGER
	$(".lightbox").fancybox({
	});

	//AUDIO INIT
	Bean_Media.setupAudioPosts();

	//COMMENTS
	var $commentform = $('#commentform');
	if ( $commentform.length ) {
		var commentformHeight = $commentform.height(),
			$cancelComment = $('#cancel-comment'),
			$commentTextarea = $('#comment');
		$commentTextarea.css({
			height : 48
		});
		$commentform.css({
			height : 48,
			overflow : 'hidden'
		}).on('click', function() {
			var $this = $(this);
			$this.animate({
				height : commentformHeight,
			}, 300);
			$commentTextarea.css({
				height : 'auto',
				overflow : 'visible'
			});
			$cancelComment.on('click', function(e) {
				e.preventDefault();
				$this.animate({
					height : 48,
				}, 300, function(){
					$commentTextarea.css({
						height : 48,
						overflow : 'hidden'
					});
				});
				return false;
			});
		});
	}

	//FLYOUT SIDEBAR
	$( "#nav-toggle, .sidebar-close, .nav-overlay" ).click( function(e) {
		$( ".content-wrapper" ).toggleClass( "open" );
		$( "#hidden-sidebar" ).toggleClass( "open" );
		$( "#nav-toggle" ).toggleClass( "active" );
		$( ".nav-overlay" ).toggleClass( "open" );
		return false;
	} );
});


jQuery(window).load(function() {
	timer = setInterval(function(){
		$notLoaded = jQuery("#projects.projects-grid .project").not(".loaded");
		$notLoaded.eq(Math.floor(Math.random()*$notLoaded.length)).fadeIn().addClass("loaded");
		if ($notLoaded.length == 0) { clearInterval(timer); }
	}, 50);
});


// FUNCTIONS FOR HANDLING POSTS OF TYPE 'AUDIO' AND 'VIDEO'
var Bean_Media = {
	setupAudioPosts: function() {

		if(jQuery().jPlayer) {
			jQuery(".jp-audio").each(function() {
				var mp3 = jQuery(this).data("file");
				var cssSelectorAncestor = '#' + jQuery(this).attr("id");

				jQuery(this).find(".jp-jplayer").jPlayer( {
					ready : function () {
							jQuery(this).jPlayer("setMedia", {
							mp3: mp3,
							end: ""
						});
					},
					size: {
					    width: "100%",
					},
					swfPath: WP_TEMPLATE_DIRECTORY_URI[0] + "/assets/js",
					cssSelectorAncestor: cssSelectorAncestor,
					supplied: (mp3 ? "mp3": "") + ", all"
				});
			});
		}
		jQuery(".jp-audio .jp-interface").css("display", "block");
	}
};