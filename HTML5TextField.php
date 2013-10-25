<?php
class HTML5TextField extends TextField {
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
	 * @see HTML5FieldsDecorator::defaultField()
	 */
	public function Field() {
		return $this->defaultField();
	}

	/**
	 * @see FormField::FieldHolder()
	 */
	public function FieldHolder() {
		return $this->defaultFieldHolder();
	}

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