<?php

namespace App\Http\Controllers;

use App\Services\AuthorService;
use Illuminate\Http\Request;

class AuthorController extends Controller
{

    protected $authorService;

    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->authorService->all()->pluck('name');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
    
        $authorData = $request->only(['name']);

        return $this->authorService->create($authorData);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $identifier)
    {
        return $this->authorService->findById($identifier);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $data = $request->only(['name']);

        return $this->authorService->update($id, $data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        return $this->authorService->delete($id);
    }
}
