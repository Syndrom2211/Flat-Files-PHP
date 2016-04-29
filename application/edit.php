<?php
$nip		= $_POST['nip'];
$nama		= $_POST['nama'];
$alamat 	= $_POST['alamat'];
$umur 		= $_POST['umur'];
$no_telp 	= $_POST['no_telp'];

//validasi
if (trim($_POST['nip']) == '') {
	$error[] = '- NIP harus di isi';
}
if (trim($_POST['nama']) == '') {
	$error[] = '- Nama harus di isi';
}
if (trim($_POST['alamat']) == '') {
	$error[] = '- Alamat harus di isi';
}
if (trim($_POST['umur']) == '') {
	$error[] = '- Umur harus di isi';
}
if (trim($_POST['no_telp']) == '') {
	$error[] = '- No Telepon harus di isi';
}

if (isset($nip)){
	$awal = false;
	$baris = file("file.txt");
	foreach ($baris as $in_baris=>$barisnya) { 
		$data=explode('#', $barisnya);
		if ($data[0] == $nip) {
			$data_baru = $nip."#".$nama."#".$alamat."#".$umur."#".$no_telp."\r"."\n";
			$baris[$in_baris]=$data_baru;
			$awal = true;
			break;
		}
	}
	if ($awal) {
		$datanya=implode($baris);
		$buka_dulu = fopen("file.txt", 'w');
		fwrite($buka_dulu, $datanya);
		fclose($buka_dulu);
		echo '<b>Data Berhasil di edit.</b><br />';?>
	<script type="text/javascript">setTimeout("location.href='index.php';",2000);</script>
	<?php
	}
}
?>