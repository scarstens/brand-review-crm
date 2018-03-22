<?php
/**
 * Main Plugin file.
 *
 * @package WordPress
 */

namespace Brand_Review\CRM;

use Brand_Review\CRM\Admin;
use WPAZ_Plugin_Base\V_2_6\Abstract_Plugin;

/**
 * Class Plugin
 *
 * @package Brand_review_crm
 */
class Plugin extends Abstract_Plugin {

	/**
	 * Use magic constant to tell abstract class current namespace as prefix for all other namespaces in the plugin.
	 *
	 * @var string $autoload_class_prefix magic constant
	 */
	public static $autoload_class_prefix = __NAMESPACE__;

	/**
	 * Prefix for plugins actions and filters.
	 *
	 * @var string
	 */
	public static $action_prefix = 'brand_review_crm_';

	/**
	 * Magic constant trick that allows extended classes to pull actual server file location, copy into subclass.
	 *
	 * @var string $current_file
	 */
	protected static $current_file = __FILE__;

	/**
	 * Initialize the plugin - for public (front end)
	 *
	 * @param mixed $instance Parent instance passed through to child.
	 *
	 * @return  void
	 */
	public function onload( $instance ) {

		/**
		 * Load CMB2
		 */
		if ( file_exists( dirname( $this->plugin_file ) . '/lib/cmb2/init.php' ) ) {
			require_once dirname( $this->plugin_file ) . '/lib/cmb2/init.php';
		} elseif ( file_exists( dirname( $this->plugin_file ) . '/lib/CMB2/init.php' ) ) {
			require_once dirname( $this->plugin_file ) . '/lib/CMB2/init.php';
		}

		/**
		 * Load CMB2 Tabs
		 */
		if ( file_exists( dirname( $this->plugin_file ) . '/lib/cmb2-extensions/cmb2-tabs/cmb2-tabs.php' ) ) {
			require_once dirname( $this->plugin_file ) . '/lib/cmb2-extensions/cmb2-tabs/cmb2-tabs.php';
		}

		$this->modules->cpts = new Custom_Post_Types();

		Custom_Content_Meta::register_meta_boxes();
	}

	/**
	 * Initialize public / shared functionality using new Class(), add_action() or add_filter().
	 */
	public function init() {
		do_action( static::$action_prefix . 'before_init' );
		do_action( static::$action_prefix . 'after_init' );
	}

	/**
	 * Initialize functionality only loaded for logged-in users.
	 */
	public function authenticated_init() {
		if ( is_user_logged_in() ) {
			do_action( static::$action_prefix . 'before_authenticated_init' );
			// $this->admin is in the abstract plugin base class
			$this->admin = new Admin\App(
				$this->installed_dir,
				$this->installed_url,
				$this->version
			);
			do_action( static::$action_prefix . 'after_authenticated_init' );
		}
	}

	/**
	 * @return mixed|void
	 */
	protected function defines_and_globals() {
	}

} // END class Plugin
