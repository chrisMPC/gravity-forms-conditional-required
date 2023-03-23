<?php
add_filter( 'gform_validation_25', 'custom_validation' );
function custom_validation( $validation_result ) {
	$form = $validation_result['form'];
	$field_ids = array( 1027, 1060, 1069 );
	$is_filled = false;
	$current_page = rgpost( 'gform_source_page_number_25' ) ? rgpost( 'gform_source_page_number_25' ) : 1;
	if ( $current_page == 2 ) {
		foreach ( $field_ids as $field_id ) {
			foreach ( $form['fields'] as &$field ) {
				if ( $field->id == $field_id ) {
					if ( $field->type === 'fileupload' ) {
						$uploaded_files = GFAPI::get_entries(
							$form['id'],
							array(
								'field_filters' => array(
									array(
										'key'   => $field->id,
										'value' => '',
										'operator' => '!='
									)
								)
							)
						);
						if ( ! empty( $uploaded_files ) ) {
							$is_filled = true;
							break;
						}
					} else {
						if ( ! empty( rgpost( 'input_' . $field_id ) ) ) {
							$is_filled = true;
							break;
						}
					}
				}
			}
			if ( $is_filled ) {
				break;
			}
		}
		if ( ! $is_filled ) {
			$validation_result['is_valid'] = false;
			foreach ( $form['fields'] as &$field ) {
				if ( in_array( $field->id, $field_ids ) ) {
					$field->failed_validation = true;
					$field->validation_message = 'Please fill at least one field.';
				}
			}
		}
	}
	return $validation_result;
}
?>