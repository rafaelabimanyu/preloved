<div align="center">

# 🏷️ preloved.g00ds

**A curated secondhand fashion archive — where every garment carries a story.**

[![Laravel](https://img.shields.io/badge/Laravel-13.x-FF2D20?style=flat-square&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.3-777BB4?style=flat-square&logo=php&logoColor=white)](https://php.net)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-4.x-38B2AC?style=flat-square&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![Vite](https://img.shields.io/badge/Vite-8.x-646CFF?style=flat-square&logo=vite&logoColor=white)](https://vite.dev)
[![License](https://img.shields.io/badge/License-MIT-black?style=flat-square)](LICENSE)

*Japanese-themed · Vintage Aesthetic · Modern Urban*

</div>

---

## 📖 Project Overview

**preloved.g00ds** adalah platform fashion editorial yang mengkurasi pakaian secondhand pilihan dengan pendekatan yang melampaui sekadar jual-beli. Terinspirasi dari estetika Jepang yang tenang, sentuhan vintage yang kaya karakter, dan urban style yang kontemporer — preloved.g00ds hadir sebagai *fashion archive*, bukan toko biasa.

Setiap item dipilih dengan kurasi yang ketat. Setiap drop dirancang seperti koleksi. Setiap lookbook bercerita.

> *"We don't sell clothes. We pass on legacies."*

Platform ini dibangun untuk para pencinta fashion yang memahami bahwa nilai sebuah pakaian bukan terletak pada harganya, melainkan pada cerita yang dibawanya.

---

## 🛠️ Tech Stack

| Layer | Teknologi | Versi |
|---|---|---|
| **Backend Framework** | [Laravel](https://laravel.com) | `^13.0` |
| **Language** | PHP | `^8.3` |
| **Frontend Styling** | [Tailwind CSS](https://tailwindcss.com) | `^4.0` |
| **Build Tool** | [Vite](https://vite.dev) | `^8.0` |
| **Database** | SQLite | — |
| **HTTP Client** | Axios | `^1.15` |
| **Templating** | Laravel Blade | — |
| **Dev Tools** | Laravel Pint, Pail, Pao | — |

---

## ✨ Features

### 🌐 Public-Facing

| Fitur | Deskripsi |
|---|---|
| **Home** | Landing page editorial dengan hero section dan highlight drop terbaru |
| **Catalog** | Halaman katalog produk dengan filter & pencarian item |
| **Item Detail** | Halaman detail item dengan galeri gambar, deskripsi, dan tag |
| **Drops** | Sesi rilis terbatas dengan tampilan koleksi terkurasi |
| **Lookbook** | Galeri editorial yang menampilkan styling dan visual storytelling |
| **About** | Halaman brand story dan filosofi preloved.g00ds |
| **Care Guide** | Panduan perawatan pakaian vintage |
| **Contact / Inquiry** | Form kontak untuk pertanyaan dan pemesanan |
| **Language Switcher** | Dukungan multi-bahasa **English 🇬🇧 / Indonesia 🇮🇩** (session-based, tanpa prefix URL) |

### 🔐 Admin — Curation Studio

Diproteksi middleware `auth` + `is_admin`.

| Modul | Akses |
|---|---|
| **Dashboard** | Ringkasan statistik platform |
| **Items CRUD** | Tambah, edit, hapus item dengan upload gambar (AJAX) |
| **Drops CRUD** | Kelola sesi drop / koleksi terbatas |
| **Lookbooks CRUD** | Kelola sesi editorial & galeri lookbook |
| **Inquiries** | Tampilkan & tandai pesan masuk dari pengunjung |
| **Settings** | Konfigurasi global platform |
| **Image Upload** | AJAX uploader helper untuk form item & lookbook |

---

## 🗄️ Database Schema

Database menggunakan **SQLite** (default). Skema utama:

```
users               — Akun admin & pengguna
items               — Data item fashion (nama, harga, kondisi, dst.)
item_images         — Galeri foto per item (relasi one-to-many)
item_tag            — Pivot table item ↔ tag
tags                — Label / kategori item
drops               — Sesi drop / koleksi rilis terbatas
lookbooks           — Sesi editorial lookbook
lookbook_images     — Foto per sesi lookbook
inquiries           — Pesan masuk dari form kontak
settings            — Konfigurasi platform (key-value)
cache               — Cache driver (database)
jobs                — Queue job driver
```

---

## 🚀 Installation Guide

### Prerequisites

Pastikan environment lokal Anda memiliki:

- PHP `>= 8.3`
- Composer
- Node.js `>= 18.x` & npm
- Git

---

### 1. Clone Repository

```bash
git clone https://github.com/rafaelabimanyu/preloved.git
cd preloved
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Setup Environment

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Setup Database

Database menggunakan SQLite — tidak perlu konfigurasi server.

```bash
touch database/database.sqlite
php artisan migrate
```

> Opsional: Jalankan seeder jika tersedia.
> ```bash
> php artisan db:seed
> ```

### 5. Install Node Dependencies & Build Assets

```bash
npm install
npm run build
```

### 6. Jalankan Server Lokal

```bash
php artisan serve
```

Akses aplikasi di: **[http://localhost:8000](http://localhost:8000)**

---

### ⚡ One-Command Setup (Alternatif)

```bash
composer run setup
```

Script ini otomatis menjalankan: `composer install` → copy `.env` → `key:generate` → `migrate` → `npm install` → `npm run build`.

---

### 🔧 Development Mode (Hot Reload)

Untuk pengembangan dengan Vite HMR, jalankan dua terminal secara bersamaan:

```bash
# Terminal 1
php artisan serve

# Terminal 2
npm run dev
```

Atau gunakan shortcut Composer:

```bash
composer run dev
```

---

### 🔑 Admin Access

Setelah migrasi, buat akun admin melalui Tinker:

```bash
php artisan tinker
```

```php
\App\Models\User::create([
    'name'     => 'Admin',
    'email'    => 'admin@preloved.g00ds',
    'password' => bcrypt('your-password'),
    'is_admin' => true,
]);
```

Akses Admin Panel: **[http://localhost:8000/login](http://localhost:8000/login)**

---

## 📂 Folder Structure

```
preloved/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/              # Controller admin (auth-protected)
│   │   │   │   ├── AuthController.php
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── ItemController.php
│   │   │   │   ├── DropController.php
│   │   │   │   ├── LookbookController.php
│   │   │   │   ├── InquiryController.php
│   │   │   │   ├── SettingController.php
│   │   │   │   └── UploadController.php
│   │   │   ├── CatalogController.php
│   │   │   ├── DropController.php
│   │   │   ├── HomeController.php
│   │   │   ├── ItemController.php
│   │   │   ├── LanguageController.php
│   │   │   ├── LookbookController.php
│   │   │   └── PageController.php
│   │   └── Middleware/
│   └── Models/                     # Eloquent models
│       ├── Drop.php
│       ├── Item.php
│       ├── ItemImage.php
│       ├── Lookbook.php
│       ├── LookbookImage.php
│       ├── Inquiry.php
│       ├── Setting.php
│       ├── Tag.php
│       └── User.php
├── database/
│   ├── migrations/                 # Skema tabel database
│   ├── factories/
│   └── seeders/
├── lang/
│   ├── en/                         # Terjemahan Bahasa Inggris
│   └── id/                         # Terjemahan Bahasa Indonesia
├── resources/
│   ├── css/
│   │   └── admin.css               # Stylesheet khusus admin panel
│   ├── js/
│   │   └── app.js                  # Entry point JavaScript
│   └── views/
│       ├── admin/                  # Blade views admin (dashboard, CRUD)
│       ├── catalog/                # Halaman katalog publik
│       ├── components/             # Komponen reusable (nav, footer, dll.)
│       ├── drops/                  # Halaman drop / koleksi
│       ├── home/                   # Halaman utama
│       ├── items/                  # Detail item
│       ├── layouts/                # Layout utama & admin
│       ├── lookbook/               # Galeri lookbook editorial
│       └── pages/                  # Halaman statis (About, Care, Contact)
├── routes/
│   └── web.php                     # Definisi semua route aplikasi
├── public/                         # File publik & asset hasil build
├── storage/                        # File upload, log, cache
├── .env.example                    # Template konfigurasi environment
├── composer.json
├── package.json
└── vite.config.js
```

---

## 🌍 Multi-Language Support

Platform mendukung dua bahasa secara penuh:

| Bahasa | Kode | Status |
|---|---|---|
| English | `en` | ✅ Aktif |
| Bahasa Indonesia | `id` | ✅ Aktif |

Lokasi file terjemahan: `lang/en/` dan `lang/id/`

Locale disimpan di **session** — tidak ada prefix URL. Pengunjung dapat beralih bahasa kapan saja melalui language switcher di navigasi.

```
Route: GET /language/{en|id}
```

---

## 🤝 Contributing

Kontribusi sangat diterima! preloved.g00ds adalah proyek yang terus berkembang.

### Alur Kontribusi

```bash
# 1. Fork repositori ini
# 2. Buat branch baru
git checkout -b feature/nama-fitur-kamu

# 3. Commit perubahan dengan pesan yang jelas
git commit -m "feat: tambahkan fitur X"

# 4. Push ke branch kamu
git push origin feature/nama-fitur-kamu

# 5. Buat Pull Request ke branch `main`
```

### Panduan Commit Message

Gunakan format [Conventional Commits](https://www.conventionalcommits.org/):

| Prefix | Digunakan untuk |
|---|---|
| `feat:` | Fitur baru |
| `fix:` | Perbaikan bug |
| `style:` | Perubahan UI / styling |
| `refactor:` | Refactor kode (bukan fitur / fix) |
| `docs:` | Perubahan dokumentasi |
| `chore:` | Maintenance & konfigurasi |

### Code Style

Proyek ini menggunakan **Laravel Pint** untuk formatting PHP:

```bash
./vendor/bin/pint
```

---

## 📜 License

Proyek ini dilisensikan di bawah **[MIT License](LICENSE)**.

```
Copyright (c) 2026 rafaelabimanyu

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software...
```

---

## 👤 Author

**Rafael Abimanyu**
- GitHub: [@rafaelabimanyu](https://github.com/rafaelabimanyu)
- Project: [preloved.g00ds](https://github.com/rafaelabimanyu/preloved)

---

<div align="center">

*Crafted with intention. Curated with love.*

**preloved.g00ds** — *Every piece has a past. Give it a future.*

</div>
