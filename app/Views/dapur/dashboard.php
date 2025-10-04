<?= $this->include('layout/header') ?>
<?= $this->include('layout/sidebar') ?>

<div class="container-fluid p-4">
  <!-- Header -->
  <div class="mb-4">
    <h3 class="fw-bold text-warning">📊Dashboard Dapur</h3>
    <p class="text-muted mb-1">
      Selamat datang, <b><?= session()->get('name') ?></b>!
    </p>
    <span class="badge bg-warning text-dark"><?= ucfirst(session()->get('role')) ?></span>
  </div>

  <!-- Menu Cepat -->
  <div class="row g-4">
    <!-- Permintaan Bahan -->
    <div class="col-md-6 col-lg-4">
      <div class="card shadow-sm border-0 h-100 hover-card">
        <div class="card-body d-flex flex-column justify-content-between">
          <div>
            <h5 class="fw-bold text-primary mb-2">📑 Permintaan Bahan</h5>
            <p class="text-muted">Ajukan dan lihat status permintaan bahan baku</p>
          </div>
          <a href="<?= base_url('dapur/permintaan') ?>" class="btn btn-primary shadow-sm mt-2">Kelola</a>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->include('layout/footer') ?>
