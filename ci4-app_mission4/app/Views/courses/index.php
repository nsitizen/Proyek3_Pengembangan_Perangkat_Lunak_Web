<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
    <h3>Kelola Data Mata Kuliah</h3>

    <button id="show-add-form-btn">Tambah Mata Kuliah Baru</button>
    <br><br>

    <div id="course-form-container" style="display:none; margin-bottom: 20px; padding: 15px; border: 1px solid #ccc;">
        <h4 id="form-title">Form Mata Kuliah</h4>
        <form id="course-form">
            <input type="hidden" id="course_id" name="course_id">
            
            <label for="course_name">Nama Mata Kuliah:</label><br>
            <input type="text" id="course_name" name="course_name" required>
            <small id="name-error" style="color: red;"></small>
            <br><br>

            <label for="credits">Jumlah SKS:</label><br>
            <input type="number" id="credits" name="credits" required>
            <small id="credits-error" style="color: red;"></small>
            <br><br>

            <button type="submit">Simpan</button>
            <button type="button" id="cancel-btn">Batal</button>
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nama Mata Kuliah</th>
                <th>SKS</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="course-list-body">
            </tbody>
    </table>

    <script>
        const initialCourses = <?= json_encode($courses); ?>;
    </script>

<?= $this->endSection(); ?>