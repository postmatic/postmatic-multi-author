<?php
/*
	Plugin Name: Multi-Author for Postmatic
	Plugin URI: http://wordpress.org/plugins/postmatic-multi-author/
	Description: Encourage visitors to subscribe to posts by author over sitewide posts.
	License: GPL2+
	Version: 0.1.0
	Author: Dylan Kuhn
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

Postmatic_Multi_Author::get_instance()->load();

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
	public function load() {

	}

}
