<?php
/**
 * Misc
 *
 * @package      Material Genesis
 * @since        0.0.1
 * @link         http://webdevsuperfast.github.io
 * @author       Rotsen Mark Acob <webdevsuperfast.github.io>
 * @copyright    Copyright (c) 2018, Rotsen Mark Acob
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
*/

// Custom Image Function
function mg_post_image() {
	global $post;
	$image = '';
	$image_id = get_post_thumbnail_id( $post->ID );
	$image = wp_get_attachment_image_src( $image_id, 'full' );
	$image = $image[0];
	if ( $image ) return $image;
	return mg_get_first_image();
}

// Get the First Image Attachment Function
function mg_get_first_image() {
	global $post, $posts;
	$first_img = '';
	ob_start();
	ob_end_clean();
	$output = preg_match_all( '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches );
	$first_img = "";
	if ( isset( $matches[1][0] ) )
		$first_img = $matches[1][0];
	return $first_img;
}

//* This will occur when the comment is posted
function mg_comment_post( $incoming_comment ) {
    // convert everything in a comment to display literally
    $incoming_comment['comment_content'] = htmlspecialchars($incoming_comment['comment_content']);
    // the one exception is single quotes, which cannot be #039; because WordPress marks it as spam
    $incoming_comment['comment_content'] = str_replace( "'", '&apos;', $incoming_comment['comment_content'] );
    return( $incoming_comment );
}

//* This will occur before a comment is displayed
function mg_comment_display( $comment_to_display ) {
    // Put the single quotes back in
    $comment_to_display = str_replace( '&apos;', "'", $comment_to_display );
    return $comment_to_display;
}

//* Remove query string from static files
function mg_remove_cssjs_ver( $src ) {
    if( strpos( $src, '?ver=' ) )
    $src = remove_query_arg( 'ver', $src );
    return $src;
}

add_action( 'genesis_meta', function() {
	$wraps = array(
        'footer-widgets' => '',
        'header' => '',
    );

    foreach( array_keys( $wraps ) as $context ) {
        $context = "genesis_structural_wrap-$context";
        // var_dump($context);
        add_filter( $context, 'bg_filter_structural_wrap', 10, 2 );
    }
} );

// Add .row div after .container div
function bg_filter_structural_wrap( $output, $original_output ) {
    if( 'close' == $original_output ) {
        $output = '</div>' . $output;
    }
    if ( 'open' == $original_output )  {
    	$output = $output . '<div class="row">';
    }
    return $output;
}
