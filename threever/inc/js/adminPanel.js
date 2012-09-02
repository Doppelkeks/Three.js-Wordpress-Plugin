function setText(val){
	text=val;
	text=text.replace("&#8220;", "\"");
	text=text.replace("&#8221;", "\"");
	console.log("yes");
}

function animate() {
	requestAnimationFrame( animate );

	var timer = Date.now() * 0.0005;

	//Draw and animate elements inside the global array
	for(var i=0; i<loaded; i++){
		threeElement.mesh.rotation.y += 0.01;	
		threeElement.camera.lookAt( threeElement.scene.position );
		threeElement.renderer.render( threeElement.scene, threeElement.camera );
	}
	
}
var loaded = 0;
var text = "";
var threeElement;

jQuery(document).ready(function() {

	var iframePath = jQuery("#threever_sectionid #iframeholder").html();
	jQuery("#threever_sectionid #iframeholder").remove();
	
	var iframe='<div id="threeverDrag" style="position:absolute; z-index:9000; border:2px solid #000; border-radius:5px; background:#666; padding:30px 0px 0px 0px; left:200px; cursor:move; top:50px; width:550px;">'+
					'<iframe style="border-top:2px solid #000; width:550px; height: 700px;" src="'+iframePath+'" frameborder="0">'+
					'</iframe>'+
				'</div>'
	
    jQuery(iframe).prependTo('body');
	jQuery("#threeverDrag").draggable({ });
	jQuery("#threeverDrag").hide();
	
	jQuery("#toggleIframe").toggle(function(){
		jQuery(this).html("Close Dialog");
		jQuery("#threeverDrag").show();
		jQuery("#threeverDrag").css("left","200px");
		jQuery("#threeverDrag").css("top","50px");
	},function(){
		jQuery(this).html("Open Dialog");
		jQuery("#threeverDrag").hide();
	});
	
	var interval = 0;
	var canvas = jQuery("#myCanvas");
		jQuery(canvas).draggable({ });
	var txtArea = jQuery("#mycode").text();
		txtArea = txtArea.replace("&#8220;", "\"");
		txtArea = txtArea.replace("&#8221;", "\"");
		text = txtArea;
		
	jQuery("#togglePreview").toggle(function(){
		jQuery("#myCanvas").show();
		jQuery("#myCanvas").css("left","700px");
		jQuery("#myCanvas").css("top","50px");
		jQuery(this).html("Close Preview");
		
		interval = setInterval(function(){
			if(text !== txtArea){
				txtArea = text;
				console.log("moin");
				loaded = 0;
				var opts = jQuery.parseJSON(txtArea);
				//console.log(opts.filepath+"hier"+ jQuery("#myCanvas"));
				threeElement = new ThreeverElement(opts,document.getElementById("myCanvas"));
				jQuery(canvas).css('width',threeElement.width+"px");
				jQuery(canvas).css('height',threeElement.height+"px");
			}
		},500);
		
	},function(){
		jQuery(this).html("3D Preview");
		jQuery("#myCanvas").hide();
		clearInterval(interval);
		
	});
	
	animate();
});
