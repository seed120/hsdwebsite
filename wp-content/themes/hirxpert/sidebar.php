<?php
/**
 * The sidebar containing the main widget area
 *
 */
if ( ! is_active_sidebar( 'right-sidebar' ) ) {
	return;
}
?>
<aside id="right-sidebar" class="widget-area">
	<?php dynamic_sidebar( 'right-sidebar' ); ?>
</aside><!-- #secondary -->