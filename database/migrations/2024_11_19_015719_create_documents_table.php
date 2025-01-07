<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('indeks');
            $table->string('kode')->nullable();
            $table->date('tanggal')->nullable();
            $table->integer('no_urut')->unique();            $table->text('isi_ringkas');
            $table->string('lampiran')->nullable();
            $table->string('dari');
            $table->string('kepada');
            $table->date('tanggal_surat')->nullable();
            $table->string('no_surat')->nullable();
            $table->string('pengolahan')->nullable();
            $table->text('catatan')->nullable();
            $table->string('link_surat')->nullable(); // Kolom tambahan
            $table->timestamps();
        });
           
    }
    
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
