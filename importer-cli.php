<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ( ! defined( 'WP_CLI' ) ) {
    return;
}

class Importer_Command extends WP_CLI_Command {
    public function import() {
        // Set PHP settings
        ini_set('max_execution_time', 600);
        ini_set('memory_limit', '256M');
        ini_set('post_max_size', '32M');
        ini_set('upload_max_filesize', '32M');
        ini_set('max_input_vars', 2000);

        // Set the current user
        wp_set_current_user( 1 );

        // Include the necessary files
        require_once( WP_PLUGIN_DIR . '/hirxpert-addon/hirxpert-addon.php' );
        require_once( WP_PLUGIN_DIR . '/hirxpert-addon/admin/extension/demo-importer/class.demo-importer.php' );
        require_once( WP_PLUGIN_DIR . '/hirxpert-addon/admin/extension/demo-importer/zozo-importer.php' );

        $demo_array = array(
            'demo_id' 	=> 'demo',
            'demo_name' => esc_html__( 'Hirxpert Main Demo', 'hirxpert-addon' ),
            'demo_img'	=> 'demo-1.jpg',
            'demo_url'	=> 'https://wordpress.zozothemes.com/hirxpert/',
            'revslider'	=> '1',
            'media_parts'	=> '18',
            'general'	=> array(
                'media' 		=> esc_html__( "Media", "hirxpert" ),
                'theme-options' => esc_html__( "Theme Options", "hirxpert" ),
                'widgets' 		=> esc_html__( "Widgets", "hirxpert" ),
                'revslider' 	=> esc_html__( "Revolution Sliders", "hirxpert" ),
                'post' 			=> esc_html__( "All Posts", "hirxpert" )
            ),
            'pages'=> array(
                '1'		=> esc_html__( "Shop", "hirxpert" ),
                '2'	=> esc_html__( "Cart", "hirxpert" ),
                '3'	=> esc_html__( "Checkout", "hirxpert" ),
                '4'	=> esc_html__( "My account", "hirxpert" ),
                '5'	=> esc_html__( "Refund and Returns Policy", "hirxpert" ),
                '6'	=> esc_html__( "Home-3", "hirxpert" ),
                '7'	=> esc_html__( "Blog", "hirxpert" ),
                '8'	=> esc_html__( "About Us", "hirxpert" ),
                '9'	=> esc_html__( "Our Services", "hirxpert" ),
                '10'	=> esc_html__( "Portfolio", "hirxpert" ),
                '11' 	=> esc_html__( "Testimonial", "hirxpert" ),
                '12'		=> esc_html__( "Team", "hirxpert" ),
                '13' 	=> esc_html__( "Contact Us", "hirxpert" ),
                '14' 	=> esc_html__( "FAQ", "hirxpert" ),
                '15'		=> esc_html__( "Home 2", "hirxpert" ),
                '16' 	=> esc_html__( "Home 5", "hirxpert" ),
                '17'		=> esc_html__( "Home 4", "hirxpert" ),
                '18' 	=> esc_html__( "Home", "hirxpert" ),
                '19' 	=> esc_html__( "Blog 2 Columns", "hirxpert" ),
                '20'	=> esc_html__( "Blog 3 Columns", "hirxpert" ),
                '21'	=> esc_html__( "Blog 4 Columns", "hirxpert" ),
                '22'	=> esc_html__( "Blog Grid + Overlay", "hirxpert" ),
                '23'	=> esc_html__( "2 Columns With Sidebar", "hirxpert" ),
                '24'	=> esc_html__( "Blog List", "hirxpert" ),
                '25'	=> esc_html__( "Service Styles 1", "hirxpert" ),
                '26'	=> esc_html__( "Service Styles 2", "hirxpert" ),
                '27'	=> esc_html__( "Home", "hirxpert" ),
                '28'	=> esc_html__( "Service Styles 3", "hirxpert" ),
                '29'	=> esc_html__( "Portfolio Grid 4", "hirxpert" ),
                '30'	=> esc_html__( "Portfolio Grid 2", "hirxpert" ),
                '31'	=> esc_html__( "Portfolio Grid 3", "hirxpert" ),
                '32'	=> esc_html__( "Home Landing Page", "hirxpert" )
            )
        );

        $_POST['demo_type'] = $demo_array['demo_id'];
        $_POST['revslider'] = $demo_array['revslider'];
        $_POST['media_parts'] = $demo_array['media_parts'];
        $_POST['menu_stat'] = '1';

        WP_CLI::line( 'Downloading general files...' );
        foreach ($demo_array['general'] as $key => $label) {
            WP_CLI::line( "Downloading $label..." );
            $_POST['key'] = $key;
            $_POST['label'] = $label;
            try {
                hirxpertZozoImporterModule::hirxpert_general_file_ajax();
            } catch (Exception $e) {
                WP_CLI::error( $e->getMessage() );
            }
        }

        WP_CLI::line( 'Downloading pages...' );
        foreach ($demo_array['pages'] as $key => $label) {
            WP_CLI::line( "Downloading $label..." );
            $_POST['key'] = $key;
            $_POST['label'] = $label;
            hirxpertZozoImporterModule::hirxpert_xml_file_ajax();
        }

        WP_CLI::line( 'Installing general files...' );
        foreach ($demo_array['general'] as $key => $label) {
            WP_CLI::line( "Installing $label..." );
            $_POST['key'] = $key;
            $_POST['label'] = $label;
            try {
                hirxpertZozoImporterModule::hirxpert_general_file_install_ajax();
            } catch (Exception $e) {
                WP_CLI::error( $e->getMessage() );
            }
        }

        WP_CLI::line( 'Installing pages...' );
        foreach ($demo_array['pages'] as $key => $label) {
            WP_CLI::line( "Installing $label..." );
            $_POST['key'] = $key;
            $_POST['label'] = $label;
            try {
                hirxpertZozoImporterModule::hirxpert_xml_file_install_ajax();
            } catch (Exception $e) {
                WP_CLI::error( $e->getMessage() );
            }
        }

        WP_CLI::line( 'Setting default settings...' );
        hirxpertZozoImporterModule::hirxpert_import_set_default_settings();

        WP_CLI::success( 'Demo data imported successfully.' );
    }
}

WP_CLI::add_command( 'importer', 'Importer_Command' );
