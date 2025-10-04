<?= $this->include('layout/header') ?>
<?= $this->include('layout/sidebar') ?>

<div class="container mt-5">
  <div class="card shadow border-0">
    
    <!-- Header -->
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
      <h4 class="mb-0">📝Daftar Permintaan Bahan</h4>
      <small class="fw-light">Hanya permintaan milik Anda</small>
    </div>

    <!-- Body -->
    <div class="card-body">
      
      <!-- Flash message -->
      <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
      <?php elseif(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
      <?php endif; ?>

      <!-- Table -->
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover align-middle">
          <thead class="table-light text-center">
            <tr>
              <th>No</th>
              <th>Tanggal Masak</th>
              <th>Menu Masakan</th>
              <th>Jumlah Porsi</th>
              <th>Status</th>
              <th>Tgl Permintaan</th>
            </tr>
          </thead>
          <tbody>
            <?php if(!empty($permintaan)): ?>
              <?php $no=1; foreach($permintaan as $p): ?>
                <tr>
                  <td class="text-center"><?= $no++ ?></td>
                  <td><?= date('d M Y', strtotime($p['tgl_masak'])) ?></td>
                  <td><?= esc($p['menu_makan']) ?></td>
                  <td class="text-end"><?= esc($p['jumlah_porsi']) ?></td>
                  <td class="text-center">
                    <?php if($p['status'] === 'menunggu'): ?>
                      <span class="badge bg-warning text-dark">Menunggu</span>
                    <?php elseif($p['status'] === 'disetujui'): ?>
                      <span class="badge bg-success">Disetujui</span>
                    <?php elseif($p['status'] === 'ditolak'): ?>
                      <span class="badge bg-danger">Ditolak</span>
                    <?php else: ?>
                      <span class="badge bg-secondary">Tidak Diketahui</span>
                    <?php endif; ?>
                  </td>
                  <td><?= date('d M Y H:i', strtotime($p['created_at'])) ?></td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="6" class="text-center text-muted">Belum ada permintaan diajukan.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>

      <!-- Tombol Aksi -->
      <div class="mt-3 d-flex justify-content-end gap-2">
        <a href="<?= base_url('dapur/dashboard') ?>" class="btn btn-secondary">
          ⬅ Kembali
        </a>
        <a href="<?= base_url('dapur/permintaan/create') ?>" class="btn btn-success">
          Ajukan Permintaan Baru
        </a>
      </div>

    </div>
  </div>
</div>

<?= $this->include('layout/footer') ?>
