<?php

use App\Models\Product;
use App\Models\RequestQr;
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
        Schema::create('batch_codes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Product::class)->constrained();
            $table->foreignIdFor(RequestQr::class)->constrained();
            $table->string('batch_code', 20);
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
        Schema::dropIfExists('batch_codes');
    }
};
