# Book Library Service

## Overview
The Book Library Service is a REST API built using the PHP Slim Framework, designed to manage users' book libraries. This service allows users to create, read, update, and delete books in their library.

## Features
- User authentication and management
- CRUD operations for books
- Clean architecture following best practices
- Docker readiness for easy deployment
- Test coverage for controllers and services

## Project Structure
```
book-library-service
├── app
│   ├── Controllers
│   ├── Models
│   ├── Repositories
│   ├── Services
│   └── Routes
├── config
├── public
├── tests
├── docker
├── docker-compose.yml
├── composer.json
├── phpunit.xml
└── README.md
```

## Installation

### Prerequisites
- Docker
- Docker Compose

### Setup
1. Clone the repository:
   ```
   git clone <repository-url>
   cd book-library-service
   ```

2. Build and run the Docker containers:
   ```
   docker-compose up --build
   ```

3. Access the application at `http://localhost:8080`.

## API Endpoints

### Books
- **GET /books**: Retrieve a list of all books.
- **GET /books/{id}**: Retrieve a specific book by ID.
- **POST /books**: Create a new book.
- **PUT /books/{id}**: Update an existing book.
- **DELETE /books/{id}**: Delete a book.

## Testing
To run the tests, use the following command:
```
docker-compose exec app vendor/bin/phpunit
```

## License
This project is licensed under the MIT License. See the LICENSE file for details.