<?php

add_action('wp_ajax_load_single_post', 'ajax_load_single_post');
add_action('wp_ajax_nopriv_load_single_post', 'ajax_load_single_post');

function ajax_load_single_post() {

	$post_types = array(
		'cea-portfolio',
		'cea-team',
		'cea-event',
		'cea-service',
		'cea-testimonial'
	);
    
	$post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
	if (!$post_id) {
        wp_send_json_error(['message' => 'Missing or invalid post ID']);
    }
	$post_type = isset( $_POST['post_type']) ? $_POST['post_type'] : ''; 
    $post_object = get_post($post_id);
    if (!$post_object || ! in_array( $post_object->post_type, $post_types, true ) || $post_object->post_status !== 'publish') {
        wp_send_json_error(['message' => 'Post not found or not published']);
    }

    global $post;
    $post = $post_object;
    setup_postdata($post);
	$style_url = '';
	require_once( CEA_PT_CORE_DIR . 'inc/cpt.elements.php' );
    $port = new CEACPTElements();
    
    $style_url = '';
	if ( class_exists('Elementor\Plugin') ) {
		if (\Elementor\Plugin::$instance->db->is_built_with_elementor($post_id)) { 
			$css_file = \Elementor\Core\Files\CSS\Post::create($post_id);
			$css_file->enqueue();
			$style_url = sprintf(
				'<link rel="stylesheet" id="elementor-post-%d" href="%s" type="text/css" media="all" />',
				$post_id,
				$css_file->get_url()
			);
		}
	}
	
	function get_elementor_content( $post_id ) {
		$elementor_content = '';
		$is_elementor = false;
		if (!class_exists('Elementor\Plugin')) {
			echo get_the_content();
			return;
		}
		$elementor = \Elementor\Plugin::instance();
		$content = $elementor->frontend->get_builder_content_for_display($post_id, true);
		if (!empty($content)) {
			echo $content;
			return;
		}
		if ( class_exists( '\Elementor\Core\Files\CSS\Post' ) ) {
			$css_file = new \Elementor\Core\Files\CSS\Post( $post_id );
			$css_file->enqueue();
			$css_url = $css_file->get_url();
		}
		$document = $elementor->documents->get($post_id);
		if ($document) {
			$elements_data = $document->get_elements_data();
			if ( $elements_data ) {
				ob_start();
				$document->print_elements_with_wrapper($elements_data);
				$content = ob_get_clean();
				$is_elementor = true;
			}
			if (!empty($content)) {
				echo $content;
				return;
			}
		}
	}

    ob_start();
    if( $post_type == 'cea-portfolio' ) : ?>
	<div class="container">
    	<div class="portfolio-single portfolio-model-2">
			<div class="row">
				<div class="col-sm-12">
					<div class="portfolio-format">
						<?php $port->ceaCPTPortfolioFormat(); ?>
					</div>
				</div>
			</div>
			<div class="row portfolio-details">
				<div class="col-sm-4">
					<div class="portfolio-meta">
						<?php $port->ceaCPTMeta(); ?>
					</div>
				</div>
				<div class="col-sm-8">
					<div class="portfolio-content-wrap">
						<div class="portfolio-content">
							<?php get_elementor_content( $post_id ); ?>
						</div>
						<?php $port->ceaCPTNav(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php elseif ( $post_type == 'cea-testimonial' ) : ?>
		<div class="container">
			<div class="testimonial">
				<div class="testimonial-content-wrap">
					<div class="testimonial-content">
						<?php get_elementor_content( $post_id ); ?>
					</div>
					<?php 
						$rate = get_post_meta( get_the_ID(), 'cea_testimonial_rating', true ); 
						if( $rate ) :
					?>
					<div class="testimonial-rating">
						<?php echo cea_star_rating( $rate );	?>
					</div>
					<?php endif;?>
				</div>
				<div class="testimonial-info">
					<?php if( has_post_thumbnail( get_the_ID() ) ): ?>
					<div class="testimonial-img">
						<?php the_post_thumbnail( 'thumbnail', array( 'class' => 'img-fluid' ) ); ?>
					</div>
					<?php endif; // if thumb exists ?>
					<?php $title_opt = $port->ceaGetThemeOpt('testimonial-title-opt'); ?>
					<?php if( $title_opt ) : ?>
					<div class="testimonial-title">
						<h2><?php the_title(); ?></h2>
					</div>
					<?php endif; // desg exists ?>
					
					<?php
						$desg = get_post_meta( get_the_ID(), 'cea_testimonial_designation', true ); 
						if( $desg ):
					?>
					<div class="testimonial-designation-wrap">
						<span class="testimonial-designation"><?php echo esc_html( $desg ); ?></span>				
						<?php
							$company = get_post_meta( get_the_ID(), 'cea_testimonial_company_name', true ); 
							if( $company ):
								$url = get_post_meta( get_the_ID(), 'cea_testimonial_company_url', true ); 
								if( $url ):
							?>
								<a href="<?php echo esc_url( $url ); ?>" title="<?php echo esc_html( $company ); ?>"><?php echo esc_html( $company ); ?></a>
							<?php else: ?>
								<span class="company-name"><?php echo esc_html( $company ); ?></span>
							<?php endif; // if has url
							endif; // if set company name 
						?>
					</div><!-- .testimonial-designation -->
					<?php endif; // desg exists ?>
					<?php $port->ceaCPTNav(); ?>	
				</div> <!-- .testimonial-info -->
			</div>
		</div>
	<?php elseif( $post_type == 'cea-service' ) : ?>
		<div class="container">
		<div class="service">
			<div class="service-info-wrap">
				<?php 
					$title_opt = $port->ceaGetThemeOpt('service-title-opt');
					$portfolio_layoutsettings = $port->ceaGetThemeOpt('service-layout-options');	
				 if( $title_opt ) : ?>
				<div class="service-title">
					<h2><?php get_the_title(); ?></h2>
				</div>
				<?php endif; // desg exists ?>
				<?php 
			if( $portfolio_layoutsettings === 'default-layout'){
				if( has_post_thumbnail( get_the_ID() ) ): ?>
				<div class="service-img">
					<?php the_post_thumbnail( '', array( 'class' => 'img-fluid' ) ); ?>
				</div>
				<?php endif; // if thumb exists 
			}?>
				<div class="service-content">
					<?php get_elementor_content( $post_id ); ?>
				</div>
				
				<?php $port->ceaCPTNav(); ?>
	
			</div> <!-- .service-info-wrap -->
		</div><!-- .service -->
		</div><!-- .container -->
	<?php elseif( $post_type == 'cea-event' ) : ?>
	<div class="container">
		<div class="row event">
			<div class="col-sm-12 event-inner">
			<?php 
				$title_opt = $port->ceaGetThemeOpt('event-title-opt');
				$event_date_time_options = $port->ceaGetThemeOpt('event-datetime-options');
				$event_layout_options = $port->ceaGetThemeOpt('event-layout-options');
				$event_date = get_post_meta( get_the_ID(), 'cea_event_start_date', true );
				$end_date = get_post_meta( get_the_ID(), 'cea_event_end_date', true );
				if( $event_layout_options === 'default-layout' ):
					$nav_pos = get_post_meta( get_the_ID(), 'cea_event_nav_position', true );
					$nav_pos == "top" ? $port->ceaCPTNav() : '';
				?>
					<?php 
					// Check if event exists or not
					$date_exist = !empty( $end_date ) ? $end_date : $event_date;
					if( $date_exist ):
						if( ( time() -( 60*60*24 ) ) > strtotime( $date_exist ) ): ?>
							<div class="alert alert-warning event-closed" role="alert">
								<span class="fa fa-exclamation-triangle"></span><?php echo apply_filters( 'cea_event_close', esc_html( 'Event closed.', 'cea-post-types' ) ); ?>
							</div>
							<?php 
						endif; // date compare with today
					endif; // $date_exist
				?>
					<div class="event-title">
						<?php if( $title_opt ) : ?>
							<h2><?php get_the_title(); ?></h2>
						<?php endif; // desg exists 
				endif;
				$date_format = get_post_meta( get_the_ID(), 'cea_event_date_format', true );
					if( $event_layout_options ==="custom-layout" && $event_date_time_options === "event-start-time" ):
						if( $event_date ): ?>
							<div class="event-title-date-time">
								<?php $event_time = get_post_meta( get_the_ID(), 'cea_event_time', true ); ?>
								<span class="event-title-time">
									<?php echo esc_html( $event_time ); ?>
								</span>
							</div>
						<?php endif; 
					elseif( $event_layout_options ==="custom-layout" && $event_date_time_options === "event-start-date" ):
						if( $event_date ): ?>
							<div class="event-title-date-time">
								<span class="event-title-date">
									<?php echo !empty( $date_format ) ? date( $date_format, strtotime( $event_date ) ) : $event_date; ?>
								</span>
							</div>
						<?php endif;
					elseif( $event_layout_options ==="custom-layout" && $event_date_time_options === "event-date-time" || $event_layout_options === "default-layout" ):
						if( $event_date ): ?>
						<div class="event-title-date-time">
							<span class="event-title-date">
								<?php echo !empty( $date_format ) ? date( $date_format, strtotime( $event_date ) ) : $event_date; ?>
							</span>
							<?php
								$event_time = get_post_meta( get_the_ID(), 'cea_event_time', true );
							?>
							<span class="event-title-time">
								<?php echo esc_html( $event_time ); ?>
							</span>
						</div>
						<?php endif; 
					endif; ?>
				</div>
				<?php
					if( $event_layout_options === 'custom-layout' && $event_feature_image || $event_layout_options === 'default-layout' ):
						if( has_post_thumbnail( get_the_ID() ) ): ?>
							<div class="event-image-wrap">
								<div class="event-img">
									<?php the_post_thumbnail( '', array( 'class' => 'img-fluid' ) ); ?>
								</div>
							</div> <!-- .team-content-wrap -->
						<?php endif; // if thumb exists
					endif;
				?>
				<div class="team-content">
				    <?php get_elementor_content( $post_id ); ?>
				</div> <!-- .team-content -->
				<?php
					$event_elements_json = get_post_meta( get_the_ID(), 'cea_event_event_info_items', true );
					$event_elements = json_decode( stripslashes( $event_elements_json ), true );
					$event_elements = $event_elements['Enable'];
					$event_col = get_post_meta( get_the_ID(), 'cea_event_col_layout', true );
					$event_col = $event_col != '' ? explode( "-", $event_col ) : array( '3', '3', '3' );
					$i = 0;
				?>
				<div class="event-info-wrap">
					<div class="row">
					
					<?php //foreach start 
					$event_date = get_post_meta( get_the_ID(), 'cea_event_start_date', true );
					$end_date = get_post_meta( get_the_ID(), 'cea_event_end_date', true );
						foreach( $event_elements as $elem => $val ) :
						
							switch( $elem ) :
							
								case "event-details" :
									if( $event_layout_options === 'custom-layout' && $event_details || $event_layout_options === 'default-layout' ):
									?>
									<div class="col-sm-<?php echo esc_attr( $event_col[$i++] ); ?>">
										<div class="event-info">
											<h4><?php echo apply_filters( 'cea_event_info_details', 'Event Details' ); ?></h4>
											<?php
											
												//Organizer Details
												$organizer = get_post_meta( get_the_ID(), 'cea_event_organiser_name', true );
												$organizer_desg = get_post_meta( get_the_ID(), 'cea_event_organiser_designation', true );
												if( $organizer ): ?>
												<p class="event-organizer">
													<span class="event-subtitle">
														<strong><?php
															echo apply_filters( 'cea_event_organizer_label', 'Organizer' ); ?> : 
														</strong>
													</span>
													<?php echo esc_html( $organizer ); ?>
													<?php if( $organizer_desg ): ?>
													<span class="event-organizer-designation"> <?php echo esc_html( $organizer_desg ); ?></span>
													<?php endif; ?>
												</p><?php
												endif;
												
												//Evenet Start Date
												if( $event_date ): ?>
												<p class="event-start-date">
													<span class="event-subtitle">
														<strong><?php
															echo apply_filters( 'cea_event_start_label', 'Start Date' ); ?> : 
														</strong>
													</span>
													<?php echo !empty( $date_format ) ? date( $date_format, strtotime( $event_date ) ) : $event_date; ?>
												</p><?php
												endif;
												
												//Evenet End Date
												if( $end_date ): ?>
												<p class="event-end-date">
													<span class="event-subtitle">
														<strong><?php
															echo apply_filters( 'cea_event_end_label', 'End Date' ); ?> : 
														</strong>
													</span>
													<?php echo !empty( $date_format ) ? date( $date_format, strtotime( $end_date ) ) : $end_date; ?>
												</p><?php
												endif;
												
												//Event Time
												$event_time = get_post_meta( get_the_ID(), 'cea_event_time', true );
												if( $event_time ): ?>
												<p class="event-time">
													<span class="event-subtitle">
														<strong><?php
															echo apply_filters( 'cea_event_time_label', 'Time' ); ?> : 
														</strong>
													</span>
													<?php echo esc_html( $event_time ); ?>
												</p><?php
												endif;
												
												//Event Cost
												$event_cost = get_post_meta( get_the_ID(), 'cea_event_cost', true );
												if( $event_cost ): ?>
												<p class="event-cost">
													<span class="event-subtitle">
														<strong><?php
															echo apply_filters( 'cea_event_cost_label', 'Cost' ); ?> : 
														</strong>
													</span>
													<?php echo esc_html( $event_cost ); ?>
												</p><?php
												endif;
												
												//Event Custom Link
												$event_link = get_post_meta( get_the_ID(), 'cea_event_link', true );
												$event_text = get_post_meta( get_the_ID(), 'cea_event_link_text', true );
												$event_target = get_post_meta( get_the_ID(), 'cea_event_link_target', true );
												if( $event_link ): ?>
												<p class="event-cost">
													<span class="event-subtitle">
														<strong><?php
															echo apply_filters( 'cea_event_cost_label', 'More About Event' ); ?> : 
														</strong>
													</span>
													<a class="btn btn-default" href="<?php echo esc_url( $event_link ); ?>" target="<?php echo esc_attr( $event_target ); ?>"><?php echo esc_html( $event_text ); ?></a>
												</p><?php
												endif;
												
											?>
										</div><!-- .event-info -->
									</div><!-- .col -->
									<?php 
								endif;
								break; 
								case "event-venue" : 
									if( $event_layout_options === 'custom-layout' && $event_venue_details || $event_layout_options === 'default-layout' ):
									?>
									<div class="col-sm-<?php echo esc_attr( $event_col[$i++] ); ?>">
										<div class="event-venue">
											<h4><?php echo apply_filters( 'cea_event_venue_name', 'Event Venue' ); ?></h4>
											
											<?php
											//Event Venue
											$venue_name = get_post_meta( get_the_ID(), 'cea_event_venue_name', true );
											if( $venue_name ): ?>
											<p class="event-venue-name">
												<span class="event-subtitle">
													<strong><?php
														echo apply_filters( 'cea_event_venue_label', 'Venue' ); ?> : 
													</strong>
												</span>
												<?php echo esc_html( $venue_name ); ?>
											</p><?php
											endif;
											
											//Event Address
											$venue_address = get_post_meta( get_the_ID(), 'cea_event_venue_address', true );
											if( $venue_address ): ?>
											<p class="event-address">
												<span class="event-subtitle">
													<strong><?php
														echo apply_filters( 'cea_event_venue_address_label', 'Address' ); ?> : 
													</strong>
												</span>
												<?php echo esc_textarea( $venue_address ); ?>
											</p><?php
											endif;
											
											//Event Email
											$email = get_post_meta( get_the_ID(), 'cea_event_email', true );
											if( $email ): ?>
											<p class="event-email">
												<span class="event-subtitle">
													<strong><?php
														echo apply_filters( 'cea_event_email_label', 'E-mail' ); ?> : 
													</strong>
												</span>
												<?php echo esc_html( $email ); ?>
											</p><?php
											endif;
											
											//Event Phone
											$phone = get_post_meta( get_the_ID(), 'cea_event_phone', true );
											if( $phone ): ?>
											<p class="event-phone">
												<span class="event-subtitle">
													<strong><?php
														echo apply_filters( 'cea_event_phone_label', 'Phone' ); ?> : 
													</strong>
												</span>
												<?php echo esc_html( $phone ); ?>
											</p><?php
											endif;
											
											//Event Website
											$website = get_post_meta( get_the_ID(), 'cea_event_website', true );
											if( $website ): ?>
											<p class="event-website">
												<span class="event-subtitle">
													<strong><?php
														echo apply_filters( 'cea_event_website_label', 'Website' ); ?> : 
													</strong>
												</span>
												<a href="<?php echo esc_url( $website ); ?>" target="_blank"><?php echo esc_url( $website ); ?></a>
											</p><?php
											endif;
											
											?>
										</div>
									</div><!-- .col -->
							
							<?php 
									endif;
								break; 
								case "event-map" : 
									if( $event_layout_options === 'custom-layout' && $event_venue_map || $event_layout_options === 'default-layout' ):
										?>
						
										<?php 
											$lat = get_post_meta( get_the_ID(), 'cea_event_gmap_latitude', true );
											if( $lat ):
											wp_enqueue_script( 'cea-gmaps' );
										?>
										<div class="col-sm-<?php echo esc_attr( $event_col[$i++] ); ?>">
											<div class="event-map">
												<?php
												$lang = get_post_meta( get_the_ID(), 'cea_event_gmap_longitude', true );
												$marker = get_post_meta( get_the_ID(), 'cea_event_gmap_marker', true );
												$map_style = get_post_meta( get_the_ID(), 'cea_event_gmap_style', true );
												$map_height = get_post_meta( get_the_ID(), 'cea_event_gmap_height', true );
												$map_height = !empty( $map_height ) ? $map_height : '400';
												?>
					
												<div id="ceagmap" class="ceagmap" style="width:100%;height:<?php echo absint( $map_height ); ?>px;" data-map-lat="<?php echo esc_attr( $lat ); ?>" data-map-lang="<?php echo esc_attr( $lang ); ?>" data-map-style="<?php echo esc_attr( $map_style ); ?>" data-map-marker="<?php echo esc_url( $marker ); ?>"></div>
					
											</div><!-- .event-map -->
										</div><!-- .col -->
										<?php endif; // if map meta exists 
										
									endif;?>
								<?php 
								break; 
								case "event-form" : 
									if( $event_layout_options === 'custom-layout' && $event_venue_form || $event_layout_options === 'default-layout' ):
									?>
									<?php 
										$contact = get_post_meta( get_the_ID(), 'cea_event_contact_form', true );
										if( $contact ):
									?>
									<div class="col-sm-<?php echo esc_attr( $event_col[$i++] ); ?>">
										<div class="event-contact">
											<?php echo do_shortcode( $contact ); ?>
										</div><!-- .event-map -->
									</div><!-- .col -->
									<?php endif; // if map meta exists ?>
									<?php 
									endif;
								break;
							endswitch;
						endforeach;//foreach end 
					?>
					</div><!-- .row -->

					<?php 
						$nav_pos = get_post_meta( get_the_ID(), 'cea_event_nav_position', true );
						$nav_pos == "bottom" ? $port->ceaCPTNav() : '';
					?>

				</div><!-- .event-info-wrap -->
			</div><!-- .event-inner-->
		</div><!-- .event -->
	</div><!-- .container -->
	<?php elseif( $post_type == 'cea-team' ) : ?>
		<div class="container">
		<div class="row team">
		<?php 
		$title_opt = $port->ceaGetThemeOpt('team-title-opt');
		$team_layout_options = $port->ceaGetThemeOpt('team-layout-options'); 
		$team_feature_image = $port->ceaGetThemeOpt('teams-default-format'); 
		$team_info = $port->ceaGetThemeOpt('team-default-metaitems');
			if( $team_layout_options === "default-layout" || $team_layout_options === "custom-layout" && $team_feature_image ):
				if( has_post_thumbnail( get_the_ID() ) ): ?>
					<div class="col-sm-5 team-image-wrap">
						<div class="team-img">
							<?php the_post_thumbnail( 'full', array( 'class' => 'img-fluid' ) ); ?>
						</div>
					</div> <!-- .team-content-wrap -->
				<?php endif; // if thumb exists 
			endif;
			if( $team_layout_options === "default-layout" || $team_layout_options === "custom-layout" && $team_info ):
				
				if( $team_layout_options === "default-layout" || $team_layout_options === "custom-layout" && $team_info ):
					?>
					<div class="col-sm-7 team-info">
				<?php else: ?>
					<div class="col-sm-12 team-info">
				<?php endif;
				  ?>
				<div class="team-title">
					<?php if( $title_opt ) : ?>
						<h2><?php the_title(); ?></h2>
					<?php endif; // desg exists ?>
					<?php
						$desg = get_post_meta( get_the_ID(), 'cea_team_designation', true ); 
						if( $desg ):
					?>
					<div class="team-designation-wrap">
						<span class="team-designation"><?php echo esc_html( $desg ); ?></span>				
					</div><!-- .team-designation -->
					<?php endif; // desg exists ?>
				</div><!-- .team-title -->
				<div class="team-other-details">
					<div class="row">
						<?php
							$email = get_post_meta( get_the_ID(), 'cea_team_email', true ); 
							if( $email ):
						?>
						<div class="col-md-6 team-email-wrap">
							<div class="team-media media">
								<div class="team-details-icon"><i class="fa fa-envelope"></i></div>
								<div class="media-body">
									<span class="team-email-label"><?php esc_html_e( 'Email', 'gigas-addon' ) ?></span>
									<a href="mailto:<?php echo esc_attr( $email ); ?>" class="team-email"><?php echo esc_html( $email ); ?></a>			
								</div>
							</div><!-- .team-media -->			
						</div><!-- .team-email-wrap -->
						<?php endif; // email exists ?>
						
						<?php
							$phone = get_post_meta( get_the_ID(), 'cea_team_phone', true ); 
							if( $phone ):
						?>
						<div class="col-md-6 team-phone-wrap">
							<div class="team-media media">
								<div class="team-details-icon"><i class="fa fa-phone"></i></div>
								<div class="media-body">
									<span class="team-phone-label"><?php esc_html_e( 'Phone', 'gigas-addon' ) ?></span>
									<a href="tel:<?php echo esc_attr( trim( $phone ) ); ?>" class="team-phone"><?php echo esc_html( $phone ); ?></a>		
								</div>
							</div><!-- .team-media -->		
						</div><!-- .team-phone-wrap -->
						<?php endif; // phone exists ?>
						
						<?php
							$website = get_post_meta( get_the_ID(), 'cea_team_website', true ); 
							if( $website ):
						?>
						<div class="col-md-6 team-website-wrap">
							<div class="team-media media">
								<div class="team-details-icon"><i class="fa fa-link"></i></div>
								<div class="media-body">
									<span class="team-website-label"><?php esc_html_e( 'Website', 'gigas-addon' ) ?></span>
									<a href="<?php echo esc_url( trim( $website ) ); ?>" class="team-website"><?php echo esc_html( $website ); ?></a>
								</div>
							</div><!-- .team-media -->			
						</div><!-- .team-website-wrap -->
						<?php endif; // website exists ?>
						
						<?php
							$experience = get_post_meta( get_the_ID(), 'cea_team_experience', true ); 
							if( $experience ):
						?>
						<div class="col-md-6 team-experience-wrap">
							<div class="team-media media">
								<div class="team-details-icon"><i class="fa fa-user"></i></div>
								<div class="media-body">
									<span class="team-details-label"><?php esc_html_e( 'Experience', 'gigas-addon' ) ?></span>
									<span class="team-experience"><?php echo esc_html( $experience ); ?></span>
								</div>
							</div><!-- .team-media -->
						</div><!-- .team-experience-wrap -->
						<?php endif; // experience exists ?>
						
					</div><!-- .row -->
				</div><!-- .team-other-details -->
				<div class="team-social-wrap">
					<ul class="nav social-icons team-social">
						<?php
						
							$taget = get_post_meta( get_the_ID(), 'cea_team_link_target', true );
						
							$social_media = array( 
								'social-facebook' => 'fa fa-facebook', 
								'social-twitter' => 'bi bi-twitter-x', 
								'social-instagram' => 'fa fa-instagram',
								'social-linkedin' => 'fa fa-linkedin', 
								'social-pinterest' => 'fa fa-pinterest-p', 
								'social-gplus' => 'fa fa-google-plus',  
								'social-youtube' => 'fa fa-youtube-play', 
								'social-vimeo' => 'fa fa-vimeo',
								'social-flickr' => 'fa fa-flickr', 
								'social-dribbble' => 'fa fa-dribbble'
							);
							
							$social_opt = array(
								'social-facebook' => 'cea_team_facebook', 
								'social-twitter' => 'cea_team_twitter',
								'social-instagram' => 'cea_team_instagram',
								'social-linkedin' => 'cea_team_linkedin',
								'social-pinterest' => 'cea_team_pinterest',
								'social-gplus' => 'cea_team_gplus',
								'social-youtube' => 'cea_team_youtube',
								'social-vimeo' => 'cea_team_vimeo',
								'social-flickr' => 'cea_team_flickr',
								'social-dribbble' => 'cea_team_dribbble',
							);
						
						
							// Actived social icons from theme option output generate via loop
							foreach( $social_media as $key => $class ){
	
								$social_url = get_post_meta( get_the_ID(), $social_opt[$key], true );
								if( $social_url ): ?>
									<li>
										<a class="<?php echo esc_attr( $key ); ?>" href="<?php echo esc_url( $social_url ); ?>" target="<?php echo esc_attr( $taget ); ?>">
											<i class="<?php echo esc_attr( $class ); ?>"></i>
										</a>
									</li>
								<?php
								endif;

							}
						?>
					</ul>
				</div> <!-- .team-social-wrap -->
				</div> <!-- .team-info --> 
			<?php endif; ?>
		</div> <!-- .team -->
		<div class="row">
			<div class="col-md-12">
				<div class="team-content-wrap">
					<?php get_elementor_content( $post_id ); ?>
				</div><!-- .team-content-wrap -->
				<?php $port->ceaCPTNav(); ?>
			</div><!-- .col -->
		</div><!-- .row -->
		
		</div><!-- .container -->
	<?php endif;
    $content = ob_get_clean();

    wp_reset_postdata();

    wp_send_json_success([
        'content' => $content,
        'title'   => get_the_title($post_id),
		'doc_title' => html_entity_decode(get_the_title($post_id)) . ' - ' . get_bloginfo('name'),
        'url'     => get_permalink($post_id),
		'is_elementor' => \Elementor\Plugin::$instance->db->is_built_with_elementor($post_id),
		'style_url' => $style_url,
		'edit_url'  => admin_url('post.php?post='. $post_id .'&action=edit'),
		'elementor_url' => admin_url('post.php?post='. $post_id .'&action=elementor'),
    ]);
	
}