<?php
$hd = $_GET['hd'];
$fd = $_GET['fd'];
session_start();
include '../../config/index.php';
$nm_lengkap = $_POST['nm_lengkap'];
$nm_user = $_POST['nm_user'];
$email = $_POST['email'];
$nohp = $_POST['nohp'];
$alamat = $_POST['alamat'];
$password = sha1($_POST['password']);
$level = $_POST['level'];
$timestamp = date('Y-m-d H:i:s');


$sql = "INSERT INTO user VALUES (null, '$nm_lengkap', '$nm_user', '$email', '$nohp', '$alamat', '$password', '$level', '$timestamp')";
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