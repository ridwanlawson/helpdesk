
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="row">
            <div class="col-md-12"> 
                <div class="card"> 
                  <div class="card-body"> 
                    <h2 align="center"> Selamat Datang <?php echo ucwords($_SESSION['nama']) ?> </h2>
                    <h2 align="center"> Layanan Pengaduan <?php echo $judul->nm_perusahaan; ?></h2>
                    </div>
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4>Pengajuan per <?php echo date('M Y') ?></h4>
                  <div class="card-header-action">
                    <a href="?hd=transaksi&fd=pengajuan" class="btn btn-danger">View More <i class="fas fa-chevron-right"></i></a>
                  </div>
                </div>
                <div class="card-body p-0">
                  <h3 align="center">Semoga dalam keadaan sehat dan berbahagia</h3>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>