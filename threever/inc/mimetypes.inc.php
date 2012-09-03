<?php

add_filter('upload_mimes', 'custom_upload_mimes');

//Add mime types for upload support
function custom_upload_mimes ( $existing_mimes=array() ) {

// only .js is supported right now i hope to get the others working later on

//$existing_mimes['obj'] = 'application/octet-stream'; 
//$existing_mimes['dae'] = 'application/octet-stream';
$existing_mimes['js'] = 'application/javascript';
//$existing_mimes['ctm'] = 'application/javascript';
 
// and return the new full result
return $existing_mimes;

}

?>