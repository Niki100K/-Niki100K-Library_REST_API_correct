<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $names = ['Filip', 'Alexandur', 'Adrian'];

        $users = User::factory(10)->create();

        foreach ($users as $user) {
            $numberOfBooks = rand(1, 3);
            $authorName = $names[array_rand($names)];

            for ($i=0; $i < $numberOfBooks; $i++) { 
                $book = Book::factory()->create();
                
                $author = Author::where('name', $authorName)->first();
                if (!$author) {
                    $author = Author::factory()->create(['name' => $authorName]);
                }
                $book->authors()->attach($author);
                $user->books()->attach($book);
            }
        }
    }
}
