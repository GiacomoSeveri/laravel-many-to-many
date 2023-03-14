<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $labels = ['FrontEnd', 'BackEnd', 'FillStack', 'Design'];

        foreach ($labels as $label) {
            $category = new Category();
            $category->label = $label;
            $category->save();
        }
    }
}
