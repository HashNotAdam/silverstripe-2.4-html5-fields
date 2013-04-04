<?php
class HTML5DropdownField extends DropdownField {
	static $extensions = array(
		'HTML5FieldsDecorator'
	);

	// HTML tag used to render this field
	protected $tagType = 'select';

	// If this field is required, the HTML5 required attribute will be set
	protected $requried = false;

	// Regular expression validation
	protected $pattern;

	/**
	 * @see HTML5FieldsDecorator::defaultField()
	 */
	public function Field() {
		$options = '';
		if( $source = $this->getSource() ) {
			// For SQLMap sources, the empty string needs to be added specially
			if( is_object($source) && $this->emptyString ) {
				$options .= $this->createTag('option', array('value' => ''), $this->emptyString);
			}

			foreach( $source as $value => $title ) {
				// Blank value of field and source (e.g. "" => "(Any)")
				if( $value === '' && ($this->value === '' || $this->value === null) ) {
					$selected = 'selected';
				} else {
					// Normal value from the source
					if( $value ) {
						$selected = $value == $this->value ? 'selected' : null;
					} else {
						// Do a type check comparison, we might have an array key of 0
						$selected = $value === $this->value ? 'selected' : null;
					}

					$this->isSelected = (bool) $selected;
				}

				$options .= $this->createTag(
					'option',
					array(
						'selected' => $selected,
						'value' => $value
					),
					Convert::raw2xml($title)
				);
			}
		}

		return $this->defaultField($options);
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
		$this->pattern = $regex;
	}
}