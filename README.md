# VHacks_Backend

## Setups

Make sure you have PHP 7.1 or higher installed on your system as well as [composer](https://getcomposer.org). You will also need a MySQL database running (either locally or using an online service) and you will need to create a database named `vhacks`.

Clone this API wherever you prefer and change your current directory to the newly cloned one:

```sh
$ git clone git@github.com:Galileo-VHacks/api.git
$ cd api
```

Prepare your environment by copying the `.env.example` file:

```sh
$ cp .env.example .env
```

Edit the new file in order to allow the application to connect to a running MySQL database (The keys that you will probably have to change are `DB_HOST`, `DB_USERNAME` and `DB_PASSWORD`).

Once you are finished you can install all the required dependencies by running:

```sh
$ composer install
```

And once this installation is finished, you can serve the application by running PHP's built in web server:

```sh
$ php -S 0.0.0.0:8000 -t public/
```

This will start the PHP server on port 8080 on your machine.

In order to perform most of the actions, you will also need a blockchain testing platform on your machine. You can read how to set this up in our [InteCoin repository](https://github.com/Galileo-VHacks/InteCoin).

