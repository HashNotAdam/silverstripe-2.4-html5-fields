<?php
/**
 * Tries to keep the classes in this module as DRY as possible by creating
 * "magic methods" for common functionality
 */
class HTML5FieldsDecorator extends DataObjectDecorator {

	/**
	 * Construct and return HTML tag
	 * Most fields are rendered with the same logic
	 */
	public function createHTML5Tag($tag, $attributes, $content = null) {
		$preparedAttributes = '';
		foreach($attributes as $k => $v) {
			if($v || in_array($v, array('0', 0), true) || $k == 'value')
				$preparedAttributes .= " $k=\"" . Convert::raw2att($v) . "\"";
		}
		$required = $this->owner->required ? ' required' : '';

		if($content || $tag != 'input') return "<{$tag}{$preparedAttributes}{$required}>$content</$tag>";
		else return "<{$tag}{$preparedAttributes}{$required}>";
	}

	/**
	 * @param string $content content between opening and closing tags (where used)
	 */
	public function defaultField( $content = null ) {
		// We can generally assume that we want to make an input tag
		$tagType = isset($this->owner->tagType) ? $this->owner->tagType : 'input';

		// The default class will be the HTML5 class name
		// Also add the standard class name so legacy styles are not broken
		$this->owner->addExtraClass($this->owner->parentClass());

		$attributes = array(
			'type' => $this->owner->type,
			'id' => $this->owner->id(),
			'name' => $this->owner->Name(),
			'tabindex' => $this->owner->getTabIndex(),
			'maxlength' => $this->owner->maxLength ?: null,
			'size' => $this->owner->maxLength ? min($this->owner->maxLength, 30) : null
		);

		$classes = array();
		if( $tagType == 'input' )
			$classes[] = 'text';
		$classes[] = $this->owner->XML_val('Type');
		if( $extraClasses = $this->owner->extraClass() )
			$classes[] = $extraClasses;
		$attributes['class'] = implode(' ', $classes);
		
		if( $this->owner->pattern )
			$attributes['pattern'] = $this->owner->pattern;

		if( $this->owner->hasMethod('amendAttributes') )
			$attributes = array_merge($attributes, $this->owner->amendAttributes($attributes));
		if( $this->owner->hasMethod('amendContent') )
			$attributes = array_merge($attributes, $this->owner->amendAttributes($attributes));

		if( $this->owner->placeholder ) $attributes['placeholder'] = $this->owner->placeholder;
		if( $value = $this->owner->Value() ) $attributes['value'] = $value;
		if( $this->owner->disabled ) $attributes['disabled'] = 'disabled';

		return $this->createHTML5Tag($tagType, $attributes, $content);
	}

	/**
	 * Most FieldHolders are rendered in exactly the same way
	 */
	public function defaultFieldHolder() {
		$varLabels = array(
			'extraClass', 'Field', 'Name', 'Message',
			'MessageType', 'RightTitle', 'Title', 'Type'
		);
		$vars = array();

		foreach( $varLabels as $label ) {
			$vars[$label] = $this->owner->XML_val($label);
		}
		$vars['ID'] = $this->owner->id();

		return $this->owner->renderWith('HTML5TextFieldHolder', $vars);
	}

	/**
	 * When using a template for FieldHolder
	 * this will render the field by calling the owner's Field method
	 *
	 * @return string
	 */
	public function getRenderedField() {
		return $this->owner->Field();
	}

	/**
	 * Sets the required attribute on the field
	 * As a help, can also add or remove the field from a validator
	 *
	 * @param boolean   $required
	 * @param Validator $validator Most likely going to be a RequiredFields object
	 */
	public function setAsRequired( $required = true, $validator = null ) {
		$this->owner->required = $required;

		if( $validator ) {
			$func = ($required ? 'add' : 'remove') . 'RequiredField';
			$validator->$func($this->owner);
		}
	}
}