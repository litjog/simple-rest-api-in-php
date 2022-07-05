# Simple REST API in PHP

This is a simple REST API implementation in PHP without framework\
Still lacking in:

- Authentication
- Request body validation

## Available routes

### `POST` `http://localhost/{DIRECTORY-NAME}/api/todos.php`

Add a todo\
Request body fields:

| Field  | Data type | Required |
| ------ | --------- | -------- |
| `body` | `string`  | `true`   |

### `GET` `http://localhost/{DIRECTORY-NAME}/api/todos.php`

Get all todos

### `GET` `http://localhost/{DIRECTORY-NAME}/api/todos.php?id={ID}`

Get a single todo by id

### `PUT` `http://localhost/{DIRECTORY-NAME}/api/todos.php?id={ID}`

Update a single todo by id\
Request body fields:

| Field          | Data type | Required |
| -------------- | --------- | -------- |
| `body`         | `string`  | `true`   |
| `hasCompleted` | `boolean` | `true`   |

### `PATCH` `http://localhost/{DIRECTORY-NAME}/api/todos.php?id={ID}`

Update a single todo `has_completed` field by id\
Request body fields:

| Field          | Data type | Required |
| -------------- | --------- | -------- |
| `hasCompleted` | `boolean` | `true`   |

### `DELETE` `http://localhost/{DIRECTORY-NAME}/api/todos.php?id={ID}`

Delete a single todo by id
