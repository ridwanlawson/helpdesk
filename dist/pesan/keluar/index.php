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
  <?php if ($_SESSION['level']=='admin'): 
    $judul = 'Balasan'; ?>
  <?php elseif ($_SESSION['level']=='user'): 
    $judul = 'Konsultasi';
  ?>
  <?php elseif ($_SESSION['level']=='teknisi'): 
    $judul = 'Pengaduan';
  ?>
  <?php endif ?>
        <section class="section">
          <div class="section-header">
            <h1><?php echo $judul ?></h1>
          </div>

          <div class="section-body">
            <div class="row">
          <?php 
                include 'notif/index.php';
          ?>
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4> <?php echo $judul.' '.ucwords($_SESSION['nama']) ?> </h4>
                  </div>
                  <div class="card-header">
                <?php 
                  $query = "SELECT COUNT(id_pesan) as jumlah FROM pesan WHERE pesan.id_pengirim = $_SESSION[id] AND status_pesan = 'terkirim'";
                  $result = $conn->query($query);
                  $data = mysqli_fetch_array($result);
                   if ($_SESSION['level']=='user' AND $data['jumlah']>0): 
                   echo '<p>Pesan hanya bisa dikirim 1 kali saja, untuk mengecek balasan bisa ditunggu balasan via Whatsapp atau via Aplikasi kami ini pada menu pesan dibawah sub menu balasan dibawah menu konsultasi dan tambah konsultasi akan dibuka kembali setelah konsultasi sebelumnya diproses hingga status menjadi selesai</p>';
                   elseif ($_SESSION['level']=='user') : ?>
                    <div class="buttons">
                      <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i> <?php echo $judul ?> Baru</button>
                    </div> 
                  <?php elseif ($_SESSION['level']=='admin') : ?>
                    <div class="buttons">
                      <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i> <?php echo $judul ?> Baru</button>
                    </div>
                  <?php endif ?>

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
                            <th>Nama Penerima</th>
                          <?php if ($_SESSION['level']=='teknisi') : ?>
                            <th>Nomor Handphone</th>
                            <th>Email</th>
                          <?php endif ?>
                            <th>Judul Pesan</th>
                            <th>Isi Pesan</th>
                            <th>Status</th>
                          <?php if ($_SESSION['level']=='teknisi') : ?>
                            <th>Action</th>  
                          <?php endif ?>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $no = 1;
                              $query = "SELECT pesan.*, user.* 
                                        FROM pesan, user 
                                        WHERE pesan.id_pengirim = $_SESSION[id] 
                                        AND pesan.id_penerima = user.id_user  
                                        GROUP BY id_pesan
                                        ORDER BY tanggal_pesan desc";
                            echo mysqli_error($conn);
                            $result = $conn->query($query);
                            while ($data = $result->fetch_object()) {
                           ?>
                          <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $data->nolayanan ?></td>
                            <td><?php echo date('d-m-Y H:i:s', strtotime($data->tanggal_pesan)); ?></td>
                            <td><?php echo ucwords($data->nm_user).' ('.ucwords($data->level).')'; ?></td>

                          <?php if ($_SESSION['level']=='teknisi') : ?>
                            <td>
                              <a data-toggle="tooltip" data-placement="right" title="Klik Untuk Mengirim Whatsapp" target="_blank" href="https://api.whatsapp.com/send?phone=<?php echo '62'.$data->no_hp ?>&text=<?php echo 'Halo '.ucwords($data->nm_user).' Kami dari PT Telkom Akses mengabarkan bahwa masalah anda sedang kami proses' ?>">
                                <?php echo $data->no_hp; ?>  
                              </a>
                            </td>
                            <td>
                              <a data-toggle="tooltip" data-placement="right" title="Klik Untuk Mengirim Email" target="_blank" href="mailto:<?php echo $data->email; ?>">
                                <?php echo $data->email; ?>
                              </a>
                            </td>
                          <?php endif ?>
                            
                            <td><?php echo $data->judul_pengaduan; ?></td>
                            <td><?php echo $data->isi_pesan; ?></td>
                            <td><?php echo ucwords($data->status_pesan) ?></td>
                          <?php if ($_SESSION['level']=='teknisi') : ?>
                            <td>
                                <button class="btn btn-primary"  data-toggle="modal" data-target="#exampleModal<?php echo $data->id_pesan ?>"><i class="fas fa-warning"></i> Balas Pesan </button>
                            </td>
                          <?php endif ?>
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
      <div class="modal fade" id="exampleModal"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Buat <?php echo $judul ?></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="<?php echo $_SESSION['direct'] ?>create.php?hd=pesan&fd=keluar" method="post" enctype="multipart/form-data">
              <div class="modal-body">
              <?php if ($_SESSION['level']=='admin'): 
                  $val = "";
              ?>

              <?php else: 
                  $val = "hidden";
              ?>
                
              <?php endif ?>
                <div class="form-group" <?= $val ?> >
                  
                  <label>Nama Penerima</label>
                  <div class="input-group">
                    <select class="form-control select2" style="width: 100%" name="id_penerima">
                      <?php
                        if ($_SESSION['level']=='admin') {
                        $data_user = "SELECT * FROM user WHERE nm_user!='admin'  AND id_user != $_SESSION[id] ORDER BY id_user";
                        $result = $conn->query($data_user);
                        while ($data = $result->fetch_object()) {
                           echo "<option value=$data->id_user>".ucwords($data->nm_user)." (".ucwords($data->level).") </option>";
                        }
                      }else{
                        $data_user = "SELECT * FROM user WHERE level = 'admin' AND nm_user!='admin' AND id_user != $_SESSION[id] ORDER BY id_user";
                        $results = $conn->query($data_user);
                        while ($datas = $results->fetch_object()) {
                           echo "<option value=$datas->id_user>".ucwords($datas->nm_user)." (".ucwords($datas->level).") </option>";
                         } 
                        }
                       ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label>Nomor Layanan</label>
                  <div class="input-group">
                    <input type="text" placeholder="075xx/1114xxxxxxxx" required="" maxlength="16" class="form-control" name="nolayanan">
                  </div>
                </div>
                <div class="form-group">
                  <label>File (Hanya Berupa Gambar)</label>
                  <div class="input-group">
                    <input type="file" class="form-control" name="file" accept=".jpg, .png, .jpeg">
                  </div>
                </div>
                <div class="form-group">
                  <label>Judul Pesan</label>
                  <div class="input-group">
                    <input type="text" class="form-control" name="judul">
                  </div>
                </div>
                <div class="form-group">
                  <label>isi Pesan</label>
                  <div class="input-group">
                    <textarea class="form-control" name="desk"></textarea>
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


  <?php
    $query = "SELECT pesan.*, user.* 
              FROM pesan, user 
              WHERE pesan.id_pengirim = $_SESSION[id] 
              AND pesan.id_penerima = user.id_user  
              GROUP BY id_pesan
              ORDER BY tanggal_pesan desc";
  echo mysqli_error($conn);
  $result = $conn->query($query);
  while ($data = $result->fetch_object()) {
   ?>
      <!-- Modal Teknisi Start -->
      <div class="modal fade" id="exampleModal<?php echo $data->id_pesan ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Input <?php echo $nama ?></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="<?php echo $_SESSION['direct'] ?>teknisi.php?hd=pesan&fd=masuk" method="post">
              <div class="modal-body">
                <div class="form-group">
                  <label>Nama User</label>
                  <div class="input-group">
                  <input type="hidden" value="<?= ucwords($data->id_pesan) ?>" name="id_pesan">
                  <input type="hidden" value="<?= ucwords($data->nolayanan) ?>" name="nolayanan">
                    <select class="form-control" name="id_penerima" sty>
                       <option value="<?= $data->id_user ?>"><?php echo ucwords($data->nm_user).' ('.ucwords($data->level).')';?></option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label>Judul Pesan</label>
                  <div class="input-group">
                    <input class="form-control" name="judul" value="">
                  </div>
                </div>
                <div class="form-group">
                  <label>isi Pesan</label>
                  <div class="input-group">
                    <textarea class="form-control" style="height:1000px" name="desk"></textarea>
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
      <!-- //Modal Teknisi End -->
  <?php } ?>

