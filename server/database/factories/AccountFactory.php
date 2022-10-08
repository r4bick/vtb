<?php

namespace Database\Factories;

use App\Models\Account;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AccountFactory extends Factory
{
    protected $model = Account::class;
    public static array $stubFirstNames = [
        'Алексей',
        'Александр',
        'Иван',
        'Петр',
        'Василий',
        'Федор',
        'Максим',
        'Егор',
        'Виктор',
        'Анна',
        'Елизавета',
    ];
    public static array $stubLastNames = [
        'Петров',
        'Иванов',
        'Сидоров',
        'Савичев',
        'Егоров',
        'Баженов',
        'Беседин',
        'Крахмаль',
        'Кулаченков',
        'Степанов',
        'Кувайтов',
    ];
    public static array $stubFamilyNames = [
        'Викторович',
        'Петрович',
        'Степанович',
        'Александрович',
        'Вадимович',
        'Олегович',
        'Николаевич',
        'Арсентьевич',
    ];


    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->randomElement(self::$stubFirstNames),
            'last_name' => $this->faker->randomElement(self::$stubLastNames),
            'family_name' => $this->faker->randomElement(self::$stubFamilyNames),
        ];
    }
}
