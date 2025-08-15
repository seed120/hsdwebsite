<?php 

/**
 * Classic Addons Styles
 **/
$primary_color = 'var( --e-global-color-primary )';
$secondary_color = 'var( --e-global-color-secondary )';
$custom_css = '';

/* Primary Color */
$custom_css .= '
	.theme-color, .icon-theme-color, .flip-box-wrapper:hover .icon-theme-hcolor,.btn.link,a.btn.border,.team-classic .team-name a {
		color: '. esc_attr( $primary_color ) .' !important;
	}
	.isotope-filter ul.nav.m-auto.d-block li a:hover,.row.portfolio-details .col-sm-4 > .portfolio-meta span.portfolio-meta-icon {
		color: '. esc_attr( $primary_color ) .';
	}
	a.btn.border {
		border-color: '. esc_attr( $primary_color ) .' !important;
	}
	.pricing-table-wrapper.pricing-style-classic .pricing-inner-wrapper {
		border-bottom-color: '. esc_attr( $primary_color ) .';
	}
	
	.theme-color-bg, .icon-theme-color-bg, .flip-box-wrapper:hover .icon-theme-hcolor-bg,.contact-info-style-classic-pro .contact-info-title,
.contact-info-wrapper.contact-info-style-classic:before,.testimonial-wrapper.testimonial-style-modern .testimonial-inner:after, .blog-wrapper.blog-style-modern .blog-inner .top-meta .post-category,.blog-wrapper .post-overlay-items .post-date a,.event-style-classic .top-meta .post-date	,.blog-layouts-wrapper .post-overlay-items .post-date a,.portfolio-content-wrap .portfolio-title h3,.custom-post-nav > a {
		background-color: '. esc_attr( $primary_color ) .';
	}
	.testimonial-list .testimonial-list-item .testimonial-thumb:before, .single-cea-testimonial .testimonial-info .testimonial-img:before,
.testimonial-wrapper.testimonial-modern .testimonial-inner:after,.cea-switch input:checked + .slider,
.day-counter-classic .day-counter > div:after,.day-counter-modern .day-counter>*:after,.cea-offcanvas-wrap span.cea-close.cea-offcanvas-close,.cea-data-table-pagination-wrap > a {
		background: '. esc_attr( $primary_color ) .';
	}
	.contact-info-style-modern .contact-mail:before,.contact-info-style-modern .contact-phone:before	{
		color: '. esc_attr( $primary_color ) .';
	}
	.team-wrapper.team-style-list .media .post-thumb:after {
			background-image: linear-gradient( 45deg , #fff0 25%, transparent 25%), linear-gradient( -45deg , transparent 25%, transparent 25%), linear-gradient( 45deg , transparent 75%, transparent 75%), linear-gradient( -45deg , transparent 75%, '. esc_attr( $primary_color ) .' 75%);
background-image: linear-gradient( 45deg , #fff0 25%, transparent 25%), linear-gradient( -45deg , transparent 25%, transparent 25%), linear-gradient( 45deg , transparent 75%, transparent 75%), linear-gradient( -45deg , transparent 75%, '. esc_attr( $primary_color ) .' 75%);
background-image: linear-gradient( 45deg , #fff0 25%, transparent 25%), linear-gradient( -45deg , transparent 25%, transparent 25%), linear-gradient( 45deg , transparent 75%, transparent 75%), linear-gradient( -45deg , transparent 75%, '. esc_attr( $primary_color ) .' 75%);
background-image: linear-gradient( 45deg , #fff0 25%, transparent 25%), linear-gradient( -45deg , transparent 25%, transparent 25%), linear-gradient( 45deg , transparent 75%, transparent 75%), linear-gradient( -45deg , transparent 75%, '. esc_attr( $primary_color ) .' 75%);			
	}
	

';
	
/* Secondary Color */
$custom_css .= '
	.secondary-color, .icon-secondary-color, .flip-box-wrapper:hover .icon-secondary-hcolor {
		color: '. esc_attr( $secondary_color ) .';
	}
	.secondary-color-bg, .icon-secondary-color-bg, .flip-box-wrapper:hover .icon-secondary-hcolor-bg,.day-counter-modern .day-counter>*,.day-counter-classic-pro .day-counter .counter-item > span {
		background-color: '. esc_attr( $secondary_color ) .';
	}
	
	
';

if( $custom_css ){
	update_option( 'cea_addon_styles', $custom_css );
}