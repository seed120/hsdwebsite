<?php
/**
 * Multilingual support functions for Hirxpert theme
 * Supports both WPML and Polylang
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Check if multilingual plugin is active
 */
function hirxpert_is_multilingual_active() {
    return function_exists( 'pll_current_language' ) || function_exists( 'icl_get_languages' );
}

/**
 * Get current language code
 */
function hirxpert_get_current_language() {
    if ( function_exists( 'pll_current_language' ) ) {
        return pll_current_language();
    } elseif ( function_exists( 'icl_get_languages' ) ) {
        return apply_filters( 'wpml_current_language', NULL );
    }
    return 'en';
}

/**
 * Get available languages
 */
function hirxpert_get_languages() {
    $languages = array();
    
    if ( function_exists( 'pll_the_languages' ) ) {
        $languages = pll_the_languages( array( 'raw' => 1 ) );
    } elseif ( function_exists( 'icl_get_languages' ) ) {
        $languages = icl_get_languages( 'skip_missing=0&orderby=code' );
    }
    
    return $languages;
}

/**
 * Display language switcher
 */
function hirxpert_language_switcher( $args = array() ) {
    if ( ! hirxpert_is_multilingual_active() ) {
        return;
    }
    
    $defaults = array(
        'container_class' => 'hirxpert-language-switcher',
        'item_class' => 'lang-item',
        'active_class' => 'current-lang',
        'show_flags' => true,
        'show_names' => true,
        'dropdown' => false,
    );
    
    $args = wp_parse_args( $args, $defaults );
    
    $languages = hirxpert_get_languages();
    
    if ( empty( $languages ) ) {
        return;
    }
    
    $output = '<div class="' . esc_attr( $args['container_class'] ) . '">';
    
    if ( $args['dropdown'] ) {
        $output .= '<select class="lang-switcher-dropdown" onchange="window.location.href=this.value">';
    }
    
    foreach ( $languages as $lang ) {
        $active = isset( $lang['active'] ) ? $lang['active'] : false;
        $url = isset( $lang['url'] ) ? $lang['url'] : '#';
        $name = isset( $lang['native_name'] ) ? $lang['native_name'] : $lang['name'];
        $code = isset( $lang['language_code'] ) ? $lang['language_code'] : $lang['code'];
        $flag = isset( $lang['country_flag_url'] ) ? $lang['country_flag_url'] : '';
        
        if ( $args['dropdown'] ) {
            $output .= '<option value="' . esc_url( $url ) . '" ' . selected( $active, true, false ) . '>';
            if ( $args['show_flags'] && $flag ) {
                $output .= '🇫🇷 ';
            }
            $output .= esc_html( $name ) . '</option>';
        } else {
            $classes = array( $args['item_class'] );
            if ( $active ) {
                $classes[] = $args['active_class'];
            }
            
            $output .= '<a href="' . esc_url( $url ) . '" class="' . esc_attr( implode( ' ', $classes ) ) . '"';
            $output .= ' hreflang="' . esc_attr( $code ) . '"';
            $output .= '>';
            
            if ( $args['show_flags'] && $flag ) {
                $output .= '<img src="' . esc_url( $flag ) . '" alt="' . esc_attr( $code ) . '" width="18" height="12">';
            }
            
            if ( $args['show_names'] ) {
                $output .= '<span>' . esc_html( $name ) . '</span>';
            }
            
            $output .= '</a>';
        }
    }
    
    if ( $args['dropdown'] ) {
        $output .= '</select>';
    }
    
    $output .= '</div>';
    
    echo $output;
}

/**
 * Add hreflang tags for SEO
 */
function hirxpert_add_hreflang_tags() {
    if ( ! hirxpert_is_multilingual_active() ) {
        return;
    }
    
    $languages = hirxpert_get_languages();
    
    foreach ( $languages as $lang ) {
        $url = isset( $lang['url'] ) ? $lang['url'] : '';
        $code = isset( $lang['language_code'] ) ? $lang['language_code'] : $lang['code'];
        
        if ( $url ) {
            echo '<link rel="alternate" hreflang="' . esc_attr( $code ) . '" href="' . esc_url( $url ) . '">' . "\n";
        }
    }
    
    // Add x-default
    $default_lang = hirxpert_get_current_language();
    echo '<link rel="alternate" hreflang="x-default" href="' . esc_url( home_url() ) . '">' . "\n";
}
add_action( 'wp_head', 'hirxpert_add_hreflang_tags' );

/**
 * Get translated string with fallback
 */
function hirxpert_get_translated_string( $string, $textdomain = 'hirxpert' ) {
    return __( $string, $textdomain );
}

/**
 * Add body class for current language
 */
function hirxpert_add_language_body_class( $classes ) {
    if ( hirxpert_is_multilingual_active() ) {
        $current_lang = hirxpert_get_current_language();
        $classes[] = 'lang-' . $current_lang;
    }
    return $classes;
}
add_filter( 'body_class', 'hirxpert_add_language_body_class' );

/**
 * Register Polylang strings for translation
 */
function hirxpert_register_polylang_strings() {
    if ( ! function_exists( 'pll_register_string' ) ) {
        return;
    }
    
    // Register theme options strings
    $theme_options = get_option( 'hirxpert_options', array() );
    
    $strings_to_register = array(
        'header-phone-text-textarea',
        'header-address',
        'header-email',
        'topbar-custom-text-1',
        'topbar-custom-text-2',
        'logobar-custom-text-1',
        'logobar-custom-text-2',
        'navbar-custom-text-1',
        'navbar-custom-text-2',
        'copyright-text',
        'blog-page-title',
        'blog-page-description',
        'blog-readmore',
    );
    
    foreach ( $strings_to_register as $string_key ) {
        if ( isset( $theme_options[ $string_key ] ) && ! empty( $theme_options[ $string_key ] ) ) {
            pll_register_string(
                $string_key,
                $theme_options[ $string_key ],
                'Hirxpert Theme',
                false
            );
        }
    }
}
add_action( 'init', 'hirxpert_register_polylang_strings' );
