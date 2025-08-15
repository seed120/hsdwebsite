<?php
/**
 * Bottom Meta
 */

$bottom_meta_opt = Hirxpert_Wp_Elements::hirxpert_options('single-bottom-meta-enable');
if( is_singular( 'post' ) && $bottom_meta_opt ):
	Hirxpert_Wp_Elements::hirxpert_get_post_meta( Hirxpert_Wp_Elements::$template, 'bottom' );
endif;

$blog_meta_opt = Hirxpert_Wp_Elements::hirxpert_options('blog-bottom-meta-enable');
if( !is_archive() && !is_singular() && $blog_meta_opt ):
	Hirxpert_Wp_Elements::hirxpert_get_post_meta( Hirxpert_Wp_Elements::$template, 'bottom' );
endif;

$archive_bottom_meta_opt = Hirxpert_Wp_Elements::hirxpert_options('archive-bottom-meta-enable');
if( is_archive() && $archive_bottom_meta_opt):
	Hirxpert_Wp_Elements::hirxpert_get_post_meta( Hirxpert_Wp_Elements::$template, 'bottom' );
endif;