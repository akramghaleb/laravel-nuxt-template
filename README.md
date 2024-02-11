<p align="center">
  <img src="https://raw.githubusercontent.com/fumeapp/laranuxt/main/resources/laranuxt.png" width="200" />
</p>

# laravel-nuxt-template
This repository provides a starter template for building web applications using Laravel as the backend and Nuxt.js as the frontend framework.


## This project built with Laravel 10 + Nuxt 3 <br>

- This template build with Laravel v10.10 & Nuxt v3.10 
- This template Support Pinia State Management
- If you like this work you can <a href="https://github.com/akramghaleb">see more here</a>

## Installation

Clone the repository

```
git clone https://github.com/akramghaleb/laravel-nuxt-template.git
```

Switch to the repo folder

```
cd laravel-nuxt-template
```

switch to client folder (nuxt app)

```
cd client

cp .env.example .env
```

Make sure to install the dependencies:
```bash
# npm
npm install

# pnpm
pnpm install

# yarn
yarn install

# bun
bun install
```

Build your code:

```bash
# npm
npm run generate

# pnpm
pnpm run generate

# yarn
yarn generate

# bun
bun run generate
```

switch to laravel folder (laravel app)

```
cd ../laravel
```


Install all the dependencies using composer

```
composer install
```

Copy the example env file and make the required configuration changes in the .env file

```
cp .env.example .env
```

Generate a new application key

```
php artisan key:generate
```

Run the database migrations (**Set the database connection in .env before migrating**)

```
php artisan migrate
```

Start the local development server

```
php artisan serve
```

You can now access the server at http://localhost:8000

<br><br>
