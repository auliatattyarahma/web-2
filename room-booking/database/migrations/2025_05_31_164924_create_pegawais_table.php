// database/migrations/2025_05_31_164924_create_pegawais_table.php
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
        Schema::create('pegawais', function(Blueprint $table) {
            $table->id();
            $table->string('nip')->unique();
            $table->string('nama');
   
            $table->foreignId('unit_kerja_id')->constrained('unit_kerjas')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawais');
    }
};