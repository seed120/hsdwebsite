<?php
	$class_array = array(
		'left'		=> ' element-left',
		'center'	=> ' pull-center justify-content-center',
		'right'		=> ' pull-right justify-content-end'
	);
$mkeys = array(
		'chk' => 'mobile-bar-chk',
		'fields' => array(
			'mobile_header_items' => 'mobilebar-items',
			'mobile_header_text_1' => 'mobile-header-custom-text'
		)			
	);
	$mobilebar_values = Hirxpert_Wp_Elements::hirxpert_get_meta_and_option_values( $mkeys );
	$mobilebar_items = Hirxpert_Wp_Elements::hirxpert_options('mobilebar-items');
	if( !empty( $mobilebar_items ) ):
	
		if( isset( $mobilebar_items['disabled'] ) ) unset( $mobilebar_items['disabled'] );

		$sticky_opt = Hirxpert_Wp_Elements::hirxpert_options('mobilebar-sticky');
		if( $sticky_opt != 'off' ): ?>
		<div class="sticky-outer" data-stickyup="<?php echo esc_attr( $sticky_opt == 'on_scrollup' ? "1" : "0" ); ?>"><div class="sticky-head">
		<?php endif; ?>
		<div class="header-mobilebar navbar">
			<div class="container">
				<?php 
					foreach( $mobilebar_items as $key => $value ){
						$mobilebar_class = $class_array[$key];
						$mobilebar_class .= isset( $mobilebar_items['right'] ) && !empty( $mobilebar_items['right'] ) ? ' right-element-exist' : '';
						
						echo '<ul class="nav mobilebar'. esc_attr( $mobilebar_class ) .'">'; 
						foreach( $value as $element => $label ){
							switch($element){
								case "logo": ?>
									<li class="header-titles-wrapper">
										<div class="header-titles">
											<?php
												// Site title or logo.
												Hirxpert_Wp_Framework::hirxpert_mobile_logo();
											?>
										</div><!-- .header-titles -->
									</li><!-- .header-titles-wrapper -->
								<?php
								break;
								case "menu-toggle": ?>
									<li class="header-mobile-toggle-wrapper">
										<a href="<?php echo esc_url( home_url() ); ?>" class="mobile-menu-toggle"><i class="bi bi-list"></i></a>
										<?php add_action( 'hirxpert_footer_after', function(){ get_template_part( 'template-parts/mobile', 'menu' ); }, 20 ); ?>
									</li><!-- .header-navigation-wrapper -->
								<?php
								break;
								case "search": ?>
									<li class="header-search-wrapper">
										<?php Hirxpert_Wp_Framework::hirxpert_search_modal( '1', 'mobile_bar' ); ?>
									</li>
								<?php
								break;
								case "mobile-menu-custom-text-1": ?>
									<li class="mobile-custom-text-1">
										<?php
											echo do_shortcode( stripslashes( force_balance_tags( wp_kses_post( get_option( 'hirxpert_options' )['mobile-menu-custom-text-1'] ) ) ) ); 
										?>
									</li>
								<?php
								break;
								case "mobile-menu-custom-text-2": ?>
									<li class="mobile-custom-text-2">
										<?php
											echo do_shortcode( stripslashes( force_balance_tags( wp_kses_post( get_option( 'hirxpert_options' )['mobile-menu-custom-text-2'] ) ) ) ); 
										?>
									</li>
								<?php
								break;
								case "mobilebar-spacer-1":
									$spacer1_width = get_option('hirxpert_options')['mobilebar-spacer-1']['width'];
									echo '<li><div class="mobile_header_spacer" style="width: '.$spacer1_width.'px;"></div></li>';
								break;
								case "mobilebar-spacer-2":
									$spacer2_width = get_option('hirxpert_options')['mobilebar-spacer-2']['width'];
									echo '<li><div class="mobile_header_spacer2" style="width: '.$spacer2_width.'px;"></div></li>';
								break;
								case "mobilebar-spacer-3":
									$spacer3_width = get_option('hirxpert_options')['mobilebar-spacer-3']['width'];
									echo '<li><div class="mobile_header_spacer3" style="width: '.$spacer3_width.'px;"></div></li>';
								break;
								case "mobilebar-html-1":
									echo '<li>';
									Hirxpert_Wp_Framework::hirxpert_html( get_option( 'hirxpert_options' )['mobilebar-html-1'] );
									echo '</li>';
								break;
								case "mobilebar-html-2":
									echo '<li>';
									Hirxpert_Wp_Framework::hirxpert_html( get_option( 'hirxpert_options' )['mobilebar-html-2'] );
									echo '</li>';
								break;
								case "mobilebar-html-3":
									echo '<li>';
									Hirxpert_Wp_Framework::hirxpert_html( get_option( 'hirxpert_options' )['mobilebar-html-3'] );
									echo '</li>';
								break;
								case "mobilebar_delimiter1":
									$delimiter1_width = get_option('hirxpert_options')['mobilebar_delimiter1_width']['width'];
									$delimiter1_height = get_option('hirxpert_options')['mobilebar_delimiter1_height']['height'];
									$delimiter1_color = get_option('hirxpert_options')['mobilebar_delimiter1_color'];
									$delimiter1_margin_top = get_option('hirxpert_options')['mobilebar_delimiter1_margin']['top'];
									$delimiter1_margin_right = get_option('hirxpert_options')['mobilebar_delimiter1_margin']['right'];
									$delimiter1_margin_left = get_option('hirxpert_options')['mobilebar_delimiter1_margin']['left'];
									$delimiter1_margin_bottom = get_option('hirxpert_options')['mobilebar_delimiter1_margin']['bottom'];
									echo '<li><div class="delimiter" style="margin: '.$delimiter1_margin_top.'px '.$delimiter1_margin_right.'px '.$delimiter1_margin_bottom.'px '.$delimiter1_margin_left.'px; background-color:'.$delimiter1_color.';width: '.$delimiter1_width.'px;height: '.$delimiter1_height.'px "></div></li>';
								break;
								case "mobilebar_delimiter2":
									$delimiter2_width = get_option('hirxpert_options')['mobilebar_delimiter2_width']['width'];
									$delimiter2_height = get_option('hirxpert_options')['mobilebar_delimiter2_height']['height'];
									$delimiter2_color = get_option('hirxpert_options')['mobilebar_delimiter2_color'];
									$delimiter2_margin_top = get_option('hirxpert_options')['mobilebar_delimiter2_margin']['top'];
									$delimiter2_margin_right = get_option('hirxpert_options')['mobilebar_delimiter2_margin']['right'];
									$delimiter2_margin_left = get_option('hirxpert_options')['mobilebar_delimiter2_margin']['left'];
									$delimiter2_margin_bottom = get_option('hirxpert_options')['mobilebar_delimiter2_margin']['bottom'];
									echo '<li><div class="delimiter" style="margin: '.$delimiter2_margin_top.'px '.$delimiter2_margin_right.'px '.$delimiter2_margin_bottom.'px '.$delimiter2_margin_left.'px; background-color:'.$delimiter2_color.';width: '.$delimiter2_width.'px;height: '.$delimiter2_height.'px "></div></li>';
								break;
								case "mobilebar_delimiter3":
									$delimiter3_width = get_option('hirxpert_options')['mobilebar_delimiter3_width']['width'];
									$delimiter3_height = get_option('hirxpert_options')['mobilebar_delimiter3_height']['height'];
									$delimiter3_color = get_option('hirxpert_options')['mobilebar_delimiter3_color'];
									$delimiter3_margin_top = get_option('hirxpert_options')['mobilebar_delimiter3_margin']['top'];
									$delimiter3_margin_right = get_option('hirxpert_options')['mobilebar_delimiter3_margin']['right'];
									$delimiter3_margin_left = get_option('hirxpert_options')['mobilebar_delimiter3_margin']['left'];
									$delimiter3_margin_bottom = get_option('hirxpert_options')['mobilebar_delimiter3_margin']['bottom'];
									echo '<li><div class="delimiter" style="margin: '.$delimiter3_margin_top.'px '.$delimiter3_margin_right.'px '.$delimiter3_margin_bottom.'px '.$delimiter3_margin_left.'px; background-color:'.$delimiter3_color.';width: '.$delimiter3_width.'px;height: '.$delimiter3_height.'px "></div></li>';
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
							}
						}
						echo '</ul>';
					}
				?>
			</div><!-- .container -->
		</div><!-- .header-mobilebar --> <?php 
	if( $sticky_opt != 'off' ): ?>
	</div> <!-- .sticky-head --></div> <!-- .sticky-outer -->
	<?php endif; ?>	
<?php endif; ?>