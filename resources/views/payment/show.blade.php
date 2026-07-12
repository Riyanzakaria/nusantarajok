<x-layout>
    <x-slot:title>Pembayaran Pesanan | Bengkel Jok Nusantara</x-slot:title>

    <div class="min-h-screen pt-32 pb-20 px-4 sm:px-6 lg:px-8 flex items-center justify-center"
         style="background: oklch(0.12 0.018 55);">
         
        <div class="w-full max-w-lg p-8 md:p-12 text-center" 
             style="background: oklch(0.155 0.022 55); border: 1px solid oklch(0.22 0.02 55);">
            
            <div class="w-20 h-20 mx-auto mb-6 flex items-center justify-center rounded-full" style="background: oklch(0.67 0.13 66 / 0.15);">
                <svg class="w-10 h-10" style="color: oklch(0.67 0.13 66);" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>

            <h1 class="font-display font-700 text-3xl mb-3" style="color: oklch(0.93 0.012 75); letter-spacing: -0.03em;">Pesanan Berhasil Dibuat!</h1>
            <p class="font-sans text-sm mb-8" style="color: oklch(0.50 0.020 62);">
                Terima kasih, <b>{{ $order->customer_name }}</b>.<br>
                Silakan selesaikan pembayaran untuk memproses pesanan Anda.
            </p>

            <div class="mb-8 p-6 text-left" style="background: oklch(0.12 0.018 55); border: 1px solid oklch(0.28 0.025 55);">
                <div class="flex justify-between items-center mb-4">
                    <span class="font-sans text-xs uppercase tracking-wider" style="color: oklch(0.50 0.020 62);">Total Pembayaran</span>
                    <span class="font-display font-600 text-2xl" style="color: oklch(0.93 0.012 75);">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="font-sans text-xs uppercase tracking-wider" style="color: oklch(0.50 0.020 62);">Nomor Pesanan</span>
                    <span class="font-mono text-sm font-700" style="color: oklch(0.67 0.13 66);">{{ $order->invoice_number }}</span>
                </div>
            </div>

            @if($order->midtrans_snap_token)
                <div class="space-y-4">
                    <button id="pay-button" 
                            class="touch-target w-full flex items-center justify-center gap-2.5 py-4 font-sans font-700 text-sm uppercase tracking-wider transition-all duration-250" 
                            style="background: oklch(0.67 0.13 66); color: oklch(0.12 0.018 55); border: none;"
                            onmouseover="this.style.background='oklch(0.75 0.11 67)'"
                            onmouseout="this.style.background='oklch(0.67 0.13 66)'">
                        Lanjutkan Pembayaran
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                    
                    <form action="{{ route('payment.regenerate', $order->id) }}" method="POST">
                        @csrf
                        <button type="submit" 
                                class="w-full py-4 font-sans font-700 text-xs uppercase tracking-wider transition-all duration-250 bg-transparent" 
                                style="border: 1px solid oklch(0.28 0.025 55); color: oklch(0.93 0.012 75);"
                                onmouseover="this.style.background='oklch(0.22 0.02 55)'"
                                onmouseout="this.style.background='transparent'"
                                onclick="return confirm('Apakah Anda yakin ingin mengganti metode pembayaran? QR/Virtual Account sebelumnya akan hangus.');">
                            Ganti Metode Pembayaran
                        </button>
                    </form>
                    
                    <p class="font-sans text-[10px] uppercase tracking-widest mt-6" style="color: oklch(0.50 0.020 62);">
                        Klik tombol "Lanjutkan Pembayaran" jika pop-up tidak muncul otomatis.
                    </p>
                </div>
            @else
                <div class="p-5 font-sans text-sm text-left mb-6" style="background: oklch(0.60 0.20 25 / 0.08); border: 1px solid oklch(0.60 0.20 25 / 0.30); color: oklch(0.75 0.18 25);">
                    Gagal memuat token pembayaran. Silakan hubungi admin via WhatsApp untuk melakukan pembayaran manual.
                </div>
                <a href="{{ $order->customer_wa_link }}" target="_blank" 
                   class="inline-flex items-center justify-center gap-2 px-6 py-3 font-sans font-700 text-sm uppercase tracking-wider"
                   style="background: #25D366; color: white;">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.274.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.1.824zm-3.423-14.416c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm.029 18.88c-1.161 0-2.305-.292-3.318-.844l-3.677.964.984-3.595c-.607-1.052-.927-2.246-.926-3.468.001-3.825 3.113-6.937 6.937-6.937 3.825 0 6.938 3.112 6.939 6.937.001 3.826-3.113 6.938-6.939 6.938z"/></svg>
                    Chat Admin
                </a>
            @endif
        </div>
    </div>

    @if($order->midtrans_snap_token)
        <script src="{{ config('midtrans.snap_url') }}" data-client-key="{{ config('midtrans.client_key') }}"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const payButton = document.getElementById('pay-button');
                const snapToken = '{{ $order->midtrans_snap_token }}';

                function openSnap() {
                    window.snap.pay(snapToken, {
                        onSuccess: function(result){
                            // Redirect ke halaman tracker/status setelah sukses
                            // Untuk sementara arahkan ke home dengan alert, atau biarkan webhook yang update
                            window.location.href = "{{ route('home') }}?status=success";
                        },
                        onPending: function(result){
                            // Stay on page
                        },
                        onError: function(result){
                            alert("Terjadi kesalahan saat memproses pembayaran Anda.");
                        },
                        onClose: function(){
                            // Customer closed popup without finishing payment
                        }
                    });
                }

                payButton.addEventListener('click', function () {
                    openSnap();
                });

                // Auto-open on load
                setTimeout(openSnap, 1000);
            });
        </script>
    @endif
</x-layout>
