# OME Portal

"OME" means "Online Marathon Eventers", it is speedrun online event moderation group.

This is used for management/moderation our event.

## Requirements

- php > 7.4
- composer
- npm

## Installation

Install PHP dependencies with Composer.

``` sh
composer install
```

Install JavaScript Dependencies with npm.

``` sh
npm install
```

And build assets with parcel.

``` sh
npm run dev
```

Generate application key for Laravel framework.

``` sh
php artisan key:generate
```

## Run application

Below command run application with artisan.

``` sh
php artisan serve
```

## Setup Swagger Mock

This application has api document written as Swagger/OpenAPI yaml.

And you can setup mock server with swagger-codegen. This requires java (maybe jre > 9 but not tested yet).

First, run script for download swagger-codegen jar file.

``` sh
npm run docs:setup
```

then generate mock server (node-js server)

``` sh
npm run mock-server:generate
```

Finally you can run mock server.

``` sh
npm run mock-server

# Access to mock server with localhost:8080
# and view UI with http://localhost:8080/docs
```
