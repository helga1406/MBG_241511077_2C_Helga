<!-- Sidebar Gudang -->
<div class="sidebar bg-light p-3 border-end" style="min-height: 100vh;">
  <?php $uri = service('uri'); ?>

  <div class="mb-4">
    <div class="fw-bold fs-5 mb-2">📦 MBG Gudang</div>
    <div class="small text-muted">
      👋 Halo, <b><?= session()->get('name') ?></b><br>
      <span class="badge bg-info"><?= ucfirst(session()->get('role')) ?></span>
    </div>
  </div>

  <!-- Menu Gudang -->
  <a href="<?= base_url('gudang') ?>" 
     class="d-block mb-2 <?= ($uri->getSegment(1) === 'gudang') ? 'fw-bold text-primary' : '' ?>">
     📊 Dashboard
  </a>

  <a href="<?= base_url('bahan/create') ?>" 
     class="d-block mb-2 <?= ($uri->getSegment(2) === 'create') ? 'fw-bold text-primary' : '' ?>">
     Tambah Bahan Baku
  </a>

  <a href="<?= base_url('bahan') ?>" 
     class="d-block mb-2 <?= ($uri->getSegment(1) === 'bahan') ? 'fw-bold text-primary' : '' ?>">
     Lihat Data Bahan
  </a>

  <a href="<?= base_url('permintaan') ?>" 
     class="d-block mb-2 <?= ($uri->getSegment(1) === 'permintaan') ? 'fw-bold text-primary' : '' ?>">
     Persetujuan Permintaan
  </a>

  <!-- Logout -->
  <div class="mt-4">
    <a href="<?= base_url('logout') ?>" class="btn btn-danger w-100">🚪 Logout</a>
  </div>
</div>

