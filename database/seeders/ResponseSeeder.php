<?php

namespace Database\Seeders;

use App\Models\Response;
use App\Models\ResponseMessage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResponseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $response1 = Response::create([
            'project_id' => 1,
            'author_id' => 1,
            'user_id' => 1
        ]);

        ResponseMessage::create([
            'response_id' => $response1->id,
            'user_id' => 3,
            'text' => 'Здравствуйте, я готов взяться за ваш проект в кратчайшие сроки. Специализируюсь на немецкой классической философии, знаю всё про Гёте. Буду рад поработать.'
        ]);

        ResponseMessage::create([
            'response_id' => $response1->id,
            'user_id' => 1,
            'text' => 'Здравствуйте, расскажите о вашем опыте в этом.'
        ]);

        ResponseMessage::create([
            'response_id' => $response1->id,
            'user_id' => 3,
            'text' => 'Сделал много работ. Жил в Германии, учился в институте Гёте в Берлине.'
        ]);

        $response2 = Response::create([
            'project_id' => 1,
            'author_id' => 2,
            'user_id' => 1
        ]);

        ResponseMessage::create([
            'response_id' => $response2->id,
            'user_id' => 4,
            'text' => 'Добрый день! Выполню вашу работу за 3 дня за ту цену, которую вы указали. Готов взяться прямо сейчас. Не могли бы вы написать пару пояснений?'
        ]);

    }
}
