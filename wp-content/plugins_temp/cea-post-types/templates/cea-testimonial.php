<?php
/**
 * The template for displaying all single service
 *
 */

get_header(); 

$t = new CEACPTElements();
$testimonial_sidebars = $t->ceaGetThemeOpt('cpt-testimonial-sidebars');
$sidebar_class = array( '12', '8', '4' );
$sidebar_stat = false;
if( !empty( $testimonial_sidebars ) && is_active_sidebar( $testimonial_sidebars ) ){
	$sidebar_stat = true;
}

?>

<div class="wrap cea-content">

	<?php do_action( 'cea_testimonial_before_content' ); ?>

	<div class="testimonial-content-area">
		<div class="container">
			<div class="row">
				<div class="col-md-<?php echo esc_attr( $sidebar_stat ? $sidebar_class[1] : $sidebar_class[0] ); ?>">
				
					<?php
					$title_opt = $t->ceaGetThemeOpt('testimonial-title-opt');
					
					while ( have_posts() ) : the_post();
					?>
						
						<div class="testimonial">
							<div class="testimonial-content-wrap">
								<div class="testimonial-content">
									<?php the_content(); ?>
								</div>
								<?php 
									$rate = get_post_meta( get_the_ID(), 'cea_testimonial_rating', true ); 
									if( $rate ) :
								?>
								<div class="testimonial-rating">
									<?php echo cea_star_rating( $rate );	?>
								</div>
								<?php endif;
								$review_title= get_post_meta( get_the_ID(), 'cea_testimonial_review_title', true ); 
									if( $review_title ) :
								?>
								<div class="review_title">
									<?php echo esc_html( $review_title );	?>
								</div>
								<?php endif; // if put rate  ?>	
							</div> <!-- .testimonial-content-wrap -->
							
							<div class="testimonial-info">
								<?php if( has_post_thumbnail( get_the_ID() ) ): ?>
								<div class="testimonial-img">
									<?php the_post_thumbnail( 'thumbnail', array( 'class' => 'img-fluid' ) ); ?>
								</div>
								<?php endif; // if thumb exists ?>
								
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
								
								<?php $t->ceaCPTNav(); ?>
								
							</div> <!-- .testimonial-info --> 
						</div><!-- .testimonial -->
					
					<?php
					endwhile; // End of the loop.
					?>
					
				</div><!-- .col -->
				
				<?php if( $sidebar_stat ): ?>
				<div class="col-md-<?php echo esc_attr( $sidebar_class[2] ); ?>">
				<aside class="sidebar-widget widget-area">
					<?php dynamic_sidebar( $testimonial_sidebars ); ?>
				</aside><!-- #secondary -->
				</div><!-- .col -->
				<?php endif; ?>
				
			</div><!-- .row -->
		</div><!-- .container -->
	</div><!-- .testimonial-content-area -->
	
	<?php do_action( 'cea_testimonial_after_content' ); ?>
	
</div><!-- .wrap -->

<?php
get_footer();