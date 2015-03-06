
<!-- saved from url=(0085)https://gist.githubusercontent.com/timmcdaniels/6997612/raw/wordpress_asset_enqueuing -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1"></head><body data-pinterest-extension-installed="cr1.35"><pre style="word-wrap: break-word; white-space: pre-wrap;">&lt;?php

// hook into WordPress wp_enqueue_scripts action with a high priority
// so our function is the last to run

add_action( 'wp_enqueue_scripts', 'theme_enqueue_assets', 99999 );

// function that enqueues our CSS &amp; JavaScript

function theme_enqueue_assets() {

    // create array of stylesheets with URL and media type

    $styles = array();
    $styles['theme-style'] = array(
        'src' =&gt; get_stylesheet_directory_uri() . '/library/css/styles.css',
        'type' =&gt; 'all'
    );

    // deregister each style in array and then enqueue them

    foreach ( $styles as $style =&gt; $val ) {
        wp_deregister_style( $style );
        if ( isset( $val['src'] ) &amp;&amp; isset( $val['type'] ) )
            wp_enqueue_style( $style, $val['src'], false, false, $val['type'] );
        else wp_enqueue_style( $style );
    }

    // create array of JS libraries with their SPDY URL and dependencies

    $scripts = array();
    $scripts['jquery'] = array(
        'src' =&gt; '//cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.min.js',
        'dep' =&gt; false
    );
    $scripts['jquery-migrate'] = array(
        'src' =&gt; '//cdnjs.cloudflare.com/ajax/libs/jquery-migrate/1.2.1/jquery-migrate.min.js',
        'dep' =&gt; array( 'jquery' )
    );
    $scripts['theme-js'] = array(
        'src' =&gt; get_stylesheet_directory_uri() . '/library/js/theme.min.js',
        'dep' =&gt; array( 'jquery' )
    );

    // add comment-reply script conditionally

    if ( is_singular() &amp;&amp; comments_open() &amp;&amp; get_option( 'thread_comments' ) )
        $scripts['comment-reply'] = array();

    // deregister each script and enqueue them in footer with no versioning

    foreach ( $scripts as $script =&gt; $val ) {
        wp_deregister_script( $script );
        if ( isset( $val['src'] ) &amp;&amp; isset( $val['dep'] ) )
            wp_enqueue_script( $script, $val['src'], $val['dep'], false, true );
        else wp_enqueue_script( $script );
    }
}

?&gt;</pre><span id="buffer-extension-hover-button" style="display: none;position: absolute;z-index: 8675309;width: 100px;height: 25px;background-image: url(chrome-extension://noojglkidnpfjbincgijbaiedldjfbhh/data/shared/img/buffer-hover-icon@1x.png);background-size: 100px 25px;opacity: 0.9;cursor: pointer;"></span></body></html>