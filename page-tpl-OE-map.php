<?php
/*
Template Name: OE map
* CRHs' iHomeFinder's Optima Express page template for map search.
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
	
	<div id="content" class="span8">
	  
	  <div <?php post_class( 'clearfix' );
	  ?>>
		
		<?php
// Action hook before post title
do_action( 'wpsight_post_title_before' );
		?>
		
		<div class="title title-archive clearfix">
		  
		  <h1><?php the_title();
			?></h1>
		  
		  <?php			    	
// Action hook to add content to title
do_action( 'wpsight_loop_title_actions' );

		  ?>
		  
		</div><!-- .title -->
		
		<?php
// Action hook after post title
do_action( 'wpsight_post_title_after' );

// Action hook before post content
do_action( 'wpsight_post_content_before' );

// Display post content like category description
if( ! empty( $post->post_content ) )
  echo '<div class="category-description clearfix">' . wpsight_format_content( $post->post_content ) . '</div>';

// Action hook after post content
do_action( 'wpsight_post_content_after' );
		?>
		
	  </div><!-- .post-<?php the_ID();
?> -->
	  <div class="visible-print">
		<?php		  
echo do_shortcode('[optima_express_map_search height=0 address="4000 Cherokee Ridge Dr., Union Grove AL 35175" zoom=12]');

		?>
	  </div>
	</div><!-- #content -->
	<?php get_sidebar( );
	?>	
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