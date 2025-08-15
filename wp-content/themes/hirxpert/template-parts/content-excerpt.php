<?php
/**
 * The default template for displaying content
 */
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php
	if( !is_page() ){
		// featured image
		get_template_part( 'template-parts/featured-image' );
		
		// title
		get_template_part( 'template-parts/entry-header' );

		// top meta
		get_template_part( 'template-parts/top-meta' );
	}
	?>

	<div class="post-inner">

		<div class="entry-content">
			<?php the_excerpt(); ?>
		</div><!-- .entry-content -->

	</div><!-- .post-inner -->

	<?php
		if( !is_page() ){
			get_template_part( 'template-parts/bottom-meta' );
		}
	?>
	
</article><!-- .post -->
