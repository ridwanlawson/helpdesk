<?php
$hd = $_GET['hd'];
$fd = $_GET['fd'];
session_start();
include '../../config/index.php';
include '../../plugin/images.php';


$id_user = $_SESSION['id'];
$nalen = $_POST['nalen'];
$alias = $_POST['alias'];
$jk = $_POST['jk'];
$noktp = $_POST['noktp'];
$tplh = $_POST['tplh'];
$tglah = $_POST['tglah'];
$alkt = $_POST['alkt'];
$notek = $_POST['notek'];
$kdpk = $_POST['kdpk'];
$alkt = $_POST['alkt'];
$notek = $_POST['notek'];
$kdpk = $_POST['kdpk'];
$peker = $_POST['peker'];
$aldo = $_POST['aldo'];
$noted = $_POST['noted'];
$kdpd = $_POST['kdpd'];
$nmibu = $_POST['nmibu'];
$jpk = $_POST['jpk'];
$jwp = $_POST['jwp'];
$kep = $_POST['kep'];
$jmn = $_POST['jmn'];
$hjmn = $_POST['hjmn'];
$pdptb = $_POST['pdptb'];
$pglnb = $_POST['pglnb'];
$sisa = $pdptb - $pglnb;
$ksgp = $_POST['ksgp'];

$ktp = uploadKtp();
$kk = uploadKk();
$suni = uploadSuni();
$pbb = uploadPbb();
$rekli = uploadRekli();
$rekta = uploadRekta();
$slip = uploadSlip();
$izin = uploadIzin();
$imb = uploadImb();
$bpkb = uploadBpkb();
$timestamp = date('Y-m-d H:i:s');

/*if (!$ktp) {
	return false;
}*/

$sql = "INSERT INTO pengajuan 
		VALUES (null, '$id_user', '$nalen', '$alias', '$jk', '$noktp', '$tplh', '$tglah', '$peker', '$alkt', '$notek', '$kdpk', '$aldo', '$noted', '$kdpd', '$nmibu', '$jpk', '$jwp', '$kep', '$jmn', '$hjmn', '$pdptb', '$pglnb', '$sisa', '$ksgp', 'pending', '$timestamp')";
$query = $conn->query($sql);

$sqls = "INSERT INTO file 
		VALUES (null, '$noktp', '$ktp', '$kk', '$suni', '$pbb', '$rekli', '$rekta', '$slip', '$izin', '$imb', '$bpkb', '$timestamp')";
$querys = $conn->query($sqls);

if ($query&&$querys) {
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