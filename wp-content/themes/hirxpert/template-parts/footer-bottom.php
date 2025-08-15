<?php
/**
 * Footer bottom
 */
$class_array = array(
	'left'		=> ' element-left',
	'center'	=> ' pull-center justify-content-center',
	'right'		=> ' pull-right justify-content-end'
);
$keys = array(
	'chk' => 'footer-bottom-chk',
	'fields' => array(
		'footer_bottom_layout' => 'footer-bottom-layout'
	)			
);
$footer_bottom_values = Hirxpert_Wp_Elements::hirxpert_get_meta_and_option_values( $keys );
$container_class = isset( $footer_bottom_values['footer_bottom_layout'] ) && $footer_bottom_values['footer_bottom_layout'] == 'boxed' ? 'container' : 'container-fluid';
/*
 * Hook: hirxpert_top_footer_bottom.
 *
 */
do_action( 'hirxpert_top_footer_bottom' );
?>

<div class="footer-bottom-wrap">
	<div class="<?php echo esc_attr( $container_class ); ?>">
		<div class="row">
			<div class="col-12">
			<?php
				$copyright_items = Hirxpert_Wp_Elements::hirxpert_options('copyright-bar-items');
				if( !empty( $copyright_items ) ):
					if( isset( $copyright_items['disabled'] ) ) unset( $copyright_items['disabled'] );
					
					foreach( $copyright_items as $key => $value ){
						$cr_bar_class = $class_array[$key];
						$cr_bar_class .= isset( $copyright_items['right'] ) && !empty( $copyright_items['right'] ) ? ' right-element-exist' : '';
						echo '<ul class="nav copyright-bar-ul'. esc_attr( $cr_bar_class ) .'">';
						foreach ($value as $element => $label) {
							switch ($element) {
								case "copyright-text": 									
									$copyright_html = get_option( 'hirxpert_options' )['copyright-text'];
										if( $copyright_html ):
											$copyright_html = stripslashes( $copyright_html );
										?>
											<li>
												<p class="footer-copyright"><?php echo do_shortcode( stripslashes( $copyright_html ) ); ?></p>
											</li>
									<?php
										endif;
									break;
									case "copyright-widgets":
										$cr_sidebar_name = Hirxpert_Wp_Elements::hirxpert_options('copyright-widget');
										if( is_active_sidebar( $cr_sidebar_name ) ){  ?>
											<li>
												<aside class="copyright-widget">
													<?php dynamic_sidebar( $cr_sidebar_name ); ?>
												</aside>
											</li>
										<?php
										}
									break;
								}
							}
						echo '</ul>';
					}				
				endif;
			?>
			</div><!-- .col-12 -->
		</div><!-- .row -->
	</div><!-- .container -->
</div><!-- .footer-bottom-wrap -->
<?php
/*
	Hook: hirxpert_after_footer_bottom.
*
*/
do_action( 'hirxpert_after_footer_bottom' );
