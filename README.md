# 21-MochAdira
## Nama : Moch Adira
## Judul Project : CarXRent
## Deskripsi Project : Aplikasi untuk menyewa mobil
## 🖼️ Preview

### ERD (Diagram Entitas Hubungan)

![ERD](https://github.com/adirasakhi/ukk-perpus-main-test/blob/master/erd.png?raw=true)

### Halaman Utama

![Preview-1](https://github.com/adirasakhi/21-MochAdira/blob/master/preview-1.png?raw=true)

### Halaman Daftar Mobil

![Preview-2](https://github.com/adirasakhi/21-MochAdira/blob/master/preview-2.png?raw=true)

### Halaman Show/Tampilan Mobil

![Preview-3](https://github.com/adirasakhi/21-MochAdira/blob/master/preview-3.png?raw=true)

### Halaman Rental User

![Preview-4](https://github.com/adirasakhi/21-MochAdira/blob/master/preview-4.png?raw=true)

### Halaman Dashboard Admin

![Preview-5](https://github.com/adirasakhi/21-MochAdira/blob/master/preview-5.png?raw=true)

### Halaman Data User Admin

![Preview-6](https://github.com/adirasakhi/21-MochAdira/blob/master/preview-6.png?raw=true)

### Halaman Data Mobil Admin

![Preview-7](https://github.com/adirasakhi/21-MochAdira/blob/master/preview-7.png?raw=true)

### Halaman Data Rental Admin

![Preview-8](https://github.com/adirasakhi/21-MochAdira/blob/master/preview-8.png?raw=true)

---

## 🎨 Konsep Desain

Sebuah platform perpustakaan digital yang memukau, menampilkan desain modern yang teratur. Halaman ini menonjolkan bagian utama dengan deskripsi layanan, ulasan, dan navigasi lokasi yang mudah digunakan.

## 🚀 Fitur Unggulan

- **Mazer Bootstrap Template**
  - Mode gelap dan terang
  - Dashboard UI

### Halaman Awal (Landing Page)

- Halaman Beranda
- Daftar Mobil
- Kategori Mobil

### Autentikasi

- Registrasi
- Login


#### Admin

- Kelola Users, Mobil, dan Kategori Mobil
- Lihat semua data

#### Penyewa

- Cari Mobil
- Lihat peminjaman Mobil mereka sendiri
- Registrasi sebagai peminjam


## 🛠️ Instalasi

### Persyaratan

- PHP 8.2.8 & Web Server (Apache, Lighttpd, atau Nginx) atau lebih
- Database (MariaDB v11.0.3 atau PostgreSQL)
- Web Browser (Firefox, Safari, Opera, dll)

### Langkah-langkah

1. **Klon Repositori**

    ```bash
    git clone https://github.com/adirasakhi/21-MochAdira.git
    cd 21-MochAdira
    composer install
    npm install
    cp .env.example .env
    ```

2. **Konfigurasi Database**

    ```conf
    APP_DEBUG=true
    DB_DATABASE=laravel
    DB_USERNAME=nama-pengguna-anda
    DB_PASSWORD=kata-sandi-anda
    ```

3. **Migrasi dan Symlink**

    ```bash
    php artisan key:generate
    php artisan storage:link
    php artisan migrate --seed
    ```

4. **Mulai Situs Web**

    ```bash
    npm run dev
    # Jalankan di terminal yang berbeda
    php artisan serve
    ```

4. **Setelah Memulai Web Sudah Ada Akun Yang Tersedia**
- **akun Admin**
Email = admin@example.com
password = password
- **akun Penyewa**
Email = penyewa@example.com
password = 12345678

perpus-v2 dibuat oleh [Adira](https://instagram.com/adrshki_/).
