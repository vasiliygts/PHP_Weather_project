
# Weather Subscription API (Laravel + Docker + PostgreSQL)

Цей проєкт реалізує сервіс з API, який дозволяє підписуватись на регулярні оновлення прогнозу погоди у вказаному місті. 

## ✅ Основна функціональність:
- `POST /api/subscribe` — створення нової пiдписки
- `GET /api/confirm/{token}` — пiдтвердження email-пiдписки
- `GET /api/unsubscribe/{token}` — вiдписка вiд оновлень

## 📄 Стек технологiй:
- **PHP 8.2** (Laravel 11)
- **PostgreSQL**
- **Mailtrap** (для тестування email)
- **Docker + Docker Compose**

## 🌐 Swagger API
Документацiя доступна у `swagger.yaml`, сумiсна з [https://editor.swagger.io](https://editor.swagger.io)

## 🔧 Установка та запуск

### ⚡ 1. Клонування репозиторiю
```bash
git clone <repo_url>
cd WeatherProjectPHP
```

### 📦 2. Запуск через Docker Compose
```bash
docker compose up -d --build
```

### 🔐 3. Генерацiя ключа
```bash
docker compose exec app php artisan key:generate
```

### ⚙️ 4. Мiграцiї
```bash
docker compose exec app php artisan migrate
```

## 🚀 Тестування API

### 🔄 Subscribe:
```http
POST /api/subscribe
Content-Type: application/x-www-form-urlencoded

email=test@example.com&city=Kyiv&frequency=daily
```

### 🔗 Confirm:
```http
GET /api/confirm/{token}
```

### ❌ Unsubscribe:
```http
GET /api/unsubscribe/{token}
```

## 📧 Email-сповіщення
- Використано Mailtrap для тестування
- HTML-повідомлення надсилається з посиланням на підтвердження підписки

## 📋 Додатково реалізовано
- HTML-форма `/subscribe.html` у папці `public/`
- Виведення повідомлень після відправки

## 📚 Автор
- Виконавець: [Ім'я Прізвище]
- Email: example@email.com
- Дата: Травень 2025
