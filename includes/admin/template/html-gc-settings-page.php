<?php
/**
 * Gotcha settings page html
 *
 * @link              http://ava.to
 * @since             0.1
 * @package           Gotcha
 *
 *
 */
if ( ! defined( 'WPINC' ) ) die;

$option_1_args = array();
for ($i=0; $i < 11 ; $i++) { 
	$option_1_args[] = array( 'value' => $i / 10, 'name'  => sprintf('%s%s %s',$i * 10,'%', __('Opacity','gotcha') ) );
}
?>


<!-- settings pagewrapper -->
<section id="gc-dashboard-wrapper">


	<?php 
		/**
		* gc_before_settings_page_logo hook
		*/
		do_action('gc_before_settings_page_logo'); 
	?>


	<!-- settings page header -->
	<header class="gc-page-title">

		<h2 class="gc-heading" id="gc-options-header">
			<?php _e('Dashboard','gotcha'); ?>
		</h2>	

	</header> <!-- .hk-page-title -->


	<?php 
		/**
		* wg_after_settings_page_logo hook
		*/
		do_action('gc_after_settings_page_logo'); 
	?>


	<!-- settings page body -->
	<main class="gc-page-body cf">


		<!--left panel -->
		<div class="gc-span-3 gc-column">


			<!--APi SETTINGS PANEL -->
			<div class="gc-panel gc-popup mask gc-ajax-parent">


				<div class="gc-panel-header">
					<h5><?php _e('Background Mask','gotcha'); ?></h5>
				</div>


				<div class="gc-panel-body">

					<?php echo $set_page->set_select('mask-opacity',__('Opacity','gotcha'), $option_1_args); ?>

					<?php echo $set_page->set_color('mask-color',__('Mask color','gotcha') ); ?>

				</div>


				<!-- Panel Footer -->
				<div class="gc-panel-footer">
					<a class="gc-spinner gc-ajax-task gc-color-branding gc-button" data-action="gc-save-mask">
						<span class="dashicons dashicons-update gc-spin"></span>
					</a>
				</div>


			</div><!-- .hk-api-settings-panel -->


		</div><!-- .hk-span-3 -->



		<div class="gc-span-3 gc-column">

			<!--APi SETTINGS PANEL -->
			<div class="gc-panel gc-grey-panel">

				<div class="gc-panel-header">
					<h5><?php _e('Basic Configuration','gotcha'); ?></h5>
				</div>

				<div class="gc-panel-body">

					<?php echo $set_page->set_check('show-register',__('Show Registration','gotcha') ); ?>

					<?php echo $set_page->set_check('show-login',__('Show Login','gotcha') ); ?>

				</div>

			</div><!-- .hk-api-settings-panel -->

		</div>

		<div class="gc-span-3 gc-column">

			<!--APi SETTINGS PANEL -->
			<div class="gc-panel">

				<div class="gc-panel-header">
					<h5><?php _e('System Status','gotcha'); ?></h5>
				</div>

				<div class="gc-panel-body">

					status settings

				</div>

			</div><!-- .hk-api-settings-panel -->

		</div>



		<div class="gc-span-3 gc-column gc-last-column gc-column">


			<div class="gc-gotcha-panel gc-color-branding">
				<h6>Gotcha</h6>
				<p>Popup registrations and<br/> logins for all</p>
				<a href="http://gotcha.ava.to" class="gc-gotcha-links">Gotcha Website</a><br/>
				<a href="http://gotcha.ava.to/docs" class="gc-gotcha-links">Gotcha Docs</a>
			</div>


			<div class="gc-github-panel gc-color-dark">
				<a href="https://github.com/avato/Hostkit" target="_blank" class="gc-logo">Gotcha on Github</a>
				<h6>Gotcha on Github</h6>
				<a href="http://gotcha.ava.to" class="gc-github-links">Report a bug</a><br/>
			</div>


		</div>
	</main>
</section><!-- #hk-dashboard-wrapper -->