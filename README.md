# Simple REST API in PHP

This is a simple REST API implementation in PHP without framework

This project was built using:

- PHP
- MySQL
- JavaScript
- React
- Bootstrap

Still lacking in:

- Authentication
- Request body validation

## How to use

1. Install XAMPP
2. Download the repo then unzip it place it inside `{YOUR-XAMPP-PATH}/htdocs/{YOUR-PROJECT-DIRECTORY}`
3. Open XAMPP control panel then start Apache and MySQL
4. Open your web browser and to go `http://localhost/phpmyadmin` and create a new database
5. Import `todo_app_todos.sql` into your own database
6. Open a new tab in your web browser and go to `http://localhost/{YOUR-PROJECT-DIRECTORY}`

## Available routes

### `POST` `http://localhost/{YOUR-PROJECT-DIRECTORY}/api/todos`

Add a todo\
Request body fields:

| Field  | Data type | Required |
| ------ | --------- | -------- |
| `body` | `string`  | `true`   |

### `GET` `http://localhost/{YOUR-PROJECT-DIRECTORY}/api/todos`

Get all todos

### `GET` `http://localhost/{YOUR-PROJECT-DIRECTORY}/api/todos/{ID}`

Get a single todo by id

### `PUT` `http://localhost/{YOUR-PROJECT-DIRECTORY}/api/todos/{ID}`

Update a single todo by id\
Request body fields:

| Field          | Data type | Required |
| -------------- | --------- | -------- |
| `body`         | `string`  | `true`   |
| `hasCompleted` | `boolean` | `true`   |

### `PATCH` `http://localhost/{YOUR-PROJECT-DIRECTORY}/api/todos/{ID}`

Update a single todo `has_completed` field by id\
Request body fields:

| Field          | Data type | Required |
| -------------- | --------- | -------- |
| `hasCompleted` | `boolean` | `true`   |

### `DELETE` `http://localhost/{YOUR-PROJECT-DIRECTORY}/api/todos/{ID}`

Delete a single todo by id
