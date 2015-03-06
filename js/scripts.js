jQuery(document).ready(function($) {
	
	/** SMOOTH SCROLL */
	
	$('a.smooth[href^="#"]').on('click',function (e) {
	    e.preventDefault();
	    var target = this.hash,
	    $target = $(target);
	    $('html, body').stop().animate({
	        'scrollTop': $target.offset().top
	    }, 900, 'swing' );
	});
	
	/**
	 * Enable Bootstrap
	 * Tooltip plugin
	 *
	 * @since 1.0
	 */
	 
	$('.tip').tooltip();
	$('.tip-right').tooltip({
		placement: 'right'
	});
	$('.tip-bottom').tooltip({
		placement: 'bottom'
	});
	$('.tip-left').tooltip({
		placement: 'left'
	});
	$('.tip-top').tooltip({
		placement: 'top'
	});
	
	/**
	 * Enable Bootstrap
	 * Popover plugin
	 *
	 * @since 1.0
	 */
	 
	$('.pop').popover();
	$('.pop-right').popover({
		placement: 'right'
	});
	$('.pop-bottom').popover({
		placement: 'bottom'
	});
	$('.pop-left').popover({
		placement: 'left'
	});
	$('.pop-top').popover({
		placement: 'top'
	});
	
	/**
	 * Enable Bootstrap
	 * Modal windows plugin
	 *
	 * @since 1.0
	 */
	
	$('.open-modal').click(function () {
      $('.modal').modal();
    });
	
	/**
	 * Enable prettyPrint
	 * for nice code display
	 *
	 * @since 1.0
	 */
	prettyPrint();
	
	/**
	 * Enable Superfish
	 * drop down menus
	 *
	 * @since 1.0
	 */	
	$("ul.sf-menu").supersubs({ 
        minWidth:    6,
        maxWidth:    20,
        extraWidth:  1
    }).superfish({ 
        delay:       500,
        animation:   {opacity:'show',height:'show'}, 
        speed:       200,
        autoArrows:  false,
        dropShadows: false
    });
	
	/** PROPERTY SEARCH DEFAULT */
	
	function wpsight_search_default() {
	
		var search_text = '.listing-search-text, .listing-search-field .text';
    
    	$(search_text).each(function () {
			if ($(this).val() == '') {
				$(this).val($(this).attr('title'));
			}
		}).focus(function () {
			if ($(this).val() == $(this).attr('title')) {
				$(this).val('');
			}
		}).blur(function () {
			if ($(this).val() == '') {
				$(this).val($(this).attr('title'));
			}
		});
		
		$('.listing-search form').submit(function () {
			$(search_text).each(function () {
				if ($(this).val() == $(this).attr('title')) {
					$(this).val('');
				}
			})
			return true;		
		});
	
	}
	
	wpsight_search_default();	
	
	/** ADVANCED SERACH */
	
	function wpsight_advanced_search() {
	
		if($.cookie(wpsight_localize.cookie_search_advanced) != 'closed') {
			$('.listing-search-advanced.open').show();
		}
	
		if ($.cookie(wpsight_localize.cookie_search_advanced) && $.cookie(wpsight_localize.cookie_search_advanced) == 'open') {
		    $('.listing-search-advanced').show();
		    $('.listing-search-advanced-button').addClass('open');
		}
		
		$('.listing-search-advanced-button').click(function () {
		    if ($('.listing-search-advanced').is(':visible')) {
		    	$.cookie(wpsight_localize.cookie_search_advanced, 'closed',{ expires: 60, path: wpsight_localize.cookie_path });
		        $('.listing-search-advanced div').animate(
		            {
		                opacity: '0'
		            },
		            150,
		            function(){           	
		                $('.listing-search-advanced-button').removeClass('open');
		                $('.listing-search-advanced').slideUp(150);	 
		            	$('.listing-search-filter input').attr('checked', false);
		            	$('.listing-search-price input').val('');
		            }
		        );
		    }
		    else {
		        $('.listing-search-advanced').slideDown(150, function(){
		        	$.cookie(wpsight_localize.cookie_search_advanced, 'open',{ expires: 60, path: wpsight_localize.cookie_path });
		            $('.listing-search-advanced div').animate(
		                {
		                    opacity: '1'
		                },
		                150
		            );	            
		    		$('.listing-search-advanced-button').addClass('open');
		        });
		    }   
		});
	
	}
	
	wpsight_advanced_search();
	
	function wpsight_reset_form($form) {
        $form.find('select').val('');
        $form.find('input:checkbox').removeAttr('checked');
        $form.find('input:radio[data-default="true"]').attr('checked',true);
        $('.listing-search-text, .listing-search-field .text').each(function () {
        	$(this).val($(this).attr('title'));
        });
    }
	
	function wpsight_reset_search() {
	
		$('.listing-search-reset-button').click(function () {
			wpsight_reset_form($('.listing-search form'));
			$.cookie(wpsight_localize.cookie_search_query, null, { expires: 30, path: wpsight_localize.cookie_path });
			$(this).animate({ opacity: '0' },150);
		});
	
	}
	
	wpsight_reset_search();
	
	/**
	 * Add comment form button class
	 *
	 * @since 1.1
	 */
	
	$('#commentform #submit').addClass(wpsight_localize.comment_button_class);
	
	/**
	 * tinyNav replaces menus with dropdown
	 * selects on smaller screens
	 *
	 * @since 1.0
	 */	
	$(".wpsight-menu ul").tinyNav({
	  active: 'current-menu-item'
	});
	
	/**
	 * fitVids makes videos ready
	 * for responsive layout
	 *
	 * @since 1.0
	 */
	$(".container").fitVids();
	
	/**
	 * Title order select go
	 * to URL on change option
	 *
	 * @since 1.2
	 */
	function wpsight_select_order() {
      $('.title-actions-order select').on('change', function () {
          var url = $(this).val();
          if (url) {
              window.location = url;
          }
          return false;
      });
    }
    
    wpsight_select_order();
    
    /** FAVORITES COMPARE */
	
	function wpsight_favorites_compare() {
	
		var btn = $('#favorites-compare');
		var fade = $('.page-template-page-tpl-favorites-php #content .post-teaser, .page-template-page-tpl-favorites-php #content .listing-details-overview');
		var comp = $('.listing-details-table-sc');
		
		if ($.cookie(wpsight_localize.cookie_favorites_compare) && $.cookie(wpsight_localize.cookie_favorites_compare) == 'open') {
			fade.hide();
		    comp.show();
		    btn.addClass('open');
		}
		
		btn.live('click', function() {
			if ( comp.is(':visible') ) {
				btn.removeClass('open');
		    	comp.fadeOut(100);
		    	fade.delay(100).fadeIn(100);
		    	$.cookie(wpsight_localize.cookie_favorites_compare, 'closed',{ expires: 60, path: wpsight_localize.cookie_path });
		    } else {
		    	btn.addClass('open');
		    	fade.fadeOut(100);
		    	comp.delay(100).fadeIn(100);
		    	$.cookie(wpsight_localize.cookie_favorites_compare, 'open',{ expires: 60, path: wpsight_localize.cookie_path });
		    }
		});
	
	}
	
	wpsight_favorites_compare();

});

/*global jQuery */
/*! 
* FitVids 1.0
*
* Copyright 2011, Chris Coyier - http://css-tricks.com + Dave Rupert - http://daverupert.com
* Credit to Thierry Koblentz - http://www.alistapart.com/articles/creating-intrinsic-ratios-for-video/
* Released under the WTFPL license - http://sam.zoy.org/wtfpl/
*
* Date: Thu Sept 01 18:00:00 2011 -0500
*/

(function( $ ){

  $.fn.fitVids = function( options ) {
    var settings = {
      customSelector: null
    }
    
    var div = document.createElement('div'),
        ref = document.getElementsByTagName('base')[0] || document.getElementsByTagName('script')[0];
        
  	div.className = 'fit-vids-style';
    div.innerHTML = '&shy;<style>         \
      .fluid-width-video-wrapper {        \
         width: 100%;                     \
         position: relative;              \
         padding: 0;                      \
      }                                   \
                                          \
      .fluid-width-video-wrapper iframe,  \
      .fluid-width-video-wrapper object,  \
      .fluid-width-video-wrapper embed {  \
         position: absolute;              \
         top: 0;                          \
         left: 0;                         \
         width: 100%;                     \
         height: 100%;                    \
      }                                   \
    </style>';
                      
    ref.parentNode.insertBefore(div,ref);
    
    if ( options ) { 
      $.extend( settings, options );
    }
    
    return this.each(function(){
      var selectors = [
        "iframe[src^='http://player.vimeo.com']", 
        "iframe[src^='http://www.youtube.com']", 
        "iframe[src^='http://www.kickstarter.com']", 
        "object", 
        "embed"
      ];
      
      if (settings.customSelector) {
        selectors.push(settings.customSelector);
      }
      
      var $allVideos = $(this).find(selectors.join(','));

      $allVideos.each(function(){
        var $this = $(this);
        if (this.tagName.toLowerCase() == 'embed' && $this.parent('object').length || $this.parent('.fluid-width-video-wrapper').length) { return; } 
        var height = this.tagName.toLowerCase() == 'object' ? $this.attr('height') : $this.height(),
            aspectRatio = height / $this.width();
		if(!$this.attr('id')){
			var videoID = 'fitvid' + Math.floor(Math.random()*999999);
			$this.attr('id', videoID);
		}
        $this.wrap('<div class="fluid-width-video-wrapper"></div>').parent('.fluid-width-video-wrapper').css('padding-top', (aspectRatio * 100)+"%");
        $this.removeAttr('height').removeAttr('width');
      });
    });
  
  }
})( jQuery );

(function(a){a.fn.supersubs=function(b){var c=a.extend({},a.fn.supersubs.defaults,b);return this.each(function(){var d=a(this);var e=a.meta?a.extend({},c,d.data()):c;var f=a('<li id="menu-fontsize">&#8212;</li>').css({padding:0,position:"absolute",top:"-999em",width:"auto"}).appendTo(d).width();a("#menu-fontsize").remove();$ULs=d.find("ul");$ULs.each(function(l){var k=$ULs.eq(l);var j=k.children();var g=j.children("a");var m=j.css("white-space","nowrap").css("float");var h=k.add(j).add(g).css({"float":"none",width:"auto"}).end().end()[0].clientWidth/f;h+=e.extraWidth;if(h>e.maxWidth){h=e.maxWidth}else{if(h<e.minWidth){h=e.minWidth}}h+="em";k.css("width",h);j.css({"float":m,width:"100%","white-space":"normal"}).each(function(){var n=a(">ul",this);var i=n.css("left")!==undefined?"left":"right";n.css(i,h)})})})};a.fn.supersubs.defaults={minWidth:9,maxWidth:25,extraWidth:0}})(jQuery);

/**
 * Cookie plugin
 *
 * Copyright (c) 2006 Klaus Hartl (stilbuero.de)
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 *
 */

/**
 * Create a cookie with the given name and value and other optional parameters.
 *
 * @example $.cookie('the_cookie', 'the_value');
 * @desc Set the value of a cookie.
 * @example $.cookie('the_cookie', 'the_value', { expires: 7, path: '/', domain: 'jquery.com', secure: true });
 * @desc Create a cookie with all available options.
 * @example $.cookie('the_cookie', 'the_value');
 * @desc Create a session cookie.
 * @example $.cookie('the_cookie', null);
 * @desc Delete a cookie by passing null as value. Keep in mind that you have to use the same path and domain
 *       used when the cookie was set.
 *
 * @param String name The name of the cookie.
 * @param String value The value of the cookie.
 * @param Object options An object literal containing key/value pairs to provide optional cookie attributes.
 * @option Number|Date expires Either an integer specifying the expiration date from now on in days or a Date object.
 *                             If a negative value is specified (e.g. a date in the past), the cookie will be deleted.
 *                             If set to null or omitted, the cookie will be a session cookie and will not be retained
 *                             when the the browser exits.
 * @option String path The value of the path atribute of the cookie (default: path of page that created the cookie).
 * @option String domain The value of the domain attribute of the cookie (default: domain of page that created the cookie).
 * @option Boolean secure If true, the secure attribute of the cookie will be set and the cookie transmission will
 *                        require a secure protocol (like HTTPS).
 * @type undefined
 *
 * @name $.cookie
 * @cat Plugins/Cookie
 * @author Klaus Hartl/klaus.hartl@stilbuero.de
 */

/**
 * Get the value of a cookie with the given name.
 *
 * @example $.cookie('the_cookie');
 * @desc Get the value of a cookie.
 *
 * @param String name The name of the cookie.
 * @return The value of the cookie.
 * @type String
 *
 * @name $.cookie
 * @cat Plugins/Cookie
 * @author Klaus Hartl/klaus.hartl@stilbuero.de
 */
jQuery.cookie = function(name, value, options) {
    if (typeof value != 'undefined') { // name and value given, set cookie
        options = options || {};
        if (value === null) {
            value = '';
            options.expires = -1;
        }
        var expires = '';
        if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
            var date;
            if (typeof options.expires == 'number') {
                date = new Date();
                date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
            } else {
                date = options.expires;
            }
            expires = '; expires=' + date.toUTCString(); // use expires attribute, max-age is not supported by IE
        }
        // CAUTION: Needed to parenthesize options.path and options.domain
        // in the following expressions, otherwise they evaluate to undefined
        // in the packed version for some reason...
        var path = options.path ? '; path=' + (options.path) : '';
        var domain = options.domain ? '; domain=' + (options.domain) : '';
        var secure = options.secure ? '; secure' : '';
        document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
    } else { // only name given, get cookie
        var cookieValue = null;
        if (document.cookie && document.cookie != '') {
            var cookies = document.cookie.split(';');
            for (var i = 0; i < cookies.length; i++) {
                var cookie = jQuery.trim(cookies[i]);
                // Does this cookie string begin with the name we want?
                if (cookie.substring(0, name.length + 1) == (name + '=')) {
                    cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                    break;
                }
            }
        }
        return cookieValue;
    }
};