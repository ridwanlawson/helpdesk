<?php
$hd = $_GET['hd'];
$fd = $_GET['fd'];
session_start();
include '../../config/index.php'; 
$id = $_POST['id'];
$faq = $_POST['faq'];
$solusi = $_POST['nm_solusi'];
$desksolusi = $_POST['desk_solusi'];
$timestamp = date('Y-m-d H:i:s');

$sql = "UPDATE solusi SET id_faq = '$faq', nm_solusi = '$solusi', desk_solusi = '$desksolusi', waktu_solusi = '$timestamp' WHERE id_solusi = '$id'";
$query = $conn->query($sql);
echo mysqli_error($conn);
if ($query) {
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