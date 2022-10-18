<?php

echo '<h1>Welcome to ' . $this->plugin_options->get('plugin_name') . ' - ' . $this->plugin_options->get('plugin_version') . '</h1>';
echo '<h4>' . $this->plugin_options->get('plugin_description') . '</h4>';



        // print('<pre>');
        // var_dump($current_page = $this->get_current_page());
        // print('</pre>');

        print('<pre>');
        var_dump($this->get_registered_pages());
        print('</pre>');