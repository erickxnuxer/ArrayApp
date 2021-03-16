<?php

$cmd = $_GET["cmd"];

$array = explode(PHP_EOL, file_get_contents('text.txt'));
?>


<?php function result() {
	global $array;

	$myFile = fopen("text.txt", "w"); ?>

	<?php foreach ($array as $key => $value) : ?>

		<li>
			<?= $value ?>
			<button id="delete" name="delete" value="delete" onclick="customizeArray(this.value, <?= $key ?>)">&times;
			</button>
		</li>

	<?php endforeach; ?>

<?php	
	$newArray = implode(PHP_EOL, $array);
	fwrite($myFile, $newArray);

	echo "#" . count($array); ?>
<?php } ?>


<?php
// Add array
if( $cmd == "addArray" ) {

	$teks = $_GET["teks"];
	array_push($array, $teks);
	result();
} 

// Hapus dari delakang
else if( $cmd == "removeArrayBelakang" ) {

	if(count($array) > 0) {
		array_pop($array);
		result();
	}

} 

// Hapus dari depan
else if( $cmd == "removeArrayDepan" ) {

	if(count($array) > 0) {
		array_shift($array);
		result();
	}

}

// Sort secara ascending
else if( $cmd == "sortASC" ) {

	if(count($array) > 0) {
		sort($array);
		result();
	}

}

// Sort secara descending
else if( $cmd == "sortDSC" ) {

	if(count($array) > 0) {
		rsort($array);
		result();
	}

}

// Acak Index jadi random
else if( $cmd == "acak" ) {

	if(count($array) > 0) {
		shuffle($array);
		result();
	}

}

// Clear
else if( $cmd == "clear" ) {

	if(count($array) > 0) {
		$array = [];
		result();
	}

}

// Clear
else if( $cmd == "count" ) {

	if(count($array) > 0) {
		result();
	}

}

// Uppercasekan semua
else if( $cmd == "upper" ) {

	if(count($array) > 0) {
		$array = array_map('strtoupper', $array);
		result();
	}

}

// Lowercasekan semua
else if( $cmd == "lower" ) {

	if(count($array) > 0) {
		$array = array_map('strtolower', $array);
		result();
	}

}

// Hapus Per Index
else if( $cmd == "removeArrayByIndex" ) {

	$indexArray = $_GET["indexArray"];
	array_splice($array, $indexArray, 1);
	result();

}

// Tampilkan sesuai range
else if( $cmd == "range" ) {

	if(count($array) > 0) {
		$range = $_GET['length'];

		$myFile = fopen("text.txt", "r") or die ("Tidak bisa open file.");

		for( $i = 0; $i < $range; $i++ ) { ?>

			<li><?= $array[$i]; ?><button id="delete" name="delete" value="delete" onclick="customizeArray(this.value, <?= $i ?>)">&times;</button></li>

		<?php }

		echo "#" . count($array);
	}

}

?>