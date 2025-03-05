<?php 
error_reporting(0);
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
                            <option value="0" <?php if ($_POST['bulan']==0) {echo 'selected'; } ?>>Semua</option>
                            <option value="1" <?php if ($_POST['bulan']==1) {echo 'selected'; } ?>>Januari</option>
                            <option value="2" <?php if ($_POST['bulan']==2) {echo 'selected'; } ?>>Februari</option>
                            <option value="3" <?php if ($_POST['bulan']==3) {echo 'selected'; } ?>>Maret</option>
                            <option value="4" <?php if ($_POST['bulan']==4) {echo 'selected'; } ?>>April</option>
                            <option value="5" <?php if ($_POST['bulan']==5) {echo 'selected'; } ?>>Mei</option>
                            <option value="6" <?php if ($_POST['bulan']==6) {echo 'selected'; } ?>>Juni</option>
                            <option value="7" <?php if ($_POST['bulan']==7) {echo 'selected'; } ?>>Juli</option>
                            <option value="8" <?php if ($_POST['bulan']==8) {echo 'selected'; } ?>>Agustus</option>
                            <option value="9" <?php if ($_POST['bulan']==9) {echo 'selected'; } ?>>September</option>
                            <option value="10" <?php if ($_POST['bulan']==10) {echo 'selected'; } ?>>Oktober</option>
                            <option value="11" <?php if ($_POST['bulan']==11) {echo 'selected'; } ?>>November</option>
                            <option value="12" <?php if ($_POST['bulan']==12) {echo 'selected'; } ?>>Desember</option>
                          </select>                    
                        </div>
                        <div class="form-group col-md-2">
                          <label>Tahun</label>
                          <select class="form-control" name="tahun">
                            <?php
                            $brg=$conn->query("SELECT YEAR(penggajian.tanggal_gaji) as tahun  from penggajian GROUP BY YEAR(tanggal_gaji)") or die($conn->error());
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
                          <label>-</label>
                          <input type="submit" name="lihat"  class="form-control btn-primary" value="Lihat">
                        </div>
                      </div> 
                    </form>
                  </div>
                  <div class="card-header">
                    <div class="buttons">
                      <a href="?hd=transaksi&fd=penggajian" class="btn btn-primary" ><i class="fas fa-money-bill-wave"></i> Bayar Gaji </a>
                      <a href="<?php echo $_SESSION['direct'] ?>laporan.php?bulan=<?php echo $_POST['bulan']; ?>&tahun=<?php echo $_POST['tahun'] ?>" target="_blank" class="btn btn-danger" ><i class="fas fa-print"></i> Cetak </a>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>                                 
                          <tr>
                            <th class="text-center">
                              No.
                            </th>
                            <th>Tanggal</th>
                            <th>Nama Karyawan</th>
                            <th>Bidang</th>
                            <th>Jabatan</th>
                            <th>Gaji Pokok</th>
                            <th>Uang Lembur</th>
                            <th>Tunjangan Struktural</th>
                            <th>Tunjangan Fungsional</th>
                            <th>Tunjangan Transportasi</th>
                            <th>Status</th>
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
                                $query = "SELECT penggajian.*, karyawan.*, gaji.*, bidang.*, jabatan.* 
                                                FROM penggajian, karyawan, gaji, bidang, jabatan 
                                                WHERE penggajian.id_karyawan = karyawan.id_karyawan
                                                  AND karyawan.id_bidang = bidang.id_bidang
                                                  AND karyawan.id_jabatan = jabatan.id_jabatan
                                                  AND penggajian.id_gaji = gaji.id_gaji
                                                  AND status = 'lunas'
                                                  AND MONTH(tanggal_gaji) = '$bulans'
                                                  AND YEAR(tanggal_gaji) = '$tahuns'
                                                  ORDER BY nm_jabatan, tanggal_gaji";
                                }elseif (!empty($tahuns) && empty($bulans)) {
                                $query = "SELECT penggajian.*, karyawan.*, gaji.*, bidang.*, jabatan.* 
                                                FROM penggajian, karyawan, gaji, bidang, jabatan 
                                                WHERE penggajian.id_karyawan = karyawan.id_karyawan
                                                  AND karyawan.id_bidang = bidang.id_bidang
                                                  AND karyawan.id_jabatan = jabatan.id_jabatan
                                                  AND penggajian.id_gaji = gaji.id_gaji
                                                  AND status = 'lunas'
                                                  AND YEAR(tanggal_gaji) = '$tahuns'
                                                  ORDER BY nm_jabatan, tanggal_gaji";
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
                                                  ORDER BY nm_jabatan, tanggal_gaji";
                                }
                            }else{
                              $query = "SELECT penggajian.*, karyawan.*, gaji.*, bidang.*, jabatan.* 
                                              FROM penggajian, karyawan, gaji, bidang, jabatan 
                                              WHERE penggajian.id_karyawan = karyawan.id_karyawan
                                                AND karyawan.id_bidang = bidang.id_bidang
                                                AND karyawan.id_jabatan = jabatan.id_jabatan
                                                AND penggajian.id_gaji = gaji.id_gaji
                                                AND status = 'lunas'
                                                ORDER BY nm_jabatan, tanggal_gaji";
                            }
                            $result = $conn->query($query);
                            while ($data = $result->fetch_object()) {
                           ?>
                          <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo date('d-M-Y', strtotime($data->tanggal_gaji)) ?></td>
                            <td><?php echo ucwords($data->nm_karyawan); ?></td>
                            <td><?php echo ucwords($data->nm_bidang); ?></td>
                            <td><?php echo ucwords($data->nm_jabatan); ?></td>
                            <td><?php echo 'Rp.'.number_format($data->gaji_pokok); ?></td>
                            <td><?php echo 'Rp.'.number_format($data->tj_lembur); ?></td>
                            <td><?php echo 'Rp.'.number_format($data->tj_struktural); ?></td>
                            <td><?php echo 'Rp.'.number_format($data->tj_fungsional); ?></td>
                            <td><?php echo 'Rp.'.number_format($data->tj_transportasi); ?></td>
                            <td><?php echo ucwords($data->status); ?></td>
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

      <!-- Modal Insert -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Input <?php echo $nama ?></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="<?php echo $_SESSION['direct'] ?>create.php?hd=master&fd=gaji" method="post">
              <div class="modal-body">
                <div class="form-group">
                  <label>Bidang</label>
                  <div class="input-group">
                    <select name="id_bidang" class="form-control">
                      <?php 
                        $querys = $conn->query("SELECT * FROM bidang");
                        while ($data_bidang = $querys->fetch_object()) { ?>
                          <option value='<?php echo $data_bidang->id_bidang ?>'><?php echo $data_bidang->nm_bidang ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label>Jabatan</label>
                  <div class="input-group">
                    <select name="id_jabatan" class="form-control">
                      <?php 
                        $queryss = $conn->query("SELECT * FROM jabatan");
                        while ($data_jabatan = $queryss->fetch_object()) { ?>
                          <option value='<?php echo $data_jabatan->id_jabatan; ?>'><?php echo $data_jabatan->nm_jabatan; ?></option>";
                      <?php  
                        }
                       ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label>Gaji Pokok (/bulan)</label>
                  <div class="input-group">
                    <input type="number" class="form-control" minlength="9" maxlength="20" min="200000" placeholder="2000000" name="ga_pok" required="">
                  </div>
                </div>
                <div class="form-group">
                  <label>Uang Lembur (/jam)</label>
                  <div class="input-group">
                    <input type="number" class="form-control" minlength="9" maxlength="20" min="20000" placeholder="50000
                    " name="u_lem" required="">
                  </div>
                </div>
                <div class="form-group">
                  <label>Tunjangan Struktural</label>
                  <div class="input-group">
                    <input type="number" class="form-control" minlength="9" maxlength="20" min="2000" placeholder="300000" name="tj_struktural">
                  </div>
                </div>
                <div class="form-group">
                  <label>Tunjangan Fungsional</label>
                  <div class="input-group">
                    <input type="number" class="form-control" minlength="9" maxlength="20" min="2000" placeholder="400000" name="tj_fungsional">
                  </div>
                </div>
                <div class="form-group">
                  <label>Tunjangan Transportasi</label>
                  <div class="input-group">
                    <input type="number" class="form-control" minlength="9" maxlength="20" min="2000" placeholder="250000" name="tj_transportasi">
                  </div>
                </div>
              </div>
              <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- //Modal Insert -->


<!-- Modal start here -->
<div class="modal fade" id="show" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModal">Edit <?php echo $nama ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="modal-data"></div>
      </div>
    </div>
  </div>
</div>
<!-- End of Modal -->
