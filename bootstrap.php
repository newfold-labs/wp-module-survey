<?php

require_once 'vendor/autoload.php';

use NewfoldLabs\WP\Module\Survey\Survey;
use NewfoldLabs\WP\Module\Survey\Service;
use NewfoldLabs\WP\ModuleLoader\Container;
use function NewfoldLabs\WP\ModuleLoader\register;

if ( function_exists( 'add_action' ) ) {

	add_action(
		'plugins_loaded',
		function () {

			register(
				array(
					'name'     => 'wp-module-survey',
					'label'    => __( 'wp-module-survey', 'wp-module-survey' ),
					'callback' => function ( Container $container ) {
						if ( ! defined( 'NFD_SURVEY_VERSION' ) ) {
							define( 'NFD_SURVEY_VERSION', '1.0.0' );
						}
						if ( ! defined( 'NFD_SURVEY_BUILD_DIR' ) && defined( 'NFD_SURVEY_VERSION' ) ) {
							define( 'NFD_SURVEY_BUILD_DIR', __DIR__ . '/build/' . NFD_SURVEY_VERSION );
						}
						if ( ! defined( 'NFD_SURVEY_BUILD_URL' && defined( 'NFD_SURVEY_VERSION' ) ) ) {
							define( 'NFD_SURVEY_BUILD_URL', $container->plugin()->url . '/vendor/newfold-labs/wp-module-survey/build/' . NFD_SURVEY_VERSION );
						}

						$container->set( 'survey', $container->service( function () {
							return new Service();
						} ) );
						new Survey( $container );
					},
					'isActive' => true,
					'isHidden' => true,
				)
			);

		}
	);

}
