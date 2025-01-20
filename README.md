# Laravel Messenger

## 📜 Описание проекта
Это простой мессенджер, разработанный с использованием Laravel. Он позволяет пользователям:
- Регистрироваться и входить в систему.
- Отправлять и получать сообщения.
- Добавлять пользователей в друзья.
- Удалять сообщения.

## 🚀 Функционал
- Регистрация и авторизация.
- CRUD операции для сообщений.
- Система добавления/удаления друзей.


## 🛠️ Технологии
- **Backend**: Laravel 11
- **Frontend**: Blade 
- **База данных**: MySQL
  

## 📂 Структура проекта
- `/app/Models`: Модели
- `/app/Http/Controllers`: Контроллеры
- `/routes/web.php`: Маршруты
- `/resources/views`: Шаблоны (Blade)
- `/database/migrations`: Миграции базы данных

## 🔧 Установка проекта
1. Клонируйте репозиторий:
    ```bash
    git clone https://github.com/DmytroBuzhylov/Messanger
    cd laravel-messenger
    ```
2. Установите зависимости:
    ```bash
    composer install
    npm install && npm run dev
    ```
3. Настройте `.env` файл:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
4. Настройте базу данных в `.env`:
    ```
    DB_DATABASE=messenger
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
    ```
5. Выполните миграции:
    ```bash
    php artisan migrate 
    ```
6. Запустите локальный сервер:
    ```bash
    php artisan serve
    ```

## 📚 Использование
1. Перейдите на `http://localhost:8000`.
2. Зарегистрируйтесь или войдите в систему.
3. Добавьте пользователя в друзья.
4. Отправьте сообщение.


## 🛡️ Безопасность
- Встроенная защита CSRF.
- Валидация пользовательских данных.
- Пароли хранятся с использованием хеша (bcrypt).

## ✍️ Автор
- **Dmytro**



