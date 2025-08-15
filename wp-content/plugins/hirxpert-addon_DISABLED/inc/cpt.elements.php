<?php 
class CEACPTElements extends CEACPT { 

	public function ceaCPTUniqueKey(){
		static $cpt_video_key = 1;
		return $cpt_video_key++;
	}
	
	public static function CeaBootstrapPagination( $args = array(), $max = '', $print = true ) {
    
		$defaults = array(
			'range'           => 4,
			'custom_query'    => false,
			'first_string' => esc_html__( 'First', 'cea-post-types' ),
			'previous_string' => esc_html__( 'Prev', 'cea-post-types' ),
			'next_string'     => esc_html__( 'Next', 'cea-post-types' ),
			'last_string'     => esc_html__( 'Last', 'cea-post-types' ),
			'before_output'   => '<div class="post-pagination-wrap"><ul class="nav pagination post-pagination justify-content-center">',
			'after_output'    => '</ul></div>'
		);
		
		$args = wp_parse_args( 
			$args, 
			apply_filters( 'cea_wp_bootstrap_pagination_defaults', $defaults )
		);
		
		$args['range'] = (int) $args['range'] - 1;
		if ( !$args['custom_query'] ){
			$args['custom_query'] = $GLOBALS['wp_query'];
		}
		$count = (int) $args['custom_query']->max_num_pages;
		$count = absint( $count ) ? absint( $count ) : (int) $max;
		
		$page = 1;
		if( get_query_var('paged') ){
			$page = intval( get_query_var('paged') );
		}elseif( get_query_var('page') ){
			$page = intval( get_query_var('page') );
		}
		
		$ceil  = ceil( $args['range'] / 2 );
		
		if ( $count <= 1 )
			return FALSE;
		
		if ( !$page )
			$page = 1;
		
		if ( $count > $args['range'] ) {
			if ( $page <= $args['range'] ) {
				$min = 1;
				$max = $args['range'] + 1;
			} elseif ( $page >= ($count - $ceil) ) {
				$min = $count - $args['range'];
				$max = $count;
			} elseif ( $page >= $args['range'] && $page < ($count - $ceil) ) {
				$min = $page - $ceil;
				$max = $page + $ceil;
			}
		} else {
			$min = 1;
			$max = $count;
		}
		
		$echo = '';
		$previous = intval($page) - 1;
		$previous = esc_attr( get_pagenum_link($previous) );
		
		// For theme check
		$t_next_post_link = get_next_posts_link();
		$t_prev_post_link = get_previous_posts_link();
		
		$firstpage = esc_attr( get_pagenum_link(1) );
		if ( $firstpage && (1 != $page) && isset( $args['first_string'] ) && $args['first_string'] != '' )
			$echo .= '<li class="nav-item previous"><a href="' . $firstpage . '" title="' . esc_attr__( 'First', 'cea-post-types') . '">' . $args['first_string'] . '</a></li>';
		if ( $previous && (1 != $page) )
			$echo .= '<li class="nav-item"><a href="' . $previous . '" title="' . esc_attr__( 'previous', 'cea-post-types') . '">' . $args['previous_string'] . '</a></li>';
		
		if ( !empty($min) && !empty($max) ) {
			for( $i = $min; $i <= $max; $i++ ) {
				if ($page == $i) {
					$echo .= '<li class="nav-item active"><span class="active">' . str_pad( (int)$i, 2, '0', STR_PAD_LEFT ) . '</span></li>';
				} else {
					$echo .= sprintf( '<li class="nav-item"><a href="%s">%002d</a></li>', esc_attr( get_pagenum_link($i) ), $i );
				}
			}
		}
		
		$next = intval($page) + 1;
		$next = esc_attr( get_pagenum_link($next) );
		if ($next && ($count != $page) )
			$echo .= '<li class="nav-item"><a href="' . $next . '" class="next-page" title="' . esc_attr__( 'next', 'cea-post-types') . '">' . $args['next_string'] . '</a></li>';
		
		$lastpage = esc_attr( get_pagenum_link($count) );
		if ( $lastpage && isset( $args['last_string'] ) && $args['last_string'] != '' ) {
			$echo .= '<li class="nav-item next"><a href="' . $lastpage . '" title="' . esc_attr__( 'Last', 'cea-post-types') . '">' . $args['last_string'] . '</a></li>';
		}
		if ( isset($echo) && $print ){
			echo ( '' . $args['before_output'] . $echo . $args['after_output'] );
		}else{
			return $args['before_output'] . $echo . $args['after_output'];
		}
	}
	
	function ceaCPTPortfolioLayout(){
		$p_layout_opt = get_post_meta( get_the_ID(), 'cea_portfolio_layout_opt', true );
		$p_layout = '1';
		if( $p_layout_opt == 'custom' ){
			$p_layout = get_post_meta( get_the_ID(), 'cea_portfolio_layout', true );
		}else{
			$p_layout = $this->ceaGetThemeOpt('portfolio-layout');
		}
		return $p_layout;
	}
	
	function ceaCPTPortfolioFormat(){
		$format = get_post_meta( get_the_ID(), 'cea_portfolio_format', true );
		switch( $format ){

			case "video":
				$video_type = get_post_meta( get_the_ID(), 'cea_portfolio_video_type', true );
				$video_id = get_post_meta( get_the_ID(), 'cea_portfolio_video_id', true );
				$video_modal = get_post_meta( get_the_ID(), 'cea_portfolio_video_modal', true );
				$video_atts = array(
					'video_type'	=> $video_type,
					'video_id'		=> $video_id,
					'video_modal'	=> $video_modal
				);
				$this->ceaCPTPortfolioVideo( $video_atts );
			break;
			
			case "audio":
				$this->ceaCPTPortfolioAudio();
			break;
			
			case "gallery":
				$this->ceaCPTPortfolioGallery();
			break;
			
			case "gmap":
				wp_enqueue_script( 'cea-gmaps' );
				$this->ceaCPTPortfolioGmap();
			break;
			
			case "360":
				$this->ceaCPTPortfolio360();
			break;
			
			case "standard":
			default:
				$this->ceaCPTPortfolioStandard();
			break;
			
		}
	}
	
	function ceaCPTPortfolio360(){
		$image = get_post_meta( get_the_ID(), 'cea_portfolio_360_degree', true );
		if( $image ) {
		?>
			<div class="portfolio-panorama-header">
				<h4 class="portfolio-sub-title"><?php echo apply_filters( 'cea_portfolio_zoacres_property_panorama_subtitle_label', esc_html__( '360&deg;', 'cea-post-types' ) ); ?></h4>
			</div>
		<?php	
			$image_atts = wp_get_attachment_image_src( $image, 'full' );
			if( isset( $image_atts[0] ) ){
			
				echo '<div id="cea-panorama" data-src="'. esc_url( $image_atts[0] ) .'"></div>';
				wp_enqueue_style( 'pannellum' );
				wp_enqueue_script( 'jquery-pannellum' );					
							
			}
		}
	}
	
	function ceaCPTPortfolioStandard(){
		if ( has_post_thumbnail() ) { ?>
			<div class="portfolio-image"><!-- for sticky column cea-sticky-obj -->
				<div class="portfolio-image-inner">
					<?php  $featured_img_url = get_the_post_thumbnail_url( get_the_ID(), 'full' ); ?>
					<a href="<?php echo esc_url( $featured_img_url ); ?>" title="<?php esc_html( the_title() ); ?>">
						<?php the_post_thumbnail( 'full', array( 'class' => 'img-fluid' ) ); ?>
					</a>
				</div>
			</div>
		<?php
		}
	}
	
	function ceaCPTPortfolioGmap(){ 
		$lat = get_post_meta( get_the_ID(), 'cea_portfolio_gmap_latitude', true );
		$lang = get_post_meta( get_the_ID(), 'cea_portfolio_gmap_longitude', true );
		$marker = get_post_meta( get_the_ID(), 'cea_portfolio_gmap_marker', true );
		$map_style = get_post_meta( get_the_ID(), 'cea_portfolio_gmap_style', true );
		$info_title = get_the_title();
		$info_address = get_post_meta( get_the_ID(), 'cea_portfolio_place', true );
		$info_stat = $info_title || $info_address ? 1 : 0;
	?>
		<div class="portfolio-gmap">
			<div id="ceagmap" class="ceagmap" style="width:100%;height:400px;" data-map-lat="<?php echo esc_attr( $lat ); ?>" data-map-lang="<?php echo esc_attr( $lang ); ?>" data-map-style="<?php echo esc_attr( $map_style ); ?>" data-map-marker="<?php echo esc_url( $marker ); ?>" data-info-title="<?php echo esc_html( $info_title ); ?>" data-info-addr="<?php echo esc_html( $info_address ); ?>" data-info="<?php echo esc_attr( $info_stat ); ?>"></div>
		</div>
	<?php
	}
	
	function ceaCPTPortfolioGallery(){
			
		$gallery_ids = get_post_meta( get_the_ID(), 'cea_portfolio_gallery', true );
		if( $gallery_ids ):
			$gallery_array = explode( ",", $gallery_ids );
			$slide_id = '';

			$gal_atts = array(
				'data-loop="'. $this->ceaGetThemeOpt( 'portfolio-single-slide-infinite' ) .'"',
				'data-margin="'. $this->ceaGetThemeOpt( 'portfolio-single-slide-margin' ) .'"',
				'data-center="'. $this->ceaGetThemeOpt( 'portfolio-single-slide-center' ) .'"',
				'data-nav="'. $this->ceaGetThemeOpt( 'portfolio-single-slide-navigation' ) .'"',
				'data-dots="'. $this->ceaGetThemeOpt( 'portfolio-single-slide-pagination' ) .'"',
				'data-autoplay="'. $this->ceaGetThemeOpt( 'portfolio-single-slide-autoplay' ) .'"',
				'data-items="'. $this->ceaGetThemeOpt( 'portfolio-single-slide-items' ) .'"',
				'data-items-tab="'. $this->ceaGetThemeOpt( 'portfolio-single-slide-tab' ) .'"',
				'data-items-mob="'. $this->ceaGetThemeOpt( 'portfolio-single-slide-mobile' ) .'"',
				'data-duration="'. $this->ceaGetThemeOpt( 'portfolio-single-slide-duration' ) .'"',
				'data-smartspeed="'. $this->ceaGetThemeOpt( 'portfolio-single-slide-smartspeed' ) .'"',
				'data-scrollby="'. $this->ceaGetThemeOpt( 'portfolio-single-slide-scrollby' ) .'"',
				'data-autoheight="'. $this->ceaGetThemeOpt( 'portfolio-single-slide-autoheight' ) .'"',
			);
			$data_atts = implode( " ", $gal_atts );
			$gallery_modal = get_post_meta( get_the_ID(), 'cea_portfolio_gallery_modal', true );
			if( $gallery_modal == 'default' ): // Gallery Model Default
			?>
				<div class="zoom-gallery portfolio-default-gallery">
			<?php
				foreach( $gallery_array as $gal_id ): ?>
					<article class="cpt-item clearfix">
						<figure>
							<?php $image_url = wp_get_attachment_url( $gal_id ); ?>
							<a href="<?php echo esc_url( $image_url ); ?>" title="<?php echo esc_html( get_the_title( $gal_id ) ); ?>">
								<?php echo wp_get_attachment_image( $gal_id, 'full', "", array( "class" => "img-fluid cpt-img" ) ); ?>
							</a>
						</figure>
					</article>
				<?php
				endforeach;
			?>
				</div>
			<?php
			elseif( $gallery_modal == 'normal' ): // Gallery Model Popup
				?>
				<div class="zoom-gallery portfolio-owl-gallery">
					<div class="cea-carousel owl-carousel" <?php echo ( $data_atts ); ?>>
					<?php
					foreach( $gallery_array as $gal_id ): ?>
						<article class="cpt-item">
							<figure>
								<?php $image_url = wp_get_attachment_url( $gal_id ); ?>
								<a href="<?php echo esc_url( $image_url ); ?>" title="<?php echo esc_html( get_the_title( $gal_id ) ); ?>">
									<?php echo wp_get_attachment_image( $gal_id, 'full', "", array( "class" => "img-fluid" ) ); ?>
								</a>
							</figure>
						</article>
					<?php
					endforeach;?>
					</div><!-- .owl-carousel -->
				</div><!-- .zoom-gallery -->
			<?php
			else: // Gallery Model Grid Popup
			
				$gutter = get_post_meta( get_the_ID(), 'cea_portfolio_grid_gutter', true );
				$cols = get_post_meta( get_the_ID(), 'cea_portfolio_grid_cols', true );
				$cols = !empty( $cols ) ? $cols : '2';
			?>
				<div class="zoom-gallery portfolio-grid-gallery grid-layout clearfix">
					<div class="isotope" data-cols="<?php echo esc_attr( $cols ); ?>" data-gutter="<?php echo esc_attr( $gutter ); ?>">
						<?php
						$chk = 1;
						foreach( $gallery_array as $gal_id ): 
							?>
								<article class="cpt-item">
									<figure>
										<?php $image_url = wp_get_attachment_url( $gal_id ); ?>
										<a href="<?php echo esc_url( $image_url ); ?>" title="<?php echo esc_html( get_the_title( $gal_id ) ); ?>">
											<?php 
											$crop_width = '';
											if( $cols <= 2 ){
												$crop_width = 560;
											}else{
												$crop_width = 400;
											}
											$cropped_img = aq_resize( $image_url, $crop_width, 9999, false, false );
											if( $cropped_img ):
												$image_alt = get_post_meta( $gal_id, '_wp_attachment_image_alt', true);
												$img_src = isset( $cropped_img[0] ) ? $cropped_img[0] : '';
												$img_width = isset( $cropped_img[1] ) ? $cropped_img[1] : '';
												$img_height = isset( $cropped_img[2] ) ? $cropped_img[2] : '';
											?>
											<img class="img-fluid cpt-img" src="<?php echo esc_url( $img_src ); ?>" width="<?php echo esc_attr( $img_width ); ?>" height="<?php echo esc_attr( $img_height ); ?>" alt="<?php echo esc_html( $image_alt ); ?>" />
											<?php else:
											echo wp_get_attachment_image( $gal_id, array( $crop_width, '9999' ), "", array( "class" => "img-fluid cpt-img" ) );
											endif; ?>
										</a>
									</figure>
								</article>
						<?php
						endforeach;
						?>
					</div><!-- .isotope -->
				</div><!-- .zoom-gallery -->
				<?php
			endif;
		endif;
	}
	
	function ceaCPTPortfolioRelated(){
		
		$rel_opt = $this->ceaGetThemeOpt( 'portfolio-related-opt' );
		$tot_items = $this->ceaGetThemeOpt( 'portfolio-related-slide-items' );
		$tot_tab_items = $this->ceaGetThemeOpt( 'portfolio-related-slide-tab-items' );
		$tot_mobile_items = $this->ceaGetThemeOpt( 'portfolio-related-slide-mobile-items' );
		$loop = $this->ceaGetThemeOpt( 'portfolio-related-slide-loop' );
		$margin = $this->ceaGetThemeOpt( 'portfolio-related-slide-margin' );
		$loop = $loop == 'on' ? 1 : 0;
		$margin = !empty( $margin ) ? $margin : 0;
		$tot_items = $tot_items ? $tot_items : 4;
		$tot_tab_items = $tot_tab_items ? $tot_tab_items : 2;
		$tot_mobile_items = $tot_mobile_items ? $tot_mobile_items : 1;
		
		wp_enqueue_style( 'owl-carousel' );
		wp_enqueue_script( 'owl-carousel' );
		
		if( $rel_opt == 'en' ):
		
			$gal_atts = array(
				'data-loop="'. esc_attr( $loop ) .'"',
				'data-margin="'. absint( $margin ) .'"',
				'data-center="0"',
				'data-nav="1"',
				'data-dots="0"',
				'data-autoplay="0"',
				'data-items="'. esc_attr( $tot_items ) .'"',
				'data-items-tab="'. esc_attr( $tot_tab_items ) .'"',
				'data-items-mob="'. esc_attr( $tot_mobile_items ) .'"',
				'data-duration="5000"',
				'data-smartspeed="2000"',
				'data-scrollby="1"',
				'data-autoheight="0"',
			);
			$gal_atts = apply_filters( 'cea_portfolio_related_slider_attributes', $gal_atts );
			$data_atts = implode( " ", $gal_atts );
			
			$post_id = get_the_ID();
			$custom_taxterms = wp_get_object_terms( $post_id, 'portfolio-categories', array('fields' => 'ids') );
			$thumb_size = '';
			if( $tot_items >= 2 ){
				$thumb_size = 'cea-grid-medium';
			}elseif( $tot_items >= 1 ){
				$thumb_size = 'medium';
			}else{
				$thumb_size = 'large';
			}
			
			if( $custom_taxterms ):
			
				$args = array(
				'post_type' => 'cea-portfolio',
					'post_status' => 'publish',
					'posts_per_page' => 10, // you may edit this number
					'orderby' => 'DESC',
					'post__not_in' => array ( $post_id ),
					'tax_query' => array(
						array(
							'taxonomy' => 'portfolio-categories',
							'field' => 'id',
							'terms' => $custom_taxterms
						)
					)
				);
	
				$related_query = new WP_Query( $args );
				if( $related_query->have_posts() ) : ?>
				
					<div class="portfolio-related-slider">
						<h4><?php echo apply_filters( 'cea_portfolio_related_title', esc_html__( 'Related Projects', 'cea-post-types' ) ); ?></h4>
						<div class="cea-related-slider owl-carousel" <?php echo ( $data_atts ); ?>>
						<?php while( $related_query->have_posts() ) : $related_query->the_post(); ?>
							<article class="cpt-item">
								<figure>
									<?php 
										if ( has_post_thumbnail( get_the_ID() ) ) :
									?>
										<a href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php echo esc_html( get_the_title() ); ?>">
											<?php echo get_the_post_thumbnail( get_the_ID(), $thumb_size, array( 'class' => 'img-fluid' ) ); ?>
										</a>
									<?php else: ?>
										<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
											<div class="empty-post-image text-center"><i class="fa fa-picture-o"></i></div>
										</a>
									<?php endif; ?>
									<h6 class="related-title">
										<a href="<?php echo esc_url( get_the_permalink() ); ?>" rel="bookmark" title="<?php echo esc_html( get_the_title() ); ?>"><?php echo esc_html( get_the_title() ); ?></a>
									</h6>
								</figure>
							</article>
						<?php endwhile; ?>
						</div><!-- .owl-carousel -->
					</div><!-- .portfolio-related-slider -->
				<?php
				endif;
				wp_reset_postdata();
			endif;
		endif; // Releted Slider option
	}
	
	function ceaCPTPortfolioVideo( $video_atts ){
		?> <div class="portfolio-video post-video-wrap"> <?php
		extract( $video_atts );
		switch( $video_modal ){
		
			case 'onclick':
				$video_url = '';
				if( $video_type == 'youtube' ){
					$video_url = 'https://www.youtube.com/embed/';
					$video_url .= esc_attr( $video_id );
				}elseif( $video_type == 'vimeo' ){
					$video_url = 'https://player.vimeo.com/video/';
					$video_url .= esc_attr( $video_id );
				}else{
					$video_url = esc_url( $video_id );
				}

				if( $video_type != 'custom' ){ ?>
					<a class="onclick-video-post" href="<?php echo esc_url( $video_url ); ?>">
						<div class="video-play-icon text-center"><span class="fa fa-play-circle-o"></span></div>
						<?php 
							if( '' !== get_the_post_thumbnail() ):
								the_post_thumbnail( '', array( 'class' => 'img-fluid mx-auto d-block' ) );
							endif;
						?>
					</a>
				<?php
				}else{
				?>
					<a class="onclick-custom-video" href="#" data-url="<?php echo esc_url( $video_url ); ?>">
						<div class="video-play-icon text-center"><span class="fa fa-play-circle-o"></span></div>
						<?php 
							if( '' !== get_the_post_thumbnail() ):
								the_post_thumbnail( '', array( 'class' => 'img-fluid mx-auto d-block' ) ); 
							endif;
						?>
					</a>
					<?php
				}
			break;
			
			case 'overlay': 
				$video_url = '';
				if( $video_type == 'youtube' ){
					$video_url = 'https://www.youtube.com/watch?v=';
					$video_url .= esc_attr( $video_id );
				}elseif( $video_type == 'vimeo' ){
					$video_url = 'https://vimeo.com/';
					$video_url .= esc_attr( $video_id );
				}else{
					$video_url = esc_url( $video_id );
				}
			
				if( $video_type != 'custom' ){ ?>
					<a class="popup-video-post" href="<?php echo esc_url( $video_url ); ?>">
						<div class="video-play-icon text-center"><span class="fa fa-play-circle-o"></span></div>
						<?php 
							if( '' !== get_the_post_thumbnail() ):
								the_post_thumbnail( '', array( 'class' => 'img-fluid mx-auto d-block' ) ); 
							endif;
						?>
					</a>
				<?php
				}else{
					$u_key = $this->ceaCPTUniqueKey();
				?>
					<a class="popup-video-post popup-with-zoom-anim popup-custom-video" href="#popup-custom-video-<?php echo esc_attr( $u_key ); ?>">
						<div class="video-play-icon text-center"><span class="fa fa-play-circle-o"></span></div>
						<?php 
							if( '' !== get_the_post_thumbnail() ):
								the_post_thumbnail( '', array( 'class' => 'img-fluid mx-auto d-block' ) ); 
							endif;
						?>
					</a>
					<div id="popup-custom-video-<?php echo esc_attr( $u_key ); ?>" class="zoom-anim-dialog mfp-hide">
						<span data-url="<?php echo esc_url( $video_url ); ?>"></span>
					</div>
					<?php
				}
			break;
			
			default: 
				$video_url = '';
				if( $video_type == 'youtube' ){
					$video_url = 'https://www.youtube.com/embed/';
					$video_url .= esc_attr( $video_id );
				}elseif( $video_type == 'vimeo' ){
					$video_url = 'https://player.vimeo.com/video/';
					$video_url .= esc_attr( $video_id );
				}else{
					$video_url = esc_url( $video_id );
				}
				
				if( $video_type != 'custom' ){
					echo do_shortcode( '[videoframe url="'. esc_url( $video_url ).'" width="100%" height="100%" params="byline=0&portrait=0&badge=0" /]' );
				}else{
					echo do_shortcode( '[video url="'. esc_url( $video_url ).'" width="100%" height="100%" /]' );
				}
			break;
		}?>
		</div><!-- .portfolio-video -->
		<?php
	}
	
	function ceaCPTPortfolioAudio(){
		$audio_type = get_post_meta( get_the_ID(), 'cea_portfolio_audio_type', true );
		$audio_id = get_post_meta( get_the_ID(), 'cea_portfolio_audio_id', true );
		if( !empty( $audio_type ) && !empty( $audio_id ) ): ?>
			<div class="post-audio-wrap">
				<?php if( $audio_type == 'soundcloud' ): ?>
						<?php echo do_shortcode('[soundcloud url="https://api.soundcloud.com/tracks/'. esc_attr( $audio_id ) .'" params="auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false&visual=true" width="100%" height="150" /]'); ?>
				<?php else: ?>
					<audio preload="none" controls style="max-width:100%;">
						<source src="<?php echo esc_url( $audio_id ); ?>" type="audio/mp3">
					</audio>
				<?php endif; ?>
			</div>
		<?php
		endif;
	}

	function ceaCPTPortfolioTitle(){ ?>		
		<?php
			$port_tit = $this->ceaGetThemeOpt('portfolio-title-opt');
			if( is_singular( 'cea-portfolio' ) ) : ?>
				<?php if( $port_tit ) : ?>
			<div class="portfolio-title"><h3><?php the_title(); ?></h3></div>
				<?php endif; ?>
		<?php 
			else: ?>
			<div class="portfolio-title"><h2><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2></div>
		<?php endif; ?>
		
	<?php
	}
	
	function ceaCPTPortfolioContent(){ ?>
		<div class="portfolio-content">
			<?php the_content(); ?>
		</div>
	<?php
	}
	
	function ceaCPTMeta(){ ?>
		<div class="portfolio-meta">
			<?php
			$portfolio_meta_items = '';
			$portfolio_items_opt = get_post_meta( get_the_ID(), 'cea_portfolio_items_opt', true );
			if( $portfolio_items_opt == 'custom' ){
				$portfolio_meta_items = get_post_meta( get_the_ID(), 'cea_portfolio_items', true );
				$portfolio_meta_items = json_decode( stripslashes( $portfolio_meta_items ), true );
			}else{
				$portfolio_meta_items = $this->ceaGetThemeOpt('portfolio-meta-items');
				$dd_fields = stripslashes( $portfolio_meta_items );
				$portfolio_meta_items = json_decode( $dd_fields, true );
			}
			
			$portfolio_meta_items = isset( $portfolio_meta_items['Enabled'] ) ? $portfolio_meta_items['Enabled'] : '';
			if( $portfolio_meta_items ): ?>
				<ul class="portfolio-meta-list"><?php						
					foreach ( $portfolio_meta_items as $key => $value ) {
						switch($key) {
							case 'date': ?>
								<li><?php $this->ceaCPTMetaDate() ?></li><?php 
							break;
							
							case 'client': ?> 
								<li><?php $this->ceaCPTMetaClient() ?></li><?php
							break;
							
							case 'category': ?>
								<li><?php $this->ceaCPTMetaCategory() ?></li><?php
							break;
							
							case 'share': ?> 
								<li><?php $this->ceaCPTMetaShare() ?></li><?php
							break;
							
							case 'tag': ?>
								<li><?php $this->ceaCPTMetaTag() ?></li><?php
							break;
							
							case 'duration': ?>
								<li><?php $this->ceaCPTMetaDuration() ?></li><?php
							break;
							
							case 'place': ?>
								<li><?php $this->ceaCPTMetaPlace() ?></li><?php
							break;
							
							case 'url': ?>
								<li><?php $this->ceaCPTMetaURL() ?></li><?php
							break;
							
							case 'estimation': ?>
								<li><?php $this->ceaCPTMetaEstimation() ?></li><?php
							break;
						}
					}?>
				</ul><?php
			endif;
			?>
		</div><!-- .portfolio-meta -->
	<?php
	}
	
	function ceaCPTMetaDate(){ 
		$title = $this->ceaGetThemeOpt( 'portfolio-date-label' );
		if( $title ):
		?>
		<div class="portfolio-meta-title-wrap">
			<h6><span class="portfolio-meta-icon"><i class="fa fa-calendar"></i></span><?php echo esc_html( $title ); ?></h6>
		</div>
		<?php endif; ?>
		<?php
			$date = get_post_meta( get_the_ID(), 'cea_portfolio_date', true );
			$date_format = get_post_meta( get_the_ID(), 'cea_portfolio_date_format', true );
			$date_text = $date;
			if( $date && $date_format ){
				$date_text = date( $date_format, strtotime( $date ) );
			}
		?>
		<span class="entry-date"><?php echo esc_attr( $date_text ); ?></span>
	<?php
	}
	
	function ceaCPTMetaClient(){
		$title = $this->ceaGetThemeOpt( 'portfolio-client-label' );
		if( $title ):
		?>
		<div class="portfolio-meta-title-wrap">
			<h6><span class="portfolio-meta-icon"><i class="fa fa-user-o"></i></span><?php echo esc_html( $title ); ?></h6>
		</div>
		<?php endif; ?>
		<?php
			$client_name = get_post_meta( get_the_ID(), 'cea_portfolio_client_name', true ); 
		?>
		<span class="entry-client"><?php echo esc_attr( $client_name ); ?></span>
	<?php
	}
	
	function ceaCPTMetaCategory(){
	
		$taxonomy = 'portfolio-categories';
		$terms = get_the_terms( get_the_ID(), $taxonomy ); // Get all terms of a taxonomy
		
		$title = $this->ceaGetThemeOpt( 'portfolio-category-label' );
		if( $title ):
		?>
		<div class="portfolio-meta-title-wrap">
			<h6><span class="portfolio-meta-icon"><i class="fa fa-folder-o"></i></span><?php echo esc_html( $title ); ?></h6>
		</div>
		<?php endif;
		
		if ( $terms && !is_wp_error( $terms ) ) :
		?>
			<ul class="portfolio-categories nav">
				<?php 
					$c = count( $terms ); 
					foreach ( $terms as $term ) { ?>
					<li><?php echo $term->name; ?><?php if( --$c != 0 ) echo ','; ?></li>
				<?php } ?>
			</ul>
		<?php endif;?>
	<?php
	}
	
	function ceaCPTMetaShare(){ 
	
		$posts_shares = $this->ceaGetThemeOpt( 'social-shares' ); 
		$posts_shares = stripslashes( $posts_shares );
		$posts_shares = json_decode( $posts_shares, true );
		
		$post_id = get_the_ID();
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'full' );
		
		$title = $this->ceaGetThemeOpt( 'portfolio-share-label' );
		if( $title ):
		?>
		<div class="portfolio-meta-title-wrap">
			<h6><span class="portfolio-meta-icon"><i class="fa fa-share-square-o"></i></span><?php echo esc_html( $title ); ?></h6>
		</div>
		<?php endif; ?>
		
		<ul class="nav portfolio-share social-icons">
			<?php 
			if( isset( $posts_shares['Enabled'] ) && !empty( $posts_shares['Enabled'] ) ) { 
				foreach ( $posts_shares['Enabled'] as $key => $value ){
					switch( $key  ){
					
						case "fb": 
					?>
							<li class="nav-item"><a href="https://www.facebook.com/sharer.php?u=<?php echo urlencode( get_permalink( $post_id ) ); ?>&t=<?php echo urlencode( get_the_title() ); ?>" target="blank" class="social-facebook share-fb"><i class="ti-facebook"></i></a></li>
						
					<?php
						break; // fb
						case "twitter":
					?>
				
							<li class="nav-item"><a href="https://twitter.com/home?status=Reading:<?php echo urlencode(get_the_title()); ?>-<?php echo  esc_url( home_url( '/' ) )."/?p=". esc_attr( $post_id ); ?>" class="social-twitter share-twitter" title="<?php esc_html_e( 'Click to send this page to Twitter!', 'cea-post-types' ); ?>" target="_blank"><i class="bi bi-twitter-x"></i></a></li>
				
					<?php
						break; // twitter
						case "linkedin":
					?>
				
							<li class="nav-item"><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php esc_url( the_permalink() ); ?>&title=<?php echo urlencode(get_the_title()); ?>&summary=&source=<?php echo bloginfo('name'); ?>" class="social-linkedin share-linkedin" target="_new"><i class="ti-linkedin"></i></a></li>
				
					<?php
						break; // linkedin
						case "pinterest":
					?>
				
						<li class="nav-item"><a href="https://pinterest.com/pin/create/button/?url=<?php esc_url( the_permalink() ); ?>&amp;media=<?php echo ( ! empty( $image[0] ) ? $image[0] : '' ); ?>&description=<?php echo urlencode(get_the_title()); ?>" class="social-pinterest share-pinterest" target="blank"><i class="ti-pinterest"></i></a></li>
				
					<?php
						break; // pinterest
					} //switch
				} // foreach
			}	
			?>

		</ul><?php
	}
	
	function ceaCPTMetaTag(){
		$taxonomy = 'portfolio-tags';
		$terms = get_the_terms( get_the_ID(), $taxonomy ); // Get all terms of a taxonomy
		
		$title = $this->ceaGetThemeOpt( 'portfolio-tags-label' );
		if( $title ):
		?>
		<div class="portfolio-meta-title-wrap">
			<h6><span class="portfolio-meta-icon"><i class="fa fa-tags"></i></span><?php echo esc_html( $title ); ?></h6>
		</div>
		<?php endif;
		
		if ( $terms && !is_wp_error( $terms ) ) :
		?>
			<ul class="portfolio-tags nav">
				<?php 
					$c = count( $terms ); 
					foreach ( $terms as $term ) { ?>
					<li><?php echo $term->name; ?><?php if( --$c != 0 ) echo ',';	?></li>
				<?php } ?>
			</ul>
		<?php endif;?>
	<?php
	}
	
	function ceaCPTMetaDuration(){ 
		$title = $this->ceaGetThemeOpt( 'portfolio-duration-label' );
		if( $title ):
		?>
		<div class="portfolio-meta-title-wrap">
			<h6><span class="portfolio-meta-icon"><i class="fa fa-clock-o"></i></span><?php echo esc_html( $title ); ?></h6>
		</div>
		<?php endif; ?>
		<?php
			$duration = get_post_meta( get_the_ID(), 'cea_portfolio_duration', true ); 
		?>
		<span class="entry-duration"><?php echo esc_html( $duration ); ?></span>
	<?php
	}
	
	function ceaCPTMetaPlace(){ 
		$title = $this->ceaGetThemeOpt( 'portfolio-place-label' );
		if( $title ):
		?>
		<div class="portfolio-meta-title-wrap">
			<h6><span class="portfolio-meta-icon"><i class="fa fa-map-marker"></i></span><?php echo esc_html( $title ); ?></h6>
		</div>
		<?php endif; ?>
		<?php
			$place = get_post_meta( get_the_ID(), 'cea_portfolio_place', true ); 
		?>
		<span class="entry-place"><?php echo esc_html( $place ); ?></span>
	<?php
	}
	
	function ceaCPTMetaURL(){ 
		$title = $this->ceaGetThemeOpt( 'portfolio-url-label' );
		if( $title ):
		?>
		<div class="portfolio-meta-title-wrap">
			<h6><span class="portfolio-meta-icon"><i class="fa fa-link"></i></span><?php echo esc_html( $title ); ?></h6>
		</div>
		<?php endif; ?>
		<?php
			$url = get_post_meta( get_the_ID(), 'cea_portfolio_url', true ); 
		?>
		<span class="entry-url"><?php echo esc_url( $url ); ?></span>
	<?php
	}
	
	function ceaCPTMetaEstimation(){ 
		$title = $this->ceaGetThemeOpt( 'portfolio-estimation-label' );
		if( $title ):
		?>
		<div class="portfolio-meta-title-wrap">
			<h6><span class="portfolio-meta-icon"><i class="fa fa-money"></i></span><?php echo esc_html( $title ); ?></h6>
		</div>
		<?php endif; ?>
		<?php
			$estimation = get_post_meta( get_the_ID(), 'cea_portfolio_estimation', true ); 
		?>
		<span class="entry-estimation"><?php echo esc_html( $estimation ); ?></span>
	<?php
	}
	
	function ceaCPTNav(){ ?>
		<div class="custom-post-nav">
			<?php $prev_post = get_previous_post();
			if (!empty( $prev_post )): ?>
			<div class="prev-nav-link">
				<a href="<?php echo get_permalink( $prev_post->ID ); ?>"><i class="ti-arrow-left"></i><h5><?php echo esc_html( get_the_title( $prev_post->ID ) ); ?></h5></a>
			</div>
			<?php else: ?>
				<a href="#" class="disabled"><i class="ti-arrow-left"></i></a>
			<?php endif; ?>
		
			<?php $next_post = get_next_post();
			if (!empty( $next_post )): ?>
			<div class="next-nav-link">
				<a href="<?php echo get_permalink( $next_post->ID ); ?>"><h5><?php echo esc_html( get_the_title( $next_post->ID ) ); ?></h5><i class="ti-arrow-right"></i></a>
			</div>
			<?php else: ?>
				<a href="#" class="disabled"><i class="fa fa-angle-double-right"></i></a>
			<?php endif; ?>
		</div>
	<?php
	}
	
} 