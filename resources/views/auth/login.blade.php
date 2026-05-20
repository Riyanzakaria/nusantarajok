<x-layout title="Login — AUTO-STITCH OS">
    <div class="max-w-md mx-auto px-4 py-16">
        <h1 class="font-display text-3xl font-bold text-slate-900 mb-2 text-center tracking-tight">Masuk ke Dashboard</h1>
        <p class="text-center text-slate-500 mb-8 font-light">Silakan login untuk mengelola AUTO-STITCH OS.</p>

        <div class="bg-white/90 backdrop-blur-md border border-slate-200 p-8 rounded-3xl shadow-xl shadow-slate-200/50">
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-slate-900 placeholder-slate-400 focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-all touch-target shadow-inner"
                    >
                    @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-slate-900 placeholder-slate-400 focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition-all touch-target shadow-inner"
                    >
                </div>

                <div class="flex items-center gap-2">
                    <input type="checkbox" id="remember" name="remember" class="rounded border-slate-300 bg-slate-50 text-accent-500 focus:ring-accent-500 w-4 h-4">
                    <label for="remember" class="text-sm text-slate-600">Ingat saya</label>
                </div>

                <button
                    type="submit"
                    class="w-full bg-slate-900 hover:bg-slate-800 text-white font-medium px-6 py-4 rounded-xl active:scale-95 transition-all duration-150 touch-target shadow-md hover:shadow-lg mt-4"
                >
                    Masuk
                </button>
            </form>
        </div>
    </div>
</x-layout>
