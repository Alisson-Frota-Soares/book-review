<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Review;
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
        // User::factory(10)->create();

        Book::factory(33)->create()->each(function ($book){
            $numReviews = random_int(5, 30);

            Review::factory()->count($numReviews)->good()->for($book)->create();
        });

        Book::factory(33)->create()->each(function ($book){
            $numReviews = random_int(5, 30);

            Review::factory()->count($numReviews)->average()->for($book)->create();
        });

        Book::factory(34)->create()->each(function ($book){
            $numReviews = random_int(5, 30);

            Review::factory()->count($numReviews)->bad()->for($book)->create();
        });

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
