<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Todo;

class TodosTableSeeder extends Seeder
{
    public function run(): void
    {
        Todo::create([
            'title' => 'Task 1',
            'description' => 'This is task 1',
            'completed' => false,
        ]);

        Todo::create([
            'title' => 'Task 2',
            'description' => 'This is task 2',
            'completed' => false,
        ]);

        Todo::create([
            'title' => 'Task 3',
            'description' => 'This is task 3',
            'completed' => true,
        ]);
    }
}
