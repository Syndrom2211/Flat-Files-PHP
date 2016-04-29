<?php
$nip		= $_POST['nip'];
$nama		= $_POST['nama'];
$alamat 	= $_POST['alamat'];
$umur		= $_POST['umur'];
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


if (isset($error)) {
	echo '<b>Error</b>: <br />'.implode('<br />', $error);
} else {
	$buka_dulu = fopen('file.txt', 'a') or die("Data tidak dapat dibuka");
	$datanya = $nip."#".$nama."#".$alamat."#".$umur."#".$no_telp."\r"."\n";
	fwrite($buka_dulu, $datanya);
	echo '<b>Data Berhasil di simpan.</b><br />';?>
	<script type="text/javascript">setTimeout("location.href='index.php';",2000);</script>
	<?php
}


?>