# EverTask: Tasks for Today

A CodeIgniter 4 and MySQL implementation of the IT0049 Web System Technologies Technical Summative Assessment 1. The application uses first-run account setup, sign-in, protected pages, and database-backed task management in a responsive nature-inspired interface.

## Assessment checklist

- `/` displays only tasks whose `task_date` is today in Asia/Manila.
- `/tasks` displays all task records ordered by scheduled date.
- `/profile` displays the signed-in owner account read from MySQL.
- `/about` identifies the developer from the supplied assessment document.
- `TaskModel` and `UserModel` use Query Builder through CodeIgniter's Model class.
- User credentials are stored as password hashes, and task records are associated with their owner.
- Tasks can be added, edited, completed, and deleted from the interface.
- Views escape database and developer text with `esc()`; views contain no database queries.
- Navigation, task cards, empty states, keyboard focus, and reduced-motion preferences are included.

## Requirements

- PHP 8.2 or later with `mysqli`, `intl`, `mbstring`, `json`, `mysqlnd`, and `openssl` enabled.
- MySQL or MariaDB (XAMPP includes both Apache and MySQL; only MySQL needs to be running for the built-in PHP server).
- Composer is useful if dependencies need to be restored; the supplied project includes `vendor/`.

## Run with XAMPP on Windows

1. Extract this project folder to a location without special permission restrictions.
2. Open the XAMPP Control Panel and start **MySQL**.
3. Open `http://localhost/phpmyadmin` and choose **Import**.
4. For a new database, import `tasks_for_today.sql`. It creates the `ever_task` database, the task and user tables, and nine sample tasks. The supplied existing database has already been upgraded; on a separate older database, import `database-upgrade-auth-tasks.sql` once to add account security and task ownership while preserving existing records.
5. Copy `.env.example` to `.env` in the project root. Confirm the MySQL username/password in `.env` match your XAMPP installation. A typical local XAMPP setup uses username `root`, a blank password, and port `3306`; your setup may differ.
6. Open a terminal in the project folder and run `C:\xampp\php\php.exe -d extension=php_intl.dll -S 127.0.0.1:8083 -t public vendor\codeigniter4\framework\system\rewrite.php`, or double-click `Start-Tasks.cmd`.
7. Visit `http://localhost:8083/`. First-time setup lets you create the owner account; later visits show the sign-in page.

The PHP development server serves the `public/` folder with XAMPP PHP and loads `intl` in the same process. Stop it with **Ctrl+C** in the terminal. Keep MySQL running while using the app.

## Pages to check

- Today: `http://localhost:8083/`
- All tasks: `http://localhost:8083/tasks`
- Profile: `http://localhost:8083/profile`
- About: `http://localhost:8083/about`

On Today, confirm the list contains only records dated today. On All Tasks, add a task, edit it, mark it complete, and delete it. Profile displays the account details created during setup.

## Structure

```text
app/
  Controllers/       Auth, Home, Tasks, Profile, About, and shared BaseController
  Filters/           login protection for workspace routes
  Helpers/           initials helper for the demo avatar
  Models/            TaskModel and UserModel
  Views/              sign-in/setup screens, shared layout, task forms, and pages
  Config/             CodeIgniter application configuration and explicit routes
public/
  assets/css/         responsive nature-inspired interface
  assets/js/          small progressive-enhancement script
tasks_for_today.sql   schema and sample records
database-upgrade-auth-tasks.sql  one-time schema update for older installations
.env.example          local database settings template (copy to .env)
```
## Project documentation

See [Tasks for Today Project Documentation](Tasks-for-Today-Project-Documentation-Updated.docx) for the setup steps, page descriptions, database schema, and troubleshooting guide.




