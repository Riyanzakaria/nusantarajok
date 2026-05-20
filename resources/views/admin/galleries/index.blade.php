<x-layout title="Manajemen Galeri | Admin">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 gap-4">
            <div>
                <h1 class="font-display text-3xl font-bold text-slate-900 tracking-tight">Manajemen Galeri</h1>
                <p class="text-slate-500 mt-1">Unggah foto dan atur showcase homepage.</p>
            </div>
            <a href="{{ route('dashboard.index') }}" class="text-sm font-semibold text-slate-500 hover:text-slate-900 transition-colors flex items-center gap-1.5">
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
            {{-- Kolom Kiri: Form Upload --}}
            <div class="col-span-1">
                <div class="bg-white border border-slate-200 p-6 rounded-2xl shadow-sm sticky top-28">
                    <h2 class="text-lg font-bold text-slate-900 mb-5 flex items-center gap-2">
                        <svg class="w-5 h-5 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        Unggah Foto Baru
                    </h2>
                    <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Kategori Kendaraan</label>
                            <select name="category_id" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 focus:ring-accent-500 focus:border-accent-500" required>
                                <option value="" disabled selected>Pilih Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Judul / Deskripsi <span class="text-slate-400 font-normal">(opsional)</span></label>
                            <input type="text" name="title" placeholder="Judul singkat..." class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 focus:ring-accent-500 focus:border-accent-500">
                            @error('title') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">File Foto (Max 2MB)</label>
                            <input type="file" name="image" accept="image/*" class="w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200" required>
                            @error('image') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <label class="flex items-center gap-2.5 text-slate-700 font-medium cursor-pointer">
                            <input type="checkbox" name="is_featured" value="1" class="rounded border-slate-300 text-slate-900 focus:ring-slate-900 w-4 h-4">
                            <span class="text-sm">Jadikan Featured (tampil di homepage)</span>
                        </label>

                        <button type="submit" class="w-full px-6 py-3 bg-slate-900 text-white font-bold rounded-xl hover:bg-accent-500 transition-colors touch-target">
                            Upload Foto
                        </button>
                    </form>
                </div>
            </div>

            {{-- Kolom Kanan: Grid Foto --}}
            <div class="col-span-2">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    @forelse($galleries as $gallery)
                    <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm group hover:shadow-md transition-shadow">
                        <div class="relative aspect-video">
                            <img src="{{ asset($gallery->image_url) }}" alt="{{ $gallery->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @if($gallery->is_featured)
                                <div class="absolute top-3 left-3 bg-amber-400 text-amber-900 text-[10px] font-bold px-2.5 py-1 rounded-full uppercase tracking-wider">
                                    ★ Featured
                                </div>
                            @endif
                        </div>
                        <div class="p-4 flex items-center justify-between">
                            <div>
                                <h3 class="font-bold text-slate-900 text-sm">{{ $gallery->title }}</h3>
                                <p class="text-xs text-slate-500 mt-0.5">{{ $gallery->category->name }}</p>
                            </div>
                            <form action="{{ route('admin.galleries.destroy', $gallery) }}" method="POST" onsubmit="return confirm('Hapus foto ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs text-red-500 hover:text-red-700 font-semibold flex items-center gap-1 px-2 py-1.5 rounded-lg hover:bg-red-50 transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-full py-12 text-center text-slate-500 bg-white border border-slate-200 rounded-2xl">
                        <svg class="w-12 h-12 mx-auto mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <p class="font-semibold">Belum ada foto di galeri.</p>
                        <p class="text-sm mt-1">Gunakan form di sebelah kiri untuk upload foto pertama.</p>
                    </div>
                    @endforelse
                </div>
        </div>
    </div>
</x-layout>
