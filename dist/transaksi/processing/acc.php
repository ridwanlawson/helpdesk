<?php
$hd = $_GET['hd'];
$fd = $_GET['fd'];
session_start();
include '../../config/index.php';

	$id = $_GET['id'];

if ($_SESSION['level']=='admin') {
	$sql = "UPDATE pengajuan SET status = 'admin' WHERE no_ktp = {$id}";
	$query = $conn->query($sql);
}elseif ($_SESSION['level']=='penyelia') {
	$sql = "UPDATE pengajuan SET status = 'penyelia' WHERE no_ktp = {$id}";
	$query = $conn->query($sql);
}elseif ($_SESSION['level']=='pimpinan') {
	$sql = "UPDATE pengajuan SET status = 'pimpinan' WHERE no_ktp = {$id}";
	$query = $conn->query($sql);
}	


	if ($query) {
		echo '<script>
				window.location.href = "../../index.php?hd='.$hd.'&fd='.$fd.'&res=sukses&act=acc";
			 </script>';
	}else{
		$data = "Error ".$conn->error;
		echo '<script>
				window.location.href = "../../index.php?hd='.$hd.'&fd='.$fd.'&res=gagal&act=acc&cau='.$data.'";
			 </script>';
	}

	$conn->close();

 ?>