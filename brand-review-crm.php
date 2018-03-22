<?php
/**
 * Brand Review CRM
 *
 * @wordpress-plugin
 * @package     Brand_review_crm
 * @author      Seth Carstens - Brand Reviews Team
 * @license     GNU GPL v2.0+
 * @link        https://brandreviewcrm.com
 * @version     0.1.0
 *
 * Built with WP PHX WordPress Development Toolkit v3.0.4 on Thursday 22nd of March 2018 04:13:11 AM
 * @link        https://github.com/WordPress-Phoenix/wordpress-development-toolkit
 *
 * Plugin Name: Brand Review CRM
 * Plugin URI: https://brandreviewcrm.com
 * Description: Plugin that enables a CRM system for vendors seeking reviews that are managing free or refunded
 * products. Version: 0.1.0 Author: Seth Carstens  - Brand Reviews Team Text Domain: brand-review-crm License: GNU GPL
 * v2.0+
 */

if ( ! function_exists( 'add_filter' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit(); /* protects plugin source from public view */
}

$current_dir = trailingslashit( dirname( __FILE__ ) );

/**
 * 3RD PARTY DEPENDENCIES
 * (manually include_once dependencies installed via composer for safety)
 */
if ( ! class_exists( 'WPAZ_Plugin_Base\\V_2_6\\Abstract_Plugin' ) ) {
	include_once $current_dir . 'lib/wordpress-phoenix/abstract-plugin-base/src/abstract-plugin.php';
}

/**
 * INTERNAL DEPENDENCIES (autoloader defined in main plugin class)
 */
include_once $current_dir . 'app/class-plugin.php';

Brand_Review\CRM\Plugin::run( __FILE__ );
