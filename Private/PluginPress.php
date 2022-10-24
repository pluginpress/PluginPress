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
            page_slug                       : 'option_page_01',
            page_title                      : 'Option Page 01',
        );
        $this->dashboard_pages->add_section(
            section_parent_page_slug        : 'option_page_01',
            section_slug                    : 'section_01',
            section_title                   : 'Option Page 01 Section 01',
            section_description             : 'Description for Option Page 01 Section 01',
        );
        $this->dashboard_pages->add_option(
            option_parent_page_slug         : 'option_page_01',
            option_parent_section_slug      : 'section_01',
            option_slug                     : 'option_01',
            option_title                    : 'Option Page 01 Section 01 Option 01',
        );
        $this->dashboard_pages->add_option(
            option_parent_page_slug         : 'option_page_01',
            option_parent_section_slug      : 'section_01',
            option_slug                     : 'option_02',
            option_title                    : 'Option Page 01 Section 01 Option 02',
        );


        $this->dashboard_pages->add_option(
            option_parent_page_slug         : 'option_page_01',
            // option_parent_section_slug      : 'section_02',
            option_slug                     : 'option_03',
            option_title                    : 'Option Page 01 Option 03',
        );
        $this->dashboard_pages->add_option(
            option_parent_page_slug         : 'option_page_01',
            // option_parent_section_slug      : 'section_02',
            option_slug                     : 'option_04',
            option_title                    : 'Option Page 01  Option 04',
        );





        $this->dashboard_pages->add_option_page(
            page_slug                       : 'option_page_02',
            page_title                      : 'Option Page 02',
        );
        $this->dashboard_pages->add_section(
            section_parent_page_slug        : 'option_page_02',
            section_slug                    : 'section_01',
            section_title                   : 'Option Page 02 Section 01',
            section_description             : 'Description for Option Page 02 Section 01',
        );
        $this->dashboard_pages->add_option(
            option_parent_page_slug         : 'option_page_02',
            option_parent_section_slug      : 'section_01',
            option_slug                     : 'option_01',
            option_title                    : 'Option Page 02 Section 01 Option 01',
        );
        $this->dashboard_pages->add_option(
            option_parent_page_slug         : 'option_page_02',
            option_parent_section_slug      : 'section_01',
            option_slug                     : 'option_02',
            option_title                    : 'Option Page 02 Section 01 Option 02',
        );











        $this->dashboard_pages->add_menu_page(
            page_slug         : 'menu_page_01',
            page_title        : 'Menu Page 01',
            // page_ui           : '',
            // page_icon_url     : '',
            // page_menu_title   : '',
            page_description  : 'This is the Menu Page 01 description.',
            // page_capabilities : '',
            page_position     : 10,
        );

        add_action(
            hook_name:'before_dashboard_page_header_section_' . $this->plugin_options->get('plugin_slug') . '_menu_page_01',
            callback:function(){
                echo '<div style="border: 1px solid #5bc666;font-size: 20px;padding: 10px;background: #26f059;">
                    This message will only shows before the header section on this page.</div>';
            }
        );
        add_action(
            hook_name:'after_dashboard_page_header_section_' . $this->plugin_options->get('plugin_slug') . '_menu_page_01',
            callback:function(){
                echo '<div style="border: 1px solid #5bc666;font-size: 20px;padding: 10px;background: #26f059;">
                    This message will only shows after the header section on this page.</div>';
            }
        );
        add_action(
            hook_name:'before_dashboard_page_title_' . $this->plugin_options->get('plugin_slug') . '_menu_page_01',
            callback:function()
            {
                echo '<div class="dashicons dashicons-admin-plugins" style="vertical-align:baseline;display: inline-block;"></div>';
            }
        );
        add_action(
            hook_name:'after_dashboard_page_title_' . $this->plugin_options->get('plugin_slug') . '_menu_page_01',
            callback:function()
            {
                echo '<a href="post-new.php" class="page-title-action">Add New</a>';
            }
        );

        add_action(
            hook_name:'before_tabs_render_' . $this->plugin_options->get('plugin_slug') . '_menu_page_01',
            callback:function()
            {
                echo '<div style="border: 1px solid #5bc666;font-size: 16px;padding: 5px;background: #2659;">';
            }
        );
        add_action(
            hook_name:'after_tabs_render_' . $this->plugin_options->get('plugin_slug') . '_menu_page_01',
            callback:function()
            {
                echo '</div>';
            }
        );


// Add tab 01
        $this->dashboard_pages->add_tab(
            tab_parent_page_slug  : 'menu_page_01',             // required - 
            tab_slug              : 'tab_01',                   // required - 
            tab_title             : 'Tab 01',                   // required - 
            tab_description       : 'Tab 01 description',       // optional - 
            // tab_default           : true,                       // optional - 
        );
        add_action(
            hook_name:'before_tab_title_render_' . $this->plugin_options->get('plugin_slug') . '_menu_page_01_tab_01',
            callback:function()
            {
                echo '<span style="vertical-align:baseline;display: inline-block;"><i class="dashicons dashicons-screenoptions"></i></span>';
            }
        );
        add_action(
            hook_name:'after_tab_title_render_' . $this->plugin_options->get('plugin_slug') . '_menu_page_01_tab_01',
            callback:function()
            {
                echo '<span style="vertical-align:baseline;display: inline-block;"><i class="dashicons dashicons-screenoptions"></i></span>';
            }
        );
        // add_action(
        //     hook_name:'tab_content_' . $this->plugin_options->get('plugin_slug') . '_menu_page_01_tab_01',
        //     callback:function($current_tab)
        //     {
        //         $v = [];
        //         echo empty($v) ? 'true' : 'false';
        //         echo 'This is tab content for tab 01';
        //     },
        //     // priority  : 10,
        //     // accepted_args : 2,
        // );
// Add tab 02
        $this->dashboard_pages->add_tab(
            tab_parent_page_slug  : 'menu_page_01',             // required - 
            tab_slug              : 'tab_02',                   // required - 
            tab_title             : 'Tab 02',                   // required - 
            tab_description       : 'Tab 02 description',       // optional - 
            // tab_default           : true,                       // optional - 
        );
        add_action(
            hook_name:'before_tab_title_render_' . $this->plugin_options->get('plugin_slug') . '_menu_page_01_tab_02',
            callback:function()
            {
                echo '<span style="vertical-align:baseline;display: inline-block;"><i class="dashicons dashicons-screenoptions"></i></span>';
            }
        );
// Add tab 03
        $this->dashboard_pages->add_tab(
            tab_parent_page_slug  : 'menu_page_01',             // required - 
            tab_slug              : 'tab_03',                   // required - 
            tab_title             : 'Tab 03',                   // required - 
            tab_description       : 'Tab 03 description',       // optional - 
            // tab_default           : true,                       // optional - 
        );
        add_action(
            hook_name:'after_tab_title_render_' . $this->plugin_options->get('plugin_slug') . '_menu_page_01_tab_03',
            callback:function()
            {
                echo '<span style="vertical-align:baseline;display: inline-block;"><i class="dashicons dashicons-screenoptions"></i></span>';
            }
        );








        $this->dashboard_pages->add_section(
            section_parent_page_slug      : 'menu_page_01',
            section_parent_tab_slug       : 'tab_01',
            section_slug                  : 'test_section_01',
            section_title                 : 'Test Section 01 Title',
            section_description           : 'This is the description for the test section 01',
            // section_ui           : null,
        );
        $this->dashboard_pages->add_section(
            section_parent_page_slug      : 'menu_page_01',
            section_parent_tab_slug       : 'tab_02',
            section_slug                  : 'test_section_02',
            section_title                 : 'Test Section 02 Title',
            section_description           : 'This is the description for the test section 02',
            // section_ui                    : '',
        );
        $this->dashboard_pages->add_section(
            section_parent_page_slug      : 'menu_page_01',
            section_parent_tab_slug       : 'tab_01',
            section_slug                  : 'test_section_03',
            section_title                 : 'Test Section 03 Title',
            section_description           : 'This is the description for the test section 03',
            // section_ui           : null,
        );

        $this->dashboard_pages->add_section(
            section_parent_page_slug      : 'menu_page_01',
            section_slug                  : 'test_section_04',
            section_title                 : 'Test Section 04 Title',
            section_description           : 'This is the description for the test section 04',
            // section_ui           : null,
        );


        $this->dashboard_pages->add_section(
            section_parent_page_slug      : 'menu_page_01',
            section_slug                  : 'test_section_05',
            section_title                 : 'Test Section 05 Title',
            section_description           : 'This is the description for the test section 05',
            // section_ui           : null,
        );





        $this->dashboard_pages->add_option(

            option_parent_page_slug : 'menu_page_01',       // Required
            option_parent_tab_slug : 'tab_01',       // Required
            option_parent_section_slug: 'test_section_01',       // Optional
            option_slug             : 'test_option_01',                 // Required
            option_title            : 'Test Option 01',             // Required

                // 'option_slug'                   => 'test_option_01',       
                // 'option_data_type'              => 'string',        // Optional
                // 'option_type'                   => 'text',      // Optional
                // 'option_default_value'          => false,       // Optional
                // 'option_description'            => 'This is the description for the test option 01',        // Optional
                // 'option_sanitize_callback'      => '',      // Optional
                // 'option_show_in_rest'           => false,       // Optional
                // 'option_ui'                     => '',      // Optional
                // 'option_class'                  => 'test-css-class',        // Optional
                // 'option_placeholder'            => 'Test option placeholder',       // Optional
        );

        $this->dashboard_pages->add_option(

            option_parent_page_slug : 'menu_page_01',       // Required
            option_parent_tab_slug : 'tab_01',       // Required
            option_parent_section_slug: 'test_section_03',       // Optional
            option_slug             : 'test_option_03',                 // Required
            option_title            : 'Test Option 03',             // Required

                // 'option_slug'                   => 'test_option_01',       
                // 'option_data_type'              => 'string',        // Optional
                // 'option_type'                   => 'text',      // Optional
                // 'option_default_value'          => false,       // Optional
                // 'option_description'            => 'This is the description for the test option 01',        // Optional
                // 'option_sanitize_callback'      => '',      // Optional
                // 'option_show_in_rest'           => false,       // Optional
                // 'option_ui'                     => '',      // Optional
                // 'option_class'                  => 'test-css-class',        // Optional
                // 'option_placeholder'            => 'Test option placeholder',       // Optional
        );


        $this->dashboard_pages->add_option(

            option_parent_page_slug : 'menu_page_01',       // Required
            option_parent_tab_slug : 'tab_02',       // Required
            option_parent_section_slug: 'test_section_02',       // Optional
            option_slug             : 'test_option_02',                 // Required
            option_title            : 'Test Option 02',             // Required

                // 'option_slug'                   => 'test_option_01',       
                // 'option_data_type'              => 'string',        // Optional
                // 'option_type'                   => 'text',      // Optional
                // 'option_default_value'          => false,       // Optional
                // 'option_description'            => 'This is the description for the test option 01',        // Optional
                // 'option_sanitize_callback'      => '',      // Optional
                // 'option_show_in_rest'           => false,       // Optional
                // 'option_ui'                     => '',      // Optional
                // 'option_class'                  => 'test-css-class',        // Optional
                // 'option_placeholder'            => 'Test option placeholder',       // Optional
        );



        $this->dashboard_pages->add_option(

            option_parent_page_slug : 'menu_page_01',       // Required
            // option_parent_tab_slug : 'tab_02',       // Required
            option_parent_section_slug: 'test_section_04',       // Optional
            option_slug             : 'test_option_041',                 // Required
            option_title            : 'Test Option 041',             // Required

                // 'option_slug'                   => 'test_option_01',       
                // 'option_data_type'              => 'string',        // Optional
                // 'option_type'                   => 'text',      // Optional
                // 'option_default_value'          => false,       // Optional
                // 'option_description'            => 'This is the description for the test option 01',        // Optional
                // 'option_sanitize_callback'      => '',      // Optional
                // 'option_show_in_rest'           => false,       // Optional
                // 'option_ui'                     => '',      // Optional
                // 'option_class'                  => 'test-css-class',        // Optional
                // 'option_placeholder'            => 'Test option placeholder',       // Optional
        );
    
        $this->dashboard_pages->add_option(

            option_parent_page_slug : 'menu_page_01',       // Required
            // option_parent_tab_slug : 'tab_02',       // Required
            // option_parent_section_slug: 'test_section_04',       // Optional
            option_slug             : 'test_option_04',                 // Required
            option_title            : 'Test Option 04',             // Required

                // 'option_slug'                   => 'test_option_01',       
                // 'option_data_type'              => 'string',        // Optional
                // 'option_type'                   => 'text',      // Optional
                // 'option_default_value'          => false,       // Optional
                // 'option_description'            => 'This is the description for the test option 01',        // Optional
                // 'option_sanitize_callback'      => '',      // Optional
                // 'option_show_in_rest'           => false,       // Optional
                // 'option_ui'                     => '',      // Optional
                // 'option_class'                  => 'test-css-class',        // Optional
                // 'option_placeholder'            => 'Test option placeholder',       // Optional
        );


// add_action(
//     hook_name:'before_tab_render_' . $this->plugin_options->get('plugin_slug') . '_menu_page_01',
//     callback:function()
//     {
//         echo '<span style="vertical-align:middle;margin-right:5px;"><i class="dashicons dashicons-screenoptions"></i>fgddfdsffg</span>';
//     }
// );










// add_action(
//     hook_name:'after_section_title_' . $this->plugin_options->get('plugin_slug') . '_menu_page_01_test_section_01',
//     callback:function()
//     {
//         echo '<input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes" style="vertical-align:middle;margin-left:5px;">';
//     }
// );
// add_action(
//     hook_name:'before_section_title_' . $this->plugin_options->get('plugin_slug') . '_menu_page_01_test_section_02',
//     callback:function()
//     {
//         echo '<span style="vertical-align:middle;margin-right:5px;"><i class="dashicons dashicons-screenoptions"></i></span>';
//     }
// );
// add_action(
//     hook_name:'after_section_title_' . $this->plugin_options->get('plugin_slug') . '_menu_page_01_test_section_02',
//     callback:function()
//     {
//         echo '<span style="vertical-align:middle;margin-left:5px;"><i class="dashicons dashicons-screenoptions"></i></span>';
//     }
// );












        // add_action(
        //     hook_name:'before_dashboard_page_header_section_' . $this->plugin_options->get('plugin_slug'),
        //     callback:function(){
        //         echo '<div style="border: 1px solid #c3c4c7;font-size: 20px;padding: 10px;background: beige;">
        //             This message will shows before the header section on the every page of this plugin is creating.</div>';
        //     }
        // );
        // add_action(
        //     hook_name:'after_dashboard_page_header_section_' . $this->plugin_options->get('plugin_slug'),
        //     callback:function(){
        //         echo '<div style="border: 1px solid #c3c4c7;font-size: 20px;padding: 10px;background: beige;">
        //             This message will shows after the header section on the every page of this plugin is creating.</div>';
        //     }
        // );
        // add_action(
        //     hook_name:'after_dashboard_page_title_' . $this->plugin_options->get('plugin_slug') . '_menu_page_01',
        //     callback:function(){
        //         echo '<a href="http://localhost/wordpress_6_0_2/wp-admin/plugin-install.php?tab=upload" class="upload-view-toggle page-title-action" role="button" aria-expanded="true"><span class="upload">Upload Plugin</span><span class="browse">Browse Plugins</span></a>';
        //     }
        // );
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
