# Corner Store POS - TFA6

A database-backed version of the four-page Corner Store POS project for IT0049 Technical Formative Assessment 6, **From Arrays to Eloquent**.

This version keeps the TFA5 layout, navigation, and routes. Customer and user records now come from a database through Eloquent models instead of arrays in the controllers.

## Requirements

- PHP 8.3 or newer with Laravel's required extensions
- Composer 2
- SQLite support (`pdo_sqlite` and `sqlite3`)

The pages use plain CSS in `public/css/style.css`. Node.js and npm are not needed.

## Run locally

Extract this project into its own folder. Open a terminal in the folder containing `artisan` and `composer.json`, then run:

```sh
composer install
composer run setup
php artisan serve
```

Open **http://127.0.0.1:8000** in your browser.

The setup command copies `.env.example` to `.env` if needed, generates an application key, creates `database/database.sqlite`, and runs the migrations and seeders. It creates five customer records and five user records.

Use a **new database file** for this TFA6 version. Its migrations describe the required TFA6 schema directly, so do not reuse TFA5's database or copy over TFA5's `.env`. The original TFA5 project can stay in a separate folder.

Run setup once on a fresh installation. To run the seeders again later, use:

```sh
php artisan db:seed
```

The seeders update existing sample records by email or username, so running them again does not duplicate the sample accounts. They do not remove other records you have added.

If PHP reports a missing extension, check the configuration used by your terminal with `php --ini` and the enabled extensions with `php -m`.

## Database schema

| Table | Activity fields |
| --- | --- |
| `customers` | `full_name`, `email`, `phone` |
| `users` | `username` (unique), `full_name` |

Both tables also have an `id`, `created_at`, and `updated_at`, following Laravel's usual model conventions. Phone numbers are stored as text so leading zeroes are preserved.

The TFA5 address, role, and status fields have been removed to match the TFA6 worksheet. The User model represents directory records; this activity does not include a sign-in system or passwords.

## Pages

| URL | Controller method | View |
| --- | --- | --- |
| `/` | `PageController::index` | `home.blade.php` |
| `/about` | `PageController::about` | `about.blade.php` |
| `/customers` | `CustomerController::index` | `customers/index.blade.php` |
| `/users` | `UserController::index` | `users/index.blade.php` |

Every page has links to all four pages. Account tables use `@foreach` and display the retrieved model properties with Blade's escaped output. Empty tables show a short message.

## How the records reach the page

1. A route in `routes/web.php` selects the controller method.
2. The controller calls `Customer::orderBy('id')->get()` or `User::orderBy('id')->get()`.
3. Eloquent retrieves the saved rows and returns a collection of model objects.
4. The controller passes the collection to the Blade view.
5. The view loops through the records and displays fields such as `$customer->full_name` and `$user->username`.

Changing a database record changes what the corresponding listing displays on the next request. Sample arrays exist only in the seeders, where they are inserted into the database.

## Main files

```text
app/Http/Controllers/
  PageController.php
  CustomerController.php
  UserController.php
app/Models/
  Customer.php
  User.php
database/migrations/
  0001_01_01_000000_create_users_table.php
  2026_11_21_000001_create_customers_table.php
database/seeders/
  DatabaseSeeder.php
  CustomerSeeder.php
  UserSeeder.php
database/factories/
  CustomerFactory.php
  UserFactory.php
resources/views/
  layouts/app.blade.php
  home.blade.php
  about.blade.php
  customers/index.blade.php
  users/index.blade.php
public/css/style.css
routes/web.php
tests/Feature/
```

The migration and seeder files recreate the sample database, so a separate SQL export is not required. The generated `.env`, SQLite file, and `vendor` folder are excluded from Git.

## Inspect and test

```sh
php artisan route:list --except-vendor
php artisan migrate:status
php artisan test
```

The tests cover the four pages and navigation, seeded records, database changes appearing in both account lists, empty lists, escaped names, the required table fields, duplicate username rejection, and repeated seeding without duplicate accounts. Tests use an in-memory SQLite database.

The included GitHub Actions workflow runs the tests on pushes and pull requests.

## Upload to GitHub

Create a new empty repository and upload the contents of this project folder. Keep `artisan`, `composer.json`, and `README.md` at the repository root. Include dotfiles such as `.env.example`, `.gitignore`, and `.github/workflows/tests.yml`.

Do not upload only the ZIP file. Do not upload your generated `.env`, SQLite database, or `vendor` folder.

If using Git, replace the repository URL below with your own:

```sh
git init
git add .
git commit -m "Replace account arrays with Eloquent models"
git branch -M main
git remote add origin https://github.com/YOUR-USERNAME/YOUR-REPOSITORY.git
git push -u origin main
```

Add your student or group details to this README if your professor requires them. This package is prepared for local use; no hosted deployment is included.

## References

- [Laravel migrations](https://laravel.com/docs/13.x/migrations)
- [Eloquent getting started](https://laravel.com/docs/13.x/eloquent)
- [Laravel database seeding](https://laravel.com/docs/13.x/seeding)
