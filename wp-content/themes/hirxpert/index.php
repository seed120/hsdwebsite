<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 */

get_header();
Hirxpert_Wp_Elements::$template = 'blog';
?>

<main id="site-content">

	<?php 
		/*
		* Page title template call
		*/
		get_template_part( 'template-parts/page', 'title' );
		$blog_structure = Hirxpert_Wp_Elements::hirxpert_options('blog-layout');
		$blog_grid_columns = Hirxpert_Wp_Elements::hirxpert_options('blog-grid-columns');
		$blog_grid_gutter = Hirxpert_Wp_Elements::hirxpert_options('blog-grid-gutter');
	?>

	<div class="hirxpert-content-wrap container">
		<div class="row">
			<?php
				$content_col_class = Hirxpert_Wp_Elements::hirxpert_get_content_class();
			?>
			<div class="<?php echo esc_attr( $content_col_class ); ?>">
				<?php				
				if ( have_posts() ) { 
					if($blog_structure === 'grid'){
						echo '<div class="hirxpert-masonry" data-columns='. $blog_grid_columns .' data-gutter='. $blog_grid_gutter.'>';
						while ( have_posts() ) {
							the_post();
							get_template_part( 'template-parts/content', 'excerpt' );
						} 
					echo '</div>';
					}
					elseif($blog_structure === 'list'){
						if ( have_posts() ) { 
							echo '<div class="hirxpert-masonry" data-columns="1" data-gutter="30">';
								while ( have_posts() ) {
									the_post();
									get_template_part( 'template-parts/content', 'excerpt' );
								} 
							echo '</div>';		
						}
					}else{
						if ( have_posts() ) { 
							echo '<div class="hirxpert-masonry" data-columns="1" data-gutter="30">';
								while ( have_posts() ) {
									the_post();
									get_template_part( 'template-parts/content', 'excerpt' );
								} 
							echo '</div>';		
						}
					}
				}
				?>
				<?php get_template_part( 'template-parts/pagination' ); ?>
			</div><!-- .col -->
			<?php get_template_part( 'template-parts/content-sidebar' ); ?>
		</div><!-- .row -->
	</div><!-- .hirxpert-content-wrap -->

</main><!-- #site-content -->

<?php
get_footer();
