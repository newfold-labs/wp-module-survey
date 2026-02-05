<?php

namespace NewfoldLabs\WP\Module\Survey;

use NewfoldLabs\WP\Module\Survey\Data\Options;

/**
 * Tests for Data\Options.
 *
 * @covers \NewfoldLabs\WP\Module\Survey\Data\Options
 */
class OptionsWPUnitTest extends \lucatume\WPBrowser\TestCase\WPTestCase {

	/**
	 * Verifies get_option_name returns prefixed option name for known key.
	 *
	 * @return void
	 */
	public function test_get_option_name_with_prefix() {
		$this->assertSame( 'nfd_module_survey_queue', Options::get_option_name( 'queue' ) );
	}

	/**
	 * Verifies get_option_name without prefix.
	 *
	 * @return void
	 */
	public function test_get_option_name_without_prefix() {
		$this->assertSame( 'queue', Options::get_option_name( 'queue', false ) );
	}

	/**
	 * Verifies get_option_name returns false for unknown key.
	 *
	 * @return void
	 */
	public function test_get_option_name_returns_false_for_unknown_key() {
		$this->assertFalse( Options::get_option_name( 'unknown' ) );
	}

	/**
	 * Verifies get_all_options returns options array.
	 *
	 * @return void
	 */
	public function test_get_all_options() {
		$options = Options::get_all_options();
		$this->assertIsArray( $options );
		$this->assertArrayHasKey( 'queue', $options );
		$this->assertSame( 'queue', $options['queue'] );
	}
}
