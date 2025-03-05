<?php
session_start();
include '../../config/index.php';  
	if($_POST['getDetail']) {
    $id = $_POST['getDetail'];
    $query = "SELECT * FROM faq WHERE id_faq='$id'";
    $result = $conn->query($query);
    while ($data = $result->fetch_object()) {

 ?>
 <!-- Modal -->
<form method="post" action="<?php echo $_SESSION['direct'] ?>update.php?hd=master&fd=faq">
  <div class="form-group">
    <label>Judul FAQ</label>
    <div class="input-group">
      <input type="hidden" class="form-control" value="<?php echo $data->id_faq;?>" placeholder="250000" name="id">
      <input type="text" class="form-control" value="<?php echo $data->nm_faq;?>" placeholder="250000" name="judul">
    </div>
  </div>
	<div class="modal-footer">
    <button type="submit" class="btn btn-primary pull-right">Save</a></button>
		<button class="btn btn-danger pull-left" data-dismiss="modal">Cancel</a></button>
	</div>            
</form>

<?php } } ?>
