<?php

namespace NewfoldLabs\WP\Module\Survey;

use NewfoldLabs\WP\Module\Survey\WPAdmin\WPAdmin;
use NewfoldLabs\WP\ModuleLoader\Container;

class Survey {

	/**
	 * Dependency injection container.
	 *
	 * @var Container
	 */
	protected $container;

	/**
	 * Constructor.
	 *
	 * @param Container $container
	 */
	public function __construct( Container $container ) {

		$this->container = $container;

		if ( Permissions::is_authorized_admin() ) {
			new WPAdmin();
		}
	}
}
