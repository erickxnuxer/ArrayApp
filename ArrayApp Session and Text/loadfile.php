<?php $myFile = fopen("text.txt", "r"); ?>

	<?php while( $baris = fgets($myFile) ) : ?> 

		<li><?= $baris; ?></li>
			
	<?php endwhile;?>

<?php fclose($myFile); ?>