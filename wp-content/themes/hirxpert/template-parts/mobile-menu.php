<?php
/*
 * Mobile Menu Template
 */
?>
<div class="mobile-menu-floating">
	<a href="<?php echo esc_url( home_url() ); ?>" class="mobile-menu-toggle"><i class="close-icon"></i></a>

	<?php
	do_action( 'hirxpert_mobile_menu_before' );
	$mobilebar_items = Hirxpert_Wp_Elements::hirxpert_options('mobilebar-menu-items');
	$mobilebar_items = isset( $mobilebar_items['enabled'] ) ? $mobilebar_items['enabled'] : ''; 
	$mkeys = array(
		'chk' => 'mobile-bar-chk',
		'fields' => array(
			'mobilebar-menu-items' => 'mobilebar-menu-items',
			'mobile_menu_custom_text_1' => 'mobile-menu-custom-text-1',
			'mobile_menu_custom_text_2' => 'mobile-menu-custom-text-2'
		)			
	);
	
	$mobile_menu_bar_values = Hirxpert_Wp_Elements::hirxpert_get_meta_and_option_values( $mkeys );
	if( !empty( $mobilebar_items ) && is_array( $mobilebar_items ) ):	
		foreach( $mobilebar_items as $element => $value ){
			switch($element){ 

				case "logo": ?>
				<div class="header-titles">
					<?php
						// Site title or logo.
						Hirxpert_Wp_Framework::hirxpert_mobile_logo( array(), 'div' );
					?>
				</div><!-- .header-titles --> <?php
				break;
				case "menu":
					$menu_name = '';
					$page_option = get_post_meta( get_the_ID(), 'hirxpert_post_meta', true );
					if( isset( $page_option['header-one-page-menu'] ) && $page_option['header-one-page-menu'] != 'none' ) {
						$menu_name = $page_option['header-one-page-menu'];
					}
					if ( has_nav_menu( 'mobile' ) || !empty( $menu_name ) ) { ?>						
						<nav class="mobile-menu-wrapper">
							<ul class="wp-menu mobile-menu">
								<?php
									wp_nav_menu(array(
										'container'      => false,
										'items_wrap'     => '%3$s',
										'theme_location' => 'mobile', // Always include theme_location
										'menu'           => !empty($menu_name) ? $menu_name : '',
										'fallback_cb'    => false,
									));
								?>
							</ul>
						</nav><!-- .mobile-menu-wrapper -->
					<?php }
					break;
				case "search":
					echo get_search_form();
					break;
				

				case "social": 
					if( class_exists( 'Hirxpert_Custom_Functions' ) ):
					?>
					<div class="mobile-menu-social-wrap">
						<?php
							Hirxpert_Custom_Functions::hirxpert_social_links();
						?>
					</div>
					<?php
					endif;
				break;
				case "mobilebar-menu-custom-text-1":					
					if( $mobile_menu_bar_values['mobile_menu_custom_text_1'] )
					echo '<div class="custom-text-1">'. do_shortcode( stripslashes( force_balance_tags( wp_kses_post( get_option( 'hirxpert_options' )['mobilebar-menu-custom-text-1'] ) ) ) ) .'</div>';
				break;
				case "mobilebar-menu-custom-text-2":
					if( $mobile_menu_bar_values['mobile_menu_custom_text_2'] )
					echo '<div class="custom-text-2">'. do_shortcode( stripslashes( force_balance_tags( wp_kses_post( get_option( 'hirxpert_options' )['mobilebar-menu-custom-text-2'] ) ) ) ) .'</div>';
				break;
				case "spacer-mobile-1":
					$spacer1_width = get_option('hirxpert_options')['mobile-spacer-1'];
					echo '<div class="mobilemenu_header_spacer" style="height: '.$spacer1_width.'px;"></div>';
				break;
				case "spacer-mobile-2":
					$spacer2_width = get_option('hirxpert_options')['mobile-spacer-2'];
					echo '<div class="mobilemenu_header_spacer2" style="height: '.$spacer2_width.'px;"></div>';
				break;
				case "spacer-mobile-3":
					$spacer3_width = get_option('hirxpert_options')['mobile-spacer-3'];
					echo '<div class="mobilemenu_header_spacer3" style="height: '.$spacer3_width.'px;"></div>';
				break;
				case "delimiter-mobile-1":
					$delimiter1_width = get_option('hirxpert_options')['mobile-delimiter-1-width']['width'];
					$delimiter1_height = get_option('hirxpert_options')['mobile-delimiter-1-height']['height'];
					$delimiter1_color = get_option('hirxpert_options')['mobile-delimiter-1-color'];
					$delimiter1_margin_top = get_option('hirxpert_options')['mobile-delimiter-1-margin']['top'];
					$delimiter1_margin_right = get_option('hirxpert_options')['mobile-delimiter-1-margin']['right'];
					$delimiter1_margin_left = get_option('hirxpert_options')['mobile-delimiter-1-margin']['left'];
					$delimiter1_margin_bottom = get_option('hirxpert_options')['mobile-delimiter-1-margin']['bottom'];
					echo '<div class="delimiter" style="margin: '.$delimiter1_margin_top.'px '.$delimiter1_margin_right.'px '.$delimiter1_margin_bottom.'px '.$delimiter1_margin_left.'px; background-color:'.$delimiter1_color.';width: '.$delimiter1_width.'px;height: '.$delimiter1_height.'px "></div>';
				break;
				case "delimiter-mobile-2":
					$delimiter2_width = get_option('hirxpert_options')['mobile-delimiter-2-width']['width'];
					$delimiter2_height = get_option('hirxpert_options')['mobile-delimiter-2-height']['height'];
					$delimiter2_color = get_option('hirxpert_options')['mobile-delimiter-2-color'];
					$delimiter2_margin_top = get_option('hirxpert_options')['mobile-delimiter-2-margin']['top'];
					$delimiter2_margin_right = get_option('hirxpert_options')['mobile-delimiter-2-margin']['right'];
					$delimiter2_margin_left = get_option('hirxpert_options')['mobile-delimiter-2-margin']['left'];
					$delimiter2_margin_bottom = get_option('hirxpert_options')['mobile-delimiter-2-margin']['bottom'];
					echo '<div class="delimiter" style="margin: '.$delimiter2_margin_top.'px '.$delimiter2_margin_right.'px '.$delimiter2_margin_bottom.'px '.$delimiter2_margin_left.'px; background-color:'.$delimiter2_color.';width: '.$delimiter2_width.'px;height: '.$delimiter2_height.'px "></div>';
				break;
				case "wpml_polylang":
					if ( defined( 'ICL_SITEPRESS_VERSION' ) ) {
						$current_language = apply_filters( 'wpml_current_language', NULL );
						echo '<li>';
						echo sprintf( __('Current Language: %s', 'hirxpert'), esc_html($current_language) );
						echo '</li>';
						do_action('wpml_add_language_selector');
					} else if ( function_exists( 'pll_the_languages' ) ) {
						echo '<li>';
						pll_the_languages( array( 'dropdown' => 0 ) );
						echo '</li>';
					}
				break;
			} //switch	
		} //foreach
	endif; 	
	do_action( 'hirxpert_mobile_menu_after' ); 
	?>

</div><!-- .mobile-menu-floating -->