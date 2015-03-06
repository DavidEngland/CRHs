<?php

/**
 * Template Name: New OE
 * This page template shows the latest lots and land.
 *
 * @package wpSight
 * @since 1.0
 */
?> 
<?php get_header(); ?>

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
	    
	    	<?php
	    		// Set up post data
	    		 while ( have_posts() ) : the_post(); 
	    	?>
	    
			<div class="page-header post-title entry-title clearfix">			
				<h1><?php the_title(); ?></h1>
			</div><!-- .title -->
		    <div>
		
			   <?php the_content(); ?>
			
		    </div>
			<?php endwhile; ?>
	    </div><!-- #content -->
	    
	    <?php get_sidebar(  ); ?>
	
	</div><!-- #main-middle -->
	
	<?php	    
	    // Close layout wrap
	    wpsight_layout_wrap( 'main-middle-wrap', 'close' );
	    
	    // Action hook to add content after main
	    do_action( 'wpsight_main_after' );	
	?>	

</div><!-- #main-wrap -->

<?php get_footer(); ?>