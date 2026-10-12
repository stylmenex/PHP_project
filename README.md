# PHP Forum Project

A simple discussion forum built with PHP and MySQL/MariaDB as a learning project. Users can register, log in, publish posts and reply to them, and admins can manage users and delete posts.

> **Status: learning project, for local use only.** This is not production-ready. See [Known limitations](#known-limitations) for the issues I am aware of and plan to fix.

## Features

- User registration and login with PHP sessions
- Two roles: **user** and **admin**
- Create posts with a rich-text editor ([TinyMCE](https://www.tiny.cloud/))
- View a post and reply to it (replies require login)
- Admin panel:
  - Create new users, including other admins
  - Delete posts (replies are deleted together with the post)
- Navigation menu that changes depending on whether the visitor is logged in and on their role
- Styling in plain CSS
- Simple profile page showing the logged-in username

## Tech stack

| Area | Technology |
|------|------------|
| Backend | PHP 8.2 (mysqli) |
| Database | MySQL / MariaDB |
| Frontend | HTML, CSS, a little JavaScript |
| Editor | TinyMCE 6 (loaded from CDN) |
| Local environment | XAMPP (Apache + MariaDB + phpMyAdmin) |

## Project structure

```
├── index.php               # Home page: list of all posts
├── view_post.php           # Single post with its replies and reply form
├── create_post.php         # New post form (login required)
├── delete_post.php         # Delete a post and its replies (admin only)
├── register.php            # User registration
├── login.php               # Login
├── logout.php              # Logout (destroys the session)
├── profile.php             # Simple profile page
├── admin_panel.php         # Admin dashboard (admin only)
├── admin_create_user.php   # Create a user or admin (admin only)
├── menu.php                # Navigation menu shared by all pages
├── db.php                  # Database connection
├── style.css               # Styling
└── forum_db.sql            # Database structure and sample data
```

## Database

The database is called `forum_db` and has three tables:

- **users**: `id`, `username`, `password`, `role` (`user` or `admin`)
- **posts**: `id`, `user_id`, `content`, `created_at`
- **replies**: `id`, `post_id`, `user_id`, `content`, `created_at`

## Setup (local)

1. Install [XAMPP](https://www.apachefriends.org/) (or any PHP + MySQL/MariaDB setup) and start **Apache** and **MySQL**.
2. Copy the project folder into the web server directory (for XAMPP: `htdocs`).
3. Open phpMyAdmin, create a database named `forum_db`, and import `forum_db.sql`.
4. Check the connection settings in `db.php`. The defaults are the XAMPP defaults (host `localhost`, user `root`, empty password), which are suitable for local development only.
5. Add your own TinyMCE API key: create a free account at tiny.cloud and replace the key in the `<script src="https://cdn.tiny.cloud/1/.../tinymce/6/tinymce.min.js">` line in `create_post.php` and `view_post.php`.
6. Open `http://localhost/<your-folder-name>/index.php` in your browser.

### Getting an admin account

Register a normal user on the site, then open the `users` table in phpMyAdmin and change that user's `role` from `user` to `admin`. After that, the admin can create other users from the Admin Panel.

## Known limitations

This project was built to practice PHP and databases, and I know it has security and design issues that would have to be fixed before any real use:

- **SQL injection:** queries are built by inserting user input directly into SQL strings. Planned fix: prepared statements.
- **Plain-text passwords:** passwords are stored and compared without hashing. Planned fix: `password_hash()` and `password_verify()`.
- **Cross-site scripting (XSS):** user-submitted content is printed without escaping. Planned fix: output escaping with `htmlspecialchars()` and sanitizing the editor content.
- **Deleting through a link:** posts are deleted with a GET request and no CSRF protection. Planned fix: POST request with a CSRF token.
- **No input validation:** there are no checks for empty fields, length, or duplicate usernames.
- **Session handling:** the session ID is not regenerated after login.
- **Hardcoded settings:** the database credentials and the TinyMCE key are written directly in the code. Planned fix: a configuration file kept out of version control.

## Planned improvements

- Fix the issues listed above
- Edit and delete for a user's own posts and replies
- Pagination for the post list
- Better separation of logic and HTML

## Author

Stylianos Menexes, Thessaloniki, Greece
