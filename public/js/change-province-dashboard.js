var changeProvinceRoutePath = $("#cPRPurl").val();
function setUpMostDynamicSchoolInProvince( provId ) {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("my-table").innerHTML = this.responseText;
		}
	};
	xhttp.open("GET", changeProvinceRoutePath + "?prov_id=" + provId, true);
	xhttp.send();
}

function changeProvince( selectMenu ) {
	var provId = selectMenu.value;
	setUpMostDynamicSchoolInProvince(provId);
}
setUpMostDynamicSchoolInProvince(1);

