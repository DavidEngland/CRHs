<?php
/*
Template Name: Optima Express
 * CRHs' iHomeFinder's Optima Express page template.
 */
global $post; 
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
			
					<h1><?php the_title(); ?>
				
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

				// Display post content like category description
				if( ! empty( $post->post_content ) )
				  echo '<div class="category-description clearfix">' . convert_chars(wptexturize($post->post_content)) . '</div>';

				// Action hook after post content
				do_action( 'wpsight_post_content_after' );
			  ?>
			<div class="visible-print">
			  <div class="author vcard"><span class="fn">Mikko Jetsu</span></div>
			  <div class="updated"><?php the_time('d M Y'); ?></div>  
            </div>		    			
			</div><!-- .post-<?php the_ID(); ?> -->
	    
	    </div><!-- #content -->
	  
	    <?php get_sidebar( ); ?>
	
	</div><!-- #main-middle -->
	
	<?php	    
	    // Close layout wrap
	    wpsight_layout_wrap( 'main-middle-wrap', 'close' );
	    
	    // Action hook to add content after main
	    do_action( 'wpsight_main_after' );	
	?>	

</div><!-- #main-wrap -->
<script>
try {
document.getElementById("propertyType1").click();
document.getElementById("propertyType2").click();
document.getElementById("propertyType3").click();
document.getElementById("ihf-main-search-form-submit").click();
}
catch(err) { }
</script>
<?php get_footer(); ?>
