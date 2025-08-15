<?php
/**
 * Template part for displaying page content in page.php
 *
 */
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<div class="post-inner">

		<div class="entry-content">

			<?php
				the_content();
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

</article><!-- .post -->
