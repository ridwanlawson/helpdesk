<?php
session_start();
include '../../config/index.php';  
	if($_POST['getDetail']) {
    $id = $_POST['getDetail'];
    $query = "SELECT * FROM solusi WHERE id_solusi='$id'";
    $result = $conn->query($query);
    while ($data = $result->fetch_object()) {

 ?>
 <!-- Modal -->
<form method="post" action="<?php echo $_SESSION['direct'] ?>update.php?hd=master&fd=solusi">
  <div class="form-group">
    <label>Pertanyaan</label>
    <div class="input-group">
      <input type="hidden" class="form-control" value="<?php echo $data->id_solusi;?>" name="id">
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
    <label>Solusi</label>
    <div class="input-group">
      <input type="text" class="form-control" placeholder="Nama Solusi" value="<?php echo $data->nm_solusi ?>" name="nm_solusi">
    </div>
  </div>
  <div class="form-group">
    <label>Desk Solusi</label>
    <div class="input-group">
      <textarea class="summernote" placeholder="Desk" value="<?php echo $data->desk_solusi ?>" name="desk_solusi"></textarea> 
    </div>
  </div>
	<div class="modal-footer">
		<button class="btn btn-danger pull-left" data-dismiss="modal">Cancel</a></button>
		<button type="submit" class="btn btn-primary pull-right">Save</a></button>
	</div>            
</form>

<?php } } ?>