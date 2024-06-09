<p align="center">
  <img src="https://raw.githubusercontent.com/fumeapp/laranuxt/main/resources/laranuxt.png" width="200" />
</p>

# laravel-nuxt-template
This repository provides a starter template for building web applications using Laravel as the backend and Nuxt.js as the frontend framework.


## This project built with Laravel 11 + Nuxt 3 <br>

- This template build with Laravel v11.0 & Nuxt v3.11 
- This template Support Pinia State Management
- If you like this work you can <a href="https://github.com/akramghaleb">see more here</a>

## Features
1. **Technology Stack:** This release leverages **Laravel version 11.0** for the backend framework and **Nuxt version 3.11** for the frontend framework. Laravel provides a robust foundation for developing web applications with its elegant syntax and powerful features, while Nuxt.js enhances the development experience by offering a framework for building server-side rendered Vue.js applications with features like automatic code splitting, hot module replacement, and more.
2. **State Management:** The release incorporates **Pinia version 2.1** for state management. Pinia is a modern and lightweight state management solution for Vue.js applications. It provides a simple and intuitive API for managing application state, making it easier to organize and manage complex data in Vue.js applications. With Pinia v2.1, developers can take advantage of improved features and optimizations for state management in their applications.
3. **Persisted State:** The release introduces support for persisted state, allowing for the storage of application state data in the local storage of the user's browser. This feature ensures that user data persists even after the browser is closed or refreshed, enhancing the user experience by providing continuity and preserving important application data. By leveraging local storage, developers can create more resilient and user-friendly applications that remember user preferences and maintain session state across sessions.

## Installation

Clone the repository

```
git clone https://github.com/akramghaleb/laravel-nuxt-template.git
```

Switch to the repo folder

```
cd laravel-nuxt-template
```

switch to frontend folder (nuxt app)

```
cd frontend

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

switch to backend folder (laravel app)

```
cd ../backend
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

<br>

---

[Github Repo](https://github.com/akramghaleb/laravel-nuxt-template)

Thanks,

If you enjoy my work, consider buying me a coffee to keep the creativity flowing!

<a href="https://www.buymeacoffee.com/akramghaleb" target="_blank"><img src="https://cdn.buymeacoffee.com/buttons/v2/default-red.png" alt="Buy Me A Coffee" width="150" ></a>
<br><br>
