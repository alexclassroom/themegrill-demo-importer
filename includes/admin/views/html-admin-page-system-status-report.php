<?php
/**
 * Admin View: Page - System Status
 *
 * @package ThemeGrill_Demo_Importer
 */

defined( 'ABSPATH' ) || exit;

global $wpdb, $wp_rewrite;;
$curl_data = function_exists( 'curl_version' ) ? curl_version() : false;
$gd_data   = function_exists( 'gd_info' ) ? gd_info() : false;
$theme     = wp_get_theme();
?>
<div class="demo-importer-system-status">
	<h2><?php esc_html_e( 'System Status', 'themegrill-demo-importer' ); ?></h2>

	<table class="demo-importer-status-table widefat">
		<thead>
		<tr>
			<th><?php esc_html_e( 'System Info', 'themegrill-demo-importer' ); ?></th>
			<th></th>
			<th></th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td><?php esc_html_e( 'Operating System:', 'themegrill-demo-importer' ); ?></td>
			<td><?php echo esc_html( PHP_OS ); ?></td>
			<td></td>
		</tr>
		<tr>
			<td><?php esc_html_e( 'Server:', 'themegrill-demo-importer' ); ?></td>
			<td><?php echo esc_html( wp_unslash( $_SERVER['SERVER_SOFTWARE'] ) ); ?></td>
			<td></td>
		</tr>
		<tr>
			<td><?php esc_html_e( 'MySQL Version:', 'themegrill-demo-importer' ); ?></td>
			<td><?php echo esc_html( $wpdb->get_var( 'SELECT VERSION()' ) ); ?></td>
			<td></td>
		</tr>
		<tr>
			<td><?php esc_html_e( 'PHP Version:', 'themegrill-demo-importer' ); ?></td>
			<td><?php echo esc_html( PHP_VERSION ); ?></td>
			<td></td>
		</tr>
		<tr>
			<td><?php esc_html_e( 'PHP Max Execution Time:', 'themegrill-demo-importer' ); ?></td>
			<td><?php echo esc_html( ini_get( 'max_execution_time' ) ); ?></td>
			<td></td>
		</tr>
		<tr>
			<td><?php esc_html_e( 'PHP Max Upload Size:', 'themegrill-demo-importer' ); ?></td>
			<td><?php echo esc_html( ini_get( 'upload_max_filesize' ) ); ?></td>
			<td></td>
		</tr>
		<tr>
			<td><?php esc_html_e( 'PHP Post Max Size:', 'themegrill-demo-importer' ); ?></td>
			<td><?php echo esc_html( ini_get( 'post_max_size' ) ); ?></td>
			<td></td>
		</tr>
		<tr>
			<td><?php esc_html_e( 'PHP Max Input Vars:', 'themegrill-demo-importer' ); ?></td>
			<td><?php echo esc_html( ini_get( 'max_input_vars' ) ); ?></td>
			<td></td>
		</tr>
		<tr>
			<td><?php esc_html_e( 'PHP Memory Limit:', 'themegrill-demo-importer' ); ?></td>
			<td><?php echo esc_html( ini_get( 'memory_limit' ) ); ?></td>
			<td></td>
		</tr>
		<tr>
			<td><?php esc_html_e( 'cURL Installed:', 'themegrill-demo-importer' ); ?></td>
			<td><?php extension_loaded( 'curl' ) ? esc_html_e( 'Yes', 'themegrill-demo-importer' ) : esc_html_e( 'No', 'themegrill-demo-importer' ); ?></td>
			<td></td>
		</tr>
		<?php if ( $curl_data ) : ?>
			<tr>
				<td><?php esc_html_e( 'cURL version:', 'themegrill-demo-importer' ); ?></td>
				<td><?php echo esc_html( $curl_data['version'] ); ?></td>
				<td></td>
			</tr>
		<?php endif; ?>
		<tr>
			<td><?php esc_html_e( 'GD Installed:', 'themegrill-demo-importer' ); ?></td>
			<td><?php extension_loaded( 'gd' ) ? esc_html_e( 'Yes', 'themegrill-demo-importer' ) : esc_html_e( 'No', 'themegrill-demo-importer' ); ?></td>
			<td></td>
		</tr>
		<?php if ( $gd_data ) : ?>
			<tr>
				<td><?php esc_html_e( 'GD version:', 'themegrill-demo-importer' ); ?></td>
				<td><?php echo esc_html( $gd_data['GD Version'] ); ?></td>
				<td></td>
			</tr>
		<?php endif; ?>
		<tr>
			<td><?php esc_html_e( 'Write Permission:', 'themegrill-demo-importer' ); ?></td>
			<td><?php echo TG_Demo_Importer_Status::get_write_permission(); ?></td>
			<td></td>
		</tr>
		<tr>
			<td><?php esc_html_e( 'Demo Pack Server Connection:', 'themegrill-demo-importer' ); ?></td>
			<td><?php echo TG_Demo_Importer_Status::get_demo_server_connection_status(); ?></td>
			<td></td>
		</tr>
		</tbody>
	</table>


	<table class="demo-importer-status-table widefat">
		<thead>
		<tr>
			<th><?php esc_html_e( 'WordPress Info', 'themegrill-demo-importer' ); ?></th>
			<th></th>
			<th></th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td><?php esc_html_e( 'Version:', 'themegrill-demo-importer' ); ?></td>
			<td><?php echo esc_html( get_bloginfo( 'version' ) ); ?></td>
			<td></td>
		</tr>
		<tr>
			<td><?php esc_html_e( 'Site URL:', 'themegrill-demo-importer' ); ?></td>
			<td><?php echo esc_html( get_site_url() ); ?></td>
			<td></td>
		</tr>
		<tr>
			<td><?php esc_html_e( 'Home URL:', 'themegrill-demo-importer' ); ?></td>
			<td><?php echo esc_html( get_home_url() ); ?></td>
			<td></td>
		</tr>
		<tr>
			<td><?php esc_html_e( 'Multisite:', 'themegrill-demo-importer' ); ?></td>
			<td><?php is_multisite() ? esc_html_e( 'Yes', 'themegrill-demo-importer' ) : esc_html_e( 'No', 'themegrill-demo-importer' ); ?></td>
			<td></td>
		</tr>
		<tr>
			<td><?php esc_html_e( 'Max Upload Size:', 'themegrill-demo-importer' ); ?></td>
			<td><?php echo esc_html( size_format( wp_max_upload_size() ) ); ?></td>
			<td></td>
		</tr>
		<tr>
			<td><?php esc_html_e( 'Memory Limit:', 'themegrill-demo-importer' ); ?></td>
			<td><?php echo esc_html( WP_MEMORY_LIMIT ); ?></td>
			<td></td>
		</tr>
		<tr>
			<td><?php esc_html_e( 'Max Memory Limit:', 'themegrill-demo-importer' ); ?></td>
			<td><?php echo esc_html( WP_MAX_MEMORY_LIMIT ); ?></td>
			<td></td>
		</tr>
		<tr>
			<td><?php esc_html_e( 'Permalink Structure:', 'themegrill-demo-importer' ); ?></td>
			<td><?php echo '' !== $wp_rewrite->permalink_structure ? esc_html( $wp_rewrite->permalink_structure ) : esc_html__( 'Plain', 'themegrill-demo-importer' ); ?></td>
			<td></td>
		</tr>
		<tr>
			<td><?php esc_html_e( 'Language:', 'themegrill-demo-importer' ); ?></td>
			<td><?php echo esc_html( get_bloginfo( 'language' ) ); ?></td>
			<td></td>
		</tr>
		<tr>
			<td><?php esc_html_e( 'Debug Mode Enabled:', 'themegrill-demo-importer' ); ?></td>
			<td><?php WP_DEBUG ? esc_html_e( 'Yes', 'themegrill-demo-importer' ) : esc_html_e( 'No', 'themegrill-demo-importer' ); ?></td>
			<td></td>
		</tr>
		<tr>
			<td><?php esc_html_e( 'Script Debug Mode Enabled:', 'themegrill-demo-importer' ); ?></td>
			<td><?php SCRIPT_DEBUG ? esc_html_e( 'Yes', 'themegrill-demo-importer' ) : esc_html_e( 'No', 'themegrill-demo-importer' ); ?></td>
			<td></td>
		</tr>
		</tbody>
	</table>


	<table class="demo-importer-status-table widefat">
		<thead>
		<tr>
			<th><?php esc_html_e( 'Theme Info', 'themegrill-demo-importer' ); ?></th>
			<th></th>
			<th></th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td><?php esc_html_e( 'Name:', 'themegrill-demo-importer' ); ?></td>
			<td><?php echo esc_html( $theme->get( 'Name' ) ); ?></td>
			<td></td>
		</tr>
		<tr>
			<td><?php esc_html_e( 'Version:', 'themegrill-demo-importer' ); ?></td>
			<td><?php echo esc_html( $theme->get( 'Version' ) ); ?></td>
			<td></td>
		</tr>
		<tr>
			<td><?php esc_html_e( 'Author:', 'themegrill-demo-importer' ); ?></td>
			<td><?php echo esc_html( $theme->get( 'Author' ) ); ?></td>
			<td></td>
		</tr>
		<tr>
			<td><?php esc_html_e( 'Author URL:', 'themegrill-demo-importer' ); ?></td>
			<td><?php echo esc_html( $theme->get( 'AuthorURI' ) ); ?></td>
			<td></td>
		</tr>
		<tr>
			<td><?php esc_html_e( 'Child Theme:', 'themegrill-demo-importer' ); ?></td>
			<td><?php is_child_theme() ? esc_html_e( 'Yes', 'themegrill-demo-importer' ) : esc_html_e( 'No', 'themegrill-demo-importer' ); ?></td>
			<td>
				<?php
				if ( ! is_child_theme() ) :
					printf(
					/* translators: 1. Opening anchor tag for ThemeGrill Child Tutorial, 2. Closing the anchor tag */
						esc_html__( 'If you want to modify the features of the theme then, we recommend you to use %1$s child theme. %2$s', 'themegrill-demo-importer' ),
						'<a href="https://themegrill.com/blog/tutorial-creating-wordpress-child-theme/" target="_blank">',
						'</a>'
					);
				endif;
				?>
			</td>
		</tr>
		<?php if ( is_child_theme() ) : ?>
			<tr>
				<td><?php esc_html_e( 'Parent Theme Name:', 'themegrill-demo-importer' ); ?></td>
				<td><?php echo esc_html( $theme->parent()->get( 'Name' ) ); ?></td>
				<td></td>
			</tr>
			<tr>
				<td><?php esc_html_e( 'Parent Theme Version:', 'themegrill-demo-importer' ); ?></td>
				<td><?php echo esc_html( $theme->parent()->get( 'Version' ) ); ?></td>
				<td></td>
			</tr>
			<tr>
				<td><?php esc_html_e( 'Parent Theme Author:', 'themegrill-demo-importer' ); ?></td>
				<td><?php echo esc_html( $theme->parent()->get( 'Author' ) ); ?></td>
				<td></td>
			</tr>
			<tr>
				<td><?php esc_html_e( 'Parent Theme Author URL:', 'themegrill-demo-importer' ); ?></td>
				<td><?php echo esc_html( $theme->parent()->get( 'AuthorURI' ) ); ?></td>
				<td></td>
			</tr>
		<?php endif; ?>
		</tbody>
	</table>


	<table class="demo-importer-status-table widefat">
		<thead>
		<tr>
			<th><?php esc_html_e( 'Active Plugins', 'themegrill-demo-importer' ); ?></th>
			<th></th>
			<th></th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		</tbody>
	</table>


	<table class="demo-importer-status-table widefat">
		<thead>
		<tr>
			<th><?php esc_html_e( 'Inactive Plugins', 'themegrill-demo-importer' ); ?></th>
			<th></th>
			<th></th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		</tbody>
	</table>
</div>
