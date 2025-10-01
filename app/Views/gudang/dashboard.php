<?= $this->include('layout/header') ?>
<?= $this->include('layout/sidebar') ?>

<div class="container-fluid p-4">
  <!-- Header -->
  <div class="mb-4">
    <h3 class="fw-bold text-primary">Dashboard Gudang</h3>
    <p class="text-muted mb-1">Selamat datang, <b><?= session()->get('name') ?></b></p>
    <span class="badge bg-info">
      <?= ucfirst(session()->get('role')) ?>
    </span>
  </div>

  <!-- Menu Cepat -->
  <div class="row g-4">
    <!-- Tambah Bahan Baku -->
    <div class="col-md-6 col-lg-4">
      <div class="card border-0 shadow-sm h-100 hover-card">
        <div class="card-body d-flex flex-column justify-content-between">
          <div>
            <h5 class="fw-bold text-primary">Tambah Bahan Baku</h5>
            <p class="text-muted">Input bahan baku baru ke dalam sistem</p>
          </div>
          <a href="<?= base_url('bahan/create') ?>" class="btn btn-primary mt-2">Tambah</a>
        </div>
      </div>
    </div>

    <!-- Lihat Data Bahan Baku -->
    <div class="col-md-6 col-lg-4">
      <div class="card border-0 shadow-sm h-100 hover-card">
        <div class="card-body d-flex flex-column justify-content-between">
          <div>
            <h5 class="fw-bold text-success">Lihat Data Bahan Baku</h5>
            <p class="text-muted">Cek stok bahan baku dengan statusnya</p>
          </div>
          <a href="<?= base_url('bahan') ?>" class="btn btn-success mt-2">Lihat Data</a>
        </div>
      </div>
    </div>

    <!-- Persetujuan Permintaan -->
    <div class="col-md-6 col-lg-4">
      <div class="card border-0 shadow-sm h-100 hover-card">
        <div class="card-body d-flex flex-column justify-content-between">
          <div>
            <h5 class="fw-bold text-warning">Persetujuan Permintaan</h5>
            <p class="text-muted">Setujui atau tolak permintaan dari dapur</p>
          </div>
          <a href="<?= base_url('permintaan') ?>" class="btn btn-warning mt-2">Kelola</a>
        </div>
      </div>
    </div>
  </div>


<?= $this->include('layout/footer') ?>

