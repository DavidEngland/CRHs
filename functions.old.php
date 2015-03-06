<?php
/**
 * Main functions file
 *
 * @package wpCasa
 * @subpackage CherokeeRidgeHomes
 */

add_action( 'wp_enqueue_scripts', 'dequeue_wpcasa_styles', 100 );

function dequeue_wpcasa_styles() {

	// Remove old Bootstrap 2.0.0 CSS
	wp_dequeue_style( 'bootstrap' );

	// Enqueue newer Bootstrap 2.3.2 CSS
	wp_enqueue_style( 'bootstrap', get_stylesheet_directory() . 'css/bootstrap.min.css', false, '2.3.2', 'all'  );	  
}

remove_action( 'wpcasa_header_before', 'wpcasa_do_top' );
add_action( 'after_setup_theme', 'crh_setup ');

function crh_setup() {
 /*
 * Built top bar without menu
 * and with social icons
 */
 
  add_action( 'wp_print_styles', 'crhs_remove_scripts', 100 );
  add_action( 'wpcasa_header_before', 'custom_do_top' );
  add_filter( 'wpsight_options_layout', 'crh_options_layout' );
  add_action( 'wp_enqueue_scripts', 'crhs_scripts' );
  add_action( 'wp_enqueue_scripts', 'dequeue_wpsight_styles', 100 );
  add_action( 'wp_enqueue_scripts', 'crhs_stylesheets' );
 
}

function crhs_remove_scripts() {
    wp_deregister_script( 'scripts' );
	wp_deregister_script( 'bootstrap' );
	wp_deregister_script( 'flex' );
}

function crh_scripts() {
/**
	// Enqueue jQuery
	//wp_enqueue_script( 'jquery' );
**/	
echo get_stylesheet_directory();

	// Enqueue custom scripts	
	wp_enqueue_script( 'scripts', get_stylesheet_directory() . 'js/scripts.min.js', array( 'jquery' ), '1.2.3', true );
	
	// Enqueue Bootstrap JS
	wp_enqueue_script( 'bootstrap', get_stylesheet_directory() . 'js/bootstrap.min.js', array( 'jquery' ), '2.3.2', true );

    // Enqueue GMaps3
    wp_enqueue_script( 'gmap3', get_stylesheet_directory() . 'gmap3.min.js', array( 'jquery' ), '6.0.0', true) ;

    // Enqueue SuperFish
    wp_enqueue_script( 'SuperFish', get_stylesheet_directory() . 'js/superfish.min.js', array( 'jquery' ), '1.7.4', true) ;

    // Enqueue TinyNav
    wp_enqueue_script( 'TinyNav', get_stylesheet_directory() . 'js/tinynav.min.js', array( 'jquery' ), '1.2', true) ;


/**		
	// Enqueue Prettify
	if( current_theme_supports( 'prettify' ) )
		wp_enqueue_script( 'prettify', WPSIGHT_ASSETS_JS_URL . '/prettify/prettify.js', array( 'scripts' ), '1.0', true );
	
	// Enqueue Google Maps
	if( current_theme_supports( 'gmaps' ) )
		wp_enqueue_script( 'gmaps', '//maps.google.com/maps/api/js?sensor=false', '', '4.2', false );
		
	// Enqueue Photoswipe
	if( current_theme_supports( 'PhotoSwipe' ) ) {
		wp_enqueue_script( 'photoswipe', WPSIGHT_ASSETS_JS_URL . '/photoswipe/photoswipe.js', array( 'jquery' ), '3.0.5', true );
		wp_enqueue_script( 'klass', WPSIGHT_ASSETS_JS_URL . '/photoswipe/klass.min.js', array( 'jquery' ), '3.0.5', true );
		wp_enqueue_script( 'photoswipe-code', WPSIGHT_ASSETS_JS_URL . '/photoswipe/code.photoswipe.jquery-3.0.5.min.js', array( 'jquery' ), '3.0.5', true );
	}
**/	
	// Enqueue Flexslider
	if( current_theme_supports( 'FlexSlider' ) )
		wp_enqueue_script( 'flex', get_stylesheet_directory() . 'js/jquery.flexslider-min.js', array( 'jquery' ), '2.2.2', true );
	
}

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
 * Set different default value
 * for header right in theme options
 *
 * @since 1.0
 */

function crh_options_layout( $options ) {

	$options['header_right']['std'] = '<i class="icon-phone"></i> ' . __( 'Need expert advice? Call us now - (256) 655-6629', 'wpsight' ) . "\n" . '<span id="find-home">' . __( 'find your dream home today', 'wpsight-ushuaia' ) . '</span>';
	
	return $options;

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