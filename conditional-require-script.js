jQuery(document).ready(function($) {
   // Bind the change event to field ID 1027
   $('#input_1027').on('change', function() {
	  // Check if field ID 1027 is left blank
	  if($(this).val() == '') {
		 // Set field ID 1069 to required
		 gf("#field_25_1069").isRequired = true;
	  } else {
		 // Reset field ID 1069 to not required
		 gf("#field_25_1069").isRequired = false;
	  }
   });
});