<?php
/**
 * The template for displaying all single portfolio
 *
 */

$t = new CEACPTElements();

?>

<div class="wrap cea-content">

	<?php do_action( 'cea_event_before_content' ); ?>

	<div class="event-content-area">
						
		<?php $title_opt = $t->ceaGetThemeOpt('event-title-opt');
		$event_date_time_options = $t->ceaGetThemeOpt('event-datetime-options');
		$event_layout_options = $t->ceaGetThemeOpt('event-layout-options');
		$event_feature_image = $t->ceaGetThemeOpt('event-default-format');
		$event_details = $t->ceaGetThemeOpt('event-default-event-details');
		$event_venue_details = $t->ceaGetThemeOpt('event-default-event-venue');
		$event_venue_map = $t->ceaGetThemeOpt('event-default-event-map');
		$event_venue_form = $t->ceaGetThemeOpt('event-default-event-form');
		$event_date = get_post_meta( get_the_ID(), 'cea_event_start_date', true );
		$end_date = get_post_meta( get_the_ID(), 'cea_event_end_date', true );
						?>
		<div class="row event">
			<div class="col-sm-12 event-inner">
			
				<?php 
				if( $event_layout_options === 'default-layout' ):
					$nav_pos = get_post_meta( get_the_ID(), 'cea_event_nav_position', true );
					$nav_pos == "top" ? $t->ceaCPTNav() : '';
				?>
				
				<?php 
					// Check if event exists or not
					
					$date_exist = !empty( $end_date ) ? $end_date : $event_date;
					
					if( $date_exist ):
						if( ( time() -( 60*60*24 ) ) > strtotime( $date_exist ) ): 
				?>
					
					<div class="alert alert-warning event-closed" role="alert">
						<span class="fa fa-exclamation-triangle"></span><?php echo apply_filters( 'cea_event_close', esc_html( 'Event closed.', 'hirxpert-addon' ) ); ?>
					</div>
				<?php 
						endif; // date compare with today
					endif; // $date_exist
				?>
					
				<div class="event-title">
					<?php if( $title_opt ) : ?>
						<h2><?php the_title(); ?></h2>
						<?php endif; // desg exists 
				endif;					
									
						$date_format = get_post_meta( get_the_ID(), 'cea_event_date_format', true );
						if( $event_layout_options ==="custom-layout" && $event_date_time_options === "event-start-time" ):
							if( $event_date ):
								?>
								<div class="event-title-date-time">
					<?php
										$event_time = get_post_meta( get_the_ID(), 'cea_event_time', true );
									?>
									<span class="event-title-time">
										<?php echo esc_html( $event_time ); ?>
									</span>
								</div>
							<?php endif; 
						elseif( $event_layout_options ==="custom-layout" && $event_date_time_options === "event-start-date" ):
							if( $event_date ):
								?>
								<div class="event-title-date-time">
									<span class="event-title-date">
										<?php echo !empty( $date_format ) ? date( $date_format, strtotime( $event_date ) ) : $event_date; ?>
									</span>
								</div>
							<?php endif;
						elseif( $event_layout_options ==="custom-layout" && $event_date_time_options === "event-date-time" || $event_layout_options === "default-layout" ):
						if( $event_date ):
					?>
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
						endif;
					?>
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
					<?php the_content(); ?>
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
				</div><!-- .event-info-wrap -->
				
				<?php 
					$nav_pos = get_post_meta( get_the_ID(), 'cea_event_nav_position', true );
					$nav_pos == "bottom" ? $t->ceaCPTNav() : '';
				?>
			
			</div><!-- .col -->
		</div><!-- .event -->				
				
	</div><!-- .event-content-area -->
	
	<?php do_action( 'cea_event_after_content' ); ?>
	
</div><!-- .wrap -->