<?php
/**
 * Displays the featured image
 */

$blog_structure = Hirxpert_Wp_Elements::hirxpert_options('blog-layout');

	if($blog_structure === 'list' && !is_singular() && !is_search()){	
		?>
		<div class="media">
	<?php
	}else{

	}
if ( has_post_thumbnail() && ! post_password_required() ) {
	?>

	<figure class="featured-media">
		<div class="featured-media-inner section-inner">
		<?php
			the_post_thumbnail( is_singular() ? 'large' : 'medium' );
			$caption = get_the_post_thumbnail_caption();
				if ( $caption ) {
				?>
					<figcaption class="wp-caption-text"><?php echo esc_html( $caption ); ?></figcaption>
				<?php
				}
			?>
		</div><!-- .featured-media-inner -->
	</figure><!-- .featured-media -->
	<?php
}