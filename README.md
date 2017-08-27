## Laravel5.4 APIs

## Required
- Docker engine
- Docker compose
- Git

## Setup
clone project
> git clone git@github.com:yuttasakcom/Laravel54API.git && cd Laravel54API

create cert
> mkdir ssl && openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout ssl/default.key -out ssl/default.crt

build & run docker
> mkdir -p data/mariadb && docker-compose up -d --build

install package
> cd www/api && composer install --prefer-dist -vvv
or
> docker exec lara composer install --prefer-dist -vvv

create env
> cd www/api && touch .env

copy text มาวาง และแก้ไขข้อมูล DB [.env.example](https://raw.githubusercontent.com/laravel/laravel/master/.env.example)
```
DB_CONNECTION=mysql
DB_HOST=mariadb
DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=root
DB_PASSWORD=password
```

generate key
> docker exec lara php artisan key:generate

change permission
> docker exec lara chmod 777 storage -R

create database `username: root, password: password`<br>
go to http://localhost:8087 create database name 'homestead'
> docker exec lara php artisan migrate:refresh --seed

good luck!<br>
go to http://localhost:8082