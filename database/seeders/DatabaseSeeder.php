<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Story;
use App\Models\Genre;
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

        User::create([
            'name' => 'Lili',
            'username' => 'lilidigidaw',
            'email' => 'lili@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        User::create([
            'name' => 'Alien',
            'username' => 'alien',
            'email' => 'alien@gmail.com',
            'password' => bcrypt('12345678')
        ]);

        User::create([
            'name' => 'Boneka',
            'username' => 'boneka',
            'email' => 'boneka@gmail.com',
            'password' => bcrypt('12345678')
        ]);

        User::create([
            'name' => 'Unicorn',
            'username' => 'unicorn',
            'email' => 'unicorn@gmail.com',
            'password' => bcrypt('12345678')
        ]);

        User::create([
            'name' => 'xie lian',
            'username' => 'flower',
            'email' => 'flower@gmail.com',
            'password' => bcrypt('12345678')
        ]);

        Genre::create([
            'name' => 'fantasy',
            'slug' => 'fantasy'
        ]);

        Genre::create([
            'name' => 'action',
            'slug' => 'action'
        ]);

        Genre::create([
            'name' => 'romance',
            'slug' => 'romance'
        ]);

        Genre::create([
            'name' => 'fanfiction',
            'slug' => 'fanfiction'
        ]);

        Genre::create([
            'name' => 'humor',
            'slug' => 'humor'
        ]);

        Story::create([
            'title' => 'Cerita Pertama',
            'slug' => 'cerita-pertama',
            'sinopsis' => 'sinopsis cerita pertama agak panjang wow',
            'genre_id' => 1,
            'user_id' => 1
        ]);

        Story::create([
            'title' => 'Cerita Kedua',
            'slug' => 'cerita-kedua',
            'sinopsis' => 'sinopsis cerita kedua agak panjang woho',
            'genre_id' => 2,
            'user_id' => 2
        ]);

        Story::create([
            'title' => 'Cerita Ketiga',
            'slug' => 'cerita-ketiga',
            'sinopsis' => 'sinopsis cerita ketiga agak panjang yipi',
            'genre_id' => 3,
            'user_id' => 1
        ]);

        Story::create([
            'title' => 'Cerita Keempat',
            'slug' => 'cerita-keempat',
            'sinopsis' => 'sinopsis cerita keempat agak panjang yes',
            'genre_id' => 3,
            'user_id' => 1
        ]);

        Story::create([
            'title' => 'Cerita Kelima',
            'slug' => 'cerita-kelima',
            'sinopsis' => 'sinopsis cerita kelima agak panjang damn',
            'genre_id' => 3,
            'user_id' => 1
        ]);


    }
}
