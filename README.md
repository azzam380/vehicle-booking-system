# Vehicle Booking & Monitoring System - Mining Corp

Aplikasi berbasis web untuk memonitoring kendaraan operasional perusahaan tambang, mencakup konsumsi BBM, jadwal layanan, dan sistem pemesanan kendaraan dengan persetujuan berjenjang (Multilevel Approval).

---

## 🛠 Spesifikasi Teknis

- **Framework:** Laravel 12.x
- **PHP Version:** 8.3+
- **Database:** MySQL / MariaDB
- **Autentikasi:** Laravel Breeze
- **Frontend:** Tailwind CSS & Chart.js (Grafik)
- **Export Tool:** Maatwebsite Excel

---

## 🚀 Fitur Utama

- **Dashboard Analytics:** Menampilkan grafik frekuensi pemakaian tiap kendaraan menggunakan Chart.js.
- **Multilevel Approval:** Proses persetujuan pemesanan minimal 2 level (Manager & Kepala Cabang).
- **Role Based Access Control:** Perbedaan tampilan antara Admin (Input) dan Approver (Persetujuan).
- **Activity Logs:** Pencatatan log sistem pada setiap proses pembuatan dan persetujuan pesanan.
- **Export Report:** Laporan pemesanan periodik yang dapat diunduh dalam format Excel.

---

## 🔑 Akun Demo

Gunakan akun berikut untuk menguji alur persetujuan berjenjang:

| Role           | Email                | Password     | Deskripsi                            |
| :------------- | :------------------- | :----------- | :----------------------------------- |
| **Admin Pool** | `admin@mail.com`     | `admin123`   | Input pesanan & pilih penyetuju.     |
| **Approver 1** | `approver1@mail.com` | `manager123` | Persetujuan Level 1 (Manager).       |
| **Approver 2** | `approver2@mail.com` | `kepala123`  | Persetujuan Level 2 (Kepala Cabang). |

---

## 💻 Panduan Instalasi

1. **Clone Repository**

    ```bash
    git clone <url-repository-anda>
    cd vehicle-booking-system

    ```

2. **Install Dependensi**
   composer install
   npm install && npm run build

3. **Konfigurasi Environment**
   Salin file .env.example menjadi .env.
   Buat database baru di MySQL dengan nama vehicle-booking-system.
   Sesuaikan konfigurasi DB_DATABASE, DB_USERNAME, dan DB_PASSWORD di file .env.

4. **Migrasi dan Seeder**
   php artisan migrate:fresh --seed --seeder=UserSeeder

================================================================================================

## 📊 Physical Data Model (Struktur Database)

Model ini menggambarkan hubungan antara pengguna, kendaraan, dan sistem pemesanan berjenjang.

### 1. Tabel: `users`

| Kolom      | Tipe Data        | Deskripsi                            |
| ---------- | ---------------- | ------------------------------------ |
| `id`       | BigInt (PK)      | ID unik pengguna.                    |
| `name`     | Varchar          | Nama lengkap pengguna.               |
| `email`    | Varchar (Unique) | Alamat email untuk login.            |
| `password` | Varchar          | Password terenkripsi.                |
| `role`     | Enum             | Role pengguna (`admin`, `approver`). |

### 2. Tabel: `vehicles`

| Kolom              | Tipe Data   | Deskripsi                           |
| ------------------ | ----------- | ----------------------------------- |
| `id`               | BigInt (PK) | ID unik kendaraan.                  |
| `name`             | Varchar     | Nama/Merk kendaraan.                |
| `type`             | Enum        | Jenis angkutan (`person`, `goods`). |
| `ownership`        | Enum        | Status milik (`company`, `rent`).   |
| `plate_number`     | Varchar     | Nomor plat kendaraan.               |
| `fuel_consumption` | Integer     | Konsumsi BBM (Liter).               |

### 3. Tabel: `bookings`

| Kolom           | Tipe Data   | Deskripsi                                  |
| --------------- | ----------- | ------------------------------------------ |
| `id`            | BigInt (PK) | ID unik pemesanan.                         |
| `user_id`       | BigInt (FK) | Admin yang menginput data.                 |
| `vehicle_id`    | BigInt (FK) | Kendaraan yang dipesan.                    |
| `driver_name`   | Varchar     | Nama driver yang bertugas.                 |
| `approver_1_id` | BigInt (FK) | Penyetuju Level 1 (Manager).               |
| `approver_2_id` | BigInt (FK) | Penyetuju Level 2 (Kepala Cabang).         |
| `status`        | Enum        | Status (`pending`, `level_1`, `approved`). |
| `booking_date`  | Date        | Tanggal pemakaian kendaraan.               |

---

## 🔄 Activity Diagram (Alur Kerja Sistem)

Berikut adalah urutan aktivitas dalam fitur pemesanan kendaraan:

1. **Mulai**: Admin login ke aplikasi.
2. **Input Data**: Admin mengisi form pemesanan (Kendaraan, Driver, Penyetuju 1, Penyetuju 2, dan Tanggal).
3. **Simpan & Log**: Sistem menyimpan data dengan status `pending` dan mencatat aktivitas ke Log aplikasi.
4. **Persetujuan Level 1**:

- Manager (Approver 1) login.
- Manager memeriksa daftar pesanan yang berstatus `pending`.
- Manager menekan tombol "Setujui".
- Sistem mengubah status menjadi `level_1` dan mencatat Log.

5. **Persetujuan Level 2**:

- Kepala Cabang (Approver 2) login.
- Kepala Cabang memeriksa daftar pesanan yang berstatus `level_1`.
- Kepala Cabang menekan tombol "Setujui Final".
- Sistem mengubah status menjadi `approved` dan mencatat Log.

6. **Selesai**: Pesanan divalidasi dan muncul dalam Laporan Excel serta Grafik Dashboard.

---

## 📝 Activity Log (Contoh Format Log)

Aplikasi mencatat setiap proses penting untuk kebutuhan audit perusahaan tambang:

- `[2026-01-30 09:00] INFO: Booking ID #10 created by Admin Pool.`
- `[2026-01-30 10:15] INFO: Booking ID #10 approved by Manager Operasional (Level 1).`
- `[2026-01-30 11:30] INFO: Booking ID #10 approved by Kepala Cabang (Final).`

---
