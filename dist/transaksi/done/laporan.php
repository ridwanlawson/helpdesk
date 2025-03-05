<?php 
session_start();
if (empty($_SESSION['nama'])) {
  echo '<script>
			window.location.href = "../../../index.php";
		</script>';
}
  error_reporting(0);
  include '../../config/index.php';
  $sql = $conn->query("SELECT * FROM perusahaan WHERE id_perusahaan = 1");
  $judul = $sql->fetch_object();

?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $judul->nm_perusahaan ?></title>
	<link rel="stylesheet" href="../../assets/modules/bootstrap/css/bootstrap.min.css" crossorigin="anonymous">
</head>
<?php 

	if ($_GET['bulan']==1) {
		$bulan = 'Januari';
	}elseif ($_GET['bulan']==2) {
		$bulan = 'Februari';
	}elseif ($_GET['bulan']==3) {
		$bulan = 'Maret';
	}elseif ($_GET['bulan']==4) {
		$bulan = 'April';
	}elseif ($_GET['bulan']==5) {
		$bulan = 'Mei';
	}elseif ($_GET['bulan']==6) {
		$bulan = 'Juni';
	}elseif ($_GET['bulan']==7) {
		$bulan = 'Juli';
	}elseif ($_GET['bulan']==8) {
		$bulan = 'Agustus';
	}elseif ($_GET['bulan']==9) {
		$bulan = 'September';
	}elseif ($_GET['bulan']==10) {
		$bulan = 'Oktober';
	}elseif ($_GET['bulan']==11) {
		$bulan = 'November';
	}elseif ($_GET['bulan']==12) {
		$bulan = 'Desember';
	}
 ?>
<body>
	<div align="center">
		<h2><?php echo $judul->nm_perusahaan ?></h2>
		<h4>Laporan Pengajuan Disetujui <?php echo $bulan; ?> </h4>
		<table class="table table-striped" border="1" width="100%">
			<thead>                                 
              <tr>
                <th class="text-center">
                  No.
                </th>
                <th>Tanggal</th>
                <th>Nama Pelanggan</th>
                <th>Judul Pengaduan</th>
                <th>Keluhan</th>
              </tr>
            </thead>
            <tbody>
                          <?php
                            $no = 1;
                            $tnow = date('Y');
                            $bnow = date('m');
                            if (isset($_POST['tahun'])&&isset($_POST['bulan'])) {
                              $tahuns = $_POST['tahun'];
                              $bulans = $_POST['bulan'];
                              if (!empty($tahuns) && !empty($bulans)){
                                $query = "SELECT pesan.*, user.*
                                                 FROM pesan, user
                                                  WHERE MONTH(tanggal_pesan) = '$bulans'
                                                  AND YEAR(tanggal_pesan) = '$tahuns'
                                                  AND pesan.status_pesan = 'selesai'
                                                  AND pesan.id_pengirim = user.id_user
                                                  ORDER BY tanggal_pesan";
                                }elseif (!empty($tahuns) && empty($bulans)) {
                                $query = "SELECT pesan.*, user.*
                                                 FROM pesan, user
                                                  WHERE YEAR(tanggal_pesan) = '$tahuns'
                                                  AND pesan.status_pesan = 'selesai'
                                                  AND pesan.id_pengirim = user.id_user
                                                  ORDER BY tanggal_pesan";
                                }else{
                                $query = "SELECT pesan.*, user.*
                                                 FROM pesan, user
                                                  WHERE MONTH(tanggal_pesan) = '$bnow'
                                                  AND YEAR(tanggal_pesan) = '$tnow'
                                                  AND pesan.status_pesan = 'selesai'
                                                  AND pesan.id_pengirim = user.id_user
                                                  ORDER BY tanggal_pesan";
                                }
                            }else{
                              $query = "SELECT pesan.*, user.* 
                                        FROM pesan, user 
                                        WHERE pesan.id_pengirim = user.id_user
                                        AND pesan.status_pesan = 'selesai' 
                                        ORDER BY tanggal_pesan desc";
                            }
                            $result = $conn->query($query);
                            while ($data = $result->fetch_object()) {
               ?>
              <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo date('d-M-Y', strtotime($data->tanggal_pesan)); ?></td>
                <td><?php echo ucwords($data->nm_lengkap); ?></td>
                <td><?php echo ucwords($data->judul_pengaduan); ?></td>
                <td><?php echo ucwords($data->isi_pesan); ?></td>
              </tr>
              <?php } ?>
            </tbody>
		</table>
	</div>
  <div style="font-size: 12px;">
		<p>Padang, <?php echo date('d-M-Y') ?></p>
    <p>Mengetahui</p>
    <br>
    <br>
    <br>
    <p>Pimpinan</p>
  </div>
</body>
</html>
<script>
	window.print();
</script>