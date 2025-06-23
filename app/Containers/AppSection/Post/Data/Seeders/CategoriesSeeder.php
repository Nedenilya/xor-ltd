<?php

namespace App\Containers\AppSection\Post\Data\Seeders;

use App\Containers\AppSection\Post\Models\Category;
use App\Ship\Parents\Seeders\Seeder as ParentSeeder;

final class CategoriesSeeder extends ParentSeeder
{
    public function run(): void
    {
        if (app()->runningUnitTests()) {
            return;
        }

        $categories = [
            'Новости',
            'Статьи',
            'Технологии',
            'Разработка',
            'Маркетинг',
            'Дизайн',
            'События',
        ];

        foreach ($categories as $name) {
            Category::firstOrCreate(['name' => $name]);
        }
    }
} 