<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->enum('payment_method', ['card', 'tng', 'shopee', 'grab'])->nullable()->after('payment_status');
            $table->string('billing_name')->nullable()->after('payment_method');
            $table->string('billing_phone')->nullable();
            $table->string('billing_email')->nullable();
            $table->text('billing_address')->nullable();
            $table->string('receiver_name')->nullable();
            $table->string('receiver_phone')->nullable();
            $table->string('receiver_email')->nullable();
            $table->text('receiver_address')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->dropColumn([
                'payment_method',
                'billing_name',
                'billing_phone',
                'billing_email',
                'billing_address',
                'receiver_name',
                'receiver_phone',
                'receiver_email',
                'receiver_address',
            ]);
        });
    }
};
