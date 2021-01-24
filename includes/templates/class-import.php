<?php
/**
 * Register the import tab and any sub-tabs.
 *
 * @package Launch With Words
 */

namespace LWW\Includes\Templates;

use LWW\Includes\Functions as Functions;

/**
 * Output the import tab and content.
 */
class Import {
	/**
	 * Constructor.
	 */
	public function __construct() {
		add_filter( 'lww_admin_tabs', array( $this, 'add_import_tab' ), 1, 1 );
		add_filter( 'lww_admin_sub_tabs', array( $this, 'add_import_main_sub_tab' ), 1, 3 );
		add_filter( 'lww_output_import', array( $this, 'output_import_content' ), 1, 3 );
	}

	/**
	 * Add the imoort tab and callback actions.
	 *
	 * @param array $tabs Array of tabs.
	 *
	 * @return array of tabs.
	 */
	public function add_import_tab( $tabs ) {
		$tabs[] = array(
			'get'    => 'import',
			'action' => 'lww_output_import',
			'url'    => Functions::get_settings_url( 'import' ),
			'label'  => _x( 'Import Content Pack', 'Tab label as Import Content Pack', 'launch-with-words' ),
			'icon'   => 'file-import',
		);
		return $tabs;
	}

	/**
	 * Add the import main tab and callback actions.
	 *
	 * @param array  $tabs        Array of tabs.
	 * @param string $current_tab The current tab selected.
	 * @param string $sub_tab     The current sub-tab selected.
	 *
	 * @return array of tabs.
	 */
	public function add_import_main_sub_tab( $tabs, $current_tab, $sub_tab ) {
		return $tabs;
	}

	/**
	 * Begin Home routing for the various outputs.
	 */
	public function output_import_content( $tab, $sub_tab = '' ) {
		if ( 'import' === $tab ) {
			if ( empty( $sub_tab ) || 'import' === $sub_tab ) {
				if ( isset( $_POST['submit'] ) ) {
					check_admin_referer( 'import-lww', 'import_lww' );
					echo 'HI';
				}
				?>
				<div id="lww-import-options">
					<h2><?php esc_html_e( 'Import Launch With Words Content Packs', 'launch-with-words' ); ?></h2>
					<form action="<?php echo esc_url( Functions::get_settings_url( 'import' ) ); ?>" method="post" enctype="multipart/form-data">
					<?php
						wp_nonce_field( 'import-lww', 'import_lww' );
					?>
					<table class="form-table" role="presentation">
						<tbody>
							<tr class="launch-with-words-authors">
								<th scope="row"><?php esc_html_e( 'Content Author', 'launch-with-words' ); ?></th>
								<td>
									<select name="lww-user">
									<?php
										$authors = new \WP_User_Query(
											array(
												'role__in' => array(
													'author',
													'editor',
													'administrator',
												),
											)
										);
									foreach ( $authors->get_results() as $author ) {
										?>
											<option value="<?php echo absint( $author->ID ); ?>"><?php echo esc_html( $author->display_name ); ?></option>
											<?php
									}
									?>

									</select>
								</td>
							</tr>
							<tr class="launch-with-words-blog-categories">
								<th scope="row"><?php esc_html_e( 'Blog Category', 'launch-with-words' ); ?></th>
								<td>
									<select name="lww-category">
									<?php
										$terms = get_terms(
											array(
												'taxonomy' => 'category',
												'hide_empty' => false,
											)
										);
									foreach ( $terms as $term ) {
										?>
											<option value="<?php echo absint( $term->term_id ); ?>"><?php echo esc_html( $term->name ); ?></option>
											<?php
									}
									?>

									</select>
								</td>
							</tr>
							<tr class="launch-with-words-blog-upload">
								<th scope="row">
									<label for="lww-file">
										<?php esc_html_e( 'Import File', 'launch-with-words' ); ?>
									</label>
								</th>
								<td>
									<input type="file" value="" name="lww-file" id="lww-file" />
								</td>
							</tr>
						</tbody>
					</table>
					<?php
						submit_button(
							__( 'Import', 'launch-with-words' ),
							'submit',
							'submit'
						);
					?>
					</form>
				</div>
				<?php
			}
		}
	}
}
