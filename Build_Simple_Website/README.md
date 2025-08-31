# 📌 Dokumentasi Project

## 📂 Struktur Folder Project

### 1. `phpproject`
Folder ini berisi penugasan terkait **dasar pemrograman PHP** dan penerapannya dengan HTML, serta implementasi pola **Model, View, Controller (MVC)** sederhana.

---

### 2. `ci4-app`
Folder ini berisi penugasan yang menggunakan **Framework CodeIgniter 4 (CI4)**.  
Fokus utamanya adalah implementasi **MVC** dengan fitur Controller, Model, dan View di dalam CodeIgniter 4.

---

## ⚙️ Persiapan & Cara Menjalankan

### Untuk `phpproject`
1. Pastikan sudah mengaktifkan **XAMPP / Apache + MySQL**.
2. Simpan folder `phpproject` di dalam `htdocs`.
3. Akses melalui browser: http://localhost/phpproject/

### Untuk `ci4-app`
1. Pastikan sudah menginstal **Composer** dan **CodeIgniter 4**.
2. Simpan folder `ci4-app` di dalam direktori `htdocs` milik XAMPP, misalnya: C:\xampp\htdocs\ci4-app
3. Jalankan **Apache** dan **MySQL** melalui XAMPP Control Panel.
4. Akses project melalui browser dengan URL: http://localhost/ci4-app/public
   > Folder `public` wajib digunakan karena di situlah front controller (`index.php`) berada.
5. Jika ingin mengubah base URL agar tidak selalu menambahkan `/public`, bisa:
   - Pindahkan isi folder `public` ke root `ci4-app`, lalu sesuaikan path di `index.php`.
   - Atau atur **Virtual Host** di Apache agar langsung mengarah ke folder `public`.