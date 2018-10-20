# Simple Todo App
[![Build Status](https://travis-ci.org/worzy/Simple-Todo.svg?branch=master)](https://travis-ci.org/worzy/Simple-Todo)

## Local Development

**Application base URL:** `simpletodo.localhost`

The local environment requires Docker installed on the host machine, then there is a Makefile in the root of the project to easier setup and run the project.

### Setup

* `make install` - Only needs to run once to install everything
* `make start` - Run it after the installation to start the environment  

### Commands to interact with the environment

* `make start` - Starts your environment
* `make stop` - Stops the environment
* `make down`
* `make destroy`

### Testing

This is automatically setup with: `make install`

* Feature tests inc. API `docker-compose exec php-fpm t` <-- alias to run `phpunit` from within the `/vendor` folder.
* Dusk browser tests `docker-compose exec php-fpm php artisan dusk`

## Default login

Username: `admin@admin.com`
Password: `secret`

## Continuous Integration

Project set up with Travis CI https://travis-ci.com/worzy/Simple-Todo/