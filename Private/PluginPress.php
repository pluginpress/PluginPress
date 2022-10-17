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



        // print('<pre>');
        // var_dump($this->plugin_activator);
        // print('</pre>');
        // die;

        // ( new CreateAdminPages( $this->plugin_options ) )->init();



    }
}
