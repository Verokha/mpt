Окружение: php8.3, mysql, node.js 20

1.  Заполняем файл .env из образца .env.example
    APP_URL - ссылка на сайт
    Подключение к БД:
    DB_CONNECTION=
    DB_HOST=
    DB_PORT=
    DB_DATABASE=
    DB_USERNAME=
    DB_PASSWORD=

    SMTP почта:
    MAIL_MAILER=smtp
    MAIL_HOST=
    MAIL_PORT=465
    MAIL_USERNAME=
    MAIL_PASSWORD=
    MAIL_ENCRYPTION=tls
    MAIL_FROM_ADDRESS=""
    MAIL_FROM_NAME="${APP_NAME}"

    Гугл авторизация:
    SCOUT_DRIVER=null
    GOOGLE_CLIENT_ID=
    GOOGLE_CLIENT_SECRET=
    GOOGLE_REDIRECT_URL="${APP_URL}/google/callback"

2.  Ввыполнить команду composer install
3.  Выполнить команду npm install
4.  Выполнить команду npm run build
5.  Выполнить команду php artisan migrate
6.  Выполнить команду php artisan storage:link
7.  Выполнить команду php artisan orchid:admin {name} {email} {password} под этой учетной записью будет доступен пользователь с ролью Администратор. Можно начать заполнять контент в /admin.
8.  Команда php artisan app:flush-archive-request {day} очищает архивные заявки. Можно выставить крон задачу на ночь что бы каждый день происходила очистка. {day} - кол-во дней от сегодняшнего дня когда можно удалять заявки. К примеру, сегодня 01.06.24. Команда php artisan app:flush-archive-request 1 будет удалять все завяки, которые имеют дату создания 31.05.2024 и старше.
