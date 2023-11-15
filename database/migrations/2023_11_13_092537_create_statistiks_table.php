<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('statistiks', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('sosmed_id')->constrained('sosmeds')->onDelete('cascade');
            $table->integer('pengikut');
            $table->integer('jangkauan');
            $table->integer('interaksi');
            $table->date('periode');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('statistiks');
    }
};
