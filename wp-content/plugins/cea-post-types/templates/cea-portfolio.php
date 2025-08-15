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
$portfolio_layoutsettings = $t->ceaGetThemeOpt('portfolio-layout-options');
$portfolio_default_format = $t->ceaGetThemeOpt('portfolio-default-format');
$portfolio_default_metaitems = $t->ceaGetThemeOpt('portfolio-default-metaitems');
?>

<div class="wrap cea-content">
	
	<?php do_action( 'cea_portfolio_before_content' ); 
	if( $portfolio_layoutsettings === 'default-layout'){
	?>

	<div class="portfolio-content-area">
		<div class="container">
			<div class="row">
				<div class="col-md-<?php echo esc_attr( $sidebar_stat ? $sidebar_class[1] : $sidebar_class[0] ); ?>">
					<?php
						while ( have_posts() ) : the_post();
						
						$sticky_col = get_post_meta( get_the_ID(), 'cea_portfolio_sticky', true );
						$sticky_lclass = $sticky_rclass = '';
						if( !empty( $sticky_col ) && $sticky_col != 'none' ){
							$sticky_lclass = $sticky_col == 'left' ? ' cea-sticky-obj' : '';
							$sticky_rclass = $sticky_col == 'right' ? ' cea-sticky-obj' : '';
						}
						
						?>
						<div class="portfolio-single portfolio-model-2">
							<div class="row">
							
								<div class="col-sm-12">
									<div class="portfolio-format">
										<?php $t->ceaCPTPortfolioFormat(); ?>
									</div>
								</div>
								
							</div><!-- .row -->
							<div class="row portfolio-details">
							
								<div class="col-sm-12">
									<div class="portfolio-meta-wrap<?php echo esc_attr( $sticky_rclass ); ?>">
										<?php $t->ceaCPTMeta(); ?>
									</div>
									<div class="portfolio-content-wrap<?php echo esc_attr( $sticky_lclass ); ?>">
										<?php $t->ceaCPTPortfolioTitle(); ?>
										<?php $t->ceaCPTPortfolioContent(); ?>
										<?php $t->ceaCPTNav(); ?>
									</div>
								</div>								
							</div><!-- .row -->
						</div><!-- .portfolio-single -->
						<?php
						
						//Portfolio Related Slider
						$t->ceaCPTPortfolioRelated();
						
						endwhile; // End of the loop.
					?>
				</div><!-- .col -->
				<?php
			} elseif ( $portfolio_layoutsettings === 'custom-layout'){
				?>
				<div class="portfolio-content-area">
				<div class="container">
					<div class="row">
						<div class="col-md-<?php echo esc_attr( $sidebar_stat ? $sidebar_class[1] : $sidebar_class[0] ); ?>">
							<?php
								while ( have_posts() ) : the_post();
								
								$sticky_col = get_post_meta( get_the_ID(), 'cea_portfolio_sticky', true );
								$sticky_lclass = $sticky_rclass = '';
								if( !empty( $sticky_col ) && $sticky_col != 'none' ){
									$sticky_lclass = $sticky_col == 'left' ? ' cea-sticky-obj' : '';
									$sticky_rclass = $sticky_col == 'right' ? ' cea-sticky-obj' : '';
								}
								
								?>
								<div class="portfolio-single portfolio-model-2">
									<div class="row">
									<?php if( $portfolio_layoutsettings === 'custom-layout' && $portfolio_default_format === 'on' && $portfolio_default_metaitems === 'on' ){
											?>
										<div class="col-sm-12">
											<div class="portfolio-format">
												<?php $t->ceaCPTPortfolioFormat(); ?>
											</div>
										</div>
										<?php 
									} elseif( $portfolio_layoutsettings === 'custom-layout' && $portfolio_default_format === 'on' && $portfolio_default_metaitems !== 'on') {
										?><div class="col-md-12 order-md-2">
											<div class="portfolio-format">
												<?php $t->ceaCPTPortfolioFormat(); ?>
											</div>
										</div>
									<?php } ?>
									</div><!-- .row -->
									<?php if( $portfolio_layoutsettings === 'custom-layout' &&  $portfolio_default_metaitems === 'on' && $portfolio_default_format === 'on' ){?>
												<div class="col-sm-4">
													<div class="portfolio-meta<?php echo esc_attr( $sticky_rclass ); ?>">
														<?php $t->ceaCPTMeta(); ?>
													</div>
												</div>
												<?php 
										} elseif( $portfolio_layoutsettings === 'custom-layout' &&  $portfolio_default_metaitems === 'on' && $portfolio_default_format !== 'on' ) {
												?>
												<div class="col-md-12 order-md-2">
													<div class="portfolio-meta<?php echo esc_attr( $sticky_rclass ); ?>">
														<?php $t->ceaCPTMeta(); ?>
													</div>
												</div>
											<?php
										} ?>
									<div class="row portfolio-details">
										<div class="col-sm-8">
											<div class="portfolio-content-wrap<?php echo esc_attr( $sticky_lclass ); ?>">
												<?php $t->ceaCPTPortfolioTitle(); ?>
												<?php $t->ceaCPTPortfolioContent(); ?>
												<?php $t->ceaCPTNav(); ?>
											</div>
										</div>
									</div><!-- .row -->
								</div><!-- .portfolio-single -->
								<?php
								
								//Portfolio Related Slider
								$t->ceaCPTPortfolioRelated();
								
								endwhile; // End of the loop.
							?>
						</div><!-- .col -->
					<?php }?>
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
	
	<?php do_action( 'cea_portfolio_after_content' ); ?>
	
</div><!-- .wrap -->

<?php
get_footer();