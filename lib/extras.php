<?php
/**
 * Extras
 *
 * @package      Material Genesis
 * @since        0.0.1
 * @link         http://webdevsuperfast.github.io
 * @author       Rotsen Mark Acob <webdevsuperfast.github.io>
 * @copyright    Copyright (c) 2018, Rotsen Mark Acob
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
*/

// Add additional classes for Bootstrap
add_filter( 'mg_add_classes', function( $classes ) {
    $new_classes = array(
        'content-sidebar-wrap' => 'row',
        'content' => 'col-md-8',
        'sidebar-primary' => 'col-md-4',
        'entry-content' => 'clearfix',
        'structural-wrap' => 'container',
        'entry-image' => 'img-fluid',
        'site-inner' => 'container',
        'nav-primary' => 'navbar navbar-expand-lg navbar-dark primary-color',
        'title-area' => 'col-md-4',
        'header-widget-area' => 'col-md-8 d-flex align-items-center',
        'site-description' => 'screen-reader-text'
    );

    return wp_parse_args( $new_classes, $classes );
} );

// filter menu args for bootstrap walker and other settings
add_filter( 'wp_nav_menu_args', 'mg_nav_menu_args_filter' );
function mg_nav_menu_args_filter( $args ) {

    require_once( MG_MODULES . 'class-wp-bootstrap-navwalker.php' );
    
    if ( 'primary' === $args['theme_location'] ) {
        $args['container'] = false;
        $args['depth'] = 1;
        $args['menu_class'] = 'navbar-nav mr-auto';
        $args['fallback_cb'] = 'WP_Bootstrap_Navwalker::fallback';
        // $args['walker'] = new WP_Bootstrap_Navwalker();
    }
    return array_merge( $args, array(
        'walker' => new WP_Bootstrap_Navwalker()
    ) );
}

// add bootstrap markup around the nav
add_filter( 'wp_nav_menu', 'mg_nav_menu_markup_filter', 10, 2 );
function mg_nav_menu_markup_filter( $html, $args ) {
    // only add additional Bootstrap markup to primary navigation
    if ( 'primary' !== $args->theme_location ) {
        return $html;
    }

    $data_target = 'nav' . sanitize_html_class( '-' . $args->theme_location );
    
    $output = '';
    $output .= '<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#'.$data_target.'" aria-controls="'.$data_target.'" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>';
    $output .= '<div class="collapse navbar-collapse" id="'.$data_target.'">';
    $output .= $html;
    $output .= '</div>';
    
    return $output;
}

add_filter( 'widget_nav_menu_args', function( $args ) {
    return array_merge( $args, array(
        'menu_class' => 'nav'
    ) );
} );