# 🚀 MASTER BLUEPRINT: CUSTOM CAR SEAT E-COMMERCE

## 📑 PHASE 1: PRODUCT REQUIREMENT DOCUMENT (PRD)

**1. Product Vision**
Platform E-Commerce *Direct-to-Consumer* khusus penjualan Jok Mobil Komplit (*Plug-and-Play* / Beli Putus). Platform difokuskan pada konversi tinggi dengan meminimalisir gesekan (*friction*) dari pemilihan produk hingga pembayaran.

**2. Core Features Scope**
*   **Semi-Custom Catalog:** Menjual 2 model/desain utama jok racing. Kustomisasi dibatasi pada pemilihan Varian Mobil, Baris Jok, dan Warna (Primary & Secondary).
*   **Direct Checkout (No Cart):** Pembelian dilakukan per satu set (per baris mobil) dengan alur "Beli Langsung" tanpa sistem keranjang belanja.
*   **Guest Checkout System:** Pembeli tidak diwajibkan mendaftar akun. Pelacakan menggunakan Nomor WhatsApp dan ID Pesanan.
*   **Automated Cargo Shipping:** Terintegrasi API Logistik (RajaOngkir Kargo) dengan perhitungan berbasis Berat Volume (dipukul rata 25kg / baris).
*   **Automated Payment:** Terintegrasi API Payment Gateway (Midtrans/Xendit/Tripay) dengan konfirmasi Webhook otomatis.

---

## 🗺️ PHASE 2: USER FLOW & LOGIC MAPPING

**1. Discovery & Customization Flow**
*   User masuk ke Landing Page / Katalog -> Memilih Desain Jok (Model A/B).
*   Di Halaman Detail, User menggunakan *Dependent Dropdown* (Merk -> Model Mobil -> Baris).
*   User melihat gambar produk (didukung fitur *Image Zoom* untuk melihat detail jahitan).
*   User mengetik/memilih preferensi Warna.
*   User menekan tombol "Beli Sekarang".

**2. Direct Checkout Flow**
*   User dihadapkan pada satu halaman form: Nama, No WA, Alamat Lengkap.
*   Mengisi Kecamatan akan memicu *AJAX Asynchronous* ke API Logistik untuk memunculkan opsi Kargo & Harga.
*   Jika API Logistik *Timeout* (> 5 detik), munculkan *fallback*: "Hitung Ongkir Manual via WhatsApp".
*   Pilih Kurir -> Klik "Bayar Sekarang" -> *Redirect* ke halaman Payment Gateway.

**3. Post-Payment & Tracking Flow**
*   Setelah bayar, user diarahkan ke Halaman Pelacakan (Tracker URL unik).
*   **Status Order:** `Unpaid` -> `Paid` (Menunggu Produksi) -> `Shipped` (Dikirim).
*   **Aksi Tracker:**
    *   Tombol "Cek Status Pembayaran" (Manual Sync ke Payment API, *rate-limited* 1 klik/menit).
    *   Nomor Resi (AWB) ditampilkan sebagai *Hyperlink* langsung ke web pihak ketiga (Cekresi/Kurir) untuk memangkas *cost* pemanggilan API internal.

---

## 🏗️ PHASE 3: TECHNICAL BLUEPRINT & ARCHITECTURE

**1. Tech Stack**
*   **Backend:** Laravel 11
*   **Database:** SQLite
*   **Frontend:** Alpine.js (State/Reactivity), Tailwind CSS (Layout/Responsive), Inline CSS `oklch` (Warna & Theming).

**2. Database Schema (SQLite)**
*   `product_models` (id, name, base_price, description, image_path)
*   `car_variants` (id, brand, model_name, row_count, weight_kg, price_adjustment)
*   `orders` (id/UUID, invoice_number, product_model_id, car_variant_id, custom_colors, customer_name, customer_wa, shipping_address, courier_code, shipping_cost, grand_total, payment_status, production_status, shipping_awb, payment_url)

**3. Critical Architectural Rules (NON-NEGOTIABLE)**
*   **Concurrency Control:** Wajib mengaktifkan `PRAGMA journal_mode = WAL;` dan `DB_BUSY_TIMEOUT = 5000` di SQLite untuk mencegah error *Database is Locked* saat transaksi bersamaan (khususnya Webhook).
*   **Webhook Security:** Wajib menggunakan verifikasi *Signature Key / HMAC SHA256* pada header *request* dari Payment Gateway untuk mencegah *spoofing* status pembayaran.
*   **Data Pruning:** Wajib membuat Laravel Scheduler (berjalan *daily*) untuk menghapus data tabel `orders` dengan status `Expired` atau `Failed` yang umurnya di atas 30 hari.

---

## 🎨 PHASE 4: DESIGN SYSTEM & COMPONENT GUIDELINES

**1. Theming Strategy (Dark Cognac Artisan)**
*   Layout dan *Spacing* wajib menggunakan **Tailwind CSS**.
*   Injeksi Warna wajib menggunakan **Inline CSS Variables (OKLCH)** di root, tanpa memodifikasi *core* Tailwind color palette.
    *   `--bg-base`: `oklch(0.12 0.018 55)`
    *   `--bg-surface`: `oklch(0.18 0.015 55)`
    *   `--accent-cognac`: `oklch(0.67 0.13 66)`
    *   `--text-primary`: `oklch(0.95 0.01 55)`

**2. Component Standards (BEM Methodology inside Blade)**
*   Penamaan class khusus wajib menggunakan BEM (cth: `product-card__title`) untuk elemen di luar utilitas Tailwind.
*   **Touch Targets:** Semua `<button>`, `<input>`, `<select>` minimal memiliki tinggi `44px`.
*   **Images:** Wajib format `.webp` dengan `loading="lazy"` dan `aspect-ratio` yang ditetapkan secara eksplisit untuk mencegah *Cumulative Layout Shift (CLS)*.

---

## 🚀 PHASE 5: IMPLEMENTATION PLAN FOR ANTIGRAVITY

*(Instruksi untuk Agen: Lakukan eksekusi berurutan menggunakan prinsip Test-Driven Development (TDD) untuk semua fungsionalitas Backend).*

*   **[Tahap 1] Foundation Setup (`@laravel-expert`, `@architecture-patterns`):** 
    *   Inisialisasi Laravel 11 & Alpine.js.
    *   Konfigurasi `database.sqlite` (Aktifkan mode WAL & Timeout 5000ms).
    *   Setup Design Tokens (OKLCH) di Root CSS dan integrasi dasar Tailwind.
*   **[Tahap 2] Database & Domain Logic (`@database-design`, `@test-driven-development`):** 
    *   Buat Migration & Factory untuk `product_models`, `car_variants`, `orders`.
    *   Tulis Unit Test (PHPUnit/Pest) untuk logika kalkulasi harga (Base Price + Adjustment).
*   **[Tahap 3] External API Services (`@api-security-best-practices`, `@test-driven-development`):** 
    *   Buat Service Class untuk API Logistik (RajaOngkir). Implementasi *Timeout* 5 detik. Buat Mock Test untuk skenario API Down.
    *   Buat Service Class untuk API Payment Gateway.
*   **[Tahap 4] Frontend UX & Logic (`@alpinejs-patterns`, `@tailwind-patterns`):** 
    *   Bangun UI *Catalog*, *Dependent Dropdown* untuk pilihan mobil, dan *Image Zoom* (Alpine.js).
    *   Bangun Form Checkout (*Direct Checkout*) dengan *asynchronous shipping calculation*.
*   **[Tahap 5] Critical Path & Webhook (`@backend-security`, `@test-driven-development`):** 
    *   Buat Checkout Controller (Proses Form -> Hit Payment API -> Simpan Order -> Redirect).
    *   Buat Webhook Controller. Terapkan Middleware verifikasi *HMAC SHA256 Signature*. Tulis *Feature Test* untuk memvalidasi penolakan *Payload/Signature* palsu.
*   **[Tahap 6] Maintenance Automation (`@laravel-expert`):** 
    *   Buat Console Command untuk *Order Pruning* (Hapus order > 30 hari berstatus Expired). Daftarkan di Laravel Scheduler.