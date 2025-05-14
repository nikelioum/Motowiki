<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MotoCategory;

class MotoCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $parent = MotoCategory::factory()->create(['title' => 'Category 1']);

        $child1 = MotoCategory::factory()->create([
            'title' => 'Category 2',
            'parent_id' => $parent->id,
        ]);

        $child2 = MotoCategory::factory()->create([
            'title' => 'Category 3',
            'parent_id' => $parent->id,
        ]);

        $subChild = MotoCategory::factory()->create([
            'title' => 'Subcategory 1',
            'parent_id' => $child2->id,
        ]);

        MotoCategory::factory()->create([
            'title' => 'Subsubcategory 1',
            'parent_id' => $subChild->id,
        ]);
    }
}
