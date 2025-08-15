<?php
	
	/*
	 * Hirxpert Footer Action 
	 * 10 - hirxpert_site_footer
	 */
	do_action( 'hirxpert_footer' ); 

	/*
	 * Hirxpert Footer After Action 
	 * 10 - hirxpert_overlay_search_form
	 * 20 - hirxpert_mobile_menu
	 * 30 - hirxpert_secondary_bar
	 * 40 - hirxpert_back_to_top
	 */
	do_action( 'hirxpert_footer_after' ); 
?>
		</div><!-- .hirxpert-body-inner -->
	<?php wp_footer(); ?>
	</body>
</html>
