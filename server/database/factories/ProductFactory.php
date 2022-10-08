<?php

namespace Database\Factories;

use App\Constants\ProductTypes;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public static array $stubProducts = [
        [
            'name' => 'Зонт',
            'description' => ' Прямой, как стрела, несгибаемый и немного консервативный зонт прекрасно подойдет, чтобы выразить уверенность и устойчивость компании.',
            'photo' => 'https://gifts.ru/id/184819',
            'price' => '400',
            'type' => ProductTypes::PHYSICAL,
            'features' => [
                'material' => 'полиэстер, 170T; металл; дерево',
                'size' => 'диаметр купола 104 см, длина 83 см',
                'package' => '86x18x30 см',
                'weight' => '0,87 кг'
            ],
        ],
        [
            'name' => 'Лонгслив',
            'description' => 'Футболка из спортивной сетки с длинным рукавом реглан и круглым вырезом. Низ изделия и низ рукавов с двойной отстрочкой, горловина обработана бейкой.',
            'photo' => 'https://gifts.ru/id/107338',
            'price' => '600',
            'type' => ProductTypes::PHYSICAL,
            'features' => [
                'material' => 'полиэстер 100%, плотность 140 г/м²',
                'size' => 'S–3XL',
                'package' => '30x30x40 см',
                'weight' => '0,6 кг'
            ],
        ],
        [
            'name' => 'Повербанк',
            'description' => <<<EOL
                Повербанк на 5000 мАч для твоего смартфона. Слот USB с поддержкой быстрой зарядки.
                Литий-ионный аккумулятор (Li-ion), емкость 2000 мАч
                Количество циклов заряда-разряда: не менее 350
            EOL,
            'photo' => 'https://gifts.ru/id/82015',
            'price' => '200',
            'type' => ProductTypes::PHYSICAL,
            'features' => [
                'package' => '33x22x30 см',
                'weight' => '0,3 кг'
            ],
        ],
        [
            'name' => 'Термокружка',
            'description' => 'Стакан с крышкой Color Cap Black — идеальный компаньон для тех, кто не стоит на месте. Благодаря оптимальным размерам стакан удобно брать с собой на учебу, работу или прогулку. Стакан подходит как для горячих, так и холодных напитков, абсолютно безопасен для здоровья и подлежит повторной переработке.',
            'photo' => 'https://gifts.ru/id/208375',
            'price' => '150',
            'type' => ProductTypes::PHYSICAL,
            'features' => [
                'package' => ' 33x22x30 см',
                'weight' => '0,3 кг'
            ],
        ],
        [
            'name' => 'Плед',
            'description' => 'Плед прошел обработку средствами антипилл и антистатик, препятствующими образованию катышков и частично снимающими статическое электричество. ',
            'photo' => 'https://gifts.ru/id/172773',
            'price' => '350',
            'type' => ProductTypes::PHYSICAL,
            'features' => [
                'package' => '40x22x40 см',
                'weight' => '0,5 кг'
            ],
        ],
        [
            'name' => 'Набор для пикника',
            'description' => 'Мягкий плед и яркий термос, которые пригодятся и на летней полянке, и в прохладном офисе: осталось только назначить место встречи.',
            'photo' => 'https://gifts.ru/id/198437',
            'price' => '650',
            'type' => ProductTypes::PHYSICAL,
            'features' => [
                'package' => '50x32x40 см',
                'weight' => '0,5 кг'
            ],
        ],
        [
            'name' => 'Магнитный антистресс',
            'description' => 'Металлические шарики на магнитной подставке помогут снять напряжение и стресс, отвлечься и расслабиться. Просто придайте горстке шариков любую форму. Фантазируйте без ограничений!',
            'photo' => 'https://gifts.ru/id/65496',
            'price' => '350',
            'type' => ProductTypes::PHYSICAL,
            'features' => [
                'package' => '20x32x40 см',
                'weight' => '0,8 кг'
            ],
        ],
        [
            'name' => 'Python разработчик (Skillbox)',
            'description' => 'Python — идеальный язык для новичка. Код на Python легко писать и читать, язык стабильно занимает высокие места в рейтингах популярности, а «питонисты» востребованы почти во всех сферах IT — программировании, анализе данных, системном администрировании и тестировании. Курс рассчитан на 10 месяцев.',
            'photo' => 'https://skillbox.ru/course/profession-python/',
            'price' => '13550',
            'type' => ProductTypes::DIGITAL,
            'features' => [],
        ],
        [
            'name' => 'Data-Scientist разработчик (Skillbox)',
            'description' => 'Освойте Data Science с нуля. Вы попробуете силы в аналитике данных, машинном обучении, дата-инженерии и подробно изучите направление, которое нравится вам больше. Отточите навыки на реальных проектах и станете востребованным специалистом.',
            'photo' => 'https://skillbox.ru/course/profession-data-analyst/',
            'price' => '15600',
            'type' => ProductTypes::DIGITAL,
            'features' => [],
        ],
        [
            'name' => 'Java-разработчик (Skillbox)',
            'description' => 'Java — один из самых популярных языков программирования в мире. На нём создают надёжные приложения для банков, IT-корпораций и стриминговых сервисов, разрабатывают интернет-магазины, игры и облачные решения. ',
            'photo' => 'https://skillbox.ru/course/profession-1c/',
            'price' => '15600',
            'type' => ProductTypes::DIGITAL,
            'features' => [],
        ],
    ];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'id' => Str::uuid(),
        ];
    }
}
