<?php
	session_start();
	$_SESSION["array"] = [];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Array App</title>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

<style>
	
.main {
	margin-top: 100px;
	width: 100vw;
	display: flex;
	flex-direction: row;
}

#array {
	flex: 0 0 50%;
	width: 100%;
}

#fileText {
	flex: 0 0 50%;
	width: 100%;
}

</style>	
</head>

<body>

	<div class="container">

		<div class="tools">
			<input type="text" id="inputan" name="inputan">

			<button id="simpan" name="simpan" value="simpan" onclick="customizeArray(this.id)">Add</button>
			<button id="hapus" name="hapus" value="hapus" onclick="customizeArray(this.id)">Hapus Dari Belakang</button>
			<button id="hapus2" name="hapus2" value="hapus2" onclick="customizeArray(this.id)">Hapus Dari Depan</button>

			<div>Menampilkan: <span id="point"></span> Index</div>

			<button id="clear" name="clear" value="clear" onclick="fClear()">Clear</button>
			<button id="acak" name="acak" value="acak" onclick="customizeArray(this.id)">Acak</button>
			<button id="count" name="count" value="count" onclick="fCount()">Count</button>
			<button id="upper" name="upper" value="upper" onclick="customizeArray(this.id)">Uppercase</button>
			<button id="lower" name="lower" value="lower" onclick="customizeArray(this.id)">Lowercase</button>
			<button id="sortASC" name="sortASC" value="sortASC" onclick="customizeArray(this.id)"><i class="fas fa-sort-alpha-down"></i></button>
			<button id="sortDSC" name="sortDSC" value="sortDSC" onclick="customizeArray(this.id)"><i class="fas fa-sort-alpha-up-alt"></i>	</button>
			
			<div id="total"></div>
		</div>

		<div class="main" >
			<div id="array"><h2>Data Array</h2></div>

			<div id="fileText"><h2>Bagian ini tidak berfungsi soalnya cuma pake session</h2></div>
		</div>

	</div>
<script>

let array = document.getElementById("array");
let fileText = document.getElementById("fileText");
let inputan = document.getElementById("inputan");


function customizeArray(button, indexArray = null) {
	var teks = document.getElementById("inputan").value;
	var url = "ajax.php?cmd=addArray&teks="+teks;

	if ( button == "hapus" ) {

		url = "ajax.php?cmd=removeArrayBelakang";

	} else if ( button == "hapus2" ) {

		url = "ajax.php?cmd=removeArrayDepan";

	} else if ( button == "delete" ) {

		url = "ajax.php?cmd=removeArrayByIndex&indexArray="+indexArray;

	} else if ( button == "sortASC" ) {

		url = "ajax.php?cmd=sortASC";

	} else if ( button == "sortDSC" ) {

		url = "ajax.php?cmd=sortDSC";

	} else if ( button == "acak" ) {

		url = "ajax.php?cmd=acak";

	} else if ( button == "upper" ) {

		url = "ajax.php?cmd=upper";

	} else if ( button == "lower" ) {

		url = "ajax.php?cmd=lower";

	}

	var xhttp;
	xhttp = new XMLHttpRequest();

	xhttp.onreadystatechange = function() {
		if(this.readyState === 4 && this.status === 200) {
			data = this.responseText;
			datafix = data.split("#");

			array.innerHTML = datafix[0];
			document.getElementById('point').innerHTML = datafix[1];

			inputan.value = "";
			loadFile();
		}
	};
	xhttp.open("GET", url, true);
	xhttp.send();
}

function loadFile() {
	var url = "loadfile.php";
	var xhttp;
	xhttp = new XMLHttpRequest();

	xhttp.onreadystatechange = function() {
		if(this.readyState === 4 && this.status === 200) {
			fileText.innerHTML = this.responseText;
		}
	};
	xhttp.open("GET", url, true);
	xhttp.send();
}

function fCount() {
	var url = "ajax.php?cmd=count";
	var xhttp;
	xhttp = new XMLHttpRequest();

	xhttp.onreadystatechange = function() {
		if(this.readyState === 4 && this.status === 200) {
			document.getElementById('total').innerHTML = "<h3>Total List: " + datafix[1] + "</h3>";
		}
	};
	xhttp.open("GET", url, true);
	xhttp.send();
}

function fClear() {
	var url = "ajax.php?cmd=clear";
	var xhttp;
	xhttp = new XMLHttpRequest();

	xhttp.onreadystatechange = function() {
		if(this.readyState === 4 && this.status === 200) {
			data = this.responseText;
			datafix = data.split("#");

			array.innerHTML = datafix[0];
			document.getElementById('range').max = datafix[1];
			document.getElementById('point').innerHTML = datafix[1];

			inputan.value = "";
			loadFile();
			fCount();
		}
	};
	xhttp.open("GET", url, true);
	xhttp.send();
}


</script>
</body>
</html>