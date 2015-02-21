<?php
/**
 * The default template for displaying listing content in single-listing.php
 *
 * @package wpSight
 * @since 1.0
 */
    	
// Set up post data
the_post(); ?>
    		
<div <?php post_class( 'clearfix' ); ?>>

	<?php
			// Action hook before listing content
        	do_action( 'wpsight_listing_widgets_before' ); 
			
			if( is_active_sidebar( wpsight_get_sidebar( 'listing' ) ) && ! post_password_required() ) {
				
				// Single listing widgets
				dynamic_sidebar( wpsight_get_sidebar( 'listing' ) );
				
			} else {
			
				// Enable some default widgets
        		
        		the_widget( 'wpSight_Listing_Title', 'title_favorites=1&title_print=1' );
        		
        		if( ! post_password_required() ) {
        			the_widget( 'wpSight_Listing_Image' );
        			the_widget( 'wpSight_Listing_Description', 'title=' . __( 'Description', 'wpsight' ) );
        		} else {
	        		the_content();
        		}
	    	    	
	    	} // endif is_active_sidebar()
	    	  
	    	// Action hook before listing content
	    	do_action( 'wpsight_listing_widgets_after' );
    ?>
 <div class="visible-print">
   <?php
     echo do_shortcode('[post_author]');
     echo do_shortcode('[post_date]');
    ?>
  </div>    			
</div><!-- .post-<?php the_ID(); ?> -->
