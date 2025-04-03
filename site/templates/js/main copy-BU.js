//$(function(){
jQuery(document).ready(function($){

	// mobile navigation
	var $lateral_menu_trigger = $('.cd-menu-trigger'),
		$content_wrapper = $('.cd-main-content'),
		$navigation = $('.masthead');

	//open-close lateral menu clicking on the menu icon
	$lateral_menu_trigger.on('click', function(event){
		event.preventDefault();
		
		$lateral_menu_trigger.toggleClass('is-clicked');
		$navigation.toggleClass('lateral-menu-is-open');
		$content_wrapper.toggleClass('lateral-menu-is-open').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
			// firefox transitions break when parent overflow is changed, so we need to wait for the end of the trasition to give the body an overflow hidden
			$('body').toggleClass('overflow-hidden');
		});
		$('#cd-lateral-nav').toggleClass('lateral-menu-is-open');
		
		//check if transitions are not supported - i.e. in IE9
		if($('html').hasClass('no-csstransitions')) {
			$('body').toggleClass('overflow-hidden');
		}
	});

	//close lateral menu clicking outside the menu itself
	$content_wrapper.on('click', function(event){
		if( !$(event.target).is('.cd-menu-trigger, #cd-menu-trigger span') ) {
			$lateral_menu_trigger.removeClass('is-clicked');
			$navigation.removeClass('lateral-menu-is-open');
			$content_wrapper.removeClass('lateral-menu-is-open').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
				$('body').removeClass('overflow-hidden');
			});
			$('#cd-lateral-nav').removeClass('lateral-menu-is-open');
			//check if transitions are not supported
			if($('html').hasClass('no-csstransitions')) {
				$('body').removeClass('overflow-hidden');
			}

		}
	});

	//open (or close) submenu items in the lateral menu. Close all the other open submenu items.
	$('.item-has-children').children('a').on('click', function(event){
		event.preventDefault();
		$(this).toggleClass('submenu-open').next('.sub-menu').slideToggle(200).end().parent('.item-has-children').siblings('.item-has-children').children('a').removeClass('submenu-open').next('.sub-menu').slideUp(200);
	});

	
	/* this just fades in the text on load */
	$('.owl-content').hide().fadeIn(400);
	


	// Shrinking Header and Scroll to Top Button
	$(window).scroll(function() {
		 if ($(window).scrollTop() > 300) {
			$("header").addClass("small");
		 } else if ($(window).scrollTop() < 300) {
			$("header").removeClass("small");
			
			$(".quick-quote").removeClass("open");
			$(".masthead").removeClass("quote-open");
			$(".cd-main-content").removeClass("quote-open");
			$(".top-quote-trigger").removeClass("up");
		 }

		 if ($(window).scrollTop() > 700) {
			$(".top-link").addClass("show");
		 } else if ($(window).scrollTop() < 700) {
			$(".top-link").removeClass("show");
		 }	
		 // Animation Effects
		 pageInView()		 
	});


/*
	$(".search-trigger").on("click", function(e){
		//$(this).toggleClass("open");
		$(".search-form").toggleClass("open");
		$(".cd-main-nav").toggleClass("fade-out");
		$(".search-query").focus();
		e.preventDefault();
	});
	
	$(".search-close").on("click", function(e){
		//$(this).toggleClass("open");
		$(".search-form").toggleClass("open");
		$(".cd-main-nav").toggleClass("fade-out");
		$(".search-query").blur();
		e.preventDefault();
	});
*/

	// Quote Form
	$(".top-quote-trigger").on("click", function(e){
		//$(this).toggleClass("open");
		$(".quick-quote").toggleClass("open");
		$(".masthead").toggleClass("quote-open");
		$(".cd-main-content").toggleClass("quote-open");
		$(".top-quote-trigger").toggleClass("up");
		e.preventDefault();
	});
	$(".cancel").on("click", function(e){
		//$(this).toggleClass("open");
		$(".quick-quote").removeClass("open");
		$(".masthead").removeClass("quote-open");
		$(".cd-main-content").removeClass("quote-open");
		$(".top-quote-trigger").removeClass("up");
		e.preventDefault();
	});


	// Sticky menus; see below.
/*
	$(".sticky").stick_in_parent({
		offset_top: 70
	});

	$('.sticky a[href^="#"]').on('click',function (e) {
	    e.preventDefault();

	    var target = this.hash;
	    var $target = $(target);

	    $('html, body').stop().animate({
	        'scrollTop': $target.offset().top-70
	    }, 900, 'swing', function () {
	        window.location.hash = target;
	    });
	});
*/

	$(".down-arrow").click(function(e) {
		e.preventDefault();
		$('html, body').animate({
			scrollTop: $("#main-content").offset().top
		}, 900);
	});
	

	// FAQ Questions
	$("h3.question").on("click", function(e){
		e.preventDefault();
		$(this).parent().find(".answer").hide('fast');
		$(this).next().slideToggle();
		$(this).toggleClass("open");
	});

	// Pop-up Forms
	$(".pop-toggle").on("click", function(e){
		e.preventDefault();
		$(this).parents(".pop-up-form").toggleClass("open");
	});

	$(".pop-up-close").on("click", function(e){
		e.preventDefault();
		$(this).parents(".pop-up-form").toggleClass("open");
	});


	// Tabbed Content
	/*
	$(".tabs-menu a").click(function(e) {
		$(this).parent().addClass("current");
		$(this).parent().siblings().removeClass("current");
		var tab = $(this).attr("href");
		
		$(this).closest('.container').find('.tab-content').css("display", "none");
		//$(".tab-content").not(tab).css("display", "none");
		$(tab).fadeIn();
		e.preventDefault();
	});
	*/

/*
	var tabs = $('.cd-tabs');

	tabs.each(function(){
		var tab = $(this),
			tabItems = tab.find('ul.cd-tabs-navigation'),
			tabContentWrapper = tab.children('ul.cd-tabs-content'),
			tabNavigation = tab.find('nav');

		tabItems.on('click', 'a', function(event){
			event.preventDefault();
			var selectedItem = $(this);
			if( !selectedItem.hasClass('selected') ) {
				var selectedTab = selectedItem.data('content'),
					selectedContent = tabContentWrapper.find('li[data-content="'+selectedTab+'"]'),
					slectedContentHeight = selectedContent.innerHeight();
				
				tabItems.find('a.selected').removeClass('selected');
				selectedItem.addClass('selected');
				selectedContent.addClass('selected').siblings('li').removeClass('selected');
				//animate tabContentWrapper height when content changes 
				tabContentWrapper.animate({
					'height': slectedContentHeight
				}, 200);
			}
		});
	});
*/

	// Remove Orphans
	/*
	$('h2').each(function(){
		if ($(window).width() > 500) {
			var string = $(this).html();
			string = string.replace(/ ([^ ]*)$/,'&nbsp;$1');
			$(this).html(string);
		}
	});
	*/

	// Top Nav Easing
	$('.top-link a, .map a').bind('click',function(event) {
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


	// Sticky Footer link
	
	if ($(window).width() > 481) {
		$('.top-link').scrollToFixed( {
			bottom: 0,
			limit: $('.top-link').offset().top,
			preFixed: function() { $(this).css('padding', '6px'); },
			postFixed: function() { $(this).css('padding', '6px'); },
		});		
	}


	$("a.read-toggle").on("click", function(){
		$(this).next().slideToggle();
		$(this).toggleClass("open");
	});


	/* ---- YOUTUBE OVERLAY -------------------------------- */
	$(".video-button").click(function(){
		$.fancybox({
			padding:		0,
			href:			this.href.replace(new RegExp("watch\\?v=", "i"), 'v/'),
			type:			'swf',
			overlayOpacity:	0.8,
			swf: {
				wmode:				'transparent',
				allowfullscreen:	'true'
			}
		});
		return false;
	});
	
	

	/* ---- Contact Forms ------------------------------- */
	new setupAjaxForm('contact-us');
	new setupAjaxForm('quote-form');
	
	/* ---- Form Stuff -------------------------------- */
	/* Contact Form */
	function setupAjaxForm(form_id, form_validations) {

		var form = '#' + form_id;
		var form_message = form + '-message';
	
		// en/disable submit button
		var disableSubmit = function(val){
			$(form + ' input[type=submit]').attr('disabled', val);
		};
	
		// setup loading message  e.preventDefault();
		$(form).ajaxSend(function(){
			$(form_message).removeClass().addClass('loading').html('Loading...').fadeIn();
		});
		
		// setup jQuery Plugin 'ajaxForm' 	
		var options = {
			dataType:  'json',
			beforeSubmit: function(){
				// run form validations if they exist
				if(typeof form_validations == "function" && !form_validations()) {
					// this will prevent the form from being submitted
					return false;
				}
				disableSubmit(true);
			},
			success: function(json){
				//alert(json.type);
				$(form_message).hide();
				$(form_message).removeClass().addClass(json.type).html(json.message).fadeIn('slow');
				$(form_message).delay(4000).fadeOut('slow');
				

				disableSubmit(false);
				if(json.type != 'error') {
					//alert(json.type+'(2)');
					$(form).clearForm();
					setTimeout(function() {
					   $(".quick-quote").removeClass("open");
				   }, 4000);
				}
			}
		};
		$(form).ajaxForm(options);
	}
});


function pageInView() {
    var a = $(window).scrollTop(), b = a + $(window).height();
    $(".about-icons").each(function() {
        pageQ1 = $(this).offset().top + $(this).height() / 4, pageQ3 = $(this).offset().top + $(this).height() / 1.3, b >= pageQ1 && pageQ3 >= a ? $(this).removeClass("is-out-of-view").addClass("is-in-view") : $(this).hasClass("is-in-view") && $(this).removeClass("is-in-view").addClass("is-out-of-view")
    })
}





/*
 Sticky-kit v1.1.2 | WTFPL | Leaf Corcoran 2015 | http://leafo.net
*/
(function(){var b,f;b=this.jQuery||window.jQuery;f=b(window);b.fn.stick_in_parent=function(d){var A,w,J,n,B,K,p,q,k,E,t;null==d&&(d={});t=d.sticky_class;B=d.inner_scrolling;E=d.recalc_every;k=d.parent;q=d.offset_top;p=d.spacer;w=d.bottoming;null==q&&(q=0);null==k&&(k=void 0);null==B&&(B=!0);null==t&&(t="is_stuck");A=b(document);null==w&&(w=!0);J=function(a,d,n,C,F,u,r,G){var v,H,m,D,I,c,g,x,y,z,h,l;if(!a.data("sticky_kit")){a.data("sticky_kit",!0);I=A.height();g=a.parent();null!=k&&(g=g.closest(k));
if(!g.length)throw"failed to find stick parent";v=m=!1;(h=null!=p?p&&a.closest(p):b("<div />"))&&h.css("position",a.css("position"));x=function(){var c,f,e;if(!G&&(I=A.height(),c=parseInt(g.css("border-top-width"),10),f=parseInt(g.css("padding-top"),10),d=parseInt(g.css("padding-bottom"),10),n=g.offset().top+c+f,C=g.height(),m&&(v=m=!1,null==p&&(a.insertAfter(h),h.detach()),a.css({position:"",top:"",width:"",bottom:""}).removeClass(t),e=!0),F=a.offset().top-(parseInt(a.css("margin-top"),10)||0)-q,
u=a.outerHeight(!0),r=a.css("float"),h&&h.css({width:a.outerWidth(!0),height:u,display:a.css("display"),"vertical-align":a.css("vertical-align"),"float":r}),e))return l()};x();if(u!==C)return D=void 0,c=q,z=E,l=function(){var b,l,e,k;if(!G&&(e=!1,null!=z&&(--z,0>=z&&(z=E,x(),e=!0)),e||A.height()===I||x(),e=f.scrollTop(),null!=D&&(l=e-D),D=e,m?(w&&(k=e+u+c>C+n,v&&!k&&(v=!1,a.css({position:"fixed",bottom:"",top:c}).trigger("sticky_kit:unbottom"))),e<F&&(m=!1,c=q,null==p&&("left"!==r&&"right"!==r||a.insertAfter(h),
h.detach()),b={position:"",width:"",top:""},a.css(b).removeClass(t).trigger("sticky_kit:unstick")),B&&(b=f.height(),u+q>b&&!v&&(c-=l,c=Math.max(b-u,c),c=Math.min(q,c),m&&a.css({top:c+"px"})))):e>F&&(m=!0,b={position:"fixed",top:c},b.width="border-box"===a.css("box-sizing")?a.outerWidth()+"px":a.width()+"px",a.css(b).addClass(t),null==p&&(a.after(h),"left"!==r&&"right"!==r||h.append(a)),a.trigger("sticky_kit:stick")),m&&w&&(null==k&&(k=e+u+c>C+n),!v&&k)))return v=!0,"static"===g.css("position")&&g.css({position:"relative"}),
a.css({position:"absolute",bottom:d,top:"auto"}).trigger("sticky_kit:bottom")},y=function(){x();return l()},H=function(){G=!0;f.off("touchmove",l);f.off("scroll",l);f.off("resize",y);b(document.body).off("sticky_kit:recalc",y);a.off("sticky_kit:detach",H);a.removeData("sticky_kit");a.css({position:"",bottom:"",top:"",width:""});g.position("position","");if(m)return null==p&&("left"!==r&&"right"!==r||a.insertAfter(h),h.remove()),a.removeClass(t)},f.on("touchmove",l),f.on("scroll",l),f.on("resize",
y),b(document.body).on("sticky_kit:recalc",y),a.on("sticky_kit:detach",H),setTimeout(l,0)}};n=0;for(K=this.length;n<K;n++)d=this[n],J(b(d));return this}}).call(this);

