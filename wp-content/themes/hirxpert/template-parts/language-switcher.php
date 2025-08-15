<?php
/**
 * Language switcher template for multilingual support
 * Supports both WPML and Polylang
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( ! hirxpert_is_multilingual_active() ) {
    return;
}

$languages = hirxpert_get_languages();
if ( empty( $languages ) ) {
    return;
}
?>

<div class="hirxpert-language-switcher-wrapper">
    <div class="hirxpert-language-switcher">
        <?php foreach ( $languages as $lang ) : ?>
            <?php
            $active = isset( $lang['active'] ) ? $lang['active'] : false;
            $url = isset( $lang['url'] ) ? $lang['url'] : '#';
            $name = isset( $lang['native_name'] ) ? $lang['native_name'] : $lang['name'];
            $code = isset( $lang['language_code'] ) ? $lang['language_code'] : $lang['code'];
            $flag = isset( $lang['country_flag_url'] ) ? $lang['country_flag_url'] : '';
            ?>
            
            <a href="<?php echo esc_url( $url ); ?>" 
               class="lang-item <?php echo $active ? 'current-lang' : ''; ?>" 
               hreflang="<?php echo esc_attr( $code ); ?>"
               title="<?php echo esc_attr( $name ); ?>">
                
                <?php if ( $flag ) : ?>
                    <img src="<?php echo esc_url( $flag ); ?>" 
                         alt="<?php echo esc_attr( $code ); ?>" 
                         width="18" height="12">
                <?php else : ?>
                    <span class="lang-flag lang-flag-<?php echo esc_attr( $code ); ?>">
                        <?php echo strtoupper( substr( $code, 0, 2 ) ); ?>
                    </span>
                <?php endif; ?>
                
                <span class="lang-name"><?php echo esc_html( $name ); ?></span>
            </a>
        <?php endforeach; ?>
    </div>
</div>
