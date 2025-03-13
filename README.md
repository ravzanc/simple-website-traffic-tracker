# Simple website traffic tracker (PoC)

## Project Setup

### Install database `website` and table `visits` from `db_schema.sql` into your MySQL local server

### Set your MySQL `website` database username and password in the .env file
```
DB_USERNAME=
DB_PASSWORD=
```

### Install code dependencies
```sh
composer install --no-dev
```

### Start the Development server
```sh
 php -S 127.0.0.1:8000 server.php
```