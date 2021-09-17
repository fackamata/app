# Readme

## Autentification et User

### création de l'user avec :  
```
symfony console make:user
```
permet la création d'une entité user avec une propriété unique, ici sur username
On retrouve l'entité User dans /src/Entity/

### création des entité avec : 
```
symfony console make:entity
```
On retrouve les entitées crées dans /src/Entity/

### création de l'authentification :
```
symfony console make:auth
```
Création de la page login dans /templates/security/login.html.twig

Création des fonction de login et logout dans /Controller/AuthController.php

## Formulaire

### création des formulaire avec : 
```
symfony console make:form
```
Créer des formulaires par rapport au entitées

### création du formulaire de registration avec : 
```
symfony console make:registration-form
```
Créer un formulaire d'autentification, peut gérer l'envoie de mail pour valider l'autentification
mais également le login dès validation et la redirection dès login

```
symfony console make:form
```

### création des controller avec : 
```
symfony console make:controller
```
dans le controller on crée les différentes fonction qui on chacune des routes définies et qui renvoie vers la vue donnée.

## Front-end

### Bootstrap form

```
form_themes: ['bootstrap_5_layout.html.twig']
```
Ajout de cette ligne dans /config/packages/twig.yaml.

Permet d'avoir des formulaire bootstrap dans l'ensemble de l'application

### Role

dans /config/packages/security.yaml