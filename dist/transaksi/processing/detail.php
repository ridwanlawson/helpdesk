<?php
session_start();
include '../../config/index.php';  
  if($_POST['getDetail']) {
    $id = $_POST['getDetail'];
    $query = "SELECT * FROM pengajuan WHERE no_ktp='$id'";
    $result = $conn->query($query);
    while ($data = $result->fetch_object()) {
      $status = $data->status;
 ?>
 <!-- Modal -->
<form method="post" enctype="multipart/form-data" action="<?php echo $_SESSION['direct'] ?>update.php?hd=transaksi&fd=pengajuan">
  <input type="hidden" value="<?php echo $data->no_ktp;?>" name="id">  
  <input type="hidden" value="<?php echo $data->id_user;?>" name="id_user">  
  <div class="form-row">
      <label for="validationDefault01">Nama Nasabah</label>
      <input type="text" name="pesan" value="<?php echo $data->nama_nasabah;?>" class="form-control" id="validationDefault01" placeholder="Ujang Maman" readonly required>
      <label for="validationDefault02">Alasan Penolakan</label>
      <textarea class="form-control" name="pesan" autofocus required="" id="validationDefault02"></textarea>
      <small>
        <i>(Wajib Diisi).</i>
      </small>
  </div> 
  <div class="modal-footer">
    <button type="submit" class="btn btn-primary pull-right">Kirim</a></button>
    <button class="btn btn-danger pull-left" data-dismiss="modal">Close</a></button>
  </div>            
</form>

<?php } } ?>
