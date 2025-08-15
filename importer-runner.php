<?php
require_once('wp-load.php');

$post_data = http_build_query(array(
    'action' => 'hirxpert_demo_import',
    'process' => 'all',
    'demo_type' => 'demo',
    'revslider' => '1',
    'media_parts' => '18',
    'menu_stat' => '1',
    'nonce' => wp_create_nonce('hirxpert_demo_import_*&^^$#(*'),
));

$command = "php wp-cli.phar eval-file importer-cli.php --post='$post_data'";

shell_exec($command);