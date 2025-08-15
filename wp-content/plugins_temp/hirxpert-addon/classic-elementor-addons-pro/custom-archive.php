<?php
/**
 * The template for displaying archive custom posts.
 */

get_header();

Hirxpert_Wp_Elements::$template = apply_filters( 'hirxpert_define_custom_single_template', 'custom-archive' );
?>

<main id="site-content">

	<?php 
		/*
		* Page title template call
		*/
		get_template_part( 'template-parts/page', 'title' );
	?>
	
	<div class="hirxpert-content-wrap container">
		<div class="row">
			<div class="col order-md-2">
				<?php
					if( is_tax('portfolio-categories') || is_tax('portfolio-tags') ){
						require_once ( HIRXPERT_ADDON_DIR . '/classic-elementor-addons-pro/cea-portfolio-archive-content.php' );	
					}elseif( is_tax('service-categories') || is_tax('service-tags') ) {
						require_once ( HIRXPERT_ADDON_DIR . '/classic-elementor-addons-pro/cea-service-archive-content.php' );	
					}
				?>
				<?php get_template_part( 'template-parts/pagination' ); ?>
			</div><!-- .col -->
			<?php get_template_part( 'template-parts/content-sidebar' ); ?>
		</div><!-- .row -->
	</div><!-- .hirxpert-content-wrap -->

</main><!-- #site-content -->

<?php get_footer(); ?>
