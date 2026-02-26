<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('guest_houses', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('alamat');
            $table->text('deskripsi')->nullable();
            $table->decimal('harga_per_malam', 10, 2);
            $table->integer('kapasitas')->default(2);
            $table->json('fasilitas')->nullable(); // WiFi, AC, TV, dll
            $table->string('gambar')->nullable();
            $table->enum('status', ['tersedia', 'tidak_tersedia'])->default('tersedia');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guest_houses');
    }
};
