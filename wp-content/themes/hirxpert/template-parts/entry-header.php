<?php
/**
 * Displays the post header
 *
 */

if( !Hirxpert_Wp_Elements::$page_title_stat || !is_singular() ):

	$blog_structure = Hirxpert_Wp_Elements::hirxpert_options('blog-layout');
	if($blog_structure === 'list' && !is_singular()){
		?>
		<div class="media-body">
		<?php
	} else {

	}
	$entry_header_classes = '';
	if ( is_singular() ) {
		$entry_header_classes .= ' header-footer-group';
	}
	?>

	<header class="entry-header<?php echo esc_attr( $entry_header_classes ); ?>">

		<?php		
			if ( is_singular() ) {
					the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' );
			}		
		?>
		
	</header><!-- .entry-header -->
<?php endif; ?>
