<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
    <h3>Ambil Mata Kuliah</h3>

    <form id="enroll-form">
        <h4>Pilih Mata Kuliah yang Tersedia:</h4>
        <div id="course-checklist">
            </div>
        <hr>
        <h5>Total SKS yang Dipilih: <span id="total-sks">0</span> SKS</h5>
        <button type="submit">Daftarkan Mata Kuliah</button>
    </form>
    
    <script>
        const BASE_URL = "<?= base_url() ?>";
        const initialCoursesForEnroll = <?= json_encode($courses); ?>;
        const enrolledCourseIds = <?= json_encode($enrolled_ids); ?>;
    </script>
<?= $this->endSection(); ?>