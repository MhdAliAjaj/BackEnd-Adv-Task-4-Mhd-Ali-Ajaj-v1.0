<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * تنفيذ الهجرة.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id(); // مفتاح رئيسي
            $table->string('title'); // اسم الكتاب
            $table->string('author'); // اسم المؤلف
            $table->text('description'); // وصف الكتاب
            $table->date('published_at'); // تاريخ النشر
            $table->timestamps(); // created_at و updated_at تلقائيين
        });
    }

    /**
     * التراجع عن الهجرة.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
};
