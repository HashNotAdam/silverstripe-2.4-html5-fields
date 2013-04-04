<?php
$customClasses = array(
	'DropdownField' => 'HTML5DropdownField',
	'EmailField' => 'HTML5EmailField',
	'NumericField' => 'HTML5NumericField',
	'PhoneNumberField' => 'HTML5PhoneNumberField',
	'TextField' => 'HTML5TextField',
	'URLField' => 'HTML5URLField'
);

foreach( $customClasses as $default => $custom ) {
	Object::useCustomClass($default, $custom);
}