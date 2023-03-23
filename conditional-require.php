<?php
add_filter( 'gform_pre_render', 'gw_conditional_requirement' );
add_filter( 'gform_pre_validation', 'gw_conditional_requirement' );
function gw_conditional_requirement( $form ) {
	$value = rgpost( 'input_1027' );
	if ( $value == '' ) {
		return $form;
	}
 
	foreach ( $form['fields'] as &$field ) {
		if ( $field->id == 1069 or 1060 ) {
			$field->isRequired = true;
		}
	}
	return $form;
}
?>