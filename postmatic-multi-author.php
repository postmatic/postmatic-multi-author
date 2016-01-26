<?php
/*
	Plugin Name: Multi-Author for Postmatic
	Plugin URI: http://wordpress.org/plugins/postmatic-multi-author/
	Description: Power up Postmatic with enhancements for multi-author blogs.
	License: GPL2+
	Version: 0.1.0
	Author: Postmatic
	Author URI: https://gopostmatic.com/
	Minimum WordPress Version Required: 3.9
*/

/*
  Copyright (c) 2016 Transitive, Inc

  This program is free software; you can redistribute it
  and/or modify it under the terms of the GNU General Public
  License as published by the Free Software Foundation;
  either version 2 of the License, or (at your option) any
  later version.

  This program is distributed in the hope that it will be
  useful, but WITHOUT ANY WARRANTY; without even the implied
  warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR
  PURPOSE. See the GNU General Public License for more
  details.
 */

// We should only be loaded by WordPress. Abort if called directly.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// One hook begets another - we'll do nothing unless Postmatic is in use
add_action( 'prompt/hooks_added', array( Postmatic_Multi_Author::get_instance(), 'add_hooks' ) );

/**
 * Main Postmatic Multi-Author singleton
 *
 * @since 0.1
 */
class Postmatic_Multi_Author {

	/**
	 * @since 0.1.0
	 * @var Postmatic_Multi_Author
	 */
	protected static $instance = null;

	/**
	 * @since 0.1.0
	 * @return Postmatic_Multi_Author
	 */
	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Protected constructor for singletonity.
	 */
	protected function __construct() {
	}

	/**
	 * @since 0.1.0
	 */
	public function add_hooks() {
		add_filter( 'prompt/subscribe_widget_object', array( $this, 'filter_subscribe_widget_object' ) );
		add_filter( 'widget_title', array( $this, 'filter_widget_title' ), 10, 2 );
	}

	/**
	 * Change the subscribe widget object to post author on single post views.
	 *
	 * @since 0.1.0
	 * @param object $object The current widget target object
	 * @return object
	 */
	public function filter_subscribe_widget_object( $object ) {

		if ( ! is_single() ) {
			return $object;
		}

		$post = get_queried_object();

		return get_user_by( 'id', $post->post_author );
	}

	/**
	 * Change the subscribe widget title when the target list is an author.
	 *
	 * @since 0.1.0
	 * @param string $title
	 * @param array $instance
	 * @return string
	 */
	public function filter_widget_title( $title, $instance ) {

		if ( ! isset( $instance['list'] ) or ! $instance['list'] instanceof Prompt_User ) {
			return $title;
		}

		return sprintf( 'Subscribe to new posts by %s', $instance['list']->get_wp_user()->display_name );
	}
}
