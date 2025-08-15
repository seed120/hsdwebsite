<?php

/**
 * Hirxpert Theme Options CSS
 */

require_once ( HIRXPERT_ADDON_DIR . 'admin/extension/theme-options/class.options-style.php' );
$hirxpert_styles = new Hirxpert_Theme_Styles;

ob_start();

echo "\n/* Hirxpert Theme Options CSS */";

echo "\n/* General Styles */\n";

//site width
$site_width = $hirxpert_styles->hirxpert_dimension_settings( 'site-width', 'width' );
if( $site_width ){
	echo '@media (min-width: 1400px){
		.container, .container-lg, .container-md, .container-sm, .container-xl, .container-xxl {
			max-width: '. esc_attr( $site_width ) .';
		}
	}';
}

//primary color
$primary_color = $hirxpert_styles->hirxpert_get_option( 'primary-color' );
$rgb = $hirxpert_styles->hirxpert_hex2rgba( $primary_color, 'none' );

/*
 * Theme Color -> $primary-color
 * Secondary Color -> $secondary_color
 * Theme RGBA -> $rgb example -> echo 'body{ background: rgba('. esc_attr( $rgb ) .', 0.5); }';
 * Theme Secondary RGBA -> $rgb example -> echo 'body{ background: rgba('. esc_attr( $secondary_rgb ) .', 0.5); }';
 */

if( $primary_color ){
	echo '.primary-color, .theme-color, a:focus, a:hover, a:active {
		color: '. esc_attr( $primary_color ) .';
	}';
	echo '.primary-bg, .theme-bg {
		background-color: '. esc_attr( $primary_color ) .';
	}';
	echo '.border-shape-top:before, .border-shape-top-left:before {
		background: linear-gradient(to bottom, '. esc_attr( $primary_color ) .' -24%, rgb(58 123 213 / 0%));
	}';
	echo '.border-shape-top:after, .border-shape-top-left:after {
		background: linear-gradient(to top, '. esc_attr( $primary_color ) .' 0%, rgb(58 123 213 / 0%));
	}';		
	echo '.footer-widget.contact-widget:before {
		background: linear-gradient(to right, '. esc_attr( $primary_color ) .' 0%, rgb(184 151 128 / 6%));
	}';
	echo '.section-title-wrapper span.elementor-divider-separator {
		border-image: linear-gradient(to right, '. esc_attr( $primary_color ) .', rgb(58 123 213 / 0%));
    	border-image-slice: 1;
	}';
	echo '.rtl .section-title-wrapper span.elementor-divider-separator {
		border-image: linear-gradient(to left, '. esc_attr( $primary_color ) .', rgb(58 123 213 / 0%));
    	border-image-slice: 1;
	}';
	echo '.team-wrapper.team-style-default .team-inner .post-thumb:before {
		background: linear-gradient(to top, '. esc_attr( $primary_color ) .' -152%, 255,255,255, 0%));
	}';	
	echo '.bookly-progress-tracker .step {
		background-color: rgba('. esc_attr( $rgb ) .', 0.25);
	}';
	echo '.portfolio-classic-bg:after, 
	.portfolio-classic-bg-up:after,
	.service-style-modern .service-inner .post-thumb:after {
		background-image: linear-gradient(178deg, rgba('. esc_attr( $rgb ) .', 0.48) 0%, '. esc_attr( $primary_color ) .' 100%);
	}';
	
	echo '.calendar_wrap th, tfoot td, ul.nav.wp-menu > li > a:before, ul[id^="nv-primary-navigation"] li.button.button-primary > a, .menu li.button.button-primary > a, span.animate-bubble-box:after, span.animate-bubble-box:before, ::selection, .owl-carousel button.owl-dot.active, .content-widgets .widget .menu-service-sidebar-menu-container ul > li > a:after, .comments-pagination.pagination .page-numbers.current, .portfolio-meta ul.nav.social-icons > li > a:hover, span.cea-popup-modal-dismiss.ti-close, blockquote:after, .wp-block-quote.is-large:after, .wp-block-quote.is-style-large:after, .wp-block-quote.is-style-large:not(.is-style-plain):after, .wp-block-quote.has-text-align-right:after, .wp-block-quote:after, p.quote-author::before, nav.post-nav-links .post-page-numbers.current, blockquote cite::before, 
.page .comments-wrapper.section-inner input.submit, .widget-area-right .widget p.wp-block-tag-cloud a.tag-cloud-link:hover, .widget .tagcloud > a:hover, .widget .tagcloud > a:focus, .widget .tagcloud > a:active, .section-title-wrapper.title-theme .title-wrap > *.sub-title:after, .cea-tab-elementor-widget.tab-style-2.cea-vertical-tab a.nav-item.nav-link:before, .portfolio-single .portfolio-video.post-video-wrap .video-play-icon, .portfolio-wrapper.portfolio-style-default .isotope-filter ul.nav li a:before, .isotope-filter ul.nav.m-auto.d-block li.active a, .call-us-team a.cea-button-link:hover, .call-us-team a.cea-button-link span.cea-button-num, .elementor-widget-ceaposts .blog-style-classic-pro .blog-inner .post-date a, .widget-area-left .contact-widget-info > p > span.bi, .hirxpert-content-wrap .post-tag > a:hover, 
.widget-area-right .contact-widget-info > p > span.bi, .portfolio-style-default .portfolio-inner .post-thumb:before, .portfolio-single .portfolio-sub-title, .testimonial-wrapper.testimonial-style-default .owl-item .testimonial-inner:hover:before, .timeline > li > .timeline-sep-title:before, .feature-box-style-5 .feature-box-wrapper .fbox-number, .header-navbar a.h-phone:before, .portfolio-style-classic .post-thumb.post-overlay-active:before, .bottom-meta .post-more:before, .blog-style-classic-pro .blog-inner ul.nav.top-meta-list li:before, .wp-block-file__button.wp-element-button, p.wp-block-tag-cloud a.tag-cloud-link:hover, .event-inner ul.nav.top-meta-list .post-date:before, a.hirxpert-toggle > span:first-child:before, a.hirxpert-toggle > span:last-child:before, a.hirxpert-toggle > span:nth-child(2):before, .team-wrapper.team-style-classic .team-inner:after, .cea-tab-elementor-widget .cea-tabs > a .cea-tab-title:before, .event-style-default .event-inner .event-address, .event-info-wrap h4, .charitable-donation-form .donation-amounts .donation-amount.selected label, aside.footer-widget-2 h5:before, .widget .widgettitle:before,	.widget .widget-title:before, .widget-area-right .wp-block-group__inner-container h1:before, .widget-area-right .wp-block-group__inner-container h2:before, .widget-area-right .wp-block-group__inner-container h3:before, .widget-area-right .wp-block-group__inner-container h4:before, .widget-area-right .wp-block-group__inner-container h5:before, .widget-area-right .wp-block-group__inner-container h6:before, .widget-area-left .widget .widget-title:before, .owl-dots button.owl-dot, .single-post ul.nav.post-meta > li.post-category:before, .team-wrapper.team-style-classic .team-inner:before, .portfolio-style-classic .post-thumb.post-overlay-active:after, .elementor-widget-ceaposts .blog-inner .read-more:before, .bottom-meta .post-more .read-more:before, .portfolio-style-classic .portfolio-inner .post-overlay-items .post-icons a, .hirxpert-masonry .top-meta-wrap ul.nav.post-meta > li:before, .blog .hirxpert-masonry .post-meta .post-more a:before, .hirxpert-masonry .bottom-meta-wrap .post-meta .post-more a:before, .wp-block-columns.footer-call-to-action, .feature-box-default .cea-button-wrapper .cea-button-link:before, .portfolio-style-classic .portfolio-inner .post-title-head .post-title:before, .portfolio-style-classic-pro .portfolio-inner .post-overlay-items .post-icons a, .portfolio-style-modern .portfolio-inner .post-overlay-items .post-icons a, .cus-box-1 .feature-box-classic-pro .feature-box-inner .cea-button-content-wrapper .cea-button-text:before, .portfolio-style-default .portfolio-inner .post-overlay-items .post-icons a, .portfolio-style-default .portfolio-inner .post-category a, .btn-black .cea-button-wrapper .cea-button-link:hover:after, .comment-body .reply a.comment-reply-link:hover, .blog-style-classic .blog-inner .top-meta, .blog-style-modern.blog-normal-model .blog-inner .top-meta .post-date, .team-style-default .team-inner:hover .post-overlay-items > .team-social-wrap, .team-style-default .team-inner:hover .post-overlay-items > .team-social-wrap > ul, .blog-style-default.blog-normal-model .blog-inner .top-meta, .content-widgets-wrapper .widget_categories ul li a:before, .content-widgets-wrapper .widget_archive ul li a:before, .footer-widgets-wrap .widget_archive ul li a:before, .footer-widgets-wrap .widget_categories ul li a:before, .woocommerce ul.products li.product .onsale, .woocommerce span.onsale, .woocommerce ul.products li.product a.added_to_cart.wc-forward:hover, .woocommerce ul.products li.product .button, .woocommerce div.product .woocommerce-tabs ul.tabs li a, .woocommerce #content input.button, .woocommerce button.button.alt, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce-page #content input.button, .woocommerce-page #respond input#submit, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button, .woocommerce input.button.alt, .woocommerce input.button.disabled, .woocommerce input.button:disabled[disabled], .cart_totals .wc-proceed-to-checkout a.checkout-button, .single-product.woocommerce .restaurt_ajax_add_to_cart, .woocommerce-MyAccount-navigation > ul li a:hover, .woocommerce-account .woocommerce-MyAccount-navigation > ul li.is-active a, .wp-block-woocommerce-customer-account a .wc-block-customer-account__account-icon, .wc-block-mini-cart__badge, .content-widgets-outer-wrapper .wc-block-grid .wc-block-grid__product-onsale, ul.nav.pagination.post-pagination > li > a, .service-wrapper.service-style-default .service-icon-img-wrap, .service-style-modern .service-inner .post-overlay-items .post-category a, .portfolio-style-classic .portfolio-inner .post-overlay-items .post-icons a:hover, .portfolio-style-classic-pro .portfolio-inner .post-details-outer .top-meta .post-category a, .team-style-modern.team-slide-model .owl-carousel .owl-nav button.owl-prev:hover, .team-style-modern.team-slide-model .owl-carousel .owl-nav button.owl-next:hover, .single .row.team, .single.single-cea-team .team-other-details .team-details-icon, .elementor-progress-percentage, header.site-header ul.nav.wp-menu li > ul.sub-menu li a:before, .widget-area-right .zozo_social_widget ul.nav.social-icons > li > a:hover, .hirxpert-masonry .top-meta-wrap .post-date:hover, .single .hirxpert-content-wrap .post-inner .post-date:hover, .single.single-cea-service aside.content-widgets-outer-wrapper .widget-content .menu .menu-item a, blockquote, .wp-block-quote.is-large, .wp-block-quote.is-style-large, .wp-block-quote.is-style-large:not(.is-style-plain), .wp-block-quote.has-text-align-right, .wp-block-quote  {
		background-color: '. esc_attr( $primary_color ) .';
	}';
	echo '.theme-color-bg, .icon-theme-color-bg, .flip-box-wrapper:hover .icon-theme-hcolor-bg, .contact-info-style-classic-pro .contact-info-title, .contact-info-wrapper.contact-info-style-classic:before, .testimonial-wrapper.testimonial-style-modern .testimonial-inner:after, .isotope-filter ul.nav li.active a:after, .isotope-filter ul.nav li a:after, .blog-wrapper.blog-style-modern .blog-inner .top-meta .post-category, .blog-wrapper .post-overlay-items .post-date a, .event-style-classic .top-meta .post-date, .blog-layouts-wrapper .post-overlay-items .post-date a, .portfolio-content-wrap .portfolio-title h3, .back-to-top:after, span.zozo-product-favoured, .charitable-donation-form .custom-donation-amount-wrapper label, .campaign-progress-bar .bar, .donate-button, .charitable-donation-amount-form .donation-amount.selected, .campaign-progress-bar .bar, .donate-button, .charitable-donation-amount-form .donation-amount.selected, .blog .hirxpert-masonry .post-meta .post-more a:hover:before, .hirxpert-masonry .bottom-meta-wrap .post-meta .post-more a:hover:before {
		background-color: '. esc_attr( $primary_color ) .' !important;
	}';
	echo '.full-search-wrapper .search-form .input-group .btn:hover, .testimonial-style-list .testimonial-inner:after, ul.nav.post-meta > li span, .comment-metadata time, .comments-wrap span:before, .comment-body .reply a.comment-reply-link, .blog .hirxpert-masonry .post-meta .post-more a, h2.entry-title a:hover, .woocommerce-message::before, .woocommerce div.product p.price, .woocommerce div.product span.price, ul.pricing-features-list.list-group li:before, .doc-icon, .sidebar-broucher .icon-box a:hover, p.quote-author, .feature-box-wrapper .fbox-content a:hover, blockquote cite, .wp-block-quote cite, .wp-block-quote footer, .bottom-meta-wrap ul.nav.post-meta > li.post-date a:hover, .single-post .cus-img-menu .menu-item .widget .wp-block-image:hover figcaption a, .single-post blockquote cite, .single-post blockquote cite a, .content-widgets-wrapper .widget_categories ul li a:before, .content-widgets-wrapper .widget_archive ul li a:before, .content-widgets-wrapper .wp-block-categories li a:before, .cus-contact a:first-child, .pagination-single-inner > h6 > a:hover span.title, .hirxpert-masonry .bottom-meta-wrap .post-meta li.post-share-wrap .social-share a:hover i, .post-share-wrap ul.social-share > li > a:hover > i, .team-style-classic-pro .team-designation, .hirxpert-masonry .bottom-meta-wrap .post-meta .post-more a:hover, .widget-content-bx a i, .widget-area-left .contact-widget-info > p a:hover, .widget-area-right .contact-widget-info > p a:hover, .testimonial-style-default .testimonial-inner::after, .sticky-head.header-sticky .header-navbar a.h-phone:hover, .contact-widget-info > p > span.bi, .pricing-style-classic.pricing-table-wrapper:hover ul li:before, .widget-area-right .zozo_social_widget ul.nav.social-icons > li > a, .secondary-bar-inner .input-group-addon.zozo-mc.btn.btn-default, .blog-style-classic-pro .post-author a:hover > span.author-name, .contact-widget-info > p a:hover, .insta-footer-wrap .sub-title, .mobile-menu-floating ul.wp-menu ul.sub-menu li.menu-item.current-menu-ancestor.menu-item-has-children .sub-menu li.current-menu-item a, .widget-content-bx.w-address .bi, .campaign-loop.campaign-grid.campaign-grid-3 li.campaign a:hover h3, .blog-layouts-wrapper .blog-multi-layout-1 .cea-block-secondary .top-meta a i, .blog-layouts-wrapper .blog-multi-layout-1 .cea-block-primary .top-meta a i, .widget-area-right .wp-block-group__inner-container h1:after, .widget-area-right .wp-block-group__inner-container h2:after, .widget-area-right .wp-block-group__inner-container h3:after, .widget-area-right .wp-block-group__inner-container h4:after, .widget-area-right .wp-block-group__inner-container h5:after, .widget-area-right .wp-block-group__inner-container h6:after, .widget-area-left .widget .widget-title:after, aside.footer-widget-2 h5:after, .widget .widgettitle:after, .widget .widget-title:after,  blockquote:before,
.wp-block-quote.is-large:before, .wp-block-quote.is-style-large:before, .wp-block-quote.is-style-large:not(.is-style-plain):before, .wp-block-quote.has-text-align-right:before, .wp-block-quote:before,
.sticky-head.header-sticky .header-navbar .header-titles > *.site-title a:hover, .single-cea-team .team-social-wrap ul.social-icons > li > a i, .portfolio-style-classic .owl-carousel .owl-item:hover:before, .flip-box-inner .cea-button-link.elementor-size-sm .cea-button-icon, .elementor-widget-ceaposts .blog-style-modern .blog-inner .post-date a i, .elementor-widget-ceaposts .blog-style-list .blog-inner .post-date a i, .blog-style-default .blog-inner .author-name:hover, .single.single-cea-team .team-other-details .media-body a:hover, .single.single-cea-team .team-other-details .media-body span.team-experience:hover, .feature-box-wrapper.feature-box-modern .fbox-content a:hover, .feature-box-wrapper.feature-box-classic .fbox-content a:hover, .team-style-classic .team-inner .team-designation, .single aside.content-widgets-outer-wrapper .widget-content .menu-service-sidebar-menu-container li.current-menu-item a, .zozo_social_widget ul.nav.social-icons > li > a:hover, .woocommerce div ul.products li.product .price, .shop_table.cart td.product-price .amount, .shop_table.cart td.product-subtotal .amount, .woocommerce table.shop_table td.product-name, .woocommerce-info::before, .shop_table tfoot td, .woocommerce table.shop_table td, .woocommerce:where(body:not(.woocommerce-uses-block-theme)) .woocommerce-breadcrumb a, .wp-block-woocommerce-customer-account a:hover, .wc-block-grid__product .wc-block-grid__product-price ins .woocommerce-Price-amount.amount, .wc-block-grid__product .wc-block-grid__product-title:hover, .wc-block-grid__product .wc-block-grid__product-price, .woocommerce .widget_block .wc-block-active-filters .wc-block-active-filters__clear-all, .wc-block-price-filter .wc-block-components-filter-reset-button, .service-style-default .service-inner .post-category a, .service-style-modern .service-inner:hover .post-overlay-items .post-category a, .portfolio-style-default .portfolio-inner .post-category a:hover, .portfolio-style-default .portfolio-inner .post-overlay-items .post-icons a:hover, .portfolio-style-classic .portfolio-inner .post-overlay-items .post-icons a, .cus-portfolio-classic .portfolio-style-classic .portfolio-inner .post-overlay-items .post-icons a, .cus-portfolio-classic .portfolio-style-classic .portfolio-inner .post-overlay-items .post-icons a:hover, .row.portfolio-details .col-sm-4 > .portfolio-meta span.portfolio-meta-icon, .testimonial-style-default .testimonial-inner .testimonial-rating, .team-wrapper.team-style-modern .team-inner .post-overlay-items .post-designation-head, .cus-tm-wrap .testimonial-style-default .testimonial-inner .testimonial-rating p i:before, .hirxpert-masonry .top-meta-wrap .post-date a, .single .hirxpert-content-wrap .post-inner .post-date a, .single.single-cea-service aside.content-widgets-outer-wrapper .widget-content .menu .menu-item a, .single.single-cea-service aside.content-widgets-outer-wrapper .widget-content .menu .menu-item a:hover, .single.single-cea-service aside.content-widgets-outer-wrapper .widget-content .menu .current-menu-item.menu-item a, .content-widgets-wrapper .content-widgets > .widget .hirxpert_latest_post_widget .side-item .side-item-text a:hover {
		color: '. esc_attr( $primary_color ) .';
	}';
	echo '.hirxpert-masonry .bottom-meta-wrap .post-meta li.post-share-wrap .social-share a:hover, .single-post ul.social-share > li > a:hover, .post-share-wrap ul.social-share > li > a, .wp-block-button.is-style-outline a.wp-block-button__link, .cea-tab-elementor-widget .cea-tabs > a.active .cea-tab-title, .woocommerce-page .theme-color, .hirxpert-masonry .bottom-meta-wrap .post-meta .post-more a, .feature-box-default .fbox-content a:hover {
			color: '. esc_attr( $primary_color ) .' !important;
		}';
		echo '.wp-block-woocommerce-mini-cart .wc-block-mini-cart__button:hover .wc-block-mini-cart__icon {
			color: '. esc_attr( $primary_color ) .';
			fill: '. esc_attr( $primary_color ) .';
		}';

	echo 'blockquote,
.wp-block-quote.is-large, .wp-block-quote.is-style-large, .wp-block-quote.is-style-large:not(.is-style-plain),.wp-block-quote.has-text-align-right, .wp-block-quote,.woocommerce-message,
.woocommerce #content div.product .woocommerce-tabs ul.tabs, .woocommerce div.product .woocommerce-tabs ul.tabs, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs, .woocommerce-page div.product .woocommerce-tabs ul.tabs, .contact-form-wrapper span.wpcf7-form-control-wrap select:focus, .contact-form-wrapper span.wpcf7-form-control-wrap textarea:focus, .single-post .comments-wrapper.section-inner input:focus, .single-post .comments-wrapper.section-inner textarea:focus, .modal-popup-body input.wpcf7-form-control:focus, 
.modal-popup-body textarea.wpcf7-form-control:focus, .wp-block-search__input:focus, .mailchimp-wrapper .input-group input#zozo-mc-email:focus, .single-cea-testimonial .testimonial-info img, .cus-float-img .float-parallax img, .comments-wrapper.section-inner input:focus, .comments-wrapper.section-inner textarea:focus, .comments-pagination.pagination .page-numbers, .team-wrapper.team-style-default .team-inner > .post-thumb img.img-fluid.rounded-circle, .testimonial-wrapper.testimonial-style-list .post-thumb img, .timeline > li:hover .timeline-panel, nav.post-nav-links .post-page-numbers, .first-widget-abt, .zozo-booking-form-wrap .bookly-form select:focus, .zozo-booking-form-wrap .bookly-form input[type="text"]:focus, .zozo-booking-form-wrap .bookly-form input[type="number"]:focus, .zozo-booking-form-wrap .bookly-form input[type="password"]:focus, .zozo-booking-form-wrap .bookly-form textarea:focus, .wp-block-button.is-style-outline a.wp-block-button__link, form.post-password-form input:focus, .elementor-element.border-left-cls:before, form.form-inline.search-form .input-group > *.form-control:focus, .team-wrapper.team-style-default .team-inner:after, .charitable-form-fields input:focus, .single .content-widgets-wrapper .wp-block-search__input:focus, .single-cea-team .team-social-wrap ul.social-icons > li > a, .zozo_social_widget ul.nav.social-icons > li > a, .zozo_social_widget ul.nav.social-icons > li > a:hover, .mobile-menu-floating .search-form .search-field:focus, .widget.widget_search .search-form .search-field:focus, .woocommerce nav.woocommerce-pagination ul li a, .woocommerce nav.woocommerce-pagination ul li span, .woocommerce div.product div.images.woocommerce-product-gallery, .woocommerce div.product div.images .flex-control-thumbs li, .form-control:focus, .woocommerce form .form-row input.input-text:focus, .woocommerce form .form-row textarea:focus, .woocommerce form .form-row .input-text:focus, .woocommerce-page form .form-row .input-text:focus, .select2-container--default.select2-container--open.select2-container--below .select2-selection--single, ul.nav.pagination.post-pagination > li > a, .single-cea-team .team-social-wrap ul.social-icons > li > a, .error404-content .search-form .search-field:focus {
		border-color: '. esc_attr( $primary_color ) .';
	}';
	echo '.charitable-donation-form .donation-amount.selected, .charitable-donation-form .donation-amount.selected, .charitable-donation-amount-form .donation-amount.selected, .charitable-notice, .charitable-drag-drop-images li:hover a.remove-image, .supports-drag-drop .charitable-drag-drop-dropzone.drag-over, .cea-mailchimp-style-default input.form-control:focus, .cea-mailchimp-style-inline input.form-control:focus, .woocommerce-cart table.cart td.actions .coupon .input-text:focus, .woocommerce .wc-block-components-price-slider__range-input::-webkit-slider-thumb, .contact-form-wrapper span.wpcf7-form-control-wrap input:focus, .wpcf7-form.init .wpcf7-form-control-wrap .wpcf7-form-control:focus {
		border-color: '. esc_attr( $primary_color ) .' !important;
	}';		
	echo '.testimonial-wrapper.testimonial-style-default .owl-item .testimonial-inner,
	.full-search-wrapper form.form-inline.search-form .form-control:focus, textarea.wpcf7-form-control:focus {
		border-bottom-color: '. esc_attr( $primary_color ) .';
	}';
	echo '.team-wrapper.team-style-default .team-inner .post-thumb:before, .woocommerce-info {
		border-top-color: '. esc_attr( $primary_color ) .';
	}';
	echo '.cea-counter-wrapper.cea-counter-style-modern .counter-value > *,
	.portfolio-style-classic .owl-carousel .owl-item:hover:before {
		-webkit-text-stroke: 1px '. esc_attr( $primary_color ) .';
	}';		
	echo '.sidebar-broucher .doc-icon, .hirxpert-content-wrap aside.content-widgets-outer-wrapper .widget-title:after, .hirxpert-content-wrap .widget.widget_block .wp-block-group .wp-block-heading::after {
		background: '. esc_attr( $primary_color ) .';
	}';
}

//secondary color
$secondary_color = $hirxpert_styles->hirxpert_get_option( 'secondary-color' );
if( empty( $secondary_color ) ){
	$secondary_color = $primary_color;
}

$secondary_rgb = $hirxpert_styles->hirxpert_hex2rgba( $secondary_color, 'none' );
if( $secondary_color ){
	echo '.secondary-color, .widget-area-right .zozo_social_widget ul.nav.social-icons > li > a:hover,.hirxpert-masonry .bottom-meta-wrap .post-meta .post-more a, .woocommerce:where(body:not(.woocommerce-uses-block-theme)) .woocommerce-breadcrumb a:hover, .woocommerce .widget_block .wc-block-active-filters .wc-block-active-filters__clear-all:hover, .wc-block-price-filter .wc-block-components-filter-reset-button:hover, .sidebar-broucher .doc-icon  {
		color: '. esc_attr( $secondary_color ) .';
	}';
	echo '.secondary-bg, .portfolio-style-classic .portfolio-inner .post-overlay-items .post-icons a:hover {
		background-color: '. esc_attr( $secondary_color ) .';
	}';
	echo 'header.hirxpert-page-header:after {
		background-color: rgba('. esc_attr( $secondary_rgb ) .', 0.77);
	}';	
	echo '.close:hover, header a.btn.btn-primary:hover, .search-form .input-group .btn:hover, .full-search-wrapper,
.elementor-widget-ceaposts .blog-style-classic-pro .blog-inner .post-date a:hover, .bottom-meta .post-more:hover:before, .blog .hirxpert-masonry .post-meta .post-more a:hover:before, 
.hirxpert-masonry .bottom-meta-wrap .post-meta .post-more a:hover:before, .woocommerce ul.products li.product .button:hover, .woocommerce div.product .woocommerce-tabs ul.tabs li.active a, .woocommerce div.product .woocommerce-tabs ul.tabs li a:hover, .woocommerce #content input.button:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce-page #content input.button:hover, .woocommerce-page a.button:hover, .woocommerce-page button.button:hover, .woocommerce-page input.button:hover, .woocommerce input.button.alt:hover, .woocommerce input.button.disabled:hover, .woocommerce input.button:disabled[disabled]:hover, .cart_totals .wc-proceed-to-checkout a.checkout-button:hover, .woocommerce button.button.alt:hover, :where(body:not(.woocommerce-block-theme-has-button-styles)) .woocommerce button.button.alt.disabled:hover, .blog-style-default .blog-inner .post-date a:hover, .single-post .comments-wrapper.section-inner input.submit {
		background-color: '. esc_attr( $secondary_color ) .';
	}';	
}
echo '.zozo-booking-form-wrap .bookly-form select, select,
.cf-style-modern span.wpcf7-form-control-wrap select {
	background-image: url('. esc_url( get_template_directory_uri() . '/assets/images/icon-select.png' ) .'); 
	
}';
echo '.cus-testimonial-default .testimonial-wrapper.testimonial-style-default .testimonial-inner:before {
	background-image: url('. esc_url( get_template_directory_uri() . '/assets/images/quotation.webp' ) .'); 
}';
echo '.elementor-element.border-points:before {
	background-image: url('. esc_url( get_template_directory_uri() . '/assets/images/arrow-step.png' ) .'); 
}';
echo '.elementor-element.border-points:after {
	background-image: url('. esc_url( get_template_directory_uri() . '/assets/images/arrow-step-after.png' ) .'); 
}';
echo ' .elementor-element .section-title-wrapper .title-wrap > * .subtitle-dots:before {
	background-image: url('. esc_url( get_template_directory_uri() . '/assets/images/tie.webp' ) .'); 
}';
echo '.single.single-cea-team .hirxpert-content-wrap .team-content-area .row.team:before {
	background-image: url('. esc_url( get_template_directory_uri() . '/assets/images/shape-5.webp' ) .'); 
}';
//body background if boxed
$hirxpert_styles->hirxpert_bg_settings( 'site-bg', 'body' );

//button color keys -> fore, bg, border, hfore, hbg, hborder
echo '.btn, button, .back-to-top,.header-navbar a.btn.btn-primary, .widget_search .search-form .input-group .btn,button.wp-block-search__button,.btn.bordered:hover,.close,
button.wp-block-search__button, .comment-respond input[type="submit"],.wp-block-button__link,.button.button-primary, input[type=button], input[type="submit"], header .mini-cart-dropdown ul.cart-dropdown-menu > li.mini-view-cart a, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt,a.zozo-woo-compare-ajax.zozo-btn, .mini-view-wishlist a, .mini-view-cart a,.woocommerce .woocommerce-error .button, .woocommerce .woocommerce-info .button, .woocommerce .woocommerce-message .button, .woocommerce-page .woocommerce-error .button, .woocommerce-page .woocommerce-info .button, .woocommerce-page .woocommerce-message .button, a.zozo-compare-close, a.zozo-sticky-cart-close, a.zozo-sticky-wishlist-close  {';
	$hirxpert_styles->hirxpert_button_color( 'button-color', 'fore' );
	$hirxpert_styles->hirxpert_button_color( 'button-color', 'bg' );
	$hirxpert_styles->hirxpert_button_color( 'button-color', 'border' );
echo '}';
echo '.btn:hover, button:hover, .back-to-top:hover, .header-navbar a.btn.btn-primary:hover, .widget_search .search-form .input-group .btn:hover, button.wp-block-search__button:hover, .btn:focus, button:focus, .back-to-top:focus,.header-navbar a.btn.btn-primary:focus, .widget_search .search-form .input-group .btn:focus, button.wp-block-search__button:focus, .btn:active, button:active, .back-to-top:active,.header-navbar a.btn.btn-primary:active, .widget_search .search-form .input-group .btn:active, button.wp-block-search__button:active,.contact-form-wrapper input.wpcf7-form-control.wpcf7-submit:hover, input[type="submit"]:hover, header .mini-cart-dropdown ul.cart-dropdown-menu > li.mini-view-cart a:hover,nav.post-nav-links .post-page-numbers:hover, .wp-block-button__link:hover,.wp-block-button.is-style-outline a.wp-block-button__link:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover,a.zozo-woo-compare-ajax.zozo-btn:hover, .mini-view-wishlist a:hover, .mini-view-cart a:hover,.woocommerce .woocommerce-error .button:hover, .woocommerce .woocommerce-info .button:hover, .woocommerce .woocommerce-message .button:hover, .woocommerce-page .woocommerce-error .button:hover, .woocommerce-page .woocommerce-info .button:hover, .woocommerce-page .woocommerce-message .button:hover, a.zozo-compare-close:hover, a.zozo-sticky-cart-close:hover, a.zozo-sticky-wishlist-close:hover {';
	$hirxpert_styles->hirxpert_button_color( 'button-color', 'hfore' );
	$hirxpert_styles->hirxpert_button_color( 'button-color', 'hbg' ) ;
	$hirxpert_styles->hirxpert_button_color( 'button-color', 'hborder' );
echo '}';

//site link color
$hirxpert_styles->hirxpert_link_color( 'link-color', 'regular', '.header-topbar a' );
$hirxpert_styles->hirxpert_link_color( 'link-color', 'hover', '.header-topbar a:hover' );
$hirxpert_styles->hirxpert_link_color( 'link-color', 'active', '.header-topbar a:active, .header-topbar a:focus' );

//site padding
$hirxpert_styles->hirxpert_padding_settings( 'site-padding', '.hirxpert-content-wrap' );
$site_logo_width = $hirxpert_styles->hirxpert_get_option('site-logo-width');
if( !empty( $site_logo_width ) && isset( $site_logo_width['width'] ) && !empty( $site_logo_width['width'] ) ){
	echo 'img.site-logo { max-width: '. esc_attr( $site_logo_width['width'] ) .'px; }';
}

// mobile header style
$mobilebar_from = $hirxpert_styles->hirxpert_get_option('mobilebar-responsive');
$mobilebar_from = $mobilebar_from ? absint($mobilebar_from) : 767;
//Apply mobile header bar color
$mobilebar_color = $hirxpert_styles->hirxpert_get_option( 'header-mobilebar-color' );
$mobilebar_item_color = $hirxpert_styles->hirxpert_get_option( 'header-mobilebar-item-color' );
//Apply mobile menu color
$mobilemenu_color = $hirxpert_styles->hirxpert_get_option( 'mobile-menu-color' );
$mobilemenu_item_color = $hirxpert_styles->hirxpert_get_option( 'mobile-menu-item-color' );
//Apply mobile sidebar width 
$mobile_sidebar_width = $hirxpert_styles->hirxpert_get_option('mobile-sidebar-width');

echo '@media only screen and (max-width: ' . esc_attr($mobilebar_from) . 'px) {';
    echo '.header-mobilebar { display: flex; }';
    echo '.site-header { display: none; }';
	echo '.header-mobilebar.navbar *{
		color: '. esc_attr( $mobilebar_item_color ) .' !important;
	}';
	echo '.header-mobilebar.navbar {
		background-color: '. esc_attr( $mobilebar_color ) .' !important;
	}';	
	echo '.mobile-menu-active .mobile-menu-floating {
		background-color: '.esc_attr( $mobilemenu_color ).' !important;
	}';	
	echo '.mobile-menu-active .mobile-menu-floating * {
		color: '.esc_attr( $mobilemenu_item_color ).';
	}';	
	echo '.mobile-menu-floating i.close-icon:after, .mobile-menu-floating i.close-icon:before{
		border-bottom-color: '.esc_attr( $mobilemenu_item_color ).';
	}';
echo '}';

echo '@media only screen and (min-width: ' . esc_attr($mobilebar_from + 1) . 'px) {';
    echo '.site-header { display: block; }';
    echo '.header-mobilebar { display: none; }';
	echo '.header-mobilebar.navbar * {
		color: '. esc_attr( $mobilebar_item_color ) .' !important;
	}';
	echo '.header-mobilebar.navbar {
		background-color: '. esc_attr( $mobilebar_color ) .' !important;
	}';	
	echo '.mobile-menu-active .mobile-menu-floating {
		background-color: '. esc_attr( $mobilemenu_color ) .' !important;
	}';	
	echo '.mobile-menu-active .mobile-menu-floating * {
		color: '.esc_attr( $mobilemenu_item_color ).';
	}';	
	echo '.mobile-menu-floating i.close-icon:after, .mobile-menu-floating i.close-icon:before{
		border-bottom-color: '.esc_attr( $mobilemenu_item_color ).' !important;
	}';
echo '}';

if( !empty( $mobile_sidebar_width ) && isset( $mobile_sidebar_width['width'] ) && !empty( $mobile_sidebar_width['width'] ) ){
	echo '@media only screen and (max-width: ' . esc_attr($mobilebar_from) . 'px) {';
    echo '.mobile-menu-active .mobile-menu-floating {
		max-width: '. esc_attr( $mobile_sidebar_width['width'] ) .'px; 
	}';
	echo '}';
}

//page loader
$page_loader = $hirxpert_styles->hirxpert_image_settings('page_loader');
if( isset( $page_loader['url'] ) && !empty( $page_loader['url'] ) ){
	echo '.page-loader { background-image: url('. esc_url( $page_loader['url']  ) .'); }';
}

//body typo styles
$hirxpert_styles->hirxpert_typo_settings( 'content-typography', 'body' );

//lead typo styles
$hirxpert_styles->hirxpert_typo_settings( 'lead-typography', '.lead' );

//h1 typo styles
$hirxpert_styles->hirxpert_typo_settings( 'h1-typography', 'h1, .h1' );

//h2 typo styles
$hirxpert_styles->hirxpert_typo_settings( 'h2-typography', 'h2, .h2' );

//h3 typo styles
$hirxpert_styles->hirxpert_typo_settings( 'h3-typography', 'h3, .h3' );

//h4 typo styles
$hirxpert_styles->hirxpert_typo_settings( 'h4-typography', 'h4, .h4' );

//h5 typo styles
$hirxpert_styles->hirxpert_typo_settings( 'h5-typography', 'h5, .h5' );

//h6 typo styles
$hirxpert_styles->hirxpert_typo_settings( 'h6-typography', 'h6, .h6' );

// Heading Mobile View Typography
echo '@media only screen and (max-width: 767px){';
	
//h1 typo styles
$hirxpert_styles->hirxpert_typo_settings( 'h1-mobile-typography', 'h1, .h1' );

//h2 typo styles
$hirxpert_styles->hirxpert_typo_settings( 'h2-mobile-typography', 'h2, .h2' );

//h3 typo styles
$hirxpert_styles->hirxpert_typo_settings( 'h3-mobile-typography', 'h3, .h3' );

//h4 typo styles
$hirxpert_styles->hirxpert_typo_settings( 'h4-mobile-typography', 'h4, .h4' );

//h5 typo styles
$hirxpert_styles->hirxpert_typo_settings( 'h5-mobile-typography', 'h5, .h5' );

//h6 typo styles
$hirxpert_styles->hirxpert_typo_settings( 'h6-mobile-typography', 'h6, .h6' );

echo '}';

//header typo styles & link color
$hirxpert_styles->hirxpert_typo_settings( 'header-typography', '.site-header' );
$hirxpert_styles->hirxpert_link_color( 'header-links-color', 'regular', '.site-header a' );
$hirxpert_styles->hirxpert_link_color( 'header-links-color', 'hover', '.site-header a:hover' );
$hirxpert_styles->hirxpert_link_color( 'header-links-color', 'active', '.site-header a:active' );
$hirxpert_styles->hirxpert_bg_settings( 'header-background', '.site-header' );
$hirxpert_styles->hirxpert_padding_settings( 'header-padding', '.site-header' );
$hirxpert_styles->hirxpert_margin_settings( 'header-margin', '.site-header' );
$hirxpert_styles->hirxpert_border_settings( 'header-border', '.site-header' );

//dropdown style
$hirxpert_styles->hirxpert_bg_settings( 'dropdown-background', '.primary-menu .menu-item-has-children ul.sub-menu' );
$hirxpert_styles->hirxpert_link_color( 'dropdown-links-color', 'regular', '.primary-menu .menu-item-has-children ul.sub-menu li a' );
$hirxpert_styles->hirxpert_link_color( 'dropdown-links-color', 'hover', '.primary-menu .menu-item-has-children ul.sub-menu li a:hover' );
$hirxpert_styles->hirxpert_link_color( 'dropdown-links-color', 'active', '.primary-menu .menu-item-has-children ul.sub-menu li a:active, .primary-menu li.current-menu-parent > ul.sub-menu > li.current-menu-item > a,
.primary-menu li.current-menu-parent > ul.sub-menu > li.current-menu-ancestor.current-menu-item > a, ul.wp-menu ul.sub-menu li.menu-item.current-menu-ancestor.menu-item-has-children > a' );



//dropdown on sticky style
$hirxpert_styles->hirxpert_bg_settings( 'dropdown-sticky-background', '.sticky-head.header-sticky .primary-menu .menu-item-has-children ul.sub-menu li' );
$hirxpert_styles->hirxpert_link_color( 'dropdown-sticky-links-color', 'regular', '.sticky-head.header-sticky .primary-menu .menu-item-has-children ul.sub-menu li a' );
$hirxpert_styles->hirxpert_link_color( 'dropdown-sticky-links-color', 'hover', '.sticky-head.header-sticky .primary-menu .menu-item-has-children ul.sub-menu li a:hover' );
$hirxpert_styles->hirxpert_link_color( 'dropdown-sticky-links-color', 'active', '.sticky-head.header-sticky .primary-menu .menu-item-has-children ul.sub-menu li a:active, .sticky-head.header-sticky .primary-menu li.current-menu-parent > ul.sub-menu > li.current-menu-item > a, .sticky-head.header-sticky .primary-menu li.current-menu-parent > ul.sub-menu > li.current-menu-ancestor.current-menu-item > a,.sticky-head.header-sticky ul.wp-menu ul.sub-menu li.menu-item.current-menu-ancestor.menu-item-has-children > a' );

//header topbar typo styles
$hirxpert_styles->hirxpert_typo_settings( 'header-topbar-typography', '.header-topbar' );

//header topbar styles & link color
$topbar_height = $hirxpert_styles->hirxpert_get_option('header-topbar-height');
if( !empty( $topbar_height ) && isset( $topbar_height['height'] ) && !empty( $topbar_height['height'] ) ){
	echo '.header-topbar {';
		echo 'line-height: '. esc_attr( $topbar_height['height'] ) .'px;';
	echo '}';
}

$topbar_sticky_height = $hirxpert_styles->hirxpert_get_option('header-topbar-sticky-height');
if( !empty( $topbar_sticky_height ) && isset( $topbar_sticky_height['height'] ) && !empty( $topbar_sticky_height['height'] ) ){
	echo '.header-sticky .header-topbar {';
		echo 'line-height: '. esc_attr( $topbar_sticky_height['height'] ) .'px;';
	echo '}';
}

$hirxpert_styles->hirxpert_bg_settings( 'header-topbar-background', '.header-topbar' );
$hirxpert_styles->hirxpert_padding_settings( 'header-topbar-padding', '.header-topbar' );
$hirxpert_styles->hirxpert_margin_settings( 'header-topbar-margin', '.header-topbar' );
$hirxpert_styles->hirxpert_border_settings( 'header-topbar-border', '.header-topbar' );
$hirxpert_styles->hirxpert_link_color( 'header-topbar-links-color', 'regular', '.header-topbar a' );
$hirxpert_styles->hirxpert_link_color( 'header-topbar-links-color', 'hover', '.header-topbar a:hover' );
$hirxpert_styles->hirxpert_link_color( 'header-topbar-links-color', 'active', '.header-topbar a:active, .header-topbar ul.wp-menu > li.current-menu-item > a,.header-topbar ul.nav.wp-menu > li.menu-item-has-children.current_page_parent > a, .header-topbar ul.nav.wp-menu > li.menu-item-has-children.current-menu-ancestor > a' );

//topbar on sticky style
$hirxpert_styles->hirxpert_bg_settings( 'header-topbar-sticky-background', '.sticky-head.header-sticky .header-topbar' );
$hirxpert_styles->hirxpert_link_color( 'header-topbar-sticky-links-color', 'regular', '.sticky-head.header-sticky .header-topbar a' );
$hirxpert_styles->hirxpert_link_color( 'header-topbar-sticky-links-color', 'hover', '.sticky-head.header-sticky .header-topbar a:hover' );
$hirxpert_styles->hirxpert_link_color( 'header-topbar-sticky-links-color', 'active', '.sticky-head.header-sticky .header-topbar a:active, .sticky-head.header-sticky .header-topbar ul.wp-menu > li.current-menu-item > a, .sticky-head.header-sticky .header-topbar ul.nav.wp-menu > li.menu-item-has-children.current_page_parent > a,.sticky-head.header-sticky .header-topbar ul.nav.wp-menu > li.menu-item-has-children.current-menu-ancestor > a'  );

//header logobar typo styles
$hirxpert_styles->hirxpert_typo_settings( 'header-logobar-typography', '.header-logobar' );

//header logobar styles & link color
$logobar_height = $hirxpert_styles->hirxpert_get_option('header-logobar-height');
if( !empty( $logobar_height ) && isset( $logobar_height['height'] ) && !empty( $logobar_height['height'] ) ){
	echo '.header-logobar {';
		echo 'line-height: '. esc_attr( $logobar_height['height'] ) .'px;';
	echo '}';
}

$logobar_sticky_height = $hirxpert_styles->hirxpert_get_option('header-logobar-sticky-height');
if( !empty( $logobar_sticky_height ) && isset( $logobar_sticky_height['height'] ) && !empty( $logobar_sticky_height['height'] ) ){
	echo '.header-sticky .header-logobar {';
		echo 'line-height: '. esc_attr( $logobar_sticky_height['height'] ) .'px;';
	echo '}';
}

$hirxpert_styles->hirxpert_bg_settings( 'header-logobar-background', '.header-logobar' );
$hirxpert_styles->hirxpert_padding_settings( 'header-logobar-padding', '.header-logobar' );
$hirxpert_styles->hirxpert_margin_settings( 'header-logobar-margin', '.header-logobar' );
$hirxpert_styles->hirxpert_border_settings( 'header-logobar-border', '.header-logobar' ); 
$hirxpert_styles->hirxpert_link_color( 'header-logobar-links-color', 'regular', '.header-logobar a' );
$hirxpert_styles->hirxpert_link_color( 'header-logobar-links-color', 'hover', '.header-logobar a:hover' );
$hirxpert_styles->hirxpert_link_color( 'header-logobar-links-color', 'active', '.header-logobar a:active, .header-logobar ul.wp-menu > li.current-menu-item > a,.header-logobar ul.nav.wp-menu > li.menu-item-has-children.current_page_parent > a, .header-logobar ul.nav.wp-menu > li.menu-item-has-children.current-menu-ancestor > a' );

//logobar on sticky style
$hirxpert_styles->hirxpert_bg_settings( 'header-logobar-sticky-background', '.sticky-head.header-sticky .header-logobar' );
$hirxpert_styles->hirxpert_link_color( 'header-logobar-sticky-links-color', 'regular', '.sticky-head.header-sticky .header-logobar a' );
$hirxpert_styles->hirxpert_link_color( 'header-logobar-sticky-links-color', 'hover', '.sticky-head.header-sticky .header-logobar a:hover' );
$hirxpert_styles->hirxpert_link_color( 'header-logobar-sticky-links-color', 'active', '.sticky-head.header-sticky .header-logobar a:active, .sticky-head.header-sticky .header-logobar ul.wp-menu > li.current-menu-item > a, .sticky-head.header-sticky .header-logobar ul.nav.wp-menu > li.menu-item-has-children.current_page_parent > a,.sticky-head.header-sticky .header-logobar ul.nav.wp-menu > li.menu-item-has-children.current-menu-ancestor > a' );

//header navbar typo styles
$hirxpert_styles->hirxpert_typo_settings( 'header-navbar-typography', '.header-navbar' );

//header navbar styles & link color
$navbar_height = $hirxpert_styles->hirxpert_get_option('header-navbar-height');
if( !empty( $navbar_height ) && isset( $navbar_height['height'] ) && !empty( $navbar_height['height'] ) ){
	echo '.header-navbar {';
		echo 'line-height: '. esc_attr( $navbar_height['height'] ) .'px;';
	echo '}';
}

$navbar_sticky_height = $hirxpert_styles->hirxpert_get_option('header-navbar-sticky-height');
if( !empty( $navbar_sticky_height ) && isset( $navbar_sticky_height['height'] ) && !empty( $navbar_sticky_height['height'] ) ){
	echo '.header-sticky .header-navbar {';
		echo 'line-height: '. esc_attr( $navbar_sticky_height['height'] ) .'px;';
	echo '}';
}

$hirxpert_styles->hirxpert_bg_settings( 'header-navbar-background', '.header-navbar' );
$hirxpert_styles->hirxpert_padding_settings( 'header-navbar-padding', '.header-navbar' );
$hirxpert_styles->hirxpert_margin_settings( 'header-navbar-margin', '.header-navbar' );
$hirxpert_styles->hirxpert_border_settings( 'header-navbar-border', '.header-navbar' );
$hirxpert_styles->hirxpert_link_color( 'header-navbar-links-color', 'regular', '.header-navbar a' );
$hirxpert_styles->hirxpert_link_color( 'header-navbar-links-color', 'hover', '.header-navbar a:hover' );
$hirxpert_styles->hirxpert_link_color( 'header-navbar-links-color', 'active', '.header-navbar a:active, .header-navbar ul.wp-menu > li.current-menu-item > a, .header-navbar ul.nav.wp-menu > li.menu-item-has-children.current-menu-ancestor > a' );

//navbar on sticky style
$hirxpert_styles->hirxpert_bg_settings( 'header-navbar-sticky-background', '.sticky-head.header-sticky .header-navbar' );
$hirxpert_styles->hirxpert_link_color( 'header-navbar-sticky-links-color', 'regular', '.sticky-head.header-sticky .header-navbar a' );
$hirxpert_styles->hirxpert_link_color( 'header-navbar-sticky-links-color', 'hover', '.sticky-head.header-sticky .header-navbar a:hover' );
$hirxpert_styles->hirxpert_link_color( 'header-navbar-sticky-links-color', 'active', '.sticky-head.header-sticky .header-navbar a:active, .sticky-head.header-sticky .header-navbar ul.wp-menu > li.current-menu-item > a, .sticky-head.header-sticky .header-navbar ul.nav.wp-menu > li.menu-item-has-children.current-menu-ancestor > a, .sticky-head.header-sticky .header-navbar a.active' );

//logo styles
$site_logo_width = $hirxpert_styles->hirxpert_get_option('site-logo-width');
if( !empty( $site_logo_width ) && isset( $site_logo_width['width'] ) && !empty( $site_logo_width['width'] ) ){
	echo 'img.site-logo { max-width: '. esc_attr( $site_logo_width['width'] ) .'px; }';
}
$sticky_logo_width = $hirxpert_styles->hirxpert_get_option('sticky-logo-width');
if( !empty( $sticky_logo_width ) && isset( $sticky_logo_width['width'] ) && !empty( $sticky_logo_width['width'] ) ){
	echo 'img.sticky-logo { max-width: '. esc_attr( $sticky_logo_width['width'] ) .'px; }';
}
$mobile_logo_width = $hirxpert_styles->hirxpert_get_option('mobile-logo-width');
if( !empty( $mobile_logo_width ) && isset( $mobile_logo_width['width'] ) && !empty( $mobile_logo_width['width'] ) ){
	echo 'img.mobile-logo { max-width: '. esc_attr( $mobile_logo_width['width'] ) .'px; }';
}


//blog page title settings
$hirxpert_styles->hirxpert_color( 'blog-title-color', '.blog .page-title-wrap .page-title, .blog .page-title-wrap .breadcrumb li' );
$hirxpert_styles->hirxpert_color( 'blog-title-desc-color', '.blog .page-title-wrap .page-subtitle' );
$hirxpert_styles->hirxpert_link_color( 'blog-title-link-color', 'regular', '.blog .page-title-wrap .breadcrumb a' );
$hirxpert_styles->hirxpert_link_color( 'blog-title-link-color', 'hover', '.blog .page-title-wrap .breadcrumb a:hover' );
$hirxpert_styles->hirxpert_link_color( 'blog-title-link-color', 'active', '.blog .page-title-wrap .breadcrumb a:active' );
$hirxpert_styles->hirxpert_bg_settings( 'blog-title-bg', '.blog .hirxpert-page-header' );
$hirxpert_styles->hirxpert_padding_settings( 'blog-title-padding', '.blog .page-title-wrap' );
$hirxpert_styles->hirxpert_bg_settings( 'blog-title-overlaycolor', '.blog .hirxpert-page-header:after' );
$blog_overlay = $hirxpert_styles->hirxpert_get_option( 'blog-title-overlaycolor' );
echo '.blog .hirxpert-page-header:after {
    background-color: ' . esc_attr( $blog_overlay ) . ';
}';

//archive page title settings
$hirxpert_styles->hirxpert_color( 'archive-title-color', '.archive .page-title-wrap .page-title, .archive .page-title-wrap .breadcrumb li, .search .page-title-wrap .page-title, .search .page-title-wrap .breadcrumb li' );
$hirxpert_styles->hirxpert_color( 'archive-title-desc-color', '.archive .page-title-wrap .page-subtitle, .search .page-title-wrap .page-subtitle' );
$hirxpert_styles->hirxpert_link_color( 'archive-title-link-color', 'regular', '.archive .page-title-wrap .breadcrumb a, .search .page-title-wrap .breadcrumb a' );
$hirxpert_styles->hirxpert_link_color( 'archive-title-link-color', 'hover', '.archive .page-title-wrap .breadcrumb a:hover, .search .page-title-wrap .breadcrumb a:hover' );
$hirxpert_styles->hirxpert_link_color( 'archive-title-link-color', 'active', '.archive .page-title-wrap .breadcrumb a:active, .search .page-title-wrap .breadcrumb a:active' );
$hirxpert_styles->hirxpert_bg_settings( 'archive-title-bg', '.archive .hirxpert-page-header, .search .hirxpert-page-header' );
$hirxpert_styles->hirxpert_padding_settings( 'archive-title-padding', '.archive .page-title-wrap, .search .page-title-wrap' );
$hirxpert_styles->hirxpert_bg_settings( 'archive-title-overlaycolor', '.archive .hirxpert-page-header:after, .search .hirxpert-page-header:after' );
$archive_overlay = $hirxpert_styles->hirxpert_get_option( 'archive-title-overlaycolor' );
echo '.archive .hirxpert-page-header:after, .search .hirxpert-page-header:after {
    background-color: ' . esc_attr( $archive_overlay ) . ';
}';

//single post page title settings
$hirxpert_styles->hirxpert_color( 'single-title-color', '.single-post .page-title-wrap .page-title, .single-post .page-title-wrap .breadcrumb li, .single-product .page-title-wrap .page-title, .single-product .page-title-wrap .breadcrumb li, .single-campaign .page-title-wrap .page-title, .single-campaign .page-title-wrap .breadcrumb li' );
$hirxpert_styles->hirxpert_color( 'single-title-desc-color', '.single-post .page-title-wrap .page-subtitle, .single-product .page-title-wrap .page-subtitle, .single-campaign .page-title-wrap .page-subtitle' );
$hirxpert_styles->hirxpert_link_color( 'single-title-link-color', 'regular', '.single-post .page-title-wrap .breadcrumb a, .single-product .page-title-wrap .breadcrumb a, .single-campaign .page-title-wrap .breadcrumb a' );
$hirxpert_styles->hirxpert_link_color( 'single-title-link-color', 'hover', '.single-post .page-title-wrap .breadcrumb a:hover, .single-product .page-title-wrap .breadcrumb a:hover, .single-campaign .page-title-wrap .breadcrumb a:hover' );
$hirxpert_styles->hirxpert_link_color( 'single-title-link-color', 'active', '.single-post .page-title-wrap .breadcrumb a:active, .single-product .page-title-wrap .breadcrumb a:active, .single-campaign .page-title-wrap .breadcrumb a:active' );
$hirxpert_styles->hirxpert_bg_settings( 'single-title-bg', '.single-post .hirxpert-page-header, .single-product .hirxpert-page-header, .single-campaign .hirxpert-page-header' );
$hirxpert_styles->hirxpert_padding_settings( 'single-title-padding', '.single-post .page-title-wrap, .single-product .page-title-wrap, .single-campaign .page-title-wrap' );
$hirxpert_styles->hirxpert_bg_settings( 'single-title-overlaycolor', '.single-post .hirxpert-page-header:after, .single-product .hirxpert-page-header:after, .single-product .hirxpert-page-header:after, body.single-doctors-directory.doctors-directory-template-default .hirxpert-page-header:after' );
$single_overlay = $hirxpert_styles->hirxpert_get_option( 'single-title-overlaycolor' );
echo '.single-post .hirxpert-page-header:after, .single-product .hirxpert-page-header:after, .single-product .hirxpert-page-header:after, body.single-doctors-directory.doctors-directory-template-default .hirxpert-page-header:after {
    background-color: ' . esc_attr( $single_overlay ) . ';
}';

//page title settings
$hirxpert_styles->hirxpert_color( 'page-title-color', '.page .page-title-wrap .page-title, .page .page-title-wrap .breadcrumb li, .error404 .page-title-wrap .page-title, .error404 .page-title-wrap .breadcrumb li' );
$hirxpert_styles->hirxpert_color( 'page-title-desc-color', '.page .page-title-wrap .page-subtitle, .error404 .page-title-wrap .page-subtitle' );
$hirxpert_styles->hirxpert_link_color( 'page-title-link-color', 'regular', '.page .page-title-wrap .breadcrumb a, .error404 .page-title-wrap .breadcrumb a' );
$hirxpert_styles->hirxpert_link_color( 'page-title-link-color', 'hover', '.page .page-title-wrap .breadcrumb a:hover, .error404 .page-title-wrap .breadcrumb a:hover' );
$hirxpert_styles->hirxpert_link_color( 'page-title-link-color', 'active', '.page .page-title-wrap .breadcrumb a:active, .error404 .page-title-wrap .breadcrumb a:active' );
$hirxpert_styles->hirxpert_bg_settings( 'page-title-bg', '.page .hirxpert-page-header, .error404 .hirxpert-page-header' );
$hirxpert_styles->hirxpert_padding_settings( 'page-title-padding', '.page .page-title-wrap, .error404 .page-title-wrap' );
$hirxpert_styles->hirxpert_bg_settings( 'page-title-overlaycolor','.page .hirxpert-page-header:after, .error404 .hirxpert-page-header:after');
$page_title_overlay = $hirxpert_styles->hirxpert_get_option( 'page-title-overlaycolor' );
echo '.page .hirxpert-page-header:after, .error404 .hirxpert-page-header:after{
	background-color: ' . esc_attr($page_title_overlay) . ';
}';

//Custom Post Single title settings
$hirxpert_styles->hirxpert_color( 'custom-single-title-color', '.single[class*="single-cea-"] .page-title-wrap .page-title, .single[class*="single-cea-"] .page-title-wrap .breadcrumb li' );
$hirxpert_styles->hirxpert_color( 'custom-single-title-desc-color', '.single[class*="single-cea-"] .page-title-wrap .page-subtitle' );
$hirxpert_styles->hirxpert_link_color( 'custom-single-title-link-color', 'regular', '.single[class*="single-cea-"] .page-title-wrap .breadcrumb a' );
$hirxpert_styles->hirxpert_link_color( 'custom-single-title-link-color', 'hover', '.single[class*="single-cea-"] .page-title-wrap .breadcrumb a:hover' );
$hirxpert_styles->hirxpert_link_color( 'custom-single-title-link-color', 'active', '.single[class*="single-cea-"] .page-title-wrap .breadcrumb a:active' );
$hirxpert_styles->hirxpert_bg_settings( 'custom-single-title-bg', '.single[class*="single-cea-"] .hirxpert-page-header' );
$hirxpert_styles->hirxpert_padding_settings( 'custom-single-title-padding', '.single[class*="single-cea-"] .page-title-wrap' );
$hirxpert_styles->hirxpert_bg_settings( 'custom-single-title-overlaycolor','.single[class*="single-cea-"] .hirxpert-page-header:after');
$custom_single_overlay = $hirxpert_styles->hirxpert_get_option( 'custom-single-title-overlaycolor' );
echo '.single[class*="single-cea-"] .hirxpert-page-header:after {
	background-color: ' . esc_attr($custom_single_overlay) . ';
}';


//Custom Post Service Single title settings
$hirxpert_styles->hirxpert_color( 'cea-service-title-color', '.single.single-cea-service .page-title-wrap .page-title, .single-cea-service .page-title-wrap .breadcrumb li' );
$hirxpert_styles->hirxpert_color( 'cea-service-title-desc-color', '.single.single-cea-service .page-title-wrap .page-subtitle' );
$hirxpert_styles->hirxpert_link_color( 'cea-service-title-link-color', 'regular', '.single.single-cea-service .page-title-wrap .breadcrumb a' );
$hirxpert_styles->hirxpert_link_color( 'cea-service-title-link-color', 'hover', '.single.single-cea-service .page-title-wrap .breadcrumb a:hover' );
$hirxpert_styles->hirxpert_link_color( 'cea-service-title-link-color', 'active', '.single.single-cea-service .page-title-wrap .breadcrumb a:active' );
$hirxpert_styles->hirxpert_bg_settings( 'cea-service-title-bg', '.single.single-cea-service .hirxpert-page-header' );
$hirxpert_styles->hirxpert_padding_settings( 'cea-service-title-padding', '.single.single-cea-service .page-title-wrap' );
$hirxpert_styles->hirxpert_bg_settings( 'cea-service-overlaycolor','.single.single-cea-service .hirxpert-page-header:after');
$service_overlay = $hirxpert_styles->hirxpert_get_option( 'cea-service-overlaycolor' );
echo '.single.single-cea-service .hirxpert-page-header:after {
	background-color: ' . esc_attr($service_overlay) . ';
}';


//Custom Post Team Single title settings
$hirxpert_styles->hirxpert_color( 'cea-team-title-color', '.single.single-cea-team .page-title-wrap .page-title, .single-cea-team .page-title-wrap .breadcrumb li' );
$hirxpert_styles->hirxpert_color( 'cea-team-title-desc-color', '.single.single-cea-team .page-title-wrap .page-subtitle' );
$hirxpert_styles->hirxpert_link_color( 'cea-team-title-link-color', 'regular', '.single.single-cea-team .page-title-wrap .breadcrumb a' );
$hirxpert_styles->hirxpert_link_color( 'cea-team-title-link-color', 'hover', '.single.single-cea-team .page-title-wrap .breadcrumb a:hover' );
$hirxpert_styles->hirxpert_link_color( 'cea-team-title-link-color', 'active', '.single.single-cea-team .page-title-wrap .breadcrumb a:active' );
$hirxpert_styles->hirxpert_bg_settings( 'cea-team-title-bg', '.single.single-cea-team .hirxpert-page-header' );
$hirxpert_styles->hirxpert_padding_settings( 'cea-team-title-padding', '.single.single-cea-team .page-title-wrap' );
$hirxpert_styles->hirxpert_bg_settings( 'cea-team-overlaycolor','.single.single-cea-team .hirxpert-page-header:after');
$team_overlay = $hirxpert_styles->hirxpert_get_option( 'cea-team-overlaycolor' );
echo '.single.single-cea-team .hirxpert-page-header:after {
	background-color: ' . esc_attr($team_overlay) . ';
}';


//Custom Post Testimonial Single title settings
$hirxpert_styles->hirxpert_color( 'cea-testimonial-title-color', '.single.single-cea-testimonial .page-title-wrap .page-title, .single-cea-testimonial .page-title-wrap .breadcrumb li' );
$hirxpert_styles->hirxpert_color( 'cea-testimonial-title-desc-color', '.single.single-cea-testimonial .page-title-wrap .page-subtitle' );
$hirxpert_styles->hirxpert_link_color( 'cea-testimonial-title-link-color', 'regular', '.single.single-cea-testimonial .page-title-wrap .breadcrumb a' );
$hirxpert_styles->hirxpert_link_color( 'cea-testimonial-title-link-color', 'hover', '.single.single-cea-testimonial .page-title-wrap .breadcrumb a:hover' );
$hirxpert_styles->hirxpert_link_color( 'cea-testimonial-title-link-color', 'active', '.single.single-cea-testimonial .page-title-wrap .breadcrumb a:active' );
$hirxpert_styles->hirxpert_bg_settings( 'cea-testimonial-title-bg', '.single.single-cea-testimonial .hirxpert-page-header' );
$hirxpert_styles->hirxpert_padding_settings( 'cea-testimonial-title-padding', '.single.single-cea-testimonial .page-title-wrap' );
$hirxpert_styles->hirxpert_bg_settings( 'cea-testimonial-overlaycolor','.single.single-cea-testimonial .hirxpert-page-header:after');
$testimonial_overlay = $hirxpert_styles->hirxpert_get_option( 'cea-testimonial-overlaycolor' );
echo '.single.single-cea-testimonial .hirxpert-page-header:after {
	background-color: ' . esc_attr($testimonial_overlay) . ';
}';


//Custom Post Portfolio Single title settings
$hirxpert_styles->hirxpert_color( 'cea-portfolio-title-color', '.single.single-cea-portfolio .page-title-wrap .page-title, .single-cea-portfolio .page-title-wrap .breadcrumb li' );
$hirxpert_styles->hirxpert_color( 'cea-portfolio-title-desc-color', '.single.single-cea-portfolio .page-title-wrap .page-subtitle' );
$hirxpert_styles->hirxpert_link_color( 'cea-portfolio-title-link-color', 'regular', '.single.single-cea-portfolio .page-title-wrap .breadcrumb a' );
$hirxpert_styles->hirxpert_link_color( 'cea-portfolio-title-link-color', 'hover', '.single.single-cea-portfolio .page-title-wrap .breadcrumb a:hover' );
$hirxpert_styles->hirxpert_link_color( 'cea-portfolio-title-link-color', 'active', '.single.single-cea-portfolio .page-title-wrap .breadcrumb a:active' );
$hirxpert_styles->hirxpert_bg_settings( 'cea-portfolio-title-bg', '.single.single-cea-portfolio .hirxpert-page-header' );
$hirxpert_styles->hirxpert_padding_settings( 'cea-portfolio-title-padding', '.single.single-cea-portfolio .page-title-wrap' );
$hirxpert_styles->hirxpert_bg_settings( 'cea-portfolio-overlaycolor','.single.single-cea-portfolio .hirxpert-page-header:after');
$portfolio_overlay = $hirxpert_styles->hirxpert_get_option( 'cea-portfolio-overlaycolor' );
echo '.single.single-cea-portfolio .hirxpert-page-header:after {
	background-color: ' . esc_attr($portfolio_overlay) . ';
}';

//Custom Post Event Single title settings
$hirxpert_styles->hirxpert_color( 'cea-event-title-color', '.single.single-cea-event .page-title-wrap .page-title, .single-cea-event .page-title-wrap .breadcrumb li' );
$hirxpert_styles->hirxpert_color( 'cea-event-title-desc-color', '.single.single-cea-event .page-title-wrap .page-subtitle' );
$hirxpert_styles->hirxpert_link_color( 'cea-event-title-link-color', 'regular', '.single.single-cea-event .page-title-wrap .breadcrumb a' );
$hirxpert_styles->hirxpert_link_color( 'cea-event-title-link-color', 'hover', '.single.single-cea-event .page-title-wrap .breadcrumb a:hover' );
$hirxpert_styles->hirxpert_link_color( 'cea-event-title-link-color', 'active', '.single.single-cea-event .page-title-wrap .breadcrumb a:active' );
$hirxpert_styles->hirxpert_bg_settings( 'cea-event-title-bg', '.single.single-cea-event .hirxpert-page-header' );
$hirxpert_styles->hirxpert_padding_settings( 'cea-event-title-padding', '.single.single-cea-event .page-title-wrap' );
$hirxpert_styles->hirxpert_bg_settings( 'cea-event-overlaycolor','.single.single-cea-event .hirxpert-page-header:after');
$portfolio_overlay = $hirxpert_styles->hirxpert_get_option( 'cea-event-overlaycolor' );
echo '.single.single-cea-event .hirxpert-page-header:after {
	background-color: ' . esc_attr($portfolio_overlay) . ';
}';


//shop page title settings
$hirxpert_styles->hirxpert_color( 'shop-title-color', '.woocommerce-shop .page-title-wrap .page-title, .woocommerce-shop .page-title-wrap .breadcrumb li' );
$hirxpert_styles->hirxpert_color( 'shop-title-desc-color', '.woocommerce-shop .page-title-wrap .page-subtitle' );
$hirxpert_styles->hirxpert_link_color( 'shop-title-link-color', 'regular', '.woocommerce-shop .page-title-wrap .breadcrumb a' );
$hirxpert_styles->hirxpert_link_color( 'shop-title-link-color', 'hover', '.woocommerce-shop .page-title-wrap .breadcrumb a:hover' );
$hirxpert_styles->hirxpert_link_color( 'shop-title-link-color', 'active', '.woocommerce-shop .page-title-wrap .breadcrumb a:active' );
$hirxpert_styles->hirxpert_bg_settings( 'shop-title-bg', '.woocommerce-shop .hirxpert-page-header' );
$hirxpert_styles->hirxpert_padding_settings( 'shop-title-padding', '.woocommerce-shop .page-title-wrap' );
$hirxpert_styles->hirxpert_bg_settings( 'shop-title-overlaycolor', '.woocommerce-shop .hirxpert-page-header:after' );

//woocommerce product page title settings
$hirxpert_styles->hirxpert_color( 'product-title-color', '.woocommerce-product .page-title-wrap .page-title, .woocommerce-product .page-title-wrap .breadcrumb li' );
$hirxpert_styles->hirxpert_color( 'product-title-desc-color', '.woocommerce-product .page-title-wrap .page-subtitle' );
$hirxpert_styles->hirxpert_link_color( 'product-title-link-color', 'regular', '.woocommerce-product .page-title-wrap .breadcrumb a' );
$hirxpert_styles->hirxpert_link_color( 'product-title-link-color', 'hover', '.woocommerce-product .page-title-wrap .breadcrumb a:hover' );
$hirxpert_styles->hirxpert_link_color( 'product-title-link-color', 'active', '.woocommerce-product .page-title-wrap .breadcrumb a:active' );
$hirxpert_styles->hirxpert_bg_settings( 'product-title-bg', '.woocommerce-page .hirxpert-page-header' );
$hirxpert_styles->hirxpert_padding_settings( 'product-title-padding', '.woocommerce-product .page-title-wrap' );
$hirxpert_styles->hirxpert_bg_settings( 'product-title-overlaycolor', '.woocommerce-shop .hirxpert-page-header:after' );

//woocommerce product category page title settings
$hirxpert_styles->hirxpert_color( 'shop-title-color', '.hirxpert-woo-category .page-title-wrap .page-title, .hirxpert-woo-category .page-title-wrap .breadcrumb li' );
$hirxpert_styles->hirxpert_color( 'shop-title-desc-color', '.hirxpert-woo-category .page-title-wrap .page-subtitle' );
$hirxpert_styles->hirxpert_link_color( 'shop-title-link-color', 'regular', '.hirxpert-woo-category .page-title-wrap .breadcrumb a' );
$hirxpert_styles->hirxpert_link_color( 'shop-title-link-color', 'hover', '.hirxpert-woo-category .page-title-wrap .breadcrumb a:hover' );
$hirxpert_styles->hirxpert_link_color( 'shop-title-link-color', 'active', '.hirxpert-woo-category .page-title-wrap .breadcrumb a:active' );
$hirxpert_styles->hirxpert_bg_settings( 'shop-title-bg', '.hirxpert-woo-category .hirxpert-page-header' );
$hirxpert_styles->hirxpert_padding_settings( 'shop-title-padding', '.hirxpert-woo-category .page-title-wrap' );
$hirxpert_styles->hirxpert_bg_settings( 'shop-title-overlaycolor', '.hirxpert-woo-category .hirxpert-page-header:after' );

//footer styles and link color
$hirxpert_styles->hirxpert_typo_settings( 'footer-typography', '.site-footer' );
$hirxpert_styles->hirxpert_bg_settings( 'footer-background', '.site-footer' );
$hirxpert_styles->hirxpert_padding_settings( 'footer-padding', '.site-footer' );
$hirxpert_styles->hirxpert_margin_settings( 'footer-margin', '.site-footer' );
$hirxpert_styles->hirxpert_border_settings( 'footer-border', '.site-footer' );
$hirxpert_styles->hirxpert_link_color( 'footer-links-color', 'regular', '.site-footer a' );
$hirxpert_styles->hirxpert_link_color( 'footer-links-color', 'hover', '.site-footer a:hover' );
$hirxpert_styles->hirxpert_link_color( 'footer-links-color', 'active', '.site-footer a:active' );

//footer top styles and link color
$hirxpert_styles->hirxpert_typo_settings( 'insta-footer-typography', '.insta-footer-wrap' );
$hirxpert_styles->hirxpert_bg_settings( 'insta-footer-background', '.insta-footer-wrap' );
$hirxpert_styles->hirxpert_padding_settings( 'insta-footer-padding', '.insta-footer-wrap' );
$hirxpert_styles->hirxpert_margin_settings( 'insta-footer-margin', '.insta-footer-wrap' );
$hirxpert_styles->hirxpert_border_settings( 'insta-footer-border', '.insta-footer-wrap' );
$hirxpert_styles->hirxpert_link_color( 'insta-footer-links-color', 'regular', '.insta-footer-wrap a' );
$hirxpert_styles->hirxpert_link_color( 'insta-footer-links-color', 'hover', '.insta-footer-wrap a:hover' );
$hirxpert_styles->hirxpert_link_color( 'insta-footer-links-color', 'active', '.insta-footer-wrap a:active' );

//footer widgets part styles and link color
$hirxpert_styles->hirxpert_typo_settings( 'footer-widgets-typography', '.footer-widgets-wrap' );
$hirxpert_styles->hirxpert_bg_settings( 'footer-widgets-background', '.footer-widgets-wrap' );
$hirxpert_styles->hirxpert_padding_settings( 'footer-widgets-padding', '.footer-widgets-wrap' );
$hirxpert_styles->hirxpert_margin_settings( 'footer-widgets-margin', '.footer-widgets-wrap' );
$hirxpert_styles->hirxpert_border_settings( 'footer-widgets-border', '.footer-widgets-wrap' );
$hirxpert_styles->hirxpert_link_color( 'footer-widgets-links-color', 'regular', '.footer-widgets-wrap a' );
$hirxpert_styles->hirxpert_link_color( 'footer-widgets-links-color', 'hover', '.footer-widgets-wrap a:hover' );
$hirxpert_styles->hirxpert_link_color( 'footer-widgets-links-color', 'active', '.footer-widgets-wrap a:active' );

//footer bottom styles and link color
$hirxpert_styles->hirxpert_typo_settings( 'copyright-section-typography', '.footer-bottom-wrap' );
$hirxpert_styles->hirxpert_bg_settings( 'copyright-section-background', '.footer-bottom-wrap' );
$hirxpert_styles->hirxpert_padding_settings( 'copyright-section-padding', '.footer-bottom-wrap' );
$hirxpert_styles->hirxpert_margin_settings( 'copyright-section-margin', '.footer-bottom-wrap' );
$hirxpert_styles->hirxpert_border_settings( 'copyright-section-border', '.footer-bottom-wrap' );
$hirxpert_styles->hirxpert_link_color( 'copyright-section-links-color', 'regular', '.footer-bottom-wrap a' );
$hirxpert_styles->hirxpert_link_color( 'copyright-section-links-color', 'hover', '.footer-bottom-wrap a:hover' );
$hirxpert_styles->hirxpert_link_color( 'copyright-section-links-color', 'active', '.footer-bottom-wrap a:active' );

//secondary bar styles
if( $primary_color && $secondary_color ){
	echo '.secondary-bar-wrapper { background: linear-gradient(90deg, '. esc_attr( $primary_color ) .' 0%, '. esc_attr( $secondary_color ) .' 100%); }';
	
	
	echo '.page-load-initiate .page-loader:before, .page-load-end .page-loader:before, .page-load-initiate .page-loader:after, .page-load-end .page-loader:after { 
		background: linear-gradient(90deg, '. esc_attr( $primary_color ) .' 0%, '. esc_attr( $secondary_color ) .' 100%);
		background: -webkit-gradient(linear, left top, right top, from('. esc_attr( $secondary_color ) .'), to('. esc_attr( $primary_color ) .'));
		background: -webkit-linear-gradient(left, '. esc_attr( $secondary_color ) .' 0%, '. esc_attr( $primary_color ) .' 100%);
		background: -o-linear-gradient(left, '. esc_attr( $secondary_color ) .' 0%, '. esc_attr( $primary_color ) .' 100%);
		background: linear-gradient(to right, '. esc_attr( $secondary_color ) .' 0%, '. esc_attr( $primary_color ) .' 100%);
	}';
}
$secondary_sidebar_width = $hirxpert_styles->hirxpert_dimension_settings( 'secondary-sidebar-width', 'width' );
if( $secondary_sidebar_width ){
	echo '.secondary-bar-inner {
		width: '. esc_attr( $secondary_sidebar_width ) .';
	}';
	echo '.secondary-bar-wrapper.from-left .secondary-bar-inner {
		left: -'. esc_attr( $secondary_sidebar_width ) .';
	}';
	echo '.secondary-bar-wrapper.from-right .secondary-bar-inner {
		right: -'. esc_attr( $secondary_sidebar_width ) .';
	}';
}

//End style

$styles = ob_get_clean();

$gf_arr = Hirxpert_Theme_Styles::$hirxpert_gf_array;
update_option( 'hirxpert_google_fonts_list', $gf_arr );
update_option( 'hirxpert_custom_styles', wp_slash( $styles ) );