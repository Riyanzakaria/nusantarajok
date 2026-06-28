<x-layout title="Manajemen Kategori | Admin">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 gap-4">
            <div>
                <h1 class="font-display text-3xl font-bold text-slate-900 tracking-tight">Kategori Galeri</h1>
                <p class="text-slate-500 dark:text-slate-500 mt-1">Atur kategori kendaraan untuk galeri foto.</p>
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
            {{-- Kolom Kiri: Form Tambah Kategori --}}
            <div class="col-span-1">
                <div class="bg-white border border-slate-200 p-6 rounded-2xl shadow-sm sticky top-28">
                    <h2 class="text-lg font-bold text-slate-900 mb-5 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                        Tambah Kategori Baru
                    </h2>
                    <form action="{{ route('admin.categories.store') }}" method="POST" class="flex flex-col gap-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Kategori</label>
                            <input type="text" name="name" placeholder="Sedan, SUV, Bus..." class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 focus:ring-accent-500 focus:border-accent-500" required>
                            @error('name') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <button type="submit" class="w-full px-6 py-3 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white font-bold rounded-xl hover:bg-accent-500 transition-colors touch-target">
                            Simpan Kategori
                        </button>
                    </form>
                </div>
            </div>

            {{-- Kolom Kanan: Tabel Data --}}
            <div class="col-span-2">
                <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
                    <table class="w-full text-left text-sm text-slate-600">
                        <thead class="bg-slate-50 text-slate-900 font-bold border-b border-slate-200">
                            <tr>
                                <th class="px-5 py-4">Nama Kategori</th>
                                <th class="px-5 py-4 hidden sm:table-cell">Slug</th>
                                <th class="px-5 py-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($categories as $category)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-5 py-4 font-semibold text-slate-900">{{ $category->name }}</td>
                                <td class="px-5 py-4 hidden sm:table-cell text-slate-500 dark:text-slate-500 font-mono text-xs">{{ $category->slug }}</td>
                                <td class="px-5 py-4 text-right">
                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Hapus kategori ini? Semua foto di dalamnya akan ikut terhapus!');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm text-red-500 hover:text-red-700 font-semibold px-2 py-1 rounded-lg hover:bg-red-50 transition-colors">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="px-6 py-12 text-center text-slate-500 dark:text-slate-500">
                                    <svg class="w-12 h-12 mx-auto mb-3 text-slate-600 dark:text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                                    <p class="font-semibold">Belum ada kategori.</p>
                                    <p class="text-sm mt-1">Mulai dengan membuat kategori pertama.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-layout>
