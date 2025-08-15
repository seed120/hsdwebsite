<?php
get_header();
Hirxpert_Wp_Elements::$template = apply_filters( 'hirxpert_define_page_template', 'page' );
Hirxpert_Wp_Elements::$hirxpert_page_options = get_post_meta( get_the_ID(), 'hirxpert_post_meta', true );
?>
<main id="site-content">
	<?php 
		// Reuse your page title section
		get_template_part( 'template-parts/page', 'title' ); 
	?>
	<div class="hirxpert-content-wrap container page">
		<div class="row">
			<div class="<?php echo esc_attr( Hirxpert_Wp_Elements::hirxpert_get_content_class() ); ?>">
				<?php
					global $product;
					if ( $product instanceof WC_Product ) {
						do_action( 'woocommerce_before_main_content' );
					} else {
						$product = wc_get_product( get_the_ID() );
						if ( $product instanceof WC_Product ) {
							do_action( 'woocommerce_before_main_content' );
						}
					}
					wc_get_template_part( 'content', 'single-product' );
					if ( $product instanceof WC_Product ) {
						do_action( 'woocommerce_after_main_content' );
					} else {
						$product = wc_get_product( get_the_ID() );
						if ( $product instanceof WC_Product ) {
							do_action( 'woocommerce_after_main_content' );
						}
					}
					do_action( 'woocommerce_after_main_content' );
				?>
			</div>

			<?php get_template_part( 'template-parts/content-sidebar' ); ?>
		</div>
	</div>
</main>
<?php get_footer(); ?>