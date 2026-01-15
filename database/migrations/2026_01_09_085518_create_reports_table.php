<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('artisan_id')->nullable()->constrained('artisans')->onDelete('cascade');
            $table->enum('type', ['sales', 'stock', 'performance'])->default('sales');
            $table->date('start_date');
            $table->date('end_date');
            $table->longText('content')->nullable();
            $table->string('file_path')->nullable();
            $table->enum('format', ['pdf', 'excel', 'json'])->default('pdf');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
