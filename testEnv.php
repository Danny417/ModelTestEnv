<html>
	<head>
		<title>Test Environment</title>
		<link rel="stylesheet" type="text/css" href="../css/input.min.css">
		<link rel="stylesheet" type="text/css" href="../css/icon.min.css">
		<link rel="stylesheet" type="text/css" href="../css/label.min.css">
		<link rel="stylesheet" type="text/css" href="../css/divider.min.css">
		<link rel="stylesheet" type="text/css" href="../css/segment.min.css">
		<link rel="stylesheet" type="text/css" href="../css/main.css">
		<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
		<meta content="utf-8" http-equiv="encoding">
	</head>
	<body>
		<div class="ui secondary inverted segment" id="menuBar">
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
				</td>
			</tr>
		</table>
		<table style="margin:0px auto;">
			<tr id="lightRow">
				<td>
					<div class = "ui-widget-ontent" id="draggable">
					</div>
				</td>
				<td>
					<div class="ui mini input">
						<input id="lightX" type="number" onkeyup="setLightX(this.value)" onchange="setLightX(this.value); setBulb(this.value)" placeholder="Enter Light X" /> 
					</div>
				</td>
				<td>
					<div class="ui mini input">
						<input id="lightY" type="number" onkeyup="setLightY(this.value)" onchange="setLightY(this.value); setBulbY(this.value)" placeholder="Enter Light Y"/> 
					</div>
					<div class="ui mini input">
						<input id="lightZ" type="number" onkeyup="setLightZ(this.value)" onchange="setLightZ(this.value)" placeholder="Enter Light Z"/> 
					</div>
				</td>
			</tr>
		</table>
		</div>
		<div class="ui horizontal divider">Models</div>
		<script type="text/javascript" src="../js/main.js"></script>
		<script src="https://rawgithub.com/mrdoob/three.js/master/build/three.js"></script>
		<script src="../js/env.js"></script>
		<script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
		<script type="text/javascript">
			//action when user type in the search box
			function typeSearch() 
			{
				"use strict";
				var filesArray = <?php echo json_encode(glob('./models/*.js')) ?>; //get file list in models folder
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
			//action when user scrolls
			$(window).bind('mousewheel MozMousePixelScroll', function(event) {
    		//for chrome
			if(event.originalEvent.wheelDelta){
				Env.camera.position.z += event.originalEvent.wheelDelta/15;
			}
			//for firefox
			else if (event.originalEvent.detail){
				Env.camera.position.z += event.originalEvent.detail/2;
			}
			//check ie before pushing code
			});
			
			$(function(){
				$("#draggable").draggable({
				containment: "document",
				drag: function(){
					var top = JSON.stringify($("#draggable").position().top);
					var y2d = $(window).height()/2 + $("#menuBar").height();
					var left = JSON.stringify($("#draggable").position().left);
					var x2d = $(window).width()/2;
					var diffX = left-x2d;
					var diffY = y2d-top;
					var inputX = document.getElementById("lightX");
					var inputY = document.getElementById("lightY");
					setLightY(parseInt(diffY)+Env.camera.position.y);
					setLightX(parseInt(diffX)+ Env.camera.position.x);
					inputX.value = parseInt(Env.light.position.x);
					inputY.value = parseInt(Env.light.position.y);
					}
				});
			});
			
			function setBulb(x){
				//$("#draggable").parent().css({position:'absolute'});
				var left = x - Env.camera.position.x + $(window).width()/2;
				$("#draggable").css({'left':left, position:'absolute'});
			};
			
			function setBulbY(y){
				var top = Env.camera.position.y - y + $(window).height()/2 + $("#menuBar").height();
				$("#draggable").css({'top':top, position:'absolute'});
			
			};
			init();  			
     		render();
		</script>
	</body>
</html>