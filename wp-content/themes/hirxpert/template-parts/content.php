<?php
/**
 * The default template for displaying content
 */
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php

	/*if ( ! is_search() ) {
		get_template_part( 'template-parts/featured-image' );
	}*/

	
	$blog_layout = Hirxpert_Wp_Elements::hirxpert_options('blog-layout');

	if( !is_page() && is_singular('post') ){
		// title
		get_template_part( 'template-parts/entry-header' );
	}
			?>
			<div class="post-inner">	

				<?php if ( is_singular( 'post' ) ) {	

					// featured image
					get_template_part( 'template-parts/featured-image' );

					// top meta
					get_template_part( 'template-parts/top-meta' );

				
				}?>
				
				<div class="entry-content">
				<?php
						the_content( __( 'Continue reading', 'hirxpert' ) );
					?>

		</div><!-- .entry-content -->

	</div><!-- .post-inner -->

	<?php
		wp_link_pages(
			array(
				'before'      => '<nav class="post-nav-links bg-light-background" aria-label="' . esc_attr__( 'Page', 'hirxpert' ) . '"><span class="label">' . esc_html__( 'Pages:', 'hirxpert' ) . '</span>',
				'after'       => '</nav>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			)
		);

		if ( is_singular( 'post' ) ) {
			get_template_part( 'template-parts/entry-author-bio' );
		}
	?>

	<?php
		if( !is_page() && is_singular( 'post' ) ){
			get_template_part( 'template-parts/bottom-meta' );
		}
	?>

	<?php
	if ( is_singular( 'post' ) ) {
		get_template_part( 'template-parts/navigation' );
	}

	/**
	 *  Output comments wrapper if it's a post, or if comments are open,
	 * or if there's a comment number – and check for password.
	 * */
	if ( ( is_singular('post') || is_page() ) && ( comments_open() || get_comments_number() ) && ! post_password_required() ) {
		?>

		<div class="comments-wrapper section-inner">

			<?php comments_template(); ?>

		</div><!-- .comments-wrapper -->

				<?php
			}
			?>
		<?php
	
	$blog_structure =  Hirxpert_Wp_Elements::hirxpert_options('blog-layout');
	if($blog_structure === 'list' && !is_singular()){
	
	?>
	
	</div><!-- media-body-->
	</div><!-- media -->
<?php
}
?>
</article><!-- .post -->
