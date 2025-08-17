## Basic Travel Insurance Quoting System

This is a basic travel insurance quoting system for the users to input their essential information, such as destination, travel dates, and coverage options. Upon submission of the form, the system will calculate and display a simple quoted price based on predefined factors.

## Features

-   Quoting form to input:
    -   Destination (Europe, Asia, America)
    -   Travel dates (start & end)
    -   Coverage options (Medical Expenses, Trip Cancellation)
    -   Number of travelers
-   Price calculation (based on user input data):
    -   Calculation logic - Number Of travelers X (destination + sum of coverage options)
-   Stores calculated quotes in the database.
-   View and remove existing quotes.
-   Prevents duplicate quotes for the same criteria.

## Tech Stack

-   **Backend**: Laravel 12
-   **Frontend**: Livewire + TailwindCSS
-   **Database**: SQLite / MySQL
-   **Testing**: PHPUnit (Unit + Feature tests)

## Project Structure

-   app/
-   Http/
    -   Livewire/QuotingForm.php # Handles quoting form UI logic
    -   Requests/StoreQuotationRequest.php # Validation
    -   Services/QuoteService.php # Business logic
    -   Repositories/QuoteRepository.php # Database operations
    -   resources/views/livewire/quoting-form.blade.php
-   tests
    -   QuoteServiceTest.php # Test quote calculation
    -   QuoteServiceDataTest.php # Test quoting feature

## Installation

1. Clone the repository
2. Go to the project folder
    - cd travel-insurance-quoting-system
3. Copy environment file
    - cp .env.example .env
4. Setup the local env (Docker)
    - Setup env using provided files inside docker-setup-files folder
    - Start containers:
        - docker-compose up -d
    - Install dependencies:
        - Run php bash - docker-compose exec php bash
            - php composer install
        - Run npm bash - docker-compose exec npm bash
            - npm install
            - npm run build (build the front end)
5. Setup the database:
    - If using SQLite
        - Create _database.sqlite_ in database folder
        - Add config data to .env
            - _DB_CONNECTION=sqlite_
            - _DB_DATABASE=/var/www/html/database/database.sqlite_ - add absolute path of the created database file
    - If using MYSQL
        - Add config data to .env
            - DB_CONNECTION=mysql
            - DB_HOST=mysql (according to the docker setup)
            - DB_PORT=3306 (according to the docker setup)
            - DB_DATABASE=intervest_quoting_system_db (according to the docker setup)
            - DB_USERNAME=intervest_quoting_system_user (according to the docker setup)
            - DB_PASSWORD=secret (according to the docker setup)
6. Run migrations and seeders:
    - _php artisan migrate --seed_
7. Open the project on browser
    - _http://localhost:8088/_
