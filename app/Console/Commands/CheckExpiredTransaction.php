<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PembayaranTransaksi;
use App\Models\Laporan;
use Carbon\Carbon;

class CheckExpiredTransaction extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:exprired-transaction';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check Expired Transaction';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $data = PembayaranTransaksi::with(['order' => function($q) {
                    $q->where('laporan_transaksi.status', 'Pending');
                }])
                ->where('expired_at', '<=', now())
                ->where('status', 'pending')
                ->chunk(100, function($transactions) {
                    foreach ($transactions as $transaction) {
                        $transaction->update([
                            'status' => 'expired'
                        ]);

                        $transaction->order->update([
                            'status' => 'Gagal'
                        ]);
                    }
                });
    }
}
