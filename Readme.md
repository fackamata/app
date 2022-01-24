# Partage ton terrain


## intall

This project use Symfony 5.x

### Clone the repository

Install dependencies:
```bash
composer install
```

### create a database

Modify .env accordingly to your database login, password & database name

create database :
```bash
symfony console doctrine:database:create
```

create schema  :
```bash
symfony console doctrine:schema:create
```


### Load fixtures
```bash
symfony console doctrine:fixtures:load
```


### Run the server
```bash
symfony serve
```


### access

As admin
``` 
login : admin
pass : adminPass
```

any user from 1 to 20
``` 
login : username-6
pass : password
```

