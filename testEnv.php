<html>
	<head>
		<title>Test Environment</title>
		<link rel="stylesheet" type="text/css" href="../css/input.min.css">
		<link rel="stylesheet" type="text/css" href="../css/icon.min.css">
		<link rel="stylesheet" type="text/css" href="../css/label.min.css">
		<link rel="stylesheet" type="text/css" href="../css/divider.min.css">
		<link rel="stylesheet" type="text/css" href="../css/segment.min.css">
		<link rel="stylesheet" type="text/css" href="../css/main.css">
		
	</head>
	<body>
		<div class="ui secondary inverted segment">
		<table style="margin:0px auto;">
			<tr>
				<td>
					<div class="ui mini icon input">
						<input type="text" id="searchBox" onkeyup="typeSearch();" onmouseup="clickOnSearch();" placeholder="Search ..."/>
						<i class="circular search icon"></i>
					</div>						
					<div class="dropdownlist" id="dropDownfileList" />
				</td>
				<td>
					<div class="ui mini input">
						<input id="cameraX" type="number" onkeyup="setCameraX(this.value)" onchange="setCameraX(this.value)" placeholder="Enter Camera X"/> 
					</div>
					<div class="ui mini input">
						<input id="cameraY" type="number" onkeyup="setCameraY(this.value)" onchange="setCameraY(this.value)" placeholder="Enter Camera Y"/> 
					</div>
					<div class="ui mini input">
						<input id="cameraZ" type="number" onkeyup="setCameraZ(this.value)" onchange="setCameraZ(this.value)" placeholder="Enter Camera Z"/> 
					</div>
				</td>
			</tr>
		</table>
		</div>
		<div class="ui horizontal divider">Models</div>
		<script type="text/javascript" src="../js/main.js"></script>
		<script src="https://rawgithub.com/mrdoob/three.js/master/build/three.js"></script>
		<script src="../js/env.js"></script>
		<script type="text/javascript">
			//action when user type in the search box
			function typeSearch() 
			{
				"use strict";
				var filesArray = <?php echo json_encode(glob('./models/*.js')) ?>;
				var resultList = [];
				var searchStr = document.getElementById("searchBox").value;	
				for(var i = 0; i < filesArray.length; i++)
				{
					if(filesArray[i].toLowerCase().indexOf(searchStr.toLowerCase()) >= 0)
					{
						resultList.push(filesArray[i]);
					}
				}	
				displayFileList(resultList);
			};
			//action when user click on the search box
			function clickOnSearch() {
				"use strict";
				var filesArray = <?php echo json_encode(glob('./models/*.js')) ?>;
				displayFileList(filesArray);
			};
					
			init();  			
     		render();
		</script>
	</body>
</html>