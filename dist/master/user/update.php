<?php
$hd = $_GET['hd'];
$fd = $_GET['fd'];
session_start();
include '../../config/index.php'; 

$id = $_POST['id'];
$nm_lengkap = $_POST['nm_lengkap'];
$nm_user = $_POST['nm_user'];
$email = $_POST['email'];
$nohp = $_POST['nohp'];
$password = $_POST['password'];
$level = $_POST['level'];
$alamat = $_POST['alamat'];
if (empty($password)) {
	$sql = "UPDATE user SET alamat = '$alamat', nm_user = '$nm_user', nm_lengkap = '$nm_lengkap', email = '$email', no_hp = '$nohp', level = '$level' WHERE id_user = '$id'";
}else{
	$pass = sha1($password);
	$sql = "UPDATE user SET  alamat = '$alamat', nm_user = '$nm_user', email = '$email', no_hp = '$nohp', pass = '$pass', level = '$level' WHERE id_user = '$id'";
}
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