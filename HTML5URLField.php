<?php
class HTML5URLField extends URLField {
	static $extensions = array(
		'HTML5FieldsDecorator'
	);

	// Value for the type attribute
	protected $type = 'text';

	// If this field is required, the HTML5 required attribute will be set
	protected $requried = false;

	// Regular expression validation
	protected $pattern;

	/**
	 * Set the pattern attribute for in-browser regular expression validation
	 * Regular expressions have an implied ^(:? and )$
	 *
	 * @param string $regex
	 */
	public function setPattern( $regex ) {
		$this->owner->pattern = $regex;
	}
}