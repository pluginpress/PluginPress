<?php

namespace PluginPress\PluginPress;

use PluginPress\PluginPressAPI\PluginPressAPI;

// If this file is called directly, abort. for the security purpose.
if(!defined('WPINC'))
{
    die;
}

class PluginPress extends PluginPressAPI
{

    public function __construct(
        protected string $plugin_file_path,
        protected string $config_file_path
    )
    {
        parent::__construct(plugin_file_path: $plugin_file_path, config_file_path: $config_file_path);
    }
    public function init()
    {
        // triggers when the plugin is activated. If a plugin is silently activated (such as during an update), this hook does not fire.
        $this->plugin_activator->set_activation_hook(activation_hook_class : new PluginActivationSequence($this->plugin_options));

        // triggers when the plugin is deactivated. If a plugin is silently deactivated (such as during an update), this hook does not fire.
        $this->plugin_activator->set_deactivation_hook(deactivation_hook_class : new PluginDeactivationSequence($this->plugin_options));

        // user will redirected to the welcome page when plugin is activated.
        // you have to set "PLUGIN_SLUG_welcome_page_auto_redirect" transient settings to TRUE on PluginActivationSequence.php to work this properly.
        $this->dashboard_pages->add_plugin_welcome_page(
                // required - absolute path to the template file OR callback function to render the UI.
                page_ui : $this->plugin_options->get('plugin_dir_path') . 'Private/Templates/PluginWelcomePageTemplate.php',
                // optional
                page_title : 'Welcome',
                // optional
                page_menu_title : 'Welcome',
                // optional - whether or not to show it on the dashboard menu. default is FALSE
                page_show_always : true,
        );
    
        $this->dashboard_pages->add_option_page(
            page_slug         : 'option_page_01',
            page_title        : 'Option Page 01',
            // page_ui           : '',
            // page_menu_title   : '',
            // page_description  : '',
            // page_capabilities : '',
            page_position     : 10,
        );

        $this->dashboard_pages->add_option_page(
            page_slug         : 'option_page_02',
            page_title        : 'Option Page 02',
            // page_ui           : '',
            // page_menu_title   : '',
            // page_description  : '',
            // page_capabilities : '',
            page_position     : 11,
        );

        $this->dashboard_pages->add_menu_page(
            page_slug         : 'menu_page_01',
            page_title        : 'Menu Page 01',
            // page_ui           : '',
            // page_icon_url     : '',
            // page_menu_title   : '',
            page_description  : 'This is a test page',
            // page_capabilities : '',
            page_position     : 10,
        );

        // add_action(
        //     hook_name:'after_dashboard_page_title_' . $this->plugin_options->get('plugin_slug'),
        //     callback:function(){
        //         echo '<a href="options-general.php" class="page-title-action">Plugin Settings</a>';
        //     }
        // );
        add_action(
            hook_name:'after_dashboard_page_title_' . $this->plugin_options->get('plugin_slug') . '_menu_page_01',
            callback:function(){
                echo '<a href="http://localhost/wordpress_6_0_2/wp-admin/plugin-install.php?tab=upload" class="upload-view-toggle page-title-action" role="button" aria-expanded="true"><span class="upload">Upload Plugin</span><span class="browse">Browse Plugins</span></a>';
            }
        );
        // add_action(
        //     hook_name:'before_dashboard_page_footer_section_' . $this->plugin_options->get('plugin_slug'),
        //     callback:function(){
        //         echo '<a href="options-general.php" class="page-title-action">Plugin Settings</a>';
        //     }
        // );

        // add_action(
        //     hook_name:'before_dashboard_page_footer_section_' . $this->plugin_options->get('plugin_slug') . '_menu_page_01',
        //     callback:function(){
        //         echo '<a href="http://localhost/wordpress_6_0_2/wp-admin/plugin-install.php?tab=upload" class="upload-view-toggle page-title-action" role="button" aria-expanded="true"><span class="upload">Upload Plugin</span><span class="browse">Browse Plugins</span></a>';
        //     }
        // );

        $this->dashboard_pages->add_menu_page(
            page_slug         : 'menu_page_02',
            page_title        : 'Menu Page 02',
            // page_ui           : '',
            // page_icon_url     : '',
            // page_menu_title   : '',
            // page_description  : '',
            // page_capabilities : '',
            page_position     : 11,
        );

        $this->dashboard_pages->add_submenu_page(
            page_parent_slug   : 'menu_page_01',
            page_slug          : 'sub_menu_page_01',
            page_title         : 'Sub Menu Page 01',
            // page_ui            : '',
            // page_menu_title    : '',
            // page_description   : '',
            // page_capabilities  : '',
            page_position      : 10,
        );

        $this->dashboard_pages->add_submenu_page(
            page_parent_slug   : 'menu_page_01',
            page_slug          : 'sub_menu_page_02',
            page_title         : 'Sub Menu Page 02',
            // page_ui            : '',
            // page_menu_title    : '',
            // page_description   : '',
            // page_capabilities  : '',
            page_position      : 11,
        );



        // print('<pre>');
        // var_dump($this->dashboard_pages->get_registered_pages());
        // print('</pre>');
        // die;

        // print('<pre>');
        // var_dump($this->dashboard_pages->get_registered_pages());
        // print('</pre>');


        // ( new CreateAdminPages( $this->plugin_options ) )->init();



    }
}
