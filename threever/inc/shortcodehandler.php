<?php

function shortcodedatahandler($atts, $content = null ) {
   //only add threejs and else if there is at least one shortcode on the viewing site
   if(!$hasThree){
		$hasThree = true;
		add_scripts();	
   }
   
   // get rid of strange quotations (don't know where they come from)
   $content = str_replace("&#8220;", "\"", $content);
   $content = str_replace("&#8221;", "\"", $content);
   $content = json_decode($content);
   
   if($content !== NULL){

		$content->{'id'} = $GLOBALS["threeverId"];
		//echo($content->{'id'});
		$GLOBALS["threeverId"]++;
		return '<canvas class="threever">'.json_encode($content).'</canvas>';
   
   }else{
   
		echo '<p class="error">There was an error with the shortcode</p>';
   }
}

add_shortcode( 'threever', 'shortcodedatahandler' );

?>