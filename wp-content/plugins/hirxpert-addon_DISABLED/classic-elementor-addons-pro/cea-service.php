<?php
/**
 * The template for displaying all single service
 *
 */

$t = new CEACPTElements();

?>

<div class="wrap cea-content">

	<?php
		$portfolio_layoutsettings = $t->ceaGetThemeOpt('service-layout-options');

		do_action( 'cea_service_before_content' ); ?>

	<div class="portfolio-content-area">
	
		<?php $title_opt = $t->ceaGetThemeOpt('service-title-opt'); ?>
		
		<div class="service">
			<div class="service-info-wrap">
			
				<?php if( $title_opt ) : ?>
				<div class="service-title">
					<h2><?php the_title(); ?></h2>
				</div>
				<?php endif; // desg exists 
				if( $portfolio_layoutsettings === 'default-layout'){
					if( has_post_thumbnail( get_the_ID() ) ): ?>
						<div class="service-img">	
							<?php the_post_thumbnail( '', array( 'class' => 'img-fluid' ) ); ?>
						</div>
					<?php endif; // if thumb exists 
				}?>
				<div class="service-content">
					<?php the_content(); ?>
				</div>
				
				<?php $t->ceaCPTNav(); ?>
	
			</div> <!-- .service-info-wrap -->
		</div><!-- .service -->					
				
	</div><!-- .portfolio-content-area -->
	
	<?php do_action( 'cea_service_after_content' ); ?>
	
</div><!-- .wrap -->