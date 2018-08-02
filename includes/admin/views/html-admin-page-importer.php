<?php
/**
 * Admin View: Page - Importer
 *
 * @package Importer
 */

defined( 'ABSPATH' ) || exit;

$feature_lists = apply_filters( 'themegrill_demo_importer_feature_lists', array(
	'pagebuilder' => array(
		'name'  => __( 'Pagebuilder', 'themegrill-demo-importer' ),
		'lists' => array(
			'elementor'  => __( 'Elementor', 'themegrill-demo-importer' ),
			'siteorigin' => __( 'SiteOrigin', 'themegrill-demo-importer' ),
		)
	)
) );

?>
<div class="wrap demo-importer">
	<h1 class="wp-heading-inline"><?php esc_html_e( 'Demo Importer', 'themegrill-demo-importer' ); ?></h1>

	<?php if ( apply_filters( 'themegrill_demo_importer_upcoming_demos', true ) ) : ?>
		<a href="<?php echo esc_url( 'https://themegrill.com/upcoming-demos' ); ?>" class="page-title-action" target="_blank"><?php esc_html_e( 'Upcoming Demos', 'themegrill-demo-importer' ); ?></a>
	<?php endif; ?>

	<hr class="wp-header-end">

	<div class="error hide-if-js">
		<p><?php _e( 'The Demo Importer screen requires JavaScript.', 'themegrill-demo-importer' ); ?></p>
	</div>

	<h2 class="screen-reader-text hide-if-no-js"><?php _e( 'Filter demos list', 'themegrill-demo-importer' ); ?></h2>

	<div class="wp-filter hide-if-no-js">
		<div class="filter-count">
			<span class="count theme-count demo-count"></span>
		</div>

		<ul class="filter-links">
			<?php foreach ( $packages->category as $slug => $label ) : ?>
				<li><a href="#" data-sort="<?php echo esc_attr( $slug ); ?>" class="demo-tab"><?php echo esc_html( $label ); ?></a></li>
			<?php endforeach; ?>
		</ul>

		<button type="button" class="button drawer-toggle" aria-expanded="false"><?php _e( 'Feature Filter', 'themegrill-demo-importer' ); ?></button>

		<form class="search-form"></form>

		<div class="filter-drawer">
			<div class="buttons">
				<button type="button" class="apply-filters button"><?php _e( 'Apply Filters', 'themegrill-demo-importer' ); ?><span></span></button>
				<button type="button" class="clear-filters button" aria-label="<?php esc_attr_e( 'Clear current filters', 'themegrill-demo-importer' ); ?>"><?php _e( 'Clear', 'themegrill-demo-importer' ); ?></button>
			</div>
			<?php
			foreach ( $feature_lists as $feature_key => $features ) {
				echo '<fieldset class="filter-group">';
				$feature_name = esc_html( $features['name'] );
				echo '<legend>' . $feature_name . '</legend>';
				echo '<div class="filter-group-feature">';
				foreach ( $features['lists'] as $feature => $feature_name ) {
					$feature = esc_attr( $feature );
					echo '<input type="checkbox" id="filter-id-' . $feature . '" value="' . $feature . '" /> ';
					echo '<label for="filter-id-' . $feature . '">' . $feature_name . '</label>';
				}
				echo '</div>';
				echo '</fieldset>';
			}
			?>
			<div class="buttons">
				<button type="button" class="apply-filters button"><?php _e( 'Apply Filters', 'themegrill-demo-importer' ); ?><span></span></button>
				<button type="button" class="clear-filters button" aria-label="<?php esc_attr_e( 'Clear current filters', 'themegrill-demo-importer' ); ?>"><?php _e( 'Clear', 'themegrill-demo-importer' ); ?></button>
			</div>
			<div class="filtered-by">
				<span><?php _e( 'Filtering by:', 'themegrill-demo-importer' ); ?></span>
				<div class="tags"></div>
				<button type="button" class="button-link edit-filters"><?php _e( 'Edit Filters', 'themegrill-demo-importer' ); ?></button>
			</div>
		</div>
	</div>
	<h2 class="screen-reader-text hide-if-no-js"><?php _e( 'Themes list', 'themegrill-demo-importer' ); ?></h2>
	<div class="theme-browser content-filterable"></div>
	<div class="theme-install-overlay wp-full-overlay expanded"></div>

	<p class="no-themes"><?php _e( 'No demos found. Try a different search.', 'themegrill-demo-importer' ); ?></p>
	<span class="spinner"></span>
</div>

<script id="tmpl-demo" type="text/template">
	<# if ( data.screenshot_url ) { #>
		<div class="theme-screenshot">
			<img src="{{ data.screenshot_url }}" alt="" />
		</div>
	<# } else { #>
		<div class="theme-screenshot blank"></div>
	<# } #>

	<# if ( data.banner ) { #>
		<span class="premium-demo-banner"><?php _e( 'Pro', 'themegrill-demo-importer' ); ?></span>
	<# } #>

	<span class="more-details"><?php _ex( 'Details &amp; Preview', 'demo', 'themegrill-demo-importer' ); ?></span>
	<div class="theme-author">
		<?php
		/* translators: %s: Demo author name */
		printf( __( 'By %s', 'themegrill-demo-importer' ), '{{{ data.author }}}' );
		?>
	</div>

	<div class="theme-id-container">
		<h3 class="theme-name">{{ data.name }}</h3>

		<div class="theme-actions">
			<# if ( data.active ) { #>
				<a class="button button-primary live-preview" target="_blank" href="{{{ data.actions.preview }}}"><?php _e( 'Live Preview', 'themegrill-demo-importer' ); ?></a>
			<# } else { #>
				<# if ( ! _.isEmpty( data.hasNotice ) ) { #>
					<# if ( data.hasNotice['required_theme'] ) { #>
						<a class="button button-primary hide-if-no-js tips demo-import disabled" href="#" data-name="{{ data.name }}" data-slug="{{ data.id }}" data-tip="<?php echo esc_attr( sprintf( __( 'Required %s theme must be activated to import this demo.', 'themegrill-demo-importer' ), '{{{ data.theme }}}' ) ); ?>"><?php _e( 'Import', 'themegrill-demo-importer' ); ?></a>
					<# } else if ( data.hasNotice['required_plugins'] ) { #>
						<a class="button button-primary hide-if-no-js tips demo-import disabled" href="#" data-name="{{ data.name }}" data-slug="{{ data.id }}" data-tip="<?php echo esc_attr( 'Required Plugin must be activated to import this demo.', 'themegrill-demo-importer' ); ?>"><?php _e( 'Import', 'themegrill-demo-importer' ); ?></a>
					<# } #>
				<# } else { #>
					<?php
					/* translators: %s: Demo name */
					$aria_label = sprintf( _x( 'Import %s', 'demo', 'themegrill-demo-importer' ), '{{ data.name }}' );
					?>
					<a class="button button-primary hide-if-no-js demo-import" href="#" data-name="{{ data.name }}" data-slug="{{ data.id }}" aria-label="<?php echo $aria_label; ?>"><?php _e( 'Import', 'themegrill-demo-importer' ); ?></a>
				<# } #>
				<button class="button preview install-demo-preview"><?php _e( 'Preview', 'themegrill-demo-importer' ); ?></button>
			<# } #>
		</div>
	</div>

	<# if ( data.imported ) { #>
		<div class="notice notice-success notice-alt"><p><?php _ex( 'Imported', 'demo', 'themegrill-demo-importer' ); ?></p></div>
	<# } #>
</script>

<script id="tmpl-demo-preview" type="text/template">
	<div class="wp-full-overlay-sidebar">
		<div class="wp-full-overlay-header">
			<button class="close-full-overlay"><span class="screen-reader-text"><?php _e( 'Close', 'themegrill-demo-importer' ); ?></span></button>
			<button class="previous-theme"><span class="screen-reader-text"><?php _ex( 'Previous', 'Button label for a demo', 'themegrill-demo-importer' ); ?></span></button>
			<button class="next-theme"><span class="screen-reader-text"><?php _ex( 'Next', 'Button label for a demo', 'themegrill-demo-importer' ); ?></span></button>
			<# if ( data.installed ) { #>
				<a class="button button-primary activate" href="{{ data.activate_url }}"><?php _e( 'Activate', 'themegrill-demo-importer' ); ?></a>
			<# } else { #>
				<a href="{{ data.install_url }}" class="button button-primary demo-install" data-name="{{ data.name }}" data-slug="{{ data.id }}"><?php _e( 'Import', 'themegrill-demo-importer' ); ?></a>
			<# } #>
		</div>
		<div class="wp-full-overlay-sidebar-content">
			<div class="install-theme-info">
				<h3 class="theme-name">
					{{ data.name }}
					<# if ( data.banner ) { #>
						<span class="premium-demo-tag"><?php _e( 'Pro', 'themegrill-demo-importer' ); ?></span>
					<# } #>
				</h3>

				<span class="theme-by">
					<?php
					/* translators: %s: Demo author name */
					printf( __( 'By %s', 'themegrill-demo-importer' ), '{{ data.author }}' );
					?>
				</span>

				<img class="theme-screenshot" src="{{ data.screenshot_url }}" alt="" />

				<div class="theme-details">
					<div class="theme-version">
						<?php
						/* translators: %s: Demo version */
						printf( __( 'Version: %s', 'themegrill-demo-importer' ), '{{ data.version }}', 'themegrill-demo-importer' );
						?>
					</div>
					<div class="theme-description">{{{ data.description }}}</div>
				</div>

				<div class="required-plugins">
					<h3><?php _e( 'Required Plugins', 'themegrill-demo-importer' ); ?></h3>
					<p><?php _e( 'This plugins are required to import demo.', 'themegrill-demo-importer' ); ?></p>
					<ul class="plugin-list">
						<li>
							<span class="plugin-name">Everest Forms</span>
							<div class="circle-loader"></div>
						</li>
						<li>
							<span class="plugin-name">Elementor</span>
							<div class="circle-loader circle-loading"></div>
						</li>
						<li>
							<span class="plugin-name">Woocommerce</span>
							<div class="circle-loader circle-colored">
								<div class="checked"></div>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="wp-full-overlay-footer">
			<div class="demo-import-actions">
				<button class="button button-hero button-primary demo-import" href="#" data-import="disabled"><?php _e( 'Import Demo', 'themegrill-demo-importer' ); ?></button>
			</div>
			<button type="button" class="collapse-sidebar button" aria-expanded="true" aria-label="<?php esc_attr_e( 'Collapse Sidebar', 'themegrill-demo-importer' ); ?>">
				<span class="collapse-sidebar-arrow"></span>
				<span class="collapse-sidebar-label"><?php _e( 'Collapse', 'themegrill-demo-importer' ); ?></span>
			</button>
			<div class="devices-wrapper">
				<div class="devices">
					<button type="button" class="preview-desktop active" aria-pressed="true" data-device="desktop">
						<span class="screen-reader-text"><?php esc_html_e( 'Enter desktop preview mode', 'themegrill-demo-importer' ); ?></span>
					</button>
					<button type="button" class="preview-tablet" aria-pressed="false" data-device="tablet">
						<span class="screen-reader-text"><?php esc_html_e( 'Enter tablet preview mode', 'themegrill-demo-importer' ); ?></span>
					</button>
					<button type="button" class="preview-mobile" aria-pressed="false" data-device="mobile">
						<span class="screen-reader-text"><?php esc_html_e( 'Enter mobile preview mode', 'themegrill-demo-importer' ); ?></span>
					</button>
				</div>
			</div>
		</div>
	</div>
	<div class="wp-full-overlay-main">
		<iframe src="{{ data.preview_url }}" title="<?php esc_attr_e( 'Preview', 'themegrill-demo-importer' ); ?>"></iframe>
	</div>
</script>

<?php
wp_print_request_filesystem_credentials_modal();
wp_print_admin_notice_templates();
tg_print_admin_notice_templates();
