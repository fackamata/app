# Partage ton terrain


## intall

This project use Symfony 5.x

Clone repository

Install dependencies:
```bash
composer install
```

### create database

Modify .env accordingly to database details

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


### Run server
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

