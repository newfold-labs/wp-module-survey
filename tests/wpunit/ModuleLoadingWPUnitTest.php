<?php

namespace NewfoldLabs\WP\Module\Survey;

use NewfoldLabs\WP\Module\Survey\Data\Constants;
use NewfoldLabs\WP\Module\Survey\Data\Options;

/**
 * Module loading wpunit tests.
 *
 * @coversNothing
 */
class ModuleLoadingWPUnitTest extends \lucatume\WPBrowser\TestCase\WPTestCase {

	/**
	 * Verify WordPress factory is available.
	 *
	 * @return void
	 */
	public function test_wordpress_factory_available() {
		$this->assertTrue( function_exists( 'get_option' ) );
		$this->assertNotEmpty( get_option( 'blogname' ) );
	}

	/**
	 * Verify add_action exists (bootstrap uses it).
	 *
	 * @return void
	 */
	public function test_wordpress_hooks_available() {
		$this->assertTrue( function_exists( 'add_action' ) );
		$this->assertTrue( function_exists( 'add_filter' ) );
	}

	/**
	 * Verify Survey classes exist.
	 *
	 * @return void
	 */
	public function test_survey_classes_exist() {
		$this->assertTrue( class_exists( Survey::class ) );
		$this->assertTrue( class_exists( Service::class ) );
		$this->assertTrue( class_exists( Permissions::class ) );
		$this->assertTrue( class_exists( Constants::class ) );
		$this->assertTrue( class_exists( Options::class ) );
		$this->assertTrue( class_exists( \NewfoldLabs\WP\Module\Survey\Models\Toast::class ) );
	}

	/**
	 * Verify Permissions::ADMIN constant.
	 *
	 * @return void
	 */
	public function test_permissions_admin_constant() {
		$this->assertSame( 'manage_options', Permissions::ADMIN );
	}
}
