<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    \App\Models\Category::create(['name' => 'Ficção']);
    \App\Models\Category::create(['name' => 'Técnico']);
    \App\Models\Category::create(['name' => 'Biografia']);
    }
}
