<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::create([
            'name' => 'Family'
        ]);
        Tag::create([
            'name' => 'Dramatic'
        ]);
        Tag::create([
            'name' => 'Mysterious'
        ]);
        Tag::create([
            'name' => 'Fun'
        ]);
        Tag::create([
            'name' => 'Emotional'
        ]);
        Tag::create([
            'name' => 'Touching'
        ]);
    }
}
