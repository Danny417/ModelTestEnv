//global env variable
var Env = {
	scene : null,
	camera : null,
	renderer : null,
	light : null,
	loader : null,
	object : null //assume we only have one object in the env 
};	

//initialize and set up the environment
function init() {
	"use strict";
	Env.scene = new THREE.Scene();
	Env.camera = new THREE.PerspectiveCamera( 75, window.innerWidth / window.innerHeight, 0.1, 1000 );

	Env.renderer = new THREE.WebGLRenderer();
	Env.renderer.setSize( window.innerWidth, window.innerHeight-200 );
	document.body.appendChild( Env.renderer.domElement );

	Env.camera.position.z = 150;
	Env.camera.position.y = 10;
	// LIGHT
	Env.light = new THREE.PointLight(0xffffff);
	Env.light.position.set(0,0,150);
	setBulb(0);
	setBulbY(0);
	Env.scene.add(Env.light);
	
	Env.loader = new THREE.JSONLoader(); 
};

//a function that will loop itself to render the page
function render() {
	"use strict";
	try {
		requestAnimationFrame(render);
		Env.object.rotation.y += 0.01;
		Env.renderer.render(Env.scene, Env.camera);
	} catch(err) {
		//Console.log(err);
	}
}

//remove the previous object that is already in the environment and load the new object that user select
function selectFile(selectedFile) {
	"use strict";
	document.getElementById("dropDownfileList").style.display="none";
	try {
		Env.scene.remove(Env.object);
		loadObj(selectedFile.innerHTML);
	} catch(err) {
	}
};

function setCameraX(val) {
	Env.camera.position.x = val;
};
function setCameraY(val) {
	Env.camera.position.y = val;
};
function setCameraZ(val) {
	Env.camera.position.z = val;
};

function setLightX(val){
	Env.light.position.x = val;
};

function setLightY(val){
	Env.light.position.y = val;
};

function setLightZ(val){
	Env.light.position.z = val;
};

//load the object model to the environment by given the file name with extension
function loadObj(filename) {
	"use strict";
	Env.loader.load('../models/'+filename, function(geometry, materials) {
		var material = new THREE.MeshFaceMaterial(materials);
		Env.object = new THREE.Mesh(geometry, material);

		Env.object.scale.set(2, 2, 2);
		Env.scene.add(Env.object);
	});
};