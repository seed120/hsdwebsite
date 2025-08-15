<?php
/**
 * Top Meta
 */

$top_meta_opt = Hirxpert_Wp_Elements::hirxpert_options('single-top-meta-enable');
if( is_singular( 'post' ) && $top_meta_opt ):
	Hirxpert_Wp_Elements::hirxpert_get_post_meta( Hirxpert_Wp_Elements::$template, 'top' );
endif;

$blog_top_meta_opt = Hirxpert_Wp_Elements::hirxpert_options('blog-top-meta-enable');
if( !is_archive() && !is_singular() && $blog_top_meta_opt ):
	Hirxpert_Wp_Elements::hirxpert_get_post_meta( Hirxpert_Wp_Elements::$template, 'top' );
endif;

$archive_top_meta_opt = Hirxpert_Wp_Elements::hirxpert_options('archive-top-meta-enable');
if( is_archive() && $archive_top_meta_opt):
	Hirxpert_Wp_Elements::hirxpert_get_post_meta( Hirxpert_Wp_Elements::$template, 'top' );
endif;
