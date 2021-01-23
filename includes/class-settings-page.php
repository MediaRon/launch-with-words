<?php
/**
 * Helper functions for the plugin.
 *
 * @package Launch With Words
 */

namespace LWW\Includes;

/**
 * Class Functions
 */
class Settings_Page {
	/**
	 * Registers and outputs placeholder for settings.
	 *
	 * @since 1.0.0
	 */
	public static function settings_page() {
		?>
		<div class="wrap lww-settings-header">
			<?php
			self::get_settings_header();
			?>
		</div>
		<div class="wrap lww-settings-tabs">
			<?php
			self::get_settings_tabs();
			?>
		</div>
		<?php
		self::get_settings_footer();
		?>
		<?php
	}

	/**
	 * Output Generic Settings Place holder for React goodness.
	 */
	public static function get_settings_header() {
		self::get_admin_header();
		?>
		<div id="lww-plugin-header">
			<div id="lww-plugin-logo">
				<a href="<?php echo esc_url( Functions::get_settings_url() ); ?>">
					<img src="<?php echo esc_url( Functions::get_plugin_url( '/assets/launch-with-words-logo.png' ) ); ?>" alt="Launch With Words Logo" />
				</a>
			</div>
		</div>
		<?php
	}

	/**
	 * Get the admin footer.
	 */
	public static function get_admin_header() {
		// Make sure we enqueue on the right admin screen.
		$screen = get_current_screen();
		if ( ! isset( $screen->id ) ) {
			return;
		}
		if ( 'posts_page_launch-with-words' !== $screen->id ) {
			return;
		}
		?>
		<svg width="0" height="0" class="hidden">
			<symbol aria-hidden="true" data-prefix="fas" data-icon="home-heart" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" id="home-heart">
				<g class="fa-group"><path class="fa-secondary" fill="currentColor" d="M64.11 311.38V496a16.05 16.05 0 0 0 16 16h416a16.05 16.05 0 0 0 16-16V311.38c-6.7-5.5-44.7-38.31-224-196.4-180.11 158.9-217.6 191.09-224 196.4zm314.1-26.31a60.6 60.6 0 0 1 4.5 89.11L298 459.77a13.94 13.94 0 0 1-19.8 0l-84.7-85.59a60.66 60.66 0 0 1 4.3-89.11c24-20 59.7-16.39 81.6 5.81l8.6 8.69 8.6-8.69c22.01-22.2 57.71-25.81 81.61-5.81z" opacity="0.4"></path><path class="fa-primary" fill="currentColor" d="M378.21 285.07c-23.9-20-59.6-16.39-81.6 5.81l-8.6 8.69-8.6-8.69c-21.9-22.2-57.6-25.81-81.6-5.81a60.66 60.66 0 0 0-4.3 89.11l84.7 85.59a13.94 13.94 0 0 0 19.8 0l84.7-85.59a60.6 60.6 0 0 0-4.5-89.11zm192.6-48.8l-58.7-51.79V48a16 16 0 0 0-16-16h-64a16 16 0 0 0-16 16v51.7l-101.3-89.43a40 40 0 0 0-53.5 0l-256 226a16 16 0 0 0-1.2 22.61l21.4 23.8a16 16 0 0 0 22.6 1.2l229.4-202.2a16.12 16.12 0 0 1 21.2 0L528 284a16 16 0 0 0 22.6-1.21L572 259a16.11 16.11 0 0 0-1.19-22.73z"></path></g>
			</symbol>
			<symbol aria-hidden="true" data-prefix="fas" data-icon="file-import" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" id="file-import">
				<g class="fa-group"><path class="fa-secondary" fill="currentColor" d="M512 488v.12A23.94 23.94 0 0 1 488 512H151.88A23.94 23.94 0 0 1 128 488V352h127.63v64.9c0 14.27 17.28 21.34 27.37 11.27L378.56 332a17 17 0 0 0 0-23.93l-95.49-96.25c-10.09-10.07-27.37-3-27.37 11.27v65H128V23.88A23.94 23.94 0 0 1 152 0h232v112a16 16 0 0 0 16 16h112z" opacity="0.4"></path><path class="fa-primary" fill="currentColor" d="M505 105L407.1 7a24 24 0 0 0-17-7H384v112a16 16 0 0 0 16 16h112v-6.1a23.9 23.9 0 0 0-7-16.9zM283.07 211.82c-10.09-10.07-27.37-3-27.37 11.27v65H16a16 16 0 0 0-16 16V336a16 16 0 0 0 16 16h239.63v64.9c0 14.27 17.28 21.34 27.37 11.27L378.56 332a17 17 0 0 0 0-23.93z"></path></g>
			</symbol>
			<?php do_action( 'lww_add_admin_header_content' ); ?>
		<?php
	}
	/**
	 * Output the top-level admin tabs.
	 */
	public static function get_settings_tabs() {
		$settings_url_base = Functions::get_settings_url( 'home' )
		?>
			<?php
			$tabs = array();
			/**
			 * Filer the output of the tab output.
			 *
			 * Potentially modify or add your own tabs.
			 *
			 * @since 1.0.0
			 *
			 * @param array $tabs Associative array of tabs.
			 */
			$tabs       = apply_filters( 'lww_admin_tabs', $tabs );
			$tab_html   = '<nav class="nav-tab-wrapper">';
			$tabs_count = count( $tabs );
			if ( $tabs && ! empty( $tabs ) && is_array( $tabs ) ) {
				$active_tab = Functions::get_admin_tab();
				if ( null === $active_tab ) {
					$active_tab = 'home';
				}
				$is_tab_match = false;
				if ( 'home' === $active_tab ) {
					$active_tab = 'home';
				} else {
					foreach ( $tabs as $tab ) {
						$tab_get = isset( $tab['get'] ) ? $tab['get'] : '';
						if ( $active_tab === $tab_get ) {
							$is_tab_match = true;
						}
					}
					if ( ! $is_tab_match ) {
						$active_tab = 'home';
					}
				}
				$do_action = false;
				foreach ( $tabs as $tab ) {
					$classes = array( 'nav-tab' );
					$tab_get = isset( $tab['get'] ) ? $tab['get'] : '';
					if ( $active_tab === $tab_get ) {
						$classes[] = 'nav-tab-active';
						$do_action = isset( $tab['action'] ) ? $tab['action'] : false;
					} elseif ( ! $is_tab_match && 'dashboard' === $tab_get ) {
						$classes[] = 'nav-tab-active';
						$do_action = isset( $tab['action'] ) ? $tab['action'] : false;
					}
					$tab_url   = isset( $tab['url'] ) ? $tab['url'] : '';
					$tab_label = isset( $tab['label'] ) ? $tab['label'] : '';
					$tab_html .= sprintf(
						'<a href="%s" class="%s" id="eff-%s"><svg class="lww-icon lww-icon-tab">%s</svg><span>%s</span></a>',
						esc_url( $tab_url ),
						esc_attr( implode( ' ', $classes ) ),
						esc_attr( $tab_get ),
						sprintf( '<use xlink:href="#%s"></use>', esc_attr( $tab['icon'] ) ),
						esc_html( $tab['label'] )
					);
				}
				$tab_html .= '</nav>';
				if ( $tabs_count > 0 ) {
					echo wp_kses( $tab_html, Functions::get_kses_allowed_html() );
				}

				$current_tab     = Functions::get_admin_tab();
				$current_sub_tab = Functions::get_admin_sub_tab();

				/**
				 * Filer the output of the sub-tab output.
				 *
				 * Potentially modify or add your own sub-tabs.
				 *
				 * @since 1.0.0
				 *
				 * @param array Associative array of tabs.
				 * @param string Tab
				 * @param string Sub Tab
				 */
				$sub_tabs = apply_filters( 'lww_admin_sub_tabs', array(), $current_tab, $current_sub_tab );

				// Check to see if no tabs are available for this view.
				if ( null === $current_tab && null === $current_sub_tab ) {
					$current_tab = 'home';
				}
				if ( $sub_tabs && ! empty( $sub_tabs ) && is_array( $sub_tabs ) ) {
					if ( null === $current_sub_tab ) {
						$current_sub_tab = '';
					}
					$is_tab_match      = false;
					$first_sub_tab     = current( $sub_tabs );
					$first_sub_tab_get = $first_sub_tab['get'];
					if ( $first_sub_tab_get === $current_sub_tab ) {
						$active_tab = $current_sub_tab;
					} else {
						$active_tab = $current_sub_tab;
						foreach ( $sub_tabs as $tab ) {
							$tab_get = isset( $tab['get'] ) ? $tab['get'] : '';
							if ( $active_tab === $tab_get ) {
								$is_tab_match = true;
							}
						}
						if ( ! $is_tab_match ) {
							$active_tab = $first_sub_tab_get;
						}
					}
					$sub_tab_html_array = array();
					$do_subtab_action   = false;
					$maybe_sub_tab      = '';
					foreach ( $sub_tabs as $sub_tab ) {
						$classes = array( 'lww-sub-tab' );
						$tab_get = isset( $sub_tab['get'] ) ? $sub_tab['get'] : '';
						if ( $active_tab === $tab_get ) {
							$classes[]        = 'lww-sub-tab-active';
							$do_subtab_action = true;
							$current_sub_tab  = $tab_get;
						} elseif ( ! $is_tab_match && $first_sub_tab_get === $tab_get ) {
							$classes[]        = 'lww-sub-tab-active';
							$do_subtab_action = true;
							$current_sub_tab  = $first_sub_tab_get;
						}
						$tab_url   = isset( $sub_tab['url'] ) ? $sub_tab['url'] : '';
						$tab_label = isset( $sub_tab['label'] ) ? $sub_tab['label'] : '';
						if ( $current_sub_tab === $tab_get ) {
							$sub_tab_html_array[] = sprintf( '<span class="%s" id="lww-tab-%s">%s</span>', esc_attr( implode( ' ', $classes ) ), esc_attr( $tab_get ), esc_html( $sub_tab['label'] ) );
						} else {
							$sub_tab_html_array[] = sprintf( '<a href="%s" class="%s" id="lww-tab-%s">%s</a>', esc_url( $tab_url ), esc_attr( implode( ' ', $classes ) ), esc_attr( $tab_get ), esc_html( $sub_tab['label'] ) );
						}
					}
					if ( ! empty( $sub_tab_html_array ) ) {
						echo '<nav class="lww-sub-links">' . wp_kses_post( rtrim( implode( ' | ', $sub_tab_html_array ), ' | ' ) ) . '</nav>';
					}
					if ( $do_subtab_action ) {
						/**
						 * Perform a sub tab action.
						 *
						 * Perform a sub tab action. Useful for loading scripts or inline styles as necessary.
						 *
						 * @since 1.0.0
						 *
						 * eff_admin_sub_tab_{current_tab}_{current_sub_tab}
						 * @param string Sub Tab
						 */
						do_action(
							sprintf( // phpcs:ignore
								'lww_admin_sub_tab_%s_%s',
								sanitize_title( $current_tab ),
								sanitize_title( $current_sub_tab )
							)
						);
					}
				}
				if ( $do_action ) {

					/**
					 * Perform a tab action.
					 *
					 * Perform a tab action.
					 *
					 * @since 1.0.0
					 *
					 * @param string $action Can be any action.
					 * @param string Tab
					 * @param string Sub Tab
					 */
					do_action( $do_action, $current_tab, $current_sub_tab );
				}
			}
			?>
		<?php
	}

	/**
	 * Run script and enqueue stylesheets and stuff like that.
	 */
	public static function get_settings_footer() {
		// Do settings footer stuff here.
	}
}
