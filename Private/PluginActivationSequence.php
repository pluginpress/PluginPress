<?php

namespace PluginPress\PluginPress;

use PluginPress\PluginPressAPI\PluginOptions\PluginOptions;

// If this file is called directly, abort. for the security purpose.
if(!defined('WPINC'))
{
    die;
}

class PluginActivationSequence
{
    public function __construct(protected PluginOptions $plugin_options)
    {
    }

    public function init() : void
    {
        error_log(esc_html__($this->plugin_options->get('plugin_name') . ' is activated.', $this->plugin_options->get('plugin_text_domain')));
        // optional - whether or not is the user to be redirected to the welcome page after the plugin is activated. default is FALSE
        set_transient(transient : $this->plugin_options->get( 'plugin_slug' ) . '_welcome_page_auto_redirect', value : true, expiration : 0);
    }
}
