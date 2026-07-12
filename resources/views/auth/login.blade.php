<x-layout title="Login — Nusantara Jok">
    <div class="max-w-md mx-auto px-4 py-16 relative">
        <div class="absolute top-0 right-0 w-[30rem] h-[30rem] bg-accent-500/10 rounded-full blur-[100px] pointer-events-none z-0"></div>
        
        <div class="relative z-10">
            <h1 class="font-display text-3xl font-bold text-slate-900 dark:text-white mb-2 text-center tracking-tight drop-shadow-md">Masuk ke Dashboard</h1>
            <p class="text-center text-slate-500 dark:text-slate-400 mb-8 font-light">Silakan login untuk mengelola Nusantara Jok.</p>

            <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-md border border-slate-200 dark:border-white/10 p-8 rounded-3xl shadow-[0_0_30px_rgba(0,0,0,0.5)]">
                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf
                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-600 dark:text-slate-300 mb-1">Email</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            class="w-full bg-slate-100/50 dark:bg-slate-900/50 border border-slate-300 dark:border-slate-600 rounded-xl px-4 py-3 text-slate-900 dark:text-white placeholder-slate-500 focus:ring-2 focus:ring-accent-500/50 focus:border-accent-500 transition-all touch-target shadow-inner"
                        >
                        @error('email')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-600 dark:text-slate-300 mb-1">Password</label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            required
                            class="w-full bg-slate-100/50 dark:bg-slate-900/50 border border-slate-300 dark:border-slate-600 rounded-xl px-4 py-3 text-slate-900 dark:text-white placeholder-slate-500 focus:ring-2 focus:ring-accent-500/50 focus:border-accent-500 transition-all touch-target shadow-inner"
                        >
                    </div>

                    <div class="flex items-center gap-2">
                        <input type="checkbox" id="remember" name="remember" class="rounded border-slate-300 dark:border-slate-600 bg-slate-100/50 dark:bg-slate-900/50 text-accent-500 focus:ring-accent-500/50 focus:ring-offset-slate-800 w-4 h-4">
                        <label for="remember" class="text-sm text-slate-500 dark:text-slate-400">Ingat saya</label>
                    </div>

                    <button
                        type="submit"
                        class="w-full bg-accent-500 hover:bg-accent-400 text-slate-900 dark:text-white font-bold px-6 py-4 rounded-xl active:scale-95 transition-all duration-150 touch-target shadow-[0_0_15px_rgba(249,115,22,0.3)] hover:shadow-[0_0_25px_rgba(249,115,22,0.5)] border border-accent-400/50 mt-4"
                    >
                        Masuk
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-layout>


