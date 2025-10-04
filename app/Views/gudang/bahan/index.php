<?= $this->include('layout/header') ?>
<?= $this->include('layout/sidebar') ?>

<div class="container-fluid p-5">

  <div class="mb-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0">📦 Daftar Bahan Baku</h3>
            <?php if (session()->get('role') == 'gudang'): ?>
                <a href="<?= base_url('gudang/bahan/create') ?>" class="btn btn-light btn-sm fw-bold">Tambah Bahan</a>
            <?php endif; ?>
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
                    <thead class="table-light">
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Jumlah</th>
                            <th>Satuan</th>
                            <th>Tgl Masuk</th>
                            <th>Tgl Kadaluarsa</th>
                            <th>Status</th>
                            <?php if (session()->get('role') == 'gudang'): ?>
                                <th>Aksi</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($bahan)): ?>
                            <?php $no=1; foreach($bahan as $b): ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td><?= $b['nama'] ?></td>
                                <td><?= $b['kategori'] ?></td>
                                <td class="text-end"><?= $b['jumlah'] ?></td>
                                <td><?= $b['satuan'] ?></td>
                                <td><?= $b['tanggal_masuk'] ?></td>
                                <td><?= $b['tanggal_kadaluarsa'] ?></td>
                                <td>
                                    <?php if($b['status'] == 'Tersedia'): ?>
                                        <span class="badge bg-success"><?= $b['status'] ?></span>
                                    <?php elseif($b['status'] == 'Segera Kadaluarsa'): ?>
                                        <span class="badge bg-warning text-dark"><?= $b['status'] ?></span>
                                    <?php elseif($b['status'] == 'Kadaluarsa'): ?>
                                        <span class="badge bg-danger"><?= $b['status'] ?></span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary"><?= $b['status'] ?></span>
                                    <?php endif; ?>
                                </td>

                                <?php if (session()->get('role') == 'gudang'): ?>
                                <td class="text-center">
                                    <a href="<?= base_url('gudang/bahan/edit/'.$b['id']) ?>" class="btn btn-warning btn-sm shadow-sm">Edit</a>
                                    <a href="<?= base_url('gudang/bahan/delete/'.$b['id']) ?>" class="btn btn-danger btn-sm shadow-sm btn-delete">Hapus</a>
                                    <?php if ($b['status'] != 'Kadaluarsa'): ?>
                                        <small class="text-muted d-block">Hanya bisa hapus jika Kadaluarsa</small>
                                    <?php endif; ?>
                                </td>
                                <?php endif; ?>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="9" class="text-center text-muted">Tidak ada data bahan</td>
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
