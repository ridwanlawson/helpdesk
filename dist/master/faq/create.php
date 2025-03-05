<?php
$hd = $_GET['hd'];
$fd = $_GET['fd'];
session_start();
include '../../config/index.php'; 
$tanya = $_POST['tanya'];
$timestamp = date('Y-m-d H:i:s');

$sql = "INSERT INTO faq VALUES (null, '$tanya', '$timestamp')";
$query = $conn->query($sql);
echo mysqli_error($conn);
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