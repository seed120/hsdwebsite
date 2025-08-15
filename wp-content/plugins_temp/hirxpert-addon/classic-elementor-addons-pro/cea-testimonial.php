<?php
/**
 * The template for displaying all single service
 *
 */
 
$t = new CEACPTElements();

?>

<div class="wrap cea-content">

	<?php do_action( 'cea_testimonial_before_content' ); ?>

	<div class="testimonial-content-area">
						
		<?php $title_opt = $t->ceaGetThemeOpt('testimonial-title-opt'); ?>
		
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
					
	</div><!-- .testimonial-content-area -->
	
	<?php do_action( 'cea_testimonial_after_content' ); ?>
	
</div><!-- .wrap -->