<?php 
	$class_array = array(
		'left'		=> ' element-left',
		'center'	=> ' pull-center justify-content-center',
		'right'		=> ' pull-right justify-content-end'
	);
	$header_keys = array(
		'chk' => 'header-chk',
		'fields' => array(
			'header_layout' => 'header-layout'
		)			
	);
	$header_values = Hirxpert_Wp_Elements::hirxpert_get_meta_and_option_values( $header_keys );
	$keys = array(
		'chk' => 'header-navbar-chk',
		'fields' => array(
			'header_navbar_items' => 'navbar-items',
			'header_navbar_text_1' => 'navbar-custom-text-1',
			'header_navbar_text_2' => 'navbar-custom-text-2'
		)			
	);
	$navbar_values = Hirxpert_Wp_Elements::hirxpert_get_meta_and_option_values( $keys );
	$navbar_items = $navbar_values['header_navbar_items'];
	if( !empty( $navbar_items ) ):	
		if( isset( $navbar_items['disabled'] ) ) unset( $navbar_items['disabled'] );
		
		$layout = $header_values['header_layout'];
		$container_class = $layout == 'wider' ? 'container-fluid' : 'container';
?>
		<div class="header-navbar navbar elements-<?php echo esc_attr( count( $navbar_items ) ); ?>">
			<?php
				/*
				 * Hirxpert Topbar Before Action
				 */
				do_action( 'hirxpert_navbar_before' );
			?>
			<div class="<?php echo esc_attr( $container_class ); ?>">
				<?php
				foreach( $navbar_items as $key => $value ){
					$navbar_class = $class_array[$key];
					$navbar_class .= isset( $navbar_items['right'] ) && !empty( $navbar_items['right'] ) ? ' right-element-exist' : '';
					echo '<ul class="nav navbar-ul'. esc_attr( $navbar_class ) .'">';
						foreach( $value as $element => $label ){
							switch( $element ){
								case "custom-text-1":
									if( $navbar_values['header_navbar_text_1'] )
									echo '<li>'. do_shortcode( stripslashes( $navbar_values['header_navbar_text_1'] ) ) .'</li>';
								break;
								case "custom-text-2":
									if( $navbar_values['header_navbar_text_2'] )
									echo '<li>'. do_shortcode( stripslashes( $navbar_values['header_navbar_text_2'] ) ) .'</li>';
								break;
								case "social":
									if( class_exists( 'Hirxpert_Custom_Functions' ) ):
										echo '<li>';
										Hirxpert_Custom_Functions::hirxpert_social_links();
										echo '</li>';
									endif;
								break;
								case "search":
									$keys = array(
										'chk' => 'header-chk',
										'fields' => array(
											'post-type' => 'search-template',
											'search_type' => 'search-type'
										)			
									);
									$search_values = Hirxpert_Wp_Elements::hirxpert_get_meta_and_option_values( $keys );
									$search_type = $search_values['search_type'];
									echo '<li>';
									Hirxpert_Wp_Framework::hirxpert_search_modal( $search_type, 'navbar' );
									echo '</li>';
								break;
									case "logo": ?>
									<li class="header-titles-wrapper">
										<div class="header-titles">
											<?php
												// Site title or logo.
												Hirxpert_Wp_Framework::hirxpert_site_logo();
												// Sticky logo
												Hirxpert_Wp_Framework::hirxpert_sticky_logo();
												// Site description.
												Hirxpert_Wp_Framework::hirxpert_site_description();
											?>
										</div><!-- .header-titles -->
									</li><!-- .header-titles-wrapper -->
								<?php
								break;
								case "primary-menu": ?>
									<li class="header-navigation-wrapper">
										<?php
											$menu_name = '';
											$page_option = get_post_meta( get_the_ID(), 'hirxpert_post_meta', true );
											if( isset( $page_option['header-one-page-menu'] ) && $page_option['header-one-page-menu'] != 'none' ) {
												$menu_name = $page_option['header-one-page-menu'];
											}
										?>
										<?php if ( has_nav_menu( 'primary' ) || !empty( $menu_name ) ) { ?>
											<nav class="primary-menu-wrapper" aria-label="<?php esc_attr_e( 'Horizontal', 'hirxpert' ); ?>">
												<ul class="nav wp-menu primary-menu">
													<?php
														wp_nav_menu(array(
															'container'      => false,
															'items_wrap'     => '%3$s',
															'theme_location' => 'primary',
															'menu'           => !empty($menu_name) ? $menu_name : '',
															'fallback_cb'    => false,
														));
													?>
												</ul>
											</nav><!-- .primary-menu-wrapper -->
										<?php }  else { 
											echo sprintf( 
												'<a href="%1$s">%2$s</a>',
												admin_url( 'nav-menus.php' ),
												esc_html__( 'Add a menu', 'hirxpert' )			
											); } 
										?>
									</li><!-- .header-navigation-wrapper -->
								<?php
								break;
								case "secondary-bar": ?>
									<li class="secondary-toggle-wrapper">
										<a href="<?php echo esc_url( home_url() ); ?>" class="secondary-menu-toggle hirxpert-toggle"><span></span><span></span><span></span></a>
									</li>
									<?php add_action( 'hirxpert_footer_after', array( 'Hirxpert_Wp_Elements', 'hirxpert_secondary_bar' ), 10 );
								break;
								case "navbar-html-1":
									echo '<li>';
									Hirxpert_Wp_Framework::hirxpert_html(get_option('hirxpert_options')['navbar_html_1'] );
									echo '</li>';
								break;
								case "navbar-html-2":
									echo '<li>';
									Hirxpert_Wp_Framework::hirxpert_html( get_option( 'hirxpert_options' )['navbar_html_2']  );
									echo '</li>';
								break;
								case "navbar-html-3":
									echo '<li>';
									Hirxpert_Wp_Framework::hirxpert_html( get_option( 'hirxpert_options' )['navbar_html_3'] );
									echo '</li>';
								break;
								case "navbar-html-4":
									echo '<li>';
									Hirxpert_Wp_Framework::hirxpert_html( get_option( 'hirxpert_options' )['navbar_html_4'] );
									echo '</li>';
								break;
								case "navbar-html-5":
									echo '<li>';
									Hirxpert_Wp_Framework::hirxpert_html( get_option( 'hirxpert_options' )['navbar_html_5'] );
									echo '</li>';
								break;
								case "navbar-spacer-1":
									$spacer1_width = get_option('hirxpert_options')['navbar_spacer_1_width']['width'];
									echo '<li><div class="header_spacer" style="width: '.$spacer1_width.'px;"></div></li>'; 
								break;
								case "navbar-spacer-2":
									$spacer2_width = get_option('hirxpert_options')['navbar_spacer_2_width']['width'];
									echo '<li><div class="header_spacer" style="width: '.$spacer2_width.'px;"></div></li>';
								break;
								case "navbar-spacer-3":
									$spacer3_width = get_option('hirxpert_options')['navbar_spacer_3_width']['width'];
									echo '<li><div class="header_spacer" style="width: '.$spacer3_width.'px;"></div></li>';
								break;
								case "navbar_delimiter1":
									$delimiter1_width = get_option('hirxpert_options')['navbar_delimiter1_width']['width'];
									$delimiter1_height = get_option('hirxpert_options')['navbar_delimiter1_height']['height'];
									$delimiter1_color = get_option('hirxpert_options')['navbar_delimiter1_color'];
									$delimiter1_margin_top = get_option('hirxpert_options')['navbar_delimiter1_margin']['top'];
									$delimiter1_margin_right = get_option('hirxpert_options')['navbar_delimiter1_margin']['right'];
									$delimiter1_margin_left = get_option('hirxpert_options')['navbar_delimiter1_margin']['left'];
									$delimiter1_margin_bottom = get_option('hirxpert_options')['navbar_delimiter1_margin']['bottom'];
									echo '<li><div class="delimiter" style="margin: '.$delimiter1_margin_top.'px '.$delimiter1_margin_right.'px '.$delimiter1_margin_bottom.'px '.$delimiter1_margin_left.'px; background-color:'.$delimiter1_color.';width: '.$delimiter1_width.'px;height: '.$delimiter1_height.'px "></div></li>';
								break;
								case "navbar_delimiter2":
									$delimiter2_width = get_option('hirxpert_options')['navbar_delimiter2_width']['width'];
									$delimiter2_height = get_option('hirxpert_options')['navbar_delimiter2_height']['height'];
									$delimiter2_color = get_option('hirxpert_options')['navbar_delimiter2_color'];
									$delimiter2_margin_top = get_option('hirxpert_options')['navbar_delimiter2_margin']['top'];
									$delimiter2_margin_right = get_option('hirxpert_options')['navbar_delimiter2_margin']['right'];
									$delimiter2_margin_left = get_option('hirxpert_options')['navbar_delimiter2_margin']['left'];
									$delimiter2_margin_bottom = get_option('hirxpert_options')['navbar_delimiter2_margin']['bottom'];
									echo '<li><div class="delimiter" style="margin: '.$delimiter2_margin_top.'px '.$delimiter2_margin_right.'px '.$delimiter2_margin_bottom.'px '.$delimiter2_margin_left.'px; background-color:'.$delimiter2_color.';width: '.$delimiter2_width.'px;height: '.$delimiter2_height.'px "></div></li>';
								break;
								case "navbar_delimiter3":
									$delimiter3_width = get_option('hirxpert_options')['navbar_delimiter3_width']['width'];
									$delimiter3_height = get_option('hirxpert_options')['navbar_delimiter3_height']['height'];
									$delimiter3_color = get_option('hirxpert_options')['navbar_delimiter3_color'];
									$delimiter3_margin_top = get_option('hirxpert_options')['navbar_delimiter3_margin']['top'];
									$delimiter3_margin_right = get_option('hirxpert_options')['navbar_delimiter3_margin']['right'];
									$delimiter3_margin_left = get_option('hirxpert_options')['navbar_delimiter3_margin']['left'];
									$delimiter3_margin_bottom = get_option('hirxpert_options')['navbar_delimiter3_margin']['bottom'];
									echo '<li><div class="delimiter" style="margin: '.$delimiter3_margin_top.'px '.$delimiter3_margin_right.'px '.$delimiter3_margin_bottom.'px '.$delimiter3_margin_left.'px; background-color:'.$delimiter3_color.';width: '.$delimiter3_width.'px;height: '.$delimiter3_height.'px "></div></li>';
								break;
								case "signin":
									$shortcode = stripslashes(force_balance_tags(wp_kses_post(get_option('hirxpert_options')['signin-register'])));
									
									if (empty($shortcode)) {
										$shortcode = wp_login_form([
											'echo'           => false,
											'redirect'       => home_url(), // Redirect to home after login
											'form_id'        => 'loginform',
											'label_username' => __('Username or Email', 'hirxpert'),
											'label_password' => __('Password', 'hirxpert'),
											'label_remember' => __('Remember Me', 'hirxpert'),
											'label_log_in'   => __('Log In', 'hirxpert'),
											'remember'       => true
										]);
									} else {
										$shortcode = do_shortcode($shortcode);
									}
								
									echo '<li>';
									echo '<div id="login-popup" class="login-popup" style="display: none;">
												<div class="popup-content">
													<button class="close-popup">×</button>
													' . do_shortcode($shortcode) . '
												</div>
										 </div>
										<button class="btn btn-primary login-button" data-shortcode="' . esc_attr($shortcode) . '">' . esc_html__('Login', 'hirxpert') . '</button>
									</li>';
								break;
								case "wpml_polylang":
									if ( defined( 'ICL_SITEPRESS_VERSION' ) ) {
										$current_language = apply_filters( 'wpml_current_language', NULL );
										echo '<li>'; 
											do_action('wpml_add_language_selector');
										echo '</li>'; 
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
			<?php
				/*
				 * Hirxpert navbar After Action 
				 * 10 - hirxpert_fullbar_search_form
				 */
				do_action( 'hirxpert_navbar_after' );
			?>
		</div><!-- .header-navbar -->
<?php endif; ?>