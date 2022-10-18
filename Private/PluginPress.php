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




        // print('<pre>');
        // var_dump($this->dashboard_pages->get_registered_pages());
        // print('</pre>');


        // ( new CreateAdminPages( $this->plugin_options ) )->init();



    }
}
