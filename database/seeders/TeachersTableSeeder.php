<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Teacher;

class TeachersTableSeeder extends Seeder
{
    public function run()
    {
        Teacher::create(['name' => 'John Doe']);
        Teacher::create(['name' => 'Jane Smith']);
    }
}
