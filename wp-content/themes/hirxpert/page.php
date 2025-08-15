<?php
/**
 * The template for displaying pages.
 */

get_header();

Hirxpert_Wp_Elements::$template = apply_filters( 'hirxpert_define_page_template', 'page' );
Hirxpert_Wp_Elements::$hirxpert_page_options = get_post_meta( get_the_ID(), 'hirxpert_post_meta', true );

?>

<main id="site-content">

	<?php 
		/*
		* Page title template call
		*/
		get_template_part( 'template-parts/page', 'title' );
	?>

	<div class="hirxpert-content-wrap container page">
		<div class="row">
			<?php
				$content_col_class = Hirxpert_Wp_Elements::hirxpert_get_content_class();
			?>
			<div class="<?php echo esc_attr( $content_col_class ); ?>">
				<?php
					if ( function_exists( 'is_woocommerce' ) && ( is_cart() || is_checkout() || is_account_page() ) ) {
						if ( is_cart() ) {
							echo do_shortcode( '[woocommerce_cart]' );
						} elseif ( is_checkout() ) {
							echo do_shortcode( '[woocommerce_checkout]' );
						} elseif ( is_account_page() ) {
							echo do_shortcode( '[woocommerce_my_account]' );
						}
					} else {
						// Regular WordPress page content
						if ( have_posts() ) {
							while ( have_posts() ) {
								the_post();
								get_template_part( 'template-parts/content' );
							}
						}
					}
				?>
			</div><!-- .col -->
			<?php get_template_part( 'template-parts/content-sidebar' ); ?>
		</div><!-- .row -->
	</div><!-- .container -->
</main><!-- #site-content -->

<?php get_footer(); ?>