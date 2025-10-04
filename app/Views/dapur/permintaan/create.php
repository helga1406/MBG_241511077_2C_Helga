<?= $this->include('layout/header') ?>
<?= $this->include('layout/sidebar') ?>

<div class="container mt-5">
  <div class="card shadow border-0">
    
    <!-- Header -->
    <div class="card-header bg-success text-white">
      <h4 class="mb-0">Ajukan Permintaan Bahan</h4>
    </div>

    <!-- Body -->
    <div class="card-body">
      <form action="<?= base_url('dapur/permintaan/store') ?>" method="post" class="needs-validation" novalidate>
        
        <!-- Info Umum -->
        <div class="mb-3">
          <label for="tgl_masak" class="form-label">Tanggal Masak</label>
          <input type="date" name="tgl_masak" id="tgl_masak" class="form-control" required>
          <div class="invalid-feedback">Tanggal masak wajib diisi.</div>
        </div>

        <div class="mb-3">
          <label for="menu_makan" class="form-label">Menu Masakan</label>
          <input type="text" name="menu_makan" id="menu_makan" class="form-control" placeholder="Contoh: Nasi goreng + telur" required>
          <div class="invalid-feedback">Menu masakan wajib diisi.</div>
        </div>

        <div class="mb-3">
          <label for="jumlah_porsi" class="form-label">Jumlah Porsi</label>
          <input type="number" name="jumlah_porsi" id="jumlah_porsi" class="form-control" min="1" required>
          <div class="invalid-feedback">Jumlah porsi wajib diisi (minimal 1).</div>
        </div>

        <hr>
        <h5 class="fw-bold">Daftar Bahan Diminta</h5>
        
        <!-- Table Bahan -->
        <div class="table-responsive">
          <table class="table table-bordered align-middle" id="tabel-bahan">
            <thead class="table-light text-center">
              <tr>
                <th style="width: 50px;">No</th>
                <th>Nama Bahan Baku</th>
                <th style="width: 150px;">Jumlah</th>
                <th style="width: 100px;">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center">1</td>
                <td>
                  <select name="bahan_id[]" class="form-select" required>
                    <option value="">-- Pilih Bahan --</option>
                    <?php foreach($bahan as $b): ?>
                      <option value="<?= $b['id'] ?>"><?= $b['nama'] ?> (stok: <?= $b['jumlah'] ?> <?= $b['satuan'] ?>)</option>
                    <?php endforeach; ?>
                  </select>
                  <div class="invalid-feedback">Pilih bahan wajib diisi.</div>
                </td>
                <td>
                  <input type="number" name="jumlah[]" class="form-control" min="1" required>
                  <div class="invalid-feedback">Jumlah bahan wajib diisi.</div>
                </td>
                <td class="text-center">
                  <button type="button" class="btn btn-danger btn-sm" onclick="hapusBaris(this)"></button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Tombol Tambah -->
        <button type="button" class="btn btn-primary btn-sm shadow-sm" onclick="tambahBaris()"> Tambah Bahan</button>
        <hr>

        <!-- Tombol Aksi -->
        <button type="submit" class="btn btn-success shadow-sm">✔ Simpan Permintaan</button>
        <a href="<?= base_url('dapur/permintaan') ?>" class="btn btn-secondary shadow-sm">⬅ Batal</a>
      </form>
    </div>
  </div>
</div>

<?= $this->include('layout/footer') ?>

<script>
function tambahBaris() {
  let tabel = document.getElementById('tabel-bahan').getElementsByTagName('tbody')[0];
  let rowCount = tabel.rows.length;
  let newRow = tabel.insertRow();

  newRow.innerHTML = `
    <td class="text-center">${rowCount + 1}</td>
    <td>
      <select name="bahan_id[]" class="form-select" required>
        <option value="">-- Pilih Bahan --</option>
        <?php foreach($bahan as $b): ?>
          <option value="<?= $b['id'] ?>"><?= $b['nama'] ?> (stok: <?= $b['jumlah'] ?> <?= $b['satuan'] ?>)</option>
        <?php endforeach; ?>
      </select>
      <div class="invalid-feedback">Pilih bahan wajib diisi.</div>
    </td>
    <td>
      <input type="number" name="jumlah[]" class="form-control" min="1" required>
      <div class="invalid-feedback">Jumlah bahan wajib diisi.</div>
    </td>
    <td class="text-center">
      <button type="button" class="btn btn-danger btn-sm" onclick="hapusBaris(this)">hapus</button>
    </td>
  `;

  // fokus ke dropdown baru
  newRow.querySelector("select").focus();
}

function hapusBaris(btn) {
  let row = btn.closest('tr');
  row.remove();

  // update nomor urut
  let rows = document.querySelectorAll("#tabel-bahan tbody tr");
  rows.forEach((r, i) => {
    r.cells[0].innerText = i + 1;
  });
}
</script>


