<!DOCTYPE html>
<html>
<head>
	<title>Array App</title>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

<style>
	
* {
	box-sizing: border-box;
	font-family: 'Quicksand', sans-serif;
	outline: none;
}

body {
	margin: 0;
	padding: 0;
	background-color: #f6f6f6;
}

.container {
	position: absolute;
	left: 50%;
	top: 50%;
	width: 60%;
	height: 75vh;
	box-shadow: 0 0 20px rgba(0,0,0,.2);
	border-radius: 15px;
	transform: translate(-50%, -50%);
	background-color: white;
	display: flex;
	flex-direction: column;
	padding: 15px;
}

.tools {
	flex: 0 0 35%;
	display: flex;
	flex-wrap: wrap;
}

.tools > * {
	margin: 3px;
	border-radius: 10px;
	border: none;
	transition: .3s;
	font-weight: 600;
}

.tools > *:hover {
	cursor: pointer;
	box-shadow: 0 0 10px rgba(0,0,0,.1);
}

.tools input[type=text] {
	width: 90%;
	padding: 10px;
	border: 1px solid rgba(0,0,0,.2);
}

.tools button {
	padding: 10px;
}

.main {
	flex: 0 0 65%;
	display: flex;
	flex-direction: row;
}

#array {
	color: white;
	font-weight: 800;
	font-size: 30px;
	display: flex;
	flex-wrap: wrap;
	flex-direction: column;
	padding: 15px;
	border-radius: 10px;
	width: 100%;
	height: 300px;
	margin: 0 5px;
	margin-top: 5px;
	background-color: #9ac8eb;
}

#fileText {
	color: white;
	font-weight: 800;
	font-size: 30px;
	display: flex;
	flex-wrap: wrap;
	flex-direction: column;
	padding: 15px;
	border-radius: 10px;
	width: 100%;
	height: 300px;
	margin: 0 5px;
	margin-top: 5px;
	background-color: #f4cfdf;
}

li {
	display: flex;
	align-items: center;
}

#simpan {
	width: 8%;
}

#delete {
	background-color: transparent;
	font-size: 25px;
	font-weight: 800;
	border: none;
	display: flex;
	align-items: center;
	transition: .3s;
}

#delete:hover {
	color: red;
}

#hapus, #hapus2 {
	background-color: #fb1f3a;
	width: 20%;
}

.range {
	display: flex;
	align-items: center;
	justify-content: space-around;
	width: 50%;
}

#simpan {
	background-color: #6ac7e6;
}

#sortASC, #sortDSC {
	background-color: #fed154;
	width: 7%;
	font-size: 20px;
}

#upper, #lower {
	background-color: #c8a8da;
}

#acak, #count {
	background-color: #bef2e5;
}

#clear {
	background-color: #bbd5a6;
}

</style>	
</head>

<body>

	<div class="container">

		<div class="tools">
			<input type="text" id="inputan" name="inputan">

			<button id="simpan" name="simpan" value="simpan" onclick="customizeArray(this.id)">Add</button>
			<button id="hapus" 	name="hapus"  value="hapus"  onclick="customizeArray(this.id)">Hapus Dari Belakang</button>
			<button id="hapus2" name="hapus2" value="hapus2" onclick="customizeArray(this.id)">Hapus Dari Depan</button>

			<div class="range">
				<input type="range" id="range" name="range" max="<?= count($_SESSION['array']) ?>" value="" oninput="customizeArray(this.id)">
				<for>Menampilkan: <span id="point"></span> Index</for>
			</div>

			<button id="clear"   name="clear" 	value="clear" 	onclick="fClear()">Clear</button>
			<button id="acak"    name="acak"  	value="acak" 	onclick="customizeArray(this.id)">Acak</button>
			<button id="count"   name="count" 	value="count" 	onclick="fCount()">Count</button>
			<button id="upper"   name="upper" 	value="upper" 	onclick="customizeArray(this.id)">Uppercase</button>
			<button id="lower"   name="lower" 	value="lower" 	onclick="customizeArray(this.id)">Lowercase</button>
			<button id="sortASC" name="sortASC" value="sortASC" onclick="customizeArray(this.id)"><i class="fas fa-sort-alpha-down"></i></button>
			<button id="sortDSC" name="sortDSC" value="sortDSC" onclick="customizeArray(this.id)"><i class="fas fa-sort-alpha-up-alt"></i>	</button>
			
			<div id="total"></div>
		</div>

		<div class="main" >
			<div id="array"><h2>Data Array</h2></div>

			<div id="fileText"><h2>Data File</h2></div>
		</div>

	</div>
<script>

let array = document.getElementById("array");
let fileText = document.getElementById("fileText");
let inputan = document.getElementById("inputan");


function customizeArray(button, indexArray = null) {
	var range = document.getElementById('range').value;
	console.log(range);
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

	} else if ( button == "range" ) {

		url = "ajax.php?cmd=range&length="+range;

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
			document.getElementById('range').max = datafix[1];
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