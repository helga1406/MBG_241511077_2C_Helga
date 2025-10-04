<?= $this->include('layout/header') ?>
<?= $this->include('layout/sidebar') ?>

<div class="container-fluid p-4">
  <!-- Header -->
  <div class="mb-4">
    <h3 class="fw-bold text-primary">📊Dashboard Gudang</h3>
    <p class="text-muted mb-1">Selamat datang, <b><?= session()->get('name') ?></b></p>
    <span class="badge bg-success"><?= ucfirst(session()->get('role')) ?></span>
  </div>

  <!-- Menu Cepat -->
  <div class="row g-4">
    <!-- Kelola Data Bahan -->
    <div class="col-md-6 col-lg-4">
      <div class="card border-0 shadow-sm h-100 hover-card">
        <div class="card-body d-flex flex-column justify-content-between">
          <div>
            <h5 class="fw-bold text-primary mb-2">📦 Data Bahan</h5>
            <p class="text-muted">Kelola stok bahan baku</p>
          </div>
          <a href="<?= base_url('gudang/bahan') ?>" class="btn btn-primary mt-2 shadow-sm">Kelola</a>
        </div>
      </div>
    </div>

    <!-- Kelola Permintaan -->
    <div class="col-md-6 col-lg-4">
      <div class="card border-0 shadow-sm h-100 hover-card">
        <div class="card-body d-flex flex-column justify-content-between">
          <div>
            <h5 class="fw-bold text-danger mb-2">📝 Permintaan Dapur</h5>
            <p class="text-muted">Lihat & proses permintaan bahan dari dapur</p>
          </div>
          <a href="<?= base_url('gudang/permintaan') ?>" class="btn btn-danger mt-2 shadow-sm">Kelola</a>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->include('layout/footer') ?>
