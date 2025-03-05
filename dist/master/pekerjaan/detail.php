<?php
session_start();
include '../../config/index.php';  
	if($_POST['getDetail']) {
    $id = $_POST['getDetail'];
    $query = "SELECT * FROM pekerjaan WHERE id_pekerjaan='$id'";
    $result = $conn->query($query);
    while ($data = $result->fetch_object()) {

 ?>
 <!-- Modal -->
<form method="post" action="<?php echo $_SESSION['direct'] ?>update.php?hd=master&fd=pekerjaan">
	<div class="form-group row">
		<label class="col-sm-4 col-form-label">Nama Pekerjaan</label>
		<div class="col-sm-8">
			<input type="hidden" class="form-control" value="<?php echo $data->id_pekerjaan;?>" name="id">
			<input type="text" class="form-control" value="<?php echo $data->nm_pekerjaan;?>" name="nm_pekerjaan">
		</div>
	</div>
	<div class="modal-footer">
		<button class="btn btn-danger pull-left" data-dismiss="modal">Cancel</a></button>
		<button type="submit" class="btn btn-primary pull-right">Save</a></button>
	</div>            
</form>

<?php } } ?>
      <!-- Modal Edit -->
<!--       <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="editModal">Edit <?php //echo $nama ?></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="update.php" method="post">
              <div class="modal-body">
              <p>Modals body text goes here.</p>
                <div class="form-group">
                  <label>Nama <?php //echo $nama ?></label>
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Nama <?php //echo $nama ?>" name="nm_pekerjaan">
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
      </div> -->
      <!-- //Modal Edit -->