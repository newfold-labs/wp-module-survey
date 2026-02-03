<?php

namespace NewfoldLabs\WP\Module\Survey;

use NewfoldLabs\WP\Module\Survey\Data\Options;

/**
 * Tests for Service.
 *
 * @covers \NewfoldLabs\WP\Module\Survey\Service
 */
class ServiceWPUnitTest extends \lucatume\WPBrowser\TestCase\WPTestCase {

	/**
	 * Verifies create_toast_survey queues a survey and returns Toast instance.
	 *
	 * @return void
	 */
	public function test_create_toast_survey_queues_and_returns_toast() {
		$option_name = Options::get_option_name( 'queue' );
		delete_option( $option_name );

		$service = new Service();
		$toast   = $service->create_toast_survey(
			'test_action',
			'test_category',
			array( 'key' => 'value' ),
			'Test Heading',
			'Test Subheading'
		);

		$this->assertInstanceOf( \NewfoldLabs\WP\Module\Survey\Models\Toast::class, $toast );

		$surveys = get_option( $option_name, array() );
		$this->assertArrayHasKey( 'toast', $surveys );
		$this->assertCount( 1, $surveys['toast'] );
		$this->assertSame( 'test_action', $surveys['toast'][0]['action'] );
		$this->assertSame( 'Test Heading', $surveys['toast'][0]['heading'] );
	}
}
