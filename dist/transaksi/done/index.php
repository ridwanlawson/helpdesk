<?php 
$head = $_GET['hd']; 
$folder = $_GET['fd'];

  if (!empty($head)&&!empty($folder)) {
    $direct = $head.'/'.$folder.'/';
  }elseif (empty($head)&&!empty($folder)) {
    $direct = $folder.'/index.php';
  }else{
    $direct = '';
  }
$direct = $head.'/'.$folder.'/';
$_SESSION['direct'] = $direct;
$nama = ucwords($_GET['fd']);
 ?>
<div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1><?php echo $nama ?></h1>
          </div>

          <div class="section-body">
            <div class="row">  
          <?php 
                include 'notif/index.php';
          ?>
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Data <?php echo $nama ?></h4>
                  </div>
                  <div class="card-body">
                    <form action="" method="post">
                      <div class="form-row">
                        <div class="form-group col-md-2">
                          <label>Bulan</label>
                          <select class="form-control" name="bulan">
                            <option value="0" <?php if (@$_POST['bulan']==0) {echo 'selected'; } ?>>Semua</option>
                            <option value="1" <?php if (@$_POST['bulan']==1) {echo 'selected'; } ?>>Januari</option>
                            <option value="2" <?php if (@$_POST['bulan']==2) {echo 'selected'; } ?>>Februari</option>
                            <option value="3" <?php if (@$_POST['bulan']==3) {echo 'selected'; } ?>>Maret</option>
                            <option value="4" <?php if (@$_POST['bulan']==4) {echo 'selected'; } ?>>April</option>
                            <option value="5" <?php if (@$_POST['bulan']==5) {echo 'selected'; } ?>>Mei</option>
                            <option value="6" <?php if (@$_POST['bulan']==6) {echo 'selected'; } ?>>Juni</option>
                            <option value="7" <?php if (@$_POST['bulan']==7) {echo 'selected'; } ?>>Juli</option>
                            <option value="8" <?php if (@$_POST['bulan']==8) {echo 'selected'; } ?>>Agustus</option>
                            <option value="9" <?php if (@$_POST['bulan']==9) {echo 'selected'; } ?>>September</option>
                            <option value="10" <?php if (@$_POST['bulan']==10) {echo 'selected'; } ?>>Oktober</option>
                            <option value="11" <?php if (@$_POST['bulan']==11) {echo 'selected'; } ?>>November</option>
                            <option value="12" <?php if (@$_POST['bulan']==12) {echo 'selected'; } ?>>Desember</option>
                          </select>                    
                        </div>
                        <div class="form-group col-md-2">
                          <label>Tahun</label>
                          <select class="form-control" name="tahun">
                            <?php
                            $brg=$conn->query("SELECT YEAR(pesan.tanggal_pesan) as tahun  from pesan GROUP BY YEAR(tanggal_pesan)") or die($conn->error());
                            while($b=$brg->fetch_array()){
                                if ($b['tahun']==$_POST['tahun']) {
                                echo '<option>'.$b['tahun'].'</option>';
                                }else{
                                echo '<option>'.$b['tahun'].'</option>';
                                }
                              
                            }
                             ?>
                          </select>                    
                        </div>
                        <div class="form-group col-md-2">
                          <label><a href="" style="color: white">-</a></label>
                          <input type="submit" name="lihat"  class="form-control btn-primary" value="Lihat">
                        </div>
                        <div class="form-group col-md-2">
                          <label><a href="" style="color: white">-</a></label>
                          <a href="<?php echo $_SESSION['direct']; ?>laporan.php?bulan=<?php echo @$_POST['bulan']; ?>&tahun=<?php echo @$_POST['tahun']; ?>" target="_blank" name="cetak"  class="form-control btn-danger" align="center" style="text-decoration: none">Cetak</a>
                        </div>
                      </div> 
                    </form>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>                                 
                          <tr>
                            <th class="text-center">
                              No.
                            </th>
                            <th>Nomor Layanan</th>
                            <th>Tanggal</th>
                            <th>Nama Lengkap</th>
                            <th>Judul Pengaduan</th>
                            <th>Keluhan</th>
                            <th>Gambar</th>
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
                            <td><?php echo $data->nolayanan; ?></td>
                            <td><?php echo date('d-M-Y', strtotime($data->tanggal_pesan)); ?></td>
                            <td><?php echo ucwords($data->nm_lengkap); ?></td>
                            <td><?php echo ucwords($data->judul_pengaduan); ?></td>
                            <td><?php echo ucwords($data->isi_pesan); ?></td>
                            <td><img width="100%" src="assets/img/data/file/<?php echo $data->file; ?>"></td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
