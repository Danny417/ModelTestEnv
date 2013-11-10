<html>
	<head>
		<title>My first Three.js app</title>
		<style>canvas { width: 100%; height: 100% }</style>
	</head>
	<body>
		<input type="text" name="model input" value="model file name">
		
		<script>
			var filelist = <?php echo json_encode(glob('*.png')) ?>;
			for (var i = 0; i < filelist.length; i++ ){
				console.log(filelist[i]);
			}
		</script>
		
		<script src="https://rawgithub.com/mrdoob/three.js/master/build/three.js"></script>
		<script>
			var scene = new THREE.Scene();
			var camera = new THREE.PerspectiveCamera( 75, window.innerWidth / window.innerHeight, 0.1, 1000 );

			var renderer = new THREE.WebGLRenderer();
			renderer.setSize( window.innerWidth, window.innerHeight );
			document.body.appendChild( renderer.domElement );
			
			//var geometry = new THREE.CubeGeometry(1,1,1);
			//var material = new THREE.MeshBasicMaterial( { color: 0x00ff00 } );
			//var cube = new THREE.Mesh( geometry, material );
			//scene.add( cube );
	
			camera.position.z = 50;

			function render() {
				requestAnimationFrame(render);
				object.rotation.y += 0.01;
				object.rotation.x += 0.03;
				renderer.render(scene, camera);
			}
			var object;
var loader = new THREE.JSONLoader();          



loader.load("untitled.js", function(geometry, materials) {
     var material = new THREE.MeshFaceMaterial(materials);
     object = new THREE.Mesh(geometry, material);

     object.scale.set(2, 2, 2);
     scene.add(object);
});
    
     render();
		</script>
	</body>
</html>