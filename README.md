## Installing enviroment

Run the command on docker:

``docker-compose up -d --build``

``docker exec -it app composer install``

``docker exec -it app php artisan key:generate``

``docker exec -it app php artisan npm install``

## Rodar DB

```text
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=secret1234
```

```bash
    php artisan migrate
    php artisan db:seed
```


# Acessar o site no endereço: ``http:\\localhost:7050``
