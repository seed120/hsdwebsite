<?php

// namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Classic_Elementor_Addons\Helper\Post_Helper as Cea_Post_Helper;

/**
 * The template for displaying all single service
 *
 */

get_header(); 

$t = new CEACPTElements();
$service_sidebars = $t->ceaGetThemeOpt('cpt-service-sidebars');
$sidebar_class = apply_filters( 'cea_service_single_cols', array( '12', '8', '4' ) );
$sidebar_stat = false;
if( !empty( $service_sidebars ) && is_active_sidebar( $service_sidebars ) ){
	$sidebar_stat = true;
}

?>

<div class="wrap cea-content">

	<?php
		$portfolio_layoutsettings = $t->ceaGetThemeOpt('service-layout-options');

		do_action( 'cea_service_before_content' ); ?>

	<div class="portfolio-content-area">
		<div class="container">
			<div class="row">
				<div class="col-md-<?php echo esc_attr( $sidebar_stat ? $sidebar_class[1] : $sidebar_class[0] ); ?>">
		<?php
		// Title Options
		$title_opt = $t->ceaGetThemeOpt('service-title-opt');
		
		while ( have_posts() ) : the_post();
		?>
			<div class="service">
				<div class="service-info-wrap">
				
					<?php if( $title_opt ) : ?>
					<div class="service-title">
						<h2><?php the_title(); ?></h2>
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
						<?php the_content(); ?>
					</div>
					
					<?php $t->ceaCPTNav(); ?>
		
				</div> <!-- .service-info-wrap -->
			</div><!-- .service -->
		
		<?php
		endwhile; // End of the loop.
?>	
				</div><!-- .col -->
				
				<?php if( $sidebar_stat ): ?>
				<div class="col-md-<?php echo esc_attr( $sidebar_class[2] ); ?>">
				<aside class="sidebar-widget widget-area">
					<?php dynamic_sidebar( $service_sidebars ); ?>
				</aside><!-- #secondary -->
				</div><!-- .col -->
				<?php endif; ?>
				
			</div><!-- .row -->
		</div><!-- .container -->
	</div><!-- .portfolio-content-area -->
	
	<?php do_action( 'cea_service_after_content' ); ?>
	
</div><!-- .wrap -->

<?php
get_footer();