# Multilingual System Setup Guide (FR/EN)

This guide will help you set up a complete multilingual system for the Hirxpert theme supporting French and English languages.

## Overview
The multilingual system has been implemented with the following components:
- ✅ French translation files created
- ✅ Multilingual functions added
- ✅ Language switcher template created
- ✅ CSS styles for language switcher
- ✅ WPML/Polylang compatibility

## Installation Steps

### Step 1: Install Multilingual Plugin

#### Option A: WPML (Premium)
```bash
# Install via WordPress Admin
1. Go to Plugins → Add New
2. Search for "WPML"
3. Install WPML Core plugin
4. Install WPML String Translation
5. Install WPML Translation Management
```

#### Option B: Polylang (Free)
```bash
# Install via WordPress Admin
1. Go to Plugins → Add New
2. Search for "Polylang"
3. Install and activate Polylang
```

### Step 2: Configure Languages

#### For WPML:
1. Go to WPML → Languages
2. Add French (fr_FR) and English (en_US)
3. Configure URL format: `/fr/` and `/en/`
4. Set up language switcher

#### For Polylang:
1. Go to Languages → Languages
2. Add French (fr_FR) and English (en_US)
3. Configure URL format: `/fr/` and `/en/`

### Step 3: Activate Translation Files

The French translation files are ready:
- `wp-content/themes/hirxpert/languages/fr_FR-clean.po`
- Rename `fr_FR-clean.po` to `fr_FR.po`
- The system will automatically generate `fr_FR.mo`

### Step 4: Add Language Switcher

#### Method 1: Using Template Tag
Add this code to your header.php or any template file:
```php
<?php hirxpert_language_switcher(); ?>
```

#### Method 2: Using Widget
The language switcher is available as a template part:
```php
<?php get_template_part('template-parts/language-switcher'); ?>
```

#### Method 3: Using Shortcode
Add this shortcode to any post/page:
```
[hirxpert_language_switcher]
```

### Step 5: Translate Content

#### Translate Theme Options
1. Go to Appearance → Customize
2. Translate all text fields using WPML/Polylang string translation

#### Translate Posts/Pages
1. Create content in English
2. Create French translations
3. Link translations together

### Step 6: Configure SEO

#### Add hreflang tags (automatic)
The system automatically adds hreflang tags for SEO:
```html
<link rel="alternate" hreflang="en" href="https://yoursite.com/en/page">
<link rel="alternate" hreflang="fr" href="https://yoursite.com/fr/page">
<link rel="alternate" hreflang="x-default" href="https://yoursite.com/page">
```

## File Structure

```
wp-content/themes/hirxpert/
├── languages/
│   ├── hirxpert.pot (original template)
│   ├── fr_FR-clean.po (French translations)
│   └── fr_FR.mo (compiled - will be generated)
├── inc/
│   └── multilingual-functions.php (multilingual functions)
├── template-parts/
│   └── language-switcher.php (language switcher template)
├── assets/
│   └── css/
│       └── multilingual.css (language switcher styles)
└── MULTILINGUAL-SETUP.md (this guide)
```

## Usage Examples

### Display Language Switcher in Header
```php
// In header.php or appropriate template
<div class="header-language-switcher">
    <?php hirxpert_language_switcher(); ?>
</div>
```

### Check Current Language
```php
$current_lang = hirxpert_get_current_language();
if ($current_lang === 'fr') {
    // French specific content
}
```

### Get Available Languages
```php
$languages = hirxpert_get_languages();
foreach ($languages as $lang) {
    echo $lang['name'] . ' - ' . $lang['url'];
}
```

## Customization

### Language Switcher Styles
Edit `assets/css/multilingual.css` to customize appearance.

### Adding New Languages
1. Create new .po file (e.g., `es_ES.po` for Spanish)
2. Add language to WPML/Polylang settings
3. Update translation strings

### RTL Support
The system includes RTL support for Arabic/Hebrew:
```css
body.rtl .hirxpert-language-switcher {
    flex-direction: row-reverse;
}
```

## Troubleshooting

### Language Switcher Not Showing
1. Ensure WPML/Polylang is installed and activated
2. Check if languages are properly configured
3. Verify file permissions for language files

### Translation Not Working
1. Check if .po/.mo files are in correct location
2. Ensure textdomain 'hirxpert' is used consistently
3. Regenerate .mo files if needed

### CSS Issues
1. Clear browser cache
2. Check if multilingual.css is properly enqueued
3. Verify CSS specificity

## Support

For additional support:
1. Check WPML/Polylang documentation
2. Review theme documentation
3. Contact theme support if needed

## Next Steps

1. Install and configure your chosen multilingual plugin
2. Set up languages in WordPress admin
3. Begin translating content
4. Test language switching functionality
5. Configure SEO settings
6. Test on mobile devices
