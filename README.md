# Blog System

## Table of Contents
1. [About](#About)
2. [Features](#Features)
3. [Demonstration](#Demonstration)
4. [Installation](#Installation)
5. [Optional](#Optional)
6. [Technologies](#Technologies)

## About

A simple blog system built with Laravel 11 and PostgreSQL, featuring comprehensive test coverage using PHPUnit. This application allows users to register, create, edit, and delete blog posts, comment on posts, categorize posts, and search for posts by keywords.

## Features

- **User registration and authentication**
- **CRUD operations** for blog posts
- **Commenting** on posts (only by logged-in users)
- **Assigning categories** to posts (Many-to-Many relationship)
- **Keyword search** for posts (title and body)
- **Access control** using Laravel Middleware
- **Input validation** and XSS protection

## Demonstration
- Blog Posts![Blog Posts](https://i.imgur.com/9EUq8Oe.png)
- Create Post ![Create Post](https://i.imgur.com/MpeeIGj.png)
- Add Comments ![Add Comments](https://i.imgur.com/C6BUIxJ.png)

## Installation
<ol>
<li>Clone this repository - <code>https://github.com/RihardsTirums/blog-system.git</code></li>
<li>Change direcory <code>cd blog-system</code></li>
<li>Install the dependencies - <code>composer install</code></li>
<li>Install the dependencies - <code>npm install</code></li>
<li>Rename <code>.env.example</code> file to <code>.env</code>
<li>Create a Postgres SQL database and new schema named <code>blog_system</code> and then add all the credentials into the ".env" file about your database you created
<ul>
    <li>DB_CONNECTION=pgsql</li>
    <li>DB_HOST=127.0.0.1</li>
    <li>DB_PORT=5432</li>
    <li>DB_DATABASE=blog_system</li>
    <li>DB_USERNAME</li>
    <li>DB_PASSWORD</li>
</ul>
<li>Run this command into terminal <code>php artisan key:generate</code> to generate encryption key</li>
<li>Run Laravel database migrations <code>php artisan migrate</code></li>
<li>Run Laravel database seeders <code>php artisan db:seed</code></li>
<li>Run this command into terminal <code>npm run dev</code>
<li>Open second terminal and run <code>php artisan serve</code> to run development server
<li>Click on link http://127.0.0.1:8000 to open project into web browser</li>

![Serve](https://i.imgur.com/2HIdcRy.png)
</ol>

## Optional
- If you want to run the tests, follow these steps:
<ol> <li>Create a new separate database for the testing environment named <code>blog_test</code>.</li> <li>Update the <code>phpunit.xml</code> file with testing database credentials:</li> <ul> <li><code>env name="DB_CONNECTION" value="pgsql"</code></li> <li><code>env name="DB_HOST" value="127.0.0.1"</code></li> <li><code>env name="DB_PORT" value="5432"</code></li> <li><code>env name="DB_DATABASE" value="blog_test"</code></li> <li><code>env name="DB_USERNAME" value="your_user_name"</code></li> <li><code>env name="DB_PASSWORD" value="your_password"</code></li> </ul> <li>Ensure that the database user specified in <code>phpunit.xml</code> has full ownership and all necessary privileges on the <code>blog_test</code> database and its schema. This is important for running tests that involve creating, modifying, or deleting database objects.</li> <li>Run tests with <code>php artisan test</code>.</li> </ol>

**Additional Note**:
Make sure the user you specify in phpunit.xml for DB_USERNAME has full ownership and permissions on the blog_test database. Without these, tests that require database interactions may fail due to insufficient privileges.

## Technologies
<ul>
<li>Laravel v 11</li>
<li>PHP 8.3.9</li>
<li>PostgreSQL 14.12</li>
<li>Composer 2.7.7</li>
<li>Tailwind CSS</li>
<li>JavaScript</li>
</ul>