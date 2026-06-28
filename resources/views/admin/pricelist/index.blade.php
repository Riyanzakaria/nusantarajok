<x-layout title="Daftar Harga Material — Nusantara Jok">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 gap-4">
            <div>
                <h1 class="font-display text-3xl font-bold text-slate-900 tracking-tight">Daftar Harga</h1>
                <p class="text-slate-500 dark:text-slate-500 mt-1">Kelola harga material dan jasa bengkel.</p>
            </div>
            <a href="{{ route('dashboard.index') }}" class="text-sm font-semibold text-slate-500 dark:text-slate-500 hover:text-slate-900 transition-colors flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Dashboard
            </a>
        </div>

        {{-- Success Alert --}}
        @if(session('success'))
            <div class="mb-6 bg-emerald-50 text-emerald-700 p-4 rounded-xl border border-emerald-200 flex items-center gap-3">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <div class="lg:grid lg:grid-cols-3 lg:gap-8 flex flex-col gap-8">
            {{-- Kolom Kiri: Form Tambah Item --}}
            <div class="col-span-1">
                <div class="bg-white border border-slate-200 p-6 rounded-2xl shadow-sm sticky top-28">
                    <h2 class="text-lg font-bold text-slate-900 mb-5 flex items-center gap-2">
                        <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        Tambah Item Baru
                    </h2>
                    <form action="{{ route('admin.pricelist.store') }}" method="POST" class="flex flex-col gap-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Kategori Kendaraan</label>
                            <select name="vehicle_category_id" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 focus:ring-accent-500 focus:border-accent-500" required>
                                <option value="">— Pilih Kategori Kendaraan —</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            @error('vehicle_category_id') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Item</label>
                            <input type="text" name="item_name" placeholder="Sintetis Premium..." class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 focus:ring-accent-500 focus:border-accent-500" required>
                            @error('item_name') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Harga</label>
                            <input type="number" name="price" placeholder="3500000" step="0.01" min="0" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 focus:ring-accent-500 focus:border-accent-500" required>
                            @error('price') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <button type="submit" class="w-full px-6 py-3 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white font-bold rounded-xl hover:bg-accent-500 transition-colors touch-target">
                            Simpan Item
                        </button>
                    </form>
                </div>
            </div>

            {{-- Kolom Kanan: Tabel Data --}}
            <div class="col-span-2">
                <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm text-slate-600">
                            <thead class="bg-slate-50 text-slate-900 font-bold border-b border-slate-200">
                                <tr>
                                    <th class="px-5 py-4">Item</th>
                                    <th class="px-5 py-4 hidden md:table-cell">Kendaraan</th>
                                    <th class="px-5 py-4 text-right">Harga</th>
                                    <th class="px-5 py-4 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100" x-data="{ editingId: null }">
                                @forelse($pricelists as $item)
                                <tr class="hover:bg-slate-50/50 transition-colors" x-data="{ editing: false }">
                                    {{-- View Mode --}}
                                    <template x-if="!editing">
                                        <td class="px-5 py-4 font-semibold text-slate-900">{{ $item->item_name }}</td>
                                    </template>
                                    <template x-if="!editing">
                                        <td class="px-5 py-4 hidden md:table-cell text-slate-500 dark:text-slate-500">{{ $item->vehicleCategory?->name ?? '—' }}</td>
                                    </template>
                                    <template x-if="!editing">
                                        <td class="px-5 py-4 text-right font-mono font-semibold text-slate-900">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                    </template>
                                    <template x-if="!editing">
                                        <td class="px-5 py-4 text-right">
                                            <div class="flex items-center justify-end gap-2">
                                                <button @click="editing = true" class="text-sm text-blue-600 hover:text-blue-800 font-semibold">Edit</button>
                                                <form action="{{ route('admin.pricelist.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus item ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-sm text-red-500 hover:text-red-700 font-semibold">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </template>

                                    {{-- Inline Edit Mode --}}
                                    <template x-if="editing">
                                        <td colspan="6" class="px-5 py-4">
                                            <form action="{{ route('admin.pricelist.update', $item) }}" method="POST" class="flex flex-wrap items-end gap-3">
                                                @csrf
                                                @method('PUT')
                                                <div class="flex-1 min-w-[140px]">
                                                    <label class="block text-xs font-semibold text-slate-500 dark:text-slate-500 mb-1">Nama</label>
                                                    <input type="text" name="item_name" value="{{ $item->item_name }}" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm text-slate-900 focus:ring-accent-500 focus:border-accent-500" required>
                                                </div>
                                                <div class="w-32">
                                                    <label class="block text-xs font-semibold text-slate-500 dark:text-slate-500 mb-1">Kendaraan</label>
                                                    <select name="vehicle_category_id" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm text-slate-900 focus:ring-accent-500 focus:border-accent-500" required>
                                                        <option value="">—</option>
                                                        @foreach($categories as $cat)
                                                            <option value="{{ $cat->id }}" {{ $item->vehicle_category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="w-32">
                                                    <label class="block text-xs font-semibold text-slate-500 dark:text-slate-500 mb-1">Harga</label>
                                                    <input type="number" name="price" value="{{ $item->price }}" step="0.01" min="0" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm text-slate-900 focus:ring-accent-500 focus:border-accent-500" required>
                                                </div>
                                                <div class="flex gap-2">
                                                    <button type="submit" class="px-4 py-2 bg-emerald-600 text-slate-900 dark:text-white text-sm font-bold rounded-lg hover:bg-emerald-700 transition-colors">Simpan</button>
                                                    <button type="button" @click="editing = false" class="px-4 py-2 bg-slate-100 text-slate-600 text-sm font-bold rounded-lg hover:bg-slate-200 transition-colors">Batal</button>
                                                </div>
                                            </form>
                                        </td>
                                    </template>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-slate-500 dark:text-slate-500">
                                        <svg class="w-12 h-12 mx-auto mb-3 text-slate-600 dark:text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                        <p class="font-semibold">Belum ada data harga.</p>
                                        <p class="text-sm mt-1">Gunakan form di sebelah kiri untuk menambah item pertama.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
