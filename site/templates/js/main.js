//$(function(){
// Hickton
$(document).ready(function($){

    if ($('body').hasClass('fees-and-costs')) {
        $('.hero').hide();  
        console.log('check'); 
    }

	// mobile navigation
	$(".menu-trigger").click(function(){
		//alert('fuck nuts');
		$("#page").toggleClass("open");
		$("#sidenav").toggleClass("open");
		$(".overlay").toggleClass("open");
		$(this).toggleClass("is-clicked");
		return false;
	});
	$(".overlay, .close").on("click", function(event){
		$("#page").removeClass("open");
		$("#sidenav").removeClass("open");
		$(".overlay").removeClass("open");
		$("#page").removeClass("quote-open");
		$(".top-quote-trigger").removeClass("up");
		$(".quick-quote").removeClass("open");
		$(".menu-trigger").removeClass("is-clicked");
		return false;
	});
	
	/* ---- Navigation Toggle (Mobiles) ------------------------ */
	$(".menu-toggle").click(function(){
		//$('.nav-wrapper').toggleClass('is-open');
		$('#cart').removeClass('is-open');
		$('#sidenav').toggleClass('is-open');
		$('#page').toggleClass('is-open');
		$('.page-header').toggleClass('is-open');
		$('.page-overlay').toggleClass('is-open');
		$(this).toggleClass("is-clicked");
		return false;
	});

	/* Side/Mobile Navigation: submenu items in the lateral menu. Close all the other open submenu items. */
	$('.side-nav .has-children').children('a').on('click', function(event){
		event.preventDefault();
		$(this).toggleClass('submenu-open').next('.subnav').slideToggle(200).end().parent('.has-children').siblings('.has-children').children('a').removeClass('submenu-open').next('.subnav').slideUp(200);
	});
	
	/*
	//open (or close) submenu items in the lateral menu. Close all the other open submenu items.
	$('.item-has-children').children('a').on('click', function(event){
		event.preventDefault();
		$(this).toggleClass('submenu-open').next('.sub-menu').slideToggle(200).end().parent('.item-has-children').siblings('.item-has-children').children('a').removeClass('submenu-open').next('.sub-menu').slideUp(200);
	});
	*/
	
	/* this just fades in the text on load */
	$('.owl-content').hide().fadeIn(400);
	

	// Shrinking Header and Scroll to Top Button
	$(window).scroll(function() {
		 if ($(window).scrollTop() > 100) {
			$("header").addClass("is-fixed");
		 } else if ($(window).scrollTop() < 100) {
			$("header").removeClass("is-fixed");
		 }

		 if ($(window).scrollTop() > 700) {
			$(".top-link").addClass("show");
		 } else if ($(window).scrollTop() < 700) {
			$(".top-link").removeClass("show");
		 }	
		 // Animation Effects
		 //pageInView()		 
	});


	$(".down-arrow").click(function(e) {
		e.preventDefault();
		$('html, body').animate({
			scrollTop: $("#main-content").offset().top
		}, 900);
	});

	/* --- Simple Contact Form --- */
	if ($('.js-simplecontactform').length) {
		$.simplecontactform($('.js-simplecontactform'));
	}
	
    if ($('.js-simplecontactform').length) {
    	var htmlToReplace = "I agree to the <a href='/terms-conditions/' >terms and conditions</a> and <a href='/gdpr-policies/' >privacy policy</a>.";
    	$('#wrap_Inputfield_c_terms_consent span.pw-no-select').replaceWith(htmlToReplace);
		//$("#wrap_Inputfield_submit").append( "<img src='/site/templates/images/dots@2x.gif' class='submit-spinner' alt='wait' />" );
    }
    
    $('#Inputfield_submit').bind('click', function(event) {
        $('.ui-button-text').after('&nbsp;&nbsp;<i class="fa fa-circle-o-notch fa-spin"></i>');
    });
    
    // Add Choose Text to select menu
	if ($('#Inputfield_c_locations').length) {
    	var firstSelect = '<option value="">Choose an option...</option>';
    	$('#Inputfield_c_locations').find('option:eq(0)').replaceWith(firstSelect);
    }
    
    $(document).ajaxStart(function() {
		$("#Inputfield_submit").prop('disabled', true);
		//$('.ui-button-text').after('&nbsp;&nbsp;<i class="fa fa-circle-o-notch fa-spin"></i>');
	}).ajaxStop(function() {
		$("#Inputfield_submit").prop('disabled', false);
	});
    
    $('.form--error--message').show().delay(5000).fadeOut();


	// Top Nav Easing
	$('.top-link a, .map a, .bubbles a').bind('click',function(event) {
		var $anchor = $(this);
	
		$('html, body').stop().animate({
			//scrollTop: $($anchor.attr('href')).offset().top-35
			scrollTop: $($anchor.attr('href')).offset().top
		}, 1000,'easeOutExpo');
	
		/*
		if you don't want to use the easing effects:
		$('html, body').stop().animate({
			scrollTop: $($anchor.attr('href')).offset().top
		}, 1000);
		*/
		event.preventDefault();
	});
	
	
	/* --- Gallery / Isotope / Filtering ---- */
	var $grid = $('.grid').imagesLoaded( function() {
	// init Isotope after all images have loaded
		$grid.isotope({
			// options
			itemSelector: '.grid-item',
			percentPosition: true,
			stagger: 30,
			masonry: {
				// use element for option
				columnWidth: '.grid-sizer',
				gutter: '.gutter-sizer'
			}
		});
	});
	/*
	$grid.imagesLoaded().progress( function() {
		$grid.isotope('layout');
	});
	*/

	var columns;
	setColumns();

	// rerun function when window is resized 
	$(window).on('resize', function() {
		setColumns();
	});

	// the function to decide the number of columns
	function setColumns() {
		if($(window).width() <= 768) {
			columns = 2;
		} else {
			columns = 4;
		}
	}
	
	
	$("#filter-menu").click(function() {
        $("#submenu").slideToggle(100);
    });
	
	$(".rplg").each(function() {
        $(this).css( "width", 'auto');
    });
    
	$("#review-menu").click(function() {
        $("#submenu2").slideToggle(100);
    });
    
    
	$('.rplg-badge-cnt').on('click', function(e){
		//$(this).removeAttr('onclick'); // add this line to remove inline onclick
		//if(formChanged){
			alert('...');
			e.preventDefault();
			$(this)[0].onclick = null;
		//}       
	});
    //.rplg-badge2
	
	/* TABS */
	/*
	$('.tabs-content li[data-content="tab-1"').each(function() {
        $(this).addClass('selected');
    });
    $('.tabs-navigation li:first-of-type').each(function() {
        $(this).find('a').addClass('selected');
    });
    var tabs = $('.filter-tabs');
    tabs.each(function() {
        var tab = $(this),
            tabItems = tab.find('ul.tabs-navigation'),
            tabContentWrapper = tab.children('ul.tabs-content'),
            tabNavigation = tab.find('nav');

        tabItems.on('click', 'a.tab-link', function(event) {
            event.preventDefault();
            var selectedItem = $(this);
            $("#submenu").slideToggle(100);
            if (!selectedItem.hasClass('selected')) {
                var selectedTab = selectedItem.data('content'),
                    selectedContent = tabContentWrapper.find('li[data-content="' + selectedTab + '"]'),
                    selectedContentHeight = selectedContent.innerHeight() + 120;
                    //selectedContentHeight = tabContentWrapper.innerHeight();

                tabItems.find('a.selected').removeClass('selected');
                selectedItem.addClass('selected');
                selectedContent.addClass('selected').siblings('li').removeClass('selected');
                //animate tabContentWrapper height when content changes 
                tabContentWrapper.animate({
                    'height': selectedContentHeight
                }, 200);
                
                $('.google-reviews').css( "height", selectedContentHeight+420+"px" );
            }

			$('html, body').stop().animate({
				//scrollTop: $(tab.attr('id')).offset()
			}, 600);            
        });
    });
    */
	/*
    //$('.filter-tabs').on('click','.rplg-url',function(ev){
    $('body').on('click','.rplg-reviews + a',function(ev){
		//var divHeight = $(".selected .tr-widget").height();
		var divHeight = $(".selected .rplg-grid").height();
		//var theHeight = $(this).find('.rplg-grid').height();
		//alert(divHeight);
		//var tabContentWrapper = tab.children('ul.tabs-content'),
        $('.google-reviews').css( "height", "+=1100px" );
        //$('.google-reviews').css( "height", ""+divHeight+"+1100px" );
    });
    */
	
});