<?php
session_start();

$cmd = $_GET["cmd"];

?>

<?php function pushArr() {  ?>

	<?php foreach ($_SESSION['array'] as $key => $value) : ?>
		<li>
			<?= $value; ?>
			<button id="delete" name="delete" value="delete" onclick="customizeArray(this.value, <?= $key ?>)">	&times;
			</button>
		</li>
	<?php endforeach; ?>


	<?= "#" . count($_SESSION['array']); ?>

<?php } ?>


<?php 
// Add array
if( $cmd == "addArray" ) {

	$teks = $_GET["teks"];
	array_push($_SESSION["array"], $teks);
	pushArr();

} 

// Hapus dari delakang
else if( $cmd == "removeArrayBelakang" ) {

	if(count($_SESSION["array"]) > 0) {
		array_pop($_SESSION["array"]);
		pushArr();
	}

} 

// Hapus dari depan
else if( $cmd == "removeArrayDepan" ) {

	if(count($_SESSION["array"]) > 0) {
		array_shift($_SESSION["array"]);
		pushArr();
	}

}

// Sort secara ascending
else if( $cmd == "sortASC" ) {

	if(count($_SESSION["array"]) > 0) {
		sort($_SESSION["array"]);
		pushArr();
	}

}

// Sort secara descending
else if( $cmd == "sortDSC" ) {

	if(count($_SESSION["array"]) > 0) {
		rsort($_SESSION["array"]);
		pushArr();
	}

}

// Acak Index jadi random
else if( $cmd == "acak" ) {

	if(count($_SESSION["array"]) > 0) {
		shuffle($_SESSION["array"]);
		pushArr();
	}

}

// Clear
else if( $cmd == "clear" ) {

	if(count($_SESSION["array"]) > 0) {
		$_SESSION["array"] = [];
		pushArr();
	}

}

// Clear
else if( $cmd == "count" ) {

	if(count($_SESSION["array"]) > 0) {
		pushArr();
	}

}

// Uppercasekan semua
else if( $cmd == "upper" ) {

	if(count($_SESSION["array"]) > 0) {
		$_SESSION['array'] = array_map('strtoupper', $_SESSION['array']);
		pushArr();
	}

}

// Lowercasekan semua
else if( $cmd == "lower" ) {

	if(count($_SESSION["array"]) > 0) {
		$_SESSION['array'] = array_map('strtolower', $_SESSION['array']);
		pushArr();
	}

}

// Hapus Per Index
else if( $cmd == "removeArrayByIndex" ) {

	$indexArray = $_GET["indexArray"];
	array_splice($_SESSION["array"], $indexArray, 1);
	pushArr();

}


?>