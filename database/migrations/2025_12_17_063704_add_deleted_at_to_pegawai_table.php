<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('shinosuke_534826ugm_pegawai', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::table('shinosuke_534826ugm_pegawai', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
