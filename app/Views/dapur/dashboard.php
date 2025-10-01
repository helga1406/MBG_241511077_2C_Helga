<?= $this->include('layout/header') ?>
<?= $this->include('layout/sidebar') ?>

<div class="container-fluid p-4">
  <!-- Header -->
  <div class="mb-4">
    <h3 class="fw-bold text-primary">Dashboard Dapur</h3>
    <p class="text-muted mb-1">Selamat datang, <b><?= session()->get('name') ?></b></p>
    <span class="badge bg-info">
      <?= ucfirst(session()->get('role')) ?>
    </span>
  </div>

  <!-- Menu Cepat -->
  <div class="row g-4">
    <!-- Buat Permintaan -->
    <div class="col-md-6 col-lg-4">
      <div class="card border-0 shadow-sm h-100 hover-card">
        <div class="card-body d-flex flex-column justify-content-between">
          <div>
            <h5 class="fw-bold text-primary">Buat Permintaan Bahan</h5>
            <p class="text-muted">Ajukan permintaan bahan untuk masak H-1</p>
          </div>
          <a href="<?= base_url('permintaan/create') ?>" class="btn btn-primary mt-2">Buat Permintaan</a>
        </div>
      </div>
    </div>

    <!-- Lihat Status Permintaan -->
    <div class="col-md-6 col-lg-4">
      <div class="card border-0 shadow-sm h-100 hover-card">
        <div class="card-body d-flex flex-column justify-content-between">
          <div>
            <h5 class="fw-bold text-success">Lihat Status Permintaan</h5>
            <p class="text-muted">Cek status permintaan (menunggu/disetujui/ditolak)</p>
          </div>
          <a href="<?= base_url('permintaan') ?>" class="btn btn-success mt-2">Lihat Status</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Logout -->
  <div class="mt-4">
    <a href="<?= base_url('logout') ?>" class="btn btn-danger">Logout</a>
  </div>
</div>

<?= $this->include('layout/footer') ?>
