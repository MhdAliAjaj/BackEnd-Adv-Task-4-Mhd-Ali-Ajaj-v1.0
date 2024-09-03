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
        Schema::create('borrow_records', function (Blueprint $table) {
            $table->id();
            $table->id(); // مفتاح رئيسي
            $table->foreignId('book_id')->constrained(); // معرّف الكتاب
            $table->foreignId('user_id')->constrained(); // معرّف المستخدم
            $table->date('borrowed_at'); // تاريخ الاستعارة
            $table->date('due_date'); // تاريخ الإعادة
            $table->date('returned_at')->nullable(); // تاريخ الإرجاع
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrow_records');
    }
};
