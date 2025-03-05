<?php
session_start();
if (empty($_SESSION['nama'])) {
  echo '<script>
			window.location.href = "../index.php";
		</script>';
}
@$head = $_GET['hd']; 
@$folder = $_GET['fd'];

	include 'header/index.php';
	if (!empty($head)&&!empty($folder)) {
		include $head.'/'.$folder.'/index.php';
	}elseif (!empty($folder)) {
		include $folder.'/index.php';
	}else{
		include 'main.php';
	}

	include 'footer/index.php';
?>