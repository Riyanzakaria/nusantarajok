# BLUEPRINT: AUTO-STITCH OS
**Sistem Operasional & Company Profile Bengkel Modifikasi Interior (Jok Mobil & Bus)**

## 0. Ringkasan Eksekutif
AUTO-STITCH OS adalah platform interaktif yang mengubah website profil perusahaan pasif menjadi mesin operasional real-time. Fokus utama adalah transparansi bagi pelanggan (High-Trust Brand) dan efisiensi administratif bagi admin bengkel.

## 1. Arsitektur & Tumpukan Teknologi (Tech Stack)
*   **Backend Core:** Laravel 11 (Optimized Route & Config Cache)
*   **Frontend Reactive Layer:** Alpine.js v3.x (State management & micro-animations)
*   **Styling Engine:** Tailwind CSS v3.4+ (Custom cubic-bezier configuration)
*   **Database:** MySQL 8.0+ (InnoDB Engine)
*   **Asset Pipeline:** Cloudinary API (Real-time WebP Encoding & Dynamic Resizing)
*   **Target Deployment:** Paid Linux VPS / Shared Hosting dengan akses SSH & Cron Jobs

## 2. Keamanan & Pembatasan Hak Akses (Security Guardrails)
Sistem mengadopsi standar zero-trust pada endpoint publik dan isolasi ketat pada layer administrasi internal:
*   **Role-Based Access Control (RBAC):** Pemisahan hak akses menggunakan middleware Laravel antara `admin` (kontrol penuh harga) dan `technician` (hanya update status produksi).
    *   *Skill Library:* `@auth-implementation-patterns`
*   **Anonymized Public Tracker:** Konsumen melacak progres kendaraan hanya menggunakan nomor plat. Sistem hanya mengembalikan data status produksi dan tipe kendaraan. Informasi nama, nomor telepon, dan nominal uang diisolasi sepenuhnya dari sisi publik.
*   **Anti-Brute Force Layer:** Endpoint publik dilindungi oleh rate limiting ketat untuk mencegah scraping atau serangan brute force pencarian nomor plat.
    *   *Skill Library:* `@api-design-principles`

## 3. Fitur Utama & Logika Bisnis

### A. The Public Engine (Lead Generation)
* **Smart Calculator:**
    * *Dynamic Pricelist:* Admin dapat mengubah harga material/jasa di dashboard tanpa koding.
* **Lead-to-WA Pipeline:** Data kalkulasi disimpan ke tabel `leads` sebelum diarahkan ke WhatsApp untuk mencegah kehilangan data prospek.

### B. The STITCH-FLOW Engine (Operational Core)
* **Capacity & Scheduling:**
    * Sistem menghitung kapasitas harian (Work Units).
    * Logika *Overbooking*: Jika kapasitas hari ini penuh, sistem otomatis menyarankan `earliest_start_date` berikutnya.
* **Anonymized Public Tracker:**
    * Pelanggan melacak progres hanya menggunakan Nomor Plat.
    * Keamanan: Hanya menampilkan jenis kendaraan dan status (Progress Bar), bukan data pribadi/harga.
* **String Normalization:** Menggunakan regex untuk membersihkan input plat nomor (menghilangkan spasi/karakter khusus) agar hasil pencarian akurat.

### C. The Authenticity Vault (Expansion)
* **Digital Warranty:** Database riwayat pengerjaan yang dapat diakses pelanggan untuk mengunduh sertifikat garansi digital.

## 4. Strategi UX (Mobile-Friendly 40+)
* **Fat-Finger Design:** Tombol minimal 44x44px.
* **High Contrast:** Teks gelap di latar terang, font minimal 16px.
* **Visual Status:** Penggunaan indikator warna (Merah/Kuning/Hijau) untuk status pengerjaan.
*Efek:* Tombol akan terasa kenyal, amblas ke dalam saat ditekan, dan membal kembali ke ukuran semula saat dilepas.
*   **Odometer Digital (Live Price Counter):** Saat mengubah material atau jenis kendaraan, angka harga pada kalkulator tidak berubah secara kaku, melainkan menggunakan fungsi *requestAnimationFrame* pada Alpine.js untuk menganimasikan pergantian angka secara mekanis dari nilai lama ke nilai baru.
*   **Liquid Progress Tracker:** Bar pelacak status pengerjaan menggunakan efek pengisian cairan (*liquid wave filling animation*). Ketika status berubah dari "Jahit" ke "Pasang", indikator akan melesat cepat lalu melambat secara elastis di ujung indikator.
*   **Asymmetric Fade-In Gallery:** Foto portofolio bus dan mobil mewah dimuat menggunakan *Intersection Observer API* yang terikat pada direktif Alpine.js (`x-intersect`). Foto akan muncul berurutan dengan jeda waktu (*staggered delay*) dari bawah ke atas secara organik saat digulir.

## 5. Struktur Database (Schema Utama)
* `users`: ID, Name, Role (Admin/Technician).
* `settings_pricelist`: ID, Category, Item_Name, Price_Value.
* `leads`: ID, Customer_Data, Calculated_Price, Status.
* `work_orders`: ID, Lead_ID, Plat_Nomor, Normalized_Plat, Current_Status, Work_Units, Start_Date.

---
*Blueprint ini bersifat Fixed dan menjadi acuan utama untuk tahap pengembangan.*
