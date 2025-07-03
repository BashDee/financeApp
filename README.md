# Finance App

A modern personal finance application to help you track and categorize your expenses as "Needs" and "Wants". Built with Laravel, Inertia.js, and Vue 3, this app provides a clean dashboard, easy data entry, and a responsive UI.

## Features

- **Needs & Wants Tracking:** Add, view, and remove your financial needs and wants, each with a title, description, and amount.
- **Dashboard:** Visual summary of your needs and wants, including totals and a doughnut chart.
- **Authentication:** Secure registration, login, and email verification.
- **Profile & Settings:** Update your profile, password, and appearance preferences.
- **Responsive UI:** Built with Vue 3, Tailwind CSS, and Vite for a fast, modern experience.

## Tech Stack

- **Backend:** Laravel 12 (PHP 8.2+)
- **Frontend:** Vue 3, Inertia.js, TypeScript
- **Styling:** Tailwind CSS
- **Build Tools:** Vite
- **Testing:** PHPUnit, ESLint, Prettier

## Getting Started

### Prerequisites
- PHP 8.2+
- Composer
- Node.js (v18+ recommended) & npm
- SQLite (default), MySQL, or PostgreSQL

### Installation

1. **Clone the repository:**
   ```sh
   git clone <your-repo-url>
   cd financeApp
   ```
2. **Install PHP dependencies:**
   ```sh
   composer install
   ```
3. **Install Node dependencies:**
   ```sh
   npm install
   ```
4. **Copy and configure environment file:**
   ```sh
   cp .env.example .env
   # Edit .env to set your database and mail settings
   ```
5. **Generate application key:**
   ```sh
   php artisan key:generate
   ```
6. **Run migrations:**
   ```sh
   php artisan migrate
   ```
7. **(Optional) Seed the database:**
   ```sh
   php artisan db:seed
   ```

### Running the App

- **Development server:**
  ```sh
  npm run dev
  # In another terminal
  php artisan serve
  ```
- Or use the combined script:
  ```sh
  composer run dev
  ```

Visit [http://localhost:8000](http://localhost:8000) in your browser.

## Testing

- **Backend tests:**
  ```sh
  php artisan test
  ```
- **Frontend linting & formatting:**
  ```sh
  npm run lint
  npm run format
  ```

## Folder Structure

- `app/` - Laravel backend (controllers, models, policies)
- `resources/js/` - Vue 3 frontend (pages, components, layouts)
- `routes/` - Laravel route definitions
- `database/` - Migrations, seeders, factories

## License

This project is open-sourced under the MIT license.

## Credits

Based on the [Laravel Vue Starter Kit](https://github.com/laravel/vue-starter-kit). 