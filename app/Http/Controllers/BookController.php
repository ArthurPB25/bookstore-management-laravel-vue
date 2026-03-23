<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Http\Requests\StoreBookRequest;
use Inertia\Inertia;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function __construct()
    {
        // Middleware de segurança: Apenas Admin pode deletar
        $this->middleware('can:delete books')->only('destroy');
        // Admin e Editor podem criar e editar
        $this->middleware('can:edit books')->except(['index', 'show', 'destroy']);
    }
    public function index()
    {
        $books = Book::with('category')->paginate(10);

        return Inertia::render('Books/Index', [
            'books' => $books
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Books/Create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Book::create($request->validated());
        return redirect()->route('books.index')
        ->with('success', 'Livro cadastro com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        return Inertia::render('Books/Edit', [
            'book' => $book,
            'categories'=>Category:: all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $book->update($request->validated());
        return redirect()->route('books.index')
        ->with('success', 'Livro atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')
        ->with('sucess', "Livro removido com sucesso!");
    }
}
