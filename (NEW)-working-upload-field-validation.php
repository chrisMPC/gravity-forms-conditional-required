<?php
// This is actually working but perhaps there is a better way?
// Require file upload if message field empty
add_filter( 'gform_field_validation_25', function( $result, $value, $form, $field ) {
	$value = rgpost( 'input_1027' );
	if ( empty( $value ) ) {
	  if ( $field->multipleFiles ) {
		  $input_name = 'input_' . $field->id;
		  $files      = isset( GFFormsModel::$uploaded_files[ $form['id'] ][ $input_name ] ) ? GFFormsModel::$uploaded_files[ $form['id'] ][ $input_name ] : array();
		  GFCommon::log_debug( __METHOD__ . '(): $files content => ' . print_r( $files, true ) );
		  $count      = count( $files );
		  $min        = 1;
   
		  if ( $result['is_valid'] && $count < $min ) {
			  $result['is_valid'] = false;
			  $result['message']  = "Please add your equipment to the form using the message area, file upload, or itemized quote builder.";
		  }
	  }
	}
	return $result;
}, 10, 4 );
///////////////////////////////////////////
?>