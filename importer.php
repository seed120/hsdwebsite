<?php
require_once('wp-load.php');

wp_set_current_user(1);

update_option('verified_token', '1');

require_once(WP_PLUGIN_DIR . '/hirxpert-addon/hirxpert-addon.php');

$_POST['action'] = 'hirxpert_demo_import';
$_POST['process'] = 'permission';
$_POST['nonce'] = wp_create_nonce('hirxpert_demo_import_*&^^$#(*');

require_once(WP_PLUGIN_DIR . '/hirxpert-addon/admin/extension/demo-importer/class.demo-importer.php');
hirxpert_demo_import_fun();
