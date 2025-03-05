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
                            <th>FAQ</th>
                            <th>Nama <?php echo $nama ?></th>
                            <th>Desk <?php echo $nama ?></th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $no = 1; 
                            $query = "SELECT solusi.*, faq.* FROM solusi, faq WHERE faq.id_faq = solusi.id_faq ";
                            $result = $conn->query($query);
                            while ($data = $result->fetch_object()) {
                           ?>
                          <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo ucwords($data->nm_faq); ?></td>
                            <td><?php echo ucwords($data->nm_solusi); ?></td>
                            <td><?php echo ucwords($data->desk_solusi); ?></td>
                            <td><button class="btn btn-primary" data-toggle="modal"  data-target="#exampleModal<?php echo $data->id_solusi ?>">Ubah</button> | <a href="<?php echo $_SESSION['direct'] ?>delete.php?hd=master&fd=solusi&id=<?php echo $data->id_solusi; ?>" class="btn btn-danger">Hapus</a></td>
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
        <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Input <?php echo $nama ?></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="<?php echo $_SESSION['direct'] ?>create.php?hd=master&fd=solusi" method="post">
              <div class="modal-body">
                <div class="form-group">
                  <label>Pertanyaan</label>
                  <div class="input-group">
                    <select name="faq" class="form-control">
                      <?php 
                        $querys = $conn->query("SELECT * FROM faq");
                        while ($data_faq = $querys->fetch_object()) { ?>
                          <option value='<?php echo $data_faq->id_faq ?>'><?php echo $data_faq->nm_faq ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label><?php echo $nama ?></label>
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Nama <?php echo $nama ?>" name="nm_solusi">
                  </div>
                </div>
                <div class="form-group">
                  <label>Desk <?php echo $nama ?></label>
                  <div class="input-group">
                    <textarea class="summernote" placeholder="Desk <?php echo $nama ?>" name="desk_solusi"></textarea> 
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
    $no = 1; 
    $query = "SELECT solusi.*, faq.* FROM solusi, faq WHERE faq.id_faq = solusi.id_faq ";
    $result = $conn->query($query);
    while ($data = $result->fetch_object()) {
   ?>
      <!-- Modal Update -->
      <div class="modal fade" id="exampleModal<?php echo $data->id_solusi ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Input <?php echo $nama ?></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="<?php echo $_SESSION['direct'] ?>update.php?hd=master&fd=solusi" method="post">
              <div class="modal-body">
                <div class="form-group">
                  <label>Pertanyaan</label>
                  <div class="input-group">
                    <input type="hidden" value="<?php echo $data->id_solusi ?>" name="id">
                    <select name="faq" class="form-control">
                      <?php 
                        $querys = $conn->query("SELECT * FROM faq");
                        while ($data_faq = $querys->fetch_object()) { ?>
                          <?php if ($data_faq->id_faq == $data->id_faq): ?>
                          <option value='<?php echo $data_faq->id_faq ?>' selected><?php echo $data_faq->nm_faq ?></option>
                          <?php else: ?>
                          <option value='<?php echo $data_faq->id_faq ?>'><?php echo $data_faq->nm_faq ?></option>
                          <?php endif ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label><?php echo $nama ?></label>
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Nama Solusi" value="<?php echo $data->nm_solusi ?>" name="nm_solusi">
                  </div>
                </div>
                <div class="form-group">
                  <label>Desk <?php echo $nama ?></label>
                  <div class="input-group">
                    <textarea class="summernote" placeholder="Desk Solusi" name="desk_solusi"><?php echo $data->desk_solusi ?></textarea> 
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
  <?php } ?>


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
