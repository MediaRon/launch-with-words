<?php
/**
 * Helper functions for the plugin.
 *
 * @package launch-with-words
 */

namespace LWW\Includes;

/**
 * Class Functions
 */
class Functions {

	/**
	 * Return the URL to the admin screen
	 *
	 * @param string $tab     Tab path to load.
	 * @param string $sub_tab Subtab path to load.
	 *
	 * @return string URL to admin screen. Output is not escaped.
	 */
	public static function get_settings_url( $tab = '', $sub_tab = '' ) {
		$options_url = admin_url( 'edit.php?page=launch-with-words' );
		if ( ! empty( $tab ) ) {
			$options_url = add_query_arg( array( 'tab' => sanitize_title( $tab ) ), $options_url );
			if ( ! empty( $sub_tab ) ) {
				$options_url = add_query_arg( array( 'subtab' => sanitize_title( $sub_tab ) ), $options_url );
			}
		}
		return $options_url;
	}

	/**
	 * Load an SVG item.
	 *
	 * @param string $svg_slug Slug (filename without extension).
	 * @param array  $args     See defaults below and filter.
	 *
	 * @return string SVG html or empty string on failure.
	 */
	public static function load_svg( $svg_slug, $args ) {
		$default_args = array(
			'alt'          => '',
			'aria_hidden'  => 'true',
			'img_classes'  => array(),
			'link'         => false,
			'href'         => '',
			'link_classes' => array(),
			'link_text'    => '',
			'target'       => '',
		);
		$args         = wp_parse_args( $args, $default_args );

		/**
		 * Filter for overriding arg values
		 *
		 * @since 1.0.0
		 *
		 * @param array  $args     Associative array of arguments.
		 * @param string $svg_slug Slug/filename of the SVG to load.
		 */
		$args = apply_filters( 'lww_load_svg_args', $args, $svg_slug );

		/**
		 * Filter for loading custom SVGs.
		 *
		 * @since 1.0.0
		 *
		 * @param string $path     Relative path to SVG folder.
		 * @param string $svg_slug Slug/filename of the SVG to load.
		 *
		 * @return string SVG Html or empty string.
		 */
		$svg_dir  = apply_filters( 'lww_load_svg_path', '/svgs/', $svg_slug );
		$svg_file = self::get_plugin_dir( $svg_dir . $svg_slug . '.svg' );
		if ( file_exists( $svg_file ) ) {
			$img_classes    = implode( ' ', $args['img_classes'] );
			$anchor_classes = implode( ' ', $args['link_classes'] );
			$img_html       = sprintf(
				'<img src="%s" alt="%s" aria-hidden="%s" class="%s" />',
				esc_url( self::get_plugin_url( $svg_dir . $svg_slug . '.svg' ) ),
				esc_attr( $args['alt'] ),
				esc_attr( $args['aria_hidden'] ),
				esc_attr( $img_classes )
			);
			$anchor_html    = $args['link'] ? sprintf( '<a href="%s" class="%s">%s%s</a>', esc_url( $args['href'] ), esc_attr( $anchor_classes ), wp_kses_post( $img_html ), ! empty( $args['link_text'] ) ? ' ' . esc_html( $args['link_text'] ) : '' ) : '';
			if ( empty( $anchor_html ) ) {
				return $img_html;
			}
			return $anchor_html;
		}
		return '';
	}

	/**
	 * Get the current admin tab.
	 *
	 * @return null|string Current admin tab.
	 */
	public static function get_admin_tab() {
		$tab = filter_input( INPUT_GET, 'tab', FILTER_DEFAULT );
		if ( $tab && is_string( $tab ) ) {
			return sanitize_text_field( sanitize_title( $tab ) );
		}
		return null;
	}

	/**
	 * Get the current admin sub-tab.
	 *
	 * @return null|string Current admin sub-tab.
	 */
	public static function get_admin_sub_tab() {
		$tab = filter_input( INPUT_GET, 'tab', FILTER_DEFAULT );
		if ( $tab && is_string( $tab ) ) {
			$subtab = filter_input( INPUT_GET, 'subtab', FILTER_DEFAULT );
			if ( $subtab && is_string( $subtab ) ) {
				return sanitize_text_field( sanitize_title( $subtab ) );
			}
		}
		return null;
	}

	/**
	 * Return the plugin slug.
	 *
	 * @return string plugin slug.
	 */
	public static function get_plugin_slug() {
		return dirname( plugin_basename( LWW_FILE ) );
	}

	/**
	 * Return the basefile for the plugin.
	 *
	 * @return string base file for the plugin.
	 */
	public static function get_plugin_file() {
		return plugin_basename( LWW_FILE );
	}

	/**
	 * Return the version for the plugin.
	 *
	 * @return float version for the plugin.
	 */
	public static function get_plugin_version() {
		return LWW_VERSION;
	}

	/**
	 * Return the plugin name for the plugin.
	 *
	 * @return string Plugin name.
	 */
	public static function get_plugin_name() {
		/**
		 * Filer the output of the plugin name.
		 *
		 * Potentially change branding of the plugin.
		 *
		 * @since 1.0.0
		 *
		 * @param string Plugin name.
		 */
		return apply_filters( 'lww_plugin_name', __( 'Launch With Words', 'launch-with-words' ) );
	}

	/**
	 * Retrieve the plugin URI.
	 */
	public static function get_plugin_uri() {
		/**
		 * Filer the output of the plugin URI.
		 *
		 * Potentially change branding of the plugin.
		 *
		 * @since 1.0.0
		 *
		 * @param string Plugin URI.
		 */
		return apply_filters( 'lww_plugin_uri', 'https://launchwithwords.com' );
	}

	/**
	 * Retrieve the plugin Menu Name.
	 */
	public static function get_plugin_menu_name() {
		/**
		 * Filer the output of the plugin menu name.
		 *
		 * Potentially change branding of the plugin.
		 *
		 * @since 1.0.0
		 *
		 * @param string Plugin Menu Name.
		 */
		return apply_filters( 'lww_plugin_menu_name', __( 'Launch With Words', 'launch-with-words' ) );
	}

	/**
	 * Retrieve the plugin title.
	 */
	public static function get_plugin_title() {
		/**
		 * Filer the output of the plugin title.
		 *
		 * Potentially change branding of the plugin.
		 *
		 * @since 1.0.0
		 *
		 * @param string Plugin Menu Name.
		 */
		return apply_filters( 'lww_plugin_menu_title', self::get_plugin_name() );
	}

	/**
	 * Returns appropriate html for KSES.
	 *
	 * @param bool $svg Whether to add SVG data to KSES.
	 */
	public static function get_kses_allowed_html( $svg = true ) {
		$allowed_tags = wp_kses_allowed_html();

		$allowed_tags['nav']        = array(
			'class' => array(),
		);
		$allowed_tags['a']['class'] = array();

		if ( ! $svg ) {
			return $allowed_tags;
		}
		$allowed_tags['svg'] = array(
			'xmlns'       => array(),
			'fill'        => array(),
			'viewbox'     => array(),
			'role'        => array(),
			'aria-hidden' => array(),
			'focusable'   => array(),
			'class'       => array(),
		);

		$allowed_tags['path'] = array(
			'd'       => array(),
			'fill'    => array(),
			'opacity' => array(),
		);

		$allowed_tags['g'] = array();

		$allowed_tags['use'] = array(
			'xlink:href' => array(),
		);

		$allowed_tags['symbol'] = array(
			'aria-hidden' => array(),
			'viewBox'     => array(),
			'id'          => array(),
			'xmls'        => array(),
		);

		return $allowed_tags;
	}

	/**
	 * Get the plugin directory for a path.
	 *
	 * @param string $path The path to the file.
	 *
	 * @return string The new path.
	 */
	public static function get_plugin_dir( $path = '' ) {
		$dir = rtrim( plugin_dir_path( LWW_FILE ), '/' );
		if ( ! empty( $path ) && is_string( $path ) ) {
			$dir .= '/' . ltrim( $path, '/' );
		}
		return $dir;
	}

	/**
	 * Return a plugin URL path.
	 *
	 * @param string $path Path to the file.
	 *
	 * @return string URL to to the file.
	 */
	public static function get_plugin_url( $path = '' ) {
		$dir = rtrim( plugin_dir_url( LWW_FILE ), '/' );
		if ( ! empty( $path ) && is_string( $path ) ) {
			$dir .= '/' . ltrim( $path, '/' );
		}
		return $dir;
	}

	/**
	 * Gets the highest priority for a filter.
	 *
	 * @param int $subtract The amount to subtract from the high priority.
	 *
	 * @return int priority.
	 */
	public static function get_highest_priority( $subtract = 0 ) {
		$highest_priority = PHP_INT_MAX;
		$subtract         = absint( $subtract );
		if ( 0 === $subtract ) {
			--$highest_priority;
		} else {
			$highest_priority = absint( $highest_priority - $subtract );
		}
		return $highest_priority;
	}
}

