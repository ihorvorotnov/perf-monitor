<?php
/**
 * Performance Monitor
 *
 * A handy way to monitor your website performance.
 *
 * @package           PerfMonitor
 * @link              https://github.com/ihorvorotnov/perf-monitor/
 * @author            Ihor Vorotnov <ihor.vorotnov@gmail.com>
 * @copyright         1999-2018 Ihor Vorotnov, PE
 * @license           GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name:       Performance Monitor
 * Plugin URI:        https://github.com/ihorvorotnov/perf-monitor/
 * Support URI:       https://github.com/ihorvorotnov/perf-monitor/issues/
 * Documentation URI: https://github.com/ihorvorotnov/perf-monitor/wiki/
 * Description:       A handy way to monitor your website performance.
 * Version:           0.1.0
 * Author:            Ihor Vorotnov
 * Author URI:        https://ihorvorotnov.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       perf-monitor
 * Domain Path:       /languages
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'PERF_MONITOR_VERSION', '0.1.0' );

/**
 * Enqueue plugin assets.
 *
 * Normally, you would use `wp_enqueue_scripts` hook and force scripts
 * to be loaded in footer. However, styles can't be forced this way
 * and we don't need them in header either. The `get_footer` hook is a
 * workaround that allows to outputs both of them in the site footer.
 */
add_action( 'get_footer', function() {

	wp_enqueue_style(
		'pm-style',
		plugin_dir_url( __FILE__ ) . 'public/assets/pm.css',
		null,
		PERF_MONITOR_VERSION
	);

	wp_enqueue_script(
		'pm-script',
		plugin_dir_url( __FILE__ ) . 'public/assets/pm.js',
		null,
		PERF_MONITOR_VERSION,
		true
	);
} );

/**
 * Add plugin HTML output to the end of the document.
 */
add_action( 'wp_footer', function() {
	require_once __DIR__ . '/public/pm.html';
} );
