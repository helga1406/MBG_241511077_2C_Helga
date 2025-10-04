<?= $this->include('layout/header') ?>
<?= $this->include('layout/sidebar') ?>

<div class="container-fluid p-5">

  <div class="mb-5">
  <div class="card shadow-lg border-0">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
      <h3 class="mb-0">Daftar Permintaan Bahan</h3>
    </div>
    <div class="card-body">

      <!-- Flash message -->
      <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
      <?php elseif(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
      <?php endif; ?>

      <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
          <thead class="table-light text-center">
            <tr>
              <th>No</th>
              <th>Nama Pemohon</th>
              <th>Menu Masakan</th>
              <th>Jumlah Porsi</th>
              <th>Tanggal Masak</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php if(!empty($permintaan)): ?>
              <?php $no=1; foreach($permintaan as $p): ?>
              <tr>
                <td class="text-center"><?= $no++ ?></td>
                    <td><?= esc($p['nama_pemohon']) ?></td>
                    <td><?= esc($p['menu_makan']) ?></td>
                    <td class="text-end"><?= esc($p['jumlah_porsi']) ?></td>
                    <td><?= esc($p['tgl_masak']) ?></td>
                    <td class="text-center">
                      <?php if($p['status'] == 'menunggu'): ?>
                        <span class="badge bg-warning text-dark">Menunggu</span>
                      <?php elseif($p['status'] == 'disetujui'): ?>
                        <span class="badge bg-success">Disetujui</span>
                      <?php elseif($p['status'] == 'ditolak'): ?>
                        <span class="badge bg-danger">Ditolak</span>
                      <?php else: ?>
                        <span class="badge bg-secondary">Tidak Diketahui</span>
                      <?php endif; ?>
                  </td>
                  <td class="text-center">
                    
                </td>
              </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="7" class="text-center text-muted">Tidak ada data permintaan</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>

      <a href="<?= base_url('gudang/dashboard') ?>" class="btn btn-secondary mt-3">⬅ Kembali</a>
    </div>
  </div>
</div>

<?= $this->include('layout/footer') ?>
