</div> 

<footer class="text-center py-3 mt-auto bg-light border-top">
  <small class="text-muted">
    &copy; <?= date('Y') ?> <i class="bi bi-mortarboard"></i> MBG. All rights reserved.
  </small>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Modal Konfirmasi Global -->
<div class="modal fade" id="globalConfirmModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title">Konfirmasi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body" id="confirmMessage">Apakah Anda yakin?</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" id="btnConfirmAction">Ya, Lanjutkan</button>
      </div>
    </div>
  </div>
</div>


<script>
(function () {
  'use strict';
  let forms = document.querySelectorAll('.needs-validation');
  let confirmModal = new bootstrap.Modal(document.getElementById('globalConfirmModal'));
  let confirmMessage = document.getElementById('confirmMessage');
  let btnConfirm = document.getElementById('btnConfirmAction');
  let targetForm = null;
  let targetHref = null;

  // Tambah & Update
  Array.prototype.slice.call(forms).forEach(function (form) {
    form.addEventListener('submit', function (event) {
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
      } else {
        event.preventDefault();
        targetForm = form;
        confirmMessage.innerText = "Apakah Anda yakin ingin menyimpan data ini?";
        confirmModal.show();
      }
      form.classList.add('was-validated');
    }, false);
  });

  // Hapus
  document.querySelectorAll('.btn-delete').forEach(function (btn) {
    btn.addEventListener('click', function (event) {
      event.preventDefault();
      targetHref = this.getAttribute('href');
      confirmMessage.innerText = "Apakah Anda yakin ingin menghapus data ini?";
      confirmModal.show();
    });
  });

  // Logout
  document.querySelectorAll('.btn-logout').forEach(function (btn) {
    btn.addEventListener('click', function (event) {
      event.preventDefault();
      targetHref = this.getAttribute('href');
      confirmMessage.innerText = "Apakah Anda yakin ingin logout?";
      confirmModal.show();
    });
  });

  // Eksekusi final
  btnConfirm.onclick = function () {
    if (targetForm) {
      targetForm.submit();
      targetForm = null;
    } else if (targetHref) {
      window.location.href = targetHref;
      targetHref = null;
    }
    confirmModal.hide();
  };

})();
</script>
</body>
</html>
