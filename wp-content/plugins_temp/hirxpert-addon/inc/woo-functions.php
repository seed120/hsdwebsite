<?php
/**
 * Custom Woo Function
 */

function hirxpert_get_woo_merge_config( $hirxpert_options ){
	$woo_default_config = '{"shop-title":"1","shop-title-items":{"center":{"title":"Title","breadcrumb":"Breadcrumb"},"disabled":{"description":"Description"}},"shop-title-color":"","shop-title-desc-color":"","shop-title-link-color":{"regular":"","hover":"","active":""},"shop-title-padding":{"top":"","right":"","bottom":"","left":""},"shop-title-bg":{"bg_color":"","bg_repeat":"","bg_size":"","bg_attachment":"","bg_position":"","image":{"id":"","url":""}},"shop-sidebar-layout":"right-sidebar","shop-right-sidebar":"","shop-left-sidebar":"","product-title":"1","product-title-items":{"center":{"title":"Title","breadcrumb":"Breadcrumb"},"disabled":{"description":"Description"}},"product-title-color":"","product-title-desc-color":"","product-title-link-color":{"regular":"","hover":"","active":""},"product-title-padding":{"top":"","right":"","bottom":"","left":""},"product-title-bg":{"bg_color":"","bg_repeat":"","bg_size":"","bg_attachment":"","bg_position":"","image":{"id":"","url":""}},"product-sidebar-layout":"right-sidebar","product-right-sidebar":"","product-left-sidebar":""}';
	$hirxpert_options = array();
	$woo_default_arr = json_decode( $woo_default_config, true );
	$hirxpert_options = array_merge( $hirxpert_options, $woo_default_arr );
	
	return $hirxpert_options;
}

function hirxpert_define_page_custom_template( $template ){
	if( is_shop() ){
		return 'shop';
	}
	if( is_product_category() ){
		return 'shop';
	}
	return $template;
}
add_filter( 'hirxpert_define_page_template', 'hirxpert_define_page_custom_template', 10 );

function custom_body_class_for_product_category( $classes ) {
    if ( is_product_category() ) {
        $classes[] = 'hirxpert-woo-category';
	}
    return $classes;
}
add_filter( 'body_class', 'custom_body_class_for_product_category' );

function hirxpert_define_single_product_template( $template ){
	if( is_product('product') ){
		return 'product';
	}
	return $template;
}
add_filter( 'hirxpert_define_custom_single_template', 'hirxpert_define_single_product_template', 10 );

// define the woocommerce_show_page_title callback 
function hirxpert_filter_woocommerce_show_page_title() { 
	if( is_shop() || is_product_category() || is_product_tag() || is_product() ){
		return false;
	}
};
add_filter( 'woocommerce_show_page_title', 'hirxpert_filter_woocommerce_show_page_title', 10, 2 ); 
