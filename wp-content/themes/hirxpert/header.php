<?php
/**
 * Header file for the Hirxpert WordPress theme.
 */

?><!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" >
		<link rel="profile" href="https://gmpg.org/xfn/11">
		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>

		<?php wp_body_open(); // For wp wp_body_open action hook ?>

		<?php
			/*
			* Set hirxpert page meta
			*/
			if( is_singular() ){
				Hirxpert_Wp_Elements::$hirxpert_page_options = get_post_meta( get_the_ID(), 'hirxpert_post_meta', true );
			}
			$keys = array(
				'chk' => 'general-chk',
				'fields' => array(
					'site_layout' => 'site-layout'
				)			
			);
			$layout = Hirxpert_Wp_Elements::hirxpert_get_meta_and_option_values( $keys );
			$pageloader_opt = Hirxpert_Wp_Elements::hirxpert_options('page-loader-option');
			?>
			<div class="hirxpert-body-inner<?php 
			    if ($layout['site_layout'] == 'boxed') {
			        echo esc_attr(' container');
			    } elseif ($layout['site_layout'] == 'wider') {
			        echo esc_attr(' container-fluid');
			    } 
			?>">	
			<?php if( $pageloader_opt == '1' ) : ?>
			<div class="page-loader"><span class="page-loader-divider"></span></div>
			<?php endif; ?>	

			<?php
			/*
			 * Hirxpert Header Before Action 
			 * 10 - hirxpert_mobile_header
			 */
			do_action( 'hirxpert_header_before' );
			?>
			
			<?php
			/*
			 * Hirxpert Header Action 
			 * 10 - hirxpert_desktop_header
			 */
			do_action( 'hirxpert_header' );
			?>
			
			<?php
			/*
			 * Hirxpert Header After Action 
			 * 10 - hirxpert_header_slider
			 */
			do_action( 'hirxpert_header_after' );
			?>