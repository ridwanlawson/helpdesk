<?php
$hd = $_GET['hd'];
$fd = $_GET['fd'];
session_start();
include '../../config/index.php'; 
$id = $_POST['id'];
$judul = $_POST['judul'];


$sql = "UPDATE faq SET judul_faq = '$judul' WHERE id_faq='$id'";

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