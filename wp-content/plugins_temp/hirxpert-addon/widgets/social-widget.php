<?php
class Hirxpert_Social_Widget extends WP_Widget {
	/**
	 * Widget setup.
	 */
	function __construct() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'zozo_social_widget', 'description' => esc_html__('A widget that displays your social icons', 'hirxpert-addon') );
		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'zozo_social_widget' );
		/* Create the widget. */
		parent::__construct( 'zozo_social_widget', esc_html__('Hirxpert Social Icons', 'hirxpert-addon'), $widget_ops, $control_ops );
	}
	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );
		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] ); 
		$socialstyle = isset( $instance['socialstyle'] ) && !empty( $instance['socialstyle'] ) ? $instance['socialstyle'] : '';
		$social_icons_fore = isset( $instance['social_icons_fore'] ) && !empty( $instance['social_icons_fore'] ) ? $instance['social_icons_fore'] : '';
		$social_icons_hfore = isset( $instance['social_icons_hfore'] ) && !empty( $instance['social_icons_hfore'] ) ? $instance['social_icons_hfore'] : '';
		$social_icons_bg = isset( $instance['social_icons_bg'] ) && !empty( $instance['social_icons_bg'] ) ? $instance['social_icons_bg'] : '';  
		$social_icons_hbg = isset( $instance['social_icons_hbg'] ) && !empty( $instance['social_icons_hbg'] ) ? $instance['social_icons_hbg'] : '';
		$facebook = isset( $instance['facebook'] ) && !empty( $instance['facebook'] ) ? $instance['facebook'] : '';
		$twitter = isset( $instance['twitter'] ) && !empty( $instance['twitter'] ) ? $instance['twitter'] : '';
		$instagram = isset( $instance['instagram'] ) && !empty( $instance['instagram'] ) ? $instance['instagram'] : '';
		$bloglovin = isset( $instance['bloglovin'] ) && !empty( $instance['bloglovin'] ) ? $instance['bloglovin'] : '';
		$youtube = isset( $instance['youtube'] ) && !empty( $instance['youtube'] ) ? $instance['youtube'] : '';
		$tumblr = isset( $instance['tumblr'] ) && !empty( $instance['tumblr'] ) ? $instance['tumblr'] : '';
		$pinterest = isset( $instance['pinterest'] ) && !empty( $instance['pinterest'] ) ? $instance['pinterest'] : '';
		$dribbble = isset( $instance['dribbble'] ) && !empty( $instance['dribbble'] ) ? $instance['dribbble'] : '';
		$soundcloud = isset( $instance['soundcloud'] ) && !empty( $instance['soundcloud'] ) ? $instance['soundcloud'] : '';
		$vimeo = isset( $instance['vimeo'] ) && !empty( $instance['vimeo'] ) ? $instance['vimeo'] : '';
		$linkedin = isset( $instance['linkedin'] ) && !empty( $instance['linkedin'] ) ? $instance['linkedin'] : '';
		$rss = isset( $instance['rss'] ) && !empty( $instance['rss'] ) ? $instance['rss'] : '';
		$whatsapp = isset( $instance['whatsapp'] ) && !empty( $instance['whatsapp'] ) ? $instance['whatsapp'] : '';
		$tiktok = isset( $instance['tiktok'] ) && !empty( $instance['tiktok'] ) ? $instance['tiktok'] : '';
		
		$class_name = isset( $socialstyle ) && !empty( $socialstyle ) ? ' social-' . $socialstyle : '';
		
		$class_name .= isset( $social_icons_fore ) && !empty( $social_icons_fore ) ? ' social-' . $social_icons_fore : '';
		$class_name .= isset( $social_icons_hfore ) && !empty( $social_icons_hfore ) ? ' social-' . $social_icons_hfore : '';
		$class_name .= isset( $social_icons_bg ) && !empty( $social_icons_bg ) ? ' social-' . $social_icons_bg : '';
		$class_name .= isset( $social_icons_hbg ) && !empty( $social_icons_hbg ) ? ' social-' . $social_icons_hbg : '';
		
		/* Before widget (defined by themes). */
		echo wp_kses_post( $before_widget );
		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo ( $title != '' ? wp_kses_post( $before_title . $title . $after_title ) : '' );
		?>
		
			<ul class="nav social-icons social-widget widget-content<?php echo esc_attr( $class_name ); ?>">
				<?php if($facebook) : ?><li><a href="<?php echo esc_url($facebook); ?>" target="_blank" class="social-facebook"><i class="bi bi-facebook"></i></a></li><?php endif; ?>
				<?php if($twitter) : ?><li><a href="<?php echo esc_url($twitter); ?>" target="_blank" class="social-twitter"><i class="bi bi-twitter-x"></i></a></li><?php endif; ?>
				<?php if($instagram) : ?><li><a href="<?php echo esc_url($instagram); ?>" target="_blank" class="social-instagram"><i class="bi bi-instagram"></i></a></li><?php endif; ?>
				<?php if($pinterest) : ?><li><a href="<?php echo esc_url($pinterest); ?>" target="_blank" class="social-pinterest"><i class="bi bi-pinterest"></i></a></li><?php endif; ?>
				<?php if($bloglovin) : ?><li><a href="<?php echo esc_url($bloglovin); ?>" target="_blank" class="social-bloglovin"><i class="bi bi-heart"></i></a></li><?php endif; ?>
				<?php if($tumblr) : ?><li><a href="<?php echo esc_url($tumblr); ?>" target="_blank" class="social-tumblr"><i class="ti-tumblr-alt"></i></a></li><?php endif; ?>
				<?php if($youtube) : ?><li><a href="<?php echo esc_url($youtube); ?>" target="_blank" class="social-youtube"><i class="bi bi-youtube"></i></a></li><?php endif; ?>
				<?php if($dribbble) : ?><li><a href="<?php echo esc_url($dribbble); ?>" target="_blank" class="social-dribbble"><i class="bi bi-dribbble"></i></a></li><?php endif; ?>
				<?php if($soundcloud) : ?><li><a href="<?php echo esc_url($soundcloud); ?>" target="_blank" class="social-soundcloud"><i class="ti-soundcloud"></i></a></li><?php endif; ?>
				<?php if($vimeo) : ?><li><a href="<?php echo esc_url($vimeo); ?>" target="_blank" class="social-vimeo"><i class="bi bi-vimeo"></i></a></li><?php endif; ?>
				<?php if($linkedin) : ?><li><a href="<?php echo esc_url($linkedin); ?>" target="_blank" class="social-linkedin"><i class="bi bi-linkedin"></i></a></li><?php endif; ?>
				<?php if($rss) : ?><li><a href="<?php echo esc_url($rss); ?>" target="_blank" class="social-rss"><i class="bi bi-rss"></i></a></li><?php endif; ?>
				<?php if($whatsapp) : ?><li><a href="<?php echo esc_url($whatsapp); ?>" target="_blank" class="social-whatsapp"><i class="bi bi-whatsapp"></i></a></li><?php endif; ?>
				<?php if($tiktok) : ?><li><a href="<?php echo esc_url($tiktok); ?>" target="_blank" class="social-tiktok"><i class="bi bi-tiktok"></i></a></li><?php endif; ?>
			</ul>
			
			
		<?php
		/* After widget (defined by themes). */
		echo wp_kses_post( $after_widget );
	}
	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['socialstyle'] = strip_tags( $new_instance['socialstyle'] );
		$instance['social_icons_fore'] = strip_tags( $new_instance['social_icons_fore'] );
		$instance['social_icons_hfore'] = strip_tags( $new_instance['social_icons_hfore'] ); 
		$instance['social_icons_bg'] = strip_tags( $new_instance['social_icons_bg'] );
		$instance['social_icons_hbg'] = strip_tags( $new_instance['social_icons_hbg'] );
		$instance['facebook'] = esc_url( $new_instance['facebook'] );
		$instance['twitter'] = esc_url( $new_instance['twitter'] );
		$instance['instagram'] = esc_url( $new_instance['instagram'] );
		$instance['bloglovin'] = esc_url( $new_instance['bloglovin'] );
		$instance['youtube'] = esc_url( $new_instance['youtube'] );
		$instance['tumblr'] = esc_url( $new_instance['tumblr'] );
		$instance['pinterest'] = esc_url( $new_instance['pinterest'] );
		$instance['dribbble'] = esc_url( $new_instance['dribbble'] );
		$instance['soundcloud'] = esc_url( $new_instance['soundcloud'] );
		$instance['vimeo'] = esc_url( $new_instance['vimeo'] );
		$instance['linkedin'] = esc_url( $new_instance['linkedin'] );
		$instance['rss'] = esc_url( $new_instance['rss'] );
		if( isset( $new_instance['whatsapp'] ) ) $instance['whatsapp'] = esc_url( $new_instance['whatsapp'] );
		if( isset( $new_instance['tiktok'] ) ) $instance['tiktok'] = esc_url( $new_instance['tiktok'] );
		return $instance;
	}
	function form( $instance ) {
		/* Set up some default widget settings. */
		$defaults = array( 'title' => '', 'socialstyle' => '', 'social_icons_fore' => '', 'social_icons_hfore' => '', 'social_icons_bg' => '', 'social_icons_hbg' => '', 'facebook' => '', 'twitter' => '', 'instagram' => '', 'bloglovin' => '', 'youtube' => '', 'tumblr' => '', 'pinterest' => '', 'dribbble' => '', 'soundcloud' => '', 'vimeo' => '', 'linkedin' => '', 'rss' => '', 'whatsapp' => '', 'tiktok' => '' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'hirxpert-addon' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr($instance['title']); ?>" class="widefat" type="text" />
		</p>
		
		<!-- Select social icons style -->
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id('socialstyle') ); ?>"><?php esc_html_e('Select Post Type:', 'hirxpert-addon'); ?></label> 
		<select id="<?php echo esc_attr( $this->get_field_id('socialstyle') ); ?>" name="<?php echo esc_attr( $this->get_field_name('socialstyle') ); ?>" class="widefat" style="width:100%;">
			<?php $social_style = array( "transparent" => esc_html__( 'Transparent', 'hirxpert-addon' ), "squared" => esc_html__( 'Squared', 'hirxpert-addon' ), "rounded" => esc_html__( 'Rounded', 'hirxpert-addon' ), "circled" => esc_html__( 'Circled', 'hirxpert-addon' ) ); ?>
			<?php foreach($social_style as $skey => $sval) { ?>
				<option value='<?php echo esc_attr( $skey ); ?>' <?php if ($skey == $instance['socialstyle']) echo 'selected="selected"'; ?>><?php echo esc_attr( $sval ); ?></option>
			<?php } ?>
		</select>
		</p>
	
		
		<!-- Social Icons Fore. -->
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id('social_icons_fore') ); ?>"><?php esc_html_e('Social Icons Fore:', 'hirxpert-addon'); ?></label> 
		<select id="<?php echo esc_attr( $this->get_field_id('social_icons_fore') ); ?>" name="<?php echo esc_attr( $this->get_field_name('social_icons_fore') ); ?>" class="widefat" style="width:100%;">
			<?php $social_icons_fore = array( "black" => esc_html__( 'Black', 'hirxpert-addon' ), "white" => esc_html__( 'White', 'hirxpert-addon' ), "own" => esc_html__( 'Own Color', 'hirxpert-addon' ) ); ?>
			<?php foreach($social_icons_fore as $skey => $sval) { ?>
				<option value='<?php echo esc_attr( $skey ); ?>' <?php if ($skey == $instance['social_icons_fore']) echo 'selected="selected"'; ?>><?php echo esc_attr( $sval ); ?></option>
			<?php } ?>
		</select>
		</p>
		
		
		<!-- Social Icons Fore Hover. -->
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id('social_icons_hfore') ); ?>"><?php esc_html_e('Social Icons Fore Hover:', 'hirxpert-addon'); ?></label> 
		<select id="<?php echo esc_attr( $this->get_field_id('social_icons_hfore') ); ?>" name="<?php echo esc_attr( $this->get_field_name('social_icons_hfore') ); ?>" class="widefat" style="width:100%;">
			<?php $social_icons_hfore = array( "h-black" => esc_html__( 'Black', 'hirxpert-addon' ), "h-white" => esc_html__( 'White', 'hirxpert-addon' ), "h-own" => esc_html__( 'Own Color', 'hirxpert-addon' ) ); ?>
			<?php foreach($social_icons_hfore as $skey => $sval) { ?>
				<option value='<?php echo esc_attr( $skey ); ?>' <?php if ($skey == $instance['social_icons_hfore']) echo 'selected="selected"'; ?>><?php echo esc_attr( $sval ); ?></option>
			<?php } ?>
		</select>
		</p>
		
		<!-- Social Icons Bg. -->
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id('social_icons_bg') ); ?>"><?php esc_html_e('Social Icons Background:', 'hirxpert-addon'); ?></label> 
		<select id="<?php echo esc_attr( $this->get_field_id('social_icons_bg') ); ?>" name="<?php echo esc_attr( $this->get_field_name('social_icons_bg') ); ?>" class="widefat" style="width:100%;">
			<?php $social_icons_bg = array( "bg-transparent" => esc_html__( 'Transparent', 'hirxpert-addon' ), "bg-black" => esc_html__( 'Black', 'hirxpert-addon' ), "bg-white" => esc_html__( 'White', 'hirxpert-addon' ), "bg-light" => esc_html__( 'RGBA Light', 'hirxpert-addon' ), "bg-dark" => esc_html__( 'RGBA Dark', 'hirxpert-addon' ), "bg-own" => esc_html__( 'Own Color', 'hirxpert-addon' ) ); ?>
			<?php foreach($social_icons_bg as $skey => $sval) { ?>
				<option value='<?php echo esc_attr( $skey ); ?>' <?php if ($skey == $instance['social_icons_bg']) echo 'selected="selected"'; ?>><?php echo esc_attr( $sval ); ?></option>
			<?php } ?>
		</select>
		</p>
		<!-- Social Icons Background Hover. -->
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id('social_icons_hbg') ); ?>"><?php esc_html_e('Social Icons Background Hover:', 'hirxpert-addon'); ?></label> 
		<select id="<?php echo esc_attr( $this->get_field_id('social_icons_hbg') ); ?>" name="<?php echo esc_attr( $this->get_field_name('social_icons_hbg') ); ?>" class="widefat" style="width:100%;">
			<?php $social_icons_hbg = array( "hbg-transparent" => esc_html__( 'Transparent', 'hirxpert-addon' ), "hbg-black" => esc_html__( 'Black', 'hirxpert-addon' ), "hbg-white" => esc_html__( 'White', 'hirxpert-addon' ), "hbg-light" => esc_html__( 'RGBA Light', 'hirxpert-addon' ), "hbg-dark" => esc_html__( 'RGBA Dark', 'hirxpert-addon' ), "hbg-own" => esc_html__( 'Own Color', 'hirxpert-addon' ) ); ?>
			<?php foreach($social_icons_hbg as $skey => $sval) { ?>
				<option value='<?php echo esc_attr( $skey ); ?>' <?php if ($skey == $instance['social_icons_hbg']) echo 'selected="selected"'; ?>><?php echo esc_attr( $sval ); ?></option>
			<?php } ?>
		</select>
		</p>
		
		
		<p><?php esc_html_e( 'Note: Set your social links in the Customizer', 'hirxpert-addon' ); ?></p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>"><?php esc_html_e( 'Show Facebook:', 'hirxpert-addon' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'facebook' ) ); ?>" value="<?php echo esc_url($instance['facebook']); ?>" class="widefat" type="text" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>"><?php esc_html_e( 'Show Twitter:', 'hirxpert-addon' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'twitter' ) ); ?>" value="<?php echo esc_url($instance['twitter']); ?>" class="widefat" type="text" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'instagram' ) ); ?>"><?php esc_html_e( 'Show Instagram:', 'hirxpert-addon' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'instagram' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'instagram' ) ); ?>" value="<?php echo esc_url($instance['instagram']); ?>" class="widefat" type="text" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'pinterest' ) ); ?>"><?php esc_html_e( 'Show Pinterest:', 'hirxpert-addon' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'pinterest' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'pinterest' ) ); ?>" value="<?php echo esc_url($instance['pinterest']); ?>" class="widefat" type="text" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'bloglovin' ) ); ?>"><?php esc_html_e( 'Show Bloglovin:', 'hirxpert-addon' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'bloglovin' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'bloglovin' ) ); ?>" value="<?php echo esc_url($instance['bloglovin']); ?>" class="widefat" type="text" />
		</p>
				
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'tumblr' ) ); ?>"><?php esc_html_e( 'Show Tumblr:', 'hirxpert-addon' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'tumblr' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'tumblr' ) ); ?>" value="<?php echo esc_url($instance['tumblr']); ?>" class="widefat" type="text" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'youtube' ) ); ?>"><?php esc_html_e( 'Show Youtube:', 'hirxpert-addon' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'youtube' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'youtube' ) ); ?>" value="<?php echo esc_url($instance['youtube']); ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'dribbble' ) ); ?>"><?php esc_html_e( 'Show Dribbble:', 'hirxpert-addon' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'dribbble' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'dribbble' ) ); ?>" value="<?php echo esc_url($instance['dribbble']); ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'soundcloud' ) ); ?>"><?php esc_html_e( 'Show Soundcloud:', 'hirxpert-addon' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'soundcloud' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'soundcloud' ) ); ?>" value="<?php echo esc_url($instance['soundcloud']); ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'vimeo' ) ); ?>"><?php esc_html_e( 'Show Vimeo:', 'hirxpert-addon' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'vimeo' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'vimeo' ) ); ?>" value="<?php echo esc_url($instance['vimeo']); ?>" class="widefat" type="text" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'linkedin' ) ); ?>"><?php esc_html_e( 'Show Linkedin:', 'hirxpert-addon' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'linkedin' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'linkedin' ) ); ?>" value="<?php echo esc_url($instance['linkedin']); ?>" class="widefat" type="text" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'rss' ) ); ?>"><?php esc_html_e( 'Show RSS:', 'hirxpert-addon' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'rss' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'rss' ) ); ?>" value="<?php echo esc_url($instance['rss']); ?>" class="widefat" type="text" />
		</p>
		
		<?php if( isset( $instance['whatsapp'] ) ) : ?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'whatsapp' ) ); ?>"><?php esc_html_e( 'Show Whatsapp:', 'hirxpert-addon' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'whatsapp' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'whatsapp' ) ); ?>" value="<?php echo esc_url($instance['whatsapp']); ?>" class="widefat" type="text" />
		</p>
		<?php endif; ?>
		
		<?php if( isset( $instance['tiktok'] ) ) : ?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'tiktok' ) ); ?>"><?php esc_html_e( 'Show Tiktok:', 'hirxpert-addon' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'tiktok' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'tiktok' ) ); ?>" value="<?php echo esc_url($instance['tiktok']); ?>" class="widefat" type="text" />
		</p>
		<?php endif; ?>
		
	<?php
	}
}
?>