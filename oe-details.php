<?php
/*
Template Name: Optima Express Details
 * CRHs' iHomeFinder's Optima Express page template.
 */
global $post;
/**
// Create post object
$my_post = array(
  'post_title'    => 'My post',
  'post_content'  => $post->post_content,
  'post_status'   => 'publish',
  'post_author'   => 4,
  'post_category' => array(61)
);

// Insert the post into the database
wp_insert_post( $my_post );
$post_id = wp_insert_post( $post, $wp_error );

**/
get_header(); ?>

<div id="main-wrap" class="wrap">	

	<?php	
	    // Action hook to add content before main
	    do_action( 'wpsight_main_before' );
	    
	    // Open layout wrap
	    wpsight_layout_wrap( 'main-middle-wrap' );	    
	?>
	
	<div id="main-middle" class="row">
	
		<?php
		$content_class = wpsight_get_span( 'big' );
		?>
 
	    <div id="content" class="<?php echo $content_class; ?>">
	    
	    	<div <?php post_class( 'clearfix' ); ?>>
    
			    <?php
			    	// Action hook before post title
			        do_action( 'wpsight_post_title_before' );
			    ?>
			    
			    <div class="page-header entry-title clearfix">
			
					<h1> <?php the_title(); ?>
				
				    <?php			    	
				    	// Action hook to add content to title
				    	do_action( 'wpsight_loop_title_actions' );
				    	
				    ?></h1>
				
				</div><!-- .title -->
			  
			  <?php
				// Action hook after post title
				do_action( 'wpsight_post_title_after' );

				// Action hook before post content
				do_action( 'wpsight_post_content_before' );


				if( ! empty( $post->post_content ) ) {
					$content = convert_chars(wptexturize($post->post_content));
				//   $content = add_lazyload($content);
				// Display post content like category description

				  echo '<div class="post-teaser clearfix">' . $content . '</div>';
				  
				}

				// Action hook after post content
				do_action( 'wpsight_post_content_after' );
			  ?>
			<div class="visible-print">
			  <div class="author vcard"><span class="fn">Mikko Jetsu</span></div>
			  <div class="updated"><?php the_time('d M Y'); ?></div>  
            </div>		    			
			</div><!-- .post-<?php the_ID(); ?> -->
		  <!-- .post_class-<?php post_class(); ?> -->
	    
	    </div><!-- #content -->
      <?php wp_reset_postdata(); ?>
	  <?php get_sidebar( ); ?>
	
	</div><!-- #main-middle -->
	
	<?php	    
	    // Close layout wrap
	    wpsight_layout_wrap( 'main-middle-wrap', 'close' );
	    
	    // Action hook to add content after main
	    do_action( 'wpsight_main_after' );	
	?>	

</div><!-- #main-wrap -->

<?php get_footer(); ?>
<script type="text/javascript">
/* <![CDATA[ */
  /* ========================================================================
 * Bootstrap: carousel.js v3.0.3
 * http://getbootstrap.com/javascript/#carousel
 * ========================================================================
 * Copyright 2013 Twitter, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ======================================================================== */


+function ($) { "use strict";

  // CAROUSEL CLASS DEFINITION
  // =========================

  var Carousel = function (element, options) {
    this.$element    = $(element)
    this.$indicators = this.$element.find('.carousel-indicators')
    this.options     = options
    this.paused      =
    this.sliding     =
    this.interval    =
    this.$active     =
    this.$items      = null

    this.options.pause == 'hover' && this.$element
      .on('mouseenter', $.proxy(this.pause, this))
      .on('mouseleave', $.proxy(this.cycle, this))

    // LAZY LOAD START
    var that = this

    this.loading = this.$element.find('.loading')
    this.lazy_elements = this.$element.find('.item img[cachedsource]')
    this.lazy_elements.load(function(){
        var $this = $(this)
        $this.attr('lazy-load', 'success')
        that.$element.trigger('slid.bs.load.success')
        that.resume($this)
    })
    .error(function(){
        var $this = $(this)
        $this.attr('lazy-load', 'error')
        that.$element.trigger('slid.bs.load.error')
        that.resume($this)
    })
    // LAZY LOAD END
  }

  Carousel.DEFAULTS = {
    interval: 5000
  , pause: 'hover'
  , wrap: true
  }

  Carousel.prototype.cycle =  function (e) {
    e || (this.paused = false)

    this.interval && clearInterval(this.interval)

    this.options.interval
      && !this.paused
      && (this.interval = setInterval($.proxy(this.next, this), this.options.interval))

    return this
  }

  Carousel.prototype.getActiveIndex = function () {
    this.$active = this.$element.find('.item.active')
    this.$items  = this.$active.parent().children()

    return this.$items.index(this.$active)
  }

  Carousel.prototype.to = function (pos) {
    var that        = this
    var activeIndex = this.getActiveIndex()

    if (pos > (this.$items.length - 1) || pos < 0) return

    if (this.sliding)       return this.$element.one('slid.bs.carousel', function () { that.to(pos) })
    if (activeIndex == pos) return this.pause().cycle()

    return this.slide(pos > activeIndex ? 'next' : 'prev', $(this.$items[pos]))
  }

  Carousel.prototype.pause = function (e) {
    e || (this.paused = true)

    if (this.$element.find('.next, .prev').length && $.support.transition.end) {
      this.$element.trigger($.support.transition.end)
      this.cycle(true)
    }

    this.interval = clearInterval(this.interval)

    return this
  }

  Carousel.prototype.next = function () {
    if (this.sliding) return
    return this.slide('next')
  }

  Carousel.prototype.prev = function () {
    if (this.sliding) return
    return this.slide('prev')
  }

  // LAZY LOAD START
  Carousel.prototype.load = function (img) {
    this.sliding = false
    this.loading.removeClass('hide')

    img.attr('src', img.attr('cachedsource'))
    img.removeAttr('cachedsource')
    img.attr('lazy-load', 'loading')
    this.$element.trigger('slid.bs.load')
  }

  Carousel.prototype.resume = function (img) {
    var $next = img.parents('.item')
      , children = $next.parents('.carousel-inner').children()
      , nextPos = children.index($next)

    this.loading.addClass('hide')
    this.to(nextPos)

    this.options.interval && this.cycle()
  }
  // LAZY LOAD END

  Carousel.prototype.slide = function (type, next) {
    var $active   = this.$element.find('.item.active')
    var $next     = next || $active[type]()
    var isCycling = this.interval
    var direction = type == 'next' ? 'left' : 'right'
    var fallback  = type == 'next' ? 'first' : 'last'
    var that      = this

    if (!$next.length) {
      if (!this.options.wrap) return
      $next = this.$element.find('.item')[fallback]()
    }

    this.sliding = true

    isCycling && this.pause()

    var e = $.Event('slide.bs.carousel', { relatedTarget: $next[0], direction: direction })

    if ($next.hasClass('active')) return

    //LAZY LOAD START
    var $nextLazyImg = $next.find('img[cachedsource]')
    if ($nextLazyImg.length) {
        this.load($nextLazyImg)
        return
    }
    // LAZY LOAD END

    if (this.$indicators.length) {
      this.$indicators.find('.active').removeClass('active')
      this.$element.one('slid.bs.carousel', function () {
        var $nextIndicator = $(that.$indicators.children()[that.getActiveIndex()])
        $nextIndicator && $nextIndicator.addClass('active')
      })
    }

    if ($.support.transition && this.$element.hasClass('slide')) {
      this.$element.trigger(e)
      if (e.isDefaultPrevented()) return
      $next.addClass(type)
      $next[0].offsetWidth // force reflow
      $active.addClass(direction)
      $next.addClass(direction)
      $active
        .one($.support.transition.end, function () {
          $next.removeClass([type, direction].join(' ')).addClass('active')
          $active.removeClass(['active', direction].join(' '))
          that.sliding = false
          setTimeout(function () { that.$element.trigger('slid.bs.carousel') }, 0)
        })
        .emulateTransitionEnd(600)
    } else {
      this.$element.trigger(e)
      if (e.isDefaultPrevented()) return
      $active.removeClass('active')
      $next.addClass('active')
      this.sliding = false
      this.$element.trigger('slid.bs.carousel')
    }

    isCycling && this.cycle()

    return this
  }


  // CAROUSEL PLUGIN DEFINITION
  // ==========================

  var old = $.fn.carousel

  $.fn.carousel = function (option) {
    return this.each(function () {
      var $this   = $(this)
      var data    = $this.data('bs.carousel')
      var options = $.extend({}, Carousel.DEFAULTS, $this.data(), typeof option == 'object' && option)
      var action  = typeof option == 'string' ? option : options.slide

      if (!data) $this.data('bs.carousel', (data = new Carousel(this, options)))
      if (typeof option == 'number') data.to(option)
      else if (action) data[action]()
      else if (options.interval) data.pause().cycle()
    })
  }

  $.fn.carousel.Constructor = Carousel


  // CAROUSEL NO CONFLICT
  // ====================

  $.fn.carousel.noConflict = function () {
    $.fn.carousel = old
    return this
  }


  // CAROUSEL DATA-API
  // =================

  $(document).on('click.bs.carousel.data-api', '[data-slide], [data-slide-to]', function (e) {
    var $this   = $(this), href
    var $target = $($this.attr('data-target') || (href = $this.attr('href')) && href.replace(/.*(?=#[^\s]+$)/, '')) //strip for ie7
    var options = $.extend({}, $target.data(), $this.data())
    var slideIndex = $this.attr('data-slide-to')
    if (slideIndex) options.interval = false

    $target.carousel(options)

    if (slideIndex = $this.attr('data-slide-to')) {
      $target.data('bs.carousel').to(slideIndex)
    }

    e.preventDefault()
  })

  $(window).on('load', function () {
    $('[data-ride="carousel"]').each(function () {
      var $carousel = $(this)
      $carousel.carousel($carousel.data())
    })
  })

}(jQuery);
/* ]]> */
</script>