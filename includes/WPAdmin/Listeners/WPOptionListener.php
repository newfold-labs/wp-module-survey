<?php

namespace NewfoldLabs\WP\Module\Survey\WPAdmin\Listeners;

use NewfoldLabs\WP\Module\Survey\Data\Options;

class WPOptionListener {

	private $surveys = array();

	public function __construct() {
		add_action( 'admin_init', array( $this, 'load_surveys' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'load_data' ) );
	}

	public function load_surveys() {
		$option_name   = Options::get_option_name( 'queue' );
		$this->surveys = get_option( $option_name, array() );
		update_option( $option_name, array() );
	}

	public function load_data() {
		if ( ! empty( $this->surveys ) ) {
			$asset_file = NFD_SURVEY_BUILD_DIR . '/surveys.asset.php';

			if ( is_readable( $asset_file ) ) {

				$asset = include_once $asset_file;

				wp_register_script(
					'nfd-survey',
					NFD_SURVEY_BUILD_URL . '/surveys.js',
					array_merge( $asset['dependencies'], array() ),
					$asset['version'],
					true
				);

				\wp_register_style(
					'nfd-survey',
					NFD_SURVEY_BUILD_URL . '/surveys.css',
					array(),
					$asset['version']
				);

				wp_add_inline_script(
					'nfd-survey',
					'var nfdSurvey =' . wp_json_encode(
						array(
							'queue' => $this->surveys,
						)
					) . ';',
					'before'
				);

				\wp_enqueue_script( 'nfd-survey' );
				\wp_enqueue_style( 'nfd-survey' );
			}
		}
	}
}
