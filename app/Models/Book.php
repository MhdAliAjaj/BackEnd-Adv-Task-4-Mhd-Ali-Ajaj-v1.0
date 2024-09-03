<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title', 'author', 'description', 'published_at'];

    /**
     * تحقق مما إذا كان الكتاب مستعارًا.
     *
     * @return bool
     */
    public function isBorrowed()
    {
        return $this->borrowRecords()->whereNull('returned_at')->exists();
    }

    /**
     * علاقة مع سجل الاستعارة.
     */
    public function borrowRecords()
    {
        return $this->hasMany(BorrowRecord::class);
    }
}