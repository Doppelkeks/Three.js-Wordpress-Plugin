

//MAIN
var threements = [];
var elements = jQuery("canvas.threever");
var loaded = 0;

jQuery(elements).each(function(index){
	
	var jsonArray = jQuery.parseJSON( jQuery(this).html() );
	console.log(jsonArray);
	
	//Generate new Object
	threements.push(new ThreeverElement(jsonArray,this));
	
	jQuery(this).html('');
	jQuery(this).css('width',threements[index].width+"px");
	jQuery(this).css('height',threements[index].height+"px");
	
	if(index == elements.length-1)
		animate();
});

function animate() {
	requestAnimationFrame( animate );

	var timer = Date.now() * 0.0005;

	//Draw and animate elements inside the global array
	for(var i=0; i<loaded; i++){
		threements[i].mesh.rotation.y += 0.01;	
		threements[i].camera.lookAt( threements[i].scene.position );
		threements[i].renderer.render( threements[i].scene, threements[i].camera );
	}
	
}

