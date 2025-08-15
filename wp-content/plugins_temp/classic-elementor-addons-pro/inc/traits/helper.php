<?php

namespace Classic_Elementor_Addons\Helper;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

trait Post_Helper
{
    /**
     * Get all types of post.
     * @return array
     */
    public static function get_post_types(){
        $post_types = get_post_types( ['public' => true, 'show_in_nav_menus' => true], 'objects' );
        $post_types = wp_list_pluck( $post_types, 'label', 'name' );

        return array_diff_key( $post_types, ['elementor_library', 'attachment'] );
    } 
	
    public static function cea_get_post_titles( $post_type = 'post' ){
        $posts = get_posts([
            'post_type' => $post_type,
            'post_status' => 'publish',
            'posts_per_page' => '-1',
        ]);

        if (!empty($posts)) {
            return wp_list_pluck( $posts, 'post_title', 'ID' );
        }

        return [];
    }
	
	public static function cea_get_tags(){		
		$tags = get_tags();
		
		if( !empty( $tags ) ) {
			return wp_list_pluck( $tags, 'name', 'term_id' );
		}
		
		return [];
	}
	
	public static function cea_get_categories(){		
		$categories = get_categories();
		
		if( !empty( $categories ) ) {
			return wp_list_pluck( $categories, 'name', 'term_id' );
		}
		
		return [];
	}
	
	public static function cea_get_authors(){
        $users = get_users([
            //'who' => 'authors',
            'has_published_posts' => true,
            'fields' => [
                'ID',
                'display_name',
            ],
        ]);

        if( !empty( $users ) ) {
            return wp_list_pluck( $users, 'display_name', 'ID' );
        }

        return [];
    }
	
	public static function cea_get_post_orderby_options(){
        $orderby = [
			'none' => 'No order',
            'ID' => 'Post ID',
            'author' => 'Post Author',
            'title' => 'Title',
            'date' => 'Date',
            'modified' => 'Last Modified Date',
            'parent' => 'Parent Id',
            'rand' => 'Random',
            'comment_count' => 'Comment Count',
            'menu_order' => 'Menu Order',
		];
        return $orderby;
    }
	
	public static function cea_get_event_post_orderby_options($post_type = 'event'){
        $orderby = [
			'none' => 'No order',
            'ID' => 'Post ID',
            'author' => 'Post Author',
            'title' => 'Title',
            'date' => 'Date',
            'modified' => 'Last Modified Date',
            'parent' => 'Parent Id',
            'rand' => 'Random',
            'comment_count' => 'Comment Count',
            'menu_order' => 'Menu Order',
            'upcoming_events' => 'Upcoming Events'
		];
        return $orderby;
    }

	public static function cea_post_type_taxonomies( $type = 'term_id', $term_key = 'category' ){
        $terms = get_terms(array(
            'taxonomy' => $term_key,
            'hide_empty' => true,
        ));
        $options = [];
        if (!empty($terms) && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                $options[$term->{$type}] = $term->name;
            }
        }
        return $options;
    }
	
    public static function cea_get_elementor_templates( $type = null ) {
        $args = [
            'post_type'      => 'elementor_library',
            'posts_per_page' => -1,
        ];

        if ( $type ) {
            $args['tax_query'] = [
                [
                    'taxonomy' => 'elementor_library_type',
                    'field'    => 'slug',
                    'terms'    => $type,
                ],
            ];
        }

        $page_templates = get_posts( $args );
        $options = array();

        if ( !empty( $page_templates ) && !is_wp_error( $page_templates ) ) {
            foreach ( $page_templates as $post ) {
                $options[$post->ID] = $post->post_title;
            }
        }
        return $options;
    }
		
}