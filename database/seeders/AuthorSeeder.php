<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Author::create([
            'name' => 'William Goldman'
        ]);
        Author::create([
            'name' => 'John Grisham'
        ]);
        Author::create([
            'name' => 'Ian McEwan'
        ]);
    }
}
