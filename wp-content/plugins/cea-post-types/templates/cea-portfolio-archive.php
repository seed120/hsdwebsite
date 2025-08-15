<?php
/**
 * The template for displaying all single portfolio
 *
 */

get_header(); 

$t = new CEACPTElements();
$portfolio_sidebars = $t->ceaGetThemeOpt('cpt-portfolio-sidebars');
$sidebar_class = array( '12', '8', '4' );
$sidebar_stat = false;
if( !empty( $portfolio_sidebars ) && is_active_sidebar( $portfolio_sidebars ) ){
	$sidebar_stat = true;
}
?>

<div class="wrap cea-content">
	
	<?php do_action( 'cea_portfolio_archive_before_content' ); ?>

	<div class="portfolio-content-area">
		<div class="container">
			<div class="row">
				<div class="col-md-<?php echo esc_attr( $sidebar_stat ? $sidebar_class[1] : $sidebar_class[0] ); ?>">
					<?php require_once( CEA_PT_CORE_DIR . 'templates/cea-portfolio-archive-content.php' ); ?>
				</div><!-- .col -->
				
				<?php if( $sidebar_stat ): ?>
				<div class="col-md-<?php echo esc_attr( $sidebar_class[2] ); ?>">
				<aside class="sidebar-widget widget-area">
					<?php dynamic_sidebar( $portfolio_sidebars ); ?>
				</aside><!-- #secondary -->
				</div><!-- .col -->
				<?php endif; ?>
				
			</div><!-- .row -->
		</div><!-- .container -->
	</div><!-- .portfolio-content-area -->
	
	<?php do_action( 'cea_portfolio_archive_after_content' ); ?>
	
</div><!-- .wrap -->

<?php
wp_enqueue_script( 'imagesloaded' );
wp_enqueue_script( 'infinite-scroll' );
wp_enqueue_script( 'isotope' );
get_footer();