#HNG Stage One Task Number Classification API

## Description
The **Number Classification API** is a simple RESTful API built with Laravel. It takes a number as input and returns interesting mathematical properties about it, along with a fun fact.

## Setup Instructions
### Prerequisites
- PHP (>=8.0)
- Composer
- Laravel (>=10)
- A web server (e.g., Apache, Nginx) or Laravel's built-in server

### Installation Steps
1. Clone the repository:
   ```sh
   git clone https://github.com/tomisin110/number-api.git
   ```
2. Navigate to the project directory:
   ```sh
   cd number-api
   ```
3. Install dependencies:
   ```sh
   composer install
   ```
4. Copy the environment file and configure your database:
   ```sh
   cp .env.example .env
   ```
5. Generate an application key:
   ```sh
   php artisan key:generate
   ```
6. Serve the application:
   ```sh
   php artisan serve
   ```
7. Your API should now be running at:
   ```
   http://127.0.0.1:8000
   ```

---

## API Documentation

### Base URL
```
https://number-api-d4ye5.kinsta.app/
```

### Endpoint
```
GET /api/classify-number?number={number}
```

### Request Example
```sh
curl -X GET "https://number-api-d4ye5.kinsta.app/api/classify-number?number=371" -H "Accept: application/json"
```

### Success Response (200 OK)
```json
{
    "number": 371,
    "is_prime": false,
    "is_perfect": false,
    "properties": ["armstrong", "odd"],
    "digit_sum": 11,
    "fun_fact": "371 is an Armstrong number because 3^3 + 7^3 + 1^3 = 371"
}
```

### Error Response (400 Bad Request)
```json
{
    "number": "invalid",
    "error": true
}
```

---

## Example Usage
- To check a number, send a GET request to:
  ```
  https://number-api-d4ye5.kinsta.app/api/classify-number?number=123
  ```
- The response will contain properties such as whether the number is prime, perfect, Armstrong, even, or odd.

---

## Additional Resources
For more information about Laravel, visit:
[Laravel Official Documentation](https://laravel.com/docs)

