<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Project::create([
            'name' => 'Написать диплом по немецкой философии',
            'about' => 'Помогите пожалуйста составить билеты для экзамена, до начала сессии) Образец прикрепил как должно быть, если что-то не понятно пишите объясню.',
            'award' => 5000,
            'short_about' => 'Помогите пожалуйста составить билеты для экзамена, до начала сессии)',
            'user_id' => 1
        ]);

        Project::create([
            'name' => 'Сделать курсовую до завтра',
            'about' => 'Умоляю помочь и сделать',
            'award' => 3000,
            'short_about' => 'Помогите пожалуйста составить билеты для экзамена',
            'user_id' => 2
        ]);
    }
}
