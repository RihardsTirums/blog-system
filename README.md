# Blog System

## Table of Contents
1. [About](#About)
2. [Features](#Features)
2. [Demonstration](#Demonstration)
3. [Installation](#Installation)
4. [Technologies](#Technologies)

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
<li>Create a Postgres SQL database and new schema and then add all the credentials into the ".env" file about your database you created
<ul>
    <li>DB_CONNECTION=pgsql</li>
    <li>DB_HOST=127.0.0.1</li>
    <li>DB_PORT=5432</li>
    <li>DB_DATABASE</li>
    <li>DB_USERNAME</li>
    <li>DB_PASSWORD</li>
</ul>
<li>Run this command into terminal <code>php artisan key:generate</code> to generate encryption key
<li>Run Laravel database migrations <code>php artisan migrate</code></li>
<li>Run Laravel database seeders <code>php artisan db:seed</code></li>
<li>Run this command into terminal <code>npm run dev</code>
<li>Open second terminal and run <code>php artisan serve</code> to run development server
<li>Click on link http://127.0.0.1:8000 to open project into web browser</li>

![Serve](https://i.imgur.com/2HIdcRy.png)
</ol>

## Technologies
<ul>
<li>Laravel v 11</li>
<li>PHP 8.3.9</li>
<li>PostgreSQL 14.12</li>
<li>Composer 2.7.7</li>
<li>Tailwind CSS</li>
<li>JavaScript</li>
</ul>