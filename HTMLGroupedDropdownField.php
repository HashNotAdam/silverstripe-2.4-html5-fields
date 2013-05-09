<?php
class HTML5GroupedDropdownField extends DropdownField {
	static $extensions = array(
		'HTML5FieldsDecorator'
	);

	// HTML tag used to render this field
	protected $tagType = 'select';

	// If this field is required, the HTML5 required attribute will be set
	protected $requried = false;

	// Regular expression validation
	protected $pattern;

	// Set multiple select attribute
	protected $multiple = false;

	/**
	 * @see HTML5FieldsDecorator::defaultField()
	 */
	public function Field() {
		// Initialisations
		$options = $classAttr = '';
		$extraAttributes = array();

		if($extraClass = trim($this->extraClass())) {
			$classAttr = "class=\"$extraClass\"";
		}
		
		foreach($this->getSource() as $value => $title) {
			if(is_array($title)) {
				$options .= "<optgroup label=\"$value\">";
				foreach($title as $value2 => $title2) {
					$selected = $value2 == $this->value ? " selected=\"selected\"" : "";
					$options .= "<option$selected value=\"$value2\">$title2</option>";
				}
				$options .= "</optgroup>";
			} else { // Fall back to the standard dropdown field
				$selected = $value == $this->value ? " selected=\"selected\"" : "";
				$options .= "<option$selected value=\"$value\">$title</option>";
			}
		}

		$id = $this->id();

		if( $this->required ) $extraAttributes[] = 'required';
		if( $this->multiple ) $extraAttributes[] = 'multiple';

		return "<select $classAttr name=\"$this->name\" id=\"$id\"" . implode(' ', $extraAttributes) . ">$options</select>";
	}
	
	/** 
	 * Sets this field to have a muliple select attribute
	 * @param boolean $bool
	 */
	public function setMultiple($bool) {
		$this->multiple = $bool;
	}
}