<?php 
/*
 * Page title template definition
 */

$keys = array(
	'chk' => 'page-title-chk',
	'fields' => array(
		'page_title_opt' => array( 'page-title', Hirxpert_Wp_Elements::$template.'-title' ),
		'page_title_items' => array( 'page-title-items', Hirxpert_Wp_Elements::$template.'-title-items' )
	)			
);
$page_title_values = Hirxpert_Wp_Elements::hirxpert_get_meta_and_option_values( $keys );
if( $page_title_values['page_title_opt'] ):
	do_action( 'hirxpert_page_title_before' );
	
	$pt_custom_class = isset( $page_title_values['pt_custom_class'] ) ? $page_title_values['pt_custom_class'] : '';
?>
	<header class="hirxpert-page-header <?php echo esc_attr( $pt_custom_class ); ?>"> 
		<div class="container">
			<div class="row">
				<div class="col-12">
					<?php Hirxpert_Wp_Elements::hirxpert_show_page_title( $page_title_values['page_title_items'] ); ?>
				</div>
			</div>
		</div><!-- .container -->
	</header><!-- .hirxpert-page-header -->
<?php
	do_action( 'hirxpert_page_title_after' );
endif;
