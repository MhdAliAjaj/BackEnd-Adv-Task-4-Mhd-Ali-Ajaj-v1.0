<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BorrowRecord extends Model
{
    protected $fillable = ['book_id', 'user_id', 'borrowed_at', 'due_date', 'returned_at'];

    /**
     * علاقة مع الكتاب.
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * علاقة مع المستخدم.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
