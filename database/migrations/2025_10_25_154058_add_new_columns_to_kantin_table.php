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
        Schema::table('kantin', function (Blueprint $table) {
            $table->string('nama_bank')->after('password');
            $table->integer('no_rekening')->after('nama_bank');
            $table->text('deskripsi')->nullable()->after('no_rekening');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kantin', function (Blueprint $table) {
            $table->dropColumn(['nama_bank', 'no_rekening', 'deskripsi']);
        });
    }
};
