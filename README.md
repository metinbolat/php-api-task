# Web Task Management Demo

This project is a web page that connects to a remote API, downloads a dataset, and displays the data in a table. It also provides search function, auto-refresh functionality, and an image selection modal.

## Features

- Retrieves data from the remote API, `https://api.baubuddy.de/dev/index.php/v1/tasks/select`.
- Displays the data in a table via `JQuery`. The data includes: `task`, `title`, `description`, and `colorCode`. The table cell which contains gets its background color from `colorCode`.
- Refreshes the data table every 60 minutes.

## Tech Stack

- HTML
- CSS
- JavaScript (with jQuery)
- PHP
- Bootstrap

## Setup and Usage

1. Clone this repository to your local machine using:
    ```bash
    git clone https://github.com/metinbolat/php-api-task.git
    ```
2. Navigate to the project directory in your terminal.
3. Run your PHP server.
4. Open the `index.php` file in your web browser.
5. Sign in using the login form. The credentials are:  
`username`: `365`  
`password`: `1`


## Author

Metin Bolat

