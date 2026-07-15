<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Label - {{ $order->invoice_number }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background: #e5e7eb; }
        @media print {
            body { background: white; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
            .no-print { display: none !important; }
            .page-break { page-break-after: always; }
            @page { margin: 0; size: A6 portrait; } /* Standard label size 10x15cm */
            .print-container { width: 100% !important; padding: 0 !important; margin: 0 !important; border: none !important; box-shadow: none !important; }
        }
    </style>
</head>
<body class="text-gray-900 py-10 print:py-0">

    <!-- Print Controls -->
    <div class="no-print max-w-[10cm] mx-auto mb-6 flex justify-between items-center bg-white p-4 rounded-xl shadow-sm border border-gray-200">
        <a href="{{ route('admin.orders.show', $order->id) }}" class="text-sm font-semibold text-gray-500 hover:text-gray-800 transition">
            &larr; Kembali
        </a>
        <button onclick="window.print()" class="bg-black text-white px-5 py-2.5 rounded-lg text-sm font-bold shadow hover:bg-gray-800 transition flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
            Cetak Label
        </button>
    </div>

    <!-- The Label (A6 aspect ratio approximately 10x15cm) -->
    <div class="print-container w-[10.5cm] min-h-[14.8cm] bg-white mx-auto border border-gray-300 shadow-xl overflow-hidden flex flex-col relative">
        
        <!-- Header / Sender -->
        <div class="border-b-2 border-black border-dashed p-4 bg-gray-50">
            <div class="flex justify-between items-start mb-3">
                <div>
                    <h1 class="font-extrabold text-lg leading-none tracking-tight">BENGKEL JOK<br>NUSANTARA</h1>
                </div>
                <div class="text-right">
                    <p class="font-mono text-xs font-bold">{{ $order->invoice_number }}</p>
                    <p class="text-[0.65rem] text-gray-500">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
            
            <div class="text-xs">
                <p class="text-[0.65rem] text-gray-500 uppercase font-bold tracking-wider mb-0.5">Pengirim:</p>
                <p class="font-bold">Bengkel Jok Nusantara</p>
                <p class="text-gray-700 mt-0.5">0812-3456-7890</p>
                <p class="text-gray-700 leading-tight mt-0.5">Jl. Raya Bekasi No.123, Jakarta Timur</p>
            </div>
        </div>

        <!-- Recipient -->
        <div class="p-4 flex-grow border-b-2 border-black">
            <p class="text-[0.65rem] text-gray-500 uppercase font-bold tracking-wider mb-1.5">Penerima:</p>
            <p class="font-bold text-xl uppercase leading-tight mb-1">{{ $order->customer_name }}</p>
            <p class="font-bold text-sm mb-2">{{ $order->customer_wa }}</p>
            <p class="text-sm text-gray-800 leading-snug">{{ $order->shipping_address }}</p>
            
            <div class="mt-3 p-2 bg-gray-100 rounded border border-gray-300">
                <p class="text-[0.65rem] font-bold uppercase text-gray-500">Provinsi Tujuan:</p>
                <p class="font-bold text-sm uppercase">{{ $order->shipping_province }}</p>
            </div>
        </div>

        <!-- Package Details -->
        <div class="p-4 bg-gray-50">
            <p class="text-[0.65rem] text-gray-500 uppercase font-bold tracking-wider mb-1">Isi Paket:</p>
            <div class="text-sm font-semibold mb-1 border border-gray-300 p-2 rounded bg-white">
                1x {{ $order->product->name ?? 'Produk Custom' }}
            </div>
            
            <div class="grid grid-cols-2 gap-2 mt-2">
                <div>
                    <p class="text-[0.65rem] text-gray-500 uppercase">Warna:</p>
                    <p class="text-xs font-bold">{{ $order->primary_color }} @if($order->secondary_color) / {{ $order->secondary_color }} @endif</p>
                </div>
                <div>
                    <p class="text-[0.65rem] text-gray-500 uppercase">Mobil:</p>
                    <p class="text-xs font-bold">{{ $order->carVariant->brand ?? '-' }} {{ $order->carVariant->model ?? '-' }}</p>
                </div>
            </div>

            @if($order->notes)
            <div class="mt-3 text-xs p-2 border border-dashed border-gray-400 bg-yellow-50/50">
                <span class="font-bold text-[0.65rem] uppercase text-gray-500 block mb-0.5">Catatan:</span>
                {{ $order->notes }}
            </div>
            @endif
        </div>
        
        <!-- Footer Info -->
        <div class="p-3 text-center border-t border-gray-200 mt-auto">
            <p class="text-[10px] text-gray-400 font-medium">Batas potong label pengiriman (A6 / 10x15cm)</p>
        </div>
    </div>

    <script>
        // Auto print prompt on load
        window.onload = function() {
            // Uncomment the next line to automatically pop up print dialog when the page loads
            // window.print();
        }
    </script>
</body>
</html>
