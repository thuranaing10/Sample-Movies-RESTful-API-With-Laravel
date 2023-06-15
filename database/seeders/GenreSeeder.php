<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Genre::create([
            'name' => 'Love'
        ]);
        Genre::create([
            'name' => 'Comedy'
        ]);
        Genre::create([
            'name' => 'Love'
        ]);
    }
}
