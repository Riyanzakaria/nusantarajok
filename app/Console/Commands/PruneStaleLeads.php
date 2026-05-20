<?php

namespace App\Console\Commands;

use App\Models\Lead;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class PruneStaleLeads extends Command
{
    /**
     * The name and signature of the console command.
     *
     * Signature: php artisan leads:prune [--days=30]
     */
    protected $signature = 'leads:prune
                            {--days=30 : Hapus leads yang lebih tua dari N hari (default: 30)}';

    /**
     * The console command description.
     */
    protected $description = 'Hard-delete leads berstatus "raw" atau "dropped" yang lebih tua dari batas hari yang ditentukan (anti-garbage, proteksi database free-tier).';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $days      = (int) $this->option('days');
        $threshold = Carbon::now()->subDays($days);

        $this->info("🧹 Memulai pruning leads yang lebih tua dari {$days} hari (sebelum {$threshold->toDateString()})...");

        $deleted = Lead::whereIn('status', ['raw', 'dropped'])
            ->where('created_at', '<', $threshold)
            ->delete();

        if ($deleted === 0) {
            $this->line('   Tidak ada leads basi yang perlu dihapus. Database bersih! ✅');
        } else {
            $this->info("   ✅ {$deleted} lead berhasil dihapus dari database.");
        }

        return Command::SUCCESS;
    }
}
