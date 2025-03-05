
<?php 
  if ($_SESSION['level']=='admin') {
?>
          <ul class="sidebar-menu" style="padding-top: 10px;">
            <li class="menu-header"></li>
            <li class="<?php if (empty($_GET['hd']) && empty($_GET['fd'])) {echo 'active';} ?>"><a class="nav-link" href="index.php" ><i class="fas fa-fire"></i><span>Dashboard</span></a></li>

            <li class="<?php if (@$_GET['hd']=='profil' && @$_GET['fd']=='perusahaan') {echo 'active';} ?>"><a class="nav-link" href="?hd=profil&fd=perusahaan"><i class="fas fa-user"></i><span>Profil</span></a></li>

            <li class="<?php if (@$_GET['hd']=='master' && @$_GET['fd']=='pengumuman') {echo 'active';} ?>"><a class="nav-link" href="?hd=master&fd=pengumuman"><i class="fas fa-bullhorn" aria-hidden="true"></i><span>Pengumuman</span></a></li>
            
            <li class="menu-header">Starter</li>
            <li class="dropdown <?php if (@$_GET['hd']=='pesan') {echo 'active';} ?>">
              <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-envelope"></i> <span>Pesan</span></a>
              <ul class="dropdown-menu">
                <li <?php if (@$_GET['fd']=='masuk') {echo 'class=active';} ?>><a class="nav-link" href="?hd=pesan&fd=masuk">Pengaduan</a></li>
                <li <?php if (@$_GET['fd']=='keluar') {echo 'class=active';} ?>><a class="nav-link" href="?hd=pesan&fd=keluar">Balasan</a></li>
              </ul>
            </li>
            <li class="dropdown <?php if (@$_GET['hd']=='master') {echo 'active';} ?>">
              <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Master</span></a>
              <ul class="dropdown-menu">
                <li <?php if (@$_GET['fd']=='faq') {echo 'class=active';} ?>><a class="nav-link" href="?hd=master&fd=faq">FAQ</a></li>
                <li <?php if (@$_GET['fd']=='solusi') {echo 'class=active';} ?>><a class="nav-link" href="?hd=master&fd=solusi">Solusi</a></li>
                <li <?php if (@$_GET['fd']=='user') {echo 'class=active';} ?>><a class="nav-link" href="?hd=master&fd=user">User</a></li>
              </ul>
            </li>
            <li class="dropdown <?php if (@$_GET['hd']=='transaksi') {echo 'active';} ?>">
              <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-pencil-ruler"></i> <span>Ticketing</span></a>
              <ul class="dropdown-menu">
                <li <?php if (@$_GET['fd']=='processing') {echo 'class=active';} ?>><a class="nav-link" href="?hd=transaksi&fd=processing">Processing</a></li>
                <li <?php if (@$_GET['fd']=='done') {echo 'class=active';} ?>><a class="nav-link" href="?hd=transaksi&fd=done">Done</a></li>
              </ul>
            </li>
<?php
  }elseif ($_SESSION['level']=='user'){
?>
          <ul class="sidebar-menu" style="padding-top: 10px;">
            <li class="menu-header"></li>
            <li class="<?php if (empty($_GET['hd']) && empty($_GET['fd'])) {echo 'active';} ?>"><a class="nav-link" href="index.php" ><i class="fas fa-fire"></i><span>Dashboard</span></a></li>
            <li class="menu-header">Starter</li>
            <li class="dropdown active">
              <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-envelope"></i> <span>Pesan</span></a>
              <ul class="dropdown-menu">
                <li <?php if (@$_GET['fd']=='keluar') {echo 'class=active';} ?>><a class="nav-link" href="?hd=pesan&fd=keluar">Pengaduan</a></li>
                <li <?php if (@$_GET['fd']=='masuk') {echo 'class=active';} ?>><a class="nav-link" href="?hd=pesan&fd=masuk">Balasan</a></li>
              </ul>
            </li>
<?php    
  }elseif ($_SESSION['level']=='teknisi'){
?>
          <ul class="sidebar-menu" style="padding-top: 10px;">
            <li class="menu-header"></li>
            <li class="<?php if (empty($_GET['hd']) && empty($_GET['fd'])) {echo 'active';} ?>"><a class="nav-link" href="index.php" ><i class="fas fa-fire"></i><span>Dashboard</span></a></li>
            <li class="menu-header">Starter</li>
            <li class="dropdown active ?>">
              <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-envelope"></i> <span>Pesan</span></a>
              <ul class="dropdown-menu">
                <li <?php if (@$_GET['fd']=='keluar') {echo 'class=active';} ?>><a class="nav-link" href="?hd=pesan&fd=keluar">Pengaduan</a></li>
                <li <?php if (@$_GET['fd']=='masuk') {echo 'class=active';} ?>><a class="nav-link" href="?hd=pesan&fd=masuk">Balasan</a></li>
                <li <?php if (@$_GET['fd']=='teknisi') {echo 'class=active';} ?>><a class="nav-link" href="?hd=pesan&fd=teknisi">Processing</a></li>
              </ul>
            </li>
<?php    
  }
?>