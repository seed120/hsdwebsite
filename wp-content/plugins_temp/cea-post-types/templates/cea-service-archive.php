<?php
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
	
	<?php do_action( 'cea_service_archive_before_content' ); ?>

	<div class="service-content-area">
		<div class="container">
			<div class="row">
				<div class="col-md-<?php echo esc_attr( $sidebar_stat ? $sidebar_class[1] : $sidebar_class[0] ); ?>">
					<?php require_once( CEA_PT_CORE_DIR . 'templates/cea-service-archive-content.php' ); ?>
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
	
	<?php do_action( 'cea_service_archive_after_content' ); ?>
	
</div><!-- .wrap -->

<?php
wp_enqueue_script( 'imagesloaded' );
wp_enqueue_script( 'infinite-scroll' );
wp_enqueue_script( 'isotope' );
get_footer();