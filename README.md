# Order-Submission Service project

Order Service designed & developed to submit order with products has the following applied:-

1. authorization-role based system (Admin - User).
2. Multi auth guard.
3. jwt authentication token.
4. Send SMS messages after submit order (Nexom).
5. Add Event & listener to dispatch events.
6. Apply repository design pattern as a DB layer.
7. Applied SOLID principle to make project with clean arcitecture.

## Run the project

1. Clone repository

    ```
        1.1- git clone https://github.com/mostafa-medht/Order-Endpoints.git
        1.2- cd project-directory
        1.3- composer install
        1.4- npm install
        1.5- cp .env.example .env
        1.6- php artisan key:generate
    ```

2. Database
   2.1 Create database in DBMS via this query

    ```sql - mysql
        create database `order-endpoints`;
    ```

    2.3 Database Configuration in .env file in application root

    ```
        DB_DATABASE=order-endpoints
        DB_USERNAME=
        DB_PASSWORD=
        Put your database user after DB_USERNAME, and your user password after DB_PASSWORD
    ```

    2.4 Migrate & seed

    ```
        php artisan migrate
        php artisan db:seed

        or

        php artisan migrate --seed
    ```

    2.5 Run the project

    ```
        php artisan serve
    ```

---

## Contributing

-   [Mostafa Medhat](https://github.com/mostafa-medht)

## When contributing to this repository, please first discuss the change you wish to make via issue.

## Contributing Guidelines

1. **Create** a new issue discussing what changes you are going to make.
2. **Fork** the repository to your own Github account.
3. **Clone** the project to your own machine.
4. **Create** a branch locally with a succinct but descriptive name.
5. **Commit** Changes to the branch.
6. **Push** changes to your fork.
7. **Open** a Pull Request in

---

## Resources

1. **JwtAuth** (https://jwt-auth.readthedocs.io/en/develop/laravel-installation/)

2. **SMSNexom** (https://github.com/Nexmo/nexmo-laravel)

## License

Order Service project Copyright © 2021 Mostafa Medht. It is a open software and.
