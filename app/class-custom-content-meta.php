<?php
/**
 * Main Plugin file.
 *
 * @package WordPress
 */

namespace Brand_Review\CRM;

/**
 * Class Custom_Content_Meta
 */
class Custom_Content_Meta {
	/**
	 * Meta option prefix.
	 *
	 * @var string
	 */
	public static $plugins_meta_prefix = 'brandreview_';

	/**
	 * Registration function initializes code in the proper scope.
	 */
	public static function register_meta_boxes() {
		add_action( 'cmb2_admin_init', [ get_called_class(), 'register_demo_metabox' ] );
	}

	/**
	 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
	 */
	public static function register_demo_metabox() {
		$prefix = static::$plugins_meta_prefix;

		/**
		 * Sample metabox to demonstrate each field type included
		 */
		$cmb_tabs_demo = new_cmb2_box( [
			'id'           => $prefix . 'metabox',
			'title'        => esc_html__( 'Test Metabox', 'cmb2_tabs' ),
			'object_types' => [ 'review_product' ],
			'tabs'         => [
				'contact' => [
					'label' => __( 'Contact', 'cmb2_tabs' ),
				],
				'social'  => [
					'label' => __( 'Social Media', 'cmb2_tabs' ),
					'icon'  => 'dashicons-share',
				],
				'note'    => [
					'label' => __( 'Note', 'cmb2_tabs' ),
					'icon'  => 'dashicons-sos',
				],
			],
		] );
		$cmb_tabs_demo->add_field( [
			'name'          => esc_html__( 'Test Text', 'cmb2_tabs' ),
			'desc'          => esc_html__( 'field description (optional)', 'cmb2_tabs' ),
			'id'            => $prefix . 'text',
			'type'          => 'text',
			'tab'           => 'contact',
			'render_row_cb' => [ 'CMB2_Tabs', 'tabs_render_row_cb' ],
		] );
		$cmb_tabs_demo->add_field( [
			'name'          => esc_html__( 'Test Text Small', 'cmb2_tabs' ),
			'desc'          => esc_html__( 'field description (optional)', 'cmb2_tabs' ),
			'id'            => $prefix . 'textsmall',
			'type'          => 'text_small',
			'tab'           => 'contact',
			'render_row_cb' => [ 'CMB2_Tabs', 'tabs_render_row_cb' ],
			'repeatable'    => true,
		] );
		$cmb_tabs_demo->add_field( [
			'name'          => esc_html__( 'Test Text Medium', 'cmb2_tabs' ),
			'desc'          => esc_html__( 'field description (optional)', 'cmb2_tabs' ),
			'id'            => $prefix . 'textmedium',
			'tab'           => 'contact',
			'type'          => 'text_medium',
			'render_row_cb' => [ 'CMB2_Tabs', 'tabs_render_row_cb' ],
		] );
		$cmb_tabs_demo->add_field( [
			'name'          => esc_html__( 'Read-only Disabled Field', 'cmb2_tabs' ),
			'desc'          => esc_html__( 'field description (optional)', 'cmb2_tabs' ),
			'id'            => $prefix . 'readonly',
			'type'          => 'text_medium',
			'tab'           => 'social',
			'render_row_cb' => [ 'CMB2_Tabs', 'tabs_render_row_cb' ],
			'default'       => esc_attr__( 'Hey there, I\'m a read-only field', 'cmb2_tabs' ),
			'save_field'    => false, // Disables the saving of this field.
			'attributes'    => [
				'disabled' => 'disabled',
				'readonly' => 'readonly',
			],
		] );
		$cmb_tabs_demo->add_field( [
			'name'          => esc_html__( 'Custom Rendered Field', 'cmb2_tabs' ),
			'desc'          => esc_html__( 'field description (optional)', 'cmb2_tabs' ),
			'id'            => $prefix . 'render_row_cb',
			'type'          => 'text',
			'tab'           => 'social',
			'render_row_cb' => [ 'CMB2_Tabs', 'tabs_render_row_cb' ],
		] );
		$cmb_tabs_demo->add_field( [
			'name'          => esc_html__( 'Website URL', 'cmb2_tabs' ),
			'desc'          => esc_html__( 'field description (optional)', 'cmb2_tabs' ),
			'id'            => $prefix . 'url',
			'type'          => 'text_url',
			'tab'           => 'social',
			'render_row_cb' => [ 'CMB2_Tabs', 'tabs_render_row_cb' ],
			'protocols'     => [
				'http',
				'https',
				'ftp',
				'ftps',
				'mailto',
				'news',
				'irc',
				'gopher',
				'nntp',
				'feed',
				'telnet',
			],
		] );
		$cmb_tabs_demo->add_field( [
			'name'          => esc_html__( 'Test Text Email', 'cmb2_tabs' ),
			'desc'          => esc_html__( 'field description (optional)', 'cmb2_tabs' ),
			'id'            => $prefix . 'email',
			'type'          => 'text_email',
			'tab'           => 'social',
			'render_row_cb' => [ 'CMB2_Tabs', 'tabs_render_row_cb' ],
		] );
		$cmb_tabs_demo->add_field( [
			'name'          => esc_html__( 'Test Time', 'cmb2_tabs' ),
			'desc'          => esc_html__( 'field description (optional)', 'cmb2_tabs' ),
			'id'            => $prefix . 'time',
			'type'          => 'text_time',
			'tab'           => 'note',
			'render_row_cb' => [ 'CMB2_Tabs', 'tabs_render_row_cb' ],
			'time_format'   => 'H:i',
		] );
		$cmb_tabs_demo->add_field( [
			'name'          => esc_html__( 'Time zone', 'cmb2_tabs' ),
			'desc'          => esc_html__( 'Time zone', 'cmb2_tabs' ),
			'id'            => $prefix . 'timezone',
			'type'          => 'select_timezone',
			'tab'           => 'note',
			'render_row_cb' => [ 'CMB2_Tabs', 'tabs_render_row_cb' ],
		] );
		$cmb_tabs_demo->add_field( [
			'name'          => esc_html__( 'Test Date Picker', 'cmb2_tabs' ),
			'desc'          => esc_html__( 'field description (optional)', 'cmb2_tabs' ),
			'id'            => $prefix . 'textdate',
			'type'          => 'text_date',
			'tab'           => 'note',
			'render_row_cb' => [ 'CMB2_Tabs', 'tabs_render_row_cb' ],
			'date_format'   => 'Y-m-d',
		] );
		$cmb_tabs_demo->add_field( [
			'name'              => esc_html__( 'Test Date Picker (UNIX timestamp)', 'cmb2_tabs' ),
			'desc'              => esc_html__( 'field description (optional)', 'cmb2_tabs' ),
			'id'                => $prefix . 'textdate_timestamp',
			'type'              => 'text_date_timestamp',
			'tab'               => 'note',
			'render_row_cb'     => [ 'CMB2_Tabs', 'tabs_render_row_cb' ],
			'timezone_meta_key' => $prefix . 'timezone',
		] );
		$cmb_tabs_demo->add_field( [
			'name'          => esc_html__( 'Test Date/Time Picker Combo (UNIX timestamp)', 'cmb2_tabs' ),
			'desc'          => esc_html__( 'field description (optional)', 'cmb2_tabs' ),
			'id'            => $prefix . 'datetime_timestamp',
			'type'          => 'text_datetime_timestamp',
			'tab'           => 'note',
			'render_row_cb' => [ 'CMB2_Tabs', 'tabs_render_row_cb' ],
		] );

		/*******************GROUPS**************************/
		$group_field_id = $cmb_tabs_demo->add_field( [
			'id'            => 'wiki_test_repeat_group',
			'type'          => 'group',
			'description'   => __( 'Generates reusable form entries', 'cmb2_tabs' ),
			'tab'           => 'note',
			'render_row_cb' => [ 'CMB2_Tabs', 'tabs_render_group_row_cb' ],
			'repeatable'    => false, // Use false if you want non-repeatable group.
			'options'       => [
				'group_title'   => __( 'Entry {#}', 'cmb2_tabs' ),
				'add_button'    => __( 'Add Another Entry', 'cmb2_tabs' ),
				'remove_button' => __( 'Remove Entry', 'cmb2_tabs' ),
				'sortable'      => true,
			],
		] );
		// Id's for group's fields only need to be unique for the group. Prefix is not needed.
		$cmb_tabs_demo->add_group_field( $group_field_id, [
			'name'       => __( 'Entry Title', 'cmb2_tabs' ),
			'id'         => 'title',
			'type'       => 'text',
			'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types).
		] );

	}
}
