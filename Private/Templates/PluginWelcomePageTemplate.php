<?php

echo '<h1>Welcome to ' . $this->plugin_options->get('plugin_name') . ' - ' . $this->plugin_options->get('plugin_version') . '</h1>';
echo '<h4>' . $this->plugin_options->get('plugin_description') . '</h4>';


echo 'Plugin Welcome Page Template</br>';


// $plugin_data = get_plugin_data( $this->plugin_options->get( 'plugin_file_path' ) );
// $plugin_version = $plugin_data[ 'Version' ];

// echo 'plugin_data <pre> '; print_r( $plugin_data ); echo ' </pre>';

// echo 'get_plugins <pre> '; print_r( get_plugins() ); echo ' </pre>';




        // print('<pre>');
        // var_dump($current_page = $this->get_current_page());
        // print('</pre>');

        print('<pre>');
        var_dump($this->get_registered_pages());
        print('</pre>');