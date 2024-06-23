<?php

namespace NewfoldLabs\WP\Module\Survey\WPAdmin;

use NewfoldLabs\WP\Module\Survey\WPAdmin\Listeners\DataAttrListener;
use NewfoldLabs\WP\Module\Survey\WPAdmin\Listeners\WPOptionListener;

class WPAdmin {

	public function __construct() {
		new DataAttrListener();
		new WPOptionListener();
	}
}
