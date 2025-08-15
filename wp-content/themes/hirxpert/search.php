<?php
/**
 * Archive template
 */

get_header();

Hirxpert_Wp_Elements::$template = 'archive';

?>

<main id="site-content">

	<?php 
		/*
		* Page title template call
		*/
		get_template_part( 'template-parts/page', 'title' );
	?>

	<div class="hirxpert-content-wrap container">
		<div class="row">
			<?php
				$content_col_class = Hirxpert_Wp_Elements::hirxpert_get_content_class();
			?>
			<div class="<?php echo esc_attr( $content_col_class ); ?>">
				<?php				
				if (is_search()) {
					$search_template = Hirxpert_Wp_Elements::hirxpert_options('search-templates');

					if (is_array($search_template) && !empty($search_template)) {
						$args = array(
							'post_type' => $search_template, 
							's' => get_search_query(),
							'paged' => $paged
						);

						$search_query = new WP_Query($args);
						if ($search_query->have_posts()) {
					echo '<div class="hirxpert-masonry" data-columns="2" data-gutter="30">';
							while ($search_query->have_posts()) {
								$search_query->the_post();
								get_template_part( 'template-parts/content', 'excerpt' );
							}
							echo '</div>';
						} else {
							// Display no results found message
							echo '<div class="no-search-results-form">';
							echo '<div class="container">';
							echo '<h2 class="no-search-title">' . esc_html__('No results found', 'hirxpert') . '</h2>';
							echo '<p class="no-search-results-desc">' . esc_html__('Sorry, but nothing matched your search terms. Please try again with different keywords.', 'hirxpert') . '</p>';
							echo '</div><!-- .container -->';
							echo '</div><!-- .no-search-results -->';
						}
						wp_reset_postdata();
					} else {
						// Display message to select a template
						echo '<div class="no-search-results-form">';
						echo '<div class="container">';
						echo '<h2 class="no-search-title">' . esc_html__('Please select a template', 'hirxpert') . '</h2>';
						echo '<p class="no-search-results-desc">' . esc_html__('Please select a template to search within.', 'hirxpert') . '</p>';
						echo '</div><!-- .container -->';
						echo '</div><!-- .no-search-results -->';
					}
				}
				get_template_part( 'template-parts/pagination' ); ?>
			</div><!-- .col -->
			<?php get_template_part( 'template-parts/content-sidebar' ); ?>
		</div><!-- .row -->
	</div><!-- .hirxpert-content-wrap -->

</main><!-- #site-content -->

<?php
get_footer();
