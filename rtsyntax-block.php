<?php
/**
 * This file must be required in main plugin file
 *
 * @package rtsyntax
 */

defined( 'ABSPATH' ) || exit;

/**
 * Action to load required css and js files for gutenberg editor
 */
add_action(
	'enqueue_block_editor_assets',
	/**
	 * Enqueues required js and css
	 */
	function () {

		$options = get_option( 'rtsyntax_options' );

		/**
		 * File in which all the blocks are created and converted to normal js
		 */
		wp_enqueue_script(
			'block.build.js',
			plugins_url( '/js/block.build.js', __FILE__ ),
			[ 'jquery', 'wp-blocks', 'wp-i18n', 'wp-element', 'moment' ]
		);

		/**
		 * Default theme file for code editor
		 */
		wp_enqueue_style(
			'highlight',
			plugins_url( '/css/' . $options['theme'] . '.css', __FILE__ )
		);

		/**
		 * List of themes available for user to select
		 * Object will be available inside js at front-end
		 */
		wp_localize_script(
			'block.build.js',
			'highlight_obj',
			[
				'path'  => plugin_dir_url( __FILE__ ),
				'debug' => WP_DEBUG,
			]
		);

	}
);
