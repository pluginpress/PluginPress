<?php

namespace PluginPress\PluginPress;

use PluginPress\PluginPressAPI\PluginOptions\PluginOptions;

// If this file is called directly, abort. for the security purpose.
if(!defined('WPINC'))
{
    die;
}

class PluginDeactivationSequence
{
    public function __construct(protected PluginOptions $plugin_options)
    {
    }

    public function init() : void
    {
        error_log(esc_html__($this->plugin_options->get('plugin_name') . ' is deactivated.', $this->plugin_options->get('plugin_text_domain')));
    }
}