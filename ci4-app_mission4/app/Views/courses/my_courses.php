<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
    <h3>Mata Kuliah yang Sudah Diambil</h3>

    <table>
        <thead>
            <tr>
                <th>Nama Mata Kuliah</th>
                <th>SKS</th>
            </tr>
        </thead>
        <tbody id="my-courses-list">
            </tbody>
    </table>

    <script>
        // Jembatan data dari PHP ke JS
        const initialMyCourses = <?= json_encode($courses); ?>;
    </script>
<?= $this->endSection(); ?>