<?php
class HTML5TextareaField extends TextareaField {
	static $extensions = array(
		'HTML5FieldsDecorator'
	);

	protected $maxLength;

	// Regular expression validation
	protected $pattern;

	// If this field is required, the HTML5 required attribute will be set
	protected $requried = false;

	// HTML tag used to render this field
	protected $tagType = 'textarea';

	/**
	 * @see HTML5FieldsDecorator::defaultField()
	 */
	public function amendAttributes($attributes) {
		$this->cols && $attributes['cols'] = $this->cols;
		$this->rows && $attributes['rows'] = $this->rows;
		return $attributes;
	}

	/**
	 * @see HTML5FieldsDecorator::defaultField()
	 */
	public function Field() {
		return $this->defaultField($this->value);
	}

	/**
	 * @see FormField::FieldHolder()
	 */
	public function FieldHolder() {
		return $this->defaultFieldHolder();
	}

	/**
	 * @param Int $length
	 */
	public function setMaxLength($length) {
		$this->maxLength = $length;
	}
	
	/**
	 * @return Int
	 */
	public function getMaxLength() {
		return $this->maxLength;
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