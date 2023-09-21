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
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pesanan');
            $table->unsignedBigInteger('table_id');
            $table->string('status');
            $table->integer('total_harga');
            $table->unique('kode_pesanan');
            $table->string('nama_pemesan');
            $table->string('no_hp');
            $table->foreign('table_id')->references('id')->on('tables')
                ->onDelete('no action')->onUpdate('no action');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};
