<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Buat Permintaan Bahan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h3>📝 Buat Permintaan Bahan</h3>

    <form action="<?= base_url('permintaan/store') ?>" method="post">
        <div class="mb-3">
            <label>Tanggal Masak</label>
            <input type="date" name="tgl_masak" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Menu Makanan</label>
            <input type="text" name="menu_makan" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Jumlah Porsi</label>
            <input type="number" name="jumlah_porsi" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Bahan Baku</label>
            <select name="bahan_id[]" class="form-select" multiple required>
                <?php foreach($bahan as $b): ?>
                    <?php if($b['status'] != 'kadaluarsa' && $b['jumlah'] > 0): ?>
                        <option value="<?= $b['id'] ?>"><?= $b['nama'] ?> (stok: <?= $b['jumlah'] ?> <?= $b['satuan'] ?>)</option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
            <small class="text-muted">Tekan Ctrl untuk pilih lebih dari 1 bahan</small>
        </div>

        <div class="mb-3">
            <label>Jumlah Bahan (urutan sesuai pilihan)</label>
            <input type="text" name="jumlah_diminta[]" class="form-control" placeholder="Contoh: 10,20,15" required>
        </div>

        <button type="submit" class="btn btn-primary">Kirim Permintaan</button>
        <a href="<?= base_url('permintaan') ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
