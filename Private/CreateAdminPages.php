<?php

namespace PluginPress\PluginPress;

use PluginPress\PluginPressAPI\PluginOptions\PluginOptions;
use PluginPress\PluginPressAPI\Admin\AdminPages;

// If this file is called directly, abort. for the security purpose.
if(! defined('WPINC'))
{
    die;
}
/**
 * Undocumented class
 * @return mixed
 */
class CreateAdminPages
{

    protected $plugin_options;

    public function __construct(PluginOptions $plugin_options)
    {
        $this->plugin_options = $plugin_options;
    }

    public function init()
    {
        // create single option page
        $this->create_option_page();
        // $this->create_option_pages();
        // $this->create_admin_welcome_page();


        // add_action('before_header_section', function () {
        //     echo 'before_header_section';
        // });
        // add_action('before_header_section_pluginpressapi_test_options_page_02',
        //     function () {
        //         echo 'after_header_section_test_menu_page_01';
        //     }
        // );

        // add_action('after_header_section', function () {
        //     echo 'after_header_section';
        // });
        // add_action('after_header_section_pluginpressapi_test_options_page_02', function () {
        //     echo 'after_header_section_test_menu_page_01';
        // });

        // add_filter(
        //     'before_tab_render_' . $this->plugin_options->get( 'plugin_slug' ) . '_test_options_page_02_test_tab_01',
        //     function($tab) {
        //         $tab['tab_after_icon']       = 'dashicons dashicons-warning';
        //         $tab['tab_after_icon_style'] = 'color:red;';
        //         return $tab;
        //     }
        // );
        // add_filter(
        //     'before_section_render_' . $this->plugin_options->get('plugin_slug') . '_test_options_page_02_test_section_01',
        //     function($section) {
        //         $section['section_before_icon']       = 'dashicons dashicons-book';
        //         $section['section_before_icon_style'] = 'color:gray;';
        //         $section['section_after_icon']        = 'dashicons dashicons-warning';
        //         $section['section_after_icon_style']  = 'color:red;';
        //         return $section;
        //     }
        // );
        // add_filter(
        //     'before_option_render_' . $this->plugin_options->get('plugin_slug') . '_test_options_page_02_test_option_01',
        //     function($option) {
        //         $option[ 'option_help_icon_style' ] = 'color:blue;';
        //         // $option[ 'option_disabled' ] = true;
        //         return $option;
        //     }
        // );
    }

    // create single option page
    private function create_option_page()
    {
        $option_page_01 = new AdminPages($this->plugin_options);
        $option_page_01->add_option_pages(
            [
                'page_title'                    => 'Test Options Page 01',
                'page_menu_title'               => 'Test Options Page 01',
                'page_description'              => 'This is the test option page 01 description',
                'page_capabilities'             => 'manage_options',
                'page_slug'                     => 'test_options_page_01',
                'page_ui'                       => '',      // default empty || valid callback function || absolute path to the template file
            ]
        );
        $option_page_01->add_tabs(
            [
                'tab_parent_page_slug'          => 'test_options_page_01',
                'tab_slug'                      => 'test_tab_01',
                'tab_title'                     => 'Test Tab 01',
                'tab_description'               => 'Test tab 01 description',
                // 'tab_before_icon'               => 'dashicons dashicons-admin-generic',
                // 'tab_after_icon'                => 'dashicons dashicons-admin-generic',
                'tab_default'                   => true,
            ]
        );
        $option_page_01->add_sections(
            [
                'section_parent_page_slug'      => 'test_options_page_01',
                'section_parent_tab_slug'       => 'test_tab_01',
                'section_slug'                  => 'test_section_01',
                'section_title'                 => 'Test Section 01 Title',
                'section_description'           => 'This is the description for the test section 01',
            ]
        );
        $option_page_01->add_fields(
            [
                'option_parent_page_slug'       => 'test_options_page_01',      // Required
                'option_parent_tab_slug'        => 'test_tab_01',       // Optional
                'option_parent_section_slug'    => 'test_section_01',       // Optional
                'option_slug'                   => 'test_option_01',        // Required
                'option_title'                  => 'Test Option 01',        // Required
                'option_data_type'              => 'string',        // Optional
                'option_type'                   => 'text',      // Optional
                'option_default_value'          => false,       // Optional
                'option_description'            => 'This is the description for the test option 01',        // Optional
                'option_sanitize_callback'      => '',      // Optional
                'option_show_in_rest'           => false,       // Optional
                'option_ui'                     => '',      // Optional
                'option_class'                  => 'test-css-class',        // Optional
                'option_placeholder'            => 'Test option placeholder',       // Optional
            ]
        );
        $option_page_01->init();
    }

    private function create_option_pages()
    {
        $option_pages = new AdminPages($this->plugin_options);
        $option_pages->add_option_pages(
            [
                [
                    'page_title'       => 'Test Options Page 02',
                    'page_menu_title'       => 'Test Options Page 02',
                    'page_description' => 'This is the test option page 02',
                    'page_capabilities'     => 'manage_options',
                    'page_slug'        => 'test_options_page_02',
                ],
                [
                    'page_title'       => 'Test Options Page 03',
                    'page_menu_title'       => 'Test Options Page 03',
                    'page_description' => 'This is the test option page 03',
                    'page_capabilities'     => 'manage_options',
                    'page_slug'        => 'test_options_page_03',
                    'page_ui'               => plugin_dir_path(__FILE__) . 'Templates/TestOptionPageTemplate.php',
                ],
                // more pages
            ]
        );
        $option_pages->add_tabs(
            [
                [
                    'tab_parent_page_slug' => 'test_options_page_02',
                    'tab_slug'         => 'test_tab_01',
                    'tab_title'        => 'Page 02 Test Tab 01',
                    'tab_description'  => 'Test Tab description 01',
                    // 'tab_before_icon' => 'dashicons dashicons-admin-generic',
                    // 'tab_after_icon' => 'dashicons dashicons-admin-generic',
                    // 'tab_default' => true,
                ],
                [
                    'tab_parent_page_slug' => 'test_options_page_02',
                    'tab_slug'         => 'test_tab_02',
                    'tab_title'        => 'Page 02 Test Tab 02',
                    'tab_description'  => 'Test Tab description 02',
                    // 'tab_before_icon' => 'dashicons dashicons-admin-generic',
                    // 'tab_after_icon' => 'dashicons dashicons-admin-generic',
                    // 'tab_default' => true,
                ],
                [
                    'tab_parent_page_slug' => 'test_options_page_02',
                    'tab_slug'         => 'test_tab_03',
                    'tab_title'        => 'Page 02 Test Tab 03',
                    'tab_description'  => 'Test Tab description 03',
                    // 'tab_before_icon' => 'dashicons dashicons-admin-generic',
                    // 'tab_after_icon' => 'dashicons dashicons-admin-generic',
                    // 'tab_default' => true,
                ],
                [
                    'tab_parent_page_slug' => 'test_options_page_03',
                    'tab_slug'         => 'test_tab_02',
                    'tab_title'        => 'Page 03 Test Tab 02',
                    'tab_description'  => 'Test Tab description 02',
                    // 'tab_before_icon' => 'dashicons dashicons-admin-generic',
                    // 'tab_after_icon' => 'dashicons dashicons-admin-generic',
                    // 'tab_default' => true,
                ],
                // more tabs

            ]
        );
        $option_pages->add_sections(
            [
                [
                    'section_parent_page_slug'    => 'test_options_page_02',
                    'section_parent_tab_slug'     => 'test_tab_01',
                    'section_slug'        => 'test_section_01',
                    'section_title'       => 'Test Section Title 01',
                    'section_description' => 'This is the description for the test section 01',
                    // 'section_ui'        => [ $this, 'render' ],
                ],
                [
                    'section_parent_page_slug'    => 'test_options_page_02',
                    'section_parent_tab_slug'     => 'test_tab_01',
                    'section_slug'        => 'test_section_02',
                    'section_title'       => 'Test Section Title 02',
                    'section_description' => 'This is the description for the test section 02',
                    // 'section_ui'        => [ $this, 'render' ],
                ],
                [
                    'section_parent_page_slug'    => 'test_options_page_02',
                    'section_parent_tab_slug'     => 'test_tab_02',
                    'section_slug'        => 'test_section_03',
                    'section_title'       => 'Test Section Title 03',
                    'section_description' => 'This is the description for the test section 03',
                    // 'section_ui'        => [ $this, 'render' ],
                ],
                // more sections

            ]
        );
        $option_pages->add_fields(
            [
                [
                    'option_parent_page_slug'    => 'test_options_page_02',
                    'option_parent_tab_slug'     => 'test_tab_01',
                    'option_parent_section_slug' => 'test_section_01',
                    'option_slug'         => 'test_input_option',
                    'option_title'        => 'Test Input Option',
                    'option_data_type'    => 'string',
                    'option_type'         => 'text',
                    'option_default_value' => 'Test Input Default Value',
                    'option_description'  => 'This is the description for the test input option',
                    // 'option_sanitize_callback' => '',
                    // 'option_show_in_rest' => false,
                    // 'option_ui' => '',
                    // 'option_class' => 'bg',
                    'option_placeholder' => 'Test input option placeholder',
                    'option_help_message' => 'This is the tooltip for the test input option',
                    // 'option_help_icon' => 'dashicons dashicons-editor-help',
                    // 'option_help_icon_style' => 'color:red;',
                    // 'option_required' => true,
                    // 'option_readonly' => true,
                    // 'option_disabled' => true,
                ],
                [
                    'option_parent_page_slug' => 'test_options_page_02', // Required
                    'option_parent_tab_slug' => 'test_tab_01', // Optional
                    'option_parent_section_slug' => 'test_section_01', // Optional
                    'option_slug' => 'test_checkbox_option', // Required
                    'option_title' => 'Test Checkbox Option', // Required
                    'option_data_type' => 'boolean', // Optional
                    'option_type' => 'checkbox', // Optional
                    'option_default_value' => true,                                         // Optional
                    'option_description' => 'This is the description for the test checkbox option', // Optional
                    // 'option_sanitize_callback' => '',                                           // Optional
                    // 'option_show_in_rest' => false,                                             // Optional
                    // 'option_ui' => '',                                                          // Optional
                    // 'option_class' => 'bg',                                         // Optional
                    // 'option_placeholder' => 'Test option placeholder',                          // Optional
                    'option_help_message' => 'This is the tooltip for the test checkbox option',
                    // 'option_help_icon' => 'dashicons dashicons-editor-help',
                    // 'option_required' => true,
                    // 'option_readonly' => true,
                    // 'option_disabled' => true,
                ],
                [
                    'option_parent_page_slug' => 'test_options_page_02', // Required
                    'option_parent_tab_slug' => 'test_tab_01', // Optional
                    'option_parent_section_slug' => 'test_section_01', // Optional
                    'option_slug' => 'test_textarea_option', // Required
                    'option_title' => 'Test Textarea Option', // Required
                    'option_data_type' => 'string', // Optional
                    'option_type' => 'textarea', // Optional
                    'option_default_value' => 'Textarea Default Value',                                            // Optional
                    'option_description' => 'This is the description for the test textarea option', // Optional
                    // 'option_sanitize_callback' => '',                                           // Optional
                    // 'option_show_in_rest' => false,                                             // Optional
                    // 'option_ui' => '',                                                          // Optional
                    // 'option_class' => 'bg',                                         // Optional
                    // 'option_placeholder' => 'Test option placeholder',                          // Optional
                    'option_help_message' => 'This is the tooltip for the test textarea option',
                    // 'option_help_icon' => 'dashicons dashicons-editor-help',
                    // 'option_required' => true,
                    // 'option_readonly' => true,
                    // 'option_disabled' => true,
                ],
                [
                    'option_parent_page_slug' => 'test_options_page_02', // Required
                    'option_parent_tab_slug' => 'test_tab_01', // Optional
                    'option_parent_section_slug' => 'test_section_01', // Optional
                    'option_slug' => 'test_select_option', // Required
                    'option_title' => 'Test Select Option', // Required
                    'option_data_type' => 'string', // Optional
                    'option_type' => 'select', // Optional
                    'option_default_value' => 'Select Default Value',                                            // Optional
                    'option_description' => 'This is the description for the test select option', // Optional
                    // 'option_sanitize_callback' => '',                                           // Optional
                    // 'option_show_in_rest' => false,                                             // Optional
                    // 'option_ui' => '',                                                          // Optional
                    // 'option_class' => 'bg',                                         // Optional
                    // 'option_placeholder' => 'Test option placeholder',                          // Optional
                    'option_help_message' => 'This is the tooltip for the test select option',
                    // 'option_help_icon' => 'dashicons dashicons-editor-help',
                    // 'option_required' => true,
                    // 'option_readonly' => true,
                    // 'option_disabled' => true,
                    'option_list' => [ 'test_item_01' => 'Test Item 01', 'test_item_02' => 'Test Item 02', 'test_item_03' => 'Test Item 03', 'test_item_04' => 'Test Item 04', ],
                ],
                [
                    'option_parent_page_slug' => 'test_options_page_03', // Required
                    'option_parent_tab_slug' => 'test_tab_02', // Optional
                    'option_parent_section_slug' => 'test_section_03', // Optional
                    'option_slug' => 'test_option_03', // Required
                    'option_title' => 'Test Option 03', // Required
                    'option_data_type' => 'string', // Optional
                    'option_type' => 'text', // Optional
                    // 'option_default_value' => false,                                            // Optional
                    'option_description' => 'This is the description for the test option 03', // Optional
                    // 'option_sanitize_callback' => '',                                           // Optional
                    // 'option_show_in_rest' => false,                                             // Optional
                    // 'option_ui' => '',                                                          // Optional
                    // 'option_class' => 'test-css-class',                                         // Optional
                    // 'option_placeholder' => 'Test option placeholder',                          // Optional
                    'option_help_icon' => 'dashicons dashicons-admin-generic',
                ],
            ]
        );
        $option_pages->init();
    }

    // // user will redirected to the welcome page when plugin is activated.
    // // If a plugin is silently activated (such as during an update, multisite, or multiple plugin activation), this does not redirect to the welcome page.
    // private function create_admin_welcome_page()
    // {
    //     $admin_welcome_page = new AdminPages($this->plugin_options);
    //     $admin_welcome_page->add_admin_welcome_page(
    //         [
    //             'page_title' => 'Welcome',
    //             'page_ui' => plugin_dir_path(__FILE__) . 'Templates/AdminWelcomePageTemplate.php', // valid callback function || absolute path to the template file
    //             'page_show_always' => true,     // default false
    //         ]
    //     );
    //     $admin_welcome_page->init();
    // }

}
