<?php
/*
Template Name: Event
* CRHs' single event page template.
*/

 get_header();
?>
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
		<?php
			global $post;

			$EM_Event = em_get_event($post->ID, 'post_id');
		?>	    
	    	<div <?php post_class( 'clearfix' ); ?>>
    
			    <?php
			    	// Action hook before post title
			        do_action( 'wpsight_post_title_before' );
			    ?>
			    
			    <h1 class="page-header post-title">
			    	<?php
			    		// Action hook post title inside
			       		do_action( 'wpsight_post_title_inside' );
                echo $EM_Event->output('#_EVENTNAME'); 
			    	?>
			    </h1>
			    
			    <?php
			        // Action hook after post title
			        do_action( 'wpsight_post_title_after' );
			        
			        // Action hook before post content
			        do_action( 'wpsight_post_content_before' );
			    ?>
			    <?php
			  	if( has_post_thumbnail( get_the_ID() ) ) 
			    	echo '<div class="post-image alignright">' . get_the_post_thumbnail( $post_id, 'post-thumbnail', array( 'alt' => the_title_attribute('echo=0'), 'title' => the_title_attribute('echo=0') ) ) . $overlay . '</div><!-- .post-image -->' . "\n";
	            ?>
			    <div class="post-teaser clearfix">
              <?php echo $EM_Event->output(get_option ( 'dbem_single_event_format')); ?>
			    </div>
			    
			    <?php
			    	// Action hook after post content
			    	do_action( 'wpsight_post_content_after' );
			    ?>
			    			
			</div><!-- .post-<?php the_ID(); ?> -->				
    
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
