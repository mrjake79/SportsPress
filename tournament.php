<?php
function sp_tournament_cpt_init() {
	$name = __( 'Tournaments', 'sportspress' );
	$singular_name = __( 'Tournament', 'sportspress' );
	$labels = sp_get_cpt_labels( $name, $singular_name );
	$args = array(
		'label' => $name,
		'labels' => $labels,
		'public' => true,
		'hierarchical' => true,
		'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'comments', 'page-attributes' ),
		'rewrite' => array( 'slug' => 'tournament' )
	);
	register_post_type( 'sp_tournament', $args );
}
add_action( 'init', 'sp_tournament_cpt_init' );

function sp_tournament_edit_columns() {
	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'Title' ),
		'sp_team' => __( 'Teams', 'sportspress' ),
		'sp_event' => __( 'Events', 'sportspress' ),
		'sp_sponsor' => __( 'Sponsor', 'sportspress' )
	);
	return $columns;
}
add_filter( 'manage_edit-sp_tournament_columns', 'sp_tournament_edit_columns' );
?>