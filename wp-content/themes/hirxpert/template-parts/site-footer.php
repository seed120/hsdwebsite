<?php
/**
 * The template for displaying the footer
 *
 */

$keys = array(
	'chk' => 'footer-chk',
	'fields' => array(
		'footer_layout' => 'footer-layout',
		'footer_items' => 'footer-items'
	)
);
$footer_values = Hirxpert_Wp_Elements::hirxpert_get_meta_and_option_values( $keys );
$footer_class = isset( $footer_values['footer_layout'] ) && $footer_values['footer_layout'] == 'boxed' ? ' container p-0' : ' container-fluid p-0';
$footer_items = $footer_values['footer_items'];
	if( !empty( $footer_items ) ):
?>
		<footer id="site-footer" class="site-footer">
			<div class="site-footer-wrap<?php echo esc_attr( $footer_class ); ?>">
				<?php 					
					if( isset( $footer_items['disabled'] ) ) unset( $footer_items['disabled'] );
					if( isset( $footer_items['enabled'] ) && !empty( $footer_items['enabled'] ) ):
						foreach( $footer_items['enabled'] as $key => $value ){
							get_template_part( 'template-parts/footer', str_replace( "footer-", "", $key ) );
						}	
					endif;
				?>
			</div><!-- .container -->
		</footer><!-- #site-footer -->
<?php endif; 