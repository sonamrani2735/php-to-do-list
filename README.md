# PHP To-Do List (Simple CRUD)

A minimal PHP + MySQL to-do list implementing CRUD operations using PDO (prepared statements).

Requirements:
- PHP 7.4+ with PDO MySQL
- MySQL / MariaDB
- A web server (Apache, Nginx) or PHP built-in server for testing

Setup:
1. Create the database and table:
   - Import `create-tasks.sql` or run the SQL from the repository in your MySQL client.
2. Edit `db.php` and set DB_HOST, DB_NAME, DB_USER, DB_PASS.
3. Put files in your webroot (index.php, create.php, edit.php, delete.php, db.php, style.css, create-tasks.sql).
4. Open in browser: http://localhost/path/to/index.php
   - Or run: `php -S 127.0.0.1:8000` in the folder and visit `http://127.0.0.1:8000`

Notes / next improvements:
- Add CSRF protection and stronger validation.
- Add pagination, filtering, and AJAX for better UX.
- Add authentication (per-user tasks).
- Use migrations (Phinx) or an ORM for larger apps.
