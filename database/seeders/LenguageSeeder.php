<?php

namespace Database\Seeders;

use App\Models\Lenguage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LenguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lenguages = [['label' => 'html'], ['label' => 'css'], ['label' => 'sass'], ['label' => 'bottstrap'], ['label' => 'js'], ['label' => 'vue'], ['label' => 'php'], ['label' => 'sql']];

        foreach ($lenguages as $leng) {
            $new_leng = new Lenguage();
            $new_leng->label = $leng['label'];
            $new_leng->save();
        }
    }
}
