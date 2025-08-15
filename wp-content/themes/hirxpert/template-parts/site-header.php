<?php			
/*
* Desktop Header
*/
			$keys = array(
				'chk' => 'header-chk',
				'fields' => array(
					'header_layout' => 'header-layout',
					'header_items' => 'header-items',
					'header_absolute' => 'header-absolute',
					'search_type' => 'search-type',
					'search_template' => 'search-template'
				)			
			);
			$header_values = Hirxpert_Wp_Elements::hirxpert_get_meta_and_option_values( $keys );
			$header_class = isset( $header_values['header_layout'] ) && $header_values['header_layout'] == 'boxed' ? ' container p-0' : '';
			$header_class .= isset( $header_values['header_absolute'] ) && $header_values['header_absolute'] ? ' header-absolute' : '';
			?>
			<header id="site-header" class="site-header<?php echo esc_attr( $header_class ); ?>">
				<?php
					$header_items = $header_values['header_items'];
					if( !empty( $header_items ) ):
						if( isset( $header_items['disabled'] ) ) unset( $header_items['disabled'] );
						if( isset( $header_items['normal'] ) && !empty( $header_items['normal'] ) ):
							foreach( $header_items['normal'] as $key => $value ){
								get_template_part( 'template-parts/header', $key );
							}
						endif;
						if( isset( $header_items['sticky'] ) && !empty( $header_items['sticky'] ) ):						
							$sticky_opt = Hirxpert_Wp_Elements::hirxpert_options('header-sticky');
						?>
						<div class="sticky-outer" data-stickyup="<?php echo esc_attr( $sticky_opt == 'on_scrollup' ? "1" : "0" ); ?>">
							<div class="sticky-head">
							<?php
								foreach( $header_items['sticky'] as $key => $value ){
									get_template_part( 'template-parts/header', $key );
								}
							?>
							</div> <!-- .sticky-head -->
						</div> <!-- .sticky-outer -->			
						<?php
						endif;
					endif;
				?>
			</header><!-- #site-header -->
