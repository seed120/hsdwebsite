<?php
/**
 * The template for displaying all single portfolio
 *
 */

$t = new CEACPTElements();

?>

<div class="wrap cea-content">

	<?php do_action( 'cea_team_before_content' ); ?>

	<div class="team-content-area">
	
		<?php $title_opt = $t->ceaGetThemeOpt('team-title-opt'); 
			$team_layout_options = $t->ceaGetThemeOpt('team-layout-options'); 
			$team_feature_image = $t->ceaGetThemeOpt('teams-default-format'); 
			$team_info = $t->ceaGetThemeOpt('team-default-metaitems');
		?>
		
		<div class="row team">
		
			<?php 
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
										<span class="team-email-label"><?php esc_html_e( 'Email', 'hirxpert-addon' ) ?></span>
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
										<span class="team-phone-label"><?php esc_html_e( 'Phone', 'hirxpert-addon' ) ?></span>
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
										<span class="team-website-label"><?php esc_html_e( 'Website', 'hirxpert-addon' ) ?></span>
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
										<span class="team-details-label"><?php esc_html_e( 'Experience', 'hirxpert-addon' ) ?></span>
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
					<?php the_content(); ?>
				</div><!-- .team-content-wrap -->
				
				<?php $t->ceaCPTNav(); ?>
				
			</div><!-- .col -->
		</div><!-- .row -->
						
	</div><!-- .team-content-area -->
	
	<?php do_action( 'cea_team_after_content' ); ?>
	
</div><!-- .wrap -->