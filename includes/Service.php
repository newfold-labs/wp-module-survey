<?php

namespace NewfoldLabs\WP\Module\Survey;

use NewfoldLabs\WP\Module\Survey\Models\Toast;

class Service {
	public function create_toast_survey( $heading, $subheading, $action, $category, $data ) {
		$survey = new Toast( $heading, $subheading, $action, $category, $data );
		$survey->save();
		return $survey;
	}
}
