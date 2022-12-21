### Prerequisites

You will need PHP, Composer and Node.js. For MacOS I recommend installing them with [Homebrew](https://brew.sh/). For Windows see instructions for [PHP](https://windows.php.net/download/), [Composer](https://getcomposer.org/doc/00-intro.md#installation-windows) and [Node](https://nodejs.org/en/download/).

### Installation

1. Clone this repo
2. Install Composer packages
   ```sh
   composer install
   ```
3. Install NPM packages
   ```sh
   npm install
   ```
4. Open .env file and change the MAIL Provider SMTP Details.
    You can use <a href="https://mailtrap.io/">MailTrap</a> to generate basic SMTP Details and test your email faeture.
    MAIL_MAILER=smtp
    MAIL_HOST=mailhog
    MAIL_PORT=1025
    MAIL_USERNAME=null
    MAIL_PASSWORD=null
    MAIL_ENCRYPTION=null

5. Create a database and configure the follow in `.env`. Enter the path to your database file
    ```
    DB_CONNECTION=
    DB_HOST=
    DB_PORT=
    DB_DATABASE=<full path to the file>
    DB_USERNAME=root
    DB_PASSWORD=
    ```
6. Initialise the database
    ```sh
    php artisan migrate
    ```
7. Compile the webpages and run it
    ```sh
    npm run dev
    php artisan serve
    ```

