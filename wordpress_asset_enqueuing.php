<?php

// hook into WordPress wp_enqueue_scripts action with a high priority
// so our function is the last to run

add_action( 'wp_enqueue_scripts', 'theme_enqueue_assets', 99999 );

// function that enqueues our CSS & JavaScript

function theme_enqueue_assets() {

    // create array of stylesheets with URL and media type

    $styles = array();
    $styles['theme-style'] = array(
        'src' => get_stylesheet_directory_uri() . '/library/css/styles.css',
        'type' => 'all'
    );

    // deregister each style in array and then enqueue them

    foreach ( $styles as $style => $val ) {
        wp_deregister_style( $style );
        if ( isset( $val['src'] ) && isset( $val['type'] ) )
            wp_enqueue_style( $style, $val['src'], false, false, $val['type'] );
        else wp_enqueue_style( $style );
    }

    // create array of JS libraries with their SPDY URL and dependencies

    $scripts = array();
    $scripts['jquery'] = array(
        'src' => '//cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.min.js',
        'dep' => false
    );
    $scripts['jquery-migrate'] = array(
        'src' => '//cdnjs.cloudflare.com/ajax/libs/jquery-migrate/1.2.1/jquery-migrate.min.js',
        'dep' => array( 'jquery' )
    );
    $scripts['theme-js'] = array(
        'src' => get_stylesheet_directory_uri() . '/library/js/theme.min.js',
        'dep' => array( 'jquery' )
    );

    // add comment-reply script conditionally

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
        $scripts['comment-reply'] = array();

    // deregister each script and enqueue them in footer with no versioning

    foreach ( $scripts as $script => $val ) {
        wp_deregister_script( $script );
        if ( isset( $val['src'] ) && isset( $val['dep'] ) )
            wp_enqueue_script( $script, $val['src'], $val['dep'], false, true );
        else wp_enqueue_script( $script );
    }
}

?>
