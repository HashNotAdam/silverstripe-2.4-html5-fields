<?php
class HTML5NumericField extends NumericField {
	static $extensions = array(
		'HTML5FieldsDecorator'
	);

	// Value for the type attribute
	protected $type = 'number';

	// If this field is required, the HTML5 required attribute will be set
	protected $requried = false;

	// Regular expression validation
	protected $pattern;

	// Min and max HTML5 attributes
	protected $min;
	protected $max;

	/**
	 * Called by HTML5FieldsDecorator::defaultField()
	 * Adds non-default attributes
	 *
	 * @param array
	 * @return array
	 */
	public function amendAttributes( $attributes ) {
		return array(
			'min' => $this->min,
			'max' => $this->max
		);
	}

	/**
	 * @see HTML5FieldsDecorator::defaultField()
	 */
	function Field() {
		return $this->defaultField();
	}

	/**
	 * @see FormField::FieldHolder()
	 */
	public function FieldHolder() {
		return $this->defaultFieldHolder();
	}

	/**
	 * Set the min variable
	 *
	 * @param int $min
	 */
	public function setMin( $min ) {
		$this->min = $min;
	}

	/**
	 * Set the man variable
	 *
	 * @param int $max
	 */
	public function setMax( $max ) {
		$this->max = $max;
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