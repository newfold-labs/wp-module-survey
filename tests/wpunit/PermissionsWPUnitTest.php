<?php

namespace NewfoldLabs\WP\Module\Survey;

/**
 * Tests for Permissions.
 *
 * @covers \NewfoldLabs\WP\Module\Survey\Permissions
 */
class PermissionsWPUnitTest extends \lucatume\WPBrowser\TestCase\WPTestCase {

	/**
	 * Verifies rest_is_authorized_admin returns false when not logged in.
	 *
	 * @return void
	 */
	public function test_rest_is_authorized_admin_false_when_logged_out() {
		wp_set_current_user( 0 );
		$this->assertFalse( Permissions::rest_is_authorized_admin() );
	}

	/**
	 * Verifies rest_is_authorized_admin returns true when admin is logged in.
	 *
	 * @return void
	 */
	public function test_rest_is_authorized_admin_true_for_administrator() {
		$user_id = $this->factory()->user->create( array( 'role' => 'administrator' ) );
		wp_set_current_user( $user_id );
		$this->assertTrue( Permissions::rest_is_authorized_admin() );
	}

	/**
	 * Verifies rest_is_authorized_admin returns false for subscriber.
	 *
	 * @return void
	 */
	public function test_rest_is_authorized_admin_false_for_subscriber() {
		$user_id = $this->factory()->user->create( array( 'role' => 'subscriber' ) );
		wp_set_current_user( $user_id );
		$this->assertFalse( Permissions::rest_is_authorized_admin() );
	}
}
