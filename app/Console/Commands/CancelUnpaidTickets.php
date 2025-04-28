<?php

namespace App\Console\Commands;

use App\Models\TicketPayment;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

// https://laravel.com/docs/10.x/artisan#writing-commands
class CancelUnpaidTickets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tickets:cancel-unpaid';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cancel unpaid tickets that are not paid within 24 hours';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            DB::beginTransaction();

            $cutoff = Carbon::now()->subHours(24);
            $affected = TicketPayment::where('status', 'pending')
                ->where('created_at', '<', $cutoff)
                ->update([
                    'status' => 'canceled',
                    'updated_at' => now(),
                ]);

            $this->info("Canceled {$affected} unpaid tickets.");
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception;
        }
    }
}
