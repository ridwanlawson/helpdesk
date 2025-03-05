<?php
$hd = $_GET['hd'];
$fd = $_GET['fd'];
session_start();
include '../../config/index.php'; 
$pekerjaan = $_POST['nm_pekerjaan'];

$sql = "INSERT INTO pekerjaan VALUES (null, '$pekerjaan')";
$query = $conn->query($sql);
if ($query) {
	echo '<script>
			window.location.href = "../../index.php?hd='.$hd.'&fd='.$fd.'&res=sukses&act=tambah";
		 </script>';
}else{
	$data = "Error ".$conn->error;
	echo '<script>
			window.location.href = "../../index.php?hd='.$hd.'&fd='.$fd.'&res=gagal&act=tambah&cau='.$data.'";
		 </script>';
}

$conn->close();

 ?>