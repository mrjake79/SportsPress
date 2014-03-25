<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Post types
 *
 * Registers post types and taxonomies
 *
 * @class 		SP_Post_types
 * @version		0.7
 * @package		SportsPress/Classes/Products
 * @category	Class
 * @author 		ThemeBoy
 */
class SP_Post_types {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'init', array( __CLASS__, 'register_taxonomies' ), 5 );
		add_action( 'init', array( __CLASS__, 'register_post_types' ), 5 );
		add_filter( 'the_posts', array( __CLASS__, 'display_scheduled_events' ) );
	}

	/**
	 * Register SportsPress taxonomies.
	 */
	public static function register_taxonomies() {
		if ( taxonomy_exists( 'product_type' ) )
			return;

		do_action( 'sportspress_register_taxonomy' );

		$labels = array(
			'name' => __( 'Leagues', 'sportspress' ),
			'singular_name' => __( 'League', 'sportspress' ),
			'all_items' => __( 'All', 'sportspress' ),
			'edit_item' => __( 'Edit League', 'sportspress' ),
			'view_item' => __( 'View', 'sportspress' ),
			'update_item' => __( 'Update', 'sportspress' ),
			'add_new_item' => __( 'Add New', 'sportspress' ),
			'new_item_name' => __( 'Name', 'sportspress' ),
			'parent_item' => __( 'Parent', 'sportspress' ),
			'parent_item_colon' => __( 'Parent:', 'sportspress' ),
			'search_items' =>  __( 'Search', 'sportspress' ),
			'not_found' => __( 'No results found.', 'sportspress' ),
		);
		$args = array(
			'label' => __( 'Leagues', 'sportspress' ),
			'labels' => $labels,
			'public' => true,
			'show_in_nav_menus' => false,
			'show_tagcloud' => false,
			'hierarchical' => true,
			'rewrite' => array( 'slug' => get_option( 'sportspress_league_slug', 'league' ) ),
		);
		$object_types = array( 'sp_event', 'sp_calendar', 'sp_team', 'sp_table', 'sp_player', 'sp_list', 'sp_staff' );
		register_taxonomy( 'sp_league', $object_types, $args );
		foreach ( $object_types as $object_type ):
			register_taxonomy_for_object_type( 'sp_league', $object_type );
		endforeach;

		$labels = array(
			'name' => __( 'Seasons', 'sportspress' ),
			'singular_name' => __( 'Season', 'sportspress' ),
			'all_items' => __( 'All', 'sportspress' ),
			'edit_item' => __( 'Edit Season', 'sportspress' ),
			'view_item' => __( 'View', 'sportspress' ),
			'update_item' => __( 'Update', 'sportspress' ),
			'add_new_item' => __( 'Add New', 'sportspress' ),
			'new_item_name' => __( 'Name', 'sportspress' ),
			'parent_item' => __( 'Parent', 'sportspress' ),
			'parent_item_colon' => __( 'Parent:', 'sportspress' ),
			'search_items' =>  __( 'Search', 'sportspress' ),
			'not_found' => __( 'No results found.', 'sportspress' ),
		);
		$args = array(
			'label' => __( 'Seasons', 'sportspress' ),
			'labels' => $labels,
			'public' => true,
			'show_in_nav_menus' => false,
			'show_tagcloud' => false,
			'hierarchical' => true,
			'rewrite' => array( 'slug' => get_option( 'sportspress_season_slug', 'season' ) ),
		);
		$object_types = array( 'sp_event', 'sp_calendar', 'sp_team', 'sp_table', 'sp_player', 'sp_list', 'sp_staff' );
		register_taxonomy( 'sp_season', $object_types, $args );
		foreach ( $object_types as $object_type ):
			register_taxonomy_for_object_type( 'sp_league', $object_type );
		endforeach;

		$labels = array(
			'name' => __( 'Venues', 'sportspress' ),
			'singular_name' => __( 'Venue', 'sportspress' ),
			'all_items' => __( 'All', 'sportspress' ),
			'edit_item' => __( 'Edit Venue', 'sportspress' ),
			'view_item' => __( 'View', 'sportspress' ),
			'update_item' => __( 'Update', 'sportspress' ),
			'add_new_item' => __( 'Add New', 'sportspress' ),
			'new_item_name' => __( 'Name', 'sportspress' ),
			'parent_item' => __( 'Parent', 'sportspress' ),
			'parent_item_colon' => __( 'Parent:', 'sportspress' ),
			'search_items' =>  __( 'Search', 'sportspress' ),
			'not_found' => __( 'No results found.', 'sportspress' ),
		);
		$args = array(
			'label' => __( 'Venues', 'sportspress' ),
			'labels' => $labels,
			'public' => true,
			'show_in_nav_menus' => false,
			'show_tagcloud' => false,
			'hierarchical' => true,
			'rewrite' => array( 'slug' => get_option( 'sportspress_venue_slug', 'venue' ) ),
		);
		$object_types = array( 'sp_event', 'sp_calendar', 'attachment' );
		register_taxonomy( 'sp_venue', $object_types, $args );
		foreach ( $object_types as $object_type ):
			register_taxonomy_for_object_type( 'sp_league', $object_type );
		endforeach;

		$labels = array(
			'name' => __( 'Positions', 'sportspress' ),
			'singular_name' => __( 'Position', 'sportspress' ),
			'all_items' => __( 'All', 'sportspress' ),
			'edit_item' => __( 'Edit Position', 'sportspress' ),
			'view_item' => __( 'View', 'sportspress' ),
			'update_item' => __( 'Update', 'sportspress' ),
			'add_new_item' => __( 'Add New', 'sportspress' ),
			'new_item_name' => __( 'Name', 'sportspress' ),
			'parent_item' => __( 'Parent', 'sportspress' ),
			'parent_item_colon' => __( 'Parent:', 'sportspress' ),
			'search_items' =>  __( 'Search', 'sportspress' ),
			'not_found' => __( 'No results found.', 'sportspress' ),
		);
		$args = array(
			'label' => __( 'Positions', 'sportspress' ),
			'labels' => $labels,
			'public' => true,
			'show_in_nav_menus' => false,
			'show_tagcloud' => false,
			'hierarchical' => true,
			'rewrite' => array( 'slug' => get_option( 'sportspress_position_slug', 'position' ) ),
		);
		$object_types = array( 'sp_player', 'sp_performance', 'sp_metric', 'attachment' );
		register_taxonomy( 'sp_position', $object_types, $args );
		foreach ( $object_types as $object_type ):
			register_taxonomy_for_object_type( 'sp_league', $object_type );
		endforeach;
	}

	/**
	 * Register core post types
	 */
	public static function register_post_types() {

		register_post_type( 'sp_separator',
			array(
				'label' => '',
				'public' => false,
				'show_ui' => true,
				'show_in_nav_menus' => false,
				'show_in_admin_bar' => false,
				'can_export' => false,
			)
		);	

		do_action( 'sportspress_register_post_type' );

		register_post_type( 'sp_event',
			apply_filters( 'sportspress_register_post_type_event',
				array(
					'labels' => array(
						'name' 					=> __( 'Schedule', 'sportspress' ),
						'singular_name' 		=> __( 'Event', 'sportspress' ),
						'all_items' 			=> __( 'Events', 'sportspress' ),
						'add_new_item' 			=> __( 'Add New Event', 'sportspress' ),
						'edit_item' 			=> __( 'Edit Event', 'sportspress' ),
						'new_item' 				=> __( 'New', 'sportspress' ),
						'view_item' 			=> __( 'View', 'sportspress' ),
						'search_items' 			=> __( 'Search', 'sportspress' ),
						'not_found' 			=> __( 'No results found.', 'sportspress' ),
						'not_found_in_trash' 	=> __( 'No results found.', 'sportspress' ),
					),
					'public' 				=> true,
					'show_ui' 				=> true,
					'capability_type' 		=> 'sp_event',
					'map_meta_cap' 			=> true,
					'publicly_queryable' 	=> true,
					'exclude_from_search' 	=> false,
					'hierarchical' 			=> false,
					'rewrite' 				=> array( 'slug' => get_option( 'sportspress_events_slug', 'events' ) ),
					'supports' 				=> array( 'title', 'author', 'thumbnail', 'comments' ),
					'has_archive' 			=> true,
					'show_in_nav_menus' 	=> true,
					'menu_icon' 			=> 'dashicons-calendar',
				)
			)
		);

		register_post_type( 'sp_calendar',
			apply_filters( 'sportspress_register_post_type_calendar',
				array(
					'labels' => array(
						'name' 					=> __( 'Calendars', 'sportspress' ),
						'singular_name' 		=> __( 'Calendar', 'sportspress' ),
						'all_items' 			=> __( 'Calendars', 'sportspress' ),
						'add_new_item' 			=> __( 'Add New Calendar', 'sportspress' ),
						'edit_item' 			=> __( 'Edit Calendar', 'sportspress' ),
						'new_item' 				=> __( 'New', 'sportspress' ),
						'view_item' 			=> __( 'View', 'sportspress' ),
						'search_items' 			=> __( 'Search', 'sportspress' ),
						'not_found' 			=> __( 'No results found.', 'sportspress' ),
						'not_found_in_trash' 	=> __( 'No results found.', 'sportspress' ),
					),
					'public' 				=> true,
					'show_ui' 				=> true,
					'capability_type' 		=> 'sp_calendar',
					'map_meta_cap' 			=> true,
					'publicly_queryable' 	=> true,
					'exclude_from_search' 	=> false,
					'hierarchical' 			=> false,
					'rewrite' 				=> array( 'slug' => get_option( 'sportspress_calendar_slug', 'calendar' ) ),
					'supports' 				=> array( 'title', 'author', 'thumbnail' ),
					'has_archive' 			=> false,
					'show_in_nav_menus' 	=> true,
					'show_in_menu' => 'edit.php?post_type=sp_event',
				)
			)
		);

		register_post_type( 'sp_team',
			apply_filters( 'sportspress_register_post_type_team',
				array(
					'labels' => array(
						'name' 					=> __( 'Teams', 'sportspress' ),
						'singular_name' 		=> __( 'Team', 'sportspress' ),
						'all_items' 			=> __( 'Teams', 'sportspress' ),
						'add_new_item' 			=> __( 'Add New Team', 'sportspress' ),
						'edit_item' 			=> __( 'Edit Team', 'sportspress' ),
						'new_item' 				=> __( 'New', 'sportspress' ),
						'view_item' 			=> __( 'View', 'sportspress' ),
						'search_items' 			=> __( 'Search', 'sportspress' ),
						'not_found' 			=> __( 'No results found.', 'sportspress' ),
						'not_found_in_trash' 	=> __( 'No results found.', 'sportspress' ),
					),
					'public' 				=> true,
					'show_ui' 				=> true,
					'capability_type' 		=> 'sp_team',
					'map_meta_cap' 			=> true,
					'publicly_queryable' 	=> true,
					'exclude_from_search' 	=> false,
					'hierarchical' 			=> true,
					'rewrite' 				=> array( 'slug' => get_option( 'sportspress_teams_slug', 'teams' ) ),
					'supports' 				=> array( 'title', 'editor', 'author', 'thumbnail', 'page-attributes' ),
					'has_archive' 			=> true,
					'show_in_nav_menus' 	=> true,
					'menu_icon' 			=> 'dashicons-shield-alt',
				)
			)
		);

		register_post_type( 'sp_table',
			apply_filters( 'sportspress_register_post_type_table',
				array(
					'labels' => array(
						'name' 					=> __( 'League Tables', 'sportspress' ),
						'singular_name' 		=> __( 'League Table', 'sportspress' ),
						'all_items' 			=> __( 'League Tables', 'sportspress' ),
						'add_new_item' 			=> __( 'Add New League Table', 'sportspress' ),
						'edit_item' 			=> __( 'Edit League Table', 'sportspress' ),
						'new_item' 				=> __( 'New', 'sportspress' ),
						'view_item' 			=> __( 'View', 'sportspress' ),
						'search_items' 			=> __( 'Search', 'sportspress' ),
						'not_found' 			=> __( 'No results found.', 'sportspress' ),
						'not_found_in_trash' 	=> __( 'No results found.', 'sportspress' ),
					),
					'public' 				=> true,
					'show_ui' 				=> true,
					'capability_type' 		=> 'sp_table',
					'map_meta_cap' 			=> true,
					'publicly_queryable' 	=> true,
					'exclude_from_search' 	=> false,
					'hierarchical' 			=> false,
					'rewrite' 				=> array( 'slug' => get_option( 'sportspress_table_slug', 'table' ) ),
					'supports' 				=> array( 'title', 'author', 'thumbnail' ),
					'has_archive' 			=> false,
					'show_in_nav_menus' 	=> true,
					'show_in_menu' 			=> 'edit.php?post_type=sp_team',
				)
			)
		);

		register_post_type( 'sp_player',
			apply_filters( 'sportspress_register_post_type_player',
				array(
					'labels' => array(
						'name' 					=> __( 'Roster', 'sportspress' ),
						'singular_name' 		=> __( 'Player', 'sportspress' ),
						'all_items' 			=> __( 'Players', 'sportspress' ),
						'add_new_item' 			=> __( 'Add New Player', 'sportspress' ),
						'edit_item' 			=> __( 'Edit Player', 'sportspress' ),
						'new_item' 				=> __( 'New', 'sportspress' ),
						'view_item' 			=> __( 'View', 'sportspress' ),
						'search_items' 			=> __( 'Search', 'sportspress' ),
						'not_found' 			=> __( 'No results found.', 'sportspress' ),
						'not_found_in_trash' 	=> __( 'No results found.', 'sportspress' ),
					),
					'public' 				=> true,
					'show_ui' 				=> true,
					'capability_type' 		=> 'sp_player',
					'map_meta_cap' 			=> true,
					'publicly_queryable' 	=> true,
					'exclude_from_search' 	=> false,
					'hierarchical' 			=> false,
					'rewrite' 				=> array( 'slug' => get_option( 'sportspress_players_slug', 'players' ) ),
					'supports' 				=> array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'page-attributes' ),
					'has_archive' 			=> true,
					'show_in_nav_menus' 	=> true,
					'menu_icon' 			=> 'dashicons-groups',
				)
			)
		);

		register_post_type( 'sp_list',
			apply_filters( 'sportspress_register_post_type_list',
				array(
					'labels' => array(
						'name' 					=> __( 'Player Lists', 'sportspress' ),
						'singular_name' 		=> __( 'Player List', 'sportspress' ),
						'all_items' 			=> __( 'Player Lists', 'sportspress' ),
						'add_new_item' 			=> __( 'Add New Player List', 'sportspress' ),
						'edit_item' 			=> __( 'Edit Player List', 'sportspress' ),
						'new_item' 				=> __( 'New', 'sportspress' ),
						'view_item' 			=> __( 'View', 'sportspress' ),
						'search_items' 			=> __( 'Search', 'sportspress' ),
						'not_found' 			=> __( 'No results found.', 'sportspress' ),
						'not_found_in_trash' 	=> __( 'No results found.', 'sportspress' ),
					),
					'public' 				=> true,
					'show_ui' 				=> true,
					'capability_type' 		=> 'sp_list',
					'map_meta_cap' 			=> true,
					'publicly_queryable' 	=> true,
					'exclude_from_search' 	=> false,
					'hierarchical' 			=> false,
					'rewrite' 				=> array( 'slug' => get_option( 'sportspress_list_slug', 'list' ) ),
					'supports' 				=> array( 'title', 'author', 'thumbnail' ),
					'has_archive' 			=> false,
					'show_in_nav_menus' 	=> true,
					'show_in_menu' 			=> 'edit.php?post_type=sp_player',
				)
			)
		);

		register_post_type( 'sp_staff',
			apply_filters( 'sportspress_register_post_type_staff',
				array(
					'labels' => array(
						'name' 					=> __( 'Staff', 'sportspress' ),
						'singular_name' 		=> __( 'Staff', 'sportspress' ),
						'all_items' 			=> __( 'Staff', 'sportspress' ),
						'add_new_item' 			=> __( 'Add New Staff', 'sportspress' ),
						'edit_item' 			=> __( 'Edit Staff', 'sportspress' ),
						'new_item' 				=> __( 'New', 'sportspress' ),
						'view_item' 			=> __( 'View', 'sportspress' ),
						'search_items' 			=> __( 'Search', 'sportspress' ),
						'not_found' 			=> __( 'No results found.', 'sportspress' ),
						'not_found_in_trash' 	=> __( 'No results found.', 'sportspress' ),
					),
					'public' 				=> true,
					'show_ui' 				=> true,
					'capability_type' 		=> 'sp_staff',
					'map_meta_cap' 			=> true,
					'publicly_queryable' 	=> true,
					'exclude_from_search' 	=> false,
					'hierarchical' 			=> false,
					'rewrite' 				=> array( 'slug' => get_option( 'sportspress_staff_slug', 'staff' ) ),
					'supports' 				=> array( 'title', 'author', 'thumbnail' ),
					'has_archive' 			=> true,
					'show_in_nav_menus' 	=> true,
					'show_in_menu' 			=> 'edit.php?post_type=sp_player',
				)
			)
		);
	}

	public function display_scheduled_events( $posts ) {
		global $wp_query, $wpdb;
		if ( is_single() && $wp_query->post_count == 0 && isset( $wp_query->query_vars['sp_event'] )) {
			$posts = $wpdb->get_results( $wp_query->request );
		}
		return $posts;
	}
}

new SP_Post_types();
