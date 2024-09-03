<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookFormRequest;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * إرجاع قائمة الكتب.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(Book::all());
    }

    /**
     * تخزين كتاب جديد.
     *
     * @param  \App\Http\Requests\BookFormRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(BookFormRequest $request)
    {
        $book = Book::create($request->validated());
        return response()->json($book, 201);
    }

    /**
     * إرجاع كتاب محدد.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return response()->json(Book::findOrFail($id));
    }

    /**
     * تحديث كتاب محدد.
     *
     * @param  \App\Http\Requests\BookFormRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(BookFormRequest $request, $id)
    {
        $book = Book::findOrFail($id);
        $book->update($request->validated());
        return response()->json($book);
    }

    /**
     * حذف كتاب محدد.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Book::destroy($id);
        return response()->noContent();
    }

    public function filter(BookFormRequest $request)
{
    $query = Book::query();
    
    if ($request->has('author')) {
        $query->where('author', $request->author);
    }
    
    return response()->json($query->get());
}
}
