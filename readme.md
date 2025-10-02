# Task Manager API - Laravel Backend

![PHP](https://img.shields.io/badge/PHP-8.1%2B-777BB4?style=for-the-badge&logo=php)
![Laravel](https://img.shields.io/badge/Laravel-10.x-FF2D20?style=for-the-badge&logo=laravel)
![MySQL](https://img.shields.io/badge/MySQL-8.0%2B-4479A1?style=for-the-badge&logo=mysql)
![License](https://img.shields.io/badge/License-MIT-yellow.svg?style=for-the-badge)

A secure and robust RESTful API for a Task Management application, built with PHP/Laravel and MySQL. This project provides all the necessary backend functionality, including user registration, login, and full CRUD (Create, Read, Update, Delete) operations for tasks, secured by JWT (JSON Web Token) authentication.

## ✨ Key Features

-   **RESTful API:** Clean, predictable, and resource-oriented API endpoints.
-   **MVC Architecture:** Organized and maintainable codebase following the Model-View-Controller pattern.
-   **JWT Authentication:** Secure user authentication and authorization using `tymon/jwt-auth`.
-   **CRUD Operations:** Full support for creating, reading, updating, and deleting tasks.
-   **Database Migrations & Seeding:** Easy database setup and population with sample data.
-   **Route-Model Binding:** Eloquent and efficient routing.
-   **Validation:** Server-side request validation to ensure data integrity.

## 🛠️ Tech Stack

-   **Backend:** PHP 8.1+, Laravel 10.x
-   **Database:** MySQL
-   **Authentication:** [tymon/jwt-auth](https://github.com/tymondesigns/jwt-auth)

## 🚀 Getting Started

Follow these instructions to get a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

-   PHP >= 8.1
-   Composer
-   MySQL Server
-   A code editor (e.g., VS Code)

### Installation

1.  **Clone the repository:**
    ```bash
    git clone [https://github.com/your-username/your-repo-name.git](https://github.com/your-username/your-repo-name.git)
    cd your-repo-name
    ```

2.  **Install dependencies:**
    ```bash
    composer install
    ```

3.  **Create your environment file:**
    ```bash
    cp .env.example .env
    ```

4.  **Generate the application key:**
    ```bash
    php artisan key:generate
    ```

5.  **Configure your `.env` file:**
    Update the `DB_*` variables with your MySQL database credentials.
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=task_manager_db
    DB_USERNAME=root
    DB_PASSWORD=your_password
    ```

6.  **Generate the JWT secret key:**
    ```bash
    php artisan jwt:secret
    ```

7.  **Run database migrations and seeders:**
    This will create the necessary tables (`users`, `tasks`, etc.) and populate them with some dummy data.
    ```bash
    php artisan migrate --seed
    ```

8.  **Start the development server:**
    ```bash
    php artisan serve
    ```
    The API will be available at `http://127.0.0.1:8000`.

##  API Endpoints

All endpoints are prefixed with `/api`. Authenticated routes require a `Bearer Token` in the `Authorization` header.

### Authentication

| Method | Endpoint              | Description                    | Authentication |
| :----- | :-------------------- | :----------------------------- | :------------- |
| `POST` | `/api/register`      | Register a new user.           | None           |
| `POST` | `/api/login`         | Log in and receive a JWT token.| None           |
| `POST` | `/api/logout`        | Log the user out (invalidates token). | **Required** |
| `POST` | `/api/refresh`       | Refresh an expired JWT token.  | **Required** |
| `GET`  | `/api/{id}/profile`  | Get the current authenticated user's profile. | **Required** |

### Tasks (CRUD)

| Method   | Endpoint        | Description                           | Authentication |
| :------- | :-------------- | :------------------------------------ | :------------- |
| `GET`    | `/tasks`        | Get all tasks for the logged-in user. | **Required** |
| `POST`   | `/tasks`        | Create a new task.                    | **Required** |
| `GET`    | `/tasks/{id}`   | Get a single task by its ID.          | **Required** |
| `PUT`    | `/tasks/{id}`   | Update a specific task.               | **Required** |
| `DELETE` | `/tasks/{id}`   | Delete a specific task.               | **Required** |

### Example Payloads

**Register User (`POST /api/auth/register`)**
```json
{
    "name": "John Doe",
    "email": "john.doe@example.com",
    "password": "password123",
    "password_confirmation": "password123"
}



Contributions are what make the open-source community such an amazing place to learn, inspire, and create. Any contributions you make are greatly appreciated.

Fork the Project

Create your Feature Branch (git checkout -b feature/AmazingFeature)

Commit your Changes (git commit -m 'Add some AmazingFeature')

Push to the Branch (git push origin feature/AmazingFeature)

Open a Pull Request

📜 License
Distributed under the MIT License. See LICENSE for more information.