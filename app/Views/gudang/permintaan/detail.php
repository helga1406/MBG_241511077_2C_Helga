<?= $this->include('layout/header') ?>
<?= $this->include('layout/sidebar') ?>

<div class="container mt-5">
  <div class="card shadow border-0">
    <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
      <h4 class="mb-0">Detail Permintaan</h4>
      <a href="<?= base_url('gudang/permintaan') ?>" class="btn btn-light btn-sm">⬅ Kembali</a>
    </div>
    <div class="card-body">

      <!-- Info umum -->
      <table class="table table-borderless">
        <tr>
          <th class="w-25">Nama Pemohon</th>
          <td><?= $permintaan['nama_pemohon'] ?></td>
        </tr>
        <tr>
          <th>Menu Masakan</th>
          <td><?= $permintaan['menu_makan'] ?></td>
        </tr>
        <tr>
          <th>Jumlah Porsi</th>
          <td><?= $permintaan['jumlah_porsi'] ?></td>
        </tr>
        <tr>
          <th>Tanggal Masak</th>
          <td><?= $permintaan['tgl_masak'] ?></td>
        </tr>
        <tr>
          <th>Status</th>
          <td>
            <?php if($permintaan['status'] == 'menunggu'): ?>
              <span class="badge bg-warning text-dark">Menunggu</span>
            <?php elseif($permintaan['status'] == 'disetujui'): ?>
              <span class="badge bg-success">Disetujui</span>
            <?php elseif($permintaan['status'] == 'ditolak'): ?>
              <span class="badge bg-danger">Ditolak</span>
            <?php endif; ?>
          </td>
        </tr>
      </table>

      <hr>

      <!-- Detail bahan -->
      <h5 class="fw-bold">Daftar Bahan Diminta</h5>
      <div class="table-responsive mt-3">
        <table class="table table-bordered table-striped align-middle">
          <thead class="table-light text-center">
            <tr>
              <th class="text-center">No</th>
              <th>Nama Bahan</th>
              <th class="text-end">Jumlah Diminta</th>
              <th class="text-center">Satuan</th>
            </tr>
          </thead>
          <tbody>
            <?php if(!empty($detail)): ?>
              <?php $no=1; foreach($detail as $d): ?>
              <tr>
                <td class="text-center"><?= $no++ ?></td>
                <td><?= $d['nama'] ?></td>
                <td class="text-end"><?= $d['jumlah_diminta'] ?></td>
                <td class="text-center"><?= $d['satuan'] ?></td>
              </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="4" class="text-center text-muted">Tidak ada detail bahan.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>

      <!-- Aksi jika status masih menunggu -->
      <?php if($permintaan['status'] == 'menunggu'): ?>
        <div class="mt-3">
          <a href="<?= base_url('gudang/permintaan/approve/'.$permintaan['id']) ?>" 
             class="btn btn-success"
             onclick="return confirm('Setujui permintaan ini?')">Setujui</a>
          <a href="<?= base_url('gudang/permintaan/reject/'.$permintaan['id']) ?>" 
             class="btn btn-danger"
             onclick="return confirm('Tolak permintaan ini?')">Tolak</a>
        </div>
      <?php endif; ?>

    </div>
  </div>
</div>

<?= $this->include('layout/footer') ?>
