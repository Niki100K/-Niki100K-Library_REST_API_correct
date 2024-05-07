<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\User;
use App\Services\BookService;
use Illuminate\Http\Request;

class BookController extends Controller
{

    protected $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->bookService->all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|numeric',
            'title' => 'required|string|max:255',
            'author' => 'required|string',
        ]);
    
        $user = User::find($validatedData['user_id']);
    
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
    
        $book = $user->books()->create([
            'title' => $validatedData['title'],
        ]);
    
        $author = Author::firstOrCreate(['name' => $validatedData['author']]);
        
        $book->authors()->attach($author);
    
        return response()->json(['message' => 'Book created successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = $this->bookService->findById($id);
        $authorNames = $book->authors()->pluck('name');
    
        return [
            'book' => [
                'title' => $book->title,
                'author' => $authorNames,
            ]
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string',
        ]);
    
        $book = $this->bookService->findById($id);
        if (!$book) {
            return response()->json(['error' => 'Book not found'], 404);
        }
    
        $userData = $request->only(['title', 'author']);
    
        $book->update([
            'title' => $userData['title'],
        ]);
    
        $author = Author::firstOrCreate(['name' => $userData['author']]);
    
        $book->authors()->sync([$author->id]);
    
        return response()->json(['message' => 'Book updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = $this->bookService->findById($id);
        if (!$book) {
            return response()->json(['error' => 'Book not found'], 404);
        }
    
        $book->delete();
    
        return response()->json(['message' => 'Book deleted successfully'], 200);
    }
}
