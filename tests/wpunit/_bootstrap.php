<?php
/**
 * Bootstrap file for wpunit tests.
 *
 * @package NewfoldLabs\WP\Module\Survey
 */

$module_root = dirname( dirname( __DIR__ ) );

require_once $module_root . '/vendor/autoload.php';

if ( ! defined( 'NFD_SURVEY_VERSION' ) ) {
	define( 'NFD_SURVEY_VERSION', '1.0.2' );
}
if ( ! defined( 'NFD_SURVEY_DIR' ) ) {
	define( 'NFD_SURVEY_DIR', $module_root );
}
if ( ! defined( 'NFD_SURVEY_BUILD_DIR' ) ) {
	define( 'NFD_SURVEY_BUILD_DIR', $module_root . '/build/' . NFD_SURVEY_VERSION );
}
if ( ! defined( 'NFD_SURVEY_BUILD_URL' ) ) {
	define( 'NFD_SURVEY_BUILD_URL', 'https://test.local/vendor/newfold-labs/wp-module-survey/build/' . NFD_SURVEY_VERSION );
}
