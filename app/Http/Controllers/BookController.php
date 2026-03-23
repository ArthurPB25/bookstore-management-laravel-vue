<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Http\Requests\StoreBookRequest;
use Inertia\Inertia;
use Illuminate\Http\Request;

class BookController extends Controller
{
    
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
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'author' => 'required|string|max:255',
        'isbn' => 'nullable|string|max:20',
        'price' => 'nullable|numeric',
        'publication_date' => 'nullable|date',
        'category_id' => 'required|exists:categories,id', // Validação real
    ]);

    \App\Models\Book::create($validated);

    return redirect()->route('books.index')->with('success', 'Livro criado!');
}


public function update(Request $request, Book $book)
{
    $validated = $request->validate([
        'title'  => 'required|string|max:255',
        'author' => 'required|string|max:255',
        // O ISBN deve ser único, MAS ignorando o ID deste livro atual
        'isbn'   => 'required|string|max:20|unique:books,isbn,' . $book->id,
        'price'  => 'required|numeric',
        'publication_date' => 'nullable|date',
        'category_id'      => 'required|exists:categories,id',
    ]);

    
    $book->update($validated);
    
    return redirect()->route('books.index')
        ->with('success', 'Livro atualizado com sucesso!');
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
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $book = \App\Models\Book::findOrFail($id);
    $book->delete();

    
    return redirect()->route('books.index')->with('message', 'Livro excluído!');
}
}
