<?php
/**
 * The template for displaying single custom posts.
 */

get_header();

$cea_post_types = array( 'cea-portfolio', 'cea-team', 'cea-service', 'cea-event', 'cea-testimonial' );
$cea_post_templates = array(
	'cea-portfolio' => array( 'option' => 'cea-portfolio', 'template' => HIRXPERT_ADDON_DIR . '/classic-elementor-addons-pro/cea-portfolio.php' ),
	'cea-team' => array( 'option' => 'cea-team', 'template' => HIRXPERT_ADDON_DIR . '/classic-elementor-addons-pro/cea-team.php' ),
	'cea-service' => array( 'option' => 'cea-service', 'template' => HIRXPERT_ADDON_DIR . '/classic-elementor-addons-pro/cea-service.php' ),
	'cea-event' => array( 'option' => 'cea-event', 'template' => HIRXPERT_ADDON_DIR . '/classic-elementor-addons-pro/cea-event.php' ),
	'cea-testimonial' => array( 'option' => 'cea-testimonial', 'template' => HIRXPERT_ADDON_DIR . '/classic-elementor-addons-pro/cea-testimonial.php' ),
);

if( is_singular( $cea_post_types ) ) {
	$post_type = get_post_type();
	Hirxpert_Wp_Elements::$template = $cea_post_templates[$post_type]['option'];
}else{
	Hirxpert_Wp_Elements::$template = apply_filters( 'hirxpert_define_custom_single_template', 'custom-single' );
}
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
			<?php
				$content_col_class = Hirxpert_Wp_Elements::hirxpert_get_content_class();
			?>
			<div class="<?php echo esc_attr( $content_col_class ); ?>">
				<?php
					if ( have_posts() ) {
						while ( have_posts() ) {
							the_post();
							
							do_action( 'hirxpert_custom_single_content_before' );

							if( is_singular( $cea_post_types ) ) {
								$post_type = get_post_type();
								require_once ( $cea_post_templates[$post_type]['template'] );
							}else{
								the_content();
							}

							do_action( 'hirxpert_custom_single_content_after' );
						}
					}
				?>
			</div><!-- .col -->
			<?php 
				get_template_part( 'template-parts/content-sidebar' ); 
			?>
		</div><!-- .row -->
	</div><!-- .container -->
</main><!-- #site-content -->

<?php get_footer(); ?>
