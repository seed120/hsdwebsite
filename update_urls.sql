-- Updated SQL dump with new domain
-- Original file: ena_wordpress_2025-08-15.sql
-- Search and replace performed:
-- Old domain: https://ena.test
-- New domain: https://hiexpert.wasmer.app

-- Update WordPress core URLs
UPDATE wp_options SET option_value = REPLACE(option_value, 'https://ena.test', 'https://hiexpert.wasmer.app') 
WHERE option_name IN ('home', 'siteurl');

-- Update post GUIDs
UPDATE wp_posts SET guid = REPLACE(guid, 'https://ena.test', 'https://hiexpert.wasmer.app');

-- Update post content
UPDATE wp_posts SET post_content = REPLACE(post_content, 'https://ena.test', 'https://hiexpert.wasmer.app');

-- Update post meta values (excluding file paths)
UPDATE wp_postmeta SET meta_value = REPLACE(meta_value, 'https://ena.test', 'https://hiexpert.wasmer.app')
WHERE meta_key NOT LIKE '_wp_attached_file' 
AND meta_value LIKE '%https://ena.test%';

-- Update options table for plugin data
UPDATE wp_options SET option_value = REPLACE(option_value, 'https://ena.test', 'https://hiexpert.wasmer.app')
WHERE option_value LIKE '%https://ena.test%';

-- Update serialized data in options table
UPDATE wp_options 
SET option_value = REPLACE(
    REPLACE(
        option_value,
        CONCAT('s:', LENGTH('https://ena.test'), ':"https://ena.test"'),
        CONCAT('s:', LENGTH('https://hiexpert.wasmer.app'), ':"https://hiexpert.wasmer.app"')
    ),
    'https://ena.test',
    'https://hiexpert.wasmer.app'
)
WHERE option_value LIKE '%s:%:"https://ena.test%';

-- Update serialized data in postmeta table
UPDATE wp_postmeta 
SET meta_value = REPLACE(
    REPLACE(
        meta_value,
        CONCAT('s:', LENGTH('https://ena.test'), ':"https://ena.test"'),
        CONCAT('s:', LENGTH('https://hiexpert.wasmer.app'), ':"https://hiexpert.wasmer.app"')
    ),
    'https://ena.test',
    'https://hiexpert.wasmer.app'
)
WHERE meta_value LIKE '%s:%:"https://ena.test%';

-- Update Elementor data (if using Elementor)
UPDATE wp_postmeta 
SET meta_value = REPLACE(meta_value, 'https://ena.test', 'https://hiexpert.wasmer.app')
WHERE meta_key LIKE '_elementor_%'
AND meta_value LIKE '%https://ena.test%';

-- Update widget data
UPDATE wp_options 
SET option_value = REPLACE(option_value, 'https://ena.test', 'https://hiexpert.wasmer.app')
WHERE option_name LIKE 'widget_%';

-- Update theme mods
UPDATE wp_options 
SET option_value = REPLACE(option_value, 'https://ena.test', 'https://hiexpert.wasmer.app')
WHERE option_name LIKE 'theme_mods_%';

-- Make sure to run FLUSH REWRITE RULES after importing this SQL by visiting the Permalinks settings page in WordPress admin
