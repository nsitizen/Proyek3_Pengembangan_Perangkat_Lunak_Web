<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
    <h3>Kelola Data Mahasiswa</h3>

    <button id="show-add-student-form-btn">Tambah Mahasiswa Baru</button>
    <br><br>

    <div id="student-form-container" style="display:none; margin-bottom: 20px; padding: 15px; border: 1px solid #ccc;">
        <h4 id="student-form-title">Form Mahasiswa</h4>
        <form id="student-form">
            <input type="hidden" id="student_id" name="student_id">

            <label for="nim">NIM:</label><br>
            <input type="text" id="nim" name="nim" required>
            <br><br>

            <label for="nama">Nama:</label><br>
            <input type="text" id="nama" name="nama" required>
            <br><br>

            <label for="entry_year">Tahun Masuk:</label><br>
            <input type="number" id="entry_year" name="entry_year" required>
            <br><br>

            <button type="submit">Simpan</button>
            <button type="button" id="cancel-student-btn">Batal</button>
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>NIM</th>
                <th>Nama</th>
                <th>Tahun Masuk</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="student-list-body">
            </tbody>
    </table>

    <script>
        // Nama variabel harus unik, jangan sama dengan 'initialCourses'
        const initialStudents = <?= json_encode($mahasiswa); ?>;
    </script>

<?= $this->endSection(); ?>