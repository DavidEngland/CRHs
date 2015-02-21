<?php
/**
 * Main functions file
 *
 * @package wpCasa
 * @subpackage CherokeeRidgeHomes
 */

/**
 * Enqueue custom scripts
 */
add_action( 'wp_enqueue_scripts', 'custom_scripts' );

function custom_scripts() {
	
	wp_enqueue_script( 'scripts', get_stylesheet_directory() . '/scripts.min.js', array( 'jquery' ), '1.2.3', true );
	
	wp_enqueue_script( 'bootstrap', get_stylesheet_directory() . '/bootstrap.min.js', array( 'jquery' ), '2.3.2', true );
		
	if( current_theme_supports( 'prettify' ) )
		wp_enqueue_script( 'prettify', get_stylesheet_directory() . '/prettify/prettify.js', array( 'scripts' ), '1.0', true );
		
	if( current_theme_supports( 'PhotoSwipe' ) ) {
		wp_enqueue_script( 'klass', get_stylesheet_directory() . '/photoswipe/klass.min.js', array( 'jquery' ), '3.0.5', true );
		wp_enqueue_script( 'photoswipe', get_stylesheet_directory() . '/photoswipe/code.photoswipe.jquery-3.0.5.min.js', array( 'jquery' ), '3.0.5', true );
	}
	
	if( current_theme_supports( 'FlexSlider' ) )
		wp_enqueue_script( 'flex', get_stylesheet_directory() . '/flex/jquery.flexslider-min.js', array( 'jquery' ), '1.8', true );
	
	// Localize scripts
	$data = array( 'menu_blank' => __( 'Select a page', 'wpcasa' ), 'cookie_path' => COOKIEPATH, 'comment_button_class' => apply_filters( 'wpcasa_button_class_comment', 'btn btn-large btn-primary' )  );
	wp_localize_script( 'scripts', 'wpcasa_localize', $data );
	
}


/**
 * Register custom customizer color options
 *
 * @since 1.2
 */

remove_action( 'customize_register', 'wpsight_customize_register_color' );
add_action( 'customize_register', 'crh_customize_register_color', 11 );

function crh_customize_register_color( $wp_customize ) {
	
	// Add setting link color
	
	$wp_customize->add_setting(
		'link_color',
		array(
			'default' 		=> '#5f53bb',
			'type' 			=> 'theme_mod'
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'customize_link_color',
			array(
			    'label'    => __( 'Link Color', 'wpsight' ),
			    'section'  => 'colors',
			    'settings' => 'link_color',
			)
		)
	);

}

remove_action( 'wpcasa_header_before', 'wpcasa_do_top' );
add_action( 'wpcasa_header_before', 'custom_do_top' );

function custom_do_top() {

	// Open layout wrap
	wpsight_layout_wrap( 'top-wrap' ); ?>

	<div id="top" class="row"><?php
	
		// Check if social icons to display
		$nr = apply_filters( 'wpsight_social_icons_nr', 5 );
				
		$social_icons = array();
		
		for( $i = 1; $i <= $nr; $i++ ) {
		    $social_icons[] = wpsight_get_social_icon( wpsight_get_option( 'icon_' . $i ) );				    
		}
		
		// Remove empty elements
		$social_icons = array_filter( $social_icons );
		
		// Set top-left span accordingly
		$span = ! empty( $social_icons ) ? 'span8' : 'span12';
		
		if( has_nav_menu( 'menu-top-left' ) ) { ?>
	        		
			<div id="top-left" class="<?php echo $span; ?>">
			
				<?php echo wpsight_menu( 'top-left', false ); ?>
			
			</div><!-- #top-left --><?php
	
		}
		
		// Loop through social icons
		
		if( ! empty( $social_icons ) ) {
		
		    $i = 1;
		    
		    // Set top-right span accordingly
			$span = ! has_nav_menu( 'menu-top-left' ) ? 'span12' : 'span4';
		    
		    $output  = '<div id="top-right" class="' . $span . '">' . "\n";
		    $output .= '<div class="social-icons">' . "\n";
		    
		    foreach( $social_icons as $k => $v ) {				
		        $social_link = wpsight_get_option( 'icon_' . $i . '_link' );				    	
		        $output .= '<a href="' . $social_link . '" target="_blank" title="' . $v['title'] . '" class="social-icon social-icon-' . $v['id'] . '"><img src="' . $v['icon'] . '" alt="' . $v['title'] . '" /></a>' . "\n";				    		
		        $i++;				    		
		    }
		    
		    $output .= '</div><!-- .social-icons -->' . "\n";
		    $output .= '</div><!-- #top-right -->' . "\n";
		    
		    echo apply_filters( 'wpsight_social_icons_top', $output );
		} ?>
	
	</div><!-- #top --><?php
	
	// Close layout wrap	
	wpsight_layout_wrap( 'top-wrap', 'close' );
	        		
}


/**
 * Remove Actions
 */

/**
add_action('init', 'custom_actions_early');

function custom_actions_early() {

	remove_action( 'wp_enqueue_scripts', 'wpcasa_scripts' );

}
*/



add_action( 'wp_print_styles', 'crhs_remove_add', 100 );

function crhs_remove_add() {

	wp_dequeue_style( 'bootstrap' );	
	wp_dequeue_style( 'layout' );

	// Enqueue Bootstrap CSS
	wp_enqueue_style( 'bootstrap', get_stylesheet_directory() . '/css/bootstrap.min.css', false, '2.3.2', 'all'  );

	
	// Enqueue wpSight layout CSS
	wp_enqueue_style( 'layout', get_stylesheet_directory() . '/css/layout.min.css', false, WPSIGHT_VERSION, 'all'  );

/**
	wp_deregister_script( 'bootstrap' );
		// Enqueue Bootstrap JS
	wp_enqueue_script( 'bootstrap', get_stylesheet_directory() . '/js/bootstrap.min.js', array( 'jquery' ), '2.3.2', true );
*/
}
add_shortcode( 'social_links', 'custom_social_links_shortcode' );

function custom_social_links_shortcode( $atts ) {

	$defaults = array( 
	    'before' => '',
	    'after'  => '',
	    'first'  => '',
	    'wrap'	 => ''
	);
	
	extract( shortcode_atts( $defaults, $atts ) );

	// Loop through social icons

	$nr = apply_filters( 'wpcasa_social_icons_nr', 5 );
	
	$social_icons = array();
	
	for( $i = 1; $i <= $nr; $i++ ) {				    
		$social_icons[] = wpsight_get_social_icon( wpcasa_get_option( 'icon_' . $i ) );				    
	}
	
	// Remove empty elements
	$social_icons = array_filter( $social_icons );
	
	$output = '<div class="svg">';
	
	if( ! empty( $social_icons ) ) {					
		$i = 1;														
		foreach( $social_icons as $k => $v ) {
		    $social_icon_class = $v['id'];
		    if ( $social_icon_class == 'gplus' ) $social_icon_class = 'googleplus';
		    $social_icon_class .= ' small';
		    $social_link = wpcasa_get_option( 'icon_' . $i . '_link' );	
			$output .= '<a href="' . $social_link . '" target="_blank" title="' . $v['title'] . '" class="webicon ' . $social_icon_class . '">' . $v['title'] . '</a>' . "\n";				    		
			$i++;				    		
		}				    
	} else {
		$social_icon = wpcasa_get_social_icon( 'rss' );
		$output .= '<a href="' . get_bloginfo_rss( 'rss2_url' ) . '" target="_blank" title="' . $social_icon['title'] . '" class="social-icon social-icon-' . $social_icon['id'] . '"><img src="' . $social_icon['icon'] . '" alt="" /></a>' . "\n";
	}
	
	$output .= '</div><!-- .social-icons -->';
	
	$output = sprintf( '%1$s%3$s%2$s', $before, $after, apply_filters( 'loginout', $output ) );

	return apply_filters( 'custom_social_links_shortcode', $output, $atts );
				
}
