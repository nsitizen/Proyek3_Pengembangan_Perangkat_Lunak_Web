// --- LOGIKA UNTUK MENU AKTIF ---
document.addEventListener("DOMContentLoaded", function() {
    // Ambil semua link menu yang memiliki class nav-link
    const navLinks = document.querySelectorAll(".nav-link");
    // Dapatkan path URL saat ini (misal: /mahasiswa)
    const currentPath = window.location.pathname;

    navLinks.forEach(link => {
        // Jika href dari link sama dengan path saat ini
        if (link.getAttribute('href') === currentPath) {
            // Tambahkan class 'active' ke link tersebut
            link.classList.add('active');
        }
    });
});

// Cek jika kita berada di halaman yang tepat sebelum menjalankan kode
if (document.querySelector("#course-list-body")) {

    // Gunakan data yang di-passing dari PHP
    let courses = initialCourses;

    // --- Selektor untuk elemen-elemen PENTING ---
    const courseTableBody = document.querySelector("#course-list-body");
    const showAddFormBtn = document.querySelector("#show-add-form-btn");
    const courseFormContainer = document.querySelector("#course-form-container");
    const courseForm = document.querySelector("#course-form");
    const cancelBtn = document.querySelector("#cancel-btn");
    const formTitle = document.querySelector("#form-title");

    // --- FUNGSI UNTUK MERENDER TABEL ---
    function renderCourses() {
        courseTableBody.innerHTML = ""; // Kosongkan tabel
        courses.forEach(course => {
            const row = document.createElement("tr");
            row.innerHTML = `
                <td>${course.course_name}</td>
                <td>${course.credits}</td>
                <td>
                    <button class="edit-btn" data-id="${course.course_id}" data-name="${course.course_name}" data-credits="${course.credits}">Edit</button>
                    <button class="delete-btn" data-id="${course.course_id}" data-name="${course.course_name}" data-credits="${course.credits}">Hapus</button>
                </td>
            `;
            courseTableBody.appendChild(row);
        });
    }

    // --- EVENT LISTENER UNTUK MENANGANI SEMUA AKSI ---

    // 1. Tampilkan form tambah saat tombol "Tambah" diklik
    showAddFormBtn.addEventListener('click', () => {
        formTitle.textContent = "Form Tambah Mata Kuliah";
        courseForm.reset(); // Kosongkan form
        document.querySelector("#course_id").value = ''; // Pastikan ID kosong
        courseFormContainer.style.display = 'block';
    });

    // 2. Sembunyikan form saat tombol "Batal" diklik
    cancelBtn.addEventListener('click', () => {
        courseFormContainer.style.display = 'none';
    });

    // 3. Tangani aksi Edit dan Hapus (menggunakan event delegation)
    courseTableBody.addEventListener('click', (e) => {
        // Jika tombol EDIT diklik
        if (e.target.classList.contains('edit-btn')) {
            const id = e.target.dataset.id;
            const name = e.target.dataset.name;
            const credits = e.target.dataset.credits;

            // Isi form dengan data yang ada
            formTitle.textContent = "Form Ubah Mata Kuliah";
            document.querySelector("#course_id").value = id;
            document.querySelector("#course_name").value = name;
            document.querySelector("#credits").value = credits;
            courseFormContainer.style.display = 'block';
        }

        // Jika tombol HAPUS diklik
        if (e.target.classList.contains('delete-btn')) {
            const id = e.target.dataset.id;
            const name = e.target.dataset.name;
            const sks = e.target.dataset.credits;

            // Ambil elemen-elemen modal
            const modal = document.querySelector('#delete-confirmation-modal');
            const messageElement = document.querySelector('#delete-modal-message');
            const confirmBtn = document.querySelector('#confirm-delete-btn');
            const cancelBtn = document.querySelector('#cancel-delete-btn');

            // Isi pesan di modal dengan informasi mata kuliah
            messageElement.textContent = `Apakah Anda yakin ingin menghapus mata kuliah "${name}" (${sks} SKS)? Data yang dihapus tidak dapat dikembalikan.`;
        
            // Tampilkan modal
            modal.style.display = 'block';

            // Fungsi untuk menangani penghapusan
            const handleDelete = () => {
                // Hapus data dari array JavaScript
                courses = courses.filter(course => course.course_id != id);
                // Render ulang tabel
                renderCourses();
                // Sembunyikan modal
                modal.style.display = 'none';
                // PENTING: Hapus event listener agar tidak menumpuk
                confirmBtn.removeEventListener('click', handleDelete);
            };

            // Tambahkan event listener ke tombol konfirmasi
            confirmBtn.addEventListener('click', handleDelete);

            // Tambahkan event listener ke tombol batal
            cancelBtn.addEventListener('click', () => {
                modal.style.display = 'none';
                // PENTING: Hapus event listener agar tidak menumpuk
                confirmBtn.removeEventListener('click', handleDelete);
            });
        }
    });

    // 4. Tangani submit form (untuk Tambah dan Ubah data)
    courseForm.addEventListener('submit', (e) => {
        e.preventDefault(); // Mencegah refresh

        // Ambil input
        const id = document.querySelector("#course_id").value;
        const nameInput = document.querySelector("#course_name");
        const creditsInput = document.querySelector("#credits");
        const name = nameInput.value.trim();
        const credits = creditsInput.value.trim();

        // Reset error
        document.querySelector("#name-error").textContent = '';
        document.querySelector("#credits-error").textContent = '';
        nameInput.classList.remove('is-invalid');
        creditsInput.classList.remove('is-invalid');

        let isValid = true;

        // Validasi Nama MK
        if (!name) {
            document.querySelector("#name-error").textContent = "Nama mata kuliah wajib diisi.";
            nameInput.classList.add("is-invalid");
            isValid = false;
        }

        // Validasi SKS
        if (!credits || parseInt(credits) <= 0) {
            document.querySelector("#credits-error").textContent = "SKS harus diisi dan lebih dari 0.";
            creditsInput.classList.add("is-invalid");
            isValid = false;
        }

        // Jika tidak valid, hentikan proses
        if (!isValid) return;

        // Jika valid, simpan data ke array
        if (id) {
            // Mode Edit
            const index = courses.findIndex(course => course.course_id == id);
            courses[index] = { course_id: id, course_name: name, credits: credits };
        } else {
            // Mode Tambah
            const newId = courses.length > 0 ? Math.max(...courses.map(c => c.course_id)) + 1 : 1;
            courses.push({ course_id: newId, course_name: name, credits: credits });
        }

        // Tutup form, reset, render ulang tabel
        courseFormContainer.style.display = 'none';
        renderCourses();
        courseForm.reset();
    });

    // --- PANGGIL FUNGSI RENDER PERTAMA KALI ---
    renderCourses();
}

// Blok untuk halaman Ambil Mata Kuliah (Mahasiswa)
if (document.querySelector("#course-checklist")) {

    // Ambil data dari variabel global yang dibuat oleh view take_courses.php
    const allCourses = initialCoursesForEnroll;
    // Ambil daftar ID yang sudah di-enroll
    const enrolledIds = enrolledCourseIds;
    // --- Filter mata kuliah yang belum diambil ---
    const availableCourses = allCourses.filter(course => {
        // Kembalikan hanya course yang course_id-nya TIDAK ADA di dalam array enrolledIds
        return !enrolledIds.includes(course.course_id.toString());
    });


    // --- Selektor Elemen ---
    const checklistContainer = document.querySelector("#course-checklist");
    const totalSksElement = document.querySelector("#total-sks");
    const enrollForm = document.querySelector("#enroll-form");

    // --- Fungsi untuk Merender Checklist ---
    function renderCourseChecklist() {
        // Tampilkan HANYA mata kuliah yang tersedia (availableCourses)
        availableCourses.forEach(course => {
            const div = document.createElement("div");
            div.innerHTML = `
                <input class="course-check" type="checkbox" value="${course.course_id}" id="course-${course.course_id}" data-sks="${course.credits}">
                <label for="course-${course.course_id}">
                    ${course.course_name} (${course.credits} SKS)
                </label>
            `;
            checklistContainer.appendChild(div);
        });
    }

    // --- Fungsi untuk Menghitung Total SKS ---
    function updateTotalSks() {
        let totalSks = 0;
        const checkedCourses = document.querySelectorAll('.course-check:checked');
        
        checkedCourses.forEach(checkbox => {
            // Ambil nilai SKS dari data-sks atribut
            totalSks += parseInt(checkbox.dataset.sks);
        });
        
        totalSksElement.textContent = totalSks;
    }

    // --- Event Listeners ---

    // 1. Tambahkan event listener ke container untuk menghitung SKS setiap kali ada perubahan
    checklistContainer.addEventListener('change', updateTotalSks);

    // 2. Tambahkan event listener untuk submit form
    enrollForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const checkedCourses = document.querySelectorAll('.course-check:checked');
        
        if (checkedCourses.length === 0) {
            alert('Anda belum memilih mata kuliah sama sekali.');
            return;
        }

        const enrolledCourseIds = [];
        checkedCourses.forEach(checkbox => {
            enrolledCourseIds.push(checkbox.value);
        });

        // --- INI BAGIAN YANG DIPERBARUI ---
        
        // 1. Ambil nama dan hash token dari meta tag
        const csrfTokenName = document.querySelector('meta[name="csrf-token-name"]').getAttribute('content');
        const csrfTokenHash = document.querySelector('meta[name="csrf-token-hash"]').getAttribute('content');

        // 2. Siapkan data yang akan dikirim, termasuk token CSRF
        const postData = {
            course_ids: enrolledCourseIds,
            [csrfTokenName]: csrfTokenHash // Ini akan menjadi -> 'csrf_test_name': 'hash_acak...'
        };

        // 3. Kirim data menggunakan Fetch
        fetch(`${BASE_URL}/courses/enroll`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify(postData) // Kirim objek gabungan
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert(data.message);
                
                // Refresh token CSRF di halaman agar bisa submit lagi nanti
                document.querySelector('meta[name="csrf-token-hash"]').setAttribute('content', data.csrf_hash_baru);

                // Hapus course yang berhasil di-enroll dari tampilan
                checkedCourses.forEach(checkbox => {
                    checkbox.parentElement.remove();
                });
                updateTotalSks();

            } else {
                alert('Terjadi kesalahan: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Tidak dapat terhubung ke server. Periksa console untuk detail.');
        });
    });

    // --- Panggil Render Pertama Kali ---
    renderCourseChecklist();
}

if (document.querySelector("#my-courses-list")) {

    const myCourses = initialMyCourses;
    const myCoursesTableBody = document.querySelector("#my-courses-list");

    function renderMyCourses() {
        myCoursesTableBody.innerHTML = ""; // Kosongkan tabel

        if (myCourses.length === 0) {
            myCoursesTableBody.innerHTML = '<tr><td colspan="2" style="text-align:center;">Anda belum mengambil mata kuliah apapun.</td></tr>';
            return;
        }

        myCourses.forEach(course => {
            const row = document.createElement("tr");
            row.innerHTML = `
                <td>${course.course_name}</td>
                <td>${course.credits}</td>
            `;
            myCoursesTableBody.appendChild(row);
        });
    }

    // Panggil fungsi render saat halaman dimuat
    renderMyCourses();
}

// Cek jika kita berada di halaman manajemen mahasiswa
if (document.querySelector("#student-list-body")) {

    // Ambil data awal dari variabel yang di-passing PHP dari view
    let students = initialStudents;

    // --- Selektor Elemen ---
    const studentTableBody = document.querySelector("#student-list-body");
    const showFormBtn = document.querySelector("#show-add-student-form-btn");
    const studentFormContainer = document.querySelector("#student-form-container");
    const studentForm = document.querySelector("#student-form");
    const cancelBtn = document.querySelector("#cancel-student-btn");
    const formTitle = document.querySelector("#student-form-title");

    // --- Fungsi untuk Merender Tabel Mahasiswa ---
    function renderStudents() {
        studentTableBody.innerHTML = ""; // Selalu kosongkan tabel sebelum diisi ulang
        students.forEach(mhs => {
            const row = document.createElement("tr");
            row.innerHTML = `
                <td>${mhs.nim}</td>
                <td>${mhs.nama}</td>
                <td>${mhs.entry_year}</td>
                <td>
                    <button class="edit-student-btn" data-id="${mhs.student_id}" data-nim="${mhs.nim}" data-nama="${mhs.nama}" data-entry_year="${mhs.entry_year}">Edit</button>
                    <button class="delete-student-btn" data-id="${mhs.student_id}" data-nama="${mhs.nama}">Hapus</button>
                </td>
            `;
            studentTableBody.appendChild(row);
        });
    }

    // --- Event Listeners ---

    // Tampilkan form tambah
    showFormBtn.addEventListener('click', () => {
        formTitle.textContent = "Form Tambah Mahasiswa";
        studentForm.reset();
        document.querySelector("#student_id").value = ''; // Pastikan ID kosong
        studentFormContainer.style.display = 'block';
    });

    // Sembunyikan form
    cancelBtn.addEventListener('click', () => {
        studentFormContainer.style.display = 'none';
    });

    // Aksi untuk tombol Edit dan Hapus
    studentTableBody.addEventListener('click', (e) => {
        // Aksi Edit
        if (e.target.classList.contains('edit-student-btn')) {
            const { id, nim, nama, entry_year } = e.target.dataset;
            formTitle.textContent = "Form Ubah Mahasiswa";
            document.querySelector("#student_id").value = id;
            document.querySelector("#nim").value = nim;
            document.querySelector("#nama").value = nama;
            document.querySelector("#entry_year").value = entry_year;
            studentFormContainer.style.display = 'block';
        }

        // Aksi Hapus
        if (e.target.classList.contains('delete-student-btn')) {
            const id = e.target.dataset.id;
            const nama = e.target.dataset.nama;

            const modal = document.querySelector('#delete-confirmation-modal');
            const messageElement = document.querySelector('#delete-modal-message');
            const confirmBtn = document.querySelector('#confirm-delete-btn');
            const cancelBtn = document.querySelector('#cancel-delete-btn');

            messageElement.textContent = `Apakah Anda yakin ingin menghapus mahasiswa "${nama}"?`;
            modal.style.display = 'block';

            const handleDelete = () => {
                students = students.filter(mhs => mhs.student_id != id);
                renderStudents();
                modal.style.display = 'none';
                confirmBtn.removeEventListener('click', handleDelete);
            };

            confirmBtn.addEventListener('click', handleDelete);
            cancelBtn.addEventListener('click', () => {
                modal.style.display = 'none';
                confirmBtn.removeEventListener('click', handleDelete);
            });
        }
    });

    // Aksi saat form di-submit
    studentForm.addEventListener('submit', (e) => {
        e.preventDefault();

        // Ambil input
        const id = document.querySelector("#student_id").value;
        const nimInput = document.querySelector("#nim");
        const namaInput = document.querySelector("#nama");
        const entryYearInput = document.querySelector("#entry_year");

        // Ambil semua elemen <small> di form
        const errorMessages = studentForm.querySelectorAll('.error-message');
        errorMessages.forEach(msg => msg.textContent = ''); // reset semua pesan error

        // Reset class is-invalid
        nimInput.classList.remove("is-invalid");
        namaInput.classList.remove("is-invalid");
        entryYearInput.classList.remove("is-invalid");

        let isValid = true;

        // Validasi NIM
        if (nimInput.value.trim() === '') {
            nimInput.nextElementSibling.textContent = 'NIM tidak boleh kosong.';
            nimInput.classList.add("is-invalid");
            isValid = false;
        }

        // Validasi Nama
        if (namaInput.value.trim() === '') {
            namaInput.nextElementSibling.textContent = 'Nama tidak boleh kosong.';
            namaInput.classList.add("is-invalid");
            isValid = false;
        }

        // Validasi Tahun Masuk
        if (entryYearInput.value.trim() === '' || entryYearInput.value <= 0) {
            entryYearInput.nextElementSibling.textContent = 'Tahun masuk harus diisi dan > 0.';
            entryYearInput.classList.add("is-invalid");
            isValid = false;
        }

        // Jika ada error, hentikan submit
        if (!isValid) return;

        // Jika valid, lanjut proses simpan
        const nim = nimInput.value.trim();
        const nama = namaInput.value.trim();
        const entry_year = entryYearInput.value.trim();

        if (id) { // Mode Edit
            const index = students.findIndex(mhs => mhs.student_id == id);
            students[index] = { student_id: id, nim, nama, entry_year };
        } else { // Mode Tambah
            const newId = students.length > 0 ? Math.max(...students.map(mhs => parseInt(mhs.student_id))) + 1 : 1;
            students.push({ student_id: newId, nim, nama, entry_year });
        }

        studentFormContainer.style.display = 'none';
        renderStudents();
        studentForm.reset();
    });

    // Panggil render pertama kali saat halaman dimuat
    renderStudents();
}

// --- CONTOH SYNC vs ASYNC ---
console.log("1. Ini pesan pertama (sync)");

// Jalankan asynchronous dengan delay 2 detik
setTimeout(() => {
    console.log("2. Ini pesan dari setTimeout (async, muncul setelah 2 detik)");
}, 2000);

console.log("3. Ini pesan terakhir (sync)");