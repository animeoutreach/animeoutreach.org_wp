<?php

	require_once nrgbusiness_file_require( get_template_directory().'/framework/classes/class.tgm.plugin.activation.php');
	add_action( 'tgmpa_register', 'themeton_register_required_plugins' );

	function themeton_register_required_plugins() {

		/**
		 * Array of plugin arrays. Required keys are name and slug.
		 * If the source is NOT from the .org repo, then source is also required.
		 */
		$plugins = array(
			array(
				'name'     				=> 'Envato Toolkit',
				'slug'     				=> 'envato-wordpress-toolkit',
				'source'   				=> get_template_directory().'/framework/plugins/envato-wordpress-toolkit.zip',
				'required' 				=> true,
				'version' 				=> '1.7.3',
				'force_activation' 		=> false,
				'force_deactivation' 	=> false,
				'external_url' 			=> '',
			),
            array(
                'name'                  => 'Visual Composer',
                'slug'                  => 'js_composer',
                'source'                => get_template_directory().'/framework/plugins/js_composer.zip',
                'required'              => true,
                'version'               => '5.0',
                'force_activation'      => false,
                'force_deactivation'    => false,
                'external_url'          => '',
            ),
            array(
                'name'                  => 'Revolution Slider',
                'slug'                  => 'revslider',
                'source'                => get_template_directory().'/framework/plugins/revslider.zip',
                'required'              => false,
                'version'               => '5.3.0.2',
                'force_activation'      => false,
                'force_deactivation'    => false,
                'external_url'          => '',
            ),
            array(
                'name'                  => 'Portfolio Post Type for ThemeTon themes',
                'slug'                  => 'themeton-portfolio',
                'source'                => get_template_directory().'/framework/plugins/themeton-portfolio.zip',
                'required'              => false,
                'version'               => '1.0',
                'force_activation'      => true,
                'force_deactivation'    => false,
                'external_url'          => '',
            )
		);


	$config = array(
        'id'           => 'themeton_tgm',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'install-required-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => __('Install Required Plugins', 'nrgbusiness'),
            'menu_title'                      => __('Install Plugins', 'nrgbusiness'),
            'installing'                      => __('Installing Plugin: %s', 'nrgbusiness'), // %s = plugin name.
            'oops'                            => __('Something went wrong with the plugin API.', 'nrgbusiness'),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'nrgbusiness' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'nrgbusiness' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'nrgbusiness' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'nrgbusiness' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'nrgbusiness' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'nrgbusiness' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'nrgbusiness' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'nrgbusiness' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'nrgbusiness' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'nrgbusiness' ),
            'return'                          => __('Return to Required Plugins Installer', 'nrgbusiness'),
            'plugin_activated'                => __('Plugin activated successfully.', 'nrgbusiness'),
            'complete'                        => __('All plugins installed and activated successfully. %s', 'nrgbusiness'), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );
 
    tgmpa( $plugins, $config );
 
}
       



?>