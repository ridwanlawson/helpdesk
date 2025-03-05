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
                    <h4>Data Pribadi </h4>
                  </div>
                  <div class="card-body">
                  </div>
                  <div class="card-header">
                    <div class="buttons">
                      <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i> Tambah Data</button>
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
                            <th>Status</th>
                            <th>Nama Nasabah</th>
                            <th>Jumlah Permohonan</th>
                            <th>Jangka Waktu</th>
                            <th>Keperluan</th>
                            <th>Jaminan</th>
                            <th>Harga Jaminan</th>
                            <th>Pendapatan Bulanan</th>
                            <th>Pengeluaran Bulanan</th>
                            <th>Sisa</th>
                            <th>Action</th>
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
                                $query = "SELECT pengajuan.*, file.* 
                                                 FROM pengajuan, file
                                                  WHERE pengajuan.no_ktp = file.no_ktp 
                                                  AND pengajuan.tanggal_pengajuan = file.waktu
                                                  AND MONTH(tanggal_pengajuan) = '$bulans'
                                                  AND YEAR(tanggal_pengajuan) = '$tahuns'
                                                  ORDER BY tanggal_pengajuan";
                                }elseif (!empty($tahuns) && empty($bulans)) {
                                $query = "SELECT pengajuan.*, file.* 
                                                 FROM pengajuan, file
                                                  WHERE pengajuan.no_ktp = file.no_ktp 
                                                  AND pengajuan.tanggal_pengajuan = file.waktu
                                                  AND YEAR(tanggal_pengajuan) = '$tahuns'
                                                  ORDER BY tanggal_pengajuan";
                                }else{
                                $query = "SELECT pengajuan.*, file.* 
                                                 FROM pengajuan, file
                                                  WHERE pengajuan.no_ktp = file.no_ktp 
                                                  AND pengajuan.tanggal_pengajuan = file.waktu
                                                  AND MONTH(tanggal_pengajuan) = '$bnow'
                                                  AND YEAR(tanggal_pengajuan) = '$tnow'
                                                  ORDER BY tanggal_pengajuan";
                                }
                            }else{
                                $query = "SELECT pengajuan.*, file.* 
                                                 FROM pengajuan, file
                                                  WHERE pengajuan.no_ktp = file.no_ktp 
                                                  AND pengajuan.tanggal_pengajuan = file.waktu
                                                  ORDER BY tanggal_pengajuan";
                            }
                            $result = $conn->query($query);
                            while ($data = $result->fetch_object()) {
                           ?>
                          <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo ucwords($data->status); ?><a href="<?php echo $_SESSION['direct'] ?>lihat.php?hd=transaksi&fd=pengajuan&id=<?php echo $data->no_ktp; ?>" title="Lihat Detail" class="btn btn-primary"><i class="far fa-eye"></i></a></td>
                            <td><?php echo $data->nama_nasabah; ?></td>
                            <td><?php echo 'Rp.'.number_format($data->jumlah_permohonan); ?></td>
                            <td><?php echo $data->jangka_waktu; ?></td>
                            <td><?php echo ucwords($data->keperluan); ?></td>
                            <td><?php echo ucwords($data->jaminan); ?></td>
                            <td><?php echo 'Rp.'.number_format($data->harga_jaminan); ?></td>
                            <td><?php echo 'Rp.'.number_format($data->pendapatan_bulanan); ?></td>
                            <td><?php echo 'Rp.'.number_format($data->pengeluaran_bulanan); ?></td>
                            <td><?php echo 'Rp.'.number_format($data->sisa); ?></td>
                            <td><button class="btn btn-primary" data-toggle="modal" data-target="#show" data-id="<?php echo $data->no_ktp ?>">Ubah</button><a href="<?php echo $_SESSION['direct'] ?>delete.php?hd=transaksi&fd=pengajuan&id=<?php echo $data->no_ktp; ?>" class="btn btn-danger">Hapus</a><a href="<?php echo $_SESSION['direct'] ?>setujui.php?hd=transaksi&fd=pengajuan&id=<?php echo $data->no_ktp; ?>" class="btn btn-success">Setujui</a></td>
                          </tr>
                          <?php }  ?>
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
        <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Input <?php echo $nama ?></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
              <div class="modal-body">
              <p>
                <b>Mohon Dibaca Terlebih Dahulu</b> <br>
                  1. Pastikan File Ukuran dibawah 2 Megabytes (MB) jika tidak kecilkan ukurannya disini -> <a target="_blank" href="">menuju web</a></ol><br>
                  2. Pastikan Format File antara gambar (.jpg, .jpeg, .png) atau pdf<br>  
                  3. Pastikan Form Terisi keseluruhan dan sesuai dengan kondisi terkini<br>     
              </p>
                <form enctype="multipart/form-data" action="<?php echo $_SESSION['direct'] ?>create.php?hd=transaksi&fd=pengajuan" method="POST">
                  <div class="form-row">
                    <div class="col-md-2 mb-3">
                      <label for="validationDefault01">Nama Lengkap/Usaha</label>
                      <input type="text" name="nalen" onkeypress="<?php echo $hus; ?>" class="form-control" id="validationDefault01" placeholder="Ujang Maman" autofocus required>
                      <small>
                        <i>Penulisan nama jangan disingkat.</i>
                      </small>
                    </div>
                    <div class="col-md-2 mb-3">
                      <label for="validationDefault02">Nama Panggilan (Alias)</label>
                      <input type="text" name="alias" onkeypress="<?php echo $hu; ?>" class="form-control" id="validationDefault02" placeholder="Ujang" required>
                    </div>
                    <div class="col-md-2 mb-3">
                    <div class="section-title">Jenis Kelamin</div>
                      <label class="form-label"> </label>
                      <div class="selectgroup w-100">
                        <label class="selectgroup-item">
                          <input type="radio" name="jk" value="l" class="selectgroup-input" checked="">
                          <span class="selectgroup-button">Lelaki</span>
                        </label>
                        <label class="selectgroup-item">
                          <input type="radio" name="jk" value="p" class="selectgroup-input">
                          <span class="selectgroup-button">Perempuan</span>
                        </label>
                      </div>
                    </div>
                    <div class="col-md-2 mb-3">
                      <label for="validationDefault03">No. KTP (Identitas Diri)</label>
                      <input type="text" name="noktp" onkeypress="<?php echo $an; ?>" class="form-control" id="validationDefault03" placeholder="12719291xxxxx" required>
                    </div>
                    <div class="col-md-4 mb-3">
                      <label for="validationDefault04">Tempat / Tanggal Lahir</label>
                      <div class="input-group">
                        <input type="text" name="tplh" onkeypress="<?php echo $hu; ?>" class="form-control" id="validationDefault04" placeholder="Jakarta" aria-describedby="inputGroupPrepend2" required>
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="inputGroupPrepend2">/</span>
                        </div>
                        <input type="date" name="tglah" class="form-control" id="validationDefault04" required>
                      </div>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col-md-5 mb-3">
                      <label for="validationDefault06">Alamat Sesuai KTP</label>
                      <textarea name="alkt" class="form-control" id="validationDefault06" required></textarea>
                      <small>
                        <i>Alamat Sesuai dengan KTP saat ini.</i>
                      </small>
                    </div>
                    <div class="col-md-2 mb-3">
                      <label for="validationDefault07">No.Tel KTP</label>
                      <input type="text" name="notek" onkeypress="<?php echo $an; ?>" class="form-control" id="validationDefault07" required>
                    </div>
                    <div class="col-md-2 mb-3">
                      <label for="validationDefault08">Kode Pos KTP</label>
                      <input type="text" name="kdpk" onkeypress="<?php echo $an; ?>" class="form-control" id="validationDefault08" required>
                    </div>
                    <div class="col-md-3 mb-3">
                      <label for="validationDefault05">Pekerjaan</label>
                      <select class="custom-select" name="peker" id="validationDefault05" required>
                        <option selected disabled value="">Pilih Pekerjaan..</option>
                        <?php 
                          $sql = "SELECT * FROM pekerjaan";
                          $querys = $conn->query($sql);
                          echo mysqli_error($conn);
                          while ($data_pekerjaan = $querys->fetch_object()) {
                            echo "<option value=$data_pekerjaan->id_pekerjaan>$data_pekerjaan->nm_pekerjaan</option>";
                          }
                         ?>
                      </select>
                      <small>
                        <i>Pekerjaan anda saat ini.</i>
                      </small>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col-md-5 mb-3">
                      <label for="validationDefault09">Alamat Sesuai Domisili</label>
                      <textarea name="aldo" onkeypress="<?php echo $anhu; ?>" class="form-control" id="validationDefault09" required></textarea>
                      <small>
                        <i>Alamat Sesuai tempat tinggal saat ini.</i>
                      </small>
                    </div>
                    <div class="col-md-2 mb-3">
                      <label for="validationDefault10">No.Tel Domisili</label>
                      <input type="text" name="noted" onkeypress="<?php echo $an; ?>" class="form-control" id="validationDefault10" required>
                    </div>
                    <div class="col-md-2 mb-3">
                      <label for="validationDefault11">Kode Pos Domisili</label>
                      <input type="text" name="kdpd" onkeypress="<?php echo $an; ?>" class="form-control" id="validationDefault11" required>
                    </div>
                    <div class="col-md-3 mb-3">
                      <label for="validationDefault12">Nama Gadis Ibu Kandung</label>
                      <input type="text" name="nmibu" onkeypress="<?php echo $hus; ?>" class="form-control" id="validationDefault12" required>
                      <small>
                        <i>Wajib Diisi jangan disingkat.</i>
                      </small>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col-md-4 mb-3">
                      <label for="validationDefault13">Jumlah Permohonan Kredit</label>
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend2">Rp.</span>
                      <input type="text" name="jpk" onkeypress="<?php echo $an; ?>" placeholder="10000000" class="form-control" id="validationDefault13" required>
                      </div>
                    </div>
                    <div class="col-md-8 mb-3">
                      <label for="validationDefault14">Jangka Waktu Pinjaman</label>
                      <div class="input-group-prepend">
                      <input type="number" min="1" name="jwp" maxlength="4" onkeypress="<?php echo $an; ?>" placeholder="2" class="form-control" id="validationDefault14" required>
                        <span class="input-group-text" id="inputGroupPrepend2">Bulan, untuk keperluan</span>
                      <input type="text" name="kep" placeholder="Membuka Usaha Baru" class="form-control" id="validationDefault14" required>
                      </div>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col-md-12 mb-3">
                      <label for="validationDefault15">Jaminan yang diserahkan</label>
                      <div class="input-group-prepend">
                      <input type="text" name="jmn" placeholder="1 unit motor" onkeypress="<?php echo $anhu; ?>" class="form-control" id="validationDefault15" required>
                        <span class="input-group-text" id="inputGroupPrepend2">Dengan harga Rp.</span>
                      <input type="text" name="hjmn" placeholder="10000000" onkeypress="<?php echo $an; ?>" class="form-control" id="validationDefault15" required>
                      </div>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col-md-4 mb-3">
                      <label for="validationDefault16">Pendapatan Per Bulan</label>
                      <div class="input-group-prepend">
                       <span class="input-group-text" id="inputGroupPrepend1">Rp.</span>
                      <input type="text" name="pdptb" onkeypress="<?php echo $an; ?>" placeholder="2000000" class="form-control" id="validationDefault16" required>
                      </div>
                    </div>
                    <div class="col-md-4 mb-3">
                      <label for="validationDefault17">Pengeluaran Per Bulan</label>
                      <div class="input-group-prepend">
                       <span class="input-group-text" id="inputGroupPrepend1">Rp.</span>
                      <input type="text" name="pglnb" onkeypress="<?php echo $an; ?>" placeholder="1500000" class="form-control" id="validationDefault17" required>
                      </div>
                    </div>
                    <div class="col-md-4 mb-3">
                      <label for="validationDefault18">Kesanggupan Membayar</label>
                      <div class="input-group-prepend">
                       <span class="input-group-text" id="inputGroupPrepend1">Rp.</span>
                      <input type="text" name="ksgp" onkeypress="<?php echo $an; ?>" placeholder="450000" class="form-control" id="validationDefault18" required>
                      </div>
                      <small> cicilan kredit (pokok + bunga) setiap bulannya</small>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col-md-3 mb-3">
                      <label for="validationDefault16">File KTP</label>
                      <div class="input-group-prepend">
                      <input type="file" name="ktp" class="form-control" accept=".jpeg, .jpg, .png, .pdf" id="input" required>
                      </div>
                      <small>KTP Suami, Istri, Penjamin</small>
                    </div>
                    <div class="col-md-2 mb-3">
                      <label for="validationDefault16">File KK</label>
                      <div class="input-group-prepend">
                      <input type="file" name="kk" class="form-control" accept=".jpeg, .jpg, .png, .pdf" id="input" required>
                      </div>
                      <small>KK Pemohon, Penjamin</small>
                    </div>
                    <div class="col-md-2 mb-3">
                      <label for="validationDefault16">Surat Nikah</label>
                      <div class="input-group-prepend">
                      <input type="file" name="suni" class="form-control" accept=".jpeg, .jpg, .png, .pdf" id="input" required>
                      </div>
                      <small>Surat Nikah Pemohon, Penjamin</small>
                    </div>
                    <div class="col-md-2 mb-3">
                      <label for="validationDefault16">File PBB</label>
                      <div class="input-group-prepend">
                      <input type="file" name="pbb" class="form-control" accept=".jpeg, .jpg, .png, .pdf" id="input" required>
                      </div>
                      <small>PBB Terakhir</small>
                    </div>
                    <div class="col-md-3 mb-3">
                      <label for="validationDefault16">Rek.Listrik</label>
                      <div class="input-group-prepend">
                      <input type="file" name="rekli" class="form-control" accept=".jpeg, .jpg, .png, .pdf" id="input"  required>
                      </div>
                      <small>Rekening Listrik, Telelpon Terakhir</small>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col-md-3 mb-3">
                      <label for="validationDefault16">Rek.Tabungan</label>
                      <div class="input-groupgroup-prepend">
                      <input type="file" name="rekta" class="form-control" accept=".jpeg, .jpg, .png, .pdf" id="input"  required>
                      </div>
                      <small>Rekening Tabungan 3 Bulan Terakhir</small>
                    </div>
                    <div class="col-md-2 mb-3">
                      <label for="validationDefault16">File Slip Gaji</label>
                      <div class="input-group-prepend">
                      <input type="file" name="slip" class="form-control"  accept=".jpeg, .jpg, .png, .pdf" id="input" required>
                      </div>
                      <small>Slip Gaji / Keterangan Penghasilan</small>
                    </div>
                    <div class="col-md-2 mb-3">
                      <label for="validationDefault16">File Izin-izin Usaha</label>
                      <div class="input-group-prepend">
                      <input type="file" name="izin" class="form-control"  accept=".jpeg, .jpg, .png, .pdf" id="input" required>
                      </div>
                    </div>
                    <div class="col-md-2 mb-3">
                      <label for="validationDefault16">SHM/SHGB, IMB</label>
                      <div class="input-group-prepend">
                      <input type="file" name="imb" class="form-control" r accept=".jpeg, .jpg, .png, .pdf" id="input" required>
                      </div>
                    </div>
                    <div class="col-md-3 mb-3">
                      <label for="validationDefault16">BPKB, Faktur, STNK, SIM</label>
                      <div class="input-group-prepend">
                      <input type="file" name="bpkb" class="form-control"  accept=".jpeg, .jpg, .png, .pdf" id="input" required>
                      </div>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col-md-12 mb-3">
                      <label for="validationDefault16"><p>Dengan penyampaian permohonan kredit ini, maka saya setuju apabila Pihak Bank mengumpulkan informasi dan data tidak terbatas dilingkungan tempat tinggal, lingkungan usaha dan/atau lingkungan kerja saya. <br>Demikian surat permohonan ini saya sampaikan atas perhatian serta bantuan Bapak/Ibu saya ucapkan terima kasih.</p>
                      </label>
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
