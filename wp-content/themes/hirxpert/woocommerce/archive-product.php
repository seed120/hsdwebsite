<?php
/**
 * Template Name: WooCommerce Page Layout
 * This template is used for all WooCommerce pages to match the page.php structure.
 */
get_header();
Hirxpert_Wp_Elements::$template = apply_filters( 'hirxpert_define_page_template', 'page' );
Hirxpert_Wp_Elements::$hirxpert_page_options = get_post_meta( get_the_ID(), 'hirxpert_post_meta', true );
?>
<main id="site-content">
	<?php 
		// Page title template (uses your existing template-parts/page-title.php)
		get_template_part( 'template-parts/page', 'title' );
	?>
	<div class="hirxpert-content-wrap container page">
		<div class="row">
			<?php
				$content_col_class = Hirxpert_Wp_Elements::hirxpert_get_content_class();
			?>
			<div class="<?php echo esc_attr( $content_col_class ); ?>">
				<?php
					// WooCommerce content
					do_action( 'woocommerce_before_main_content' );
					woocommerce_content();
					do_action( 'woocommerce_after_main_content' );
				?>
			</div><!-- .col -->
			
			<?php get_template_part( 'template-parts/content-sidebar' ); ?>
		</div><!-- .row -->
	</div><!-- .container -->
</main><!-- #site-content -->
<?php get_footer(); ?>
