//display the files on the page
function displayFileList(filesArray) {
	"use strict";
	var searchBar = document.getElementById("dropDownfileList"); //get input element
	while(searchBar.firstChild) {
		searchBar.removeChild(searchBar.firstChild);
	}
	for(var i = 0; i < filesArray.length; i++) {
		var list = document.createElement('p');
		list.setAttribute('name', 'filelist');
		list.setAttribute('class', 'dropdownlist');
		list.setAttribute('onclick','selectFile(this);');
		list.innerHTML = filesArray[i].substring(filesArray[i].lastIndexOf('/') + 1);
		document.getElementById("dropDownfileList").appendChild(list);
	}
	searchBar.style.display="block";
	return true;
};

//mouse down event; close the drop down list
document.onmousedown = function(e) {
	"use strict";
	if(e.target.getAttribute('id') != 'searchBox' && 
		e.target.getAttribute('name') != 'filelist') {
		document.getElementById("dropDownfileList").style.display="none";
	}
};