<?php
$hd = $_GET['hd'];
$fd = $_GET['fd'];
session_start();
include '../../config/index.php'; 
include '../../plugin/images.php';

$id = $_POST['id'];
$status = 'tolak';

$idpnm = $_SESSION['id'];
$pesan = $_POST['pesan'];
$idpna = $_POST['id_user'];
$timestamp = date('Y-m-d H:i:s');

$sql = "UPDATE pengajuan 
		SET status = '$status' 
		WHERE no_ktp = '$id'";
$query = $conn->query($sql);

$sqls = "INSERT INTO pesan VALUES (null, '$idpnm', '$idpna', '$pesan', '$timestamp')";
$querys = $conn->query($sqls);


if ($query&&$querys) {
	echo '<script>
			window.location.href = "../../index.php?hd='.$hd.'&fd='.$fd.'&res=sukses&act=ubah";
		 </script>';
}else{
	$data = "Error ".$conn->error;
	echo '<script>
			window.location.href = "../../index.php?hd='.$hd.'&fd='.$fd.'&res=gagal&act=ubah&cau='.$data.'";
		 </script>';
}

$conn->close();

 ?>