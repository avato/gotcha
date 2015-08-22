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
<section id="gc-dashboard-wrapper">
    <?php
    	/**
        * gc_before_settings_page_logo hook
        */
        do_action('gc_before_settings_page_logo');
    ?><!-- settings page header -->


    <header class="gc-page-title">
        <h2 class="gc-heading" id="gc-options-header">
        <?php _e('Dashboard','gotcha'); ?>
        <?php echo (get_option('savetest'));  ?>
        </h2>
    </header>
    <!-- .hk-page-title -->
   
    <?php
        /**
        * wg_after_settings_page_logo hook
        */
        do_action('gc_after_settings_page_logo');
    ?><!-- settings page body -->


    <main class="gc-page-body cf">
        <form action="" enctype="multipart/form-data" id="gc-mainform" method="post" name="mainform">

        	<?php wp_nonce_field( 'gc-admin-actions', "gc-security"); ?>

            <div class="gc-span-3 gc-column">

                <div class="gc-panel gc-popup mask gc-ajax-parent">
                    <div class="gc-panel-header">
                        <h5><?php _e('Background Mask','gotcha'); ?>
                        </h5>
                    </div>


                    <div class="gc-panel-body">
                        <?php echo $set_page->set_select('mask-opacity',__('Opacity','gotcha'), $option_1_args); ?>

                        <?php echo $set_page->set_color('mask-color',__('Mask color','gotcha') ); ?>

                    </div>

                </div><!-- .hk-api-settings-panel -->
            </div><!-- .hk-span-3 -->


            <div class="gc-span-3 gc-column">
                <!--APi SETTINGS PANEL -->


                <div class="gc-panel gc-grey-panel">
                    <div class="gc-panel-header">
                        <h5><?php _e('Basic Configuration','gotcha'); ?>
                        </h5>
                    </div>


                    <div class="gc-panel-body">

                        <?php echo $set_page->set_check('show-register',__('Show Registration','gotcha') ); ?>

                        <?php echo $set_page->set_check('show-login',__('Show Login','gotcha') ); ?>

                    </div>
                </div>
                <!-- .hk-api-settings-panel -->
            </div>


            <div class="gc-span-3 gc-column">
                <!--APi SETTINGS PANEL -->


                <div class="gc-panel">
                    <div class="gc-panel-header">
                        <h5><?php _e('Form Colors','gotcha'); ?></h5>
                    </div>


                    <div class="gc-panel-body">
                       <?php echo $set_page->set_color('form-bg',__('Form Bg color','gotcha') ); ?>
                       <?php echo $set_page->set_color('label-col',__('Label color','gotcha') ); ?>
                       <?php echo $set_page->set_color('subm-bg',__('Submit Bg','gotcha') ); ?>
                       <?php echo $set_page->set_color('subm-col',__('Submit color','gotcha') ); ?>
                       <br/>
                    </div>
                </div>
                <!-- .hk-api-settings-panel -->
            </div>


            <div class="gc-span-3 gc-column gc-last-column gc-column">
                <div class="gc-gotcha-panel gc-color-branding">
                    <h6>Gotcha</h6>
                    <p>Popup registrations and<br>
                    logins for all</p>
                    <a class="gc-gotcha-links" href=
                    "http://gotcha.ava.to">Gotcha Website</a><br>
                    <a class="gc-gotcha-links" href=
                    "http://gotcha.ava.to/docs">Gotcha Docs</a>
                </div>


                <div class="gc-github-panel gc-color-dark">
                    <a class="gc-logo" href="https://github.com/avato/Hostkit"
                    target="_blank">Gotcha on Github</a>

                    <h6>Gotcha on Github</h6>
                    <a class="gc-github-links" href=
                    "http://gotcha.ava.to">Report a bug</a><br>
                </div>
            </div>

            <div class="gc-savebar">
            	<input type="submit" class="gc-color-dark" name="gc-form-submit" value="<?php _e('Update settings','gc'); ?>" />
            </div>

        </form>
    </main>


</section>
<!-- #hk-dashboard-wrapper -->