<?php

namespace NewfoldLabs\WP\Module\Survey\WPAdmin\Listeners;

class DataAttrListener {

	public function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_data_attr_listener' ) );
	}

	public function enqueue_data_attr_listener() {
		$asset_file = NFD_SURVEY_BUILD_DIR . '/dataAttrListener.asset.php';

		if ( is_readable( $asset_file ) ) {

			$asset = include_once $asset_file;

			wp_register_script(
				'nfd-survey-data-attr-listener',
				NFD_SURVEY_BUILD_URL . '/dataAttrListener.js',
				array_merge( $asset['dependencies'], array() ),
				$asset['version'],
				true
			);

			wp_add_inline_script(
				'nfd-survey-data-attr-listener',
				'var nfdSurveyDataAttrListener =' . wp_json_encode(
					array(
						'restUrl' => \get_home_url() . '/index.php?rest_route=',
					)
				) . ';',
				'before'
			);

			wp_enqueue_script( 'nfd-survey-data-attr-listener' );
		}
	}
}
