<?php 
session_start();
if (empty($_SESSION['nama'])) {
  echo '<script>
			window.location.href = "../../../index.php";
		</script>';
}
  include '../../config/index.php';
  $sql = $conn->query("SELECT * FROM perusahaan WHERE id_perusahaan = 1");
  $judul = $sql->fetch_object();

?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $judul->nm_perusahaan ?></title>
</head>
<body style="font-size: 10px">
	<div align="center">
		<h1><?php echo $judul->nm_perusahaan ?></h1>
		<h1>Laporan Penggajian</h1>
		<table border="1" width="100%">
			<thead>                                 
              <tr>
                <th class="text-center">
                  No.
                </th>
                <th width="60px">Tanggal</th>
                <th>Nama Karyawan</th>
                <th>Bidang</th>
                <th>Jabatan</th>
                <th>Gaji Pokok</th>
                <th>Uang Lembur</th>
                <th>Tunjangan Struktural</th>
                <th>Tunjangan Fungsional</th>
                <th>Tunjangan Transportasi</th>
                <th>Total</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <?php
              include "../../config/index.php";
              	$no = 1;
                $tnow = date('Y');
				$bnow = date('m');
				if (isset($_GET['tahun'])&&isset($_GET['bulan'])) {
					$tahuns = $_GET['tahun'];
					$bulans = $_GET['bulan'];
					if (!empty($tahuns) && !empty($bulans)){
						$query = "SELECT penggajian.*, karyawan.*, gaji.*, bidang.*, jabatan.* 
					                  FROM penggajian, karyawan, gaji, bidang, jabatan 
					                  WHERE penggajian.id_karyawan = karyawan.id_karyawan
					                    AND karyawan.id_bidang = bidang.id_bidang
					                    AND karyawan.id_jabatan = jabatan.id_jabatan
					                    AND penggajian.id_gaji = gaji.id_gaji
					                    AND status = 'lunas'
					                    AND MONTH(tanggal_gaji) = '$bulans'
					                    AND YEAR(tanggal_gaji) = '$tahuns'
					                    ORDER BY nm_jabatan";
						}elseif (!empty($tahuns) && empty($bulans)) {
						$query = "SELECT penggajian.*, karyawan.*, gaji.*, bidang.*, jabatan.* 
					                  FROM penggajian, karyawan, gaji, bidang, jabatan 
					                  WHERE penggajian.id_karyawan = karyawan.id_karyawan
					                    AND karyawan.id_bidang = bidang.id_bidang
					                    AND karyawan.id_jabatan = jabatan.id_jabatan
					                    AND penggajian.id_gaji = gaji.id_gaji
					                    AND status = 'lunas'
					                    AND YEAR(tanggal_gaji) = '$tahuns'
					                    ORDER BY nm_jabatan";
						}else{
						$query = "SELECT penggajian.*, karyawan.*, gaji.*, bidang.*, jabatan.* 
					                  FROM penggajian, karyawan, gaji, bidang, jabatan 
					                  WHERE penggajian.id_karyawan = karyawan.id_karyawan
					                    AND karyawan.id_bidang = bidang.id_bidang
					                    AND karyawan.id_jabatan = jabatan.id_jabatan
					                    AND penggajian.id_gaji = gaji.id_gaji
					                    AND status = 'lunas'
					                    AND MONTH(tanggal_gaji) = '$bnow'
					                    AND YEAR(tanggal_gaji) = '$tnow'
					                    ORDER BY nm_jabatan";
						}
				}else{
					$query = "SELECT penggajian.*, karyawan.*, gaji.*, bidang.*, jabatan.* 
				                  FROM penggajian, karyawan, gaji, bidang, jabatan 
				                  WHERE penggajian.id_karyawan = karyawan.id_karyawan
				                    AND karyawan.id_bidang = bidang.id_bidang
				                    AND karyawan.id_jabatan = jabatan.id_jabatan
				                    AND penggajian.id_gaji = gaji.id_gaji
				                    AND status = 'lunas'
				                    ORDER BY nm_jabatan";
				}
                $result = $conn->query($query);
                while ($data = $result->fetch_object()) {
                	$total = $data->tj_transportasi + $data->tj_fungsional + $data->tj_struktural + $data->tj_lembur + $data->gaji_pokok;
               ?>
              <tr>
                <td align="center"><?php echo $no++ ?></td>
                <td align="center"><?php echo date('d-M-Y', strtotime($data->tanggal_gaji)) ?></td>
                <td align="center"><?php echo ucwords($data->nm_karyawan); ?></td>
                <td align="center"><?php echo ucwords($data->nm_bidang); ?></td>
                <td align="center"><?php echo ucwords($data->nm_jabatan); ?></td>
                <td align="center"><?php echo 'Rp.'.number_format($data->gaji_pokok); ?></td>
                <td align="center"><?php echo 'Rp.'.number_format($data->tj_lembur); ?></td>
                <td align="center"><?php echo 'Rp.'.number_format($data->tj_struktural); ?></td>
                <td align="center"><?php echo 'Rp.'.number_format($data->tj_fungsional); ?></td>
                <td align="center"><?php echo 'Rp.'.number_format($data->tj_transportasi); ?></td>
                <td align="center"><?php echo 'Rp.'.number_format($total); ?></td>
                <td align="center"><?php echo ucwords($data->status); ?></td>
              </tr>
              <?php } ?>
            </tbody>
		</table>
	</div>
	<div>
		<p>Pasaman Timur, <?php echo date('d-m-Y') ?></p>
		<p>	
			<b style="padding-right: 210px">PREPARED BY,</b>  
			<b style="padding-right: 160px">CHECKED BY,</b> 
			<b>APPROVED BY,</b>
		</p>
		<p style="color: white;">-</p>
		<p style="color: white;">-</p>
		<p style="color: white;">-</p>
		<p>
			<b style="padding-right: 20px">DESMAWATI</b> <b style="padding-right: 50px">DEDI SETIAWAN</b>
			<b style="padding-right: 100px">MARTIAS</b>   <b style="padding-right: 50px">HARMADI</b>
			<b style="padding-right: 25px">________</b> <b style="padding-right: 25px">________</b> <b>________</b> 
		</p>
		<p>		
			<b style="padding-right: 46px">ADMIN</b> <b style="padding-right: 110px">SFC</b>
			<b style="padding-right: 130px">SFO</b> <b style="padding-right: 77px">CC</b> 
			<b style="padding-right: 28px">PIMPINAN</b> <b style="padding-right: 40px">GEM</b> <b>AGM</b>
		</p>
	</div>
</body>
</html>
<script>
	window.print();
</script>