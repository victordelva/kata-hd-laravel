# Victor del Valle

## Requerimientos
Debes tener Docker y Docker compose disponible en tu ordenador 

## Para empezar ejecuta los siguientes comandos dentro del proyecto

> `docker-compose up -d`
>
> `cp .env.example .env`
>
> `composer install`
>
> `docker-compose exec app php artisan migrate`

Tendrás disponible la aplicación en tu localhost: 
http://localhost

## Execute tests

> `docker-compose exec app ./vendor/bin/phpunit`
