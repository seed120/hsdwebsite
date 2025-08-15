<?php
/**
 * Footer widgets
 */

$keys = array(
	'chk' => 'footer-middle-chk',
	'fields' => array(
		'footer_middle_layout' => 'widgets-footer-layout',
		'footer_widgets_layout' => 'footer-widgets-layout',
		'footer_widget_1' => 'footer-widget-1',
		'footer_widget_2' => 'footer-widget-2',
		'footer_widget_3' => 'footer-widget-3',
		'footer_widget_4' => 'footer-widget-4'
	)			
);
$footer_widget_values = Hirxpert_Wp_Elements::hirxpert_get_meta_and_option_values( $keys );
$footer_layout = $footer_widget_values['footer_widgets_layout'];
$footer_cols = $footer_layout ? explode( '-', $footer_layout ) : '';

if( !empty( $footer_cols ) ):
	$col_count = count($footer_cols);
    $container_class = isset( $footer_widget_values['footer_middle_layout'] ) && $footer_widget_values['footer_middle_layout'] == 'boxed' ? 'container' : 'container-fluid';
	
	$widgets_stat = 0; $i = 1;
	foreach( $footer_cols as $col ){
		$sidebar_name = $footer_widget_values['footer_widget_'.$i];
		if( is_active_sidebar( $sidebar_name ) ) $widgets_stat = 1;
		$i++;
	}
	
	if( $widgets_stat ):
?>

<div class="footer-widgets-wrap">
	<div class="<?php echo esc_attr( $container_class ); ?>">
		<div class="row">
		<?php
			$i = 1;
			foreach( $footer_cols as $col ){
				$sidebar_name = $footer_widget_values['footer_widget_'.$i];
				if( is_active_sidebar( $sidebar_name ) ){  ?>
					<aside class="footer-widget-2 col-md-<?php echo esc_attr( $col ); ?>">
						<?php dynamic_sidebar( $sidebar_name ); ?>
					</aside>
				<?php
				}
				$i++;
			}
		?>
		</div><!-- .row -->
	</div><!-- .container -->
</div><!-- .footer-widgets-wrap -->

<?php 
	endif; // widget_stat == 1
endif;
?>


