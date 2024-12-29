<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id_transaction')->primary()->default(Str::uuid());
            $table->uuid('id_user');
            $table->uuid('id_cart');
            $table->boolean('is_payment')->default(false)->nullable();
            $table->string('address')->nullable();
            $table->string('send_type')->nullable();
            $table->string('status')->nullable();
            $table->string('resi_number')->nullable();
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('id_cart')->references('id_cart')->on('carts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
