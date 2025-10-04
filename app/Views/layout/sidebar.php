<!-- Sidebar -->
<div class="sidebar">
  <?php $uri = service('uri'); ?>

  <div>
    <div class="brand">MBG</div>
    <div class="user-info">
      👋Halo, <b><?= session()->get('name') ?></b><br>
      <small><?= ucfirst(session()->get('role')) ?></small>
    </div>

    <!-- Menu Dinamis -->
    <?php if (session()->get('role') === 'gudang'): ?>
      <a href="<?= base_url('gudang/dashboard') ?>" 
         class="<?= ($uri->getSegment(2) === 'dashboard') ? 'active' : '' ?>">
         📊 Dashboard
      </a>
      <a href="<?= base_url('gudang/bahan') ?>" 
         class="<?= ($uri->getSegment(2) === 'bahan') ? 'active' : '' ?>">
         📦 Data Bahan
      </a>
      <a href="<?= base_url('gudang/permintaan') ?>" 
         class="<?= ($uri->getSegment(2) === 'permintaan') ? 'active' : '' ?>">
         📝 Permintaan Masuk
      </a>

    <?php elseif (session()->get('role') === 'dapur'): ?>
      <a href="<?= base_url('dapur/dashboard') ?>" 
         class="<?= ($uri->getSegment(2) === 'dashboard') ? 'active' : '' ?>">
         📊 Dashboard
      </a>
      <a href="<?= base_url('dapur/permintaan') ?>" 
         class="<?= ($uri->getSegment(2) === 'permintaan' && $uri->getSegment(3) === null) ? 'active' : '' ?>">
         📝 Lihat Permintaan
      </a>
    <?php endif; ?>
  </div>

  <!-- Logout -->
  <div class="logout">
  <a href="<?= base_url('logout') ?>" class="btn btn-light w-100 text-danger fw-bold btn-sm btn-logout">
  Logout
  </a>
  </div>
</div>

<!-- Content -->
<div class="content">
