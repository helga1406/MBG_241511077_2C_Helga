<?= $this->include('layout/header') ?>
<?= $this->include('layout/sidebar') ?>

<div class="container mt-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-success text-white">
            <h3 class="mb-0">Tambah Bahan Baku</h3>
        </div>
        <div class="card-body">
            <form action="<?= base_url('gudang/bahan/store') ?>" method="post" 
                  class="needs-validation" novalidate>
                
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Bahan</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                    <div class="invalid-feedback">Nama bahan wajib diisi.</div>
                </div>

                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <input type="text" class="form-control" id="kategori" name="kategori" required>
                    <div class="invalid-feedback">Kategori wajib diisi.</div>
                </div>

                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="number" class="form-control" id="jumlah" name="jumlah" min="0" required>
                    <div class="invalid-feedback">Jumlah tidak boleh kosong atau negatif.</div>
                </div>

                <div class="mb-3">
                    <label for="satuan" class="form-label">Satuan</label>
                    <input type="text" class="form-control" id="satuan" name="satuan" required>
                    <div class="invalid-feedback">Satuan wajib diisi.</div>
                </div>

                <div class="mb-3">
                    <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
                    <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" required>
                    <div class="invalid-feedback">Tanggal masuk wajib diisi.</div>
                </div>

                <div class="mb-3">
                    <label for="tanggal_kadaluarsa" class="form-label">Tanggal Kadaluarsa</label>
                    <input type="date" class="form-control" id="tanggal_kadaluarsa" name="tanggal_kadaluarsa" required>
                    <div class="invalid-feedback">Tanggal kadaluarsa wajib diisi.</div>
                </div>

                <button type="submit" class="btn btn-success shadow-sm">Simpan</button>
                <a href="<?= base_url('gudang/bahan') ?>" class="btn btn-secondary shadow-sm">⬅ Batal</a>
            </form>
        </div>
    </div>
</div>

<?= $this->include('layout/footer') ?>
