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
        Schema::table('lareja_web_activity', function (Blueprint $table) {
            $table->unsignedBigInteger('file_id')->nullable();
            $table->foreign('file_id')->references('id')->on('files');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lareja_web_activity', function (Blueprint $table) {
            $table->dropForeign('lareja_web_activity_file_id_foreign');
            $table->dropColumn('file_id');
        });
    }
};
