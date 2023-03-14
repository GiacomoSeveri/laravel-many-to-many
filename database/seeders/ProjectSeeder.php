<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 5; $i++) {
            $newProject = new Project();
            // $newProject->image = $faker->imageUrl(1140, 500);
            $newProject->title = $faker->text(10);
            $newProject->content = $faker->paragraphs(2, true);
            $newProject->collab = $faker->text(8);
            $newProject->slug = Str::slug($newProject->title, '-');
            $newProject->save();
        }
    }
}
