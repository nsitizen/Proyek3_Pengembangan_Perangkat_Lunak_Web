  </main>
  <!-- CONTENT END -->

  <!-- FOOTER -->
  <footer class="text-center mt-4 p-3 bg-light border-top">
    <small><b>Bandung - Jawa Barat</b></small>
  </footer>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="delete-confirmation-modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title">Konfirmasi Penghapusan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p id="delete-modal-message">Apakah Anda yakin?</p>
      </div>
      <div class="modal-footer">
        <button id="confirm-delete-btn" class="btn btn-danger">Ya, Hapus</button>
        <button id="cancel-delete-btn" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap Bundle JS (dengan Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Custom JS -->
<script src="<?= base_url('js/app.js') ?>"></script>
</body>
</html>
