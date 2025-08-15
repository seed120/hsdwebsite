<?php
// Portfolio Archive Template
$t = new CEACPTElements();
$gutter = $cols = $infinite = $isotope = $extra_class = '';
$extra_class = 'masonry-layout';

// Archive Layout Grid Settings
$cols = $t->ceaGetThemeOpt( 'portfolio-grid-cols' );
$gutter = $t->ceaGetThemeOpt( 'portfolio-grid-gutter' );
$infinite = $t->ceaGetThemeOpt( 'portfolio-infinite-scroll' ) ? 'true' : 'false';
$isotope = $t->ceaGetThemeOpt( 'portfolio-grid-type' );
$extra_class .= $t->ceaGetThemeOpt( 'portfolio-grid-type' ) == 'normal' ? ' grid-normal' : '';

error_log("Cols: " . $cols);
error_log("Gutter: " . $gutter);


$article_class = $isotope == 'isotope' ? ' isotope-item' : '';

?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main archive-template cea-archive-template <?php echo esc_attr( $extra_class ); ?>" role="main" data-cols="<?php echo esc_attr( $cols ); ?>" data-gutter="<?php echo esc_attr( $gutter ); ?>">
						
			<?php
			$args = array(
				'post_type' => 'cea-portfolio'
			);
			
			if( is_tax() ) {
				$q_object = get_queried_object();
				$term_name = $taxonomy = '';
				if( isset($q_object->name) ) $term_name = $q_object->name;
				if( isset($q_object->taxonomy) ) $taxonomy = $q_object->taxonomy;
				$args[$taxonomy] = $term_name;
			}
			
			$query = new WP_Query( $args );
			
			if ( $query->have_posts() ) {
				
				$chk = $isotope_stat = 1;
				// Start the Loop
				while ( $query->have_posts() ) : $query->the_post();
			
					if( $isotope == 'isotope' && $isotope_stat == 1 ) : $isotope_stat = 0; ?>
						<div class="isotope" data-cols="<?php echo esc_attr( $cols ); ?>" data-gutter="<?php echo esc_attr( $gutter ); ?>" data-infinite="<?php echo esc_attr( $infinite ); ?>"><?php
					endif;
					
					if( $chk == 1 && $isotope == 'normal' ) : echo '<div class="grid-parent clearfix">';  endif; ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class( 'post cea-portfolio' . $article_class ); ?>>
						<div class="portfolio-archive">
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'medium', array( 'class' => 'img-fluid' ) ); ?></a>
							<div class="portfolio-archive-title">
								<?php 
									$custom_url = get_post_meta( get_the_ID(), 'cea_portfolio_custom_url', true );
									$target = get_post_meta( get_the_ID(), 'cea_portfolio_custom_url_target', true );
									$title_url = $custom_url != '' ? $custom_url : get_the_permalink();
								?>
								<h4><a href="<?php echo esc_url( $title_url ); ?>" target="<?php echo esc_attr( $target ); ?>"><?php the_title(); ?></a></h4>
							</div>
						</div>
					</article><!-- #post-## -->
					<?php
					if( $chk == $cols && $isotope == 'normal' ) : echo '</div><!-- .grid-parent -->'; $chk = 0; endif;
					
					$chk++;
					
					?>
				 
				<?php endwhile;
				
				if( $isotope == 'isotope' ) : $isotope_stat = 0; ?>
					</div><!-- .isotope --><?php
				endif;

				if( $chk != 1 && $isotope == 'normal' ) : echo '</div><!-- .grid-parent -->'; endif;
					 
			} // end of check for query having posts
				 
			// use reset postdata to restore orginal query
			wp_reset_postdata();
?>
		</main>
	</div>