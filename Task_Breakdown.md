ANTIGRAVITY EXECUTION MANIFEST: AUTO-STITCH OS
Target Stack: Laravel, Tailwind CSS, Alpine.js, MySQL, Cloudinary.
Design Philosophy: Anti-Generic AI UI, Organic Micro-interactions, Accessibility-First.

MILESTONE 1: CORE INFRASTRUCTURE & SAFETY LAYER
Komando Eksekusi: Antigravity, lakukan inisialisasi project dan perketat guardrails keamanan sesuai spesifikasi di bawah.

Task 1.1: Project Scaffolding & Asset Pipeline

Instruksi: Setup Laravel 11, konfigurasi Vite, jalankan inisialisasi Tailwind CSS dan Alpine.js. Pastikan file konfigurasi @postcss.config.js dan @eslint.config.js terpasang dengan benar untuk menjaga standardisasi kode.

Checkpoint: Server lokal berjalan, npm run dev mengompilasi aset tanpa warning.

Task 1.2: RBAC Middleware (Vulnerability Prevention)

Instruksi: Jalankan skill @auth-implementation-patterns. Buat tabel users dengan kolom role (admin, technician). Bangun custom middleware CheckRole untuk mengisolasi dashboard administrasi harga material.

Checkpoint: User dengan role technician dialihkan otomatis (HTTP 403) saat mencoba menembus URL /admin/pricelist.

Task 1.3: Public Endpoint Throttle (Anti-Brute Force)

Instruksi: Jalankan skill @api-design-principles. Konfigurasikan Rate Limiting pada rute pencarian plat nomor (/tracker/search) menggunakan Laravel's Rate Limiter.

Checkpoint: Request ke-6 dalam kurun waktu 1 menit dari IP yang sama otomatis diblokir dengan kode HTTP 429.

MILESTONE 2: DATABASE ARCHITECTURE & NORMALIZATION ENGINE
Komando Eksekusi: Antigravity, bangun skema data operasional dan kunci logika bisnis pada layer backend.

Task 2.1: Relational Schema Deployment

Instruksi: Jalankan skill @architecture-patterns. Generate migrasi untuk tabel settings_pricelist, leads, dan work_orders sesuai dengan skema utama pada Blueprint_AUTO-STITCH_OS.md. Pasang database index pada kolom normalized_plat untuk optimalisasi query pencarian.

Checkpoint: Struktur tabel ter-buat secara presisi melalui php artisan migrate.

Task 2.2: String Normalizer Helper & Capacity Logic

Instruksi: Buat Service Class StitchFlowManager. Implementasikan fungsi Regex untuk pembersihan plat nomor (menghapus spasi, mengubah ke huruf kapital). Tulis logika kalkulasi Work Units harian untuk mendeteksi overbooking.

Checkpoint: Unit test membuktikan string "b  8888  xZ" berhasil dinormalisasi menjadi "B8888XZ".

Task 2.3: Cache Layer for Dynamic Pricelist

Instruksi: Jalankan skill @application-performance-performance-optimization. Bungkus query matriks harga settings_pricelist menggunakan Laravel Cache Memory. Pasang model event hooks (saved, deleted) agar cache otomatis hancur (flush) ketika admin mengubah komponen harga.

Checkpoint: Database log menunjukkan angka 0 queries hit pada tabel pricelist saat halaman di-refresh berulang kali.

MILESTONE 3: HIGH-FIDELITY MOBILE INTERFACE & PREMIUM ANIMATION
Komando Eksekusi: Antigravity, buat komponen UI interaktif. Buat animasi terasa organik dan hidup menggunakan transisi berbasis statik, hindari kesan UI generik templat AI.

Task 3.1: Organic Odometer Smart Calculator

Instruksi: Jalankan skill @accessibility-compliance-accessibility-audit. Desain form kalkulator dengan tombol opsi bermaterial tebal, berukuran minimal 44x44px. Gunakan Alpine.js untuk membuat efek angka harga bergulir (odometer/counter animation) saat material diubah.

Animation Specs: Tambahkan interaksi mikro berupa efek membal (elastic spring pop) pada tombol pilihan menggunakan Tailwind utility: active:scale-95 transition-transform duration-150.

Checkpoint: Elemen UI lolos uji klik di perangkat mobile tanpa risiko salah tekan (fat-finger).

Task 3.2: Liquid Public Tracker & Skeleton Loading

Instruksi: Desain halaman pelacakan progres publik. Ketika pencarian dikirim, munculkan animasi Skeleton Loader yang memudar halus (animate-pulse). Progress bar wajib menggunakan efek pengisian cairan bergerak (liquid filling gauge) berbasis Tailwind transisi.

Animation Specs: Gunakan interpolasi percepatan kustom untuk pergerakan bar: transition-all duration-1000 ease-[cubic-bezier(0.34,1.56,0.64,1)] (efek akselerasi melesat lalu mengerem membal di ujung, meniru perilaku Framer Motion).

Checkpoint: Status progres bergerak lincah dan elegan saat diuji di browser mobile.

Task 3.3: Image Showcase Observer

Instruksi: Jalankan skill @application-performance-performance-optimization. Hubungkan galeri portofolio interior dengan Cloudinary untuk transformasi WebP otomatis. Gunakan Intersection Observer via Alpine.js untuk memicu animasi fade-in-up yang asimetris (berjeda antar gambar) saat user melakukan scrolling.

Checkpoint: Gambar dimuat secara malas (lazy-loaded) dan muncul dengan transisi premium saat masuk ke dalam viewport.

MILESTONE 4: WA PIPELINE & PRODUCTION DEPLOYMENT
Komando Eksekusi: Antigravity, selesaikan integrasi pipa data dan siapkan konfigurasi peluncuran produksi.

Task 4.1: Lead Capture & WhatsApp Formatting Pipeline

Instruksi: Hubungkan form kalkulator ke tabel leads. Setelah data tersimpan, arahkan user menggunakan metode deep linking ke WhatsApp API. Teks pesan wajib diformat otomatis menggunakan kombinasi spasi, bullet points, dan penanda bold agar admin bengkel langsung mendapatkan data bersih.

Checkpoint: Klik pada tombol kalkulator memicu penyimpanan data di database lokal, dilanjutkan dengan terbukanya aplikasi WhatsApp secara instan dengan teks yang rapi.

Task 4.2: Production Hardening & VPS Setup

Instruksi: Jalankan skill @azd-deployment. Setup konfigurasi produksi, isolasi variabel sensitif di .env, jalankan optimasi berkas (php artisan config:cache, route:cache).

Checkpoint: Aplikasi berjalan penuh di bawah protokol HTTPS dengan penanganan eror tertutup (tidak membocorkan stack trace ke publik).