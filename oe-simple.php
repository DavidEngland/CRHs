<?php
/*
Template Name: Optima Express Simple
* CRHs' iHomeFinder's Optima Express page template for map search.
*/

 
get_header();

// Set up post data
the_post(); ?>

<div id="main-wrap" class="wrap">

	<?php	
	    // Action hook to add content before main
	    do_action( 'wpsight_main_before' );
	    
	    // Open layout wrap
	    wpsight_layout_wrap( 'main-middle-wrap' );	    
	?>
	
	<div id="main-middle" class="row">
	
		<?php			    
	    	// Set class of #content div depending on active sidebars
	    	$content_class =  wpsight_get_span( 'big' ) ;	    	
		?>
	
	    <div id="content" class="<?php echo $content_class; ?>">				
	    
	    	<div <?php post_class( 'clearfix' ); ?>>
    
			    <?php
			    	// Action hook before post title
			        do_action( 'wpsight_post_title_before' );
			    ?>
			    
			    <h1 class="post-title title">
			    	<?php
			    		// Action hook post title inside
			       		do_action( 'wpsight_post_title_inside' );
			    		the_title();
			    	?>
			    </h1>
			    
			    <?php
			        // Action hook after post title
			        do_action( 'wpsight_post_title_after' );
			        
			        // Action hook before post content
			        do_action( 'wpsight_post_content_before' );
			    ?>
			    <?php remove_filter( 'the_content', 'wpautop' ); ?>	
			    <div class="post-teaser clearfix">
			    	<?php the_content(); ?>
			    </div>
				<?php add_filter( 'the_content', 'wpautop' ); ?>			    
			    <?php
			    	// Action hook after post content
			    	do_action( 'wpsight_post_content_after' );
			    ?>
			    			
			</div><!-- .post-<?php the_ID(); ?> -->				
			<div class="visible-print">
			  <div class="author vcard"><span class="fn">Mikko Jetsu</span></div>
			  <div class="updated"><?php the_time('d M Y'); ?></div>  
            </div>	    
	    </div><!-- #content -->
	    
	    <?php get_sidebar(); ?>
	
	</div><!-- #main-middle -->
	
	<?php	    
	    // Close layout wrap
	    wpsight_layout_wrap( 'main-middle-wrap', 'close' );
	    
	    // Action hook to add content after main
	    do_action( 'wpsight_main_after' );	
	?>	

</div><!-- #main-wrap -->

<?php get_footer(); ?>
