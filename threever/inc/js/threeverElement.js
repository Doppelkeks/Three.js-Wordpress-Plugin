function createScene(geometry,copy){
		//console.log(geometry);
		geometry.computeVertexNormals();
		geometry.computeTangents();
		geometry.castShadow = true;
		geometry.receiveShadow  = false;
		copy.mesh = new THREE.Mesh( geometry, copy.material);

		/* Next 3 lines seems not to be mandatory */
		copy.mesh.geometry.dynamic = true
		copy.mesh.geometry.__dirtyVertices = true;
		copy.mesh.geometry.__dirtyNormals = true;
		copy.mesh.doubleSided = true;
		copy.scene.add(copy.mesh);
		
		loaded++;
}

function ThreeverElement(opts,canvas){

	//Height and width of element
	this.width = parseInt(opts.width);
	this.height = parseInt(opts.height);
	
	//Specify the loader according to filetype
	var meshType = opts.filepath.split('.').pop().toLowerCase();
	switch(meshType)
	{
	case "dae":
	  this.loader = new THREE.ColladaLoader();
	  break;
	case "obj":
	  this.loader = new THREE.OBJLoader();
	  break;
	case "js":
	  this.loader = new THREE.JSONLoader();
	  break;
	case "ctm":
	  this.loader = new THREE.CTMLoader();
	 break; 
	
	//in case wrong or no filetype specified
	default:
	  return;
	}
	
	//init empty light array
	this.lights=[];
	
	//CAMERA
	
	//4 arguments = we have a perspective camera
	if(opts.camera.length == 4){
		this.camera = new THREE.PerspectiveCamera(opts["camera"][0], //fov
												  opts["camera"][1], //aspect
												  opts["camera"][2], //near
												  opts["camera"][3]); //far
		
	//6 arguments = we have a orthographic camera
	}else if(opts.camera.length == 6){
		this.camera = new THREE.OrthographicCamera(opts["camera"][0], //left
												   opts["camera"][1], //rigth
												   opts["camera"][2], //top
												   opts["camera"][3], //bottom
												   opts["camera"][4], //near
												   opts["camera"][5]); //far
	}		

	//CAMERA POSITION
	this.camera.position.set(opts.cameraPos[0],opts.cameraPos[1],opts.cameraPos[2]);	

	//LIGHTS

	//AMBIENT
	var ambient = opts.lights[0][0];

	if(ambient != null){
		this.lights.push(new THREE.AmbientLight(ambient));
		console.log("Added AmbientLight with color "+ambient);
	}
	
	//DIRECTIONAL
	var directional = opts.lights[1];
	if(directional[0] != null){
		console.log("here");
		this.lights.push(new THREE.DirectionalLight(directional[0], 1));
		this.lights[this.lights.length-1].castShadow = true;
		this.lights[this.lights.length-1].position.set( directional[1][0], directional[1][1], directional[1][2] ).normalize();
		console.log("Added DirectionalLight with color "+directional[0]+" and position: "+directional[1]);
		//this.lights[this.lights.length-1].shadowCameraVisible	= true;
	}
	
	//POINT
	var point = opts.lights[2];
	if(point[0] != null)
	for(var i=0;i<point.length;i++)
	{
		this.lights.push(new THREE.PointLight(point[i][0],2, 800));
		this.lights[this.lights.length-1].position.set( point[i][1][0], point[i][1][1], point[i][1][2] );
		console.log("Added PointLight with color "+point[i][0]+" and position: "+point[i][1]);
	}
	
	//SPOT
	var spot = opts.lights[3];
	if(spot[0] != null)
	for(var i=0;i<spot.length;i++)
	{
		this.lights.push(new THREE.SpotLight(spot[i][0]));
		this.lights[this.lights.length-1].position.set( spot[i][1][0], spot[i][1][1], spot[i][1][2] ).normalize();
		console.log("Added SpotLight with color "+spot[i][0]+" and position: "+spot[i][1]);
		spotLight.castShadow = true;
		
		//not sure what this is D:
		spotLight.shadowMapWidth = 1024;
		spotLight.shadowMapHeight = 1024; 
		spotLight.shadowCameraNear = 500;
		spotLight.shadowCameraFar = 4000;
		spotLight.shadowCameraFov = 30;
	}
	
	//Material Creation 
	
	var material = {};
	material.shading = THREE.SmoothShading;
	material.color = opts.diffuse[1];
	material.specular = opts.specular[1];	
	material.shininess = opts.shininess;
	
	
	if(opts.diffuse[0] !== ""){
		console.log("lol"+opts.diffuse[0]);
		var DTex = THREE.ImageUtils.loadTexture(opts.diffuse[0]);
			//DTex.anisotropy = 16;
			DTex.wrapS = DTex.wrapT = THREE.RepeatWrapping;
		material.map = DTex;
	}
	if(opts.specular[0] !== ""){
		console.log("lol2"+opts.specular[0]);
		var STex = THREE.ImageUtils.loadTexture(opts.specular[0]);
			//STex.anisotropy = 16;
			STex.wrapS = STex.wrapT = THREE.RepeatWrapping;
		material.specularMap = STex;
	}
	if(opts.normal !== "" && opts.normal !== undefined){
		console.log("lol3"+opts.normal);
		var NTex = THREE.ImageUtils.loadTexture(opts.normal);
			//NTex.anisotropy = 16;
			NTex.wrapS = NTex.wrapT = THREE.RepeatWrapping;
		material.bumpMap = NTex;
	}
	if(opts.normalScale)
		material.bumpScale = opts.normalScale;
		
	material.perPixel = true;
	
	if(opts.isWireframe)
		material.wireframe = true;
		
	if(opts.idDoubleSide)
		material.side = THREE.DoubleSide;
			
	this.material = new THREE.MeshPhongMaterial(material);


	//Create an own Scene
	this.scene = new THREE.Scene();
	
	//Add generated camera to scene
	this.scene.add(this.camera);
	
	//Add all lights
	for(var elem in this.lights){
		this.scene.add(this.lights[elem]);
	}
	
	//Add Material to scene
	this.scene.add(this.material);
	
	//load model file
	this.load = function(){
		//scope issuse fix
		var copy = this;
		var callback = function( geometry ) { createScene( geometry , copy ); };
		this.loader.load( opts.filepath, callback );	
	};
	this.load();
	
	
	//Renderer
	this.renderer = new THREE.WebGLRenderer({antialiasing: true , canvas: canvas});
	this.renderer.setSize(this.width, this.height);
	this.renderer.shadowMapEnabled	= true;
	this.renderer.shadowMapSoft		= true;
	this.renderer.physicallyBasedShading = true;
}