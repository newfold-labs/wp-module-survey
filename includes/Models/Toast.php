<?php

namespace NewfoldLabs\WP\Module\Survey\Models;

use NewfoldLabs\WP\Module\Survey\Data\Options;

class Toast {
	public static $type = 'toast';
	protected $action;
	protected $category;
	protected $data;
	protected $heading;
	protected $subheading;

	public function __construct( $heading, $subheading, $action, $category, $data ) {
		$this->action     = $action;
		$this->category   = $category;
		$this->data       = $data;
		$this->heading    = $heading;
		$this->subheading = $subheading;
	}

	public function save() {
		$option_name = Options::get_option_name( 'queue' );
		$surveys     = get_option( $option_name, array() );
		if ( ! isset( $surveys['toast'] ) ) {
			$surveys['toast'] = array();
		}

		array_push(
			$surveys[ self::$type ],
			array(
				'action'     => $this->action,
				'category'   => $this->category,
				'data'       => $this->data,
				'heading'    => $this->heading,
				'subheading' => $this->subheading,
			)
		);
		update_option( $option_name, $surveys );
	}
}
