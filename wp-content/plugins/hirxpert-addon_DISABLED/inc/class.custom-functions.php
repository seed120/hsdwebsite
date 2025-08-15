<?php 

/*
 * Hirxpert custom functions 
 */

class Hirxpert_Custom_Functions {
	
	private static $_instance = null;

	private static $hirxpert_options = null;
		
	public function __construct() {
		
		self::$hirxpert_options = Hirxpert_Theme_Option::$hirxpert_options;
						
		add_filter( 'single_template', array( $this, 'hirxpert_cea_cpt_custom_template' ), 99 );
		
		add_filter( 'taxonomy_template', array( $this, 'hirxpert_cea_cpt_custom_tax_template' ), 99 );
		
		add_action( 'save_post', array( $this, 'hirxpert_save_post_options' ), 10, 1 );
		
		add_action( 'wp_enqueue_scripts', array( $this, 'hirxpert_addon_register_scripts' ) );
		
		add_action( 'wp_body_open', array( $this, 'hirxpert_addon_wp_body_open' ), 10 );
		
		add_filter( 'excerpt_length', array( $this, 'hirxpert_custom_excerpt_length' ), 10 );
		
		add_filter( 'hirxpert_trigger_to_save_custom_styles', array( $this, 'hirxpert_trigger_to_save_custom_styles_fun' ), 10 );
		
		//Year shortcode
		add_shortcode( 'year', function($atts){ return date("Y"); } );
		//Copyright icon shortcode
		add_shortcode( 'copy', function($atts){ return '&copy;'; } );
		
		// Remove single cpt templates
		remove_filter( 'single_template', 'cea_cpt_custom_template', 10 );
		
	}
	
	function hirxpert_trigger_to_save_custom_styles_fun( $styles ){
		require_once HIRXPERT_ADDON_DIR . 'admin/extension/theme-options/googlefonts.php';
		require_once ( HIRXPERT_ADDON_DIR . 'admin/extension/theme-options/theme-options-css.php' );
		$custom_css = Hirxpert_Theme_Option::hirxpert_minify_css( $styles );
		return $styles .' '. $custom_css;
	}
	
	function hirxpert_addon_register_scripts(){
		wp_enqueue_style( 'font-awesome', HIRXPERT_ADDON_URL . '/assets/css/themify-icons.css', array(), '4.7.0', 'all' );
	}
	
	function hirxpert_custom_excerpt_length( $length ){
		$hirxpert_options = self::$hirxpert_options;
		if( isset( $hirxpert_options['blog-post-excerpt-length'] ) && !empty( $hirxpert_options['blog-post-excerpt-length'] ) ) {
			return absint( $hirxpert_options['blog-post-excerpt-length'] );
		}
		return $length;
	}
	
	function hirxpert_addon_wp_body_open(){
		$hirxpert_options = self::$hirxpert_options;	
		$dark_light = isset( $hirxpert_options['dark-light'] ) ? $hirxpert_options['dark-light'] : false;
		if( $dark_light ): ?>
			<div class="dar-light-sticky">
				<div class="dar-light-inner">
					<span class="round-ball-switch"></span>
					<i class="bi bi-sun light-mode"></i>
					<i class="bi bi-moon-fill dark-mode"></i>
				</div>
			</div>
		<?php
		endif;
	}
	
	function hirxpert_save_post_options($post_id){
		
		if ( ! current_user_can( 'manage_options' ) ) {
			return $post_id;
		}
		if ( isset( $_POST['hirxpert_options'] ) ) {
			//update_post_meta( $post_id, 'hirxpert_post_custom_styles', 'This is custom post styles' );
			require_once ( HIRXPERT_ADDON_DIR . 'admin/extension/theme-options/post-options-css.php' );
		}
		
	}
	
	function hirxpert_cea_cpt_custom_template( $single ) {
		global $post;
		/* Checks for single template by post type */
		if( $post->post_type == 'cea-portfolio' || $post->post_type == 'cea-team' || $post->post_type == 'cea-event' || $post->post_type == 'cea-service' || $post->post_type == 'cea-testimonial' ) {
			if( file_exists( HIRXPERT_ADDON_DIR . '/classic-elementor-addons-pro/custom-singular.php' ) ) {
				return apply_filters( 'cea_portfolio_template_path', HIRXPERT_ADDON_DIR . '/classic-elementor-addons-pro/custom-singular.php' );
			}		
		}

		return $single;
	}
	
	function hirxpert_cea_cpt_custom_tax_template( $archive ){
		if( is_tax('portfolio-categories') || is_tax('portfolio-tags') || is_tax('service-categories') || is_tax('service-tags') ){
			require_once ( HIRXPERT_ADDON_DIR . 'inc/cpt.elements.php' );
			if( file_exists( HIRXPERT_ADDON_DIR . '/classic-elementor-addons-pro/custom-archive.php' ) ) {
				return HIRXPERT_ADDON_DIR . '/classic-elementor-addons-pro/custom-archive.php';
			}		
		}
	}

	public static function hirxpert_social_links() {
		$hirxpert_options = self::$hirxpert_options;
		$social_links = isset($hirxpert_options['social-links']) ? $hirxpert_options['social-links'] : '';
		$social_url = isset($social_links['url']) ? $social_links['url'] : '';
		$social_links = isset($social_links['enabled']) && !empty($social_links['enabled']) ? $social_links['enabled'] : '';
		$social_links = apply_filters('hirxpert_available_social_links', $social_links);
	
		if (!empty($social_links) && is_array($social_links)) {
			wp_enqueue_style('font-awesome');
	
			$social_class = isset($hirxpert_options['social-icons-layout']) ? ' social-' . $hirxpert_options['social-icons-layout'] : '';
			$custom_color = isset($hirxpert_options['social-icons-fore-custom']) && $hirxpert_options['social-icons-fore'] === 'custom' ? $hirxpert_options['social-icons-fore-custom'] : '';
			$custom_bg_color = isset($hirxpert_options['social-icons-bg-custom']) && $hirxpert_options['social-icons-bg'] === 'bg-custom' ? $hirxpert_options['social-icons-bg-custom'] : '';
			$custom_hover_color = isset($hirxpert_options['social-icons-hfore-custom']) && $hirxpert_options['social-icons-hfore'] === 'h-custom' ? $hirxpert_options['social-icons-hfore-custom'] : '';
			$custom_bg_hover_color = isset($hirxpert_options['social-icons-hbg-custom']) && $hirxpert_options['social-icons-hbg'] === 'hbg-custom' ? $hirxpert_options['social-icons-hbg-custom'] : '';
			$border_color = isset($hirxpert_options['social-icons-border-color']) ? $hirxpert_options['social-icons-border-color'] : '';
			$border_width = isset($hirxpert_options['social-icons-border-width']) ? $hirxpert_options['social-icons-border-width'] . 'px' : '1px';
			$border_radius = isset($hirxpert_options['social-icons-border-radius']) ? $hirxpert_options['social-icons-border-radius'] . '%' : '0%';
			$border_style = isset($hirxpert_options['social-icons-border-style']) ? $hirxpert_options['social-icons-border-style'] : '';
			$target_window = isset($hirxpert_options['social-icon-window']) ? $hirxpert_options['social-icon-window'] : '';
	
			// Generate hover styles
			$hover_styles = '';
			foreach ($social_links as $key => $icon_class) {
				$hover_styles .= "
					.social-icons .social-{$key}:hover {
						color: " . esc_attr($custom_hover_color) . " !important;
						background-color: " . esc_attr($custom_bg_hover_color) . " !important;
					}
				";
			}
			if (!empty($hover_styles)) {
				wp_add_inline_style('font-awesome', $hover_styles);
			}
			?>
			<ul class="nav social-icons<?php echo esc_attr($social_class); ?>">
				<?php foreach ($social_links as $key => $icon_class) :
					$url = isset($social_url[$key]) ? $social_url[$key] : '#';
					?>
					<li>
						<a class="social-<?php echo esc_attr($key); ?>"
						   href="<?php echo esc_url($url); ?>"
						   <?php if (!empty($target_window)) echo ' target="' . esc_attr($target_window) . '"'; ?>
						   style="
							   color: <?php echo esc_attr($custom_color); ?>;
							   background-color: <?php echo esc_attr($custom_bg_color); ?>;
							   border-color: <?php echo esc_attr($border_color); ?>;
							   border-width: <?php echo esc_attr($border_width); ?>;
							   border-radius: <?php echo esc_attr($border_radius); ?>;
							   border-style: <?php echo esc_attr($border_style); ?>"
							onMouseOver="this.style.color='<?php echo esc_attr($custom_hover_color); ?>'"
							onMouseOut="this.style.color='<?php echo esc_attr($custom_color); ?>'"   
							>
						   <span class="<?php echo esc_attr($icon_class); ?>"></span>
						</a>
					</li>
				<?php endforeach; ?>
			</ul><!-- .social-icons -->
			<?php
		}
	}
	
	public static function hirxpert_social_share() { //Hirxpert_Wp_Elements::hirxpert_social_share()
		$hirxpert_options = self::$hirxpert_options;		
		$social_share = isset( $hirxpert_options['social-share'] ) ? $hirxpert_options['social-share'] : '';	
		$social_share = isset( $social_share['enabled'] ) && !empty( $social_share['enabled'] ) ? $social_share['enabled'] : '';
		$social_share = apply_filters( 'hirxpert_available_social_share', $social_share );		
		if( !empty( $social_share ) && is_array( $social_share ) ){
			$post_id = get_the_ID();
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'large' );
			$image_url = !empty( $image ) && isset( $image[0] ) ? $image[0] : '';
			$post_title = get_the_title();
			$site_name = get_bloginfo( 'name' );
			wp_enqueue_style('font-awesome');
			echo '<ul class="nav social-share">';
			foreach( $social_share as $key => $icon_class ){
				switch($key){
					case "facebook":
						echo sprintf( 
							'<li class="nav-item"><a href="%s" data-href="https://www.facebook.com/sharer.php?u=%s&t=%s" target="_blank" rel="nofollow" class="social-facebook share-fb"><i class="%s"></i></a></li>',
							esc_url( home_url( '/' ) ),
							urlencode( get_permalink( $post_id ) ),
							urlencode( $post_title ),
							esc_attr( $icon_class )
					 	);
					break;
					case "twitter":
						echo sprintf( 
							'<li class="nav-item"><a href="%s" data-href="https://twitter.com/share?hashtags=sharing&text=%s&via=%s - %s" class="social-twitter share-twitter" title="%s" target="_blank" rel="nofollow"><i class="%s"></i></a></li>', 
							esc_url( home_url( '/' ) ),
							urlencode( $post_title ),
							urlencode( $site_name ),
							esc_url( get_permalink( $post_id ) ),
							esc_html__( 'Click to send this page to Twitter!', 'hirxpert-addon' ),
							esc_attr( $icon_class )
						);
					break;
					case "linkedin":						
						echo sprintf( 
							'<li class="nav-item"><a href="%s" data-href="https://www.linkedin.com/shareArticle?mini=true&url=%s&title=%s&summary=&source=%s" class="social-linkedin share-linkedin" target="_blank" rel="nofollow"><i class="%s"></i></a></li>',
							esc_url( home_url( '/' ) ),
							esc_url( get_permalink( $post_id ) ),
							urlencode( $post_title ),
							get_bloginfo('name'),
							esc_attr( $icon_class )	
						);
					break;
					case "instagram":
						echo sprintf( 
							'<li class="nav-item"><a href="%s" data-href="https://www.instagram.com/?url=%s" class="social-instagram share-instagram" target="_blank" rel="nofollow"><i class="%s"></i></a></li>',
							esc_url( home_url( '/' ) ),
							esc_url( get_permalink( $post_id ) ),
							esc_attr( $icon_class )	
						);
					break;
					case "pinterest":
						echo sprintf( 
							'<li class="nav-item"><a href="%s" data-href="https://pinterest.com/pin/create/button/?url=%s&amp;media=%s&description=%s" class="social-pinterest share-pinterest" target="_blank" rel="nofollow"><i class="%s"></i></a></li>',
							esc_url( home_url( '/' ) ),
							esc_url( get_permalink( $post_id ) ),
							esc_url( $image_url ),
							urlencode( $post_title ),
							esc_attr( $icon_class )
						);
					break;
					case "whatsapp":
						echo sprintf( 
							'<li class="nav-item"><a href="%s" data-href="https://api.whatsapp.com/send?text=%s %s" target="_blank" rel="nofollow" class="social-whatsapp share-whatsapp"><i class="%s"></i></a></li>',
							esc_url( home_url( '/' ) ),
							urlencode( $post_title ),
							urlencode( get_permalink( $post_id ) ),
							esc_attr( $icon_class )
						);
					break;
					case "tumblr":
						echo sprintf(
							'<li class="nav-item"><a href="%s" data-href="https://www.tumblr.com/share/link?url=%s&name=%s" target="_blank" rel="nofollow" class="social-tumblr share-tumblr"><i class="%s"></i></a></li>',
							esc_url(home_url('/')),
							esc_url(get_permalink($post_id)),
							urlencode($post_title),
							esc_attr($icon_class)
						);
					break;
	
					case "yahoo":
						echo sprintf(
							'<li class="nav-item"><a href="%s" data-href="https://compose.mail.yahoo.com/?body=%s" target="_blank" rel="nofollow" class="social-yahoo share-yahoo"><i class="%s"></i></a></li>',
							esc_url(home_url('/')),
							esc_url(get_permalink($post_id)),
							esc_attr($icon_class)
						);
					break;
	
					case "vimeo":
						echo sprintf(
							'<li class="nav-item"><a href="%s" data-href="https://vimeo.com/share?url=%s" target="_blank" rel="nofollow" class="social-vimeo share-vimeo"><i class="%s"></i></a></li>',
							esc_url(home_url('/')),
							esc_url(get_permalink($post_id)),
							esc_attr($icon_class)
						);
					break;
	
					case "youtube":
						echo sprintf(
							'<li class="nav-item"><a href="%s" data-href="https://www.youtube.com/share?url=%s" target="_blank" rel="nofollow" class="social-youtube share-youtube"><i class="%s"></i></a></li>',
							esc_url(home_url('/')),
							esc_url(get_permalink($post_id)),
							esc_attr($icon_class)
						);
					break;
	
					case "stack-overflow":
						echo sprintf(
							'<li class="nav-item"><a href="%s" data-href="https://stackoverflow.com/share?url=%s" target="_blank" rel="nofollow" class="social-stackoverflow share-stackoverflow"><i class="%s"></i></a></li>',
							esc_url(home_url('/')),
							esc_url(get_permalink($post_id)),
							esc_attr($icon_class)
						);
					break;
	
					case "jsfiddle":
						echo sprintf(
							'<li class="nav-item"><a href="%s" data-href="https://jsfiddle.net/?url=%s" target="_blank" rel="nofollow" class="social-jsfiddle share-jsfiddle"><i class="%s"></i></a></li>',
							esc_url(home_url('/')),
							esc_url(get_permalink($post_id)),
							esc_attr($icon_class)
						);
					break;
	
					case "reddit":
						echo sprintf(
							'<li class="nav-item"><a href="%s" data-href="https://www.reddit.com/submit?url=%s&title=%s" target="_blank" rel="nofollow" class="social-reddit share-reddit"><i class="%s"></i></a></li>',
							esc_url(home_url('/')),
							esc_url(get_permalink($post_id)),
							urlencode($post_title),
							esc_attr($icon_class)
						);
					break;
	
					case "soundcloud":
						echo sprintf(
							'<li class="nav-item"><a href="%s" data-href="https://soundcloud.com/share?url=%s" target="_blank" rel="nofollow" class="social-soundcloud share-soundcloud"><i class="%s"></i></a></li>',
							esc_url(home_url('/')),
							esc_url(get_permalink($post_id)),
							esc_attr($icon_class)
						);
					break;
	
					case "wikipedia":
						echo sprintf(
							'<li class="nav-item"><a href="%s" data-href="https://en.wikipedia.org/wiki/Special:Search?search=%s" target="_blank" rel="nofollow" class="social-wikipedia share-wikipedia"><i class="%s"></i></a></li>',
							esc_url(home_url('/')),
							urlencode($post_title),
							esc_attr($icon_class)
						);
					break;
	
					case "xing":
						echo sprintf(
							'<li class="nav-item"><a href="%s" data-href="https://www.xing.com/social/share?url=%s" target="_blank" rel="nofollow" class="social-xing share-xing"><i class="%s"></i></a></li>',
							esc_url(home_url('/')),
							esc_url(get_permalink($post_id)),
							esc_attr($icon_class)
						);
					break;
	
					case "tiktok":
						echo sprintf(
							'<li class="nav-item"><a href="%s" data-href="https://www.tiktok.com/share?url=%s" target="_blank" rel="nofollow" class="social-tiktok share-tiktok"><i class="%s"></i></a></li>',
							esc_url(home_url('/')),
							esc_url(get_permalink($post_id)),
							esc_attr($icon_class)
						);
					break;
				}
			}
			echo '</ul><!-- .social-share -->';
		}
	}

    public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

}
Hirxpert_Custom_Functions::instance();