<?= $this->include('layout/header') ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header text-center">
                    <h4>Login</h4>
                </div>
                <div class="card-body">
                    
                    <!-- Flash message (kalau ada error dari session) -->
                    <?php if(session()->getFlashdata('msg')): ?>
                        <div class="alert alert-danger">
                            <?= session()->getFlashdata('msg') ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('auth/processLogin') ?>" method="post">
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Masukkan email" required>
                            <div class="invalid-feedback">
                                Email wajib diisi.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                            <div class="invalid-feedback">
                                Password wajib diisi.
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>

<?= $this->include('layout/footer') ?>
