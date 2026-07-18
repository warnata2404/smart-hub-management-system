# Smart Hub Management System

## Deskripsi

Smart Hub Management System adalah RESTful API yang dikembangkan menggunakan Laravel 13 untuk mengelola proses peminjaman peralatan (equipment borrowing management). Aplikasi ini menyediakan fitur autentikasi pengguna menggunakan Laravel Sanctum serta pengelolaan data peralatan, jadwal peminjaman, peminjaman, detail peminjaman, dan check-in.

---

## Fitur

- Autentikasi pengguna (Register, Login, Logout, Current User)
- Manajemen Equipment
- Manajemen Borrowing Schedule
- Manajemen Booking
- Manajemen Booking Item
- Manajemen Check-In
- Validasi Request menggunakan Form Request
- REST API menggunakan API Resource
- Authentication menggunakan Laravel Sanctum
- PostgreSQL Database

---

## Teknologi

- Laravel 13
- PHP 8.3
- PostgreSQL
- Laravel Sanctum
- Composer

---

## Persyaratan Sistem

- PHP 8.3 atau lebih baru
- Composer 2.x
- PostgreSQL
- Git

---

## Instalasi

### 1. Clone Repository

```bash
git clone <repository-url>
cd smart-hub-management-system
```

### 2. Install Dependency

```bash
composer install
```

### 3. Copy File Environment

```bash
cp .env.example .env
```

atau pada Windows:

```bash
copy .env.example .env
```

### 4. Konfigurasi Database

Sesuaikan konfigurasi database PostgreSQL pada file `.env`.

Contoh:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=smart_hub_management_system
DB_USERNAME=postgres
DB_PASSWORD=your_password
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Jalankan Migration

```bash
php artisan migrate
```

### 7. Buat Storage Link

```bash
php artisan storage:link
```

### 8. Jalankan Server

```bash
php artisan serve
```

Aplikasi dapat diakses melalui:

```
http://127.0.0.1:8000
```

---

## API Endpoint

### Authentication

| Method | Endpoint           |
| ------ | ------------------ |
| POST   | `/api/v1/register` |
| POST   | `/api/v1/login`    |
| POST   | `/api/v1/logout`   |
| GET    | `/api/v1/user`     |

### Equipment

| Method | Endpoint                  |
| ------ | ------------------------- |
| GET    | `/api/v1/equipments`      |
| POST   | `/api/v1/equipments`      |
| GET    | `/api/v1/equipments/{id}` |
| PUT    | `/api/v1/equipments/{id}` |
| DELETE | `/api/v1/equipments/{id}` |

### Borrowing Schedule

| Method | Endpoint                           |
| ------ | ---------------------------------- |
| GET    | `/api/v1/borrowing-schedules`      |
| POST   | `/api/v1/borrowing-schedules`      |
| GET    | `/api/v1/borrowing-schedules/{id}` |
| PUT    | `/api/v1/borrowing-schedules/{id}` |
| DELETE | `/api/v1/borrowing-schedules/{id}` |

### Booking

| Method | Endpoint                |
| ------ | ----------------------- |
| GET    | `/api/v1/bookings`      |
| POST   | `/api/v1/bookings`      |
| GET    | `/api/v1/bookings/{id}` |
| PUT    | `/api/v1/bookings/{id}` |
| DELETE | `/api/v1/bookings/{id}` |

### Booking Item

| Method | Endpoint                     |
| ------ | ---------------------------- |
| GET    | `/api/v1/booking-items`      |
| POST   | `/api/v1/booking-items`      |
| GET    | `/api/v1/booking-items/{id}` |
| PUT    | `/api/v1/booking-items/{id}` |
| DELETE | `/api/v1/booking-items/{id}` |

### Check-In

| Method | Endpoint                 |
| ------ | ------------------------ |
| GET    | `/api/v1/check-ins`      |
| POST   | `/api/v1/check-ins`      |
| GET    | `/api/v1/check-ins/{id}` |
| PUT    | `/api/v1/check-ins/{id}` |
| DELETE | `/api/v1/check-ins/{id}` |

---

## Pengujian

Backend telah melalui pengujian berikut:

- Pengujian Model menggunakan Laravel Tinker
- Pengujian Relationship Model
- Pengujian Foreign Key
- Pengujian Eager Loading
- Pengujian Authentication API
- Pengujian Equipment API
- Pengujian Validasi Request
- Pengujian Middleware Laravel Sanctum

Seluruh pengujian berhasil dilalui tanpa error.

---

## Struktur Project

```
app/
├── Http/
│   ├── Controllers/
│   ├── Requests/
│   └── Resources/
├── Models/
database/
routes/
public/
storage/
```

---

## Lisensi

Project ini dikembangkan sebagai tugas mata kuliah dan digunakan untuk keperluan akademik.
