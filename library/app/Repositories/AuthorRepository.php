<?php

namespace App\Repositories;

use App\Models\Author;

class AuthorRepository
{
    protected $model;

    public function __construct(Author $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function findById($identifier)
    {
        if (is_numeric($identifier)) {
            return $this->model->findOrFail($identifier);
        } else {
            $author = Author::where('name', $identifier)->first();
            if (!$author) {
                return response()->json(['error' => 'Author not found'], 404);
            }
            return $author;
        }
    }

    public function create($data)
    {
        $existingAuthor = Author::where('name', $data['name'])->first();
        if ($existingAuthor) {
            return response()->json(['error' => 'Author already exists'], 400);
        }
    
        $author = $this->model->create($data);
    
        return $author;
    }

    public function update($id, $data)
    {
        $author = $this->model->findOrFail($id);
        $author->update($data);
        return $author;
    }

    public function delete($id)
    {
        $author = Author::find($id);
        if (!$author) {
            return response()->json(['error' => 'Author not found'], 404);
        }
    
        $author->books()->detach();
        $author->delete();
    
        return response()->json(['message' => 'Author deleted successfully'], 200);
    }
}