<?= $this->include('layout/header') ?>
<?= $this->include('layout/sidebar') ?>

<div class="container mt-5">
    <div class="card shadow border-0">
        <div class="card-header bg-danger text-white">
            <h4> Konfirmasi Hapus Bahan</h4>
        </div>
        <div class="card-body">
            <p>Apakah Anda yakin ingin menghapus bahan berikut?</p>

            <table class="table table-bordered">
                <tr>
                    <th>Nama</th>
                    <td><?= esc($bahan['nama']) ?></td>
                </tr>
                <tr>
                    <th>Kategori</th>
                    <td><?= esc($bahan['kategori']) ?></td>
                </tr>
                <tr>
                    <th>Jumlah</th>
                    <td><?= esc($bahan['jumlah']) ?> <?= esc($bahan['satuan']) ?></td>
                </tr>
                <tr>
                    <th>Tanggal Masuk</th>
                    <td><?= esc($bahan['tanggal_masuk']) ?></td>
                </tr>
                <tr>
                    <th>Tanggal Kadaluarsa</th>
                    <td><?= esc($bahan['tanggal_kadaluarsa']) ?></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <?php if($bahan['status'] == 'Kadaluarsa'): ?>
                            <span class="badge bg-danger"><?= $bahan['status'] ?></span>
                        <?php elseif($bahan['status'] == 'Segera Kadaluarsa'): ?>
                            <span class="badge bg-warning text-dark"><?= $bahan['status'] ?></span>
                        <?php elseif($bahan['status'] == 'Tersedia'): ?>
                            <span class="badge bg-success"><?= $bahan['status'] ?></span>
                        <?php else: ?>
                            <span class="badge bg-secondary"><?= $bahan['status'] ?></span>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>

            <div class="mt-3">
                <form action="<?= base_url('gudang/bahan/delete/'.$bahan['id']) ?>" method="post">
                    <?= csrf_field() ?>
                    <?php if($bahan['status'] == 'Kadaluarsa'): ?>
                        <button type="submit" class="btn btn-danger shadow-sm">Ya, Hapus</button>
                    <?php else: ?>
                        <button type="button" class="btn btn-danger shadow-sm" disabled>Ya, Hapus</button>
                        <small class="text-muted d-block mt-2">Bahan hanya bisa dihapus jika status <strong>Kadaluarsa</strong></small>
                    <?php endif; ?>
                    <a href="<?= base_url('gudang/bahan') ?>" class="btn btn-secondary shadow-sm">⬅ Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->include('layout/footer') ?>
