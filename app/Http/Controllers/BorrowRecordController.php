<?php

namespace App\Http\Controllers;

use App\Http\Requests\BorrowRecordFormRequest;
use App\Models\Book;
use App\Models\BorrowRecord;

class BorrowRecordController extends Controller
{
    /**
     * استعارة كتاب.
     *
     * @param  \App\Http\Requests\BorrowRecordFormRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function borrow(BorrowRecordFormRequest $request)
    {
        $book = Book::findOrFail($request->book_id);
        
        // تحقق من توفر الكتاب
        if ($book->isBorrowed()) {
            return response()->json(['error' => 'هذا الكتاب مستعار بالفعل.'], 400);
        }

        // إنشاء سجل الاستعارة
        $borrowRecord = BorrowRecord::create([
            'book_id' => $book->id,
            'user_id' => auth()->id(), // معرّف المستخدم الحالي
            'borrowed_at' => now(),
            'due_date' => now()->addDays(14), // تاريخ الإعادة بعد 14 يومًا
        ]);

        return response()->json($borrowRecord, 201);
    }

    /**
     * إرجاع كتاب.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function returnBook($id)
    {
        $borrowRecord = BorrowRecord::findOrFail($id);
        $borrowRecord->returned_at = now();
        $borrowRecord->save();

        return response()->json($borrowRecord);
    }
}
