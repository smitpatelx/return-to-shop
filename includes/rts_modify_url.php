<?php

// Returns url that you want to redirect to
function rts_modify_url() {
    $rts_page_id = get_option('rts_page_id','');
    $slug = get_post_field( 'post_name', $rts_page_id );
    $rts_wpml_support = get_option('rts_wpml_support',0);

	$redirect_url = '';
	$language = apply_filters( 'wpml_current_language', NULL );
    $url_red_wpml = '/?lang='.$language;

    global $wp;
    $current_page = add_query_arg( array(), $wp->request );
    // die($current_page);

    if(($current_page=='cart' || $current_page=='panier' || $current_page=='carrito') && !is_user_logged_in()) {
        if($rts_wpml_support) {
            if(is_null($language) || $language == 'en') {
                $redirect_url = '/'.$slug.'/';
            } else {
                $redirect_url = '/'.$slug.$url_red_wpml;
            }
        } else {
            $redirect_url = '/'.$slug.'/'; 
        }
    } else {
        if($rts_wpml_support) {
            if(is_null($language) || $language == 'en') {
                $redirect_url = '/shop/';
            } else {
                $redirect_url = '/shop'.$url_red_wpml;
            }
        } else {
            $redirect_url = '/shop/'; 
        }
    }

	return $redirect_url;
}