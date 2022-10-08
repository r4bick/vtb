<?php

namespace Database\Factories;

use App\Constants\TaskCategories;
use App\Constants\TaskTypes;
use App\Models\Account;
use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public static array $stubTasks = [
        [
            'name' => 'Выступление с митапом по теме Java-разработки',
            'description' => 'Необходимо подготовить доклад по теме работы с Java-Core в т.ч. с использованием асинхронных запросов. Доклад должен содержать расширенный обзор выбранной темы, длительность выступления не менее 15 минут. Выступление на ежемесячной ВТБ Conf',
            'begin_at' => '25.10.2022',
            'end_at' => '30.11.2022',
            'type' => TaskTypes::USER,
            'category' => TaskCategories::MEETUP,
            'reward' => 250,
        ],
        [
            'name' => 'выступление с митапом по теме Python-разработки',
            'description' => 'Необходимо подготовить доклад по теме работы с глубоким обучением нейросетей с использованием TEnsor Flow. Доклад должен содержать расширенный обзор выбранной темы, длительность выступления не менее 15 минут. Выступление на ежемесячной ВТБ Conf.',
            'begin_at' => '25.10.2022',
            'end_at' => '30.11.2022',
            'type' => TaskTypes::USER,
            'category' => TaskCategories::MEETUP,
            'reward' => 310,
        ],
        [
            'name' => 'выступление с докладом на Heisenbug Conf 2022',
            'description' => <<<EOL
                Автоматизация тестирования;
                Инструменты и окружение для ручного и автоматизированного тестирования;
                Тестирование распределённых систем;
                Тестирование мобильных приложений;
                UX, Security;
                Нагрузочное тестирование, performance-тестирование, бенчмаркинг;
                AI в тестировании;

                Мы ориентированы на технологическую сторону тестирования, и, если вы в ней пока новичок, это лишний повод нас посетить. Никаких тест-кейсов, правил заведения багов и управления командами — только технологии, только хардкор!

                Ссылка на конференцию:https://heisenbug.ru/
            EOL,
            'begin_at' => '25.10.2022',
            'end_at' => '30.11.2022',
            'type' => TaskTypes::USER,
            'category' => TaskCategories::MEETUP,
            'reward' => 1000,
        ],
        [
            'name' => 'Обучение стажера в отделе фреймворку VueJS',
            'description' => 'К нам в отдел пришел стажер Витя Самойлов (IDXXXXX), необходимо подобрать с ним курс по VueJS и сопроводить его в процессе изучения замечательной технологии.',
            'begin_at' => '25.10.2022',
            'end_at' => '30.11.2022',
            'type' => TaskTypes::USER,
            'category' => TaskCategories::MENTORING,
            'reward' => 5000,
        ],
        [
            'name' => 'Обучение стажера в отделе фреймворку ReactNative',
            'description' => 'К нам в отдел пришел стажер Паша Петров (IDXXXXX), необходимо подобрать с ним курс по React Native и сопроводить его в процессе изучения замечательной технологии.',
            'begin_at' => '25.10.2022',
            'end_at' => '15.11.2022',
            'type' => TaskTypes::USER,
            'category' => TaskCategories::MENTORING,
            'reward' => 3000,
        ],
        [
            'name' => 'Записать курс по работе с MySQL',
            'description' => 'Ищем спикера для записи внутрикорпоративного курса по MySQL. Необходимо осветить основы данной темы. Записываем в студии в главном офисе во вторник и четверг после обеда. Подробности у ответственного.',
            'begin_at' => '25.10.2022',
            'end_at' => '15.11.2022',
            'type' => TaskTypes::USER,
            'category' => TaskCategories::EDUCATION,
            'reward' => 1000,
        ],
        [
            'name' => 'Обучение стажера в отделе Java Core',
            'description' => 'Необходимо подобрать и проконтроллировать прохождение курса по Java Core для Саши Александрова (IDXXXXX), необходимо подобрать с ним курс по Java Core  и сопроводить его в процессе изучения замечательной технологии.',
            'begin_at' => '25.10.2022',
            'end_at' => '15.11.2022',
            'type' => TaskTypes::USER,
            'category' => TaskCategories::MENTORING,
            'reward' => 3000,
        ],
        [
            'name' => 'Проведение обучения по работе с Figma для менеджеров проекта',
            'description' => 'Ищем спикера для проведения обучающего курса для наших менеджеров проектов по графическому редактору Figma. Курс проводится очно в 711 аудитории.',
            'begin_at' => '25.10.2022',
            'end_at' => '15.11.2022',
            'type' => TaskTypes::USER,
            'category' => TaskCategories::MEETUP,
            'reward' => 1500,
        ],
        [
            'name' => 'Публикация статьи на Habrahabr по методологиям разработки',
            'description' => 'Необходимо написать статью по современным методологиями разработки, применяемым в ВТБ и опубликовать её на Habrahabr с указанием корпоративного аккаунта ВТБ @VTB.',
            'begin_at' => '25.10.2022',
            'end_at' => '15.11.2022',
            'type' => TaskTypes::USER,
            'category' => TaskCategories::PUBLICATION,
            'reward' => 1500,
        ],
        [
            'name' => 'Публикация статьи на Habrahabr по микросервисам',
            'description' => 'Необходимо написать статью по микросвервисной архитектуре, применяемой в ВТБ и опубликовать её на Habrahabr с указанием корпоративного аккаунта ВТБ @VTB.',
            'begin_at' => '25.10.2022',
            'end_at' => '15.11.2022',
            'type' => TaskTypes::USER,
            'category' => TaskCategories::PUBLICATION,
            'reward' => 1500,
        ],
        [
            'name' => 'Создание ролика для новогоднего корпоратива от отдела',
            'description' => 'Необходимо сделать видеоролик о жизни в ВТБ, не более 3х минут. Со съемой поможет СММ-менеджер @regina_aa',
            'begin_at' => '25.10.2022',
            'end_at' => '15.11.2022',
            'type' => TaskTypes::DEPARTURE,
            'category' => TaskCategories::COMMUNITY,
            'reward' => 7000,
        ],
        [
            'name' => 'Разработка стикерпака для корпоративного канала в телеграм',
            'description' => 'Необходимо сделать стикерпак о жизни в ВТБ для корпоративного аккаунта и выслать СММ-менеджеру @regina_aa',
            'begin_at' => '25.10.2022',
            'end_at' => '15.11.2022',
            'type' => TaskTypes::USER,
            'category' => TaskCategories::COMMUNITY,
            'reward' => 500,
        ],
        [
            'name' => 'Наполнение базы знаний отдела',
            'description' => 'Необходимо наполнить базу знаний отдела статьями по разработки , охватывающими актуальные применяемые технологии',
            'begin_at' => '25.10.2022',
            'end_at' => '30.11.2022',
            'type' => TaskTypes::DEPARTURE,
            'category' => TaskCategories::COMMUNITY,
            'reward' => 10000,
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
            'like_number' => $this->faker->randomNumber(2),
            'dislike_number' => $this->faker->randomNumber(2),
        ];
    }
}
