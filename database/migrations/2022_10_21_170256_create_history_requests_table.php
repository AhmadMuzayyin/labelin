<?php

use App\Models\RequestQr;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(RequestQr::class)->constrained()->cascadeOnDelete();
            $table->enum('status', ['Waiting Payment', 'Pending Payment', 'Proses Cetak QR', 'Dalam Pengiriman']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history_requests');
    }
};
