<?php
/**
 * Custom Post Types
 *
 * @package  WordPress
 * @internal https://github.com/WordPress-Phoenix/proof-of-concept-custom-post-type-permalinked-to-taxonomy/blob/master/proof-of-concept-custom-post-type-permalinked-to-taxonomy.php
 */

namespace Brand_Review\CRM;

/**
 * Class Custom_Post_Types
 *
 * @package Brand_Review\CRM
 */
class Custom_Post_Types {
	public static $cpt_name = 'review_product';
	public static $tax_name = 'product_type';
	public static $link_by = 'type';

	/**
	 * Custom_Post_Types constructor.
	 *
	 * @param array $args
	 */
	function __construct( $args = [] ) {
		add_action( 'init', [ static::class, 'create_custom_tax' ] );
		add_action( 'init', [ static::class, 'create_custom_post_type' ] );
		add_filter( 'post_type_link', [ static::class, 'proper_custom_permalinks' ], 10, 2 );
	}

	/**
	 * Register the custom post type to create it
	 */
	static function create_custom_post_type() {
		$labels = [
			'name'          => static::$cpt_name,
			'singular_name' => static::$cpt_name,
		];
		$args   = [
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'query_var'          => true,
			'capability_type'    => 'post',
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => [ 'title', 'editor', 'thumbnail', 'excerpt' ],
			'rewrite'            => [
				'slug'       => static::$link_by . '/%' . static::$tax_name . '%',
				'with_front' => false,
			],
			'has_archive'        => static::$link_by,
		];
		register_post_type( static::$cpt_name, $args );
	}

	/**
	 * Creates the awesome linking between CPT and TAX
	 * ie http://local.wordpress.dev/events/awesome-seo/seo-proper-custom-post-event/
	 *
	 * @param $post_link
	 * @param $post
	 *
	 * @return mixed
	 */
	static function proper_custom_permalinks( $post_link, $post ) {
		if ( false !== strpos( $post_link, '%' . static::$tax_name . '%' ) ) {
			$event_type_term = get_the_terms( $post->ID, static::$tax_name );
			$post_link       = str_replace( '%' . static::$tax_name . '%', array_pop( $event_type_term )->slug, $post_link );
		}

		return $post_link;
	}

	/**
	 * Build custom taxonomy for CPT.
	 */
	static function create_custom_tax() {
		register_taxonomy(
			static::$tax_name,
			static::$cpt_name,
			[
				'label'          => static::$tax_name,
				'singular_label' => static::$tax_name,
				'hierarchical'   => true,
				'query_var'      => true,
				'rewrite'        => [ 'slug' => static::$link_by ],
			]
		);
	}
}
