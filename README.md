
# JobFlow

<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="JobFlow Logo">
</p>

<p align="center">
  <a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

---

## 📘 Tentang JobFlow

**JobFlow** adalah aplikasi manajemen lowongan kerja dan proses rekrutmen yang dibangun dengan Laravel. Aplikasi ini membantu pengguna dalam mengelola lowongan, melacak lamaran, dan mengatur tugas-tugas rekrutmen secara efisien.

---

## 🎯 Tujuan dan Manfaat

### 🎯 Motivasi
- Menyederhanakan proses rekrutmen dan pengelolaan lowongan kerja.
- Mengatasi tantangan dalam pelacakan status lamaran dan tugas HR.

### ✅ Masalah yang Dipecahkan
- Sulitnya mengelola data lowongan dan pelamar secara terpusat.
- Kurangnya kontrol atas proses dan progres rekrutmen.

### 📚 Pembelajaran
- Menerapkan Laravel untuk pengembangan aplikasi web.
- Integrasi dengan **Tailwind CSS** dan **Alpine.js** untuk tampilan modern.
- Visualisasi data menggunakan **Chart.js**.

---

## 📂 Daftar Isi

- [Instalasi](#instalasi)
- [Penggunaan](#penggunaan)
- [Fitur](#fitur)
- [Kredit](#kredit)
- [Cara Berkontribusi](#cara-berkontribusi)
- [Tes](#tes)
- [Lisensi](#lisensi)

---

## ⚙️ Instalasi

1. Clone repository:
   ```bash
   git clone https://github.com/username/jobflow.git
   cd jobflow
   ```

2. Instal dependency:
   ```bash
   composer install
   ```

3. Salin file `.env`:
   ```bash
   cp .env.example .env
   ```

4. Atur konfigurasi database pada file `.env`

5. Jalankan migrasi:
   ```bash
   php artisan migrate
   ```

6. Jalankan server:
   ```bash
   php artisan serve
   ```

---

## 🚀 Penggunaan

Setelah proses instalasi, buka browser dan akses `http://localhost:8000`.

### Fitur Utama:
- **Dashboard**: Statistik lowongan, lamaran, dan tugas.
- **Manajemen Lowongan**: Tambah, edit, dan hapus lowongan.
- **Manajemen Lamaran**: Pantau status lamaran pelamar.
- **Manajemen Tugas**: Atur tugas terkait proses rekrutmen.

---

## ✨ Fitur

- ✅ **Dashboard** statistik rekrutmen
- ✅ **CRUD Lowongan** kerja
- ✅ **Pelacakan Lamaran** dan status pelamar
- ✅ **Manajemen Tugas** dengan deadline dan status
- ✅ **UI Modern dan Responsif** menggunakan Tailwind CSS
- ✅ **Visualisasi Data** dengan Chart.js

---

## 👨‍💻 Kredit

- Dibangun dengan [Laravel](https://laravel.com)
- UI: [Tailwind CSS](https://tailwindcss.com), [Alpine.js](https://alpinejs.dev)
- Visualisasi Data: [Chart.js](https://www.chartjs.org)

---

## 🤝 Cara Berkontribusi

1. Fork repositori ini.
2. Buat branch baru:
   ```bash
   git checkout -b fitur-baru
   ```
3. Commit perubahan:
   ```bash
   git commit -m "Menambahkan fitur baru"
   ```
4. Push ke branch Anda:
   ```bash
   git push origin fitur-baru
   ```
5. Buat Pull Request ke repositori utama.

---

## 🧪 Tes

Untuk menjalankan pengujian, gunakan perintah berikut:

```bash
php artisan test
```

---

## 📄 Lisensi

Aplikasi ini bersifat open-source dan dilisensikan di bawah [MIT License](https://opensource.org/licenses/MIT).
