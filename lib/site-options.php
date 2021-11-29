<?php
add_action( 'cmb2_admin_init', 'igv_register_theme_options_metabox' );

function igv_register_theme_options_metabox() {
  $prefix = '_igv_';
/*
  $boiler_options = new_cmb2_box( array(
    'id'           => $prefix . 'boiler_options_page',
    'title'        => esc_html__( 'Boiler Options', 'cmb2' ),
    'object_types' => array( 'options-page' ),
    'option_key'      => $prefix . 'boiler_options', // The option key and admin menu page slug.
    'icon_url'        => 'dashicons-layout', // Menu icon. Only applicable if 'parent_slug' is left empty.
    // 'menu_title'      => esc_html__( 'Options', 'cmb2' ), // Falls back to 'title' (above).
    // 'parent_slug'     => 'themes.php', // Make options page a submenu item of the themes menu.
    'capability'      => 'manage_options', // Cap required to view options-page.
    // 'position'        => 1, // Menu position. Only applicable if 'parent_slug' is left empty.
    // 'admin_menu_hook' => 'network_admin_menu', // 'network_admin_menu' to add network-level options page.
    // 'display_cb'      => false, // Override the options-page form output (CMB2_Hookup::options_page_output()).
    'save_button'     => esc_html__( 'Boil me baby', 'cmb2' ), // The text for the options-page save button. Defaults to 'Save'.
  ) );

  $boiler_options->add_field( array(
    'name'    => esc_html__( 'THE TITLE', 'cmb2' ),
    'desc'    => esc_html__( 'field description (optional)', 'cmb2' ),
    'id'      => 'title',
    'type'    => 'title',
  ) );

  $boiler_options->add_field( array(
    'name'    => esc_html__( 'Site Background Color', 'cmb2' ),
    'desc'    => esc_html__( 'field description (optional)', 'cmb2' ),
    'id'      => 'bg_color',
    'type'    => 'colorpicker',
    'default' => '#ffffff',
  ) );
*/
  // Site options for general data

  $site_options = new_cmb2_box( array(
    'id'           => $prefix . 'site_options_page',
    'title'        => esc_html__( 'Site Options', 'cmb2' ),
    'object_types' => array( 'options-page' ),
    /*
     * The following parameters are specific to the options-page box
     * Several of these parameters are passed along to add_menu_page()/add_submenu_page().
     */
    'option_key'      => $prefix . 'site_options', // The option key and admin menu page slug.
    // 'menu_title'      => esc_html__( 'Options', 'cmb2' ), // Falls back to 'title' (above).
    // 'parent_slug'     => 'themes.php', // Make options page a submenu item of the themes menu.
    'capability'      => 'manage_options', // Cap required to view options-page.
    // 'position'        => 1, // Menu position. Only applicable if 'parent_slug' is left empty.
    // 'admin_menu_hook' => 'network_admin_menu', // 'network_admin_menu' to add network-level options page.
    // 'display_cb'      => false, // Override the options-page form output (CMB2_Hookup::options_page_output()).
    // 'save_button'     => esc_html__( 'Save Theme Options', 'cmb2' ), // The text for the options-page save button. Defaults to 'Save'.
  ) );

  // Shop

  $site_options->add_field( array(
    'name'    => esc_html__( 'Shop', 'cmb2' ),
    'id'      => $prefix . 'shop_title',
    'type'    => 'title',
  ) );

  $site_options->add_field( array(
    'name'    => esc_html__( 'Stripe API Private Key', 'cmb2' ),
    'id'      => 'shop_stripe_key',
    'type'    => 'text',
  ) );

  $site_options->add_field( array(
    'name'    => esc_html__( 'Shop Archive Slug', 'igv' ),
    'desc'    => esc_html__( 'Defaults to \'shop\'. You must update permalinks after changing.', 'igv' ),
    'id'      => 'shop_archive_slug',
    'type'    => 'text',
  ) );

  $site_options->add_field( array(
    'name'    => esc_html__( 'Shop Item Slug', 'igv' ),
    'desc'    => esc_html__( 'Defaults to \'product\'. You must update permalinks after changing.', 'igv' ),
    'id'      => 'shop_item_slug',
    'type'    => 'text',
  ) );

  // Currencies

  $site_options->add_field( array(
    'name' => esc_html__( 'Currency Codes', 'cmb2' ),
    'id'          => 'shop_currencies',
    'type'        => 'text_small',
    'desc'        => 'Add all currencies here, including default currency',
    'repeatable' => true,
    'options'     => array(
      'repeatable' => true
    )
  ) );

  // Shipping

  $site_options->add_field( array(
    'name' => esc_html__( 'Domestic shipping label', 'cmb2' ),
    'id'   => 'shop_shipping_domestic_label',
    'type'    => 'text',
    'default' => 'Domestic'
  ) );

  $domestic_shipping_group_id = $site_options->add_field( array(
    'name'        => 'Domestic options',
    'desc'        => 'Must be ordered by cost, low to high',
    'id'          => 'shop_shipping_domestic',
    'type'        => 'group',
    'options'     => array(
      'group_title'    => esc_html__( 'Option {#}', 'cmb2' ), // {#} gets replaced by row number
      'add_button'     => esc_html__( 'Add Another Option', 'cmb2' ),
      'remove_button'  => esc_html__( 'Remove Option', 'cmb2' ),
      'sortable'       => true,
      'closed'     => true
    ),
  ) );

  $site_options->add_group_field( $domestic_shipping_group_id, array(
    'name' => esc_html__( 'Cost (SGD)', 'cmb2' ),
    'id'   => 'cost',
    'type'    => 'text',
  ) );

  $site_options->add_group_field( $domestic_shipping_group_id, array(
    'name' => esc_html__( 'Max Weight Kg (if any)', 'cmb2' ),
    'id'   => 'max',
    'type'    => 'text',
  ) );

  $site_options->add_field( array(
    'name' => esc_html__( 'International shipping label', 'cmb2' ),
    'id'   => 'shop_shipping_international_label',
    'type'    => 'text',
    'default' => 'International'
  ) );

  $international_shipping_group_id = $site_options->add_field( array(
    'name'        => 'International shipping',
    'desc'        => 'Must be ordered by cost, low to high',
    'id'          => 'shop_shipping_international',
    'type'        => 'group',
    'options'     => array(
      'group_title'    => esc_html__( 'Option {#}', 'cmb2' ), // {#} gets replaced by row number
      'add_button'     => esc_html__( 'Add Another Option', 'cmb2' ),
      'remove_button'  => esc_html__( 'Remove Option', 'cmb2' ),
      'sortable'       => true,
      'closed'     => true
    ),
  ) );

  $site_options->add_group_field( $international_shipping_group_id, array(
    'name' => esc_html__( 'Cost (SGD)', 'cmb2' ),
    'id'   => 'cost',
    'type'    => 'text',
  ) );

  $site_options->add_group_field( $international_shipping_group_id, array(
    'name' => esc_html__( 'Max Weight (if any)', 'cmb2' ),
    'id'   => 'max',
    'type'    => 'text',
  ) );

  // Mailchimp

  $site_options->add_field( array(
    'name'    => esc_html__( 'Mailchimp', 'cmb2' ),
    'id'      => $prefix . 'mailchimp_title',
    'type'    => 'title',
  ) );

  $site_options->add_field( array(
    'name'    => esc_html__( 'Mailchimp Action', 'cmb2' ),
    'id'      => 'mailchimp_action',
    'type'    => 'text',
  ) );

  // Social Media variables

  $site_options->add_field( array(
    'name'    => esc_html__( 'Social Media', 'cmb2' ),
    'desc'    => esc_html__( 'Urls and accounts for different social media platforms. For use in menus and metadata', 'cmb2' ),
    'id'      => $prefix . 'socialmedia_title',
    'type'    => 'title',
  ) );

  $site_options->add_field( array(
    'name'    => esc_html__( 'Facebook Account Handle', 'cmb2' ),
    'id'      => 'socialmedia_facebook',
    'type'    => 'text',
    'default' => 'sofaronline',
  ) );

  $site_options->add_field( array(
    'name'    => esc_html__( 'Twitter Account Handle', 'cmb2' ),
    'id'      => 'socialmedia_twitter',
    'type'    => 'text',
    'default' => 'so_faronline',
  ) );

  $site_options->add_field( array(
    'name'    => esc_html__( 'Instagram Account Handle', 'cmb2' ),
    'id'      => 'socialmedia_instagram',
    'type'    => 'text',
    'default' => 'sofaronline',
  ) );

  $site_options->add_field( array(
    'name'    => esc_html__( 'Vimeo Account Handle', 'cmb2' ),
    'id'      => 'socialmedia_vimeo',
    'type'    => 'text',
    'default' => 'sofaronline',
  ) );

  // Metadata options

  $site_options->add_field( array(
    'name'    => esc_html__( 'Metadata options', 'cmb2' ),
    'desc'    => esc_html__( 'Settings relating to open graph, facebook and twitter sharing, and other social media metadata', 'cmb2' ),
    'id'      => $prefix . 'og_title',
    'type'    => 'title',
  ) );

  $site_options->add_field( array(
    'name'    => esc_html__( 'Open Graph default image', 'cmb2' ),
    'desc'    => esc_html__( 'primarily displayed on Facebook, but other locations as well', 'cmb2' ),
    'id'      => 'og_image',
    'type'    => 'file',
  ) );

  $site_options->add_field( array(
    'name'    => esc_html__( 'Logo for SEO results', 'cmb2' ),
    'desc'    => esc_html__( 'presentation logo for this site (optional)', 'cmb2' ),
    'id'      => 'metadata_logo',
    'type'    => 'file',
  ) );

  $site_options->add_field( array(
    'name'    => esc_html__( 'Facebook App ID', 'cmb2' ),
    'desc'    => esc_html__( '(optional)', 'cmb2' ),
    'id'      => 'og_fb_app_id',
    'type'    => 'text',
  ) );

  // Analytics

  $site_options->add_field( array(
    'name'    => esc_html__( 'Analytics', 'cmb2' ),
    'desc'    => esc_html__( 'Settings for analytics', 'cmb2' ),
    'id'      => $prefix . 'analytics_title',
    'type'    => 'title',
  ) );

  $site_options->add_field( array(
    'name'    => esc_html__( 'Google Analytics Tracking ID', 'cmb2' ),
    'desc'    => esc_html__( '(optional)', 'cmb2' ),
    'id'      => 'google_analytics_id',
    'type'    => 'text',
  ) );
}
