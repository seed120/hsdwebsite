<?php
/**
 * Archive template
 */

get_header();

Hirxpert_Wp_Elements::$template = 'archive';

$blog_structure = Hirxpert_Wp_Elements::hirxpert_options('blog-layout');
$blog_grid_columns = Hirxpert_Wp_Elements::hirxpert_options('blog-grid-columns');
$blog_grid_gutter = Hirxpert_Wp_Elements::hirxpert_options('blog-grid-gutter');
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
				if ( have_posts() ) { 
					if ( $blog_structure === 'list' ){
					echo '<div class="hirxpert-masonry" data-columns="1" data-gutter="30">';
						while ( have_posts() ) {
							the_post();
							get_template_part( 'template-parts/content', 'excerpt' );
						} 
					echo '</div>';		
					}elseif( $blog_structure === 'grid' ) {
						echo '<div class="hirxpert-masonry" data-columns='. $blog_grid_columns .' data-gutter='. $blog_grid_gutter.'>';
						while ( have_posts() ) {
							the_post();
							get_template_part( 'template-parts/content', 'excerpt' );
						} 
					echo '</div>';		
					}else{
						echo '<div class="hirxpert-masonry" data-columns="1" data-gutter="30">';
						while ( have_posts() ) {
							the_post();
							get_template_part( 'template-parts/content', 'excerpt' );
						} 
					echo '</div>';		
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