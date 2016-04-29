<?php
$nip = $_GET['nip'];

if (isset($error)) {
	echo '<b>Error</b>: <br />'.implode('<br />', $error);
} else {
	$baris = file("file.txt");
	$hapus = $nip;
	foreach($baris as $index => $indexnya)
	  if(stristr($indexnya, $hapus)) unset($baris[$index]);
		$data = implode("", array_values($baris));
		$file = fopen("file.txt",'w');
		fwrite($file, $data);
		fclose($file);
		header("Location:../index.php");
}
?>