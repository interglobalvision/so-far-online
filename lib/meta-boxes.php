<?php

/* Get post objects for select field options */
function get_post_objects( $query_args ) {
  $args = wp_parse_args( $query_args, array(
    'post_type' => 'post',
  ) );
  $posts = get_posts( $args );
  $post_options = array();
  if ( $posts ) {
    foreach ( $posts as $post ) {
      $post_options [ $post->ID ] = $post->post_title;
    }
  }
  return $post_options;
}


/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

/**
 * Hook in and add metaboxes. Can only happen on the 'cmb2_init' hook.
 */
add_action( 'cmb2_init', 'igv_cmb_metaboxes' );
function igv_cmb_metaboxes() {

  // Start with an underscore to hide fields from custom fields list
  $prefix = '_igv_';

  /**
   * Metaboxes declarations here
   * Reference: https://github.com/WebDevStudios/CMB2/blob/master/example-functions.php
   */

  $article_metabox = new_cmb2_box( array(
 		'id'               => $prefix . 'article_metabox',
 		'title'            => esc_html__( 'Options', 'cmb2' ), // Doesn't output for term boxes
 		'object_types'     => array( 'post', 'weekly', 'diary', 'incubator' ), // Tells CMB2 which taxonomies should have these fields
 	) );

	$article_metabox->add_field( array(
		'name' => esc_html__( 'Subtitle', 'cmb2' ),
		'id'   => $prefix . 'subtitle',
		'type' => 'textarea_small',
	) );

  $article_metabox->add_field( array(
		'name' => esc_html__( 'Featured Image Caption', 'cmb2' ),
		'id'   => $prefix . 'featured_caption',
		'type' => 'wysiwyg',
		'options' => array(
			'textarea_rows' => 2,
      'media_buttons' => false, // show insert/upload button(s)
		),
	) );

  $article_metabox->add_field( array(
		'name' => esc_html__( 'Footnotes', 'cmb2' ),
    'desc' => 'Use [footnote index="#"] in the content to generate the corresponding references',
		'id'   => $prefix . 'footnotes',
		'type' => 'text',
    'repeatable' => 'true',
	) );

  $article_metabox->add_field( array(
		'name'      	=> __( 'Featured Artworks', 'cmb2' ),
		'id'        	=> $prefix . 'article_artworks',
		'type'      	=> 'post_search_ajax',
		'desc'			=> __( '(Start typing product title)', 'cmb2' ),
		// Optional :
		'limit'      	=> 3, 		// Limit selection to X items only (default 1)
		'sortable' 	 	=> true, 	// Allow selected items to be sortable (default false)
		'query_args'	=> array(
			'post_type'			=> array( 'product' ),
			'post_status'		=> array( 'publish' ),
			'posts_per_page'	=> -1
		)
	) );

  $article_metabox->add_field( array(
		'name'      	=> __( 'Further Reading', 'cmb2' ),
		'id'        	=> $prefix . 'article_related',
		'type'      	=> 'post_search_ajax',
		'desc'			=> __( '(Start typing post title)', 'cmb2' ),
		// Optional :
		'limit'      	=> 3, 		// Limit selection to X items only (default 1)
		'sortable' 	 	=> true, 	// Allow selected items to be sortable (default false)
		'query_args'	=> array(
			'post_type'			=> array( 'post', 'weekly', 'incubator', 'diary' ),
			'post_status'		=> array( 'publish' ),
			'posts_per_page'	=> -1
		)
	) );

  // ARTWORK

  $artwork_metabox = new_cmb2_box( array(
 		'id'               => $prefix . 'artwork_metabox',
 		'title'            => esc_html__( 'Options', 'cmb2' ), // Doesn't output for term boxes
 		'object_types'     => array( 'product' ), // Tells CMB2 which taxonomies should have these fields
    'show_in_rest'     => WP_REST_Server::READABLE
 	) );

  $artwork_metabox->add_field( array(
    'name'       => __( 'Product Price', 'igv' ),
    'id'         => $prefix . 'product_price',
    'type'       => 'text',
  ) );

  $artwork_metabox->add_field( array(
    'name'       => __( 'Product Inventory', 'igv' ),
    'id'         => $prefix . 'product_inventory',
    'type'       => 'text_small',
    'default'    => '1',
  ) );

  $artwork_metabox->add_field( array(
    'name'       => __( 'Product Weight Kg', 'igv' ),
    'id'         => $prefix . 'product_weight',
    'type'       => 'text_small',
    'default'    => '0',
  ) );

	$artwork_metabox->add_field( array(
		'name' => esc_html__( 'Title', 'cmb2' ),
		'id'   => $prefix . 'artwork_title',
		'type' => 'text',
	) );

  $artwork_metabox->add_field( array(
		'name' => esc_html__( 'Year', 'cmb2' ),
		'id'   => $prefix . 'artwork_year',
		'type' => 'text_small',
	) );

  $artwork_metabox->add_field( array(
		'name' => esc_html__( 'Specs', 'cmb2' ),
		'id'   => $prefix . 'artwork_specs',
		'type' => 'text',
    'repeatable' => true,
	) );

  $artwork_metabox->add_field( array(
		'name' => esc_html__( 'Images', 'cmb2' ),
		'id'   => $prefix . 'artwork_images',
		'type' => 'file_list',
    'preview_size' => array( 150, 150 ),
	) );

  $artwork_metabox->add_field( array(
    'name'    => esc_html__( 'Editor\'s Pick', 'cmb2' ),
    'id'      => $prefix . 'product_pick',
    'type'    => 'checkbox',
  ) );

  $artwork_metabox->add_field( array(
    'name'    => esc_html__( 'Authenticity', 'cmb2' ),
    'id'      => $prefix . 'product_authenticity',
    'type'    => 'textarea',
  ) );

  $artwork_metabox->add_field( array(
    'name'    => esc_html__( 'Framing & Installation', 'cmb2' ),
    'id'      => $prefix . 'product_framing',
    'type'    => 'textarea',
  ) );

  $artwork_metabox->add_field( array(
    'name'    => esc_html__( 'Shipping & Taxes', 'cmb2' ),
    'id'      => $prefix . 'product_shipping',
    'type'    => 'textarea',
  ) );

  // ISSUE

  $issue_metabox = new_cmb2_box( array(
		'id'               => $prefix . 'issue_metabox',
		'title'            => esc_html__( 'Options', 'cmb2' ), // Doesn't output for term boxes
		'object_types'     => array( 'term' ), // Tells CMB2 to use term_meta vs post_meta
		'taxonomies'       => array( 'issue' ), // Tells CMB2 which taxonomies should have these fields
		'new_term_section' => true, // Will display in the "Add New Category" section
	) );

  $issue_metabox->add_field( array(
		'name' => esc_html__( 'Issue Subtitle', 'cmb2' ),
		'id'   => $prefix . 'subtitle',
		'type' => 'text',
	) );

  $issue_metabox->add_field( array(
		'name' => esc_html__( 'Number', 'cmb2' ),
		'id'   => $prefix . 'issue_number',
		'type' => 'text_small',
	) );

  $issue_metabox->add_field( array(
		'name' => esc_html__( 'Issue Season', 'cmb2' ),
		'id'   => $prefix . 'issue_season',
		'type' => 'text_small',
	) );

  $issue_metabox->add_field( array(
		'name' => esc_html__( 'Publish Date', 'cmb2' ),
		'id'   => $prefix . 'publish_date',
		'type' => 'text_date_timestamp',
		'timezone_meta_key' => $prefix . 'publish_timezone', // Optionally make this field honor the timezone selected in the select_timezone specified above
	) );

  $issue_metabox->add_field( array(
		'name' => esc_html__( 'Publish Timezone', 'cmb2' ),
		'id'   => $prefix . 'publish_timezone',
		'type' => 'select_timezone',
	) );

  $issue_metabox->add_field( array(
		'name' => esc_html__( 'Contributors', 'cmb2' ),
		'id'   => $prefix . 'issue_contributors',
		'type' => 'textarea_small',
	) );

  $issue_metabox->add_field( array(
		'name' => esc_html__( 'Issue Featured Image', 'cmb2' ),
		'id'   => $prefix . 'issue_image',
		'type' => 'file',
	) );

  $issue_metabox->add_field( array(
		'name' => esc_html__( 'Issue Featured Image Caption', 'cmb2' ),
		'id'   => $prefix . 'issue_image_caption',
  	'type' => 'wysiwyg',
    'options' => array(
      'textarea_rows' => 2,
      'media_buttons' => false, // show insert/upload button(s)
    ),
  ) );

  // BIO

  $bio_metabox = new_cmb2_box( array(
		'id'               => $prefix . 'artist_contributor_metabox',
		'title'            => esc_html__( 'Options', 'cmb2' ), // Doesn't output for term boxes
		'object_types'     => array( 'term' ), // Tells CMB2 to use term_meta vs post_meta
		'taxonomies'       => array( 'artist', 'contributor' ), // Tells CMB2 which taxonomies should have these fields
		'new_term_section' => true, // Will display in the "Add New Category" section
	) );

  $bio_metabox->add_field( array(
		'name' => esc_html__( 'Birth Year', 'cmb2' ),
		'id'   => $prefix . 'bio_year',
		'type' => 'text_small',
	) );

  $bio_metabox->add_field( array(
		'name' => esc_html__( 'Photo', 'cmb2' ),
		'id'   => $prefix . 'bio_photo',
		'type' => 'file',
	) );



  // SHOP FILTER

  $shop_filter_metabox = new_cmb2_box( array(
		'id'               => $prefix . 'shop_filter_metabox',
		'title'            => esc_html__( 'Shop Filter', 'cmb2' ), // Doesn't output for term boxes
		'object_types'     => array( 'term' ), // Tells CMB2 to use term_meta vs post_meta
		'taxonomies'       => array( 'artist', 'medium', 'collection' ), // Tells CMB2 which taxonomies should have these fields
		'new_term_section' => true, // Will display in the "Add New Category" section
	) );

  $shop_filter_metabox->add_field( array(
		'name' => esc_html__( 'Filter Image', 'cmb2' ),
		'id'   => $prefix . 'filter_image',
		'type' => 'file',
	) );

  // WEEKLY TYPE

  $weeklytype_metabox = new_cmb2_box( array(
		'id'               => $prefix . 'weeklytype_metabox',
		'title'            => esc_html__( 'Options', 'cmb2' ), // Doesn't output for term boxes
		'object_types'     => array( 'term' ), // Tells CMB2 to use term_meta vs post_meta
		'taxonomies'       => array( 'weeklytype' ), // Tells CMB2 which taxonomies should have these fields
		'new_term_section' => true, // Will display in the "Add New Category" section
	) );

  $weeklytype_metabox->add_field( array(
		'name' => esc_html__( 'Color', 'cmb2' ),
		'id'   => $prefix . 'weeklytype_color',
		'type' => 'colorpicker'
	) );

  // ABOUT

  $about_page = get_page_by_path('about');

  if (!empty($about_page)) {
    $about_metabox = new_cmb2_box( array(
  		'id'            => $prefix . 'about_metabox',
  		'title'         => __( 'Options', 'cmb2' ),
  		'object_types'  => array( 'page', ), // Post type
      'show_on'      => array(
        'key' => 'id',
        'value' => array( $about_page->ID )
      ),
  	) );

    $about_metabox->add_field( array(
  		'name' => esc_html__( 'Headline', 'cmb2' ),
  		'id'   => $prefix . 'about_headline',
  		'type' => 'textarea_small',
  	) );

    $about_metabox->add_field( array(
  		'name' => esc_html__( 'Mission', 'cmb2' ),
  		'id'   => $prefix . 'about_mission',
  		'type' => 'wysiwyg',
  		'options' => array(
  			'textarea_rows' => 5,
        'media_buttons' => false, // show insert/upload button(s)
  		),
  	) );

    $about_metabox->add_field( array(
      'id'          => $prefix . 'about_team_title',
  		'type'        => 'title',
      'name'     => esc_html__( 'Team', 'cmb2' ),
    ) );

    $about_team_id = $about_metabox->add_field( array(
  		'id'          => $prefix . 'about_team',
  		'type'        => 'group',
  		'options'     => array(
  			'group_title'    => esc_html__( 'Member {#}', 'cmb2' ), // {#} gets replaced by row number
  			'add_button'     => esc_html__( 'Add Another Member', 'cmb2' ),
  			'remove_button'  => esc_html__( 'Remove Member', 'cmb2' ),
  			'sortable'       => true,
  		),
  	) );

    $about_metabox->add_group_field( $about_team_id, array(
  		'name' => esc_html__( 'Photo', 'cmb2' ),
  		'id'   => 'photo',
  		'type' => 'file',
  	) );

    $about_metabox->add_group_field( $about_team_id, array(
  		'name'       => esc_html__( 'Name', 'cmb2' ),
  		'id'         => 'name',
  		'type'       => 'text',
  	) );

  	$about_metabox->add_group_field( $about_team_id, array(
  		'name'        => esc_html__( 'Bio', 'cmb2' ),
  		'id'          => 'bio',
  		'type'        => 'textarea_small',
  	) );

    $about_metabox->add_field( array(
  		'name' => esc_html__( 'Contributors Text', 'cmb2' ),
  		'id'   => $prefix . 'about_contributors_text',
  		'type' => 'wysiwyg',
  		'options' => array(
  			'textarea_rows' => 5,
        'media_buttons' => false, // show insert/upload button(s)
  		),
  	) );

    $about_metabox->add_field( array(
  		'name' => esc_html__( 'Contributors Image', 'cmb2' ),
  		'id'   => $prefix . 'about_contributors_image',
  		'type' => 'file',
  	) );

    $about_metabox->add_field( array(
  		'name' => esc_html__( 'Artists Text', 'cmb2' ),
  		'id'   => $prefix . 'about_artists_text',
  		'type' => 'wysiwyg',
  		'options' => array(
  			'textarea_rows' => 5,
        'media_buttons' => false, // show insert/upload button(s)
  		),
  	) );

    $about_metabox->add_field( array(
  		'name' => esc_html__( 'Artists Image', 'cmb2' ),
  		'id'   => $prefix . 'about_artists_image',
  		'type' => 'file',
  	) );

    $about_metabox->add_field( array(
      'id'          => $prefix . 'about_partners_title',
  		'type'        => 'title',
      'name'     => esc_html__( 'Partners', 'cmb2' ),
    ) );

    $about_partners_id = $about_metabox->add_field( array(
  		'id'          => $prefix . 'about_partners',
  		'type'        => 'group',
  		'options'     => array(
  			'group_title'    => esc_html__( 'Partner {#}', 'cmb2' ), // {#} gets replaced by row number
  			'add_button'     => esc_html__( 'Add Another Partner', 'cmb2' ),
  			'remove_button'  => esc_html__( 'Remove Partner', 'cmb2' ),
  			'sortable'       => true,
  		),
  	) );

    $about_metabox->add_group_field( $about_partners_id, array(
  		'name' => esc_html__( 'Logo', 'cmb2' ),
  		'id'   => 'logo',
  		'type' => 'file',
  	) );

    $about_metabox->add_group_field( $about_partners_id, array(
  		'name'       => esc_html__( 'Link', 'cmb2' ),
  		'id'         => 'link',
  		'type' => 'text_url',
  		'protocols' => array('http', 'https'),
  	) );

  }

  // INCUBATOR

  $incubator_page = get_page_by_path('incubator');

  if (!empty($incubator_page)) {
    $incubator_metabox = new_cmb2_box( array(
  		'id'            => $prefix . 'incubator_metabox',
  		'title'         => __( 'Options', 'cmb2' ),
  		'object_types'  => array( 'page', ), // Post type
      'show_on'      => array(
        'key' => 'id',
        'value' => array( $incubator_page->ID )
      ),
  	) );

    $incubator_metabox->add_field( array(
  		'name' => esc_html__( 'Headline', 'cmb2' ),
  		'id'   => $prefix . 'incubator_headline',
  		'type' => 'textarea_small',
  	) );

    $incubator_metabox->add_field( array(
  		'name' => esc_html__( 'Projects Brief', 'cmb2' ),
  		'id'   => $prefix . 'incubator_projects_brief',
  		'type' => 'textarea_small',
  	) );

  }
}
?>
