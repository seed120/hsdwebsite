<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Classic Elementor Addon Modal Popup
 *
 * @since 1.0.0
 */
 
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Classic_Elementor_Addons\Helper\Post_Helper as Cea_Post_Helper;
 
class CEA_Elementor_Video_Playlist_Widget extends Widget_Base {
    
    use Cea_Post_Helper;
        /**
        * Get widget name.
        *
        * Retrieve Modal Popup widget name.
        *
        * @since 1.0.0
        * @access public
        * @return string Widget name.
        */
        public function get_name() {
            return 'ceavideoplaylist';
        }
        /**
         * Get widget title.
         *
         * Retrieve Modal Popup widget title.
         *
         * @since 1.0.0
         * @access public
         *
         * @return string Widget title.
         */
        public function get_title() {
            return __( "Video/Audio Playlist", 'classic-elementor-addons-pro' );
        }
        /**
         * Get widget icon.
         *
         * Retrieve Modal Popup widget icon.
         *
         * @since 1.0.0
         * @access public
         *
         * @return string Widget icon.
         */
        public function get_icon() {
            return "cea-default-icon ti-video-camera";
        }
        /**
         * Get widget categories.
         *
         * Retrieve the list of categories the Modal Popup widget belongs to.
         *
         * @since 1.0.0
         * @access public
         *
         * @return array Widget categories.
         */
        public function get_categories() {
            return [ "classic-elements" ];
        }
        /**
         * Retrieve the list of scripts the counter widget depended on.
         *
         * Used to set scripts dependencies required to run the widget.
         *
         * @since 1.3.0
         * @access public
         *
         * @return array Widget scripts dependencies.
         */
        public function get_script_depends() {
            return [ 'cea-custom-front' ];
        }

        /**
         * Get Keywords
         *
         * Retrieve the list of keywords that used to search for Cea Draw SVG widget
         * 
         * @access public
         * 
         * @return array Widget Keywords
         */
        public function get_keywords(): array {
            return [ 'zozo', 'themes', 'cea', 'playlist', 'video', 'youtube', 'vimeo', 'upload', 'gallery', 'classic' ];
        }


        protected function register_controls(){
            $this->start_controls_section(
                'section_video_playlist',
                [
                    'label' => __( 'Video/Audio Playlist', 'classic-elementor-addons-pro' ),
                ]
            );
            $this->add_control(
              'video_playlist_type',
                [
                    'label' => __( 'Video Playlist Type', 'classic-elementor-addons-pro' ),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'youtube' => __( 'YouTube', 'classic-elementor-addons-pro' ),
                        'vimeo' => __( 'Vimeo', 'classic-elementor-addons-pro' ),
                        'upload' => __( 'Upload', 'classic-elementor-addons-pro' ),
                    ],
                    'default' => 'youtube',
                ]
            );
            $this->add_control(
                'video_upload_option',
                [
                    'label' => __( 'Upload Video/Audio', 'classic-elementor-addons-pro' ),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'video' => __( 'Video', 'classic-elementor-addons-pro' ),
                        'audio' => __( 'Audio', 'classic-elementor-addons-pro' ),
                    ],
                    'default' => 'video',
                    'condition' => [
                        'video_playlist_type' => 'upload',
                    ],
                ]
            );
            $this->add_control(
                'video_playlist_upload_video',
                [
                    'label' => __( 'Upload Video/Audio Playlist', 'classic-elementor-addons-pro' ),
                    'type' => Controls_Manager::REPEATER,
                    'fields' => [
                        [
                            'name' => 'media_url',
                            'label' => __( 'Upload File', 'classic-elementor-addons-pro' ),
                            'type' => Controls_Manager::MEDIA,
                            'media_types' => ['video'],
                            'default' => [
                                'url' => '',
                            ],
                        ],
                        [
                            'name' => 'media_title',
                            'label' => __( 'Title', 'classic-elementor-addons-pro' ),
                            'type' => Controls_Manager::TEXT,
                            'default' => __( 'Media Title', 'classic-elementor-addons-pro' ),
                        ],
                        [
                            'name' => 'media_thumbnail',
                            'label' => __( 'Thumbnail Image', 'classic-elementor-addons-pro' ),
                            'type' => Controls_Manager::MEDIA,
                            'media_types' => ['image'],
                            'default' => [
                                'url' => '',
                            ],
                        ],
                    ],
                    'condition' => [
                        'video_playlist_type' => 'upload',
                        'video_upload_option' => 'video',
                    ],
                    'default' => [
                        [
                            'media_url' => __( '', 'classic-elementor-addons-pro' ),
                            'media_title' => __( 'Media Title', 'classic-elementor-addons-pro' ),
                            'media_thumbnail' => '',
                        ],
                    ]
                ]
            );
            $this->add_control(
                'video_playlist_upload',
                [
                    'label' => __( 'Upload Video/Audio Playlist', 'classic-elementor-addons-pro' ),
                    'type' => Controls_Manager::REPEATER,
                    'fields' => [
                        [
                            'name' => 'media_url',
                            'label' => __( 'Upload File', 'classic-elementor-addons-pro' ),
                            'type' => Controls_Manager::MEDIA,
                            'media_types' => ['video', 'audio'],
                            'default' => [
                                'url' => '',
                            ],
                        ],
                        [
                            'name' => 'media_title',
                            'label' => __( 'Title', 'classic-elementor-addons-pro' ),
                            'type' => Controls_Manager::TEXT,
                            'default' => __( 'Media Title', 'classic-elementor-addons-pro' ),
                        ],
                        [
                            'name'  => 'media_image',
                            'label' => __( 'Image', 'classic-elementor-addons-pro' ),
                            'type'  => Controls_Manager::MEDIA,
                            'media_types' => ['image'],
                            'default' => [
                                'url' => '',
                            ],
                        ]
                    ],
                    'condition' => [
                        'video_playlist_type' => 'upload',
                        'video_upload_option' => 'audio',
                    ],
                    'default' => [
                        [
                            'media_url' => __( '', 'classic-elementor-addons-pro' ),
                            'media_title' => __( 'Media Title', 'classic-elementor-addons-pro' ),
                            'media_image' => __( '', 'classic-elementor-addons-pro' ),
                        ],
                    ]
                ]
            );
            $this->add_control(
                'video_playlist_youtube_type',
                [
                    'label' => __( 'YouTube Video Type', 'classic-elementor-addons-pro' ),
                    'type'  => Controls_Manager::SELECT,
                    'options' => [
                        'channel' => __( 'Channel', 'classic-elementor-addons-pro' ),
                        'playlist' => __( 'Add Links', 'classic-elementor-addons-pro' ),
                    ],
                    'default' => 'channel',
                    'condition' => [
                        'video_playlist_type' => 'youtube',
                    ],
                ]
            );
            $this->add_control(
                'video_playlist_vimeo',
                [
                    'label' => __( 'Vimeo Video URL', 'classic-elementor-addons-pro' ),
                    'type' => Controls_Manager::REPEATER,
                    'fields' => [
                        [
                            'name' => 'video_url',
                            'label' => __( 'Video URL', 'classic-elementor-addons-pro' ),
                            'type' => Controls_Manager::TEXT,
                            'default' => __( '', 'classic-elementor-addons-pro' ),
                        ],
                        [
                            'name' => 'video_title',
                            'label' => __( 'Video Title', 'classic-elementor-addons-pro' ),
                            'type' => Controls_Manager::TEXT,
                            'default' => __( '', 'classic-elementor-addons-pro' ),
                        ],
                    ],
                    'condition' => [
                        'video_playlist_type' => 'vimeo',
                    ],
                ]
            );
            $this->add_control(
                'video_playlist',
                [
                    'label' => __( 'Video Playlist', 'classic-elementor-addons-pro' ),
                    'type' => Controls_Manager::REPEATER,
                    'fields' => [
                        [
                            'name' => 'video_url',
                            'label' => __( 'Video URL', 'classic-elementor-addons-pro' ),
                            'type' => Controls_Manager::TEXT,
                            'default' => __( '', 'classic-elementor-addons-pro' ),
                        ],
                        [
                            'name' => 'video_title',
                            'label' => __( 'Video Title', 'classic-elementor-addons-pro' ),
                            'type' => Controls_Manager::TEXT,
                            'default' => __( '', 'classic-elementor-addons-pro' ),
                        ],
                    ],
                    'default' => [
                        [
                            'video_url' => __( '', 'classic-elementor-addons-pro' ),
                            'video_title' => __( '', 'classic-elementor-addons-pro' ),
                        ],
                    ],
                    'condition' => [
                        'video_playlist_type' => 'youtube',
                        'video_playlist_youtube_type' => 'playlist',
                    ],
                ]
            );
            $this->add_control(
                'youtube_playlist_channel_id',
                [
                    'label' => __( 'YouTube Channel ID', 'classic-elementor-addons-pro' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => __( '', 'classic-elementor-addons-pro' ),
                    'condition' => [
                        'video_playlist_type' => 'youtube',
                        'video_playlist_youtube_type' => 'channel',
                    ],
                ]
            );
            $this->add_control(
                'youtube_api_key',
                [
                    'label' => __( 'YouTube API Key', 'classic-elementor-addons-pro' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => '',
                    'condition' => [
                        'video_playlist_type' => 'youtube',
                        'video_playlist_youtube_type' => 'channel',
                    ],
                ]
            );
            $this->add_control(
                'video_list_items_number',
                [
                    'label' => __( 'Number of Videos', 'classic-elementor-addons-pro' ),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 5,
                    'condition' => [
                        'video_playlist_type' => 'youtube',
                        'video_playlist_youtube_type' => 'channel',
                    ],
                ]
            );
            $this->add_control(
                'video_autoplay',
                [
                    'label' => esc_html__( 'Autoplay', 'classic-elementor-addons-pro' ),
                    'description' => esc_html__( 'Autoplay works when mute is enabled', 'classic-elementor-addons-pro' ),
                    'type' => Controls_Manager::SWITCHER,
                    'separator' => 'before'
                ]
            );
            $this->add_control(
                'video_muted',
                [
                    'label' => esc_html__( 'Mute Video', 'classic-elementor-addons-pro' ),
                    'description' => esc_html__( 'Enable this to make autoplay work', 'classic-elementor-addons-pro' ),
                    'type' => Controls_Manager::SWITCHER,
                ]
            );
            $this->add_control(
		    	'video_controls',
		    	[
		    		'label' => esc_html__( 'Video Controls', 'classic-elementor-addons-pro' ),
		    		'type' => Controls_Manager::SWITCHER,
		    		'label_on' => esc_html__( 'Show', 'classic-elementor-addons-pro' ),
		    		'label_off' => esc_html__( 'Hide', 'classic-elementor-addons-pro' ),
		    		'default' => 'yes',
                    'condition' => [
                        'video_playlist_type!' => 'vimeo',
                    ],
		    	]
		    );
            $this->add_control(
		    	'vimeo_controls',
		    	[
		    		'label' => esc_html__( 'Video Controls', 'classic-elementor-addons-pro' ),
		    		'type' => Controls_Manager::SWITCHER,
		    		'label_on' => esc_html__( 'Show', 'classic-elementor-addons-pro' ),
		    		'label_off' => esc_html__( 'Hide', 'classic-elementor-addons-pro' ),
		    		'default' => 'yes',
                    'condition' => [
                        'video_playlist_type' => 'vimeo',
                    ],
		    	]
		    );
            $this->add_control(
                'youtube_channel_layout',
                [
                    'label'     => __( 'Youtube Playlist Layout', 'classic-elementor-addons-pro' ),
                    'type'      => 'dragdrop',
                    'ddvalues'  => [
                        'enabled'   =>  [
                            'video-title'   =>  __( 'Video Title', 'classic-elementor-addons-pro' ),
                            'channel'       =>  __( 'Channel', 'classic-elementor-addons-pro' ),
                        ],
                        'disabled'  =>  [
                            'views'         =>  __( 'Views', 'classic-elementor-addons-pro' ),
                        ]
                    ],
                    'separator'     =>  'before',
                    'condition' => [
                        'video_playlist_type' => 'youtube',
                        'video_playlist_youtube_type' => 'channel',
                    ],
                ]
            );
            $this->add_control(
                'playlist_align',
                [
                    'label'     =>  __( 'Playlist Align', 'classic-elementor-addons-pro' ),
                    'type'      =>  Controls_Manager::SELECT,
                    'options'   =>  [
                        'before'    =>  __( 'Left', 'classic-elementor-addons-pro' ),
                        'after'    =>  __( 'Right', 'classic-elementor-addons-pro' )
                    ],
                    'default'   => 'after',
                    'separator'     =>  'before',
                ]
            );
            $this->end_controls_section();

            // Style Tab 
            $this->start_controls_section(
                'general_styles',
                [
                    'label'     =>  __( 'General', 'classic-elementor-addons-pro' ),
                    'tab'       => Controls_Manager::TAB_STYLE,
                ]
            );
            $this->add_responsive_control(
                'video_wrap_margin', 
                [
                    'label'      => esc_html__( 'Margin', 'classic-elementor-addons-pro' ),
				    'type'       => Controls_Manager::DIMENSIONS,
				    'size_units' => [ 'px', '%', 'em', 'rem' ],
				    'selectors'  => [
					    '{{WRAPPER}} .cea-video-audio-widget' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				    ],
                ]
            );
            $this->add_responsive_control(
                'video_wrap_padding', 
                [
                    'label'      => esc_html__( 'Padding', 'classic-elementor-addons-pro' ),
				    'type'       => Controls_Manager::DIMENSIONS,
				    'size_units' => [ 'px', '%', 'em', 'rem' ],
				    'selectors'  => [
					    '{{WRAPPER}} .cea-video-audio-widget' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				    ],
                    'separator' => 'after'
                ]
            );
            $this->add_responsive_control(
                'video_wrap_height',
                [
                    'label'     => __( 'Height', 'classic-elementor-addons-pro' ),
                    'type'      => Controls_Manager::SLIDER,
                    'size_units'    =>  [ 'px', '%', 'rem', 'em' ],
                    'range'     => [
                        'px'   => [
                            'min'   => 0,
                            'max'   => 1000,
                        ],
                        '%'   => [
                            'min'   => 0,
                            'max'   => 100,
                        ],
                        'rem'   => [
                            'min'   => 0,
                            'max'   => 250,
                        ],
                        'em'   => [
                            'min'   => 0,
                            'max'   => 250,
                        ],
                    ],
                    'default'   => [
                        'size' => 400,
                        'unit' => 'px'
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .cea-youtube-playlist-wrapper' =>  'height: {{SIZE}}{{UNIT}}',
                        '{{WRAPPER}} .cea-vimeo-playlist-wrapper' =>  'height: {{SIZE}}{{UNIT}}',
                        '{{WRAPPER}} .cea-video-playlist-container' =>  'height: {{SIZE}}{{UNIT}}',
                    ]
                ]
            );
            $this->add_responsive_control(
                'video_wrap_gap',
                [
                    'label'     => __( 'Gap', 'classic-elementor-addons-pro' ),
                    'type'      => Controls_Manager::SLIDER,
                    'size_units'    =>  [ 'px', '%', 'rem', 'em' ],
                    'range'     => [
                        'px'   => [
                            'min'   => 0,
                            'max'   => 200,
                        ],
                        '%'   => [
                            'min'   => 0,
                            'max'   => 100,
                        ],
                        'rem'   => [
                            'min'   => 0,
                            'max'   => 50,
                        ],
                        'em'   => [
                            'min'   => 0,
                            'max'   => 50,
                        ],
                    ],
                    'default'   => [
                        'size' => 20,
                        'unit' => 'px'
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .cea-youtube-playlist-wrapper' =>  'gap: {{SIZE}}{{UNIT}}',
                        '{{WRAPPER}} .cea-vimeo-playlist-wrapper' =>  'gap: {{SIZE}}{{UNIT}}',
                        '{{WRAPPER}} .cea-video-playlist-container' =>  'gap: {{SIZE}}{{UNIT}}',
                    ],
                    'separator' => 'after'
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name'     => 'video_wrap_border',
                    'label'    => esc_html__( 'Border', 'classic-elementor-addons-pro' ),
                    'selector' => '{{WRAPPER}} .cea-video-audio-widget',
                ]
            );
            $this->add_responsive_control(
                'video_wrap_radius',
                [
                    'label'      => esc_html__( 'Border Radius', 'classic-elementor-addons-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem' ],
                    'selectors'  => [
                        '{{WRAPPER}} .cea-video-audio-widget' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->end_controls_section();
            $this->start_controls_section(
                'playlist_styles',
                [
                    'label'     =>  esc_html__( 'Playlist Styles', 'classic-elementor-addons-pro' ),
                    'tab'       =>  Controls_Manager::TAB_STYLE,
                ]
            );
            $this->add_responsive_control(
                'video_playlist_gap',
                [
                    'label'     => __( 'Gap', 'classic-elementor-addons-pro' ),
                    'type'      => Controls_Manager::SLIDER,
                    'size_units'    =>  [ 'px', '%', 'rem', 'em' ],
                    'range'     => [
                        'px'   => [
                            'min'   => 0,
                            'max'   => 50,
                        ],
                        '%'   => [
                            'min'   => 0,
                            'max'   => 100,
                        ],
                        'rem'   => [
                            'min'   => 0,
                            'max'   => 20,
                        ],
                        'em'   => [
                            'min'   => 0,
                            'max'   => 20,
                        ],
                    ],
                    'default'   => [
                        'size' => 5,
                        'unit' => 'px'
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .cea-video-playlist .cea-video-item' =>  'margin-bottom: {{SIZE}}{{UNIT}}',
                        '{{WRAPPER}} .cea-video-playlist .cea-vimeo-item' =>  'margin-bottom: {{SIZE}}{{UNIT}}',
                    ],
                    'separator' => 'after'
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'playlist_title_typography',
                    'selector' => '{{WRAPPER}} .youtube-title strong, {{WRAPPER}} .vimeo-title strong, {{WRAPPER}} .video-title strong, {{WRAPPER}} .cea-video-playlist-item',
                    'separator' => 'before',
                ]
            );
            $this->start_controls_tabs(
                'video_playlist_color',
            );
            $this->start_controls_tab(
                'video_title_color',
                [
                    'label'     =>      __( 'Normal', 'classic-elementor-addons-pro' ),
                ]
            );
            $this->add_control(
                'video_play_title_color',
                [
                    'label'     =>      __( 'Color', 'classic-elementor-addons-pro' ),
                    'type'      =>      Controls_Manager::COLOR,
                    'selectors' =>      [
                        '{{WRAPPER}} .cea-video-item .youtube-title strong'     =>      'color: {{VALUE}};',
                        '{{WRAPPER}} .cea-vimeo-item .vimeo-title strong'     =>      'color: {{VALUE}};',
                        '{{WRAPPER}} .cea-video-playlist-item'     =>      'color: {{VALUE}};',
                    ]
                ]
            );
            $this->end_controls_tab();
            $this->start_controls_tab(
                'video_title_hover',
                [
                    'label'     =>      __( 'Hover', 'classic-elementor-addons-pro' ),
                ]
            );
            $this->add_control(
                'video_play_title_hover',
                [
                    'label'     =>      __( 'Color', 'classic-elementor-addons-pro' ),
                    'type'      =>      Controls_Manager::COLOR,
                    'selectors' =>      [
                        '{{WRAPPER}} .cea-video-item:hover .youtube-title strong'     =>      'color: {{VALUE}};',
                        '{{WRAPPER}} .cea-vimeo-item:hover .vimeo-title:hover strong'     =>      'color: {{VALUE}};',
                        '{{WRAPPER}} .cea-video-playlist-item:hover'     =>      'color: {{VALUE}};',
                    ]
                ]
            );
            $this->end_controls_tab();
            $this->start_controls_tab(
                'video_title_active',
                [
                    'label'     =>      __( 'Active', 'classic-elementor-addons-pro' ),
                ]
            );
            $this->add_control(
                'video_play_title_active',
                [
                    'label'     =>      __( 'Color', 'classic-elementor-addons-pro' ),
                    'type'      =>      Controls_Manager::COLOR,
                    'selectors' =>      [
                        '{{WRAPPER}} .cea-video-item.active .youtube-title strong'     =>      'color: {{VALUE}};',
                        '{{WRAPPER}} .cea-vimeo-item.active .vimeo-title strong'     =>      'color: {{VALUE}};',
                        '{{WRAPPER}} .cea-video-playlist-item.active'     =>      'color: {{VALUE}};',
                    ]
                ]
            );
            $this->end_controls_tab();
            $this->end_controls_tabs();
            $this->end_controls_section();
        }
    
        protected function render() {
            $settings = $this->get_settings_for_display();
            $video_playlist_type = $settings['video_playlist_type'];
            $video_playlist_youtube_type = $settings['video_playlist_youtube_type'];
            $video_playlist = $settings['video_playlist'];
            $video_upload_option = $settings['video_upload_option'];
            $upload_audio_playlist = $settings['video_playlist_upload'];
            $upload_video_playlist = $settings['video_playlist_upload_video'];
            $autoplay = isset( $settings['video_autoplay'] ) && $settings['video_autoplay'] == 'yes' ? 1 : 0;
            $muted = isset( $settings['video_muted'] ) && $settings['video_muted'] == 'yes' ? 1 : 0;
            $controls = isset( $settings['video_controls'] ) && $settings['video_controls'] == 'yes' ? 1 : 0;
            $background = isset( $settings['vimeo_controls'] ) && $settings['vimeo_controls'] == 'yes' ? 0 : 1;
            $playlist_align = isset( $settings['playlist_align'] ) ? $settings['playlist_align'] : '';
            echo '<div class="cea-video-audio-widget" data-autoplay="'. $autoplay .'" data-muted="'. $muted .'" data-controls="'. $controls .'" data-background="'. $background .'">';
            if ($video_playlist_type === 'upload') {
                if ($video_upload_option === 'audio') {
                    $first = $upload_audio_playlist[0];
                    $first_url = esc_url($first['media_url']['url']);
                    $first_title = !empty($first['media_title']) ? esc_html($first['media_title']) : basename(parse_url($first_url, PHP_URL_PATH));
                    $first_image = !empty($first['media_image']['url']) ? esc_url($first['media_image']['url']) : '';
                    $is_audio = strpos($first_url, '.mp3') !== false || strpos($first_url, '.ogg') !== false;
                    if ($is_audio) {
                        echo '<div class="cea-playlist-style-audio">';
                        echo '<div class="cea-audio-main-player" style="'.( $playlist_align == 'before' ? 'order: 2;' : 'order:1;' ).'">';
                        echo '<img id="cea-audio-thumbnail" src="'. $first_image .'" alt="'. $first_title .'">';
                        echo '<h3 id="cea-audio-title">' . $first_title . '</h3>';
                        echo '<audio id="cea-audio-player" '. ($controls == 1 ? 'controls ' : '') .' '. ($autoplay == 1 ? 'autoplay ' : '').' '. ($muted == 1 ? 'muted' : ''). ' src="'. $first_url .'"></audio>';
                        echo '</div>';                
                        echo '<div class="cea-audio-playlist" style="'.( $playlist_align == 'before' ? 'order: 1;' : 'order:2;' ).'">';
                        echo '<ul class="cea-video-list">';
                
                        foreach ($upload_audio_playlist as $index => $media) {
                            $media_url = esc_url($media['media_url']['url']);
                            $media_title = !empty($media['media_title']) ? esc_html($media['media_title']) : basename(parse_url($media_url, PHP_URL_PATH));
                            $media_image = !empty($media['media_image']['url']) ? esc_url($media['media_image']['url']) : '';
                            echo '<li class="cea-audio-item">';
                            echo '<img src="'. $media_image .'" alt="'. $media_title .'">';
                            echo '<a href="#" class="cea-upload-playlist-item'. ($index === 0 ? ' active' : '') .'" data-media-url="'. $media_url .'" data-title="'. $media_title .'" data-image="'. $media_image .'">'. $media_title .'</a>';
                            echo '</li>';
                        }
                
                        echo '</ul>';
                        echo '</div>';
                        echo '</div>';
                    }
                } elseif ($video_upload_option === 'video') {
                    $first = $upload_video_playlist[0];
                    $first_url = esc_url($first['media_url']['url']);
                    $first_title = !empty($first['media_title']) ? esc_html($first['media_title']) : basename(parse_url($first_url, PHP_URL_PATH));
                    $is_video = strpos($first_url, '.mp4') !== false || strpos($first_url, '.webm') !== false;

                    if ($is_video) {
                        echo '<h3 id="cea-video-title">' . $first_title . '</h3>';
                        echo '<div class="cea-video-playlist-container">';
                        
                        echo '<div class="cea-video-main-player" style="'. ( $playlist_align == 'before' ? 'order: 2;' : 'order: 1;' ) .'">';
                        echo '<video id="cea-video-player" '. ($controls == 1 ? 'controls ' : '') .' '. ($autoplay == 1 ? 'autoplay' : '') .' src="'. $first_url .'"></video>';
                        echo '</div>';
                        echo '<div class="cea-video-playlist" style="'. ( $playlist_align == 'before' ? 'order: 1;' : 'order: 2;' ) .'">';
                        echo '<ul class="cea-video-list">';
                        foreach ($upload_video_playlist as $index => $media) {
                            $media_url = esc_url($media['media_url']['url']);
                            $media_title = !empty($media['media_title']) ? esc_html($media['media_title']) : basename(parse_url($media_url, PHP_URL_PATH));
                            $media_thumb = !empty($media['media_thumbnail']['url']) ? esc_url($media['media_thumbnail']['url']) : '';
                        
                            echo '<li class="cea-video-item">';
                            if ($media_thumb) {
                                echo '<img src="' . $media_thumb . '" alt="' . esc_attr($media_title) . '">';
                            }
                            echo '<a href="#" class="cea-video-playlist-item'. ($index === 0 ? ' active' : '') .'" data-media-url="'. $media_url .'" data-title="'. $media_title .'">'. $media_title .'</a>';
                            echo '</li>';
                        }
                        
                        echo '</ul>';
                        echo '</div>';
                        echo '</div>';
                        ?>
                        <?php
                    }
                }
            }
            
            //Youtube video adding links
            if (!empty($video_playlist) && $video_playlist_type === 'youtube' && $video_playlist_youtube_type === 'playlist') :
                $video_data = [];
                foreach ($video_playlist as $item) {
                    $video_id = $this->get_youtube_video_id($item['video_url']);
                    $video_data[] = [
                        'id' => $video_id,
                        'title' => $item['video_title']
                    ];
                }
                
                if (!empty($video_data)) :
                    $first_video = $video_data[0];
                    ?>
                        <div class="cea-youtube-playlist-wrapper">
                            <div class="cea-main-player" style="<?php echo ( $playlist_align == 'before' ? 'order: 2;' : 'order:1;' ); ?>">
                                <iframe id="cea-video-frame" width="100%" height="100%" src="https://www.youtube.com/embed/<?php echo esc_attr($first_video['id']); ?>?autoplay=<?php echo esc_attr( $autoplay ); ?>&mute=<?php echo esc_attr( $muted ); ?>&controls=<?php echo esc_attr( $controls ); ?>" frameborder="0" allowfullscreen></iframe>
                            </div>
                            <div class="cea-video-playlist" style="<?php echo( $playlist_align == 'before' ? 'order: 1;' : 'order: 2;' ); ?>">
                                <ul class="cea-video-list">
                                    <?php foreach ($video_data as $index => $video): ?>
                                        <li class="cea-video-item <?php echo $index === 0 ? 'active' : ''; ?>" data-video-id="<?php echo esc_attr($video['id']); ?>">
                                            <img src="https://img.youtube.com/vi/<?php echo esc_attr($video['id']); ?>/0.jpg" alt="<?php echo esc_attr($video['title']); ?>"/>
                                            <div class="youtube-title">
                                                <strong><?php echo esc_html($video['title']); ?></strong>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                        <?php
                    else :
                        echo '<p>' . esc_html__('No videos found in the playlist.', 'classic-elementor-addons-pro') . '</p>';
                endif;
            endif;

            //Vimeo video adding links
            $first_vimeo_video = !empty($settings['video_playlist_vimeo'][0]) ? $settings['video_playlist_vimeo'][0] : null;
            if ( $first_vimeo_video && $video_playlist_type === 'vimeo' ):
                 ?>
                    <div class="cea-vimeo-playlist-wrapper">
                        <div class="cea-main-player" style="<?php echo ( $playlist_align == 'before' ? 'order: 2;' : 'order:1;' ); ?>">
                            <iframe id="cea-vimeo-frame" width="100%" height="100%" src="<?php echo esc_url( $this->get_embed_vimeo_url($first_vimeo_video['video_url']) ); ?>?autoplay=<?php echo esc_attr( $autoplay ); ?>&mute=<?php echo esc_attr( $muted ); ?>&background=<?php echo esc_attr( $background ); ?>" frameborder="0" allowfullscreen></iframe>
                        </div>
                        <div class="cea-video-playlist" style="<?php echo ( $playlist_align == 'before' ? 'order: 1;' : 'order: 2;' ); ?>">
                            <ul class="cea-video-list">
                                <?php foreach ( $settings['video_playlist_vimeo'] as $index => $video ): ?>
                                    <?php
                                    $embed_url = $this->get_embed_vimeo_url( $video['video_url'] );
                                    $thumb_url = $this->get_vimeo_thumbnail_url( $video['video_url'] );
                                    ?>
                                    <li class="cea-vimeo-item <?php echo $index === 0 ? 'active' : ''; ?>" data-vimeo-url="<?php echo esc_url( $embed_url ); ?>">
                                        <?php if ( $thumb_url ): ?>
                                            <img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php echo esc_attr( $video['video_title'] ); ?>">
                                        <?php endif; ?>
                                        <div class="vimeo-title">
                                            <strong><?php echo esc_html( $video['video_title'] ); ?></strong>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                <?php 
            endif;
            // YouTube Channel ID and API Key
            if( $video_playlist_type === 'youtube' && $video_playlist_youtube_type === 'channel' && !empty($settings['youtube_playlist_channel_id']) && !empty($settings['youtube_api_key'])) {
                $settings = $this->get_settings_for_display();
                $channel_id = $settings['youtube_playlist_channel_id'];
                $api_key = $settings['youtube_api_key'];
                $limit = !empty($settings['video_list_items_number']) ? $settings['video_list_items_number'] : 5;
                $youtube_layout = isset( $settings['youtube_channel_layout'] ) && !empty( $settings['youtube_channel_layout'] ) ? json_decode( $settings['youtube_channel_layout'], true ) : array( 'enabled' => '' );
                if (empty($channel_id) || empty($api_key)) {
                    echo '<p>' . esc_html__('YouTube Channel ID or API Key is missing.', 'classic-elementor-addons-pro') . '</p>';
                    return;
                }
            
                $upload_playlist_id = $this->get_upload_playlist_id($channel_id, $api_key);
                if (!$upload_playlist_id) {
                    echo '<p>' . esc_html__('Unable to retrieve uploads playlist from YouTube.', 'classic-elementor-addons-pro') . '</p>';
                    return;
                }
            
                $videos = $this->get_channel_videos($upload_playlist_id, $api_key, $limit);
                if (empty($videos)) {
                    echo '<p>' . esc_html__('No videos found in the channel.', 'classic-elementor-addons-pro') . '</p>';
                    return;
                }
                function cea_get_youtube_video_details($video_id, $api_key) {
                    $api_url = "https://www.googleapis.com/youtube/v3/videos?part=snippet,statistics&id={$video_id}&key={$api_key}";
                    $response = wp_remote_get($api_url);

                    if (is_wp_error($response)) return null;

                    $body = wp_remote_retrieve_body($response);
                    $data = json_decode($body, true);

                    if (!empty($data['items'][0])) {
                        $item = $data['items'][0];
                        return [
                            'channel' => $item['snippet']['channelTitle'],
                            'views' => number_format($item['statistics']['viewCount']),
                            'published_at' => $item['snippet']['publishedAt'],
                        ];
                    }

                    return null;
                }

                function cea_time_ago($datetime) {
                    $timestamp = strtotime($datetime);
                    $diff = time() - $timestamp;
                
                    $units = [
                        31536000 => 'year',
                        2592000 => 'month',
                        604800 => 'week',
                        86400 => 'day',
                        3600 => 'hour',
                        60 => 'minute',
                        1 => 'second'
                    ];
                
                    foreach ($units as $secs => $unit) {
                        $quot = floor($diff / $secs);
                        if ($quot >= 1) {
                            return $quot . ' ' . $unit . ($quot > 1 ? 's' : '') . ' ago';
                        }
                    }
                    return 'just now';
                }

                $first_video = $videos[0];
                ?>
                <div class="cea-youtube-playlist-wrapper">
                    <div class="cea-main-player" style="<?php echo ( $playlist_align == 'before' ? 'order: 2;' : 'order:1;' ); ?>">
                        <iframe id="cea-video-frame" width="100%" height="100%" src="https://www.youtube.com/embed/<?php echo esc_attr($first_video['id']); ?>?autoplay=<?php echo esc_attr( $autoplay ); ?>&mute=<?php echo esc_attr( $muted ); ?>&controls=<?php echo esc_attr( $controls ); ?>" frameborder="0" allowfullscreen></iframe>
                    </div>
                    <div class="cea-video-playlist" style="<?php echo ( $playlist_align == 'before' ? 'order: 1;' : 'order:2;' ); ?>">
                        <ul class="cea-video-list">
                            <?php foreach ($videos as $index => $video): 
                                $details = cea_get_youtube_video_details($video['id'], $api_key);
                                $channel = $details['channel'];
                                $views = $details['views'];
                                $published = cea_time_ago($details['published_at']);?>
                                <li class="cea-video-item d-flex <?php echo $index === 0 ? 'active' : ''; ?>" data-video-id="<?php echo esc_attr($video['id']); ?>">
                                <img src="https://img.youtube.com/vi/<?php echo esc_attr($video['id']); ?>/0.jpg" alt="<?php echo esc_attr($video['title']); ?>"/>
                                <div class="youtube-title">
                                    <?php 
                                    foreach( $youtube_layout['enabled'] as $keys => $items ) {
                                        switch( $keys ) {
                                            case 'video-title':
                                                ?>
                                                <strong><?php echo esc_html($video['title']); ?></strong><br>
                                                <?php
                                            break;
                                            case 'channel':
                                                ?>
                                                <small><?php echo esc_html($channel); ?></small><br>
                                                <?php
                                            break;
                                            case 'views':
                                                ?>
                                                <small><?php echo esc_html($views); ?> views • <?php echo esc_html($published); ?></small>
                                                <?php
                                                break;
                                        }
                                    }
                                    ?>
                                </div>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
	            </div><!--.cea-video-audio-widget-->
                <?php
            }
        }
        private function get_upload_playlist_id($channel_id, $api_key) {
            $url = "https://www.googleapis.com/youtube/v3/channels?part=contentDetails&id={$channel_id}&key={$api_key}";
            $response = wp_remote_get($url);
        
            if (is_wp_error($response)) return false;
        
            $data = json_decode(wp_remote_retrieve_body($response), true);
            return $data['items'][0]['contentDetails']['relatedPlaylists']['uploads'] ?? false;
        }
        
        private function get_channel_videos($playlist_id, $api_key, $max_results = 5) {
            $url = "https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&playlistId={$playlist_id}&maxResults={$max_results}&key={$api_key}";
            $response = wp_remote_get($url);
        
            if (is_wp_error($response)) return [];
        
            $data = json_decode(wp_remote_retrieve_body($response), true);
        
            $videos = [];
            foreach ($data['items'] as $item) {
                $videos[] = [
                    'id' => $item['snippet']['resourceId']['videoId'],
                    'title' => $item['snippet']['title'],
                ];
            }
        
            return $videos;
        }
        private function get_embed_youtube_url($url) {
            if (strpos($url, 'watch?v=') !== false) {
                $parts = parse_url($url);
                parse_str($parts['query'], $query);
                if (!empty($query['v'])) {
                    return 'https://www.youtube.com/embed/' . $query['v'];
                }
            }
            if (strpos($url, 'youtu.be/') !== false) {
                $id = substr($url, strrpos($url, '/') + 1);
                return 'https://www.youtube.com/embed/' . $id;
            }
            return $url;
        }
        
        private function get_embed_vimeo_url($url) {
            if (strpos($url, 'vimeo.com/') !== false) {
                $id = substr($url, strrpos($url, '/') + 1);
                return 'https://player.vimeo.com/video/' . $id;
            }
        
            return $url;
        }
        public function get_youtube_video_id($url) {
            preg_match('/(?:youtube\.com.*(?:\?|&)v=|youtu\.be\/)([^&]+)/', $url, $matches);
            return $matches[1] ?? '';
        }
        private function get_vimeo_thumbnail_url( $video_url ) {
            $response = wp_remote_get( "https://vimeo.com/api/oembed.json?url=" . urlencode( $video_url ) );
            if ( is_wp_error( $response ) ) {
                return '';
            }
            $body = wp_remote_retrieve_body( $response );
            $data = json_decode( $body, true );
        
            return isset( $data['thumbnail_url'] ) ? $data['thumbnail_url'] : '';
        }
    }